<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
    function sessionLoginInfomation(Request $request)
    {
        $data = $request->data;
        session()->put('info',$data);
        return;
    }
}
