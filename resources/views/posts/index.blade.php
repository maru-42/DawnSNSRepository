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
    <td><a href="/profile/{{ $post->user_id}}"><img src="{{ asset('/images/'.$post->images)}}"></a></td>
    <td>{{ $post->username}}</td>
    <td>{{ $post->posts }}</td>
    <td>{{ $post->created_at }}</td>
    @if ($post->user_id==Auth::id())
    <td><img src="{{ asset('/images/edit.png')}}" id="edit-form" onclick="editModal({{$post->post_id}})"></td>
    <td><img src="{{ asset('/images/trash.png')}}" onclick="deleteModal({{$post->post_id}})"></td>
    @endif
  </tr>

  <div class="modal-main edit-modal editModal-{{ $post->post_id }}">
    <div class="modal-inner modal-content">
      <h2>投稿編集</h2>
      <form method="POST" enctype="multipart/form-data" action="{{ url('post/update/') }}">
        @csrf
        <textarea name="posts" cols="30" rows="10"></textarea>
        <input type="hidden" name="post_id" value="{{ $post->post_id }}" />
        <div class="line-right">
          <!-- モーダルを閉じるボタン(関数名と一致させないとモーダルが閉じません) -->
          <button type="button" class="left-button" onclick="editModal({{ $post->post_id }})">キャンセル</button>
          <!-- 送信ボタン -->
          <button type="submit" class="right-button" onclick="editModal({{ $post->post_id }})">保存</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-main delete-modal deleteModal-{{ $post->post_id }}">
    <div class="modal-inner modal-content">
      <h2>投稿削除</h2>
      <form method="POST" enctype="multipart/form-data" action="{{ url('post/delete/') }}/{{$post->post_id}}">
        @csrf
        <textarea name="posts" cols="30" rows="10"></textarea>
        {{ $post->post_id }}
        <div class="line-right">
          <!-- モーダルを閉じるボタン(関数名と一致させないとモーダルが閉じません) -->
          <button type="button" class="left-button" onclick="deleteModal({{ $post->post_id }})">キャンセル</button>
          <!-- 送信ボタン -->
          <button type="submit" class="right-button" onclick="deleteModal({{ $post->post_id }})">保存</button>
        </div>
      </form>
    </div>
  </div>
  @endforeach
</table>

@endsection