<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function editDetails(/*$id*/)
    {
        $site_setting = SiteSetting::find(1); //1 record only has exist
        return view('backend.site_setting.edit-details',compact('site_setting'));
    }
    public function editImages(/*$id*/)
    {
        $site_setting = SiteSetting::find(1); //1 record only has exist
        return view('backend.site_setting.edit-images',compact('site_setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateDetails(Request $request/*, $id*/)
    {
        $site_setting = SiteSetting::find(1);

        $site_setting->main_title = $request->main_title;
        $site_setting->about_title = $request->about_title;
        $site_setting->about_subtitle = $request->about_subtitle;
        $site_setting->about_content = $request->about_content;

        $site_setting->open_time_saturday = $request->open_time_saturday;
        $site_setting->open_time_sunday = $request->open_time_sunday;
        $site_setting->open_time_monday = $request->open_time_monday;
        $site_setting->open_time_tuesday = $request->open_time_tuesday;
        $site_setting->open_time_wednesday = $request->open_time_wednesday;
        $site_setting->open_time_thursday = $request->open_time_thursday;
        $site_setting->open_time_friday = $request->open_time_friday;

        $site_setting->address = $request->address;
        $site_setting->phone = $request->phone;
        $site_setting->email = $request->email;
        $site_setting->facebook = $request->facebook;
        /*$site_setting->twitter = $request->twitter;*/
        $site_setting->instagram = $request->instagram;
        $site_setting->youtube = $request->youtube;

        $site_setting->checkout_shipping_charge = $request->checkout_shipping_charge;
        $site_setting->checkout_vat = $request->checkout_vat;
        $withUpdate = $site_setting->isDirty();
        $site_setting->save();

        if ($withUpdate) {
            $notification = array(
                'message'=>'Successfully updated.',
                'alert-type'=>'success'
            );
        } else {
            $notification = array(
                'message'=>'No changes have been made.',
                'alert-type'=>'info'
            );
        }

        return Redirect()->back()->with($notification);
    }
    public function updateImages(Request $request){

        $site_setting = SiteSetting::find(1);
        //updateImageInDbLoc(REQUEST, OLD PATH LOGO, NEW PATH LOGO, COLUMN NAME/FILE NAME, StorageFolderName)

        $resMainLogo = $this->updateImageInDbLoc($request, $site_setting,
            'logo_path_old', 'logo_path_new', 'logo_path', 'home');
        $resMainTopCenter = $this->updateImageInDbLoc($request, $site_setting,
            'main_head_topv_image_path_old', 'main_head_topv_image_path_new', 'main_head_topv_image_path', 'home');
        $resMainTopLeft = $this->updateImageInDbLoc($request, $site_setting,
            'main_head_top_left_image_path_old', 'main_head_top_left_image_path_new', 'main_head_top_left_image_path', 'home');
        $resMainMiddle = $this->updateImageInDbLoc($request, $site_setting,
            'main_middle_image_path_old', 'main_middle_image_path_new', 'main_middle_image_path', 'home');
        $resMainTopRight = $this->updateImageInDbLoc($request, $site_setting,
            'main_head_bottom_right_image_path', 'main_head_bottom_right_image_path_new', 'main_head_bottom_right_image_path', 'home');
        $resMainBottomLeft = $this->updateImageInDbLoc($request, $site_setting,
            'ychose_below_left_image_path_old', 'ychose_below_left_image_path_new', 'ychose_below_left_image_path', 'home');
        $resMainBottomRight = $this->updateImageInDbLoc($request, $site_setting,
            'ychose_below_right_image_path_old', 'ychose_below_right_image_path_new', 'ychose_below_right_image_path', 'home');

        $resAboutTop = $this->updateImageInDbLoc($request, $site_setting,
            'about_head_top_image_path_old', 'about_head_top_image_path_new', 'about_head_top_image_path', 'about');

        $resMenuTopGrid = $this->updateImageInDbLoc($request, $site_setting,
            'menu_head_top_grid_image_path_old', 'menu_head_top_grid_image_path_new', 'menu_head_top_grid_image_path', 'menu');
        $resMenuTopList = $this->updateImageInDbLoc($request, $site_setting,
            'menu_head_top_list_image_path_old', 'menu_head_top_list_image_path_new', 'menu_head_top_list_image_path', 'menu');
        $resMenuTopDetails = $this->updateImageInDbLoc($request, $site_setting,
            'menu_head_top_details_image_path_old', 'menu_head_top_details_image_path_new', 'menu_head_top_details_image_path', 'menu');

        $resGalleryTop = $this->updateImageInDbLoc($request, $site_setting,
            'gallery_head_top_image_path_old', 'gallery_head_top_image_path_new', 'gallery_head_top_image_path', 'gallery');

        $resPagesServiceTop = $this->updateImageInDbLoc($request, $site_setting,
            'pages_service_head_top_image_path_old', 'pages_service_head_top_image_path_new', 'pages_service_head_top_image_path', 'pages');
        $resPagesCartTop = $this->updateImageInDbLoc($request, $site_setting,
            'pages_cart_head_top_image_path_old', 'pages_cart_head_top_image_path_new', 'pages_cart_head_top_image_path', 'pages');
        $resPagesCheckoutTop = $this->updateImageInDbLoc($request, $site_setting,
            'pages_checkout_head_top_image_path_old', 'pages_checkout_head_top_image_path_new', 'pages_checkout_head_top_image_path', 'pages');

        $resContactTop = $this->updateImageInDbLoc($request, $site_setting,
            'contact_head_top_image_path_old', 'contact_head_top_image_path_new', 'contact_head_top_image_path', 'contact');
        $resContactMiddle = $this->updateImageInDbLoc($request, $site_setting,
            'contact_middle_left_image_path_old', 'contact_middle_left_image_path_new', 'contact_middle_left_image_path', 'contact');


        if ($resMainLogo || $resMainTopCenter || $resMainTopLeft || $resMainMiddle || $resMainTopRight || $resMainBottomLeft ||
            $resMainBottomRight || $resAboutTop || $resMenuTopGrid || $resMenuTopList || $resMenuTopDetails || $resGalleryTop ||
            $resPagesServiceTop || $resPagesCartTop || $resPagesCheckoutTop || $resContactTop || $resContactMiddle){

            $notification = array(
                'message' => 'Successfully updated.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'No changes have been made..',
                'alert-type' => 'info'
            );
        }

        return Redirect()->back()->with($notification);
    }
    public function updateImageInDbLoc($request, $site_setting, $old, $new, $name, $folder){
        $imageOld = $request->$old; //++++++  input name
        $imageNew = $request->file($new); //++++++  input name
        //$file=Input::file('image');
        //$file->move(public_path().'/'.$mytime.'.'.$file->getClientOriginalExtension());
        if ($imageNew){
            if ($imageOld != ""){
                $path = public_path($imageOld);
                if (File::exists($path)) {
                    unlink($path);}}

            $image_name = date('dmYHmsi').hexdec(uniqid());//$name;//date('dmYHmsi').hexdec(uniqid()); //++++++
            $ext = strtolower($imageNew->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'storage/images/site_setting/'.$folder.'/';
            $image_url = $upload_path.$image_full_name;

            //$imageNew->move($upload_path,$image_full_name); //use move since direct saving to public folder
            $imageNew->move(public_path().'/'.$upload_path,$image_full_name); //use move since direct saving to public folder
            $site_setting->$name = $image_url; //++++++
            //$withUpdate = $site_setting->isDirty();
            $site_setting->save();
            return true;
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteOldImageById($id, $image_path_name){
        //delete image from folder
        $sitesetting = SiteSetting::find($id);
        $image_path = $sitesetting->$image_path_name;
        //image
        if ( $image_path != "") { //check if with url in DB
            $path = public_path($image_path);
            if(File::exists($path)) {
                unlink($path);
            }
        }

        //delete to DB
        SiteSetting::find($id)->delete();
    }
}
