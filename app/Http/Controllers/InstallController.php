<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function installPage(){
        $configsArray = ConfigController::configs();
        if($configsArray['is_installed'] != 1){
            return view('pages.install.index');
        }else{
            return redirect('/');
        }
    }
}
