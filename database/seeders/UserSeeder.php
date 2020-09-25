<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Admin Demo',
            'email' => 'admin@demo.com',
            'password' => \Hash::make('demo'),
        ]);
    }
}
