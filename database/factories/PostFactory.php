<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'writer_id' => User::factory(),
            'title' => $this->faker->title,
            'description' => $this->faker->text,
        ];
    }

    public function website(int $websiteId)
    {
        return $this->state(function (array $attributes) use ($websiteId) {
            return [
                'website_id' => $websiteId,
            ];
        });
    }
}
