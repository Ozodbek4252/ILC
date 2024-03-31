<?php

namespace Database\Seeders;

use App\Models\Icon;
use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Social::create([
            'name' => 'Instagram',
            'link' => 'https://www.instagram.com/',
            'icon_id' => Icon::where('name', 'Instagram')->first()->id,
        ]);

        Social::create([
            'name' => 'Telegram',
            'link' => 'https://www.telegram.org/',
            'icon_id' => Icon::where('name', 'Telegram')->first()->id,
        ]);

        Social::create([
            'name' => 'X',
            'link' => 'https://www.x.com/',
            'icon_id' => Icon::where('name', 'X')->first()->id,
        ]);
    }
}
