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
        Schema::create('order__user__profiles', function (Blueprint $table) {
            $table->id();
            $table->string('Phone');
            $table->string('Address');
            $table->string('Doc_Name_RegdNo');
            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')->references('id')->on('users');
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
        Schema::dropIfExists('order__user__profiles');
    }
};
