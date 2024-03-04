<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->string('payment_type')->comment('cod, paypal, check, creditcard, stripe');
            $table->string('payment_id')->nullable()->comment('transaction_id of paypal, payment_id of stripe');
            $table->string('balance_transaction')->nullable()->comment('captured thru api- stripe');
            $table->string('order_id')->nullable()->comment('returned value, from api of paypal and stripe');
            $table->string('payment_status')->nullable()->comment('returned status from api of paypal and stripe');
            $table->string('shipping_charge')->default(0);
            $table->string('vat_amount')->default(0);
            $table->string('subtotal_amount');
            $table->string('total_amount');
            $table->integer('status_code')->default(0)->comment('0-new, 1-Payment accepted, 2-for delivery, 3-delivered, 4-canceled, 5-for return, 6-returned');
            $table->string('tracking_code')->comment('uniquid with functions to check if really unique from DB');
            $table->timestamps('payment_date');
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
        Schema::dropIfExists('order_payments');
    }
}
