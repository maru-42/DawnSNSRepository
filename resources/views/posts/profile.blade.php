@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <tr>
    <td><a href="/profile"><img src="{{ asset('/images/'.$profile->images)}}"></a></td>
    <td>{{ $profile->username}}</td>
    <td>{{ $profile->mail}}</td>
    <td>{{ $profile->password}}</td>
    <td>{{ $profile->bio }}</td>
    <td><a href="/profile"><img src="{{ asset('/images/'.$profile->images)}}"></a></td>

  </tr>
</table>


@endsection