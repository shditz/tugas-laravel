<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder.
     */
    public function run(): void
    {
        // Jalankan seeder LoginSeeder
        $this->call(LoginSeeder::class);
        $this->call(UserSeeder::class);
    }
}
