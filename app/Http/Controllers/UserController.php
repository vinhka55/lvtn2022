<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $admin=Admin::with('roles')->orderBy('id',"desc")->paginate(5);
        return view('admin.user.list')->with(compact('admin'));
    }
    public function assign_roles(Request $request){
        
        $user = Admin::where('email',$request->email)->first();
        $user->roles()->detach(); //Lệnh detach xóa hết quyền user
        if($request->author_role){
            //Lệnh acttach gán quyền cho user
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request->user_role){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request->admin_role){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message','Gán quyền cho user thành công');
    }
    public function delete($id)
    {
        $user=Admin::find($id);
        if($user){
            $user->roles()->detach();
            $user->delete();
            return redirect()->back();
        }
    }
    public function user_change_avatar(Request $req)
    {
        $user=User::find($req->hidden_id_user);
        $user->avatar=$req->file("change_avatar");

        if($user->avatar){
            $name_avatar= $user->avatar->getClientOriginalName();
            $user->avatar->move("public/uploads/avatar",$name_avatar);
            $user->avatar=$name_avatar;
            $user->save();        
        }
        return redirect('/thong-tin-tai-khoan');
    }
}
