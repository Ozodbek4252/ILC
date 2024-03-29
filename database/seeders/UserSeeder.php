<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ozodbek',
            'email' => 'ozodbek@gmail.com',
            'password' => bcrypt('ozodbek1111')
        ]);
    }
}
