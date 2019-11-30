<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5,10)), "."),    //bỏ dấu . ở bên phải
        'body' => $faker->paragraph(rand(3,7), true),   //thay vì mãng thì thành chuỗi
        'views' => rand(0, 10),
        //'answers_count' => rand(0, 10),
        'votes' => rand(-3, 10),
    ];
});

$factory->define(App\Answer::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->paragraph(rand(3,7), true),   //thay vì mãng thì thành chuỗi
        'user_id' => \App\User::pluck('id')->random(),
        //'question_id' => \App\Question::pluck('id')->random(),
        'votes_count' => rand(-3, 10),
    ];
});
