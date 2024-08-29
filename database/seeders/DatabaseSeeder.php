<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TripSeeder;
use Database\Seeders\DaySeeder;
use Database\Seeders\StopSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        /* \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'manuel@gmail.com',
        ]); */

        $this->call([
            UserSeeder::class,
            TripSeeder::class,
            DaySeeder::class,
            StopSeeder::class,
        ]);
    }
}
