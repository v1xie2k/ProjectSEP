<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function home(Request $request)
    {
        if(isLogin())return view('master.User.home');
        abort(403);
    }
}
