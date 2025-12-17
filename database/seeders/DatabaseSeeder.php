<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([
            [
                'name' => 'Admin Peohai 1',
                'email' => 'admin1@admin.com',
                'password' => Hash::make('password123'),
                'role' => 'Super Admin',
            ],
            [
                'name' => 'Admin Peohai 2',
                'email' => 'admin2@admin.com',
                'password' => Hash::make('password123'),
                'role' => 'Admin',
            ],
        ]);

        $this->call([
            CitySeeder::class,
        ]);
    }
}
