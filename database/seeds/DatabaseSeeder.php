<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Carlos Mario',
            'last_name' => 'Jimenez',
            'email' => 'carlos@gmail.com',
            'identification' => '123456789',
            'password' => bcrypt('password'),
            'phone' => '3017729843',
        ]);
    }
}
