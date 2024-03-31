<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Lang;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = About::create([
            'background_image' => 'about/back.png',
            'sec1_image' => 'about/sec1.png',
            'sec2_image' => 'about/sec2.png',
        ]);

        // Ru Translation for about
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'О компании',
            'column_name' => 'title',
        ]);
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Эффективная и надежная транспортировка ваших грузов ',
            'column_name' => 'sub_title',
        ]);
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Наша компания по логистике специализируется в основном на связях с Китаем и международной авиа и авто логистике. Мы предлагаем широкий спектр услуг, включая форвардинг, проверку и упаковку грузов. Наша команда профессионалов стремится обеспечить эффективную и безопасную транспортировку грузов по всему миру.
            Мы гордимся нашим сотрудничеством с аналитической компанией Statbook, которая обеспечивает нам ценную информацию и анализ данных для наших клиентов. Это позволяет нам предлагать нашим клиентам наилучшие решения и повышать эффективность их поставок.
            Также мы являемся партнерами крупной авиа логистической компании MyFreighter, что позволяет нам обеспечивать высокий уровень сервиса и доступ к широкой сети международных перевозок. Благодаря этому партнерству мы можем предложить нашим клиентам надежное и быстрое доставки грузов по всему миру.',
            'column_name' => 'sec1_description',
        ]);
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Наша цель — облегчить процесс таможенного оформления и сделать его максимально простым и эффективным для вашего бизнеса. ',
            'column_name' => 'sec2_description',
        ]);

        // Uz Translation for about
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Biz haqimizda',
            'column_name' => 'title',
        ]);
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Sizning yuklaringizni samarali va ishonchli transportlash',
            'column_name' => 'sub_title',
        ]);
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Bizning logistika kompaniyamiz asosan Xitoy bilan aloqalarni va xalqaro aviava va avto logistikaga asoslangan. Biz forwardlash, yuklarni tekshirish va qadoqlash kabi xizmatlarni taklif etamiz. Bizning professional jamoamiz dunyoning har qaysi joyiga samarali va xavfsiz yuklarni transport qilishni ta\'minlashga intiladi.
            Biz Statbook analitik kompaniyasi bilan hamkorlik qilishimizdan foydalanib, bu bizga mijozlarimiz uchun qimmatbaho ma\'lumotlar va ma\'lumotlarni tahlil qilish imkonini beradi. Bu bizga mijozlarimizga eng yaxshi yechimlarni taklif qilish va ularning taminotlarini samaraliroq qilishga imkon beradi.
            Biz katta aviava logistika kompaniyasi MyFreighter hamkorlari bo\'lib, bu bizga yuqori darajadagi xizmat va xalqaro transport tarmog\'iga kirish imkonini beradi. Ushbu hamkorlik orqali biz mijozlarimizga dunyoning har qaysi joyiga ishonchli va tezkor yuklarni etkazib berish imkonini taklif qilishimiz mumkin.',
            'column_name' => 'sec1_description',
        ]);
        $about->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Bizning maqsadimiz - soliqqa tayyorlash jarayonini yengillashtirish va uningni biznesingiz uchun maksimal oson va samarali qilish.',
            'column_name' => 'sec2_description',
        ]);
    }
}
