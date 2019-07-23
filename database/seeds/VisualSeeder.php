<?php

use Illuminate\Database\Seeder;

class VisualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Visual::class, 50)->make()->each(function($visual) {

            $apartment = App\Apartment::inRandomOrder()->first();
            $visual->apartment()->associate($apartment);
            $visual->save();
        });
    }
}
