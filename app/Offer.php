<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function setPrettyTime($time)
    {
        if(!$time){
            return '';
        }
        return Carbon::parse($time)->format('m/d/Y H:i');
    }

    public static function setPrettyTimeNoHour($time)
    {
        if(!$time){
            return '';
        }
        return Carbon::parse($time)->format('m/d/Y');
    }

    public static function getPackagesByOfferId($id)
    {
        if(!$id){
            return '';
        }
        return Package::where('order_id',$id)->get();
    }
    public static function translateStatus($status)
    {
        if(!$status){
            return 'draft';
        }
        return 'published';
    }

    public static function newOffer($request)
    {
        $offer = Offer::create([
            'user_id'=>Auth::id(),
            'submit_action'=>$request->submit_action ? 'published' : 'draft',
            'from_name'=>$request->from_name,
            'from_company_name'=>$request->from_company_name,
            'to_company_name'=>$request->to_company_name,
            'from_lat'=>$request->from_lat,
            'from_lng'=>$request->from_lng,
            'from_address_name'=>$request->from_address_name,
            'from_address_id'=>$request->from_address_id,
            'from_zip_code'=>$request->from_zip_code,
            'to_name'=>$request->to_name,
            'to_lat'=>$request->to_lat,
            'to_lng'=>$request->to_lng,
            'to_address_name'=>$request->to_address_name,
            'to_address_id'=>$request->to_address_id,
            'to_zip_code'=>$request->to_zip_code,
            'from_date'=>(new Carbon($request->from_date))->addDays(1),
            'to_date'=>(new Carbon($request->to_date))->addDays(1),
            'to_country_name'=>$request->to_country_name,
            'from_country_name'=>$request->from_country_name,
            'to_country_code'=>$request->to_country_code,
            'from_country_code'=>$request->from_country_code,
            'note'=>$request->note,
            'order_id'=>'111',
        ]);

        foreach ($request->pack as $p){
            Package::create([
                'user_id'=>Auth::id(),
                'order_id'=> $offer->id,
                'package_quantity'=>$p['package_quantity'],
                'package_width'=>$p['package_width'],
                'package_height'=>$p['package_height'],
                'package_length'=>$p['package_length'],
                'package_weight'=>$p['package_weight'],
                'package_type'=>$p['package_type'],
            ]);
        }

        Country::setCountry($request->from_country_name,$request->to_country_name,$request->from_country_code,$request->to_country_code);

        return $offer;
    }

    public static function updateOffer($request,$id)
    {

        $offer = Offer::where('id',$id)->update([
            'user_id'=>Auth::id(),
            'submit_action'=>$request->submit_action ? 'published' : 'draft',
            'from_name'=>$request->from_name,
            'from_company_name'=>$request->from_company_name,
            'to_company_name'=>$request->to_company_name,
            'from_lat'=>$request->from_lat,
            'from_lng'=>$request->from_lng,
            'from_address_name'=>$request->from_address_name,
            'from_address_id'=>$request->from_address_id,
            'from_zip_code'=>$request->from_zip_code,
            'to_name'=>$request->to_name,
            'to_lat'=>$request->to_lat,
            'to_lng'=>$request->to_lng,
            'to_address_name'=>$request->to_address_name,
            'to_address_id'=>$request->to_address_id,
            'to_zip_code'=>$request->to_zip_code,
            'from_date'=>(new Carbon($request->from_date))->addDays(1),
            'to_date'=>(new Carbon($request->to_date))->addDays(1),
            'to_country_name'=>$request->to_country_name,
            'from_country_name'=>$request->from_country_name,
            'to_country_code'=>$request->to_country_code,
            'from_country_code'=>$request->from_country_code,
            'note'=>$request->note,
            'order_id'=>'111',
        ]);

        foreach ($request->pack as $p){
            Package::create([
                'user_id'=>Auth::id(),
                'order_id'=> $id,
                'package_quantity'=>$p['package_quantity'],
                'package_width'=>$p['package_width'],
                'package_height'=>$p['package_height'],
                'package_length'=>$p['package_length'],
                'package_weight'=>$p['package_weight'],
                'package_type'=>$p['package_type'],
            ]);
        }

        return $offer;
    }

}
