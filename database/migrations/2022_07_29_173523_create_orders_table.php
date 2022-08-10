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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('order_number')->unique();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            //$table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->decimal('totalAmount', 20, 6);
            $table->string('payment_mode');
            $table->string('c_country');
            $table->string('c_fname');
            $table->string('c_lname');
            $table->text('c_address');
            $table->string('c_state_country');
            $table->string('c_postal_zip');
            $table->string('c_email_address');
            $table->string('c_phone');
            $table->text('c_order_notes')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
