@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <!-- followscontrollerから送られてきたfollowsという名前で送られた、DBから取り出した画像s['follows'=>$followsList]を、foreachで取り出して、その一つ一つの画像を$followという名前で使っていく -->
  @foreach ($follows as $follow)
  <tr>
    <td><img src="{{ asset('/images/'.$follow->images)}}"></td>
  </tr>
  @endforeach
</table>

<!-- <table class='table table-hover'> -->
<!-- followscontrollerから送られてきたfollowsという名前で送られた、DBから取り出したフォローユーザーのつぶやき一覧['follows'=>$followsList]を、foreachで取り出して、その一つ一つのフォローユーザーの呟きを$〇〇という名前で使っていく
  ってことはfollowcontrollerで取得するものは画像だけではなく、呟きとユーザーネームもってこと？-->

<!-- @foreach ($posts as $post)
  <tr>
    <td><img src="{{ asset('/images/'.$post->images)}}"></td>
    <td>{{ $post->username}}</td>
    <td>{{ $post->posts }}</td>
    <td>{{ $post->created_at }}</td>
  </tr>
  @endforeach
</table> -->

@endsection