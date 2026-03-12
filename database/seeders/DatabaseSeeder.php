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
        // 1. Default User Create (Admin ke liye)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // Password: password
        ]);

        // 2. Apne Custom Seeders Call karein
        $this->call([
            CategorySeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}