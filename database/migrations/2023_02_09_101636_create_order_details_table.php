<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('Order_id');
            $table->foreign('Order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('Product_id');
            $table->foreign('Product_id')->references('id')->on('products');
            $table->float('rate');
            $table->integer('qty');
            $table->float('gst');
            $table->float('Product_price');
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
};
