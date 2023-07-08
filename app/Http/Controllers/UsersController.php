<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Auth;


class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function search(){
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');

        // select username image from users
        $usersList = DB::table('users')
            ->select('id', 'images','username')
            ->get();

        return view('users.search',['users'=>$usersList, 'followNumbers'=>$followNumbers]);
    }

    public function result(){
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');

        // select username image from users
        $word = $_GET['search'];
        $usersList = DB::table('users')
            ->where('username','like','%'.$word.'%')
            ->select('id','images','username')
            ->get();
        // dd($usersList);
        return view('users.search',['users'=>$usersList, 'followNumbers'=>$followNumbers , 'word'=>$word]);
    }

    public function followed($userId){
        // フォローするボタンを押されたらfollowsテーブルに、followがフォローボタンを押された人のid、followに自分のidをinsertする
        // insert into follows (カラム1(follow),カラム2(follower),カラム3(created_at)) values(レコード1,レコード2,レコード3);
        DB::table('follows')->insert([
            'follow' =>$userId,
            'follower' => Auth::id(),
            'created_at' => new DateTime(),
        ]);
        // その後ボタンをフォローをはずすに変更
        return back();
    }

    public function unFollowed($userId){
          // フォローはずすボタンを押されたらfollowsテーブルのレコードをdeleteする
        //   delete from follows where id =削除したい番号;
        DB::table('follows')
            ->where('follow',$userId)
            ->where('follower',Auth::id())
            ->delete();
        // その後ボタンをフォローするに変更
        return back();
    }
}