<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seo::create([
            'keywords' => 'Logistics, Transportation, Cargo',
            'description' => 'This is a website for logistics and transportation company.'
        ]);
    }
}
