<?php

namespace Database\Seeders;

use App\Models\User;
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
            'id' => 1,
            'name' => 'Admin Demo',
            'email' => 'admin@demo.com',
            'password' => \Hash::make('demo'),
        ]);

        User::find(1)->assignRole('admin');
    }
}
