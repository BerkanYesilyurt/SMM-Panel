<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function profilePage(User $user){
        $currentUser = $user::findOrFail(auth()->user()->id);
        return view('pages.profile', compact('currentUser'));
    }

    public function updateProfile(){

    }

    public function generateToken(User $user){
        $apiKey = Str::random(55);

        $user->where('id', '=', auth()->user()->id)->update([
            'api_key' => $apiKey
        ]);

        return back()->with('message', 'You have successfully generated new API key.');
    }
}
