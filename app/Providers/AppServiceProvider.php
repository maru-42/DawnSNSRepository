<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Auth;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view)
        {
            $userInfo = AppServiceProvider::GetUserInfo();
            $view->with('userInfo',$userInfo);
        });
    }

    /**
     * サイドバーに表示するユーザー情報取得
     */
    private function GetUserInfo(){


        $userInfo = new UserInfo();

        // フォロー数
        $userInfo->followCount = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        // フォロワー数
        $userInfo->followerCount = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        $user= DB::table('users')
            ->find(Auth::id());
        if($user!=null && $user->images!=null){
            $userInfo->images = $user->images;
        }

        return $userInfo;
    }
}

class UserInfo{
    public $followCount;
    public $followerCount;
    public $images;
}