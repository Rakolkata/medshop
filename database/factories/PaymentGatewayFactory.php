<?php

use Faker\Generator as Faker;

$factory->define(App\Model\PaymentGateway::class, function (Faker $faker) {
     return [
        'cust_id' => $faker->numberBetween(1,100),
        'cust_id' => '1',
        'customer_code' => $faker->word,
        'inv_id'=>$faker->numberBetween(1,100),
        'tally_inv_no' => $faker->word,
        'ledger_name'=> $faker->name,
        'account_name' => $faker->name,
        'amount' => $faker->numberBetween(500,5000),
        'tran_type'=> 'electronic',
        'bank_name'=> 'HDFC BANK',
        'tran_number' => $faker->unique($reset = true)->randomDigitNotNull,
        'trans_remarks'=> 'NARRATION OF ONLINE PAYMENT',
        'date' => now(),
    ];
});
