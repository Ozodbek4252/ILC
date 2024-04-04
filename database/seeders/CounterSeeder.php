<?php

namespace Database\Seeders;

use App\Models\Counter;
use App\Models\Icon;
use App\Models\Lang;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $counter1 = Counter::create([
            'icon_id' => Icon::where('name', 'team')->first()->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()->id,
            'number' => '50',
        ]);

        // Ru Translation for counter1
        $counter1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Человек в нашей команде',
            'column_name' => 'text',
        ]);

        // Uz Translation for counter1
        $counter1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Bizning jamoamizda odam',
            'column_name' => 'text',
        ]);

        $counter2 = Counter::create([
            'icon_id' => Icon::where('name', 'check')->first()->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()->id,
            'number' => '300',
        ]);

        // Ru Translation for counter2
        $counter2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Успешных заказов',
            'column_name' => 'text',
        ]);

        // Uz Translation for counter2
        $counter2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Muvaffaqiyatli buyurtmalar',
            'column_name' => 'text',
        ]);

        $counter3 = Counter::create([
            'icon_id' => Icon::where('name', 'truck')->first()->id,
            'secondary_icon_id' => Icon::where('name', 'check_white')->first()->id,
            'number' => '15',
        ]);

        // Ru Translation for counter3
        $counter3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Автомобилей',
            'column_name' => 'text',
        ]);

        // Uz Translation for counter3
        $counter3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Avtomobillar',
            'column_name' => 'text',
        ]);
    }
}
