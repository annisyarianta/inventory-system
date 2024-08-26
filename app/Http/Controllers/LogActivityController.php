<?php

namespace App\Http\Controllers;

use App\logpostdata;
use Illuminate\Http\Request;
use DataTables;

class LogActivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $logactivities = \App\logpostdata::paginate();
        return view('logactivity.index', compact('logactivities'));
    }

    public function read(Request $request){

        $query = \App\logpostdata::query();
        $query->leftJoin('users','users.id','=','logpostdatas.log_user');
        $query->select('logpostdatas.log_id','logpostdatas.log_date','logpostdatas.log_uri','users.name','log_method');

        return DataTables::of($query)->toJson();
    }
}
