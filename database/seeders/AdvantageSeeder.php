<?php

namespace Database\Seeders;

use App\Models\Advantage;
use App\Models\Icon;
use App\Models\Lang;
use Illuminate\Database\Seeder;

class AdvantageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advantage1 = Advantage::create([
            'icon_id' => Icon::where('name', 'percent')->first()?->id,
        ]);

        // Ru Translation for advantage1
        $advantage1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Выгодная цена',
            'column_name' => 'title',
        ]);
        $advantage1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Наши клиенты экономят средства благодаря выгодным ценам и получают качественные услуги без переплаты.',
            'column_name' => 'description',
        ]);

        // Uz Translation for advantage1
        $advantage1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Sifat kafolati',
            'column_name' => 'title',
        ]);
        $advantage1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Biz barcha xizmatlarimiz va mahsulotlarimiz uchun kafolat beramiz',
            'column_name' => 'description',
        ]);


        $advantage2 = Advantage::create([
            'icon_id' => Icon::where('name', 'support')->first()?->id,
        ]);

        // Ru translations for advantage2
        $advantage2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Качественный сервис',
            'column_name' => 'title',
        ]);
        $advantage2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Мы предоставляем оперативное реагирование на запросы и индивидуальный подход к каждому клиенту',
            'column_name' => 'description',
        ]);

        // Uz Translation for advantage2
        $advantage2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Yaxshi xizmat',
            'column_name' => 'title',
        ]);
        $advantage2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Biz so\'rovlarga tez va individual yondashuv bilan javob beramiz',
            'column_name' => 'description',
        ]);


        $advantage3 = Advantage::create([
            'icon_id' => Icon::where('name', 'delivery')->first()?->id,
        ]);

        // Ru translations for advantage3
        $advantage3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Быстрая доставка',
            'column_name' => 'title',
        ]);
        $advantage3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Мы осуществляем оперативную обработку заказов и выбираем оптимальные маршруты доставки для получения товаров в кратчайшие сроки',
            'column_name' => 'description',
        ]);

        // Uz Translation for advantage3
        $advantage3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Tezkor yetkazib berish',
            'column_name' => 'title',
        ]);
        $advantage3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Biz buyurtmalar tezroq ishlashini ta\'minlaymiz va tovarlarni qisqa muddatda olish uchun optimal yetkazib berish yo\'nalishlarini tanlaymiz',
            'column_name' => 'description',
        ]);
    }
}
