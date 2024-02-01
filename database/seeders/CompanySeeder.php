<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Page\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'SuperAdmin',
            'slug' => Str::slug('SuperAdmin'),
            'email' => 'superadmin@gmail.com',
            'phone' => '2396',
            'adress' => 'Z-1508',
            'city' => 'Pehuajo',
            'social' => '',
            'url' => 'www.facebook.com',
            'description' => 'SuperAdmin description',
            'status' => '1',
            'type_menu' => '1',
            'image_logo' => 'galletas_05.jpg',
            'image_logo_uri' => 'archives/images/logo',
            'image_hero' => 'galletas_06.jpg',
            'image_hero_uri' => 'archives/images/hero',
            'image_qr' => '1706149337_1_1.jpg',
            'image_qr_uri' => 'archives/images/qr',
            'membership_id' => '3',
        ]);
        Company::create([
            'name' => 'Tu Licuado',
            'slug' => Str::slug('Tu Licuado'),
            'email' => 'tumedialuna@gmail.com',
            'phone' => '2396513625',
            'adress' => 'Av. San Martin 593',
            'city' => 'Carlos Casares',
            'social' => '',
            'url' => 'www.facebook.com',
            'description' => 'Veni a desayunar o merendar las mejores medias lunas de la zona, tambien tenemos licuados, cafes, tortas entre otras cosas',
            'status' => '1',
            'type_menu' => '1',
            'image_logo' => 'galletas_05.jpg',
            'image_logo_uri' => 'archives/images/logo',
            'image_hero' => 'galletas_06.jpg',
            'image_hero_uri' => 'archives/images/hero',
            'image_qr' => '1706149337_1_1.jpg',
            'image_qr_uri' => 'archives/images/qr',
            'membership_id' => '3',
        ]);
        Company::create([
            'name' => 'Pizzalocos',
            'slug' => Str::slug('Pizzalocos'),
            'email' => 'pizzalocos@gmail.com',
            'phone' => '2395845524',
            'adress' => 'Arenales 962',
            'city' => 'Carlos Casares',
            'social' => '',
            'url' => 'www.facebook.com',
            'description' => 'Disfruta de nuestras pizzas caseras, tenemos una amplia variedad para pedir',
            'status' => '1',
            'type_menu' => '1',
            'image_logo' => 'galletas_05.jpg',
            'image_logo_uri' => 'archives/images/logo',
            'image_hero' => 'galletas_06.jpg',
            'image_hero_uri' => 'archives/images/hero',
            'image_qr' => '1706149337_1_1.jpg',
            'image_qr_uri' => 'archives/images/qr',
            'membership_id' => '2',
        ]);
        Company::create([
            'name' => 'Donas Buonas',
            'slug' => Str::slug('Donas Buonas'),
            'email' => 'donasbuonas@gmail.com',
            'phone' => '3512396625846',
            'adress' => 'Varela 1505',
            'city' => 'Pehuajo',
            'social' => '',
            'url' => 'www.facebook.com',
            'description' => 'Merenda las donas caseras de la casa, con cualquier ingrediente que le quieras agregar vos',
            'status' => '1',
            'type_menu' => '1',
            'image_logo' => 'galletas_05.jpg',
            'image_logo_uri' => 'archives/images/logo',
            'image_hero' => 'galletas_06.jpg',
            'image_hero_uri' => 'archives/images/hero',
            'image_qr' => '1706149337_1_1.jpg',
            'image_qr_uri' => 'archives/images/qr',
            'membership_id' => '2',
        ]);
    }
}
