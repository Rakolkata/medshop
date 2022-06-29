<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class mainPageController extends Controller
{
    public function  welcomeindex()
    {
        //$SubscriptionData= companyregisters::where('is_primary',1)->first();
        return view('welcome');
    }
}
