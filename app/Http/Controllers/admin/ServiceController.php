<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicesPage()
    {
        return view('pages.admin.services', [
            'services' => Service::all(),
            'categories' => Category::all()
        ]);
    }

    public function updateService(Request $request)
    {
        //TODO
    }

    public function createNewService(Request $request)
    {
        //TODO
    }

    public function deleteService(Request $request)
    {
        //TODO
    }
}
