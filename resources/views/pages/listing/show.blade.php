@extends('layouts.app')
@section('inner_page', true)

@section('title', $listing->name . ' — Sagamu.ng')
@section('meta_description', Str::limit($listing->description, 160))

@section('content')

<nav class="breadcrumb">
    <div class="breadcrumb-inner">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        @if($listing->category)
            <a href="{{ route('category.show', $listing->category->slug) }}">{{ $listing->category->name }}</a>
            <span class="sep">/</span>
        @endif
        {{ $listing->name }}
    </div>
</nav>

<img class="listing-detail-hero"
     src="{{ $listing->hero_image ?? asset('images/one.webp') }}"
     alt="{{ $listing->name }}" />

<div class="listing-detail-header">
    <div class="listing-detail-header-inner">
        <div>
            <div class="listing-card__tags" style="margin-bottom:10px;">
                @if($listing->category)
                    <span class="tag-category">{{ $listing->category->name }}</span>
                @endif
                @if($listing->neighbourhood)
                    <span class="tag-neighbourhood">{{ $listing->neighbourhood->name }}</span>
                @endif
            </div>
            <h1>{{ $listing->name }}</h1>
            @if($listing->price_range && $listing->price_range !== 'na')
                <p style="color:#aaa;margin:4px 0 0;">{{ $listing->price_symbol }}</p>
            @endif
        </div>
        <div class="listing-quick-actions">
            @if($listing->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $listing->whatsapp) }}" class="qa-btn qa-btn--whatsapp" target="_blank">
                    <i class="fa fa-whatsapp"></i> WhatsApp
                </a>
            @endif
            @if($listing->phone)
                <a href="tel:{{ $listing->phone }}" class="qa-btn qa-btn--call">
                    <i class="fa fa-phone"></i> Call
                </a>
            @endif
            @if($listing->address)
                <a href="https://www.google.com/maps/search/{{ urlencode($listing->address . ' Sagamu') }}" class="qa-btn qa-btn--dir" target="_blank">
                    <i class="fa fa-map-marker"></i> Directions
                </a>
            @endif
        </div>
    </div>
</div>

<div class="listing-detail-body">
    <div class="listing-editorial">
        <h2>About {{ $listing->name }}</h2>
        <div class="article-body">
            {!! nl2br(e($listing->description)) !!}
        </div>

        @if($listing->gallery && count($listing->gallery))
        <div class="listing-gallery">
            @foreach($listing->gallery as $img)
                <img src="{{ $img }}" alt="{{ $listing->name }} gallery" />
            @endforeach
        </div>
        @endif
    </div>

    <aside>
        <div class="contact-box">
            @if($listing->address)
            <div class="contact-row">
                <span class="contact-row__label"><i class="fa fa-map-marker"></i></span>
                <span>{{ $listing->address }}</span>
            </div>
            @endif
            @if($listing->phone)
            <div class="contact-row">
                <span class="contact-row__label"><i class="fa fa-phone"></i></span>
                <a href="tel:{{ $listing->phone }}">{{ $listing->phone }}</a>
            </div>
            @endif
            @if($listing->whatsapp)
            <div class="contact-row">
                <span class="contact-row__label"><i class="fa fa-whatsapp"></i></span>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $listing->whatsapp) }}" target="_blank">WhatsApp</a>
            </div>
            @endif
            @if($listing->opening_hours)
            <div class="contact-row">
                <span class="contact-row__label"><i class="fa fa-clock-o"></i></span>
                <span>{{ $listing->opening_hours }}</span>
            </div>
            @endif
            @if($listing->website)
            <div class="contact-row">
                <span class="contact-row__label"><i class="fa fa-globe"></i></span>
                <a href="{{ $listing->website }}" target="_blank">Visit website</a>
            </div>
            @endif
        </div>

        <div class="map-placeholder">
            <i class="fa fa-map-o" style="font-size:2rem;color:#aaa;"></i>
            <p>Map coming soon</p>
        </div>

        <p class="claim-listing-link">
            Is this your business? <a href="{{ route('list-business') }}">Claim or update this listing &rarr;</a>
        </p>
    </aside>
</div>

@if($relatedListings->count())
<div class="related-listings">
    <div class="related-listings-inner">
        <h2>More in {{ $listing->category->name ?? 'Sagamu' }}</h2>
        <div class="cards-grid-3">
            @foreach($relatedListings as $related)
                <x-listing-card :listing="$related" />
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
