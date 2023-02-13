@extends('layouts.my_layout')

@section('title','投稿一覧')

@section('content')


@if (session('message'))
<div class="alert-light">
    {{ session('message') }}
</div>
@endif
{{-- フォーム --}}
<form class="my-2" action="{{ route('post.store')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">タイトル</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <span class="input-group-text">本文</span>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">投稿</button>
</form>

{{-- 投稿一覧 --}}
<p class="fs-3">投稿一覧</p>
<div class="accordion" id="description">
    @foreach ($posts as $index => $post)
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#target-{{$index}}"
                aria-expanded="false" aria-controls="target-{{$index}}">
                {{$post->title}}
            </button>
        </h2>
        <div id="target-{{$index}}" class="accordion-collapse collapse" aria-labelledby="headingOne">
            {{-- 投稿タイトル --}}
            <div class="accordion-body">
                {{ $post->description }}
            </div>
            {{-- コメント投稿フォーム --}}
            <div class="p-3 row g-3 align-items-center">
                <form action="{{ route('comment.store',[$post->id]) }}" method="POST">
                    @csrf
                    <div class="col-auto mb-2">
                        <input type="text" id="inputPassword6" class="form-control" name="context">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">コメント投稿</button>
                    </div>
                </form>
            </div>
            <p class="fs-5 m-2">コメント一覧</p>
            @if(empty($post->comments))
            <p class="m-2">コメントが投稿されていません</p>
            @else
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                <li class="list-group-item d-flex justify-content-between">
                    <p>
                        {{ $comment->context}}
                    </p>
                    <p class="text-muted">
                        コメント投稿日
                        {{$comment->created_at}}
                    </p>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection