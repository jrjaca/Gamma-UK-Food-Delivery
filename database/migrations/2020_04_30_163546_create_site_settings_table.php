<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable();
            $table->string('main_title')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('open_time_saturday')->nullable();
            $table->string('open_time_sunday')->nullable();
            $table->string('open_time_monday')->nullable();
            $table->string('open_time_tuesday')->nullable();
            $table->string('open_time_wednesday')->nullable();
            $table->string('open_time_thursday')->nullable();
            $table->string('open_time_friday')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('checkout_shipping_charge')->default(0);
            $table->string('checkout_vat')->default(0);
            $table->text('about_title')->nullable();
            $table->text('about_subtitle')->nullable();
            $table->text('about_content')->nullable();

            $table->string('main_head_topv_image_path')->nullable();
            $table->string('main_head_top_left_image_path')->nullable();
            $table->string('main_middle_image_path')->nullable();
            $table->string('main_head_bottom_right_image_path')->nullable();

            $table->string('ychose_below_left_image_path')->nullable();
            $table->string('ychose_below_right_image_path')->nullable();

            $table->string('about_head_top_image_path')->nullable();

            $table->string('menu_head_top_grid_image_path')->nullable();
            $table->string('menu_head_top_list_image_path')->nullable();
            $table->string('menu_head_top_details_image_path')->nullable();

            $table->string('gallery_head_top_image_path')->nullable();

            $table->string('pages_service_head_top_image_path')->nullable();
            $table->string('pages_cart_head_top_image_path')->nullable();
            $table->string('pages_checkout_head_top_image_path')->nullable();

            $table->string('contact_head_top_image_path')->nullable();
            $table->string('contact_middle_left_image_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
