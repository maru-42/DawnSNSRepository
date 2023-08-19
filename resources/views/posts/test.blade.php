@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  @foreach ($posts as $post)
  <tr>
    <td><img src="{{ asset('/images/'.$post->images)}}"></a></td>
    <td>{{ $post->username}}</td>
    <td>{{ $post->posts }}</td>
    <td>{{ $post->created_at }}</td>

    @endforeach
</table>

@endsection