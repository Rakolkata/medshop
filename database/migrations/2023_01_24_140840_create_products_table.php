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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->string('SKU');
            $table->decimal('MRP');
            $table->decimal('Price_unit');
            $table->integer('Stock');
            $table->date('Exp_date');  
            $table->unsignedBigInteger('Categories_id');
            $table->foreign('Categories_id')->references('Categories_id')->on('categories');
            $table->unsignedBigInteger('Brand');
            $table->foreign('Brand')->references('id')->on('brands');
            $table->string('Box_No'); 
            $table->unsignedBigInteger('Function');
            $table->foreign('Function')->references('id')->on('med__functions'); 
            $table->string('Generic_name');
            $table->string('Ingredients');
            $table->unsignedBigInteger('Schedule');
            $table->foreign('Schedule')->references('id')->on('schedules'); 
            $table->longText('Description');
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
        Schema::dropIfExists('products');
    }
};
