@extends('layouts.login')

@section('content')
{!! Form::open(['url' => '/top']) !!}
<div class="form-group">
  {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?']) !!}
</div>
<button type="submit" class="btn btn-success pull-right">追加</button>
{!! Form::close() !!}

<table class='table table-hover'>
  <!-- postscontrollerから送られてきたpostsという名前で送られた、DBから取り出した呟きs['posts'=>$postsList]を、foreachで取り出して、その一つ一つの呟きを$postという名前で使っていく -->
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