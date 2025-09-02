<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginBusinessController extends Controller
{
    public function tokenLogin($token)
    {
        \Auth::logout();
        $loginToken = \App\Models\LoginBusiness::where(['token' => $token, 'token_status' => 'Active'])->first();

        if ($loginToken) {

            $loginToken->token_status = 'Used';
            $loginToken->save();
            
            $user = \App\Models\User::where('username', $loginToken->app_username)->first();

            if ($user) {
                if (\Auth::login($user)) {
                    return redirect('/home');
                }
            }
        }

        return redirect('/login');
    }

    public function dd()
    {
        return view('dd');
    }
}
