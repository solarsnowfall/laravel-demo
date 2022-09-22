<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Company;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'email'         => $this->faker->email,
            'phone'         => $this->faker->phoneNumber,
            'address'       => $this->faker->address,
            'company_id'    => Company::pluck('id')->random(),
            //'user_id'       => User::factory()
        ];
    }
}
