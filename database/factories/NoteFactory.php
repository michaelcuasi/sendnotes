<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => $this->faker->uuid,
            "user_id" => User::factory(),
            "title" => $this->faker->words(5, true),
            "body" => $this->faker->paragraph,
            "send_date" => $this->faker->date('Y-m-d', '+30 days'),
            "recipient" => $this->faker->email,
            "is_published" => true,
            "heart_count" => $this->faker->numberBetween(0, 20),

        ];
    }
}
