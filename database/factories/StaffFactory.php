<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'surname' => $this->faker->unique()->name(),
            'other_name' => $this->faker->name(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'id_photo' => base64_encode($this->faker->imageUrl(140, 140)),
        ];
    }
}
