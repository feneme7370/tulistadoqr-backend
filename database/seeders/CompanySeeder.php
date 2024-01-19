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
            'description' => 'SuperAdmin description',
            'status' => '1',
            'image_logo' => '',
            'image_hero' => '',
            'membership_id' => '3',
        ]);
        Company::create([
            'name' => 'Puerto Tabla',
            'slug' => Str::slug('Puerto Tabla'),
            'email' => 'puertotabla@gmail.com',
            'phone' => '2395969696',
            'adress' => 'Av. San Martin',
            'city' => 'Carlos Casares',
            'social' => '',
            'description' => 'La roticeria perfecta',
            'status' => '1',
            'image_logo' => '',
            'image_hero' => '',
            'membership_id' => '2',
        ]);
        Company::create([
            'name' => 'Viterra',
            'slug' => Str::slug('Viterra'),
            'email' => 'viterra@gmail.com',
            'phone' => '2395969696',
            'adress' => 'Av. San Martin',
            'city' => 'Carlos Casares',
            'social' => '',
            'description' => 'La roticeria perfecta',
            'status' => '1',
            'image_logo' => '',
            'image_hero' => '',
            'membership_id' => '1',
        ]);
        Company::create([
            'name' => 'LDC',
            'slug' => Str::slug('LDC'),
            'email' => 'ldc@gmail.com',
            'phone' => '2395969696',
            'adress' => 'Av. San Martin',
            'city' => 'Carlos Casares',
            'social' => '',
            'description' => 'La roticeria perfecta',
            'status' => '1',
            'image_logo' => '',
            'image_hero' => '',
            'membership_id' => '3',
        ]);
    }
}
