<?php


namespace App\Http\Controllers;

use app\loglogin;
use Illuminate\Http\Request;
use DataTables;

class LogLoginController extends Controller
{
    //
    public function index(Request $request)
    {
        $loglogins = \App\LogLogin::leftJoin('users','loglogins.loglogin_user','=','users.id')->paginate();
        return view('loglogin.index', compact('loglogins'));
    }

    public function read(Request $request){
        $query = \App\LogLogin::query();
        $query->leftJoin('users','users.id','=','loglogins.loglogin_user');
        $query->select('loglogins.loglogin_id','loglogins.loglogin_created_at','users.name');

        return DataTables::of($query)->toJson();
    }
}
