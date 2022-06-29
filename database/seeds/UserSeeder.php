<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
//use App\Model\Admin\Admin;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'User',
            'user_id'=>'1',
            'user_name'=>'abc',
            'password'=>bcrypt('User@123'),
            'mobile'=>'',
            'email'=>'user@gmail.com',
            'alternate_email'=>'',
            'email_verified_at'=>'2022-06-21 22:23:18',
            'emp_code'=>'',
            'designation'=>'',
            'address'=>'',
            'country'=>'',
            'state'=>'',
            'pincode'=>'',
            'image'=>'',
            'user_type'=>'user',
            'designation_hierarchy'=>'',      
     ]);
    }
}
