<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!Auth::user()){
            return;
        }

        $offer = Offer::create([
            'user_id'=>Auth::id(),
            'submit_action'=>$request->submit_action,
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
            'from_date'=>new Carbon($request->from_date),
            'to_date'=>new Carbon($request->to_date),
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

        if($request->submit_action){

        }

        return $offer;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
