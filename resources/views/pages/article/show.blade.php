@extends('layouts.app')
@section('inner_page', true)

@section('title', $article->title . ' — Sagamu.ng')
@section('meta_description', $article->excerpt ?? Str::limit(strip_tags($article->body), 160))

@section('content')

<nav class="breadcrumb">
    <div class="breadcrumb-inner">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <a href="#">{{ $article->kicker ?? 'Sagamu Today' }}</a>
        <span class="sep">/</span>
        {{ Str::limit($article->title, 50) }}
    </div>
</nav>

<div class="article-hero">
    <img src="{{ $article->hero_image ?? asset('images/blog (1).jpg') }}" alt="{{ $article->title }}" />
</div>

<div class="article-outer">
    @if($article->kicker)
        <p class="article-kicker">{{ $article->kicker }}</p>
    @endif
    <h1>{{ $article->title }}</h1>
    <div class="article-meta">
        @if($article->author)
            <span>by {{ $article->author }}</span>
            &nbsp;&middot;&nbsp;
        @endif
        @if($article->published_at)
            <span>{{ $article->published_at->format('j F Y') }}</span>
        @endif
    </div>

    <div class="article-body">
        {!! $article->body !!}
    </div>

    <div class="article-tags-row">
        <span class="article-tag">Sagamu</span>
        @if($article->kicker)
            <span class="article-tag">{{ $article->kicker }}</span>
        @endif
    </div>
</div>

@if($moreArticles->count())
<div class="more-articles">
    <div class="more-articles-inner">
        <h2>More from Sagamu Today</h2>
        <div class="article-cards-grid">
            @foreach($moreArticles as $more)
                <x-article-card :article="$more" />
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
