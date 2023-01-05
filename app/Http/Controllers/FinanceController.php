<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function addFundsPage()
    {
        return view('pages.addfunds');
    }
}
