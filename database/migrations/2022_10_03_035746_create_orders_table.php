<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('name',100)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('district',120)->nullable();
            $table->string('ward',120)->nullable();
            $table->string('address',100)->nullable();
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->double('total')->nullable();
            $table->softDeletes();
            $table->timestamps();
            #Status
            //0. Đang xử lý
            //1. Đang giao hàng
            //2. Đã giao hàng
            //3. Huỷ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
