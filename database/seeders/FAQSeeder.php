<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faq1 = FAQ::create();

        // Ru Translation for faq1
        $faq1->translations()->create([
            'lang_id' => 1,
            'content' => 'Ташкент',
            'column_name' => 'answer',
        ]);
        $faq1->translations()->create([
            'lang_id' => 1,
            'content' => 'Что такое столица Узбекистана?',
            'column_name' => 'question',
        ]);

        // Uz Translation for faq1
        $faq1->translations()->create([
            'lang_id' => 2,
            'content' => 'Toshkent',
            'column_name' => 'answer',
        ]);
        $faq1->translations()->create([
            'lang_id' => 2,
            'content' => 'O\'zbekiston poytaxti qaysi shahar?',
            'column_name' => 'question',
        ]);


        $faq2 = FAQ::create();

        // Ru Translation for faq2
        $faq2->translations()->create([
            'lang_id' => 1,
            'content' => 'Какой срок доставки?',
            'column_name' => 'question',
        ]);
        $faq2->translations()->create([
            'lang_id' => 1,
            'content' => 'Срок доставки зависит от маршрута транспортировки, вида транспорта и от того, будет ли это полная загрузка или частичная: Европа - Узбекистан 20-25 дней; Россия - Узбекистан 10-14 дней; Китай - Узбекистан 25-30 дней.',
            'column_name' => 'answer',
        ]);

        // Uz Translation for faq2
        $faq2->translations()->create([
            'lang_id' => 2,
            'content' => 'Yetkazib berish muddati qancha?',
            'column_name' => 'question',
        ]);
        $faq2->translations()->create([
            'lang_id' => 2,
            'content' => 'Yetkazib berish muddati yo\'l yo\'nalishi, transport turi va to\'liq yoki qisman yuklanishiga qarab o\'zgaradi: Yevropa - O\'zbekiston 20-25 kun; Rossiya - O\'zbekiston 10-14 kun; Xitoy - O\'zbekiston 25-30 kun.',
            'column_name' => 'answer',
        ]);

        $faq3 = FAQ::create();

        // Ru Translation for faq3
        $faq3->translations()->create([
            'lang_id' => 1,
            'content' => 'Какие документы нужны для таможенного оформления?',
            'column_name' => 'question',
        ]);
        $faq3->translations()->create([
            'lang_id' => 1,
            'content' => 'Для таможенного оформления необходимы следующие документы: 1. Коммерческий счет-фактура; 2. Счет-фактура; 3. Пакинг-лист; 4. Декларация; 5. Сертификаты качества; 6. Сертификаты соответствия; 7. Договор; 8. Транспортные документы; 9. Доверенность на таможенное оформление; 10. Документы, подтверждающие стоимость товара.',
            'column_name' => 'answer',
        ]);

        // Uz Translation for faq3
        $faq3->translations()->create([
            'lang_id' => 2,
            'content' => 'Nima uchun maxsulotlar uchun maxsulotlar uchun qanday hujjatlar kerak?',
            'column_name' => 'question',
        ]);
        $faq3->translations()->create([
            'lang_id' => 2,
            'content' => 'Maxsulotlar uchun maxsulotlar uchun quyidagi hujjatlar kerak: 1. Savdo hisob-faktura; 2. Hisob-faktura; 3. Paket ro\'yxati; 4. Deklaratsiya; 5. Sifat sertifikatlari; 6. Mos kelish sertifikatlari; 7. Shartnoma; 8. Transport hujjatlari; 9. Max susiyati uchun maxsulotlar; 10. Maxsulot narxini tasdiqlovchi hujjatlar.',
            'column_name' => 'answer',
        ]);
    }
}
