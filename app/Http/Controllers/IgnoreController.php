<?php

namespace App\Http\Controllers;

use App\Ignore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IgnoreController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Auth::user()->role != 2){
            return;
        }

        return Ignore::create([
            'user_id'=>Auth::id(),
            'offer_id'=>$request->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ignore  $ignore
     * @return \Illuminate\Http\Response
     */
    public function show(Ignore $ignore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ignore  $ignore
     * @return \Illuminate\Http\Response
     */
    public function edit(Ignore $ignore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ignore  $ignore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ignore $ignore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ignore  $ignore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ignore $ignore)
    {
        //
    }
}
