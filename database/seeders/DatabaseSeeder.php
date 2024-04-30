<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'daniel',
            'email' => 'daniel.vdheijden@shopmonkey.nl',
            'password' => '123',
        ]);

        Shop::create([
            'shop_title' => 'Test shop',
            'shop_id' => '352051',
            'cluster' => 'eu1',
            'api_key' => '0c00fceb0289bd87b9daea304c5381ac',
            'api_secret' => '7f8c597d8347afe6ff46baa2fc14507b',
            'main_language' => 'nl',
        ]);
    }
}
