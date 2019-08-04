<?php

namespace App\Http\Controllers;

use App\Country;
use App\Jobs\SendConfirmEmail;
use App\Jobs\SendOfferEmail;
use App\Jobs\SendPriceOfferEmail;
use App\Offer;
use App\Package;
use App\Response;
use App\User;
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

    public function getConfirmOffers()
    {
        if(! Auth::id() || Auth::user()->role != 2){
            return;
        }

        $offers =  Offer::where('submit_action','published')->orderBy('created_at', 'DESC')->get();

        $offersAvilable = [];
        foreach ($offers as $offer){

            $response = Response::where('offer_id',$offer->id)
                ->where('company_id',Auth::id())
                ->where('is_send_email',0)
                ->where('is_send',1)
                ->first();

            if(count($response) == 0){

            }else{
                $offer->response_id = $response->id;
                array_push($offersAvilable,$offer);
            }
        }

        $offers = $offersAvilable;

        return collect($offers)->map(function($filter){
            return [
                'id'=>$filter['id'],
                'response_id'=>$filter['response_id'],
                'from_lat'=>$filter['from_lat'],
                'from_lng'=>$filter['from_lng'],
                'from_name'=>$filter['from_name'],
                'to_name'=>$filter['to_name'],
                'details'=> User::where('id',$filter['user_id'])->first(),
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
                'from_company_name'=>   $filter['from_company_name'],
                'to_company_name'=>   $filter['to_company_name'],
                'packages'=> Offer::getPackagesByOfferId($filter['id'])
            ];
        });

    }

    public function confirmOffer(Request $request)
    {
        if(! Auth::id() || Auth::user()->role != 1){
            return;
        }

        $res = Response::where('id',$request->id)->update([
            'is_customer_response'=>1,
        ]);

        $admins = User::where('role',3)->get();
        foreach ($admins as $s){

                try {
                    dispatch(new SendConfirmEmail($s));
                }catch (\Exception $e){
                }
        }

        return $res;
    }

    public function getPriceOffer(Request $request)
    {
        if(! Auth::id() || Auth::user()->role != 1){
            return;
        }
        $offers = Offer::where('user_id',Auth::id())->orderBy('created_at', 'DESC')->get();
        $filterdOffers = [];
        foreach ($offers as $o){

            $respones = Response::where('user_id',Auth::id())
                ->where('is_customer_response',0)
                ->where('offer_id',$o->id)->get();

            if(count($respones) == 0){
                continue;
            }

            $o->pretty_time = Offer::setPrettyTime($o->created_at);
            $o->from_date = Offer::setPrettyTimeNoHour($o->from_date);
            $o->to_date = Offer::setPrettyTimeNoHour($o->to_date);
            $o->packages = Offer::getPackagesByOfferId($o->id);
            $o->response = $respones;
            array_push($filterdOffers,$o);
        }
        return $filterdOffers;
    }

    public function setPrice(Request $request)
    {

        if(!Auth::id() || Auth::user()->role != 2){
            return;
        }
        if($request->price <= 0 || $request->extra_price < 0 || !$request->offer_id){
            return 'price issue';
        }

        $userId = Offer::where('id',$request->offer_id)->first();
        $userId = $userId->user_id;
        $userName = User::where('id',$userId)->first();

        $response = Response::create([
            'offer_id' => $request->offer_id,
            'price_offer' => $request->price,
            'currency' => $request->price_currency,
            'price_offer_extra' => $request->extra_price,
            'currency_extra' => $request->extra_price_currency,
            'company_id' => Auth::id(),
            'company_name' => Auth::user()->company_name,
            'user_id' => $userId,
            'user_name' => $userName->name,
            'is_send_email' => 0,
            'is_send' => 0,
            'is_customer_response' => 0,
        ]);

        try {
            dispatch(new SendPriceOfferEmail($response,$userName));
        }catch (\Exception $e){
        }
    }

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
        $offersAvilable = [];
        foreach ($offers as $offer){

            $response = Response::where('offer_id',$offer->id)
                ->where('company_id',Auth::id())->first();
            if(count($response) == 1){

            }else{
                array_push($offersAvilable,$offer);
            }
        }

        $offers = $offersAvilable;
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
        $shippers = User::where('role',2)->whereNotNull('confirm_mail')->get();

        foreach ($shippers as $s){
            if($request->submit_action){
                try {
                    dispatch(new SendOfferEmail($s,$offer));
                }catch (\Exception $e){
                }
            }
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
