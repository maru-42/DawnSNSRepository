<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;



class PostsController extends Controller
{
    //
    public function index(){
        $postsList = DB::table('posts')
            // ユーザーidの中で現在認証されているものを
            ->where('user_id',Auth::id())
            // 更新された順で
            ->orderBy('updated_at','desc')
            // 取得
            ->get();
        return view('posts.index',['posts'=>$postsList]);
    }

     public function create(Request $request)
    {
        // index.blade.phpのリクエストから投稿内容を取得
        $post = $request->input('newPost');
        // 現在認証されているユーザーのIDを取得
        $userId = Auth::id();

        DB::table('posts')->insert([
            'user_id' =>$userId,
            'posts' => $post,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        return redirect('/top');
    }
}