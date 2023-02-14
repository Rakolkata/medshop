<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_User_Profile extends Model
{
    use HasFactory;
    protected $table = 'order__user__profiles';
    protected $primaryKey = 'id';
}
