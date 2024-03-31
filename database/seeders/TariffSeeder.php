<?php

namespace Database\Seeders;

use App\Models\Icon;
use App\Models\Lang;
use App\Models\Tariff;
use Illuminate\Database\Seeder;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tariff1 = Tariff::create([
            'icon_id' => Icon::where('name', 'plane')->first()->id,
            'price' => '$10',
            'link' => 'https://example.com',
        ]);

        // Ru Translation for tariff1
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Авиадоставка',
            'column_name' => 'name',
        ]);
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'кг',
            'column_name' => 'unit',
        ]);
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => '3-10 дней',
            'column_name' => 'delivery_time',
        ]);
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => '2 раза в неделю (ВТ-ЧТ)',
            'column_name' => 'schedule',
        ]);

        // Uz Translation for tariff1
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Aviayuborish',
            'column_name' => 'name',
        ]);
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'kg',
            'column_name' => 'unit',
        ]);
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => '3-10 kun',
            'column_name' => 'delivery_time',
        ]);
        $tariff1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'haftada 2 marta (Seshanba, Payshanba)',
            'column_name' => 'schedule',
        ]);


        $tariff2 = Tariff::create([
            'icon_id' => Icon::where('name', 'truck')->first()->id,
            'price' => '$8',
            'link' => 'https://example.com',
        ]);

        // Ru Translation for tariff2
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Автодоставка',
            'column_name' => 'name',
        ]);
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'кг',
            'column_name' => 'unit',
        ]);
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => '7-20 дней',
            'column_name' => 'delivery_time',
        ]);
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => '1 раз в неделю (ВТ)',
            'column_name' => 'schedule',
        ]);

        // Uz Translation for tariff2
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Avtomobil yuborish',
            'column_name' => 'name',
        ]);
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'kg',
            'column_name' => 'unit',
        ]);
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => '7-20 kun',
            'column_name' => 'delivery_time',
        ]);
        $tariff2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'haftada 1 marta (Seshanba)',
            'column_name' => 'schedule',
        ]);
    }
}
