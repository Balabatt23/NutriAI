<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'testing',
            'password' => Hash::make('123'),
            'email' => 'a@gmail.com',
            'weight' => 80,
            'height' => 174,
            'gender' => 'M',
            'bmi' => 26.7,
            'exercise_frequency' => 5,
            'age' => 20,
            'alcohol_consumption' => 0,
            'smoking_habit' => 0,
            'avg_daily_steps' => 7000,
            'avg_sleep_hours' => 6.5,
            // 'caloric_intake' => 2000
        ]);

        // User::factory()->create([
        //     'username' => 'Test User',
        //     'email' => 'test@example.com',

        // ]);
    }
}
