<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::query()->create([
            'image' => 'partners/freighter.png',
            'name' => 'freighter',
        ]);
        Partner::query()->create([
            'image' => 'partners/statbook.png',
            'name' => 'statbook',
        ]);
        Partner::query()->create([
            'image' => 'partners/uzum.png',
            'name' => 'uzum',
        ]);
    }
}
