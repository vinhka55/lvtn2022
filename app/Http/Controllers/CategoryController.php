<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($name)        
    {

        return view('page.detail',['name'=>$name,]);
    }
}
