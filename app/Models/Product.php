<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->hasMany(Category::class,'Categories_id','Categories_id');
    }

    public function brand()
    {
        return $this->hasMany(Brand::class,'id','Brand');
    }

    public function function()
    {
        return $this->hasMany(Med_Function::class,'id','Function');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class,'id','Schedule');
    }

}
