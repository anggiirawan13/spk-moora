<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class HomeController extends Controller
{

    public function index(){
        $mobils = Car::latest()->get();
        return view('auth.login',compact('mobils'));
    }

    public function contact(){
        return view('frontend.contact');
    }
    public function spk(){
        return view('frontend.spk');
    }
    public function about(){
        return view('frontend.about');
    }
    public function detail(Car $mobil){

        return view('frontend.detail',compact('mobil'));
    }

    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }

    public function redirect(){

        $is_admin=Auth::user()->is_admin;
        if($is_admin=='1')
        {
            return view('admin.dashboard');
        }else{
            return view('home');
        }
    }
}
