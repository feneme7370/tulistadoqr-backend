<?php

namespace Database\Seeders;

use App\Models\Page\Suggestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Suggestion::create([
            'product_id' => 2,
            'company_id' => 2,
            'user_id' => 2,
        ]);
        Suggestion::create([
            'product_id' => 8,
            'company_id' => 2,
            'user_id' => 2,
        ]);
        Suggestion::create([
            'product_id' => 3,
            'company_id' => 2,
            'user_id' => 2,
        ]);
        Suggestion::create([
            'product_id' => 12,
            'company_id' => 2,
            'user_id' => 2,
        ]);
    }
}
