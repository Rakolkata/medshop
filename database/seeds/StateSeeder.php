<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\Admin\state;


class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $states = [        
            ['state' =>'Andhra Pradesh'], 
            ['state' =>'Arunachal Pradesh'],
            ['state' =>'Assam'],            
            ['state' =>'Bihar'],
            ['state' =>'Chhattisgarh'], 
            ['state' =>'Goa'],
            ['state' =>'Gujarat'],            
            ['state' =>'Haryana'],
            ['state' =>'Himachal Pradesh'], 
            ['state' =>'Jharkhand'],
            ['state' =>'Karnataka'],            
            ['state' =>'Kerala'],
            ['state' =>'Madhya Pradesh'], 
            ['state' =>'Maharashtra'],
            ['state' =>'Manipur'],            
            ['state' =>'Meghalaya'],
            ['state' =>'Mizoram'], 
            ['state' =>'Nagaland'],
            ['state' =>'Odisha'],            
            ['state' =>'Punjab'],
            ['state' =>'Rajasthan'], 
            ['state' =>'Sikkim'],
            ['state' =>'Tamil Nadu'],            
            ['state' =>'Telangana'],
            ['state' =>'Tripura'], 
            ['state' =>'Uttarakhand'],
            ['state' =>'Uttar Pradesh'],            
            ['state' =>'West Bengal']
      ];

         foreach($states as $state)
        {
            state::create($state);
        }
    }
}
