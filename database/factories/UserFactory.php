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
        'email_verified_at' => now(),
        'bio' => $faker->sentence,
        'username' => $faker->userName,
        'gender' => /*$faker->$faker->randomElement([0, 1])*/ $faker->numberBetween($min = 0, $max = 1),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Category::class, function (Faker $faker) {
    return [
        "name" => $faker->colorName,
    ];
});
$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        "name" => $faker->colorName,
    ];
});
$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        "user_id" => function(){
            return factory(App\User::class)->create();
        },
        'post_id' => function () {
            return factory(App\Post::class)->create();
        },
        'body' => $faker->sentence,
    ];
});
$factory->define(App\Post::class, function (Faker $faker) {
    return[
        'title' => $faker->sentence,
        'user_id' => function(){
            return factory(App\User::class)->create();
        },
        'category_id' => function(){
            return factory(\App\Category::class)->create();
        },
        'content' => $faker->paragraphs($nb = 3, $asText = true),
        'featured' => $faker->numberBetween($min = 0, $max = 1)
    ];
});
