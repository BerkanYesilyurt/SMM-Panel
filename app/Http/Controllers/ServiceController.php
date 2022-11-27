<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatusEnum;
use App\Models\Category;

class ServiceController extends Controller
{
    public function servicesPage(){

        $categories = [];
        $services = [];

        foreach(Category::all() as $category){
            if($category->status == CategoryStatusEnum::ACTIVE->value) {
                $categories[$category->id] = $category->name;
                $services[$category->id] = Category::find($category->id)->getServicesWithCategory();
            }
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
