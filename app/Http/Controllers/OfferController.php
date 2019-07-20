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
        $offer = Offer::newOffer($request);
        if($request->submit_action){

        }

        return $offer;
    }
    public function deleteOffer(Request $request)
    {
        return Offer::where('id',$request->id)
            ->where('submit_action','draft')
            ->where('user_id',Auth::id())->delete();
    }
    public function update(Request $request)
    {

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
        if(! Auth::id()){
            return ;
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
        if(! Auth::id()){
            return ;
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
