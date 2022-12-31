<?php

namespace App\Http\Controllers\admin;

use App\Enums\UserBanTypesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class BanController extends Controller
{
    public function banPage(User $user, $type)
    {
        return view('pages.admin.ban', [
            'user' => $user,
            'type' => in_array($type, UserBanTypesEnum::values()) ? $type : NULL
        ]);
    }

    public function ban()
    {

    }

    public function deleteBan(Request $request)
    {
        $request->validate([
            'type' => new Enum(UserBanTypesEnum::class),
            'user_id' => ['required', Rule::exists('user_bans','user_id')->where(function ($query) use ($request){
                $query->where('type', $request->type);
            })]
        ]);

        UserBan::where('user_id', $request->user_id)->where('type', $request->type)->delete();
        return back()->with('message', 'You have successfully deleted the ban.');
    }
}
