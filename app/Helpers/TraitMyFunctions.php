<?php


namespace App\Helpers;

use App\ContactUs;
use App\FoodType;
use App\Meal;
use App\MealImage;
use App\MealsMealtype;
use App\MealType;
use App\OrderBilling;
use App\OrderPayment;
use App\OrderShipping;
use App\SiteSetting;
use App\User;
use Illuminate\Support\Facades\DB;

trait TraitMyFunctions
{

    public static function getSiteSettings(){
        return SiteSetting::find(1); //for frontend - app.blade
    }

    public static function getAllFoodTypes(){
        return FoodType::all();
    }
            public static function getAllFoodTypesWelcome(){
                return FoodType::orderBy('created_at', 'desc')->paginate(6, ['*'], 'type');
            }
            public static function getAllFoodTypesOrderByName(){ //except softdeleted
                return FoodType::orderBy('name', 'ASC')->get();
            }
            /*food-type.blade*/
            public static function getFoodTypesById($id){ //except softdeleted
                return FoodType::find($id);
            }

    public static function getAllMealTypesIncludeSoftDeleted(){ //include softdeleted, MealTypeController - Backend
        return MealType::withTrashed()->orderBy('name', 'ASC')->get();;
    }
            public static function getAllMealTypes(){ //excluded softdeleted, MealController - Backend
                return MealType::all();
            }
            public static function getAllMealTypesOrderByName(){ //except softdeleted
                return MealType::orderBy('name', 'ASC')->get();
            }
            public static function getAllMealTypesAndMealMealTypesGalleryView(){ //softdeletd not included / Gallery
                return DB::table('meal_types')
                    ->leftJoin('meals_mealtypes', 'meal_types.id', 'meals_mealtypes.meal_type_id')  /*many to many*/
                    ->where('meals_mealtypes.deleted_at', null)
                    ->where('meal_types.deleted_at', null) //06-02-2020
                    ->select('meal_types.*', 'meals_mealtypes.id as m_mt_id', 'meals_mealtypes.meal_id as m_mt_meal_id', 'meals_mealtypes.meal_type_id as m_mt_meal_type_id')
                    ->orderBy(DB::raw('RAND()'))
                    ->get();
                /*->orderBy('meals.created_at', 'DESC')*/
                /*->paginate(12, ['*'], 'product');*/
            }

    public static function getAllMealsMealtypes(){//except softdeleted
        return MealsMealtype::all();
    }
            public static function getAllMealsMealtypesByMealId($id){//By meal_id, exclude softdeleted, MealController - backend
                //return MealsMealtype::withTrashed()->where('meal_id', $id)->get();
                return DB::table('meals_mealtypes')
                    ->leftJoin('meal_types', 'meals_mealtypes.meal_type_id', 'meal_types.id')
                    ->where('meals_mealtypes.meal_id', $id)
                    ->where('meals_mealtypes.deleted_at', null)
                    ->select('meals_mealtypes.*', 'meal_types.name as meal_type_name')
                    ->get();
            }

    public static function getAllMealImages(){ //except softdeleted
        return MealImage::all();
    }
            public static function getAllMealImagesByMealId($id){//By meal_id, including softdaleted
                return MealImage::withTrashed()
                        ->where('meal_id', $id)
                        ->orderBy('position_no', 'ASC')
                        ->get();
            }
            public static function getAllMealImagesByMealIdFrontend($id){//By meal_id, excluding softdaleted
                return DB::table('meal_images')
                    ->where('meal_id', $id)
                    ->where('deleted_at', null)
                    ->orderBy('position_no', 'ASC')
                    ->get();
            }

    public static function getAllMeals(){ // all in the Meals table, including softdeleted
        //return Meal::all(); //except softdeleted
        return DB::table('meals')
                ->leftJoin('food_types', 'meals.food_type_id', 'food_types.id')
                ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                ->where('meal_images.position_no', 0)
                ->select('meals.*', 'food_types.name as food_type_name', 'meal_images.path as image_path')
                ->orderBy('created_at', 'DESC')
                ->get();
    }
            public static function getAllMealsWelcome(){ //softdeletd not included  / Welcome page
                return DB::table('meals')
                    ->leftJoin('food_types', 'meals.food_type_id', 'food_types.id')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meal_images.position_no', 0)
                    ->where('meals.deleted_at', null)
                    ->select('meals.*', 'food_types.name as food_type_name', 'food_types.icon_path as food_type_icon', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    /*->orderBy('meals.created_at', 'DESC')*/
                    ->paginate(9, ['*'], 'product');
            }
            public static function getAllMealsGrid(){ //softdeletd not included  / Menu grid
                return DB::table('meals')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meal_images.position_no', 0)
                    ->where('meals.deleted_at', null)
                    ->select('meals.*', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    /*->orderBy('meals.created_at', 'DESC')*/
                    ->paginate(12, ['*'], 'product');
            }
            public static function getAllMealsList(){ //softdeletd not included  / Menu List
                return DB::table('meals')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meal_images.position_no', 0)
                    ->where('meals.deleted_at', null)
                    ->select('meals.*', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    ->get();
                    /*->orderBy('meals.created_at', 'DESC')*/
                    /*->paginate(12, ['*'], 'product');*/
            }
            public static function getAllMealsAndMealTypesListView(){ //softdeletd not included / Menu List
                return DB::table('meals')
                    ->leftJoin('meals_mealtypes', 'meals.id', 'meals_mealtypes.meal_id')  /*many to many*/
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meal_images.position_no', 0)
                    ->where('meals.deleted_at', null)
                    ->select('meals.*', 'meals_mealtypes.id as mmt_id', 'meals_mealtypes.meal_id as mmt_meal_id', 'meals_mealtypes.meal_type_id as mmt_mt_id', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    ->get();
                /*->orderBy('meals.created_at', 'DESC')*/
                /*->paginate(12, ['*'], 'product');*/
            }
            /*admin*/
            public static function getMealById($id){ //include softdeletd
                //return Meal::withTrashed()->find($id);
                return DB::table('meals')
                    ->leftJoin('food_types', 'meals.food_type_id', 'food_types.id')
                    ->where('meals.id', $id)
                    ->select('meals.*', 'food_types.name as food_type_name')
                    ->first();
            }
            /*food-type.blade*/
            public static function getMealByFoodTypeId($id){ //exclude softdeletd  menu-details
                return DB::table('meals')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meals.food_type_id', $id)
                    ->where('meal_images.position_no', 0)
                    ->where('meals.deleted_at', null)
                    ->select('meals.*', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    /*->orderBy('meals.created_at', 'DESC')*/
                    ->paginate(12, ['*'], 'product');
            }
            //CartController-addCart
            public static function getMealByIdFrontend($id){ //exclude softdeletd  menu-details
                return DB::table('meals')
                    ->leftJoin('food_types', 'meals.food_type_id', 'food_types.id')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meals.id', $id)
                    ->where('meals.deleted_at', null)
                    ->where('meal_images.position_no', 0)
                    ->select('meals.*', 'food_types.name as food_type_name', 'meal_images.path as image_path')
                    ->first();
            }
            /*menu details*/
            public static function getTop3PopularMenu(){ //softdeletd not included, top 3 only, with tag_popular_menu
                return DB::table('meals')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meals.deleted_at', null)
                    ->where('meal_images.position_no', 0)
                    ->where('meals.tag_popular_menu', 1)
                    ->select('meals.*', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    ->take(3)
                    ->get();
            }
            /*footer*/
            public static function getGalleryFooterImages(){ //softdeletd not included, top 6 only, with tag_our_gallery_footer tag
                return DB::table('meals')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meals.deleted_at', null)
                    ->where('meal_images.position_no', 0)
                    ->where('meals.tag_our_gallery_footer', 1)
                    ->select('meals.*', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    /*->orderBy('created_at', 'DESC')*/
                    ->take(6)
                    ->get();
            }
            /*footer*/
            public static function getLatestMenuFooterImages(){ //softdeletd not included, top 3 only, with tag_latest_menu_footer tag
                return DB::table('meals')
                    ->leftJoin('meal_images', 'meals.id', 'meal_images.meal_id')
                    ->where('meals.deleted_at', null)
                    ->where('meal_images.position_no', 0)
                    ->where('meals.tag_latest_menu_footer', 1)
                    ->select('meals.*', 'meal_images.path as image_path')
                    ->orderBy(DB::raw('RAND()'))
                    /*->orderBy('created_at', 'DESC')*/
                    ->take(3)
                    ->get();
            }

    public static function getPayments(){ //PaymentController backend
        return DB::table('order_payments')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
            public static function getPaymentsByStatusCode($status_code){ //PaymentController backend
                return DB::table('order_payments')
                    ->where('status_code', $status_code)
                    ->orderBy('created_at', 'DESC')
                    ->get();
            }
            public static function getUserPurchasedByUserId($used_id){ //home.blade frontend
                return DB::table('order_payments')
                    ->where('user_id', $used_id)
                    ->orderBy('created_at', 'DESC')
                    ->get();
                    //->paginate(10, ['*'], 'product');
            }
            public static function getUserPurchasedByPaymentId($payment_id){ //payment-order-details.blade frontend
                return DB::table('order_payments')
                    ->where('id', $payment_id)
                    ->first();
            }

            public static function getTotalRevenueAmount(){ //AdminController, home - backend.
                //Total amount from total_amount
                return DB::table('order_payments')
                    ->whereIn('payment_status', ['COMPLETED', 'succeeded']) //paypal snd stripe status
                    ->sum('total_amount');
            }
            public static function getTotalNumberOfOrdersByPayment(){ //AdminController, home - backend.
                //Total number from total_amount
                return DB::table('order_payments')
                    ->whereIn('payment_status', ['COMPLETED', 'succeeded']) //paypal snd stripe status
                    ->count();
            }
            public static function getTotalRevenueAmountPaypal(){ //AdminController, home - backend.
                //Total amount from total_amount
                return DB::table('order_payments')
                    ->where('payment_status', 'COMPLETED') //paypal status
                    ->where('payment_type', 'paypal')
                    ->sum('total_amount');
            }
            public static function getTotalNumberOfOrdersPaymentPaypal(){ //AdminController, home - backend.
                //Total number from total_amount
                return DB::table('order_payments')
                    ->where('payment_status', 'COMPLETED') //paypal status
                    ->where('payment_type', 'paypal')
                    ->count();
            }
            public static function getTotalRevenueAmountStripe(){ //AdminController, home - backend.
                //Total amount from total_amount
                return DB::table('order_payments')
                    ->where('payment_status', 'succeeded') //stripe status
                    ->where('payment_type', 'stripe')
                    ->sum('total_amount');
            }
            public static function getTotalNumberOfOrdersByPaymentStripe(){ //AdminController, home - backend.
                //Total number from total_amount
                return DB::table('order_payments')
                    ->where('payment_status', 'succeeded') //stripe status
                    ->where('payment_type', 'stripe')
                    ->count();
            }


    /*public static function getOrders(){ //PaymentController backend
        return DB::table('order_details')
            ->orderBy('created_at', 'DESC')
            ->get();
    }*/
            public static function getOrdersByPaymentStatusCode($status_code){ //PaymentController backend
                return DB::table('order_details')
                    ->leftJoin('order_payments', 'order_details.id', 'order_payments.order_payment_id')
                    ->where('order_payments.status_code', $status_code)
                    ->orderBy('order_details.created_at', 'DESC')
                    ->get();
            }
            public static function getUserOrderDetailsWithImageByPaymentId($payment_id){ //payment-order-details.blade frontend
                return DB::table('order_details')
                    ->leftJoin('meal_images', 'order_details.meal_id', 'meal_images.meal_id')
                    ->where('order_payment_id', $payment_id)
                    ->where('meal_images.position_no', 0)
                    ->select('order_details.*', 'meal_images.path as image_path')
                    ->orderBy('meal_name', 'ASC')
                    ->get();
            }
            public static function getPaymentOrderUserAddressDetailsByPaymentId($payment_id){ //index.blade, OrderController.blade backend
                return DB::table('order_details')
                    ->leftJoin('meal_images', 'order_details.meal_id', 'meal_images.meal_id')
                    ->leftJoin('order_payments', 'order_details.order_payment_id', 'order_payments.id')
                    ->leftJoin('users', 'order_payments.user_id', 'users.id')
                    ->leftJoin('order_shippings', 'users.id', 'order_shippings.user_id')
                    ->leftJoin('order_billings', 'users.id', 'order_billings.user_id')
                    ->where('order_details.order_payment_id', $payment_id)
                    ->where('meal_images.position_no', 0)
                    ->select('order_details.*',
                        'meal_images.path as image_path',
                        'order_payments.payment_type as pay_payment_type',
                        'order_payments.payment_id as pay_payment_id',
                        'order_payments.order_id as pay_order_id',
                        'order_payments.payment_status as pay_payment_status',
                        'order_payments.shipping_charge as pay_shipping_charge',
                        'order_payments.vat_amount as pay_vat_amount',
                        'order_payments.subtotal_amount as pay_subtotal_amount',
                        'order_payments.total_amount as pay_total_amount',
                        'order_payments.status_code as pay_status_code',
                        'order_payments.tracking_code as pay_tracking_code',
                        'order_payments.payment_date as pay_payment_date',
                        'users.name as user_name',
                        'users.email as user_email',
                        'users.phone_no as user_phone_no',
                        'users.name as user_name',
                        'users.name as user_name',
                        'order_shippings.name as s_name',
                        'order_shippings.company_name as s_company_name',
                        'order_shippings.email as s_email',
                        'order_shippings.phone as s_phone',
                        'order_shippings.street_address as s_street_address',
                        'order_shippings.apartment_unit as s_apartment_unit',
                        'order_shippings.town_city as s_town_city',
                        'order_shippings.state_country as s_state_country',
                        'order_shippings.post_zipcode as s_post_zipcode',
                        'order_billings.name as b_name',
                        'order_billings.company_name as b_company_name',
                        'order_billings.email as b_email',
                        'order_billings.phone as b_phone',
                        'order_billings.street_address as b_street_address',
                        'order_billings.apartment_unit as b_apartment_unit',
                        'order_billings.town_city as b_town_city',
                        'order_billings.state_country as b_state_country',
                        'order_billings.post_zipcode as b_post_zipcode')
                    ->orderBy('order_payments.created_at', 'DESC')
                    ->get();
            }

    public static function getOrderBillingByUserId($user_id){ //CheckoutController.php
        return OrderBilling::where('user_id', $user_id)->first();
    }

    public static function getOrderShippingByUserId($user_id){ //CheckoutController.php
        return OrderShipping::where('user_id', $user_id)->first();
    }

    public static function getUsers(){ //with trashed, UserController
        return User::withTrashed()
            ->orderBy('name', 'ASC')
            ->get();
    }
            public static function getTotalRegisteredUser(){ //AdminController, home.blade admin
                return User::where('deleted_at', null)->count();
            }

    public static function getUserMessages(){ //UserController
        return ContactUs::orderBy('created_at', 'DESC')->get();
    }
            public static function getTotalMessage(){ //AdminController, home.blade admin
                return ContactUs::all()->count();
            }

    public static function getUserBillingAddressByUserId($user_id){ //HomeController
        return OrderBilling::where('user_id', $user_id)->first();
    }

    public static function getUserShippingAddressByUserId($user_id){ //HomeController
        return OrderShipping::where('user_id', $user_id)->first();
    }


    public static function generatePaymentTrackingNumber() {
        //$number = mt_rand(1000000000, 9999999999); // better than rand()
        $unique_id = uniqid();

        // call the same function if the barcode exists already
        if (self::paymentTrackingNumberExists($unique_id)) {
            return self::generatePaymentTrackingNumber();
        }

        // otherwise, it's valid and can be used
        return $unique_id;
    }

    public static function paymentTrackingNumberExists($unique_id) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        //return User::whereBarcodeNumber($number)->exists();
        return OrderPayment::where('tracking_code', $unique_id)->exists();
    }
}
