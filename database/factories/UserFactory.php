<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

// Demo BiElements
$factory->define(App\Bielement::class, function (Faker $faker) {
    return [
        'eng_id'=>App\Engine::all()->random()->eng_id,
        'bi_name' => $faker->name,
        'bi_desc' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'bi_cover_img' => $faker->image('public/storage/bielements',300, 300, 'technics', false),
        'bi_embed' =>'1551717426.PDF',
        'bi_type' => $faker->numberBetween(10,100),
        'bi_base64' => $faker->name,
        'bi_creator' => $faker->company,
        'bi_publish_date' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});

// Demo Engines
$factory->define(App\Engine::class, function (Faker $faker) {
    return [
        'eng_name' => $faker->name,
        'eng_desc' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'eng_img' => $faker->image('public/storage/engs',400, 400, 'abstract', false)
    ];
});

// Demo Admins
$factory->define(App\Admin::class,function(Faker $faker){
    return [
        'admin'=>$faker->username,
        'pwd'=>'12345'
    ];
});