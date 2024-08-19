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
        $credentials = ['email' => $request->username, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on the user's role
            if ($user->role === 'admin') {
                return redirect('/dashboardatk');
            } elseif ($user->role === 'staff') {
                return redirect('/daftar');
            }
        }

        return redirect('/loginatk')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/loginatk');
    }
}
