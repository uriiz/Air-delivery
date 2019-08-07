<?php

namespace App\Http\Controllers;

use App\FeedBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
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
        if(!Auth::id()){
            return 'not login';
        }
         FeedBack::create([
            'user_id' => Auth::id(),
            'content' => $request->contentText,
            'email' => Auth::user()->email,
            'name' => Auth::user()->name,
        ]);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeedBack  $feedBack
     * @return \Illuminate\Http\Response
     */
    public function show(FeedBack $feedBack)
    {
        if(!Auth::id() || Auth::user()->role != 3){
            return 'not login';
        }
        return FeedBack::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeedBack  $feedBack
     * @return \Illuminate\Http\Response
     */
    public function edit(FeedBack $feedBack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeedBack  $feedBack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeedBack $feedBack)
    {
        if(!Auth::id() || Auth::user()->role != 3){
            return 'not login';
        }

        return FeedBack::where('id',$request->id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeedBack  $feedBack
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeedBack $feedBack)
    {
        //
    }
}
