<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use TraitMyFunctions;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminHome(){
        $data = array();
        $data['total_registered_users'] = $this->getTotalRegisteredUser();
        $data['total_messages'] = $this->getTotalMessage();
        $data['revenue'] = $this->getTotalRevenueAmount();
        $data['orders'] = $this->getTotalNumberOfOrdersByPayment();

        $data['paypal_amount'] = $this->getTotalRevenueAmountPaypal();
        $data['paypal_transaction'] = $this->getTotalNumberOfOrdersPaymentPaypal();
        $data['stripe_amount'] = $this->getTotalRevenueAmountStripe();
        $data['stripe_transaction'] = $this->getTotalNumberOfOrdersByPaymentStripe();

        return view('backend.home', ['data'=>$data]);
    }

}
