<?php

namespace Database\Seeders;

use App\Models\Icon;
use App\Models\Lang;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service1 = Service::create([
            'link' => 'https://www.google.com',
            'icon_id' => Icon::where('name', 'truck-check')->first()?->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()?->id,
            'image' => 'services/1.png',
        ]);

        // Ru Translation for service1
        $service1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Логистика',
            'column_name' => 'name',
        ]);
        $service1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Доставим грузы из любой точки мира быстро и качественно',
            'column_name' => 'description',
        ]);

        // Uz Translation for service1
        $service1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Logistika',
            'column_name' => 'name',
        ]);
        $service1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Biz dunyoning har qanday nuqtasidan yuklarni tez va sifatli yetkazib beramiz',
            'column_name' => 'description',
        ]);

        $service2 = Service::create([
            'link' => 'https://www.google.com',
            'icon_id' => Icon::where('name', 'secure')->first()?->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()?->id,
            'image' => 'services/2.png',
        ]);

        // Ru Translation for service2
        $service2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Страховка груза',
            'column_name' => 'name',
        ]);
        $service2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Обеспечим безопасность и защиту товара во время перевозок',
            'column_name' => 'description',
        ]);

        // Uz Translation for service2
        $service2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Yukni sugurtalash',
            'column_name' => 'name',
        ]);
        $service2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Yuklarni yetkazib berish jarayonida tovarni himoyalash va himoya qilishni ta\'minlaymiz',
            'column_name' => 'description',
        ]);

        $service3 = Service::create([
            'link' => 'https://www.google.com',
            'icon_id' => Icon::where('name', 'checking')->first()?->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()?->id,
            'image' => 'services/3.png',
        ]);

        // Ru Translation for service3
        $service3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Проверка груза',
            'column_name' => 'name',
        ]);
        $service3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Проверим груз на целостность и соответствии заказу перед отправкой',
            'column_name' => 'description',
        ]);

        // Uz Translation for service3
        $service3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Yukni tekshirish',
            'column_name' => 'name',
        ]);
        $service3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Yukni jo\'natishdan oldin tovarni butunligini va buyurtmaga mosligini tekshiramiz',
            'column_name' => 'description',
        ]);

        $service4 = Service::create([
            'link' => 'https://www.google.com',
            'icon_id' => Icon::where('name', 'box')->first()?->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()?->id,
            'image' => 'services/4.png',
        ]);

        // Ru Translation for service4
        $service4->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Упаковка',
            'column_name' => 'name',
        ]);
        $service4->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Качественно упаковываем товары для безопасной и надежной перевозки',
            'column_name' => 'description',
        ]);

        // Uz Translation for service4
        $service4->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Qadoqlash',
            'column_name' => 'name',
        ]);
        $service4->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Tovarlarimizni xavfsiz va ishonchli yetkazish uchun sifatli qadoqlaymiz',
            'column_name' => 'description',
        ]);

        $service5 = Service::create([
            'link' => 'https://www.google.com',
            'icon_id' => Icon::where('name', 'consalting')->first()?->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()?->id,
            'image' => 'services/5.png',
        ]);

        // Ru Translation for service5
        $service5->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Консалтинг',
            'column_name' => 'name',
        ]);
        $service5->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Проводим анализ бизнес-процессов и разрабатываем эффективные стратегии ',
            'column_name' => 'description',
        ]);

        // Uz Translation for service5
        $service5->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Konsalting',
            'column_name' => 'name',
        ]);
        $service5->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Biznes jarayonlarini tahlil qilamiz va samarali strategiyalar ishlab chiqamiz',
            'column_name' => 'description',
        ]);

    }
}
