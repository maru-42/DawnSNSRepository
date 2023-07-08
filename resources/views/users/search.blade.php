@extends('layouts.login')

@section('content')

<!-- 以下この記事を参考にして記述 -->
<!-- https://takuma-it.com/laravel-keyword-search/ -->
<!-- formタグのvalue="@if (isset($search)) {{ $search }} @endif"で検索した後に、検索した値をフォーム内に保持することができます。 -->
<div class="">
  <div class="">
    <form method="GET" action="result">
      @csrf
      <input type="text" placeholder="ユーザー名" name="search" value="@if (isset($search)) {{ $search }} @endif">
      <input type="submit"></input>
      <!-- もしurlがresultになったらuserscontrollerから$wordを取ってきたい -->
    </form>
  </div>
  <div class="">
    <p>検索ワード:{{ $word }}</p>
  </div>
</div>
<table class='table table-hover'>
  <!-- userscontrollerから送られてきたusersという名前で送られた、DBから取り出した情報['users'=>$usersList]を、foreachで取り出して、その一つ一つの呟きを$userという名前で使っていく -->
  @foreach ($users as $user)
  <tr>
    <td><img src="{{ asset('/images/'.$user->images)}}"></td>
    <td>{{ $user->username}}</td>
  </tr>
  @endforeach
</table>

@endsection