<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profilePage(User $user){
        $currentUser = $user::findOrFail(auth()->user()->id);
        return view('pages.profile', compact('currentUser'));
    }

    public function updateProfile(){

    }

    public function generateToken(){

    }
}
