<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'admins';

        protected $fillable = [
            'id','name','email', 'mobile','password','address','state','pincode','image','is_super'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }
