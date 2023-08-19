@extends('layouts.login')

@section('content')
<div class="form-group">
  {!! Form::open(['url' => '/top']) !!}
  <img src="{{ asset('/images/'.$userInfo->images) }}">
  {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?']) !!}
  <input type="image" src="{{ asset('/images/post.png')}}" alt="クリックで送信 " />
  {!! Form::close() !!}
</div>

<table class='table table-hover'>
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

  <div class="modal-main edit-modal editModal-{{ $post->post_id }}" id="js-editModal">
    <div class="modal-inner modal-content" id="js-editModal-content">
      <div id="js-edit-uchigawa">
        <h2>投稿編集</h2>
        <form method="POST" enctype="multipart/form-data" action="{{ url('post/update/') }}">
          @csrf
          <textarea name="posts" cols="30" rows="10">{{ $post->posts}}</textarea>
          <input type="hidden" name="post_id" value="{{ $post->post_id }}" />
          <div class="line-right">
            <button type="button" class="left-button" onclick="editModal({{ $post->post_id }})">キャンセル</button>
            <!-- 送信ボタン -->
            <button type="submit" class="right-button" onclick="editModal({{ $post->post_id }})">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal-main delete-modal deleteModal-{{ $post->post_id }}" id="js-deleteModal">
    <div class="modal-inner modal-content" id="js-deleteModal-content">
      <div id="js-delete-uchigawa">
        <h2>削除</h2>
        <form method="POST" enctype="multipart/form-data" action="{{ url('post/delete/') }}">
          @csrf
          <input type="hidden" name="post_id" value="{{ $post->post_id }}" />
          <div class="line-right">
            <button type="button" class="left-button" onclick="deleteModal({{ $post->post_id }})">キャンセル</button>
            <!-- 送信ボタン -->
            <button type="submit" class="right-button" onclick="deleteModal({{ $post->post_id }})">削除</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</table>

@endsection