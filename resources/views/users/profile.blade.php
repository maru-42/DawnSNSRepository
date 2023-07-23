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


@endsection