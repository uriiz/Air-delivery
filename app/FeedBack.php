<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    protected $fillable = [
        'user_id' ,
        'id' ,
        'content',
        'email',
        'name',
    ];
}
