<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ignore extends Model
{
    protected $fillable = ['user_id','offer_id'];
}
