<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('title');
            $table->text('description');
            $table->float('price')->unsigned();
            $table->integer('number_of_rooms')->unsigned();
            $table->integer('bathrooms')->unsigned();
            $table->integer('bedrooms')->unsigned();
            $table->integer('square_meters')->unsigned();
            $table->string('address');
            $table->double('lat');
            $table->double('lng');
            $table->string('image');
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
        Schema::dropIfExists('apartments');
    }
}
