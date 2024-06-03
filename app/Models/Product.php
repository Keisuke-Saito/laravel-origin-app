<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users');
    }

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

}