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
            'name' => 'TuMenuQR.',
            'slug' => Str::slug('TuMenuQR.'),
            'email' => 'marascofederico95@gmail.com',
            'phone' => '2396513953',
            'adress' => 'Arenales 356',
            'city' => 'Carlos Casares, Bs. As.',
            'social' => '',
            'url' => 'tumenuqr.femaser.com',
            'description' => 'Accede con el codigo QR y podras ver tu menu con todos tus productos y categorias. ',
            'status' => '1',
            'type_menu' => '1',
            'image_logo' => '1_1_1707081893_ZoENgmh.jpg',
            'image_logo_uri' => 'archives/images/logo/',
            'image_hero' => '1_1_1707081810_fIcuIY7.jpg',
            'image_hero_uri' => 'archives/images/hero/',
            'image_qr' => '1_1_1707081541_2Mb9ngW.jpg',
            'image_qr_uri' => 'archives/images/qr/',
            'membership_id' => '3',
        ]);
        Company::create([
            'name' => 'Meriendalunas',
            'slug' => Str::slug('Meriendalunas'),
            'email' => 'meriendalunas@gmail.com',
            'phone' => '2396513953',
            'adress' => 'Arenales 356',
            'city' => 'Carlos Casares',
            'social' => '',
            'url' => 'tumenuqr-demo1.femaser.com',
            'description' => 'Veni a desayunar o merendar las mejores medias lunas de la zona, tambien tenemos licuados, cafes, tortas entre otras cosas',
            'status' => '1',
            'type_menu' => '1',
            'image_logo' => '1_1_1707777476_UcXnFVS.jpg',
            'image_logo_uri' => 'archives/images/2/logos/',
            'image_hero' => '2_2_1708134332_Vu4gtWB.jpg',
            'image_hero_uri' => 'archives/images/2/heros/',
            'image_qr' => '1_1_1707777476_wcCxNmF.jpg',
            'image_qr_uri' => 'archives/images/2/qrs/',
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
            'image_logo_uri' => 'archives/images/logo/',
            'image_hero' => 'galletas_06.jpg',
            'image_hero_uri' => 'archives/images/hero/',
            'image_qr' => '1706149337_1_1.jpg',
            'image_qr_uri' => 'archives/images/qr/',
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
            'image_logo_uri' => 'archives/images/logo/',
            'image_hero' => 'galletas_06.jpg',
            'image_hero_uri' => 'archives/images/hero/',
            'image_qr' => '1706149337_1_1.jpg',
            'image_qr_uri' => 'archives/images/qr/',
            'membership_id' => '2',
        ]);
    }
}
