<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersPage(){
        $users = User::orderByDesc('id')->paginate(25);
        $userCount = User::count();
        return view('pages.admin.users', compact('users'))->with('userCount', $userCount);
    }

    public function getUserDetails(User $user){
        return view('pages.admin.user', compact('user'));
    }

    public function updateUserDetails(User $user){

    }
}
