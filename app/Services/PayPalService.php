<?php

namespace App\Services;

use App\Helpers\ConsumesExternalServices;
use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Jobs\SendEmail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PayPalService
{
    use ConsumesExternalServices;
    use TraitMyFunctions;

    protected $baseUri;
    protected $clientId;
    protected $clientSecret;
    protected $checkoutController;
    protected $app_name;

    public function __construct(CheckoutController $checkoutController)
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
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

        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");
        return "Basic {$credentials}";
    }

    public function handlePayment($totalAmount, $currency){
        $order = $this->createOrder($totalAmount, $currency);
        $orderLinks = collect($order->links);

        //look for approve
        $approve = $orderLinks->where('rel', 'approve')->first();
        session()->put('approvalId', $order->id);
        return redirect($approve->href);
    }
            public function createOrder($totalAmount, $currency){
                //makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $isJsonRequest = false)
                return $this->makeRequest(
                    'POST',
                    '/v2/checkout/orders',
                    [],
                    [
                        'intent' => 'CAPTURE',
                        'purchase_units' => [
                            0 => [
                                'amount' => [
                                    'currency_code' => strtoupper($currency),
                                    'value' => $totalAmount
                                ]
                            ]
                        ],
                        'application_context' => [
                            'brand_name' => config('app.name'),
                            'shipping_preference' => 'NO_SHIPPING',
                            'user_action' => 'PAY_NOW', //CONTINUE, PAY_NOW
                            'return_url' => route('paypal.approval'),
                            'cancel_url' => route('paypal.cancelled')
                        ]
                    ],
                    [],
                    $isJsonRequest = true //since based on documentation it is json format
                );
            }

    public function handleApproval(){
        if (session()->has('approvalId')){
            $approvalId = session()->get('approvalId');
            //returned data from paypal
            $returnedData = $this->capturePayment($approvalId);

            //Set from CHeckoutController checkoutPaypal() function
            $vat_amount = Session::get('vat_amount');
            $shipping_charge = Session::get('shipping_charge');
            $phone_setting = Session::get('phone_setting');
            $email_setting = Session::get('email_setting'); 
            $logo_path_setting = Session::get('logo_path_setting');

            //SAVE TO DB and EMAIL
            //returned value from paypal
            $payment = $returnedData->purchase_units[0]->payments->captures[0];
            $total = number_format($payment->amount->value,2, '.', ','); //from paypal
            $payment_id = $payment->id;
            $order_id = $returnedData->id;
            $payment_status = $returnedData->status;

            $data = array();
            $data['user_id'] = Auth::id();
            //$table->integer('coupon_id')->nullable();
            $data['payment_type'] = "paypal"; //cod, paypal, check, creditcard, stripe
            $data['payment_id'] = $payment_id; //paypal's transaction_id
            //$data['balance_transaction'] = "";
            $data['order_id'] = $order_id;
            $data['payment_status'] = $payment_status;
            $data['shipping_charge'] = $shipping_charge;
            $data['vat_amount'] = $vat_amount;
            $data['subtotal_amount'] = Cart::subtotal();
            $data['total_amount'] = $total;
            $data['status_code'] = 0;//$table->integer('status_code')->default(0)->comment('0-new, 1-Payment accepted, 2-for delivery,
            // 3-delivered, 4-canceled, 5-for return, 6-returned');
            $data['tracking_code'] = $this->generatePaymentTrackingNumber();//date('mdY').mt_rand(100000,999999); //status code for followup. mdY+6digts random number
            $data['payment_date'] = Carbon::now();//$table->date('payment_date');
            $data['created_at'] = Carbon::now();

            //insert
            $order_payment_id = DB::table('order_payments')->insertGetId($data); //insert in order_payments table
            $this->checkoutController->insertOrderDetail($order_payment_id); //insert in order_details table
            $this->checkoutController->insertOrderBilling(); //insert in order_billings table
            $this->checkoutController->insertOrderShipping(); //insert in order_shippings table

            //======================================== any changes here must be adjusted also to CheckoutController checkoutStripe() ====================//
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

            $userEmail = Auth::user()->email;
            $details = ['email' => $userEmail,
                'data' => $data];
            SendEmail::dispatchNow($details); //passed to SendMail.php / if you want to send w/o a que but TOO SLOW FOR USER SIDE
            //SendEmail::dispatch($details); //passed to SendMail.php / with que but required to run php artisan queue:work --queue=high,default
            //======================================== any changes here must be adjusted also to CheckoutController checkoutStripe() ====================//
//$res = SendEmail::dispatchNow($details);
//dd($res);
            //clear cart
            Cart::destroy();
            //if (Session::has('b_address')){ Session::forget('b_address'); }
            //if (Session::has('s_address')){ Session::forget('s_address'); }
            //Session::has('vat_amount');
            //Session::has('shipping_charge');

            $notification = array(
                'message' => 'Transaction has been successful. Thank you for your purchased.',
                'alert-type' => 'success'
            );
            return redirect()
                ->route('home')
                ->with('success', "We have received your £{$total} payment. Please check your email for more details.")
                ->with($notification);
        } else {
            $notification = array(
                'message' => 'Please check error message.',
                'alert-type' => 'error'
            );
            return redirect()
                ->route('show.checkout')
                ->with('error', 'We cannot capture the payment as of the moment. Please try again.')
                ->with($notification);
        }

    }
            public function capturePayment($approvalId){

                return $this->makeRequest(
                    'POST',
                    "/v2/checkout/orders/{$approvalId}/capture",
                    [],
                    [],
                    [
                        'content-type' => 'application/json'
                    ]
                );
            }

}
