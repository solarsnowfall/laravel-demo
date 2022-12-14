<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->company,
            'address'       => $this->faker->address,
            'website'       => $this->faker->domainName,
            'email'         => $this->faker->email,
            'created_at'    => now(),
            'updated_at'    => now(),
            //'user_id'       => User::factory()
        ];
    }
}
