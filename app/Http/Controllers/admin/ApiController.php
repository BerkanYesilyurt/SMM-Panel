<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\Service;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiPage(){
        return view('pages.admin.api', [
            'apis' => Api::all()
        ]);
    }

    public function createApi()
    {
        //TODO: createApi
    }

    public function updateApi()
    {
        //TODO: updateApi
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
