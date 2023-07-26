<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            $request->validate([
                'mail' => 'required|string|email|min:4|max:255',
                'password' => 'required|string|min:4|max:12'
            ],
            [
                'mail.required' => 'メールアドレスを入力してください',
            'mail.string' => 'メールアドレスを文字列で入力してください',
            'mail.email' => 'メールアドレスを入力してください',
            'mail.min' => 'メールアドレスを4文字以上で入力してください',
            'mail.max' => 'メールアドレスを255文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードを4文字以上で入力してください',
            'password.max' => 'パスワードを12文字以内で入力してください'
            ]);
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/top');
            }
        }
        return view("auth.login");
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}