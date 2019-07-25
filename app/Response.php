<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'id',
         'offer_id',
         'price_offer',
         'currency',
         'price_offer_extra',
         'company_id',
         'user_id',
         'currency_extra',
         'is_send_email',
         'is_send',
         'is_customer_response',
    ];

}
