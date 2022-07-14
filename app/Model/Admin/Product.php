<?php

namespace App\model\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table="product";
    protected $primaryKey='id';
    protected $fillable=[
        'id','gematricName','brand',' title','stock','quantity','price','sellPrice','description','image'
       ];
}
