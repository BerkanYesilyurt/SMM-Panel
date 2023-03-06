<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Api;

class ApiController extends Controller
{
    public function apiPage(){
        return view('pages.admin.api', [
            'apis' => Api::all()
        ]);
    }
}
