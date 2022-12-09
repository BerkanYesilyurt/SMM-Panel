<?php

namespace App\Http\Controllers\admin;

use App\Enums\ServiceStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

    public function serviceUpdatesPage()
    {
        return view('pages.admin.serviceupdates', [
            'serviceupdates' => ServiceUpdate::with('service')->get()
        ]);
    }

    public function updateService(Request $request, Service $service, ServiceUpdate $serviceUpdate)
    {
        $fields = $request->validate([
            'id' => 'required|numeric|exists:services,id',
            'name' => 'required|min:1|max:250',
            'description' => 'required|min:1|max:1000',
            'category_id' => 'required|exists:categories,id',
            'status' => ['required', new Enum(ServiceStatusEnum::class)],
            'price' => 'required|numeric|min:0.01|max:99999',
            'min' => 'integer|digits_between:1,9',
            'max' => 'integer|digits_between:1,9|gte:min',
            'serviceupdate_description' => 'nullable|min:1|max:1000'
        ]);

        $currentService = $service->find($request->id);

        DB::transaction(function () use($fields, $currentService, $request, $serviceUpdate){
            $filteredFields = Arr::except($fields, ['id', 'serviceupdate_description']);

            if(abs($currentService->price - $request->price) > PHP_FLOAT_EPSILON){
                $serviceUpdate->create([
                    'service_id' => $request->id,
                    'old_price' => floatval($currentService->price),
                    'new_price' => floatval($request->price),
                    'public' => $request->serviceupdate_public ? true : null,
                    'show_price_changes' => $request->serviceupdate_showprice ? true : null,
                    'description' => $request->serviceupdate_description ?? null
                ]);
            }

            $currentService->update($filteredFields);
        });
        return back()->with('message', 'You have successfully updated the service.');
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

    public function updateServiceUpdates(Request $request)
    {
        //TODO
    }
}
