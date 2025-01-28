@extends('layouts.base')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        ToDo詳細
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ $todo->content }}</h5>
        <p class="card-text">作成日時：{{ $todo->created_at }}</p>
      </div>
      <div class="row">
          <!-- 編集ボタンを追加 -->
          <div class="col-auto">
            <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-primary">編集</a> <!-- 編集ボタン -->
          </div>
          <div class="col-auto">
            <form method="POST" action="{{ route('todo.delete', $todo->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">削除する</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection