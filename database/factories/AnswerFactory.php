<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph(rand(5, 10), true),
            'votes_count' => rand(-3, 10),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
