@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <!-- followscontrollerから送られてきたfollowsという名前で送られた、DBから取り出した画像s['follows'=>$followsList]を、foreachで取り出して、その一つ一つの画像を$followという名前で使っていく -->
  @foreach ($followerImages as $followerImage)
  <tr>
    <td><a href="/profile/{{ $followerImage->id}}"><img src="{{ asset('/images/'.$followerImage->images)}}"></a></td>
  </tr>
  @endforeach
</table>

<table class='table table-hover'>
  <!-- postscontrollerから送られてきたpostsという名前で送られた、DBから取り出した呟きs['posts'=>$postsList]を、foreachで取り出して、その一つ一つの呟きを$postという名前で使っていく -->
  @foreach ($followerPosts as $followerPost)
  <tr>
    <td><a href="/profile/{{ $followerPost->id}}"><img src="{{ asset('/images/'.$followerPost->images)}}"></a></td>
    <td>{{ $followerPost->username}}</td>
    <td>{{ $followerPost->posts }}</td>
    <td>{{ $followerPost->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection