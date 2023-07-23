<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Validator;




class PostsController extends Controller
{
    //2.6	ログイン中のみ閲覧可能なページの設定のために記述
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
       $postsList = DB::table('users')
            ->join('posts','users.id','=','posts.user_id')
            ->join('follows','users.id','=','follows.follow')
            ->where('follows.follower',Auth::id())
            ->orWhere('posts.user_id',Auth::id())
            ->orderBy('posts.created_at','desc')
            ->select('users.images as images','users.username as username','posts.posts as posts','posts.created_at as created_at','users.id as id')
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

    public function profile(){
        $profile = DB::table('users')
            ->find(Auth::id());
        return view('posts.profile',
        ['profile'=>$profile]);
    }

     public function update(Request $request){
            $data = $request->input();
            // バリデーションするために追加
            $validator = $this->validator($data);

            if ($validator->fails()){
                return redirect('profile')
                ->withErrors($validator)
                ->withInput();
            }
            // $this->update($data);

            return redirect('profile');
        }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:255|unique:users',
            'new password' => 'alpha_num|min:4|max:12|unique:users|',
            'bio' => 'max:200',
            'icon image' => 'alpha_num|image'
        ])->validate();
    }
}