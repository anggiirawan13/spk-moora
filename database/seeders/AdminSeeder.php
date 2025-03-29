<?php

namespace Database\Seeders;

use \App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'aldi',
            'email' => 'aldi@gmail.com',
            'image_name' => '',
            'password' => bcrypt('Aldi1234'),
            'is_admin' => 1,
        ]);

        User::create([
            'name' => 'adam',
            'email' => 'adam@gmail.com',
            'image_name' => '',
            'password' => bcrypt('Adam1234'),
            'is_admin' => 0,
        ]);
    }
}
