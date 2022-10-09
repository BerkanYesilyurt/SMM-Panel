<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicesPage(){

        $categories = [];
        $services = [];

        foreach(Category::all() as $category){
            $categories[$category->id] = $category->name;
            $services[$category->id] = Category::find($category->id)->getServicesWithCategory();
        }

        return view('pages.services', compact('services', 'categories'));

    }

    public function servicesUpdatesPage(){
        $configsArray = ConfigController::configs();
        if($configsArray['service_updates_page'] == 1){
            return view('pages.serviceupdates');
        }else{
            abort(404);
        }
    }
}
