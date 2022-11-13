<?php

namespace App\Http\Controllers\admin;

use App\Enums\CategoryStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class CategoryController extends Controller
{
    public function categoriesPage()
    {
        return view('pages.admin.categories', [
            'categories' => Category::all()
        ]);
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|min:1|max:250',
            'status' => ['required', new Enum(CategoryStatusEnum::class)]
        ]);

        Category::findOrFail($request->id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return back()->with('message', 'You have successfully edited category details.');
    }
}
