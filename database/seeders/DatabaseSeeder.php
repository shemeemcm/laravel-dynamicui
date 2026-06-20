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
        // User::factory(10)->create();

        // Seed one Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Seed one Client user
        User::create([
            'name' => 'Client User',
            'email' => 'client@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'role' => 'client',
        ]);

        // Call UIBlockSeeder
        $this->call(UIBlockSeeder::class);
    }
}
