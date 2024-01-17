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
            'category' => '3',
            'level' => '5',
            'product' => '10',
            'user' => '1',
            'suggestion' => '1',
            'status' => '1',
        ]);
        Membership::create([
            'name' => 'Gold',
            'slug' => Str::slug('Gold'),
            'category' => '10',
            'level' => '13',
            'product' => '100',
            'user' => '2',
            'suggestion' => '3',
            'status' => '1',
        ]);
        Membership::create([
            'name' => 'Platinium',
            'slug' => Str::slug('Platinium'),
            'category' => '20',
            'level' => '50',
            'product' => '500',
            'user' => '5',
            'suggestion' => '10',
            'status' => '1',
        ]);
    }
}
