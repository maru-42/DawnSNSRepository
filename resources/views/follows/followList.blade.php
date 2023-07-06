@extends('layouts.login')

@section('content')

<table class='table table-hover'>
  <!-- followscontrollerから送られてきたfollowsという名前で送られた、DBから取り出した画像s['follows'=>$followsList]を、foreachで取り出して、その一つ一つの呟きを$followという名前で使っていく -->
  @foreach ($follows as $follow)
  <tr>
    <td><img src="{{ asset('/images/'.$follow->images)}}"></td>
  </tr>
  @endforeach
</table>
@endsection