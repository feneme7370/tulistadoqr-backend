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
            'description' => 'Licuados de frutas, con multiples sabores',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => '2_2_1707773327_sEduSQa.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Cafes',
            'slug' => Str::slug('Cafes'),
            'description' => 'Nos especializamos en cafes italianos, tenemos con leche, miel y express',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => '2_2_1707773314_z2xyg9g.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Galletas',
            'slug' => Str::slug('Galletas'),
            'description' => 'Pepas, Oreos, Dulces y Saladas',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => '2_2_1707773302_QdPNLUX.jpg',
            'level_id' => 3,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Porcion dulce',
            'slug' => Str::slug('Postres'),
            'description' => 'Tartas dulces con frutos rojos, tartas de frutillas, con crema y la que vos queiras',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => '2_2_1707773285_fEUbDPz.jpg',
            'level_id' => 3,
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Category::create([
            'name' => 'Donas',
            'slug' => Str::slug('Donas'),
            'description' => 'Incluyen chips de chocolates, dulces, saladas, con crema, elegi la tuya',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => '2_2_1707773269_jNznsXb.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);
    }
}
