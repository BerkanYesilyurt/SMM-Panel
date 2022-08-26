<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request, User $user){
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if(auth()->attempt($fields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You have successfully logged in.');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function register(Request $request, User $user){
        $fields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'contact' => ['required'],
        ]);

        $fields['password'] = bcrypt($fields['password']);

        $newUser = $user->create($fields);
        auth()->login($newUser);

        return redirect('/')->with('message', 'You have successfully registered.');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have successfully logged out.');
    }

}
