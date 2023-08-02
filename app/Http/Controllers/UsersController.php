<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Auth;


class UsersController extends Controller
{
    //
    public function profile($userId){
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');

        $profile = DB::table('users')
            ->find($userId);

        $postsList = DB::table('users')
            ->join('posts','users.id','=','posts.user_id')
            ->where('posts.user_id',$userId)
            ->orderBy('posts.created_at','desc')
            ->select('users.images as images','users.username as username','posts.posts as posts','posts.created_at as created_at','users.id as id')
            ->get();

        return view('users.profile',
        ['followNumbers'=>$followNumbers,'profile'=>$profile,'posts'=>$postsList]);
    }

    public function search(){
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');
            //ログインユーザーがフォローしているユーザーのidカラムを配列で取得、
            //取得したものはsearch.blade.phpのcontainsで、フォローするフォロー外すボタンのどちらを表示させるかの分岐に使用している

        // select username image from users
        $usersList = DB::table('users')
        // 自分をユーザー一覧に表示しないために記述
            ->whereNotIn('id',[Auth::id()])
            ->select('id', 'images','username')
            ->get();

        return view('users.search',['users'=>$usersList, 'followNumbers'=>$followNumbers]);
    }

    public function result(Request $request){
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');

        // select username image from users
        $word = $request->input('search');
        $usersList = DB::table('users')
            ->where('username','like','%'.$word.'%')
            // 自分をユーザー一覧に表示しないために記述
            ->whereNotIn('id',[Auth::id()])
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