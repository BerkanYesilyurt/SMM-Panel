<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function apiPage(){
        return view('pages.api');
    }
}
