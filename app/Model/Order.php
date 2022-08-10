<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $table = 'orders';
     protected $primaryKey='id';
     protected $fillable = [
        'id','user_id','c_country','c_fname','c_lname','c_address','c_state_country','c_postal_zip','c_email_address','c_phone','c_order_notes','payment_mode','totalAmount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*public function items()
    {
        return $this->hasMany(OrderItem::class);
    }*/
}
