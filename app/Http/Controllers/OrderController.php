<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPage(){
        $categories = [];
        $services = [];

        foreach(Category::all() as $category){
            $categories[$category->id] = $category->name;
            $services[$category->id] = Category::find($category->id)->getServicesWithCategory();
        }

        return view('pages.new-order', compact('services', 'categories'));
    }

    public function massOrderPage(){
        return view('pages.massorders');
    }
}
