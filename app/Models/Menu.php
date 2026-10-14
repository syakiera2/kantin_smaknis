<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'category', 'price', 'stock', 'is_available'];

    protected $casts = ['is_available' => 'boolean'];
}