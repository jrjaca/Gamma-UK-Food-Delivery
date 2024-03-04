<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->integer('food_type_id');
            //$table->string('meal_type_id');
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
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
