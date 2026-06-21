@extends('layouts.app')
@section('inner_page', true)

@section('title', $listing->name . ' — ' . ($listing->category->name ?? 'Business') . ' in Sagamu | Sagamu.ng')
@section('meta_description', Str::limit(strip_tags($listing->description), 155) . ' Located in Sagamu, Ogun State, Nigeria.')
@section('canonical', route('listing.show', $listing->slug))
@section('og_type', 'business.business')
@section('og_image', $listing->hero_image ?? asset('images/og-default.jpg'))
@section('og_image_alt', $listing->name . ' — ' . ($listing->category->name ?? 'Business') . ' in Sagamu')

@push('schema')
@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => $listing->schema_type,
        '@id'      => route('listing.show', $listing->slug) . '#business',
        'name'     => $listing->name,
        'description' => \Illuminate\Support\Str::limit(strip_tags($listing->description), 300),
        'url'      => route('listing.show', $listing->slug),
        'geo'      => ['@type' => 'GeoCoordinates', 'latitude' => '6.8416', 'longitude' => '3.6479'],
        'hasMap'   => 'https://www.google.com/maps/search/' . urlencode(($listing->address ?? $listing->name) . ' Sagamu Ogun State Nigeria'),
        'areaServed' => ['@type' => 'City', 'name' => 'Sagamu'],
        'containedInPlace' => [
            '@type' => 'City',
            'name'  => 'Sagamu',
            'containedInPlace' => ['@type' => 'State', 'name' => 'Ogun State',
                'containedInPlace' => ['@type' => 'Country', 'name' => 'Nigeria']],
        ],
    ];
    if ($listing->hero_image)   $schema['image']        = $listing->hero_image;
    if ($listing->address)      $schema['address']      = ['@type' => 'PostalAddress', 'streetAddress' => $listing->address, 'addressLocality' => 'Sagamu', 'addressRegion' => 'Ogun State', 'addressCountry' => 'NG'];
    if ($listing->phone)        $schema['telephone']    = $listing->phone;
    if ($listing->website)      $schema['sameAs']       = $listing->website;
    if ($listing->opening_hours) $schema['openingHours'] = $listing->opening_hours;
    if ($listing->price_range && $listing->price_range !== 'na') $schema['priceRange'] = $listing->price_symbol;

    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ],
    ];
    if ($listing->category) {
        $breadcrumb['itemListElement'][] = ['@type' => 'ListItem', 'position' => 2, 'name' => $listing->category->name, 'item' => route('category.show', $listing->category->slug)];
        $breadcrumb['itemListElement'][] = ['@type' => 'ListItem', 'position' => 3, 'name' => $listing->name, 'item' => route('listing.show', $listing->slug)];
    } else {
        $breadcrumb['itemListElement'][] = ['@type' => 'ListItem', 'position' => 2, 'name' => $listing->name, 'item' => route('listing.show', $listing->slug)];
    }
@endphp
<script type="application/ld+json">{{ json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</script>
<script type="application/ld+json">{{ json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</script>
@endpush

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
            <h1>
                {{ $listing->name }}
                @if($listing->is_featured)
                    <span class="featured-badge">Featured</span>
                @endif
            </h1>
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

        @if(!$listing->is_featured && $listing->status === 'active')
        <div class="upgrade-cta-box">
            <p class="upgrade-cta-label">Is this your business?</p>
            <p>Get a <strong>Featured</strong> badge and appear at the top of your category.</p>
            <a href="{{ route('listing.upgrade', $listing->slug) }}" class="upgrade-cta-btn">
                Feature this listing &rarr;
            </a>
        </div>
        @else
        <p class="claim-listing-link">
            Is this your business? <a href="{{ route('list-business') }}">Contact us to update this listing &rarr;</a>
        </p>
        @endif
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
