<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateSystemSettingsRequest;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function systemSettingsPage(){
        return view('pages.admin.system-settings', [
            'settings' => Config::all(['name', 'value'])->keyBy('name')->toArray()
        ]);
    }

    public function setSystemSettingWith($settings){
        foreach($settings as $settingName => $settingValue){
            Config::where('name', '=', $settingName)->update(['value' => $settingValue]);
        }
    }

    public function updateSystemSettings(UpdateSystemSettingsRequest $request, Config $config)
    {
        if ($request->type == 'maintenancemode'){
            $config->where('name', '=', 'maintenance_mode')->update(['value' => DB::raw('!value')]);
        }elseif($request->type == 'firstsection'){
            $this->setSystemSettingWith([
                'title' => $request->title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'currency' => $request->currency,
                'currency_symbol' => $request->currency_symbol,
                'service_updates_page' => $request->service_updates_page,
                'register_page' => $request->register_page,
                'directly_login' => $request->directly_login,
                'autologin_after_registration' => $request->autologin_after_registration,
                'forgot_password' => $request->forgot_password,
            ]);
        }elseif($request->type == 'secondsection'){
            $this->setSystemSettingWith([
                'terms_content' => $request->terms_content ?? null,
                'policy_content' => $request->policy_content ?? null,
                'javascript_embed_header' => $request->javascript_embed_header ?? null,
                'javascript_embed_footer' => $request->javascript_embed_footer ?? null,
                'facebook_link' => $request->facebook_link,
                'twitter_link' => $request->twitter_link,
                'instagram_link' => $request->instagram_link,
                'youtube_link' => $request->youtube_link,
            ]);

        }else{
            abort(416);
        }
        return redirect()->back()->with('message', 'You have successfully changed the settings.');
    }
}
