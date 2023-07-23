<?php

namespace App\Http\Controllers\admin;

use App\Enums\PaymentStatusEnum;
use App\Enums\UserAuthorityEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\UsersPageFilter;
use App\Http\Requests\admin\UpdateUserDetailsRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    public function usersPage(Request $request, UsersPageFilter $filter){
        $request->validate([
            'orderby' => ['starts_with:asc_,desc_', 'ends_with:_id,_balance'],
        ]);

        $users = User::filterByFunctions($filter)->paginate(50);
        return view('pages.admin.users', compact('users'));
    }

    public function getUserDetails(User $user){
        return view('pages.admin.user', compact('user'));
    }

    public function createUser(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'min:3', 'max:150'],
            'email' => ['required', 'email:filter', 'max:150', Rule::unique('users', 'email')],
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

        $amount = $request->balance - $user->balance;
        $user->update([
            'balance' => $request->balance
        ]);

        $details = [];
        $details['user_id'] = $user->id;
        $details['email'] = $user->email;
        $details['balance'] = $user->balance;
        $details['last_login'] = $user->last_login;
        $details['last_login_ip'] = $user->last_login_ip;

        $user->payment_logs()->create([
            'user_id' => $user->id,
            'payment_method_id' => 0,
            'currency' => configValue('currency'),
            'amount' => $amount,
            'details' => $details,
            'status' => PaymentStatusEnum::COMPLETED->value
        ]);

        return back()->with('message', 'You have successfully updated user balance.');
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric|exists:users,id',
        ]);

        DB::transaction(function () use($request){
            User::where('id', $request->delete_id)->delete();
            Ticket::where('user_id', $request->delete_id)->delete();
            TicketMessage::where('user_id', $request->delete_id)->delete();
        });
        return back()->with('message', 'You have successfully deleted the user.');
    }
}
