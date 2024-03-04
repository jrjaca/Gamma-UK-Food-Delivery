<?php

namespace App\Services;

use App\Helpers\ConsumesExternalServices;
use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Jobs\SendEmail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StripeService
{
    use ConsumesExternalServices;
    use TraitMyFunctions;

    protected $baseUri;
    protected $key;
    protected $secret;
    protected $checkoutController;
    protected $app_name;

    public function __construct(CheckoutController $checkoutController)
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
        $this->checkoutController = $checkoutController;
        $this->app_name = config('app.name'); //to be use in sending email
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers){
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response){
        return json_decode($response);
    }

    public function resolveAccessToken(){
        return "Bearer {$this->secret}";
    }

    public function handlePayment($totalAmount, $currency, $paymentMethod){
       $intent = $this->createIntent($totalAmount, $currency, $paymentMethod);
       session()->put('paymentIntentId', $intent->id);
       //return redirect()->route('approval');  I have no payment resolver, i don't use this
       return $this->handleApproval();
    }

    public function handleApproval(){
        //returned api response must have a payment id returned
        if (session()->has('paymentIntentId')){
            $paymentIntentId = session()->get('paymentIntentId');
            $confirmation = $this->confirmPayment($paymentIntentId);

            if ($confirmation->status === 'requires_action') { //using credit card number to test to return this status 4000002500003155
                $clientSecret = $confirmation->client_secret;
                return view('frontend.payment.3d-secure')->with([
                    'clientSecret' => $clientSecret
                ]);
            }

            //save the data from api (amount) not the one you have passed, because this is the actuall sent, although it is the same
            //SAVE TO BD, EMAIL, SAVE BILLING,SHIPPING ADDRESS IF THE STATUS IS SUCCEEDED
            if ($confirmation->status === 'succeeded'){ //succeeded
                //$name = $confirmation->charge->data[0]->billing_details->name;
                $currency = strtoupper($confirmation->currency);
                $totalAmount = number_format(($confirmation->amount/100),2, '.', ',');
                $balance_transaction = $confirmation->charges->data[0]->balance_transaction;
                $payment_method = $confirmation->payment_method;

                //Set from CHeckoutController checkoutPaypal() function
                $vat_amount = Session::get('vat_amount');
                $shipping_charge = Session::get('shipping_charge');
                $phone_setting = Session::get('phone_setting');
                $email_setting = Session::get('email_setting');
                $logo_path_setting = Session::get('logo_path_setting');

                $data = array();
                $data['user_id'] = Auth::id();
                //$table->integer('coupon_id')->nullable();
                $data['payment_type'] = "stripe"; //cod, paypal, check, creditcard, stripe
                $data['payment_id'] = $payment_method;
                $data['balance_transaction'] = $balance_transaction;
                $data['order_id'] = uniqid(); //changes  - unique id by laravel
                $data['payment_status'] = $confirmation->status;
                $data['shipping_charge'] = $shipping_charge;
                $data['vat_amount'] = $vat_amount;
                $data['subtotal_amount'] = Cart::subtotal();//$table->string('subtotal_amount');
                $data['total_amount'] = $totalAmount;
                $data['status_code'] = 0;//$table->integer('status_code')->default(0)->comment('0-new, 1-Payment accepted, 2-for delivery,
                //3-delivered, 4-canceled, 5-for return, 6-returned');
                $data['tracking_code'] = $this->generatePaymentTrackingNumber();//date('mdY').mt_rand(100000,999999); //status code for followup. mdY+6digts random number
                $data['payment_date'] = Carbon::now();//$table->date('payment_date');
                $data['created_at'] = Carbon::now();

                //insert
                $order_payment_id = DB::table('order_payments')->insertGetId($data); //insert in order_payments table
                $this->checkoutController->insertOrderDetail($order_payment_id); //insert in order_details table
                $this->checkoutController->insertOrderBilling(); //insert/update in order_billings table
                $this->checkoutController->insertOrderShipping(); //insert/update in order_shippings table

                //======================================== any changes here must be adjusted also to PayPalService.php handleApproval() ====================//
                //---- additional to email ----//
                $data['cart_content_arr'] = Cart::content();
                $data['shipping_address_arr'] = Session::get('s_address');
                $data['name_user'] = Auth::user()->name;
                $data['app_name'] = $this->app_name;//get from .env
                //get from setting, email_setting to be used to appear as sender-FROM
                $data['phone_setting'] = $phone_setting;
                $data['email_setting'] = $email_setting;
                $data['logo_path_setting'] = $logo_path_setting;
                //---- /additional to aemail ----//
                //======================================== any changes here must be adjusted also to PayPalService.php handleApproval() ====================//

                $userEmail = Auth::user()->email;
                $details = ['email' => $userEmail,
                    'data' => $data];
                SendEmail::dispatchNow($details); //passed to SendMail.php / if you want to send w/o a que but TOO SLOW FOR USER SIDE
                //SendEmail::dispatch($details); //passed to SendMail.php / with que but required to run php artisan queue:work --queue=high,default

                //clear cart
                Cart::destroy();
                //if (Session::has('b_address')){ Session::forget('b_address'); }
                //if (Session::has('s_address')){ Session::forget('s_address'); }

                $notification = array(
                    'message' => 'Transaction has been successful. Thank you for your purchased.',
                    'alert-type' => 'success'
                );
                return redirect()
                    ->route('home')
                    //->back()
                    ->with('success', "We have received your £{$totalAmount} payment. Please check your email for more details.")
                    ->with($notification);
            }
            return redirect()->back()->with('error', 'We are unable to confirm your payment. Stripe Status: '.$confirmation->status.'.');
        }

        //no payment ID have been given, either with problem in payment
        return redirect()->back()->with('error', 'We are unable to confirm your payment. Please try again.');
    }
            public function confirmPayment($paymentIntentId){
                return $this->makeRequest(
                    'POST',
                    "/v1/payment_intents/{$paymentIntentId}/confirm",
                );
            }

    public function createIntent($value, $currency, $paymentMethod){
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            [],
            [
                'amount' => round($value*100),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod, //returned token of stripe upon submit
                'confirmation_method' => 'manual' //based from api
            ]
        );
    }

}
