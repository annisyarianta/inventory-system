<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            return redirect('/dashboardatk');
        }
        return redirect('/loginatk');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/loginatk');
    }
}
