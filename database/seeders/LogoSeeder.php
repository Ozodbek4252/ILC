<?php

namespace Database\Seeders;

use App\Models\Logo;
use Illuminate\Database\Seeder;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Logo::create([
            'main_logo' => 'assets/images/logo/main_logo_1711742069.png',
            'small_logo' => 'assets/images/logo/small_logo_1711742069.png',
        ]);
    }
}
