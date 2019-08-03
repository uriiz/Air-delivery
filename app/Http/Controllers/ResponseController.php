<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Package;
use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
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
    public function create()
    {
        //
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
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */

    public function appDeleteResponse(Request $request)
    {
        if(! Auth::id() || Auth::user()->role != 2){
            return;
        }

        return Response::where('id',$request->id)->update([
            'is_send_email' => 1,
        ]);
    }

    public function show(Response $response)
    {
        if(! Auth::id() || Auth::user()->role != 3){
            return;
        }

        $offers =  Offer::where('submit_action','published')->orderBy('created_at', 'DESC')->get();
        $offersAvilable = [];
        foreach ($offers as $offer){
            $response = Response::where('is_customer_response',1)
                ->where('offer_id',$offer->id)
                ->where('is_send',0)->get();
            if(count($response) >= 1){
                $packages = Package::where('order_id',$offer->id)->get();
                $offer->responses = $response;
                $offer->packages = $packages;
                array_push($offersAvilable,$offer);
            }
        }
        return $offersAvilable;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(! Auth::id() || Auth::user()->role != 3){
            return;
        }


        return Response::where('id',$request->id)->update([
            'is_send'=>1
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
