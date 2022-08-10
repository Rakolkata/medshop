<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $table="cart";
     protected $primaryKey='id';
     protected $fillable=['id','user_id','product_id','quantity','total_price'];
}
