<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Page\Membership;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membership::create([
            'name' => 'Plate',
            'slug' => Str::slug('Plate'),
            'price' => 3000,
            'short_description' => 'Plan Basico',
            'description' => 'Si tienes pocos productos que ofrecer este es el tuyo',
            'category' => '3',
            'level' => '5',
            'product' => '10',
            'user' => '1',
            'suggestion' => '1',
            'tag' => '2',
            'status' => '1',
        ]);
        Membership::create([
            'name' => 'Gold',
            'slug' => Str::slug('Gold'),
            'price' => 5000,
            'short_description' => 'Plan Intermedio',
            'description' => 'Ideal para comercios, roticerias, y bares',
            'category' => '10',
            'level' => '13',
            'product' => '100',
            'user' => '2',
            'suggestion' => '3',
            'tag' => '2',
            'status' => '1',
        ]);
        Membership::create([
            'name' => 'Platinium',
            'slug' => Str::slug('Platinium'),
            'price' => 7000,
            'short_description' => 'Plan Completo',
            'description' => 'Util para mostrar toda la amplia gama de productos y variedades de tu comercio',
            'category' => '20',
            'level' => '50',
            'product' => '500',
            'user' => '5',
            'suggestion' => '10',
            'tag' => '2',
            'status' => '1',
        ]);
    }
}
