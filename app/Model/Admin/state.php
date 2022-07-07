<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    
    protected $table="state";
    public $timestamps = false;
    protected $primaryKey='PK';
    protected $fillable = [
        'PK', 'State'
    ];
}
