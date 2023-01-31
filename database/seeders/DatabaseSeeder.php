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
            'email' => 'email@email.com',
            'is_admin' => true
        ]);


        User::factory()
            ->count(3)
            ->has(
                Apartment::factory(10)
            )
            ->create();
    }
}
