<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd('welcome validation');ここまできてること確認済み
        return Validator::make($data, [
            // 詳細設計書に従って、validation項目を追加
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:255|unique:users',
            'password' => 'required|string|min:4|max:12',
            'password-confirm' => 'required|string|min:4|max:12|same:password',
        ]
        // [
        // 'username.required'=>'必須項目です',
        // 'username.string'=>'文字列を記入してください',
        // 'username.min'=>'4文字以上で入力してください',
        // 'username.max'=>'12文字以下で入力してください'
        // ]
        )->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $request->validate([
            // 詳細設計書に従って、validation項目を追加
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:255|unique:users',
            'password' => 'required|string|min:4|max:12',
            'password-confirm' => 'required|string|min:4|max:12|same:password',
        ],
        [
            'username.required' => '名前を入力してください',
            'username.string' => '名前を文字列で入力してください',
            'username.min' => '名前を4文字以上で入力してください',
            'username.max' => '名前を12文字以内で入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.string' => 'メールアドレスを文字列で入力してください',
            'mail.email' => 'メールアドレスを入力してください',
            'mail.min' => 'メールアドレスを4文字以上で入力してください',
            'mail.max' => 'メールアドレスを255文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードを4文字以上で入力してください',
            'password.max' => 'パスワードを12文字以内で入力してください',
            'password.unique:users' => 'そのパスワードは使えません。違うものを入力してください',
            'password-confirm.required' => 'パスワード確認を入力してください',
            'password-confirm.min' => 'パスワード確認を4文字以上で入力してください',
            'password-confirm.max' => 'パスワード確認を12文字以内で入力してください',
            'password-confirm.unique:users' => 'そのパスワードは使えません。違うものを入力してください',
            'password-confirm.same:password' => 'パスワードとパスワード確認は同じものにしてください',

    ]);
            $this->create($data);
        $username = $data['username'];
            return view('auth.added',['username'=>$username]);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}