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
        // id 1
        Level::create([
                'name' => 'Bebidas',
                'slug' => Str::slug('Bebidas'),
                'description' => 'Proba nuestros licuados, tenemos una amplia variedad de gustos, tambien ofrecemos cafe, te, entre otras cosas',
                'image_hero_uri' => 'archives/images/2/levels/',
                'image_hero' => 'bebidas.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);

            // id 2
        Level::create([
                'name' => 'Comidas',
                'slug' => Str::slug('Comidas'),
                'description' => 'Tenemos galletas, donas y medias lunas para disfrutar',
                'image_hero_uri' => 'archives/images/2/levels/',
                'image_hero' => 'comidas.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);



        Level::create([
                'name' => 'Bebidas',
                'slug' => Str::slug('Bebidas'),
                'description' => 'Ofrecemos gaseosas y aguas savorizadas, tambien tenemos vinos y cervezas',
                'image_hero_uri' => 'archives/images/2/levels/',
                'image_hero' => 'bebidas.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);
        Level::create([
                'name' => 'Comidas',
                'slug' => Str::slug('Comidas'),
                'description' => 'Pizzas, hambuerguesas, sanwdiches y demas',
                'image_hero_uri' => 'archives/images/3/levels/',
                'image_hero' => 'comidas.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);
        Level::create([
                'name' => 'Postres',
                'slug' => Str::slug('Postres'),
                'description' => 'Postres de todo tipo, con chocolate, frutos rojos, porciones de tortas muy ricas',
                'image_hero_uri' => 'archives/images/3/levels/',
                'image_hero' => 'postres.jpg',
                'status' => 1,
                'user_id' => 2,
                'company_id' => 2,
            ]);
    }
}
