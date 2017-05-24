<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from')->unsigned()->nullable();
            $table->integer('user_to')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->string('send_from')->nullable();
            $table->boolean('read_on')->default(false);
            $table->timestamps();
            $table->engine = 'InnoDB';
            
            $table->foreign('user_to')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
