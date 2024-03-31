<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Lang;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact1 = Contact::create([
            'phone' => '+998 99 999 99 99',
            'email' => 'usoft@gmail.com',
        ]);

        // Ru Translation for contact1
        $contact1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'C понедельника по пятницу 9:00—18:00',
            'column_name' => 'schedule',
        ]);
        $contact1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Ташкент, Мирабадский район, Ойбек 38',
            'column_name' => 'address',
        ]);

        // Uz Translation for contact1
        $contact1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Dushanbadan jumagacha 9:00—18:00',
            'column_name' => 'schedule',
        ]);
        $contact1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Toshkent, Mirabad tumani, Oybek 38',
            'column_name' => 'address',
        ]);
    }
}
