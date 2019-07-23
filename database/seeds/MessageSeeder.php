<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Message::class, 50)->make()->each(function($message) {

            $apartment = App\Apartment::inRandomOrder()->first();
            $message->apartment()->associate($apartment);
            $message->save();
    });

   }
}
