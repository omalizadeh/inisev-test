<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    public function definition()
    {
        return [
            'domain' => $this->faker->domainName,
        ];
    }
}
