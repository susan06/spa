<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_office_id')->unsigned()->index();
            $table->string('title');
            $table->date('date_start');
            $table->date('date_end');
            $table->date('view_start');
            $table->date('view_end');
            $table->text('description')->nullable();
            $table->boolean('view')->default(true);
            $table->timestamps();  
            $table->engine = 'InnoDB'; 

            $table->foreign('branch_office_id')->references('id')->on('branch_offices')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tours');
    }
}
