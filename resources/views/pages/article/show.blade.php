@extends('layouts.app')
@section('inner_page', true)

@section('title', $article->title . ' | Sagamu.ng — Sagamu City Guide')
@section('meta_description', $article->excerpt ?? Str::limit(strip_tags($article->body), 155))
@section('canonical', route('article.show', $article->slug))
@section('og_type', 'article')
@section('og_image', $article->hero_image ?? asset('images/og-default.jpg'))
@section('og_image_alt', $article->title . ' — Sagamu.ng')

@push('schema')
@php
    $schema = [
        '@context'         => 'https://schema.org',
        '@type'            => 'NewsArticle',
        '@id'              => route('article.show', $article->slug) . '#article',
        'headline'         => $article->title,
        'description'      => $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->body), 200),
        'url'              => route('article.show', $article->slug),
        'image'            => $article->hero_image ?? asset('images/og-default.jpg'),
        'publisher'        => ['@id' => url('/') . '/#organization'],
        'isPartOf'         => ['@id' => url('/') . '/#website'],
        'inLanguage'       => 'en-NG',
        'about'            => ['@type' => 'City', 'name' => 'Sagamu', 'containedInPlace' => ['@type' => 'State', 'name' => 'Ogun State']],
    ];
    if ($article->author)       $schema['author']       = ['@type' => 'Person', 'name' => $article->author];
    if ($article->published_at) $schema['datePublished'] = $article->published_at->toIso8601String();
    if ($article->updated_at)   $schema['dateModified']  = $article->updated_at->toIso8601String();

    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',          'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => ($article->kicker ?? 'Sagamu Today'), 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $article->title, 'item' => route('article.show', $article->slug)],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endpush

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
