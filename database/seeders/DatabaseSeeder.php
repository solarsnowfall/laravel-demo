<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(5)->create();

        $users->each(function (User $user) {
            $companies = $user->companies()->saveMany(
                Company::factory()->count(rand(2, 5))->make()
            );

            $companies->each(function (Company $company) use ($user) {
                $company->contacts()->saveMany(
                    Contact::factory()->count(rand(5, 10))->make()
                        ->map(function (Contact $contact) use ($user) {
                            $contact->user_id = $user->id;
                            return $contact;
                        })
                );
            });
        });
    }
}
