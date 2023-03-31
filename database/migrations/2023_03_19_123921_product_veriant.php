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
        Schema::create('product_veriant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pid')->nullable();
            $table->foreign('pid')->references('id')->on('products');
            $table->integer('stock');
            $table->date('expdate');
            $table->float('mrp_per_unit')->nullable()->default(123.45);
            $table->string('batch', 100)->nullable()->default('');
            $table->tinyInteger('strip');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_veriant');
    }
};
