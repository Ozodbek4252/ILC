<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::create([
            'name' => 'Ozodbek',
            'phone' => '998998989898',
            'email' => 'ozodbek@gmail.com',
            'message' => 'Hello, I am Ozodbek'
        ]);

        Request::create([
            'name' => 'Ozodbek',
            'phone' => '998998989898'
        ]);

        Request::create([
            'name' => 'Kim',
            'phone' => '998901233412',
            'email' => 'kim@gmail.com',
            'message' => 'Hello, I am Kim'
        ]);
    }
}
