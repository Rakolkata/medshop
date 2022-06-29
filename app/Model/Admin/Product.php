<?php

namespace App\model\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table="batch";
    protected $primaryKey='id';
    protected $fillable=[
        'id','product_name','quantity','description','status'
    ];
}
