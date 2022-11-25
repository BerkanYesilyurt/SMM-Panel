<?php

namespace App\Http\Controllers\admin;

use App\Enums\ServiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

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

    public function createNewService(Request $request, Service $service)
    {
        $fields = $request->validate([
            'name' => 'required|min:1|max:250',
            'description' => 'required|min:1|max:1000',
            'category_id' => 'required|exists:categories,id',
            'status' => ['required', new Enum(ServiceStatusEnum::class)],
            'price' => 'required|numeric|min:0.01|max:99999',
            'min' => 'integer|digits_between:1,9',
            'max' => 'integer|digits_between:1,9|gte:min'
        ]);

        $service->create($fields);
        return back()->with('message', 'You have successfully created new service.');
    }

    public function deleteService(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric',
        ]);

        Service::findOrFail($request->delete_id)->delete();

        return back()->with('message', 'You have successfully deleted service.');
    }
}
