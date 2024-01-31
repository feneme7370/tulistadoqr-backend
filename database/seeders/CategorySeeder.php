<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Page\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(30)->create();
        Category::create([
            'name' => 'Licuados',
            'slug' => Str::slug('Licuados'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'image_hero_uri' => 'archives/images/category_hero/',
            'image_hero' => 'pastel_01.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Cafes',
            'slug' => Str::slug('Cafes'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'image_hero_uri' => 'archives/images/category_hero/',
            'image_hero' => 'pastel_02.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Galletas',
            'slug' => Str::slug('Galletas'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'image_hero_uri' => 'archives/images/category_hero/',
            'image_hero' => 'pastel_03.jpg',
            'level_id' => 3,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Postres',
            'slug' => Str::slug('Postres'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'image_hero_uri' => 'archives/images/category_hero/',
            'image_hero' => 'pastel_04.jpg',
            'level_id' => 3,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Donas',
            'slug' => Str::slug('Donas'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'image_hero_uri' => 'archives/images/category_hero/',
            'image_hero' => 'pastel_05.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);
    }
}
