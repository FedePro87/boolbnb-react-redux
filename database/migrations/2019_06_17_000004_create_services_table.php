<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Service;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('icon');
            $table->timestamps();
        });

        Service::insert([
            'name' => 'WI-FI',
            'icon' => '<i class="fas fa-wifi"></i>',
        ]);

        Service::insert([
            'name' => 'Piscina',
            'icon' => '<i class="fas fa-swimmer"></i>',
        ]);
        Service::insert([
            'name' => 'Posto Macchina',
            'icon' => '<i class="fas fa-parking"></i>',
        ]);
        Service::insert([
            'name' => 'Portineria',
            'icon' => '<i class="fas fa-concierge-bell"></i>',
        ]);
        Service::insert([
            'name' => 'Sauna',
            'icon' => '<i class="fas fa-hot-tub"></i>',
        ]);
        Service::insert([
            'name' => 'Vista mare',
            'icon' => '<i class="fas fa-umbrella-beach"></i>',
        ]);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
