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

    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }

    public function redirect()
    {
        return view('admin.dashboard');
    }
}
