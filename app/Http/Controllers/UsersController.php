<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        // select username image from users
        $usersList = DB::table('users')
            ->select('images','username')
            ->get();

        return view('users.search',['users'=>$usersList]);
    }
    public function result(){
        // select username image from users
        $word = $_GET['search'];
        $usersList = DB::table('users')
            ->where('username','like','%'.$word.'%')
            ->select('images','username')
            ->get();
        // dd($usersList);
        return view('users.search',['users'=>$usersList , 'word'=>$word]);
    }
}