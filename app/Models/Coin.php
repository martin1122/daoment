<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = ['coin', 'convert', 'data'];

    protected $casts = ['data' => 'object'];

    protected $attributes = ['data' => '{}'];
}

