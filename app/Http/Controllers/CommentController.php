<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ReplyComment;
use Carbon\Carbon;
use DB;
use Session;
use Auth;


class CommentController extends Controller
{
    public function show_comment(Request $req)
    {
        $name_user=Session::get('name_user');
        $avatar_of_new_comment=DB::table('user')->where('id',Session::get('user_id'))->value('avatar');
        $comment=Comment::where('product_id',$req->id_product)->orderBy('id','desc')->where("status",true)->get();
        $all_rep_comment=ReplyComment::orderBy('id','desc')->get();
        $output="";
        foreach ($comment as $key => $value) {
            $avatar=DB::table('user')->where('id',$value->user_id)->value('avatar');
            $output=$output.'<div class="col-md-3" style="border: 2px solid black;">
                                    <img width="50%" src="'.url("public/uploads/avatar/{$avatar}").'" alt="my avatar">
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-success">@ '.$value->name_user_comment.'</p>'.
                                        '<p><b>'.$value->content.'</b></p>'.
                                        '<p>'.Carbon::parse($value->time)->format('d-m-Y').'</p>'.
                                    '</div>
                                    <button onclick="rep('.$value->id.')" class="rep-comment-ui">Trả lời</button>
                                    <div class="comment-reply-'.$value->id.'"></div>
                                    <div class="row append-reply-'.$value->id.'"><input class="name-'.$value->id.'" type="hidden" value="'.$name_user.'">
                                    <input class="avatar-'.$value->id.'" type="hidden" value="'.$avatar_of_new_comment.'"></div>';
            foreach ($all_rep_comment as $rep) {
                if($rep->user_id!=0)
                $avatar_rep=DB::table('user')->where('id',$rep->user_id)->value('avatar');
                else $avatar_rep="admin.jfif";
                if($rep->user_id!=0)
                    $name=DB::table('user')->where('id',$rep->user_id)->value('name');
                else $name="Admin";
                if($value->id==$rep->id_parent_comment){
                    $output=$output.'<div class="col-md-3" style="border: 2px solid black;">
                                        <img width="50%" src="'.url("public/uploads/avatar/{$avatar_rep}").'" alt="my avatar">
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-success">@ '.$name.'</p>'.
                                        '<p>'.$rep->content.'</p>'.
                                        '<p>'.Carbon::parse($rep->time)->format('d-m-Y').'</p>'.
                                    '</div>';
                }
            }                    
        }
        echo $output;
    }
    public function send_comment(Request $req)
    {
        $comment=new Comment();
        $comment->content=$req->content;
        $comment->name_user_comment=Session::get("name_user");
        $comment->user_id=Session::get("user_id");
        $comment->product_id=$req->product_id;
        $comment->save();
    }
    public function list_comment()
    {
        $all_comment=Comment::with("product")->orderBy("id","desc")->get();
        $all_reply_comment=ReplyComment::all();
        return view('admin.comment.list',compact('all_comment','all_reply_comment'));
    }
    public function change_status_comment(Request $req)
    {
        $comment=Comment::find($req->id_comment);
        $comment->status=!$comment->status;
        $comment->save();
        return redirect('/admin/danh-sach-binh-luan');
    }
    public function admin_rep(Request $req)
    {
        $reply_comment=new ReplyComment();
        $reply_comment->content=$req->content_reply;
        $reply_comment->id_parent_comment=$req->id_comment;
        if(Auth::check()) $reply_comment->user_id=0;
        else{
            $reply_comment->user_id=Session::get('user_id');
        }
        $reply_comment->save();
    }
}