<?php

namespace App\Http\Controllers\Backend;

use App\FoodType;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Image; //for inmage intervention
use Symfony\Component\Console\Input\Input;

class FoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrieved all
        $food_types = FoodType::withTrashed()
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return view('backend.food_type.index', compact('food_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.food_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) /*FoodTypeRequest NOT WORKING HERE DUE TO add row*/
    {

        /*https://laravel.io/forum/04-30-2014-saving-dynamically-created-form-field-array-to-db-laravel-way
        $deps  = Input::only('name','description','image_path','icon_path','created_at');*/

        $inputs = $request->except('_method', '_token');
        foreach ($inputs as $key => $value) { //has always 1 result
            foreach ($value as $row => $item) {

                //image
                $image_path = $item['image_path'];
                $vImagePath = "";
                if ($image_path){//if all 3 images are about to upload
                    //generate Unique hexdec code, current date and get image extension
                    $image_path_name = date('dmYHmsi').hexdec(uniqid()).'.'.$image_path->getClientOriginalExtension();
                    //use the image intervention, resize and set saving folder in public
                    //Image::make($image_path)->resize(300,300)->save('storage/images/food_type/'.$image_path_name);
                    //Image::make($image_path)->save('storage/images/food_type/'.$image_path_name);
                    $upload_path = 'storage/images/food_type/';
                    $image_path->move(public_path().'/'.$upload_path, $image_path_name); //use move since direct saving to public folder

                    //prepare for saving to DB
                    //$vImagePath = 'storage/images/food_type/'.$image_path_name;
                    $vImagePath = $upload_path.$image_path_name;
                }

                //icon
                $icon_path = $item['icon_path'];
                $vIconPath = "";
                if ($icon_path){//if all 3 images are about to upload
                    //generate Unique hexdec code, current date and get image extension
                    $icon_path_name = date('dmYHmsi').hexdec(uniqid()).'.'.$icon_path->getClientOriginalExtension();
                        //use the image intervention, resize and set saving folder in public
                        //Image::make($icon_path)->resize(300,300)->save('storage/images/food_type/'.$icon_path_name);
                    //Just save to folder
                    //Image::make($icon_path)->save('storage/images/food_type/'.$icon_path_name);
                    $upload_path = 'storage/images/food_type/';
                    $icon_path->move(public_path().'/'.$upload_path, $icon_path_name); //use move since direct saving to public folder

                    //prepare for saving to DB
                    //$vIconPath = 'storage/images/food_type/'.$icon_path_name;
                    $vIconPath = $upload_path.$icon_path_name;
                }

                $data[] =[
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'image_path' => $vImagePath,
                    'icon_path' => $vIconPath,
                    'created_at' => Carbon::now()
                ];
            }
        };
        FoodType::insert($data);

        $notification = array(
            'message'=>'Successfully saved!',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.food-type.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food_type = FoodType::withTrashed()->find($id);
        return response()->json($food_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food_type = FoodType::withTrashed()->find($id);
        return view('backend.food_type.edit',compact('food_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodTypeRequest $request/*, $id*/)
    {
        //dd($request);
        //--------------update details-------------
        $food_type = FoodType::withTrashed()->find($request->id);
        $food_type->name = $request->name;
        $food_type->description = $request->description;
        $withUpdate = $food_type->isDirty();
        $food_type->save();
        if ($withUpdate) {
            $resDet = "Details have been changed.";
        } else {
            $resDet = "No changes have been made from the details.";
        }

        //--------upload image and icon-----------
        $resImageMsg = $this->updateImage($request);
        $resIconMsg = $this->updateIcon($request);

        $notification=array(
            'message' => $resDet.'; '.$resImageMsg.'; '.$resIconMsg,
            'alert-type' => 'info'
        );
        return Redirect()->route('admin.food-type.index')->with($notification);
    }
            public function updateImage($request){
                //------------------------ UPDATE IMAGE ---------------------------//
                $imageOld = $request->image_path_old;
                $imageNew = $request->file('image_path_new');
                $food_type = FoodType::find($request->id);
                $resMsg = "No changes have been made for the image.";

                if ($imageNew){ //check if with image attached
                    if ($imageOld != ""){//check if has old image
                        $path = public_path($imageOld);
                        if (File::exists($path)) {//delete old logo from storage folder if there is existing in DB
                            unlink($path);
                        }
                    }

                    $image_name = date('dmYHmsi').hexdec(uniqid());//Str::random(10);
                    $ext = strtolower($imageNew->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'storage/images/food_type/';   //set path
                    $image_url = $upload_path.$image_full_name;
                    //$imageNew->move($upload_path,$image_full_name);
                    $imageNew->move(public_path().'/'.$upload_path,$image_full_name); //use move since direct saving to public folder
                    $food_type->image_path = $image_url;
                    $withUpdate = $food_type->isDirty(); //check if with update in  general, but you can set specific attribute ex. isDirty('brand_name')
                    $food_type->save();

                    if ($withUpdate) {
                        $resMsg = "Image has been updated.";
                    } else {
                        $resMsg = "No changes have been made for the image.";
                    }

                }
                return $resMsg;
                //------------------------ /UPDATE IMAGE ---------------------------//
            }

            public function updateIcon($request){
                //------------------------ UPDATE ICON ---------------------------//
                $iconOld = $request->icon_path_old;
                $iconNew = $request->file('icon_path_new');
                $food_type = FoodType::find($request->id);
                $resMsg = "No changes have been made for the icon.";

                if ($iconNew){ //check if with image attached
                    if ($iconOld != ""){//check if has old image
                        $path = public_path($iconOld);
                        if (File::exists($path)) {//delete old logo from storage folder if there is existing in DB
                            unlink($path);
                        }
                    }

                    $image_name = date('dmYHmsi').hexdec(uniqid());//Str::random(10);
                    $ext = strtolower($iconNew->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'storage/images/food_type/';   //set path
                    $icon_url = $upload_path.$image_full_name;
                    //$iconNew->move($upload_path,$image_full_name);
                    $iconNew->move(public_path().'/'.$upload_path,$image_full_name); //use move since direct saving to public folder
                    $food_type->icon_path = $icon_url;
                    $withUpdate = $food_type->isDirty(); //check if with update in  general, but you can set specific attribute ex. isDirty('brand_name')
                    $food_type->save();

                    if ($withUpdate) {
                        $resMsg = "Icon has been updated.";
                    } else {
                        $resMsg = "No changes have been made for the icon.";
                    }

                }
                return $resMsg;
                //------------------------ /UPDATE ICON ---------------------------//
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
        $foodtype = FoodType::withTrashed()->find($id);
        $image_path = $foodtype->image_path;
        //image
        if ( $image_path != "") { //check if with url in DB
            $path = public_path($image_path);
            if(File::exists($path)) {
                unlink($path);
            }
        }

        $icon_path = $foodtype->icon_path;
        //icon
        if ( $icon_path != "") { //check if with url in DB
            $path = public_path($icon_path);
            if(File::exists($path)) {
                unlink($path);
            }
        }

        //delete to DB
        FoodType::withTrashed()->where('id', $id)->forceDelete();
    }
            public function deleteItem($id){
                $this->destroy($id);
                $notification = array(
                    'message'=>'Food Type has been permanently deleted.',
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


    public function enableSoftDelete($id){
        FoodType::find($id)->delete(); //automatic soft deleted using this function

        $notification=array(
            'message'=>'Food Type has been deleted temporarily.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function disableSoftDelete($id){
        FoodType::withTrashed()->where('id', $id)->restore();

        $notification=array(
            'message'=>'Food Type has been restored.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

}
