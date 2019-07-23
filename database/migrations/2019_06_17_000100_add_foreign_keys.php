<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up(){
    Schema::table('apartments', function(Blueprint $table) {
      $table->foreign('user_id', 'user')
      ->references('id')
      ->on('users')
      ->onDelete('cascade');
    });

    Schema::table('messages', function(Blueprint $table) {
      $table->foreign('apartment_id', 'apartment2')
      ->references('id')
      ->on('apartments')
      ->onDelete('cascade');
    });

    Schema::table('visuals', function(Blueprint $table) {
      $table->foreign('apartment_id', 'apartment4')
      ->references('id')
      ->on('apartments')
      ->onDelete('cascade');
    });

    Schema::table('apartment_service', function(Blueprint $table){
      $table->foreign('service_id','service')
      ->references('id')
      ->on('services');

      $table->foreign('apartment_id','apartment')
      ->references('id')
      ->on('apartments');
    });

    Schema::table('apartment_sponsorship', function(Blueprint $table){
      $table->foreign('apartment_id','apartment3')
      ->references('id')
      ->on('apartments');

      $table->foreign('sponsorship_id','sponsorship')
      ->references('id')
      ->on('sponsorships');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down(){
    Schema::table('apartment_service', function(Blueprint $table) {
      $table->dropForeign('service');
      $table->dropForeign('apartment');
    });

    Schema::table('apartments', function(Blueprint $table) {
      $table->dropForeign('sponsorship');
      $table->dropForeign('user');
    });

    Schema::table('apartment_sponsorship', function(Blueprint $table){
      $table->dropForeign('sponsorship');
      $table->dropForeign('apartment3');
    });
  }
}
