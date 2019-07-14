<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{


    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'package_quantity',
        'package_width',
        'package_height',
        'package_length',
        'package_weight',
        'package_type',
    ];
}
