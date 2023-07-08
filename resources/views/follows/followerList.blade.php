@extends('layouts.login')

@section('content')


<!-- <table class='table table-hover'>
  followscontrollerから送られてきたfollowsという名前で送られた、DBから取り出した画像s['follows'=>$followsList]を、foreachで取り出して、その一つ一つの画像を$followという名前で使っていく
  @foreach ($followers as $follower)
  <tr>
    <td><img src="{{ asset('/images/'.$follower->images)}}"></td>
  </tr>
  @endforeach
</table> -->
@endsection