<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateUserDetailsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersPage(){
        $users = User::paginate(50);
        $userCount = User::count();
        return view('pages.admin.users', compact('users'))->with('userCount', $userCount);
    }

    public function getUserDetails(User $user){
        return view('pages.admin.user', compact('user'));
    }

    public function updateUserDetails(UpdateUserDetailsRequest $request, User $user){
        $user->update($request->validated());
        return back()->with('message', 'You have successfully edited user details.');
    }

    public function updateUserBalance(Request $request, User $user){
        $request->validate([
            'balance' => 'required|numeric|min:0|digits_between:1,10'
        ]);

        $user->update([
            'balance' => $request->balance
        ]);

        return back()->with('message', 'You have successfully updated user balance.');
    }
}
