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
            'password-confsirm' => 'required|string|min:4|max:12|same:password',
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
            // バリデーションするために追加
            $validator = $this->validator($data);

            if ($validator->fails()){
                return redirect('added')
                ->withErrors($validator)
                ->withInput();
            }
            $this->create($data);

            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}