<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Lang;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banner1 = Banner::query()->create([
            'file' => 'banners/banner-video-1.mp4',
            'type' => 'video',
            'file_type' => 'video/mp4',
            'is_published' => true,
        ]);

        // Ru Translation for banner1
        $banner1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Грузоперевозки по всему миру',
            'column_name' => 'title',
        ]);
        // Uz Translation for banner1
        $banner1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Dunyoning har qanday joyiga yuk tashish',
            'column_name' => 'title',
        ]);

        $banner2 = Banner::query()->create([
            'file' => 'banners/banner-image-1.jpg',
            'type' => 'image',
            'is_published' => false,
        ]);

        // Ru Translation for banner2
        $banner2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Грузоперевозки по всему миру 2',
            'column_name' => 'title',
        ]);

        //There is no uz translation for banner2
    }
}
