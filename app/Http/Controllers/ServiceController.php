<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicesPage(Service $service, Category $category){
        $services = $service->all();
        $categories = $category->all();
        return view('pages.services', compact('services', 'categories'));
    }
}
