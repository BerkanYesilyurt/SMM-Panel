<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiPage(){
        return view('pages.api');
    }
}
