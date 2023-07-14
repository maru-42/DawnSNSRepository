@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <tr>
    <td><a href="/profile/{{ $profile->id}}"><img src="{{ asset('/images/'.$profile->images)}}"></a></td>
    <td>{{ $profile->username}}</td>
    <td>{{ $profile->bio }}</td>
  </tr>
</table>


@endsection