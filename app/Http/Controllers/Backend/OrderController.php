<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use TraitMyFunctions;

    /*public function listOrders(){
        $orders =  $this->getOrders();
        return view('backend.order.index', compact('orders'));
    }

    public function listOrdersByPaymentStatusCode($status_code){
        $orders =  $this->getOrdersByPaymentStatusCode($status_code);
        return view('backend.order.status', compact('orders'));
    }*/

    public function fullPaymentOrderUserAddressDetails($payment_id){
        //dd($payment_id);
        $full_details =  $this->getPaymentOrderUserAddressDetailsByPaymentId($payment_id);
        return json_encode($full_details);
    }

}
