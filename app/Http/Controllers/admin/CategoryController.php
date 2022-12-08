<?php

namespace App\Http\Controllers\admin;

use App\Enums\CategoryStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function createNewCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:250',
            'status' => ['required', new Enum(CategoryStatusEnum::class)]
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return back()->with('message', 'You have successfully created new category.');
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric',
        ]);

        DB::transaction(function () use($request){
            Category::findOrFail($request->delete_id)->delete();
            Service::where('category_id', '=', $request->delete_id)->delete();
        });

        return back()->with('message', 'You have successfully deleted category and related services.');
    }
}
