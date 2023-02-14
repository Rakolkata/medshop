<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Order_details extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'id';

    
    public function products()
    {
        return $this->hasMany(Product::class,'id','Product_id');
    }

}
