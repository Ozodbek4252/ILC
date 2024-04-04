<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LangSeeder::class,
            LogoSeeder::class,
            IconSeeder::class,
            ContactSeeder::class,
            AboutSeeder::class,
            SeoSeeder::class,

            BannerSeeder::class,
            PartnerSeeder::class,
            RequestSeeder::class,
            FAQSeeder::class,
            NewsSeeder::class,
            AdvantageSeeder::class,
            ServiceSeeder::class,
            CounterSeeder::class,
            TariffSeeder::class,
            SocialSeeder::class,
        ]);
    }
}
