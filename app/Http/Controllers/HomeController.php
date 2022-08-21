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
        return view('dashboard');
    }elseif($directly_login){
        return redirect()->route('login');
    }else{
        return view('index');
    }

    }


    public function showLogin(Config $config){
        $configs = $config->all();
        $configsArray = [];
        foreach($configs as $config){
            $configsArray[$config->name] = $config->value;
        }
        return view('login', compact('configsArray'));
    }
}
