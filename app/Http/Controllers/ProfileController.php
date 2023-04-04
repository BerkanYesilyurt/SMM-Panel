<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function profilePage(User $user){
        $currentUser = $user::findOrFail(auth()->user()->id);
        return view('pages.profile', compact('currentUser'));
    }

    public function updateProfile(Request $request, User $user){
        $currentUser = $user::findOrFail(auth()->user()->id);

        if($request->type == 'updateProfile'){
            $fields = $request->validate([
                'name' => ['required', 'min:3', 'max:150'],
                'timezone' => ['required', 'numeric', 'min:-100000', 'max:100000'],
                'contact' => ['required', 'max:150'],
            ]);

            $currentUser->update($fields);
            alert()->success('Success!','You have successfully edited your profile.')->timerProgressBar();
            return back();

        }else if($request->type == 'changePassword'){
            $fields = $request->validate([
                'password' => ['required', 'confirmed', 'min:6', 'max:50']
            ]);

            if(!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->withErrors(["doesntMatch" => "Old password does not match."]);
            }

            $currentUser->update([
                'password' => bcrypt($fields['password'])
            ]);

            alert()->success('Success!','You have successfully changed your password.')->timerProgressBar();
            return back();

        }else{
            return back();
        }

    }

    public function generateToken(User $user){
        $apiKey = Str::random(55);

        $user->where('id', '=', auth()->user()->id)->update([
            'api_key' => $apiKey
        ]);

        return back()->with('message', 'You have successfully generated new API key.');
    }
}
