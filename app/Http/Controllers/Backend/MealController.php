<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMealRequest;
use App\Meal;
use App\MealImage;
use App\MealsMealtype;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\FoodType;
use App\MealType;
use App\Http\Requests\MealRequest;
use Image; //for inmage intervention
use Symfony\Component\Console\Input\Input;

class MealController extends Controller
{
    use TraitMyFunctions;
/* $table->id();
            $table->integer('food_type_id');
            $table->integer('meal_type_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('regular_price');
            $table->string('discounted_price')->nullable();
            $table->string('delivery_cost')->nullable();
            $table->string('delivery_time')->nullable();
            $table->integer('ratings')->default(0);
            $table->integer('tag_popular_menu')->default(0);
            $table->integer('tag_special_offer')->default(0);
            $table->integer('tag_new')->default(0);
            $table->integer('tag_hot')->default(0);
            $table->integer('tag_latest_menu_footer')->default(0);
            $table->integer('tag_our_gallery_footer')->default(0);
            $table->timestamps();
            $table->softDeletes();*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$meal_types = $this->getAllMealTypes();
        $food_types = $this->getAllFoodTypes();
        $meal_images = $this->getAllMealImages();
        $meals_mealtypes = $this->getAllMealsMealtypes();*/

        $meals = $this->getAllMeals();
        /*dd($meals);*/
        return view('backend.meal.index', compact('meals'/*,'meal_types', 'food_types', 'meal_images', 'meals_mealtypes'*/));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $food_types = $this->getAllFoodTypes();
        $meal_types = $this->getAllMealTypes();
        /*$site_setting =  $this->getSiteSettings(); 'site_setting', */
        return view('backend.meal.create', compact('food_types', 'meal_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealRequest $request)
    { //dd($request);
        $inputs = $request->except('_method', '_token');
        //dd($inputs);
        foreach ($inputs as $key => $value) { //has always 1 result
            foreach ($value as $row => $item) { /*dd($item['meal_type_id']);*/
                if (isset($item['inner-group'])) { //check if with attached image, at least 1 is required

                    /*saving details*/
                        if (isset($item['tag_popular_menu'])) {
                            $tag_popular_menu = 1;
                        } else {
                            $tag_popular_menu = 0;
                        }

                        if (isset($item['tag_special_offer'])) {
                            $tag_special_offer = 1;
                        } else {
                            $tag_special_offer = 0;
                        }

                        if (isset($item['tag_new'])) {
                            $tag_new = 1;
                        } else {
                            $tag_new = 0;
                        }

                        if (isset($item['tag_hot'])) {
                            $tag_hot = 1;
                        } else {
                            $tag_hot = 0;
                        }

                        if (isset($item['tag_latest_menu_footer'])) {
                            $tag_latest_menu_footer = 1;
                        } else {
                            $tag_latest_menu_footer = 0;
                        }

                        if (isset($item['tag_our_gallery_footer'])) {
                            $tag_our_gallery_footer = 1;
                        } else {
                            $tag_our_gallery_footer = 0;
                        }

                        $data = array(
                            'food_type_id' => $item['food_type_id'],
                            'name' => $item['name'],
                            'description' => $item['description'],
                            'regular_price' => $item['regular_price'],
                            'discounted_price' => $item['discounted_price'],
                            'delivery_cost' => $item['delivery_cost'],
                            'delivery_time' => $item['delivery_time'],

                            'tag_popular_menu' => $tag_popular_menu,
                            'tag_special_offer' => $tag_special_offer,
                            'tag_new' => $tag_new,
                            'tag_hot' => $tag_hot,
                            'tag_latest_menu_footer' => $tag_latest_menu_footer,
                            'tag_our_gallery_footer' => $tag_our_gallery_footer,

                            'created_at' => Carbon::now()
                        );

                        $meal_id = Meal::insertGetId($data);
                    /*---/saving details---*/

                    /*---saving meal type---*/
                        foreach ($item['meal_type_id'] as $row) {
                            $data = array(
                                'meal_id' => $meal_id,
                                'meal_type_id' => $row,
                                'created_at' => Carbon::now()
                            );
                            MealsMealtype::insert($data);
                        }
                    /*---saving meal type---*/

                    /*---saving images path---*/
                        $images = $item['inner-group'];
                        $vImagePath = "";

                        foreach ($images as $count => $info) {
                            $image_path = $info['images_path']; //from input
                            if ($image_path) {
                                //generate Unique hexdec code, current date and get image extension
                                $image_path_name = date('dmYHmsi') . hexdec(uniqid()) . '.' . $image_path->getClientOriginalExtension();
                                //use the image intervention, resize and set saving folder in public
                                //Image::make($image_path)->resize(300,300)->save('storage/images/meal/'.$image_path_name);
                                //Image::make($image_path)->save('storage/images/meal/' . $image_path_name);
                                $upload_path = 'storage/images/meal/';
                                $image_path->move(public_path().'/'.$upload_path, $image_path_name); //use move since direct saving to public folder

                                //prepare for saving to DB
                                //$vImagePath = 'storage/images/meal/' . $image_path_name;
                                $vImagePath = $upload_path . $image_path_name;
                            }

                            $data = array(
                                'meal_id' => $meal_id, //from details after saving
                                'path' => $vImagePath,
                                'name' => $info['name_image'],
                                'description' => $info['name_description'],
                                'position_no' => $count,
                                'created_at' => Carbon::now()
                            );
                            MealImage::insert($data);
                        }
                    /*---/saving images path---*/
                } else {
                    $notification = array(
                        'message' => 'At least 1 image is required.',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            }
        }
        $notification = array(
            'message' => 'Successfully saved!',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.meal.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal = $this->getMealById($id);
        //images
        $allmealimagesbymealid = $this->getAllMealImagesByMealId($id);
        //selected meal types
        $allmealsmealtypesbymealid = $this->getAllMealsMealtypesByMealId($id);

        return view('backend.meal.view', compact('meal','allmealimagesbymealid', 'allmealsmealtypesbymealid'));

        /*return response()->json($meal);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = $this->getMealById($id);
        //image
        $allmealimagesbymealid = $this->getAllMealImagesByMealId($id);
        //selected meal types
        $allmealsmealtypesbymealid = $this->getAllMealsMealtypesByMealId($id);
            //put in array then pass to multiplke select to match
            $meal_mealtypes = array();
            foreach ($allmealsmealtypesbymealid as $row){
                $meal_mealtypes[] = $row->meal_type_id;
            }

        //library
        $food_types = $this->getAllFoodTypes();
        $meal_types = $this->getAllMealTypes();

        return view('backend.meal.edit', compact('meal','allmealimagesbymealid', 'meal_mealtypes', 'food_types', 'meal_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMealRequest $request/*, $id*/)
    {
        //dd($request);
        $withchanges = false;
        $inputs = $request->except('_method', '_token');
        //dd($inputs);
        foreach ($inputs["outer-group"] as $key => $item) { //has always 1 result
            //dd($item);
            //foreach ($value as $row => $item) {
                //dd(count($item['inner-group']));
                if (count($item['inner-group']) > 1) { //check if with attached image, at least 1 is required, if 1 only-default, therefore no attached image
                    $meal_id = $item['mealid'];
                    $meal = Meal::withTrashed()->find($meal_id);
                    //dd($mealid);

                    /*saving details*/
                        if (isset($item['tag_popular_menu'])) {
                            $tag_popular_menu = 1;
                        } else {
                            $tag_popular_menu = 0;
                        }

                        if (isset($item['tag_special_offer'])) {
                            $tag_special_offer = 1;
                        } else {
                            $tag_special_offer = 0;
                        }

                        if (isset($item['tag_new'])) {
                            $tag_new = 1;
                        } else {
                            $tag_new = 0;
                        }

                        if (isset($item['tag_hot'])) {
                            $tag_hot = 1;
                        } else {
                            $tag_hot = 0;
                        }

                        if (isset($item['tag_latest_menu_footer'])) {
                            $tag_latest_menu_footer = 1;
                        } else {
                            $tag_latest_menu_footer = 0;
                        }

                        if (isset($item['tag_our_gallery_footer'])) {
                            $tag_our_gallery_footer = 1;
                        } else {
                            $tag_our_gallery_footer = 0;
                        }

                        $meal->food_type_id = $item['food_type_id'];
                        $meal->name = $item['name'];
                        $meal->description = $item['description'];
                        $meal->regular_price = $item['regular_price'];
                        $meal->discounted_price = $item['discounted_price'];
                        $meal->delivery_cost = $item['delivery_cost'];
                        $meal->delivery_time = $item['delivery_time'];
                        $meal->tag_popular_menu = $tag_popular_menu;
                        $meal->tag_special_offer = $tag_special_offer;
                        $meal->tag_new = $tag_new;
                        $meal->tag_hot = $tag_hot;
                        $meal->tag_latest_menu_footer = $tag_latest_menu_footer;
                        $meal->tag_our_gallery_footer = $tag_our_gallery_footer;
                        $withUpdate = $meal->isDirty();
                        $meal->save();

                        if ($withUpdate) {
                            $withchanges = true;
                        }
                    /*---/saving details---*/

                    /*---saving meal type---*/
                        $oldType = serialize($item['meal_type_id_old']);
                        $newType = serialize($item['meal_type_id']);
                        if ($oldType != $newType) { //if old and new array is not equal
                            //force delete all first, to clear all the relations
                            MealsMealtype::withTrashed()->where('meal_id', $meal_id)->forceDelete();
                            //then save again
                            foreach ($item['meal_type_id'] as $row) {
                                $data = array(
                                    'meal_id' => $meal_id,
                                    'meal_type_id' => $row,
                                    'created_at' => Carbon::now()
                                );
                                MealsMealtype::insert($data);
                            }
                            $withchanges = true;
                        }
                    /*---saving meal type---*/

                    /*---saving, update, delete images path---*/
                            /*---get image ids for this meal prior deletion---*/
                                $originalImageIds = MealImage::withTrashed()->where('meal_id', $meal_id)->get();
                            /*---get image ids for this meal prior deletion---*/

                        $images = $item['inner-group'];
                        $vImagePath = "";
                        /*{{ dd($images); }}*/
                        foreach ($images as $count => $info) {
                            if ($info['image_id'] > 0) { //except the default image field (0) skip - UPDATE
                                /*{{ dd($info); }}*/
                                /*{{ dd($info['image_id']); }}*/
                                /*{{ dd($info['name_image']); }}*/
                                /*Update*/
                                $image = MealImage::withTrashed()->find($info['image_id']);
                                $image->name = $info['name_image'];
                                $image->description = $info['name_description'];

                                    /*for $image->path */
                                    if (isset($info['images_path'])) { //if there is new upload
                                        /*{{ dd($info); }}*/
                                        $image_path = $info['images_path']; //from input, new upload
                                        if ($image_path) {
                                            //generate Unique hexdec code, current date and get image extension
                                            $image_path_name = date('dmYHmsi') . hexdec(uniqid()) . '.' . $image_path->getClientOriginalExtension();
                                            //use the image intervention, resize and set saving folder in public
                                            //Image::make($image_path)->resize(300,300)->save('storage/images/meal/'.$image_path_name);
                                            //Image::make($image_path)->save('storage/images/meal/' . $image_path_name);
                                            $upload_path = 'storage/images/meal/';
                                            $image_path->move(public_path().'/'.$upload_path, $image_path_name); //use move since direct saving to public folder

                                            //prepare for saving to DB
                                            //$vImagePath = 'storage/images/meal/' . $image_path_name;
                                            $vImagePath = $upload_path . $image_path_name;
                                            $image->path = $vImagePath; //save

                                                /*unlink,delete image to folder*/
                                                $image_path_old = $info['images_path_old'];
                                                //image
                                                if ($image_path_old != "") { //check if with url in DB
                                                    $path = public_path($image_path_old);
                                                    if (File::exists($path)) {
                                                        unlink($path);
                                                    }
                                                }

                                        }
                                    }
                                $withUpdate = $image->isDirty();
                                $image->save();
                                if ($withUpdate) {
                                    $withchanges = true;
                                }

                            } elseif ($info['image_id'] == null) { //except the new added image (null) - SAVE NEW
                                //save new image
                                $image_path = $info['images_path']; //from input
                                if ($image_path) {
                                    //generate Unique hexdec code, current date and get image extension
                                    $image_path_name = date('dmYHmsi') . hexdec(uniqid()) . '.' . $image_path->getClientOriginalExtension();
                                    //use the image intervention, resize and set saving folder in public
                                    //Image::make($image_path)->resize(300,300)->save('storage/images/meal/'.$image_path_name);
                                    //Image::make($image_path)->save('storage/images/meal/' . $image_path_name);
                                    $upload_path = 'storage/images/meal/';
                                    $image_path->move(public_path().'/'.$upload_path, $image_path_name); //use move since direct saving to public folder

                                    //prepare for saving to DB
                                    //$vImagePath = 'storage/images/meal/' . $image_path_name;
                                    $vImagePath = $upload_path . $image_path_name;
                                }

                                $data = array(
                                    'meal_id' => $meal_id, //from details after saving
                                    'path' => $vImagePath,
                                    'name' => $info['name_image'],
                                    'description' => $info['name_description'],
                                    'position_no' => $count, //NOT YET PERFECT----------------- set if 0 not exist or adjust to product details
                                    'created_at' => Carbon::now()
                                );
                                MealImage::insert($data);
                                $withchanges = true;
                            }
                        }

                        /*--delete image SCRIPT MUST BE HERE(outside the loop) SO THAT ALL IMAGES HAVE BEEN SAVED--*/
                            //convert to proper array for matching
                            foreach ($originalImageIds as $info){
                                $orig_img[] = $info->id;
                            }
                            //convert to proper array for matching
                            foreach ($images as $count => $item){
                                $current_img[] = $item['image_id'];
                            }

                            //compare original image ids vs the current from form input file
                            foreach ($orig_img as $origId){
                                if (!in_array($origId, $current_img)){ //check if old id is exist in the form input file, if not, delete
                                    $this->deleteImageByIdUpdatedOtherToZero($origId, $meal_id); //delete image if not exist
                                    $withchanges = true;
                                }
                            }
                        /*--/delete image--*/
                    /*---/saving, update, delete images path---*/
                } else {
                    $notification = array(
                        'message' => 'All images have been deleted, please provide at least 1..',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            //}
        }

        if ($withchanges){
            $notification = array(
                'message' => 'Successfully updated!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'No changes have been made.',
                'alert-type' => 'warning'
            );
        }

        return Redirect()->route('admin.meal.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete image from folder
        $meal = Meal::withTrashed()->find($id);
        $allmealimagesbymealid = $this->getAllMealImagesByMealId($id);
        //$allmealsmealtypesbymealid = $this->getAllMealsMealtypesByMealId($id);

        //dd($allmealimagesbymealid);

        //unlink-delete image from folder
        foreach ($allmealimagesbymealid as $row) {
            //dd($row->path);
            $image_path = $row->path;
            //image
            if ($image_path != "") { //check if with url in DB
                $path = public_path($image_path);
                if (File::exists($path)) {
                    unlink($path);
                }
            }
        }

        //delete to DB
        Meal::withTrashed()->where('id', $id)->forceDelete();
        MealImage::withTrashed()->where('meal_id', $id)->forceDelete();
        MealsMealtype::withTrashed()->where('meal_id', $id)->forceDelete();
    }
            public function deleteItem($id){
                $this->destroy($id);
                $notification = array(
                    'message'=>'Product has been permanently deleted.',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }

            public function deleteAllSelected(Request $request)
            {
                /* $ids = $request->ids;
                 DB::table("food_types")
                         ->whereIn('id', explode(",", $ids))->delete();*/
                $ids = explode(",", $request->ids);
                foreach($ids as $row) {
                    $id = trim($row);
                    $this->destroy($id);
                }
                return response()->json(['success' => "Successfully deleted!"]);
            }
    public function deleteImageByIdUpdatedOtherToZero($imageId, $mealId){
        //delete image from folder
        $image = MealImage::withTrashed()->find($imageId);
        $image_path = $image['path'];
        $image_position = $image['position_no'];

        if ( $image_path != "") { //check if with url in DB
            $path = public_path($image_path);
            if(File::exists($path)) {
                unlink($path);
            }
        }

        //delete to DB
        MealImage::withTrashed()->where('id', $imageId)->forceDelete();

        //if position_no is 0, then prior the deletion, update the other image to 0.
        if ($image_position == 0){
            $image = MealImage::withTrashed()
                        ->where('meal_id', $mealId)
                        ->orderBy('position_no', 'ASC')
                        ->first();
            /*dd($image_position);*/
            $image->position_no = 0;
            $image->save();
        }
    }

    public function enableSoftDelete($id){
        Meal::find($id)->delete();
        MealImage::where('meal_id', $id)->delete();
        MealsMealtype::where('meal_id', $id)->delete();
        $notification=array(
            'message'=>'Product has been deleted temporarily.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function disableSoftDelete($id){
        Meal::withTrashed()->where('id', $id)->restore();
        MealImage::withTrashed()->where('meal_id', $id)->restore();
        MealsMealtype::withTrashed()->where('meal_id', $id)->restore();
        $notification=array(
            'message'=>'Product has been restored.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
