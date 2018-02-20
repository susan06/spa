<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_id')->unsigned()->index();
            $table->integer('client_id')->unsigned()->index();
            $table->enum('status', [
                    'pendient',
                    'approved',
                    'rejected',
                ])->default('pendient');
            $table->enum('rejected_by', [
                    'client',
                    'owner',
                ])->nullable();
            $table->string('details_client')->nullable();
            $table->timestamps();  
            $table->engine = 'InnoDB'; 

            $table->foreign('tour_id')->references('id')->on('tours')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tours_reservations');
    }
}
