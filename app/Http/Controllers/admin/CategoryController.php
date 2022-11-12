<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoriesPage()
    {
        return view('pages.admin.categories', [
            'categories' => Category::all()
        ]);
    }
}
