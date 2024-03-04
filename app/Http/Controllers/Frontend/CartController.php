<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use TraitMyFunctions;

    public function addCart($id, $qty){
        $meal = $this->getMealByIdFrontend($id);
        $data = array();

        if ($meal->discounted_price > 0){
            $data['id'] = $meal->id;
            $data['name'] = $meal->name;
            $data['qty'] = $qty;
            $data['price'] = $meal->discounted_price;
            $data['weight'] = 1;
            $data['options']['image_path'] = $meal->image_path;
            //$data['options']['color'] = '';
            //$data['options']['size'] = '';
            Cart::add($data);
        } else {
            $data['id'] = $meal->id;
            $data['name'] = $meal->name;
            $data['qty'] = $qty;
            $data['price'] = $meal->regular_price;
            $data['weight'] = 1;
            $data['options']['image_path'] = $meal->image_path;
            //$data['options']['color'] = '';
            //$data['options']['size'] = '';
            Cart::add($data);
        }
       return response()->json(['success' => $meal->name.' has been successfully added to your cart.']);
    }

    public function updateCartQuantity(Request $request){
        $rowId = $request->row_id;
        $qty = $request->qty;
        $old_qty = $request->old_qty;
        if ($old_qty == $qty) {
            $notification = array(
                'message' => 'No changes have been made.',
                'alert-type' => 'info'
            );
        } else {
            Cart::update($rowId, $qty);
            $notification = array(
                'message' => 'Item quantity has been updated.',
                'alert-type' => 'success'
            );
        }
        return Redirect()->back()->with($notification);
    }

    public function removeItemCart($rowId)
    {
        Cart::remove($rowId);

        if (Cart::total() <= 0) {
            $notification = array(
                'message'=>'Your cart is empty.',
                'alert-type'=>'info'
            );
            return Redirect()->route('index')->with($notification);
        }

        $notification = array(
            'message' => 'Successfully removed from cart',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function showCart(){
        $site_setting =  $this->getSiteSettings();
        $cart = Cart::content();

        if (Cart::total() <= 0){
            $shipping_charge = 0;
            $vat = 0;
        } else {
            $shipping_charge = $site_setting->checkout_shipping_charge;
            $vat = $site_setting->checkout_vat;
        }

        $grandTotal = number_format(((str_replace(',', '', Cart::subtotal())) +
                                    $vat +
                                    $shipping_charge),2, '.', ',');


        return view('frontend.pages-cart', compact('site_setting', 'cart', 'shipping_charge', 'vat', 'grandTotal'));
    }

}
