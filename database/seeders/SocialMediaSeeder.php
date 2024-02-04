<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Page\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialMedia::create([
            'name' => 'Facebook',
            'slug' => Str::slug('Facebook'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Twitter',
            'slug' => Str::slug('Twitter'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Youtube',
            'slug' => Str::slug('Youtube'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Instagram',
            'slug' => Str::slug('Instagram'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Tiktok',
            'slug' => Str::slug('Tiktok'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Telegram',
            'slug' => Str::slug('Telegram'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Github',
            'slug' => Str::slug('Github'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Whatsapp',
            'slug' => Str::slug('Whatsapp'),
            'user_id' => '1',
            'company_id' => '1',
        ]);
    }
}
