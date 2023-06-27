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
        return view('posts.index');
    }

     public function create(Request $request)
    {
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            // 現在認証されているユーザーのIDを取得
            'user_id' =>Auth::id(),
            'posts' => $post,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        return redirect('/top');
    }
}