<?php

namespace Database\Seeders;

use App\Models\Page\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tag::factory(30)->create();
        Tag::create([
            'name' => 'Verano 23/24',
            'slug' => Str::slug('Verano 23/24'),
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Tag::create([
            'name' => 'Salados',
            'slug' => Str::slug('Nuevos'),
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Tag::create([
            'name' => 'Ofertas',
            'slug' => Str::slug('Ofertas'),
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Tag::create([
            'name' => 'Calentitos',
            'slug' => Str::slug('Calentitos'),
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Tag::create([
            'name' => 'Familiar',
            'slug' => Str::slug('Familiar'),
            'user_id' => 2,
            'company_id' => 2,
        ]);
        Tag::create([
            'name' => 'Dulces',
            'slug' => Str::slug('Dulces'),
            'user_id' => 2,
            'company_id' => 2,
        ]);
    }
}
