<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favorites')->delete();
        $users = \App\User::pluck('id')->all();
        $number_of_users = count($users);
        foreach (\App\Question::all() as $question) {
            for ($i = 0; $i < rand(0, $number_of_users); $i++) {
                $user = $users[$i];
                $question->favorites()->attach($user);
            }
        }
    }
}
