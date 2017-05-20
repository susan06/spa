<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->index();
            $table->integer('province_id')->unsigned()->index();
            $table->string('name', 60);
            $table->text('address');
            $table->text('address_description');
            $table->string('lat');
            $table->string('lng');
            $table->string('phone_one', 60);
            $table->text('phone_second')->nullable();
            $table->text('working_hours');
            $table->string('week')->default('0,6');
            $table->integer('min_time')->default(8);
            $table->integer('max_time')->default(20);
            $table->string('email');
            $table->boolean('domicile')->default(false);
            $table->boolean('reservation_web')->default(false);
            $table->boolean('reservation_discount')->default(false);
            $table->integer('percent_discount')->nullable(); 
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onUpdate('cascade')->onDelete('cascade');
            
        });
        
    }
    
    public function down() {
        Schema::drop('branch_offices');
    }
}
