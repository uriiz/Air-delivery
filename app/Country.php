<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
      'code' ,
      'id' ,
      'name'
    ];

    public static function setCountry($fromName,$toName,$fromCode,$toCode)
    {

        $countryFrom = Country::firstOrNew(array('name' => $fromName));
        $countryFrom->name = $fromName;
        $countryFrom->code = $fromCode;
        $countryFrom->save();

        $countryTo = Country::firstOrNew(array('name' => $toName));
        $countryTo->name = $toName;
        $countryTo->code = $toCode;
        $countryTo->save();


    }
}
