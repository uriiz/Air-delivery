<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wait extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company_name',
        'company_phone',
        'role',
        'phone',
        'logo',
        'confirm_term',
        'password',
        'id',
        'country',
        'lat',
        'lng',
        'address',
    ];
}
