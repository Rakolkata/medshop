<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\User;
use Hash;
class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
            'name' => 'Admin',
            'email' => 'admin',
            'password' => Hash::make('123'),
            'type' => 1
        ]
            );
    }
}
