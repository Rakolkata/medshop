<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->string('user_name',50);
            $table->string('password',100);
            $table->string('mobile',50)->nullable();
            $table->string('email',50)->nullable(); 
            $table->string('alternate_email',50)->nullable();   
            $table->timestamp('email_verified_at')->nullable();
            $table->string('emp_code',20)->nullable();
            $table->string('designation',50)->nullable();
            $table->string('address',200)->nullable();
            $table->string('country',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('pincode',20)->nullable();
            $table->string('image')->nullable();
            $table->string('user_type')->default('user');
            $table->string('designation_hierarchy')->nullable();
            $table->rememberToken();
            $table->datetime('created_by')->nullable();
            $table->datetime('updated_by')->nullable();
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
        Schema::dropIfExists('users');
    }
}
