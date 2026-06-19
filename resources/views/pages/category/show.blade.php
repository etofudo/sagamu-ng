@extends('layouts.app')
@section('inner_page', true)

@section('title', $category->name . ' in Sagamu — Sagamu.ng')

@section('content')

<div class="cat-hero">
    <div class="cat-hero-inner">
        <div>
            <h1>{{ $category->name }} in Sagamu</h1>
            <p>Find every {{ strtolower($category->name) }} in Sagamu, listed by neighbourhood</p>
        </div>
        <div class="cat-hero-count">
            {{ $listings->total() }}
            <small>listings</small>
        </div>
    </div>
</div>

<div class="filter-bar">
    <div class="filter-bar-inner">
        <span class="filter-label">Neighbourhood:</span>
        <a href="{{ route('category.show', $category->slug) }}"
           class="filter-chip {{ !request('neighbourhood') ? 'active' : '' }}">All</a>
        @foreach($neighbourhoods as $n)
            <a href="{{ route('category.show', $category->slug) }}?neighbourhood={{ $n->slug }}"
               class="filter-chip {{ request('neighbourhood') === $n->slug ? 'active' : '' }}">
                {{ $n->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="category-listings">
    <div class="category-listings-header">
        <h2>All {{ $category->name }}</h2>
        <span class="results-count">Showing {{ $listings->firstItem() }}–{{ $listings->lastItem() }} of {{ $listings->total() }}</span>
    </div>

    @if($listings->count())
        <div class="cards-grid-3">
            @foreach($listings as $listing)
                <x-listing-card :listing="$listing" />
            @endforeach
        </div>

        @if($listings->hasPages())
            <div class="load-more-wrap">
                {{ $listings->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div style="padding:60px 20px;text-align:center;color:#888;">
            <p>No listings found in this category yet.</p>
            <a href="{{ route('list-business') }}" style="color:var(--orange);">Be the first to list your business &rarr;</a>
        </div>
    @endif
</div>

@endsection
