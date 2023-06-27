@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

{!! Form::open(['url' => '/top']) !!}
<div class="form-group">
  {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?']) !!}
</div>
<button type="submit" class="btn btn-success pull-right">追加</button>
{!! Form::close() !!}

@endsection