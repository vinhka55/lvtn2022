<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class InfoUserController extends Controller
{
    public function show_info()
    {
        $id=Session::get('user_id');
        $data=DB::table('user')->where('id',$id)->get();
        return view('page.user.show_info',['info'=>$data]);
    }
}
