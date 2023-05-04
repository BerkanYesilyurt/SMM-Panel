<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateSystemSettingsRequest;
use App\Models\Config;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function systemSettingsPage(){
        return view('pages.admin.system-settings', [
            'settings' => Config::all(['name', 'value', 'updated_at'])->keyBy('name')->toArray()
        ]);
    }

    public function setSystemSettingWith($settings, $requestAttributes){
        $changedSettingNames = [];
        foreach($settings as $settingName => $settingValue){
            if(configValue($settingName) != $settingValue){
                Config::where('name', '=', $settingName)->update(['value' => $settingValue]);
                $changedSettingNames[] = $requestAttributes[$settingName];
            }
        }
        return $changedSettingNames;
    }

    public function updateSystemSettings(UpdateSystemSettingsRequest $request, Config $config)
    {
        if ($request->type == 'maintenancemode'){
            $config->where('name', '=', 'maintenance_mode')->update(['value' => DB::raw('!value')]);
            $changedSettingNames[] = 'Maintenance Mode';
        }elseif($request->type == 'firstsection' || $request->type == 'secondsection'){
            $changedSettingNames = $this->setSystemSettingWith($request->validated(), $request->attributes());
        }else{
            abort(416);
        }

        if(Cache::has('configsArray')) {
            Cache::forget('configsArray');
        }

        return redirect()->back()->with([
            'message' => 'You have successfully changed the following settings:',
            'changedSettingNames' => $changedSettingNames
        ]);
    }
}
