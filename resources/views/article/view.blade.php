@extends('layouts.master')
@section('title')
    {{ $article->title }}
@endsection
@section('li-article', 'active')
@section('content')
    <div class="container">
        <div class="card">
            <div class="px-5 py-5">
                <h1 class="h2 font-weight-bold text-primary ">{{ $article->title }}</h1>
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <div><i class="fa fa-user text-primary mr-2"></i> <span>{{ $article->author->name }}</span></div>
                    <div><i class="fa fa-clock text-primary mr-2"></i> <span>{{ $article->created_at }}</span></div>
                    <div><i class="fa fa-tag text-primary mr-2"></i> <span>{{ $article->category->name }}</span></div>
                </div>
                <div class="mb-4">
                    <img class="rounded w-100" src="{{ asset('article_images/' . $article->thumbnail) }}"
                        alt="{{ $article->title }}">
                </div>
                <div>
                    {!! $article->content !!}
                </div>
            </div>

        </div>
    </div>
@endsection
