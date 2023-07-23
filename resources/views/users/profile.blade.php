@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <tr>
    <td><a href="/profile/{{ $profile->id}}"><img src="{{ asset('/images/'.$profile->images)}}"></a></td>
    <th>Name</th>
    <td>{{ $profile->username}}</td>
  </tr>
  <tr>
    <td></td>
    <th>Bio</th>
    <td>{{ $profile->bio }}</td>
    @if($followNumbers->contains($profile->id))
    <td><a href="unFollowed/{{ $profile->id}}">フォローをはずす</a></td>
    @else
    <td><a href="followed/{{ $profile->id}}">フォローする</a></td>
    @endif
  </tr>
</table>

<table class='table table-hover'>
  @foreach ($posts as $post)
  <tr>
    <td><a href="/profile/{{ $post->id}}"><img src="{{ asset('/images/'.$post->images)}}"></a></td>
    <td>{{ $post->username}}</td>
    <td>{{ $post->posts }}</td>
    <td>{{ $post->created_at }}</td>
  </tr>
  @endforeach
</table>


@endsection