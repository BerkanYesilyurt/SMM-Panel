<?php

namespace App\Http\Controllers;

use App\Events\LastLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function getIpAdress(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->getClientIp();
    }

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
            event(new LastLogin(auth()->user(), $request, $this->getIpAdress()));

            alert()->success('Success!','You have successfully logged in.')->timerProgressBar();
            return redirect('/');
        }
        toast('Invalid Credentials','error')->timerProgressBar();
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
        $fields['last_login'] = now();
        $fields['last_login_ip'] = $this->getIpAdress();

        $newUser = $user->create($fields);
        auth()->login($newUser);

        alert()->success('Success!','You have successfully registered and logged in.')->timerProgressBar();
        return redirect('/');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        alert()->success('Success!','You have successfully logged out.')->timerProgressBar();;
        return redirect('/');
    }

    public function userStatistics(User $user){
        $userStatistics = [];

    }

    public function getUserBalance($user_id = null){
        if(is_null($user_id)){
            $user_id = auth()->user()->id;
        }

        $balance = User::findOrFail($user_id)->balance;
        return $balance;
    }

}
