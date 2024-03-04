<?php

use App\FoodType;
use App\Meal;
use App\SiteSetting;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//=======================================  FRONTEND  =============================================//

    Route::get('/', function () {
        $site_setting = App\Helpers\TraitMyFunctions::getSiteSettings();
        $food_types_welcome = App\Helpers\TraitMyFunctions::getAllFoodTypesWelcome();
        $meals_welcome = App\Helpers\TraitMyFunctions::getAllMealsWelcome();
        return view('welcome',compact('site_setting','food_types_welcome', 'meals_welcome'));
    })->name('index');

    /*Route::get('/post-data', 'Frontend\CheckoutController@receiveData')->name('postData');*/

    //for verifying email after registration
    Auth::routes(['verify' => true]);

    //UserController
    Route::get('/index', 'Auth\UserController@triggerLogin')->name('trigger.login');
    Route::post('/checkout/login', 'Auth\UserController@checkoutLogin')->name('checkout.login');
    Route::post('/checkout/register', 'Auth\UserController@checkoutRegister')->name('checkout.register');

    //ChangePasswordController
//For Authenticated User Only
Route::middleware(['auth'])->group(function(){

    Route::get('/password/change', 'Auth\ChangePasswordController@changePassword')->name('change.password');
    Route::post('/password/update', 'Auth\ChangePasswordController@updatePassword')->name('update.password');

});


    //HomeController
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/menu-grid', 'HomeController@menuGrid')->name('menu.grid');
    Route::get('/menu-list', 'HomeController@menuList')->name('menu.list');
    /*Route::get('/menu-details', 'HomeController@menuDetails')->name('menu.details');*/
    Route::get('/menu-details/{id}', 'HomeController@menuDetailsById');
    Route::get('/gallery', 'HomeController@gallery')->name('gallery');
    Route::get('/pages-service', 'HomeController@pagesService')->name('pages.service');
    /*Route::get('/pages-checkout', 'HomeController@pagesCheckout')->name('pages.checkout');*/
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::post('/contact/send', 'HomeController@contactSend')->name('contact.send');
    Route::get('/food-type/{id}', 'HomeController@foodTypeById');

    Route::post('/update/profile', 'HomeController@updateProfile')->name('update.profile');


    //CartController
    Route::get('/cart/product/add/{id}/{qty}', 'Frontend\CartController@addCart');
    Route::get('/cart/product/remove/{id}', 'Frontend\CartController@removeItemCart');
    Route::get('/cart', 'Frontend\CartController@showCart')->name('show.cart');
    Route::post('/cart/quantity/update', 'Frontend\CartController@updateCartQuantity')->name('quantity.update.cart');

    //CheckoutController
    Route::get('/paypal/approval', 'Frontend\CheckoutController@paypalApproval')->name('paypal.approval');
    Route::get('/paypal/cancelled', 'Frontend\CheckoutController@paypalCancelled')->name('paypal.cancelled');
//Check if cart has an amount
Route::middleware(['check.if.has.amount'])->group(function() {

    Route::get('/checkout', 'Frontend\CheckoutController@showCheckout')->name('show.checkout');
    Route::post('/checkout/billing-address', 'Frontend\CheckoutController@setBillingAddress')->name('billing.address');
    Route::post('/checkout/shipping-address', 'Frontend\CheckoutController@setShippingAddress')->name('shipping.address');

});
/*Route::get('test-email', 'Frontend\CheckoutControlle@enqueue');*/

Route::middleware(['check.if.has.amount', 'check.if.has.billing.shipping.auth'])->group(function() {

    Route::post('/checkout/paypal', 'Frontend\CheckoutController@checkoutPaypal')->name('checkout.paypal');
    Route::post('/checkout/stripe', 'Frontend\CheckoutController@checkoutStripe')->name('checkout.stripe');
    Route::get('/stripe/approval', 'Frontend\CheckoutController@stripeApproval')->name('stripe.approval');
    Route::get('/stripe/cancelled', 'Frontend\CheckoutController@stripeCancelled')->name('stripe.cancelled');

});

//For Authenticated User Only
Route::middleware(['auth'])->group(function(){

    //HomeController
    Route::get('/home', 'HomeController@index')->name('home');
    /*Route::get('/payment-order-details/{id}', 'HomeController@orderDetails');*/

    //OrderController
    Route::get('/order/details/{payment_id}', 'Backend\OrderController@fullPaymentOrderUserAddressDetails');
});


//=======================================  BACKEND  =============================================//

//Authenticated User and Administrator Only
Route::middleware(['auth','check.if.admin'])->group(function(){

    //AdminController
    Route::get('/admin/home', 'Backend\AdminController@adminHome')->name('admin.home');

    //FoodTypeController
    Route::get('/admin/food-type/create', 'Backend\FoodTypeController@create')->name('admin.food-type.create');
    Route::post('/admin/food-type/store', 'Backend\FoodTypeController@store')->name('admin.food-type.store');
    Route::get('/admin/food-type/index', 'Backend\FoodTypeController@index')->name('admin.food-type.index');
    Route::get('/admin/food-type/show/{id}', 'Backend\FoodTypeController@show');
    Route::get('/admin/food-type/edit/{id}', 'Backend\FoodTypeController@edit');
    Route::post('/admin/food-type/update', 'Backend\FoodTypeController@update')->name('admin.food-type.update');
    Route::get('/admin/food-type/delete/{id}', 'Backend\FoodTypeController@deleteItem');
    Route::get('/admin/food-type/enablesoftdelete/{id}', 'Backend\FoodTypeController@enableSoftDelete');
    Route::get('/admin/food-type/disablesoftdelete/{id}', 'Backend\FoodTypeController@disableSoftDelete');
    Route::delete('/admin/food-type/delete-all-selected', 'Backend\FoodTypeController@deleteAllSelected');

    //MealTypeController
    Route::get('/admin/meal-type/create', 'Backend\MealTypeController@create')->name('admin.meal-type.create');
    Route::post('/admin/meal-type/store', 'Backend\MealTypeController@store')->name('admin.meal-type.store');
    Route::get('/admin/meal-type/index', 'Backend\MealTypeController@index')->name('admin.meal-type.index');
    Route::get('/admin/meal-type/delete/{id}', 'Backend\MealTypeController@destroy');
    /*Route::get('/admin/meal-type/edit/{id}', 'Backend\MealTypeController@edit'); --THRU MODAL --*/
    Route::post('/admin/meal-type/update', 'Backend\MealTypeController@update')->name('admin.meal-type.update');
    Route::get('/admin/meal-type/enablesoftdelete/{id}', 'Backend\MealTypeController@enableSoftDelete');
    Route::get('/admin/meal-type/disablesoftdelete/{id}', 'Backend\MealTypeController@disableSoftDelete');


    //MealController
    Route::get('/admin/meal/create', 'Backend\MealController@create')->name('admin.meal.create');
    Route::get('/admin/meal/index', 'Backend\MealController@index')->name('admin.meal.index');
    Route::post('/admin/meal/store', 'Backend\MealController@store')->name('admin.meal.store');
    Route::get('/admin/meal/delete/{id}', 'Backend\MealController@deleteItem');
    Route::get('/admin/meal/enablesoftdelete/{id}', 'Backend\MealController@enableSoftDelete');
    Route::get('/admin/meal/disablesoftdelete/{id}', 'Backend\MealController@disableSoftDelete');
    Route::delete('/admin/meal/delete-all-selected', 'Backend\MealController@deleteAllSelected');
    Route::get('/admin/meal/show/{id}', 'Backend\MealController@show');
    Route::get('/admin/meal/edit/{id}', 'Backend\MealController@edit');
    Route::post('/admin/meal/update', 'Backend\MealController@update')->name('admin.meal.update');

    //SiteSettingController
    Route::get('/admin/site-setting/details/edit', 'Backend\SiteSettingController@editDetails')->name('admin.site-setting.details.edit');
    Route::get('/admin/site-setting/images/edit', 'Backend\SiteSettingController@editImages')->name('admin.site-setting.images.edit');
    Route::post('/admin/site-setting/details/update', 'Backend\SiteSettingController@updateDetails')->name('admin.site-setting.details.update');
    Route::post('/admin/site-setting/images/update', 'Backend\SiteSettingController@updateImages')->name('admin.site-setting.images.update');

    //UserController
    Route::get('/admin/users', 'Backend\UserController@listUsers')->name('admin.users');
    Route::get('/admin/user/messages', 'Backend\UserController@listMessages')->name('admin.user.messages');

    //PaymentController
    Route::get('/admin/payments', 'Backend\PaymentController@listPayments')->name('admin.payments');
    Route::get('/admin/payments/status/{status_code}', 'Backend\PaymentController@listPaymentsByStatusCode');
    Route::get('/admin/payments/change-status/{status_code}/{payment_id}', 'Backend\PaymentController@changeStageCode');
});