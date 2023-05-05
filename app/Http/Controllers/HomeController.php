<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('maintenance');
    }

    public function check(){
    if(auth()->check()){
        return redirect()->route('new-order');
    }elseif(configValue('directly_login')){
        return redirect()->route('login');
    }else{
        return view('index');
    }
    }


    public function showLogin(){
        return view('login');
    }

    public function showRegister(){
        if(configValue('register_page')){
            return view('register');
        }else{
            return redirect('/');
        }
    }
}
