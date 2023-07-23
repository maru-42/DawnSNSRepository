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
  </tr>
</table>


@endsection