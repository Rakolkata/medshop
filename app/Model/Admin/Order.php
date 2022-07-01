<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="order";
    protected $primaryKey='id';
    protected $fillable=[
        'id','gematricName','brand',' title','stock','quantity','price','sellPrice','description'
       ];
}
