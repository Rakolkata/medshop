<?php

use Faker\Generator as Faker;

$factory->define(App\Model\CurrentAssetMaster::class, function (Faker $faker) {
    return [
        'account_name' => 'HDFC BANK',
        'account_under' => 'ABCD',
        'bank_acc_holder' => 'SANDEEP DUBEY',
        'bank_branch'=> 'SOUTH EXT',
        'bank_ifsc' => 'IFSC0001',
        'bank_acc_no' => $faker->numberBetween(200000,3000000),
        'bank_address'=> '204 JANAK CINEMA ,COMMUNITY CENTER,BLOCK -C,NEW DELHI-110049',
    ];
});
