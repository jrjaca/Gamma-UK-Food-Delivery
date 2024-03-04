<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodType extends Model
{
    use SoftDeletes;
    protected $date = ['deleted_at'];

    /*protected $fillable =[
        'name',
        'description',
        'image_path',
        'icon_path'
    ];*/

}
