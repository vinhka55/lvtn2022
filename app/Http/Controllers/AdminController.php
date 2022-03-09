<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function register_auth()
    {
        return view('admin.login.register');
    }
    public function handle_register(Request $req)
    {
        $data=$req->all();
        $user=new Admin();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=$data['password'];
        $user->phone=$data['phone'];
        $user->save();
    }
    public function validator($request)
    {
        
    }
}
