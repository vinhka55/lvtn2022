<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    public function index()
    {
        $data=DB::table('category')->get();
        // echo("<pre>");
        // var_dump($data);
        // return;
        return view('page.home',['category'=>$data]);
    }
}
