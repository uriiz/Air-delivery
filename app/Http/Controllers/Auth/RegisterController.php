<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/add-new';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if(!$data['confirm_term']){
           return;
        }
        $now = Carbon::now();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'job_title' => $data['job_title'],
            'company_name' => $data['company_name'],
            'company_phone' => $data['company_phone'],
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'address' => $data['address'],
            'role' => $data['role'],
            'zip_code' => $data['zip_code'],
            'phone' => $data['phone'],
            'logo' => '/images/user_profile.jpg',
            'confirm_term' => Carbon::now(),
            'confirm_mail' => $now,
            'password' => Hash::make($data['password']),
        ]);
    }
}
