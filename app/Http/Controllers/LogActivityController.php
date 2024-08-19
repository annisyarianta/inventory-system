<?php

namespace App\Http\Controllers;

use App\logpostdata;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $logactivities = \App\logpostdata::paginate(10);
        return view('logactivity.index', compact('logactivities'));
    }
}
