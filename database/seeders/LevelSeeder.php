<?php

namespace Database\Seeders;

use App\Models\Page\Level;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Level::factory(20)->create();
        Level::create([
                'name' => 'Bebidas',
                'slug' => Str::slug('Bebidas'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_01.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);
        Level::create([
                'name' => 'Comidas',
                'slug' => Str::slug('Comidas'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_02.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);
        Level::create([
                'name' => 'Postres',
                'slug' => Str::slug('Postres'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_03.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);
        Level::create([
                'name' => 'Bebidas',
                'slug' => Str::slug('Bebidas'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_04.jpg',
                'status' => 1,
                'user_id' => 3,
                'company_id' => 3,
            ]);
        Level::create([
                'name' => 'Comidas',
                'slug' => Str::slug('Comidas'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_05.jpg',
                'status' => 1,
                'user_id' => 3,
                'company_id' => 3,
            ]);
        Level::create([
                'name' => 'Postres',
                'slug' => Str::slug('Postres'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_06.jpg',
                'status' => 1,
                'user_id' => 3,
                'company_id' => 3,
            ]);
        Level::create([
                'name' => 'Bebidas',
                'slug' => Str::slug('Bebidas'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_07.jpg',
                'status' => 1,
                'user_id' => 4,
                'company_id' => 4,
            ]);
        Level::create([
                'name' => 'Comidas',
                'slug' => Str::slug('Comidas'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_08.jpg',
                'status' => 1,
                'user_id' => 4,
                'company_id' => 4,
            ]);
        Level::create([
                'name' => 'Postres',
                'slug' => Str::slug('Postres'),
                'description' => 'Descripcion del nivel',
                'image_hero_uri' => 'archives/images/level_hero/',
                'image_hero' => 'cafe_09.jpg',
                'status' => 1,
                'user_id' => 4,
                'company_id' => 4,
            ]);
    }
}
