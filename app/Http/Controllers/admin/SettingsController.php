<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function systemSettingsPage(){
        return view('pages.admin.system-settings', [
            'settings' => Config::all(['name', 'value'])->keyBy('name')->toArray()
        ]);
    }
}
