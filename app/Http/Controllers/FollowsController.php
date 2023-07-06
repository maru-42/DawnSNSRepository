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
        // select * from users where カラム名 = 値(今回の場合はログインユーザー)みたいな感じで、followId＝ログインユーザーのfollowerの情報を持ってきたい
        $followList = DB::table('users')
            ->join('follows','users.id','=','follows.follower')
            ->where('follows.follow',Auth::id())
            ->select('users.images as images')
            ->get();

        return view('follows.followList',['follows'=>$followList]);
    }
    public function followerList(){
        return view('follows.followerList');
    }
}