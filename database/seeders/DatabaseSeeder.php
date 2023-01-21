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
        User::factory(3)
            ->create()
            ->each(static function (User $user) {
                Apartment::factory(rand(4, 12), ['by_user_id' => $user->id])->create();
            });
    }
}
