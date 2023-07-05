<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;



class PostsController extends Controller
{
    //2.6	ログイン中のみ閲覧可能なページの設定のために記述
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $postsList = DB::table('posts')
            //投稿を表示したいのですが、postsテーブルには投稿内容しか保存されておりません。なので、画像とユーザー名を取ってくるためにはUsersテーブルとも結合させないといけません。
            ->join('users','posts.user_id','=','users.id')
            // ユーザーidの中で現在認証されているものを
            ->where('posts.user_id',Auth::id())
            // 投稿された順で
            ->orderBy('posts.created_at','desc')
            //usersテーブルの画像とユーザー名、postsテーブルのposts(投稿)と投稿日時を取得
            ->select('users.images as images','users.username as username','posts.posts as posts','posts.created_at as created_at')
            // 取得
            ->get();

        // 「4.2.1	ログインユーザーのフォローのつぶやきを表示」をやろうとした
        //0.ログインユーザーのIdを取得
        // $loginUserId = Auth::id();

        //1.フォローしてる人のuserId(followsテーブルのfollow) を抽出する
        //$followUserIds = select follow from follows where follower=$loginUserId;

        //2.その人たち(0.で作った$loginUserIdと1.で作った$followUserIds)の呟きを取得,user名と画像も持ってくる
        //select * from posts join users on posts.user_id=users.id
        //where posts.user_id=$userId or posts.user_id=$followUserIds;
        //なんだけど、「posts.user_id=$followUserIds」これは一つずつしか対応してくれないから、繰り返し処理が必要、foreachを使ってフォローしている人みんなのを取得する


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