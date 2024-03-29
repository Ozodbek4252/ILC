<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lang::query()->create([
            'code' => 'uz',
            'name' => 'O\'zbekcha',
            'icon' => 'assets/images/flags/Custom-Icon-Design-All-Country-Flag-Uzbekistan-Flag.256.png',
            'is_published' => true,
        ]);

        Lang::query()->create([
            'code' => 'ru',
            'name' => 'Русский',
            'icon' => 'assets/images/flags/Custom-Icon-Design-All-Country-Flag-Russia-Flag.256.png',
            'is_published' => true,
        ]);

        Lang::query()->create([
            'code' => 'en',
            'name' => 'English',
            'icon' => 'assets/images/flags/Icons-Land-Vista-Flags-English-Language-Flag-1.256.png',
            'is_published' => true,
        ]);
    }
}
