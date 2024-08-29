<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creator_id' => 2,
            'company_name' => $this->faker->name(),
            'position' => 'Waiter/Waitress',
            'description' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(),
            'location' => 'New York City, United States',
            'job_type' => 'Full-Time',
            'category' => 'Food & Beverage',
            'close_date' => $this->faker->date()
        ];
    }
}
