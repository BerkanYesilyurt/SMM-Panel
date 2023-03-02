<?php

use App\Enums\UserBanTypesEnum;
use App\Models\Config;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

if (!function_exists('configValue')) {
    function configValue(string $name)
    {
        return Config::where('name', '=', $name)->value('value');
    }
}

if (!function_exists('checkBan')){
    function checkBan($type, $user = NULL):bool {
        if(is_null($user)){
            $user = Auth::user();
        }

        if($user->is_banned){
            $ban_record = $user->is_banned->where('type', UserBanTypesEnum::from($type)->value)->first();
            if($ban_record){
                if($ban_record->permanent || ($ban_record->until_at && Carbon::now()->lt($ban_record->until_at))){
                    return true;
                }
            }
        }
        return false;
    }
}

if (!function_exists('getBanDateMessage')) {
    function getBanDateMessage($type, $user = NULL)
    {
        if(is_null($user)){
            $user = Auth::user();
        }
        if ($user->is_banned) {
            $ban_record = $user->is_banned->where('type', UserBanTypesEnum::from($type)->value)->first();
            if ($ban_record) {
                if($ban_record->permanent){
                    return '<span class="badge bg-danger">There is no time limit for this ban.</span>';
                }else{
                    return 'The ' . strtolower(UserBanTypesEnum::from($type)->value) . ' is temporarily suspended until <span class="badge bg-danger">' . date('d F Y h:i:s', strtotime($ban_record->until_at)) . '</span>';
                }
            }
        }
        return null;
    }
}

if (!function_exists('hasTables')) {
    function hasTables(array $tables)
    {
        foreach($tables as $table){
            if(!Schema::hasTable($table)){
                return false;
            }
        }
        return true;
    }
}
