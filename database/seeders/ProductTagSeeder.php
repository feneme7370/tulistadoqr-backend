<?php

namespace Database\Seeders;

use App\Models\Page\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductTag::factory(120)->create();
    }
}
