<?php

namespace App\Http\Controllers\admin;

use App\Enums\UserBanTypesEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function deleteBan()
    {

    }
}
