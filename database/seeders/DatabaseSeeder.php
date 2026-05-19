<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Item;
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

        User::create([
            'name' => 'erik',
            'email' => 'erikolim@gmail.com',
            'username' => 'kocak',
            'password' => bcrypt('admin123'),
            'role' => 'Admin'
        ]);

        Kategori::factory()->count(15)->create();
        Item::factory()->count(20)->create();
        User::factory()->count(20)->create();
    }
}
