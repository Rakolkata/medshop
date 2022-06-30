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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gematricName',200);
            $table->string('brand',200);
            $table->string('title',200);
            $table->string('stock',200);
            $table->biginteger('quantity');
            $table->decimal('price');
            $table->decimal('sellPrice');
            $table->string('description',300);
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
        Schema::dropIfExists('product');
    }
};
