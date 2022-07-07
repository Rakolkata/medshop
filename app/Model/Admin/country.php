<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table="country";
     protected $primaryKey='PK';
     public $timestamps = false;
     protected $fillable=[
        'PK', 'country','countryCode'
    ];
}
