<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初期ユーザー登録
        DB::table('users')->insert([
            'username' => 'ユーザー1',
            'mail' => 'user1@user1.com',
            'password' => 'user1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
         ]);
    }
}