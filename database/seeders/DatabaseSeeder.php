<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create()->each(function($u) {
            $u->quetions()
                ->saveMany(
                    \App\Models\Question::factory(rand(1, 5))->make()
                )
                ->each(function ($q) {
                   $q->answers()->saveMany(\App\Models\Answer::factory(rand(1, 5))->make());
                });
        });
    }
}
