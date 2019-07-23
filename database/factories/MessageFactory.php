<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'title'=>$faker->word(5),
        'content'=>$faker->sentence(50),
        'email'=>$faker->email()
    ];
});
