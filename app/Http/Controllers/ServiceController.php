<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatusEnum;
use App\Models\Category;
use App\Models\ServiceUpdate;

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

    public function serviceUpdatesPage(){
        $configsArray = ConfigController::configs();
        if($configsArray['service_updates_page'] == 1){
            return view('pages.serviceupdates', [
                'serviceupdates' => ServiceUpdate::with('service')->get()
            ]);
        }else{
            abort(404);
        }
    }
}
