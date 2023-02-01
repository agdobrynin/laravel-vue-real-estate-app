<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@email.com',
            'is_admin' => true
        ]);

        foreach (['email@email.com', 'email2@email.com', 'email3@email.com'] as $email) {
            User::factory()->has(
                Apartment::factory(rand(50, 90))
            )->create(['email' => $email]);
        }
    }
}
