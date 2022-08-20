<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function check(Config $config){
    $maintenance_mode = $config->where('name','=', 'maintenance_mode')->value('value');
    $directly_login = $config->where('name','=', 'directly_login')->value('value');

    if($maintenance_mode){
        return view('undermaintenance');
    }

    if(auth()){
        return view('dashboard');
    }elseif($directly_login){
        return route('login');
    }else{
        return view('index');
    }

    }


    public function showLogin(){
        return view('login');
    }
}
