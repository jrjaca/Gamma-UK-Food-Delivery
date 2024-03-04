<?php

namespace App\Http\Controllers\Frontend;

use App\Facade\PayPal;
use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\InvoiceMail;
use App\OrderBilling;
use App\OrderShipping;
use App\Services\PayPalService;
use App\Services\StripeService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Stripe\Stripe;


class CheckoutController extends Controller
{
    use TraitMyFunctions;

    public function __construct()
    {
        $this->app_name = config('app.name'); //to be use in sending email
    }

    public function showCheckout(){
        $site_setting =  $this->getSiteSettings();
        $cart = Cart::content();

        if (Cart::subtotal() <= 0){
            $shipping_charge = 0;
            $vat = 0;
        } else {
            $shipping_charge = $site_setting->checkout_shipping_charge;
            $vat = $site_setting->checkout_vat;
        }

        $grandTotal = number_format(((str_replace(',', '', Cart::subtotal())) +
                                      $vat +
                                      $shipping_charge),2, '.', ',');

        $billing = "";
        $shipping = "";
        if (Auth::check()){
            $billing = $this->getOrderBillingByUserId(Auth::id());
            $shipping = $this->getOrderShippingByUserId(Auth::id());
        }

        return view('frontend.pages-checkout', compact('site_setting', 'cart', 'shipping_charge', 'vat', 'grandTotal', 'billing', 'shipping'));
    }

    public function setBillingAddress(Request $request){
        //forget,clear,unset
        Session::forget('b_address');
        //set again
        Session::put('b_address',[
            'name_billing' => $request->name_billing,
            'company_name_billing' => $request->company_name_billing,
            'street_address_billing' => $request->street_address_billing,
            'apartment_unit_billing' => $request->apartment_unit_billing,
            'town_city_billing' => $request->town_city_billing,
            'state_country_billing' => $request->state_country_billing,
            'post_zipcode_billing' => $request->post_zipcode_billing,
            'email_billing' => $request->email_billing,
            'phone_billing' => $request->phone_billing
        ]);

        if (!Session::has('s_address')) {
            //set shipping address equal to billing by default
            Session::put('s_address', [
                'name_shipping' => $request->name_billing,
                'company_name_shipping' => $request->company_name_billing,
                'street_address_shipping' => $request->street_address_billing,
                'apartment_unit_shipping' => $request->apartment_unit_billing,
                'town_city_shipping' => $request->town_city_billing,
                'state_country_shipping' => $request->state_country_billing,
                'post_zipcode_shipping' => $request->post_zipcode_billing,
                'email_shipping' => $request->email_billing,
                'phone_shipping' => $request->phone_billing
            ]);
        }

        $notification = array(
            'message'=>'Billing address has been set.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function setShippingAddress(Request $request){
        //forget,clear,unset
        Session::forget('s_address');
        //set again
        Session::put('s_address',[
            'name_shipping' => $request->name_shipping,
            'company_name_shipping' => $request->company_name_shipping,
            'street_address_shipping' => $request->street_address_shipping,
            'apartment_unit_shipping' => $request->apartment_unit_shipping,
            'town_city_shipping' => $request->town_city_shipping,
            'state_country_shipping' => $request->state_country_shipping,
            'post_zipcode_shipping' => $request->post_zipcode_shipping,
            'email_shipping' => $request->email_shipping,
            'phone_shipping' => $request->phone_shipping
        ]);

        $notification = array(
            'message'=>'Shipping address has been set.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //saving and email sending is in app\Services\PayPalService.php
    public function checkoutPaypal(Request $request){
        /*---PayPal Payment Gateway---*/
        Session::put('vat_amount', $request->vat_amount);
        Session::put('shipping_charge', $request->shipping_charge);
        Session::put('phone_setting', $request->phone_setting);
        Session::put('email_setting', $request->email_setting);
        Session::put('logo_path_setting', $request->logo_path_setting);

        $currency = "GBP";
        //remove ',' first before addition
        $totalAmount = str_replace(',', '', Cart::subtotal()) +
                                        $request->vat_amount +
                                        $request->shipping_charge;

        //assumed that all inputs are validated
        $paymentPlatform = resolve(PayPalService::class); //authorization
        return $paymentPlatform->handlePayment($totalAmount, $currency); //for checkout Now
        //SAVING, EMAIL is in PalpalService.php
        //dd($paymentPlatform->handlePayment($request));
        /*---/PayPal Payment Gateway---*/
    }
            public function paypalApproval(){
                $paymentPlatform = resolve(PayPalService::class);
                return $paymentPlatform->handleApproval();
            }
            public function paypalCancelled(){
                $notification = array(
                    'message' => 'You have cancelled your payment.',
                    'alert-type' => 'info'
                );

                return redirect()
                    ->route('show.checkout')
                    ->with($notification);
            }

    public function checkoutStripe(Request $request){
        $request->validate([
            'payment_method' => 'required',
        ]);

        Session::put('vat_amount', $request->vat_amount);
        Session::put('shipping_charge', $request->shipping_charge);
        Session::put('phone_setting', $request->phone_setting);
        Session::put('email_setting', $request->email_setting);
        Session::put('logo_path_setting', $request->logo_path_setting);

        $paymentMethod = $request->payment_method;
        $currency = "gbp";
        //remove ',' first before addition
        $totalAmount = str_replace(',', '', Cart::subtotal()) +
            $request->vat_amount +
            $request->shipping_charge;

        //assumed that all inputs are validated
        $paymentPlatform = resolve(StripeService::class); //authorization
        return $paymentPlatform->handlePayment($totalAmount, $currency, $paymentMethod); //for checkout Now
        //SAVING, EMAIL is in StripeService.php
    }
            public function stripeApproval(){
                $paymentPlatform = resolve(StripeService::class);
                return $paymentPlatform->handleApproval();
            }
            public function stripeCancelled(){
                $notification = array(
                    'message' => 'You have cancelled your payment.',
                    'alert-type' => 'info'
                );

                return redirect()
                    ->route('show.checkout')
                    ->with($notification);
            }

    public function insertOrderDetail($order_payment_id){
        $content = Cart::content();
        $data = array();
        foreach ($content as $row){
            $data['order_payment_id'] = $order_payment_id;
            $data['meal_id'] = $row->id;
            $data['meal_name'] = $row->name;
            $data['quantity'] = $row->qty;
            $data['price_single'] = number_format(($row->price),2, '.', ',');
            $data['price_total'] = number_format(($row->qty*$row->price),2, '.', ',');
            $data['created_at'] = Carbon::now();
            DB::table('order_details')->insert($data);   //insert muliple records into order_details table
        }
    }

    public function insertOrderBilling(){

        $billing = $this->getOrderBillingByUserId(Auth::id()); //if exit-update, if fail insert
        if ($billing === null){
            $billing = new OrderBilling();//create
        } //else //update

        $billing->user_id = Auth::id();
        $billing->name = Session::get('b_address')['name_billing'];
        $billing->company_name = Session::get('b_address')['company_name_billing'];
        $billing->street_address = Session::get('b_address')['street_address_billing'];
        $billing->apartment_unit = Session::get('b_address')['apartment_unit_billing'];
        $billing->town_city = Session::get('b_address')['town_city_billing'];
        $billing->state_country = Session::get('b_address')['state_country_billing'];
        $billing->post_zipcode = Session::get('b_address')['post_zipcode_billing'];
        $billing->email = Session::get('b_address')['email_billing'];
        $billing->phone = Session::get('b_address')['phone_billing'];
        //$billing->country_code
        $billing->save();
    }

    public function insertOrderShipping(){
        $shipping = $this->getOrderShippingByUserId(Auth::id()); //if exit-update, if fail insert
        if ($shipping === null ){
            $shipping = new OrderShipping();//create
        } //else //update

        $shipping->user_id = Auth::id();
        $shipping->name = Session::get('s_address')['name_shipping'];
        $shipping->company_name = Session::get('s_address')['company_name_shipping'];
        $shipping->street_address = Session::get('s_address')['street_address_shipping'];
        $shipping->apartment_unit = Session::get('s_address')['apartment_unit_shipping'];
        $shipping->town_city = Session::get('s_address')['town_city_shipping'];
        $shipping->state_country = Session::get('s_address')['state_country_shipping'];
        $shipping->post_zipcode = Session::get('s_address')['post_zipcode_shipping'];
        $shipping->email = Session::get('s_address')['email_shipping'];
        $shipping->phone = Session::get('s_address')['phone_shipping'];
        //$shipping->country_code
        $shipping->save();
    }




    /*public function receiveData(Request $request){
        //customized message, or create Request
        $messages = [
            'required' => 'The :attribute field is required'
        ];

        //validation
        $validator = Validator::make($request->all(), [
                'person_name' => 'required|string',
                'person_email' => 'required|email',
            ]
        );

        //dd($Validator);
        //if validation fails
        if ($validator->fails()){
            $Response = $validator->messages();

        } else {

            //$paymentPlatform = resolve(PayPalService::class);
            //return $paymentPlatform->handlePayment($request);

            $Response = ['success' => 'Your data has been submitted.'];
        }
        return response ()->json($Response, 200);

    }*/
}
