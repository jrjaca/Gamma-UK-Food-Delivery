<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\Helpers\TraitMyFunctions;
use App\Http\Requests\UserProfileRequest;
use App\SiteSetting;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use TraitMyFunctions;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $payment_details =  $this->getUserPurchasedByUserId(Auth::id());
        return view('home', compact('payment_details'));
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $withChanges = $user->isDirty();
        $user->save();

        if ($withChanges){
            $notification = array(
                'message' => 'Successfully updated.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'No changes have been made.',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /*public function orderDetails($payment_id)
    {
        $payment_detail =  $this->getUserPurchasedByPaymentId($payment_id);
        $order_details =  $this->getUserOrderDetailsWithImageByPaymentId($payment_id);
        $order_billing_address =  $this->getUserBillingAddressByUserId(Auth::id());
        $order_shipping_address =  $this->getUserShippingAddressByUserId(Auth::id());
        return view('payment-order-details', compact('payment_detail','order_details', 'order_billing_address', 'order_shipping_address'));
    }*/

    public function about()
    {
        $site_setting = $this->getSiteSettings();
        return view('frontend.about', compact('site_setting'));
    }

    public function menuGrid()
    {
        $site_setting =  $this->getSiteSettings();
        $allmealsgrid =  $this->getAllMealsGrid();
        return view('frontend.menu-grid', compact('site_setting', 'allmealsgrid'));
    }

    public function menuList()
    {
        $site_setting =  $this->getSiteSettings();
        $allmealslist =  $this->getAllMealsList();
        $allfoodtypesorderbyname =  $this->getAllFoodTypesOrderByName();
        $allmealtypesorderbyname =  $this->getAllMealTypesOrderByName();
        $allmealsandmealtypeslistview =  $this->getAllMealsAndMealTypesListView();
        return view('frontend.menu-list', compact('site_setting', 'allmealslist', 'allfoodtypesorderbyname', 'allmealtypesorderbyname', 'allmealsandmealtypeslistview'));
    }

    /*public function menuDetails()
    {
        $site_setting =  $this->getSiteSettings();
        return view('frontend.menu-details', compact('site_setting'));
    }*/
            public function menuDetailsById($id)
            {
                $site_setting =  $this->getSiteSettings();
                $meal =  $this->getMealByIdFrontend($id);
                $allmealimagesbymealidfrontend =  $this->getAllMealImagesByMealIdFrontend($id);
                $top3popularmenu =  $this->getTop3PopularMenu();
                return view('frontend.menu-details', compact('site_setting', 'meal', 'allmealimagesbymealidfrontend', 'top3popularmenu'));
            }

    public function gallery()
    {
        $site_setting =  $this->getSiteSettings();
        $allmealtypesorderbyname =  $this->getAllMealTypesOrderByName();
        $allmealslist =  $this->getAllMealsList();
        $allmealtypesandmealmealtypesgalleryview =  $this->getAllMealTypesAndMealMealTypesGalleryView();
        $allmealimages =  $this->getAllMealImages();;
        return view('frontend.gallery', compact('site_setting', 'allmealtypesorderbyname', 'allmealslist', 'allmealtypesandmealmealtypesgalleryview', 'allmealimages'));
    }

    public function pagesService()
    {
        $site_setting =  $this->getSiteSettings();
        return view('frontend.pages-service', compact('site_setting'));
    }

    /*public function pagesCart() at CartController
    {
        $site_setting =  $this->getSiteSettings();
        return view('frontend.pages-cart', compact('site_setting'));
    }*/

    /*public function pagesCheckout()
    {
        $site_setting =  $this->getSiteSettings();
        return view('frontend.pages-checkout', compact('site_setting'));
    }*/

    public function contact()
    {
        $site_setting =  $this->getSiteSettings();
        return view('frontend.contact', compact('site_setting'));
    }

    public function contactSend(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if ($validator->fails()){
            $notification = array(
                'message' => 'Unable to send message. Please check the error above.',
                'alert-type' => 'warning'
            );
            return Redirect()->back()
                ->withErrors($validator)
                ->with($notification);
        }

        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();

        $notification = array(
            'message' => 'Your message has been successfully sent.',
            'alert-type' => 'success'
        );
        return Redirect()->route('index')->with($notification);
    }

    public function foodTypeById($id){
        $site_setting =  $this->getSiteSettings();
        $mealbyfoodtypeid = $this->getMealByFoodTypeId($id);
        $foodtypesbyid = $this->getFoodTypesById($id);
        return view('frontend.food-type', compact('site_setting','mealbyfoodtypeid','foodtypesbyid'));
    }

}
