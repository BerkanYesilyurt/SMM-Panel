<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboardPage(){
        $count = new CountController();
        return view('pages.admin.dashboard', [
            'count' => $count->countAll(),
            'config' => ConfigController::configs()
        ]);
    }
}
