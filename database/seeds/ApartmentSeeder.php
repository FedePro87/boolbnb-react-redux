<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use App\Service;
use App\Message;
use App\Sponsorship;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class, 50)->make()->each(function($apartment) {

            $user = User::inRandomOrder()->first();
            $apartment->user()->associate($user);

            $apartment->save();
            
            $services = Service::inRandomOrder()->take(rand(1,6))->get();
            $apartment->services()->attach($services);

            $randomizer=rand(0,1);

            if($randomizer){
              $sponsorship=Sponsorship::inRandomOrder()->first();
              $apartment->sponsorships()->attach($sponsorship);
            }

        });


        
    }
}



// factory(Post::class, 100)->make()->each(function($post){

//     $author = Author::inRandomOrder()->first();
//     $post->author()->associate($author);
//     $post->save();

//     $categories = Category::inRandomOrder()->take(rand(1, 5))->get();
//     $post->categories()->attach($categories);
//   });
