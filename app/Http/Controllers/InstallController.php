<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function installPage(){
        return view('pages.install.index');
    }
}
