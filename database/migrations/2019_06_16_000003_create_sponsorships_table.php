<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Sponsorship;

class CreateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('duration');
            $table->float('amount');
            $table->timestamps();
        });

        Sponsorship::insert([
            'duration' => 1440,
            'amount'=> 2.99
        ]);
        Sponsorship::insert([
            'duration' => 4320,
            'amount'=> 5.99
        ]);
        Sponsorship::insert([
            'duration' => 8640,
            'amount'=> 9.99
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
