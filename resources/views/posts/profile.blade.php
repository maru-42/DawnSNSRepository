@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <div class="">
    <a href="/profile"><img src="{{ asset('/images/'.$profile->images)}}"></a>
  </div>

  {!! Form::open() !!}
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
    {{Form::label('inputName','UserName')}}
    <div class="">
      {{Form::text('inputName', $profile->username, ['class'=>'form-control', 'id'=>'inputName', 'placeholder'=>'UserName'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::label('inputEmail','MailAdress')}}
    <div class="">
      {{Form::email('inputEmail', $profile->mail, ['class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'MailAdress'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::label('inputPassword','Password')}}
    <div class="">
      {{Form::password('inputPassword', ['class'=>'form-control', 'id'=>'inputPassword','readonly', 'placeholder'=>'●●●●●●'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::label('inputPassword','new Password')}}
    <div class="">
      {{Form::password('inputPassword', ['class'=>'form-control', 'id'=>'inputPassword', 'placeholder'=>'new Password'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::label('inputBio','Bio')}}
    <div class="">
      {{Form::textarea('inputBio', $profile->bio,['class'=>'form-control', 'id'=>'inputBio', 'placeholder'=>'Bio'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::file('image', ['class'=>'custom-file-input', 'id'=>'fileimage'])}}
    <div class="">
      {{Form::label('image', 'ファイルを選択', ['class'=>'custom-file-label'])}}
    </div>
  </div>

  <div class="form-group row">
    {{Form::submit('更新', ['class'=>'btn btn-primary btn-block'])}}
  </div>

  {!! Form::close() !!}

</table>


@endsection