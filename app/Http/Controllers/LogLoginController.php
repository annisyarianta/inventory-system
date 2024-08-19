<?php

use App\LogLogin;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogLoginController extends Controller
{
    //
    public function index(Request $request)
    {
        $loglogins = \App\LogLogin::leftJoin('users','loglogins.loglogin_user','=','users.id')->paginate();
        return view('loglogin.index', compact('loglogins'));
    }
}
