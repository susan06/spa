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
            $table->string('lastname');
            $table->string('gender')->nullable(); 
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->date('birthday')->nullable(); 
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('status', 20);
            $table->string('avatar')->nullable();
            $table->string('lang')->default('es');
            $table->integer('province_id')->unsigned()->index();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('password');
            $table->boolean('online')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->string('confirmation_token', 60)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

    }       

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
