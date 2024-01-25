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
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Cafes',
            'slug' => Str::slug('Cafes'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Galletas',
            'slug' => Str::slug('Galletas'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Postres',
            'slug' => Str::slug('Postres'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Donas',
            'slug' => Str::slug('Donas'),
            'description' => 'Descripcion la categoria',
            'status' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);
    }
}
