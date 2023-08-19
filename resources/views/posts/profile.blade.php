@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <div class="">
    <a href="/profile"><img src="{{ asset('/images/'.$profile->images)}}"></a>
  </div>

  {!! Form::open(['url'=>'/profile','method'=>'post','files'=>true]) !!}
  {{ Form::token()}}

  @if ($errors->any())
  <div class="error" style="color:red">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="form-group row">
    {{Form::label('username','UserName')}}
    <div class="">
      {{Form::text('username', $profile->username, ['class'=>'form-control', 'id'=>'username', 'placeholder'=>'UserName'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::label('mail','MailAdress')}}
    <div class="">
      {{Form::email('mail', $profile->mail, ['class'=>'form-control', 'id'=>'mail', 'placeholder'=>'MailAdress'])}}
    </div>
  </div>
  <div class="form-group row">
    {{Form::label('oldPassword','Password')}}
    <div class="">
      {{Form::password('oldPassword', ['class'=>'form-control', 'id'=>'oldPassword','readonly', 'placeholder'=>'●●●●●●'])}}
    </div>
  </div>
  <div class="form-group row">
    {{Form::label('password','new Password')}}
    <div class="">
      {{Form::password('password', ['class'=>'form-control', 'id'=>'password', 'placeholder'=>'new Password'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::label('bio','Bio')}}
    <div class="">
      {{Form::textarea('bio', $profile->bio,['class'=>'form-control', 'id'=>'bio', 'placeholder'=>'Bio'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::file('images', ['class'=>'custom-file-input', 'id'=>'images'])}}
    <div class="">
      {{Form::label('images', 'ファイルを選択', ['class'=>'custom-file-label'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::submit('更新', ['class'=>'btn btn-primary btn-block'])}}
  </div>

  {!! Form::close() !!}

</table>


@endsection