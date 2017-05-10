<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_office_id')->unsigned()->index();
            $table->integer('method_payment_id')->unsigned()->index();
            $table->timestamps();  
            $table->engine = 'InnoDB'; 

            $table->foreign('branch_office_id')->references('id')->on('branch_offices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('method_payment_id')->references('id')->on('method_payments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('branch_offices_payments');
    }
}
