<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ApiRequest;
use App\Models\Api;
use App\Models\Service;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apisPage(){
        return view('pages.admin.apis', [
            'apis' => Api::all()
        ]);
    }

    public function newApiPage()
    {
        return view('pages.admin.api', [
            'title' => 'New API',
            'path' => 'new-api'
        ]);
    }

    public function editApiPage(Api $api)
    {
        return view('pages.admin.api', [
            'title' => 'Edit API',
            'api' => $api
        ]);
    }

    public function createApi(ApiRequest $request)
    {
        Api::create($request->validated());
        return redirect('/admin/apis')->with('message', 'You have successfully created the API.');
    }

    public function updateApi(ApiRequest $request)
    {
        Api::findOrFail($request->id)->update($request->safe()->except(['id']));
        return back()->with('message', 'You have successfully edited API details.');
    }

    public function deleteApi(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric|exists:apis,id',
        ]);

        DB::transaction(function () use($request){
            Api::findOrFail($request->delete_id)->delete();
            Service::where('api_provider_id', '=', $request->delete_id)->delete();
        });

        return back()->with('message', 'You have successfully deleted API and related services.');
    }
}
