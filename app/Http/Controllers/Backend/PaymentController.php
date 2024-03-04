<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use App\OrderPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use TraitMyFunctions;

    public function listPayments(){ //all status in the same blade
        $status_code = 100;
        $payments =  $this->getPayments();
        return view('backend.payment.index', compact('payments', 'status_code'));
    }

    public function listPaymentsByStatusCode($status_code){ //all status in the same blade
        $payments =  $this->getPaymentsByStatusCode($status_code);
        return view('backend.payment.index', compact('payments', 'status_code'));
    }

    public function changeStageCode($status_code, $payment_id){
        $payment = OrderPayment::find($payment_id); //update status
        $payment->status_code = $status_code;
        $payment->save();

        $message = "";
        if      ($status_code==1){ $message = "Tagged as ACCEPTED."; }
        else if ($status_code==2){ $message = "Tagged as FOR DELIVERY."; }
        else if ($status_code==3){ $message = "Tagged as DELIVERED."; }
        else if ($status_code==4){ $message = "Tagged as CANCELLED."; }
        else if ($status_code==5){ $message = "Tagged as RETURNED / FOR RETURN."; }

        $notification = array(
            'message' => $message,
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

}
