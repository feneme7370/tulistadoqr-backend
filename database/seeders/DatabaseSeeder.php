<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MembershipSeeder::class,
            CompanySeeder::class,
            SpatieSeeder::class,

            LevelSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,

            TagSeeder::class,
            SocialMediaSeeder::class,

            ProductTagSeeder::class,
            CompanySocialMediaSeeder::class,
            // ShippingMethodsSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
