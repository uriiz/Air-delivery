<?php

namespace App\Http\Controllers;

use App\Country;
use App\Offer;
use App\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCountries()
    {

        return Country::select('name')->get();

    }
    public function getAppOffers()
    {
        if(Auth::user()->role != 2){
            return;
        }
        $offers =  Offer::where('submit_action','published')->orderBy('created_at', 'DESC')->get();
        return collect($offers)->map(function($filter){
           return [
               'id'=>$filter['id'],
               'from_lat'=>$filter['from_lat'],
               'from_lng'=>$filter['from_lng'],
               'from_address_name'=>$filter['from_address_name'],
               'from_zip_code'=>$filter['from_zip_code'],
               'to_lat'=>$filter['to_lat'],
               'to_lng'=>$filter['to_lng'],
               'to_zip_code'=>$filter['to_zip_code'],
               'to_address_name'=>$filter['to_address_name'],
               'from_date'=>Offer::setPrettyTimeNoHour($filter['from_date']),
               'to_date'=>Offer::setPrettyTimeNoHour($filter['to_date']),
               'note'=> $filter['note'],
               'pretty_time'=>  Offer::setPrettyTime($filter['updated_at']),
               'from_country_name'=> $filter['from_country_name'],
               'to_country_name'=>   $filter['to_country_name'],
               'from_company_name'=>   '****',
               'to_company_name'=>   '****',
               'packages'=> Offer::getPackagesByOfferId($filter['id'])
           ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if(!Auth::user() || Auth::user()->role != 1){
          return 0;
        }
        $offer = Offer::newOffer($request);
        if($request->submit_action){

        }

        return $offer;
    }
    public function deleteOffer(Request $request)
    {
        if(!Auth::user() || Auth::user()->role != 1){
            return;
        }

        return Offer::where('id',$request->id)
            ->where('submit_action','draft')
            ->where('user_id',Auth::id())->delete();
    }
    public function update(Request $request)
    {
        if(!Auth::user() || Auth::user()->role != 1){
            return;
        }
        $id = $request->id;
        Package::where('order_id',$id)->delete();
        $offer = Offer::updateOffer($request,$id);
        return $offer;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getOfferDetails(Request $request)
    {
        if(!Auth::user() || Auth::user()->role != 1){
            return;
        }

        $offer =  Offer::where('id',$request->id)
            ->where('submit_action','draft')
            ->where('user_id',Auth::id())->first();

        if(! $offer || !$offer->id ){
            return null;
        }
        $packages = Package::where('order_id',$offer->id)->get();
        $offer->packages = $packages;
        return $offer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Offer $offer)
    {
        if(!Auth::user() || Auth::user()->role != 1){
            return;
        }

        $offers =  Offer::where('user_id',Auth::id())->orderBy('created_at', 'DESC')->get();
        foreach ($offers as $o){
            $o->pretty_time = Offer::setPrettyTime($o->created_at);
            $o->from_date = Offer::setPrettyTimeNoHour($o->from_date);
            $o->to_date = Offer::setPrettyTimeNoHour($o->to_date);
            $o->packages = Offer::getPackagesByOfferId($o->id);

        }
        return $offers;
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
