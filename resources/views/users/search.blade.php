@extends('layouts.login')

@section('content')

<!-- 以下この記事を参考にして記述 -->
<!-- https://takuma-it.com/laravel-keyword-search/ -->
<!-- formタグのvalue="@if (isset($search)) {{ $search }} @endif"で検索した後に、検索した値をフォーム内に保持することができます。 -->
<form method="GET" action="index.blade.php">
  @csrf
  <input type="text" placeholder="ユーザー名" name="search" value="@if (isset($search)) {{ $search }} @endif">
  <input type="submit"></input>
</form>

<table class='table table-hover'>
  <!-- postscontrollerから送られてきたpostsという名前で送られた、DBから取り出した呟きs['posts'=>$postsList]を、foreachで取り出して、その一つ一つの呟きを$postという名前で使っていく -->
  @foreach ($users as $user)
  <tr>
    <td><img src="{{ asset('/images/'.$user->images)}}"></td>
    <td>{{ $user->username}}</td>
  </tr>
  @endforeach
</table>

@endsection