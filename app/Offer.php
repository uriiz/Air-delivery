<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'id',
        'submit_action',
        'from_name',
        'from_company_name',
        'from_lat',
        'from_lng',
        'from_address_name',
        'from_address_id',
        'from_zip_code',
        'to_name',
        'to_company_name',
        'to_lat',
        'to_lng',
        'to_address_name',
        'to_address_id',
        'to_zip_code',
        'from_date',
        'to_date',
        'note',
        'user_id',
        'to_country_name',
        'to_country_code',
        'from_country_name',
        'from_country_code',
        'order_id',
    ];
}
