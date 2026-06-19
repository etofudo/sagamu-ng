@extends('layouts.app')
@section('inner_page', true)

@section('title', $neighbourhood->name . ' — Neighbourhood Guide — Sagamu.ng')

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
