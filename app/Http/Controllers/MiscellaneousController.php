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


    function reputTerm(Request $request)
    {
        $arr = session()->get('info');

        $arr['data']['term'] = json_decode($request->term, true);
        session()->put('info', $arr);
        return;
    }
}
