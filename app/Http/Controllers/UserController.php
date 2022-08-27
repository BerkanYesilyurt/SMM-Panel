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

        if(is_null($request->rememberme)){
            $rememberme = 0;
        }else{
            $rememberme = 1;
        }

        if(auth()->attempt($fields, $rememberme)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You have successfully logged in.');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function register(Request $request, User $user){
        $fields = $request->validate([
            'name' => ['required', 'min:3', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6', 'max:50'],
            'contact' => ['required', 'max:150'],
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
