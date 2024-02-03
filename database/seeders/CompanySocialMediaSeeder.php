<?php

namespace Database\Seeders;

use App\Models\Page\CompanySocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanySocialMedia::create([
            'company_id' => '1',
            'social_media_id' => '2',
            'url' => 'www.twitter.com',
        ]);
        CompanySocialMedia::create([
            'company_id' => '1',
            'social_media_id' => '1',
            'url' => 'www.facebook.com',
        ]);
        CompanySocialMedia::create([
            'company_id' => '1',
            'social_media_id' => '3',
            'url' => 'www.youtube.com',
        ]);
        CompanySocialMedia::create([
            'company_id' => '1',
            'social_media_id' => '4',
            'url' => 'www.instagram.com',
        ]);

        CompanySocialMedia::create([
            'company_id' => '2',
            'social_media_id' => '2',
            'url' => 'www.twitter.com',
        ]);
        CompanySocialMedia::create([
            'company_id' => '2',
            'social_media_id' => '1',
            'url' => 'www.facebook.com',
        ]);
        CompanySocialMedia::create([
            'company_id' => '2',
            'social_media_id' => '3',
            'url' => 'www.youtube.com',
        ]);
        CompanySocialMedia::create([
            'company_id' => '2',
            'social_media_id' => '4',
            'url' => 'www.instagram.com',
        ]);
    }
}
