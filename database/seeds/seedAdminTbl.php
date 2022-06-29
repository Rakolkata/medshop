<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Model\Admin\Admin;

class seedAdminTbl extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'mobile'=>'',
            'password'=>bcrypt('Admin@123'),
            'address'=>'Ranchi',
            'state'=>'Jharkhand',
            'pincode'=>'',
            'image'=>'',
            'is_super'=>'1'         
     ]);
    }
}
