@extends('layouts.app')
@section('inner_page', true)

@section('title', $category->name . ' in Sagamu, Ogun State — Complete Directory | Sagamu.ng')
@section('meta_description', 'Find the best ' . strtolower($category->name) . ' in Sagamu, Ogun State. Browse ' . $listings->total() . ' listings with addresses, phone numbers and reviews — Sagamu.ng.')
@section('canonical', route('category.show', $category->slug))

@push('schema')
@php
    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',              'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $category->name . ' in Sagamu', 'item' => route('category.show', $category->slug)],
        ],
    ];

    $itemList = [
        '@context'       => 'https://schema.org',
        '@type'          => 'ItemList',
        'name'           => $category->name . ' in Sagamu',
        'description'    => 'Complete directory of ' . strtolower($category->name) . ' businesses in Sagamu, Ogun State, Nigeria.',
        'url'            => route('category.show', $category->slug),
        'numberOfItems'  => $listings->total(),
        'itemListElement' => [],
    ];
    foreach ($listings->take(10) as $i => $item) {
        $itemList['itemListElement'][] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $item->name,
            'url'      => route('listing.show', $item->slug),
        ];
    }
@endphp
<script type="application/ld+json">{{ json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</script>
<script type="application/ld+json">{{ json_encode($itemList,   JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</script>
@endpush

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
