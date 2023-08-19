<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FollowsController extends Controller
{
    //
    public function followList(){
        // select images from usersだけど、取ってきたいのはログインしているユーザーがfollowしているユーザーのimagesだから、usersテーブルとfollowsテーブルを結合する必要がある？
        // select * from users where カラム名 = 値(今回の場合はログインユーザー)みたいな感じで、followerId＝ログインユーザーのfollowの情報を持ってきたい
        //joinは結合、whereは検索条件、selectは必要なカラムを選んで取得
        //ユーザーズテーブルとフォローズテーブルを結合し、検索条件はフォローズテーブルのフォロワーがログインユーザーのidであるレコードとし、imagesとuser.idを選択して取得したものを、$followImageListとおく
        $followImageList = DB::table('users')
            ->join('follows','users.id','=','follows.follow')
            ->where('follows.follower',Auth::id())
            ->select('users.images as images','users.id as id')
            ->get();

        // select * from users join posts on users.id = posts.user_id
        // join follows on users.id = follows.follow
        // where follows.follower = Auth::id()
        // orderBy('posts.created_at','desc')
        //ユーザーズ
        $followPostList = DB::table('users')
            ->join('posts','users.id','=','posts.user_id')
            ->join('follows','users.id','=','follows.follow')
            ->where('follows.follower',Auth::id())
            ->whereNotIn('users.id',[Auth::id()])
            ->orderBy('posts.created_at','desc')
            ->select('users.images as images','users.username as username','posts.posts as posts','posts.created_at as created_at','users.id as id')
            ->get();

        return view('follows.followList',['followImages'=>$followImageList,
        'followPosts'=>$followPostList]);
    }
    public function followerList(){
        $followerImageList = DB::table('users')
            ->join('follows','users.id','=','follows.follower')
            ->where('follows.follow',Auth::id())
            ->select('users.images as images','users.id as id')
            ->get();

            $followerPostList = DB::table('users')
            ->join('posts','users.id','=','posts.user_id')
            ->join('follows','users.id','=','follows.follower')
            ->where('follows.follow',Auth::id())
            ->whereNotIn('users.id',[Auth::id()])
            ->orderBy('posts.created_at','desc')
            ->select('users.images as images','users.username as username','posts.posts as posts','posts.created_at as created_at','users.id as id')
            ->get();

        return view('follows.followerList',['followerImages'=>$followerImageList,
        'followerPosts'=>$followerPostList]);
    }
}