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
          Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customerName',100);
            $table->biginteger('orderId');
            $table->biginteger('orderNumber');
            $table->biginteger('productId');
            $table->string('productName',100);
            $table->biginteger('price');
            $table->biginteger('quantity');
            $table->biginteger('totalPrice');
            $table->string('paymentMode',100);
            $table->datetime('deliveryDate');
            $table->text('deliveryNote');
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
        Schema::dropIfExists('orderdetails');
    }
};
