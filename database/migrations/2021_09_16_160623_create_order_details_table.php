<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id')->nullable();
            $table->string('orderNo')->nullable();
            $table->tinyInteger('city_id')->nullable();
            $table->tinyInteger('area_id')->nullable();
            $table->tinyInteger('staff_id')->nullable();
            $table->string('required_services')->nullable();
            $table->date('pick_up_date')->nullable();
            $table->time('pick_up_time')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('pay_type')->nullable();
            $table->string('postCode')->nullable();
            $table->string('customerAddress')->nullable();
            $table->string('message')->nullable();
            $table->integer('picked_up');
            $table->integer('status');
            $table->integer('payment_type');
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
        Schema::dropIfExists('order_details');
    }
}
