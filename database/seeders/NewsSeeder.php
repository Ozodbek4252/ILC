<?php

namespace Database\Seeders;

use App\Models\Lang;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news1 = News::create([
            'image' => 'news/news1.png',
            'is_published' => true,
            'seo_keywords' => 'news, company, logistics, TransFleet',
            'seo_description' => 'ILC Logistics, a leading company in the logistics sector, today announced the launch of its new innovative Transport Management System (TMS). This system, named "TransFleet", is developed using advanced technologies and algorithms to optimize and simplify the entire transportation process.',
        ]);

        // Ru Translation for news1
        $news1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Последние обновления нашей компании',
            'column_name' => 'title',
        ]);
        $news1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'ILC Logistics, ведущая компания в сфере логистики, сегодня объявила о запуске своей новой инновационной системы управления грузоперевозками (Transport Management System - TMS). Эта система, названная "TransFleet", разработана с использованием передовых технологий и алгоритмов, чтобы оптимизировать и упростить весь процесс грузоперевозок.',
            'column_name' => 'text',
        ]);

        // Uz Translation for news1
        $news1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Bizning kompaniyamizning so‘nggi yangilanishlari',
            'column_name' => 'title',
        ]);
        $news1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'ILC Logistics, logistika sohasida rivojlanayotgan kompaniyalar birligida, bugun g‘oz yashirgan yangi transportni boshqarish tizimini (Transport Management System - TMS) ishga tushirish haqida e‘lon qildi. Ushbu tizim, "TransFleet" deb nomlangan, yuqori texnologiyalardan va algoritmlardan foydalanib, barcha transport vositalarini boshqarish jarayonini optimallashtirish va osonlashtirish maqsadida ishlab chiqilgan.',
            'column_name' => 'text',
        ]);

        $news2 = News::create([
            'image' => 'news/news2.png',
            'is_published' => false,
            'seo_keywords' => 'news, company, logistics, TransFleet',
            'seo_description' => 'ILC Logistics, a leading company in the logistics sector, today announced the launch of its new innovative Transport Management System (TMS). This system, named "TransFleet", is developed using advanced technologies and algorithms to optimize and simplify the entire transportation process.',
        ]);

        // Ru Translation for news2
        $news2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Мнения наших специалистов',
            'column_name' => 'title',
        ]);
        $news2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => '"Мы гордимся представлением нашей новой системы управления грузоперевозками TransFleet", - сказал Иван Петров, генеральный директор ILC Logistics. "TransFleet открывает новые возможности для наших клиентов, обеспечивая им более эффективное и прозрачное управление их грузоперевозками. Мы уверены, что это станет ключевым конкурентным преимуществом для наших партнеров".',
            'column_name' => 'text',
        ]);

        // Uz Translation for news2
        $news2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Bizning mutaxassislarimizning fikrlari',
            'column_name' => 'title',
        ]);
        $news2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => '"Biz yangi TransFleet transportni boshqarish tizimimizni taqdim etishdan fakhr duyamiz", - dedi ILC Logistics bosh direktori Ivan Petrov. "TransFleet mijozlarimiz uchun yangi imkoniyatlar ochadi, ularning transport vositalarini samaraliroq va shaffofroq boshqarishini ta’minlash. Biz, bu, bizning sheriklarimiz uchun asosiy raqobatbaho afzallik bo‘lishini ta’minlaymiz", - dedi u.',
            'column_name' => 'text',
        ]);

        $news3 = News::create([
            'image' => 'news/news3.png',
            'is_published' => true,
            'seo_keywords' => 'news, company, logistics, TransFleet',
            'seo_description' => 'ILC Logistics plans to implement the TransFleet system step by step over the next few months, starting with large clients and gradually expanding its use to the entire client base of the company.',
        ]);

        // Ru Translation for banner3
        $news3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Внедрение системы TransFleet',
            'column_name' => 'title',
        ]);
        $news3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'ILC Logistics планирует поэтапное внедрение системы TransFleet в течение следующих нескольких месяцев, начиная с крупных клиентов и постепенно расширяя ее использование на всю клиентскую базу компании.',
            'column_name' => 'text',
        ]);

        // Uz Translation for banner3
        $news3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'TransFleet tizimini qo‘llash',
            'column_name' => 'title',
        ]);
        $news3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'ILC Logistics keyingi bir necha oy davomida TransFleet tizimini bosqichma-bosqich qo‘llashni rejalashtiradi, boshlang‘ich mijozlar bilan boshlab va keyinchalik uni kompaniyaning barcha mijozlar bazasiga kengaytirib boradi.',
            'column_name' => 'text',
        ]);

    }
}
