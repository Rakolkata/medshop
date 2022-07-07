<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\Admin\country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $countries =  [
            ['country'=>'Afghanistan'], 
            ['country'=>'Albania'],
            ['country'=>'Algeria'],            
            ['country'=>'Angola'],
            ['country'=>'Antigua'], 
            ['country'=>'Argentina'],
            ['country'=>'Armenia'],            
            ['country'=>'Australia'],
            ['country'=>'Austria'], 
            ['country'=>'Bahamas'],
            ['country'=>'Bahrain'],            
            ['country'=>'Bangladesh'],
            ['country'=>'Belarus'], 
            ['country'=>'Belgium'],
            ['country'=>'Belize'],            
            ['country'=>'Bhutan'],
            ['country'=>'Cambodia'], 
            ['country'=>'Cameroon'],
            ['country'=>'Canada'],            
            ['country'=>'China'],
            ['country'=>'Pakistan'],
            ['country'=>'South Africa'],
            ['country'=>'Sri Lanka'],            
            ['country'=>'South Africa'],
            ['country'=>'United Kingdom'], 
            ['country'=>'India'],
            ['country'=>'Japan'],            
            ['country'=>'Nepal'],
            ['country'=>'Iran'],
            ['country'=>'Italy'],            
            ['country'=>'South Sudan'],
            ['country'=>'United Kingdom'], 
            ['country'=>'Zambia'],
            ['country'=>'Sweden'],            
            ['country'=>'Myanmar'],
        ];

        foreach($countries as $country)
        {
            country::create($country);
        }
    }
    
}
