<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('maintenance');
    }

    public function check(Config $config){
    $directly_login = $config->where('name','=', 'directly_login')->value('value');

    if(auth()->check()){
        return view('pages.new-order');
    }elseif($directly_login){
        return redirect()->route('login');
    }else{
        return view('index');
    }

    }


    public function showLogin(){
        return view('login');
    }

    public function showRegister(){
        $configsArray = ConfigController::configs();
        if($configsArray['register_page']){
            return view('register');
        }else{
            return redirect('/');
        }
    }
}
