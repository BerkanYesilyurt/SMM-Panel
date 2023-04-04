<?php

namespace App\Http\Controllers;

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
