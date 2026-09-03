<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('12341234'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        User::factory()->create([
            'name' => 'Broker User',
            'email' => 'broker@example.com',
            'password' => bcrypt('12341234'),
            'role' => 'broker',
            'status' => 'approved',
        ]);

        User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('12341234'),
            'role' => 'client',
            'status' => 'approved',
        ]);
    }
}
