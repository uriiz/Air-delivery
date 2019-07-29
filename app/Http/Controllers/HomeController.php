<?php

namespace App\Http\Controllers;

use App\Offer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function getUsers()
    {
        if(!Auth::id() || Auth::user()->role != 3){
            return;
        }
        $users = User::where('role',1)->orderBy('created_at', 'DESC')->get();
        foreach ($users as $u){
            $u->offers = Offer::where('user_id',$u->id)->get();
        }

        return $users;
    }

    public function deleteUser(Request $request)
    {
        if(!Auth::id() || Auth::user()->role != 3){
            return;
        }

        User::where('id',$request->id)->delete();
    }
    public function getUser()
    {
        if(Auth::user()){
            return Auth::user();
        }else{
            return 0;
        }
    }

    public function logOut()
    {

        Auth::logout();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function updateUser(Request $request)
    {

        if(!Auth::user() ){
            return;
        }

        if(!$request->name){
            $name = Auth::user()->name;
        }else{
            $name = $request->name;
        }
        if(!$request->phone){
            $phone = Auth::user()->phone;
        }else{
            $phone = $request->phone;
        }

        if(!$request->company_phone){
            $companyPhone = Auth::user()->company_phone;
        }else{
            $companyPhone = $request->company_phone;
        }

        return User::where('id',Auth::id())->update([
            'name'=> $name,
            'phone'=> $phone,
            'company_name' => $request->company_name,
            'zip_code' => $request->zip_code,
            'job_title' => $request->job_title,
            'company_phone' => $companyPhone,
        ]);
    }
    public function updateUserImage(Request $request)
    {
        if(!Auth::user()){
            return;
        }

        if ( ! Input::hasFile('file')) {
            return ;
        }
        $file = Input::file('file');

        $this->validate($request, [
            'file' => 'mimes:jpeg,png,jpg|max:10000',
        ]);

        $imageFiles = [
            'jpeg',
            'png',
            'jpg',
        ];
        if(!is_string($file)){
            if(!in_array($file->getClientOriginalExtension(),$imageFiles)){
                return 'not match file';
            }
        }
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/logos/'.Auth::user()->id), $imageName);
        $link = '/images/logos/'.Auth::user()->id.'/'.$imageName;
        return User::where('id',Auth::id())->update([
            'logo'=> $link,
        ]);

    }


}
