<?php

namespace App\Http\Controllers\admin;

use App\Enums\UserAuthorityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateUserDetailsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    public function usersPage(){
        $users = User::paginate(50);
        return view('pages.admin.users', compact('users'));
    }

    public function getUserDetails(User $user){
        return view('pages.admin.user', compact('user'));
    }

    public function createUser(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'min:3', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')],
            'balance' => 'required|numeric|min:0|digits_between:1,10',
            'password' => ['min:6', 'max:50'],
            'contact' => ['required', 'max:150'],
            'authority' => ['required', new Enum(UserAuthorityEnum::class)]
        ]);
        $fields['password'] = bcrypt($fields['password']);

        User::create($fields);
        return back()->with('message', 'You have successfully created a new user.');
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

    public function deleteUser(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric|exists:users,id',
        ]);

        User::where('id', $request->delete_id)->delete();
        return back()->with('message', 'You have successfully deleted the user.');
    }
}
