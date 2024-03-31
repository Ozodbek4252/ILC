<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Icon::create([
            'name' => 'box',
            'icon' => 'icons/box.png',
        ]);
        Icon::create([
            'name' => 'check',
            'icon' => 'icons/check.png',
        ]);
        Icon::create([
            'name' => 'checking',
            'icon' => 'icons/checking.png',
        ]);
        Icon::create([
            'name' => 'consalting',
            'icon' => 'icons/consalting.png',
        ]);
        Icon::create([
            'name' => 'delivery',
            'icon' => 'icons/delivery.png',
        ]);
        Icon::create([
            'name' => 'percent',
            'icon' => 'icons/percent.png',
        ]);
        Icon::create([
            'name' => 'plane',
            'icon' => 'icons/plane.png',
        ]);
        Icon::create([
            'name' => 'secure',
            'icon' => 'icons/secure.png',
        ]);
        Icon::create([
            'name' => 'support',
            'icon' => 'icons/support.png',
        ]);
        Icon::create([
            'name' => 'team',
            'icon' => 'icons/team.png',
        ]);
        Icon::create([
            'name' => 'truck-check',
            'icon' => 'icons/truck-check.png',
        ]);
        Icon::create([
            'name' => 'truck',
            'icon' => 'icons/truck.png',
        ]);
        Icon::create([
            'name' => 'Telegram',
            'icon' => 'icons/tg.png',
        ]);
        Icon::create([
            'name' => 'Instagram',
            'icon' => 'icons/insta.png',
        ]);
        Icon::create([
            'name' => 'X',
            'icon' => 'icons/x.png',
        ]);
    }
}
