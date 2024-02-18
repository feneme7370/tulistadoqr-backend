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
        // id 1
        Category::create([
            'name' => 'Batidos',
            'slug' => Str::slug('Batidos'),
            'description' => 'Batidos de frutas, con multiples sabores',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'batidos.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 2
        Category::create([
            'name' => 'Cafes',
            'slug' => Str::slug('Cafes'),
            'description' => 'Nos especializamos en cafes italianos, tenemos con leche, miel y express',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'cafes.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 3
        Category::create([
            'name' => 'Galletas',
            'slug' => Str::slug('Galletas'),
            'description' => 'Pepas, Oreos, Dulces y Saladas',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'galletas.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 4
        Category::create([
            'name' => 'Porcion dulce',
            'slug' => Str::slug('Postres'),
            'description' => 'Tartas dulces con frutos rojos, tartas de frutillas, con crema y la que vos queiras',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'tortas.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 5
        Category::create([
            'name' => 'Donas',
            'slug' => Str::slug('Donas'),
            'description' => 'Incluyen chips de chocolates, dulces, saladas, con crema, elegi la tuya',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'donas.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 6
        Category::create([
            'name' => 'Capuchinos',
            'slug' => Str::slug('Capuchinos'),
            'description' => 'Nos especializamos en cafes italianos, tenemos con leche, miel y express',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'capuchinos.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 7
        Category::create([
            'name' => 'Cheese cake',
            'slug' => Str::slug('Cheese cake'),
            'description' => 'Caseros cheesses cakes',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'cheessecake.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 8
        Category::create([
            'name' => 'Medialunas',
            'slug' => Str::slug('Medialunas'),
            'description' => 'Dulces y saladas',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'medialunas.jpg',
            'level_id' => 2,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 9
        Category::create([
            'name' => 'Te',
            'slug' => Str::slug('Te'),
            'description' => 'Te con miel y menta, te de hiervas y mas',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'te.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 10
        Category::create([
            'name' => 'Exprimido',
            'slug' => Str::slug('Exprimido'),
            'description' => 'Jugos naturales',
            'status' => 1,
            'image_hero_uri' => 'archives/images/2/categories/',
            'image_hero' => 'exprimidos.jpg',
            'level_id' => 1,
            'user_id' => 2,
            'company_id' => 2,
        ]);

        // id 11
        Category::create([
            'name' => 'Gaseosas',
            'slug' => Str::slug('Gaseosas'),
            'description' => 'Coca cola, sprite, y mucha variedad',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'gaseosas.jpg',
            'level_id' => 3,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 12
        Category::create([
            'name' => 'Agua Savorizada',
            'slug' => Str::slug('Agua Savorizada'),
            'description' => 'Pomelo, Naranja, Pera',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'aguasavorizada.jpg',
            'level_id' => 3,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 13
        Category::create([
            'name' => 'Vinos',
            'slug' => Str::slug('Vinos'),
            'description' => 'Vinos de variadas cosechas',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'vinos.jpg',
            'level_id' => 3,
            'user_id' => 3,
            'company_id' => 3,
        ]);
        
        // id 14
        Category::create([
            'name' => 'Pizzas',
            'slug' => Str::slug('Pizzas'),
            'description' => 'A la pieda y con varios tipos',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'pizzas.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 15
        Category::create([
            'name' => 'Hamburguesas',
            'slug' => Str::slug('Hamburguesas'),
            'description' => 'Sabrosas hamburguesas',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'hamburguesas.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 16
        Category::create([
            'name' => 'Milanesas',
            'slug' => Str::slug('Milanesas'),
            'description' => 'Ricas milanesas caseras',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'milanesas.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 17
        Category::create([
            'name' => 'Papas Fritas',
            'slug' => Str::slug('Papas Fritas'),
            'description' => 'Papas con provenzal o panceta',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'papasfritas.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 18
        Category::create([
            'name' => 'Picada',
            'slug' => Str::slug('Picada'),
            'description' => 'Rica entrada',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'picadas.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);

        // id 19
        Category::create([
            'name' => 'Tallarines',
            'slug' => Str::slug('Tallarines'),
            'description' => 'Rica entrada',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'tallarines.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);
        
        // id 20
        Category::create([
            'name' => 'Sandwich',
            'slug' => Str::slug('Sandwich'),
            'description' => 'Ponele lo que quieras',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'sandwich.jpg',
            'level_id' => 4,
            'user_id' => 3,
            'company_id' => 3,
        ]);
        
        // id 21
        Category::create([
            'name' => 'Postres',
            'slug' => Str::slug('Postres'),
            'description' => 'Termina la comida de la mejor forma',
            'status' => 1,
            'image_hero_uri' => 'archives/images/3/categories/',
            'image_hero' => 'tallarines.jpg',
            'level_id' => 5,
            'user_id' => 3,
            'company_id' => 3,
        ]);
    }
}
