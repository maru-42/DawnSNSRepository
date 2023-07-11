@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <!-- followscontrollerから送られてきたfollowsという名前で送られた、DBから取り出した画像s['follows'=>$followsList]を、foreachで取り出して、その一つ一つの画像を$followという名前で使っていく -->
  @foreach ($followImages as $followImage)
  <tr>
    <td><a href="/profile"><img src="{{ asset('/images/'.$followImage->images)}}"></a></td>
  </tr>
  @endforeach
</table>


<table class='table table-hover'>
  <!-- postscontrollerから送られてきたpostsという名前で送られた、DBから取り出した呟きs['posts'=>$postsList]を、foreachで取り出して、その一つ一つの呟きを$postという名前で使っていく -->
  @foreach ($followPosts as $followPost)
  <tr>
    <td><a href="/profile"><img src="{{ asset('/images/'.$followPost->images)}}"></a></td>
    <td>{{ $followPost->username}}</td>
    <td>{{ $followPost->posts }}</td>
    <td>{{ $followPost->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection