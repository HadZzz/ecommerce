<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ShopSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ShopSeeder::class,
        ]);
    }
}
