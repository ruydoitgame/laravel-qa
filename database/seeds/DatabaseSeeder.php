<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersQuestionsAnswersTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(VotablesTableSeeder::class);
    }
}
