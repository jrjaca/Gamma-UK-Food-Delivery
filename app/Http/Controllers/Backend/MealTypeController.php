<?php

namespace App\Http\Controllers\Backend;

use App\FoodType;
use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\MealTypeRequest;
use App\MealsMealtype;
use App\MealType;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    use TraitMyFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrieved all
        //$meal_types = MealType::orderBy('created_at', 'DESC')->get();
        $meal_types = $this->getAllMealTypesIncludeSoftDeleted();
        return view('backend.meal_type.index', compact('meal_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.meal_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealTypeRequest $request)
    {
        $meal_type = new MealType();
        $meal_type->name = $request->name;
        $meal_type->save();

        $notification = array(
            'message'=>'Successfully saved!',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.meal-type.index')->with($notification);
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
        //--- THRU MODAL --//
        /*$meal_type = MealType::find($id);
        return response()->json($meal_type);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MealTypeRequest $request/*, $id*/)
    {
        $meal_type = MealType::find($request->id);
        $meal_type->name = $request->name;
        $withUpdate = $meal_type->isDirty();
        $meal_type->save();

        if ($withUpdate) {
            $notification = array(
                'message'=>'Successfully updated!',
                'alert-type'=>'success'
            );
        } else {
            $notification = array(
                'message'=>'No changes have been made!',
                'alert-type'=>'info'
            );
        }

        return Redirect()->route('admin.meal-type.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MealType::find($id)->delete();
        $notification = array(
            'message'=>'Successfully deleted.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function enableSoftDelete($id){
        MealType::find($id)->delete();
        MealsMealtype::where('meal_type_id', $id)->delete();
        $notification=array(
            'message'=>'Temporarily deleted..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function disableSoftDelete($id){
        MealType::withTrashed()->where('id', $id)->restore();
        MealsMealtype::withTrashed()->where('meal_type_id', $id)->restore();
        $notification=array(
            'message'=>'Successfully restored.',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
