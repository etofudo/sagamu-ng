@extends('layouts.app')
@section('inner_page', true)

@section('title', $neighbourhood->name . ' — Neighbourhood Guide, Sagamu | Sagamu.ng')
@section('meta_description', ($neighbourhood->character ? $neighbourhood->character . '. ' : '') . 'Complete guide to living in ' . $neighbourhood->name . ', Sagamu — rentals, schools, healthcare, restaurants and transport. Sagamu.ng.')
@section('canonical', route('neighbourhood.show', $neighbourhood->slug))
@section('og_image', $neighbourhood->hero_image ?? asset('images/og-default.jpg'))
@section('og_image_alt', $neighbourhood->name . ' — Sagamu Neighbourhood Guide')

@push('schema')
@php
    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'Place',
        '@id'        => route('neighbourhood.show', $neighbourhood->slug) . '#place',
        'name'       => $neighbourhood->name . ', Sagamu',
        'description' => strip_tags($neighbourhood->description ?? ($neighbourhood->character ?? 'A neighbourhood in Sagamu, Ogun State, Nigeria.')),
        'url'        => route('neighbourhood.show', $neighbourhood->slug),
        'geo'        => ['@type' => 'GeoCoordinates', 'latitude' => '6.8416', 'longitude' => '3.6479'],
        'containedInPlace' => [
            '@type' => 'City',
            'name'  => 'Sagamu',
            'containedInPlace' => ['@type' => 'State', 'name' => 'Ogun State',
                'containedInPlace' => ['@type' => 'Country', 'name' => 'Nigeria']],
        ],
    ];
    if ($neighbourhood->hero_image) $schema['image'] = $neighbourhood->hero_image;
    if ($neighbourhood->best_for)   $schema['amenityFeature'] = [['@type' => 'LocationFeatureSpecification', 'name' => 'Best for', 'value' => $neighbourhood->best_for]];

    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',           'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Neighbourhoods', 'item' => url('/#neighbourhoods')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $neighbourhood->name, 'item' => route('neighbourhood.show', $neighbourhood->slug)],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($schema,     JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endpush

@section('content')

<nav class="breadcrumb">
    <div class="breadcrumb-inner">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <a href="{{ route('home') }}#neighbourhoods">Neighbourhoods</a>
        <span class="sep">/</span>
        {{ $neighbourhood->name }}
    </div>
</nav>

<div class="neigh-hero">
    <img src="{{ $neighbourhood->hero_image ?? asset('images/blog (1).jpg') }}" alt="{{ $neighbourhood->name }}" />
    <div class="neigh-hero-overlay">
        <h1>{{ $neighbourhood->name }}</h1>
        @if($neighbourhood->character)
            <p>{{ $neighbourhood->character }}</p>
        @endif
    </div>
</div>

<div class="neigh-glance-strip">
    <div class="neigh-glance-inner">
        @if($neighbourhood->character)
        <div class="glance-item">
            <span class="glance-item__label">Character</span>
            <span class="glance-item__value">{{ $neighbourhood->character }}</span>
        </div>
        @endif
        @if($neighbourhood->rental_range)
        <div class="glance-item">
            <span class="glance-item__label">Rental Range</span>
            <span class="glance-item__value">{!! $neighbourhood->rental_range !!}</span>
        </div>
        @endif
        @if($neighbourhood->best_for)
        <div class="glance-item">
            <span class="glance-item__label">Best For</span>
            <span class="glance-item__value">{{ $neighbourhood->best_for }}</span>
        </div>
        @endif
        @if($neighbourhood->nearest_landmark)
        <div class="glance-item">
            <span class="glance-item__label">Nearest Landmark</span>
            <span class="glance-item__value">{{ $neighbourhood->nearest_landmark }}</span>
        </div>
        @endif
        @if($neighbourhood->transport_info)
        <div class="glance-item">
            <span class="glance-item__label">Transport</span>
            <span class="glance-item__value">{{ $neighbourhood->transport_info }}</span>
        </div>
        @endif
    </div>
</div>

<div class="neigh-content">
    <div class="neigh-editorial">
        @if($neighbourhood->description)
            <h2>What {{ $neighbourhood->name }} Is Like</h2>
            <div class="article-body">{!! $neighbourhood->description !!}</div>
        @endif
    </div>

    <aside>
        @if($listings->count())
        <div class="neigh-sidebar-widget">
            <h4>Places in {{ $neighbourhood->name }}</h4>
            <ul>
                @foreach($listings->take(5) as $listing)
                    <li><a href="{{ route('listing.show', $listing->slug) }}">{{ $listing->name }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="neigh-sidebar-widget">
            <h4>Other Neighbourhoods</h4>
            <ul>
                @foreach($otherNeighbourhoods as $other)
                    <li><a href="{{ route('neighbourhood.show', $other->slug) }}">{{ $other->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>

@if($listings->count())
<div class="neigh-listings-section">
    <div class="neigh-listings-section-inner">
        <h2>Eat &amp; Drink in {{ $neighbourhood->name }}</h2>
        <div class="cards-grid-3">
            @foreach($listings->take(3) as $listing)
                <x-listing-card :listing="$listing" />
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
