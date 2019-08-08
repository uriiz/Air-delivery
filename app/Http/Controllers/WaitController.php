<?php

namespace App\Http\Controllers;

use App\Jobs\SendJoinEmail;
use App\Jobs\SendWelcomeEmail;
use App\User;
use App\Wait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WaitController extends Controller
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

    public function insertUser(Request $request)
    {

        if(!Auth::id() || Auth::user()->role != 3){
            return;
        }

        $user = Wait::where('id',$request->id)->first();

        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'job_title' => '',
            'company_name' => $user->company_name,
            'company_phone' => $user->company_phone,
            'lat' => '',
            'lng' => '',
            'address' => '',
            'role' => 2,
            'zip_code' => '',
            'phone' => $user->phone,
            'logo' => '/images/user_profile.jpg',
            'confirm_term' => $user->confirm_term,
            'confirm_mail' => null,
            'password' => Hash::make($user->password),
        ]);

        if($newUser->email){

            try {
                dispatch(new SendWelcomeEmail($newUser));
            }catch (\Exception $e){
            }
            return Wait::where('id',$request->id)->delete();
        }
        return ;
    }

    public function store(Request $request)
    {

        $wait = Wait::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'role' => 2,
            'phone' => $request->phone,
            'confirm_term' => Carbon::now(),
            'password' => $request->password,
        ]);
        $admins = User::where('role',3)->get();
        foreach ($admins as $s){
            try {
                dispatch(new SendJoinEmail($s));
            }catch (\Exception $e){
            }
        }
        return $wait;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wait  $wait
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Wait::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wait  $wait
     * @return \Illuminate\Http\Response
     */
    public function edit(Wait $wait)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wait  $wait
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wait $wait)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wait  $wait
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wait $wait)
    {
        //
    }
}
