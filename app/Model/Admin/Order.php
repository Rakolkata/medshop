<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="orderdetails";
    protected $primaryKey='id';
    protected $fillable=[
        'id','customerName','orderId',' orderNumber','productId','productName','price','quantity','totalPrice','paymentMode','deliveryDate','deliveryNote'
       ];
}
