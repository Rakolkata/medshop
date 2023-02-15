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
            $table->string('SKU')->nullable();
            $table->decimal('MRP')->nullable();
            $table->decimal('Price_unit')->nullable();
            $table->integer('Stock')->nullable();
            $table->date('Exp_date')->nullable();  
            $table->unsignedBigInteger('Categories_id')->nullable();
            $table->foreign('Categories_id')->nullable()->references('Categories_id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('Brand')->nullable();
            $table->foreign('Brand')->nullable()->references('id')->on('brands')->onUpdate('cascade') ->onDelete('set null');
            $table->string('Box_No')->nullable(); 
            $table->unsignedBigInteger('Function')->nullable();
            $table->foreign('Function')->nullable()->references('id')->on('med__functions')->onUpdate('cascade')->onDelete('set null'); 
            $table->string('Generic_name')->nullable();
            $table->string('Ingredients')->nullable();
            $table->unsignedBigInteger('Schedule')->nullable();
            $table->foreign('Schedule')->nullable()->references('id')->on('schedules')->onUpdate('cascade')->onDelete('set null'); 
            $table->longText('Description')->nullable();
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
