@props(['listing'])

<div class="listing-card {{ $listing->is_featured ? 'listing-card--featured' : '' }}">
    @if($listing->is_featured)
        <span class="listing-card__featured-ribbon">Featured</span>
    @endif
    <a href="{{ route('listing.show', $listing->slug) }}">
        <img src="{{ $listing->hero_image ?? asset('images/one.webp') }}" alt="{{ $listing->name }}" />
    </a>
    <div class="listing-card__body">
        <div class="listing-card__tags">
            <span class="tag-category">{{ $listing->category->name ?? '' }}</span>
            @if($listing->neighbourhood)
                <span class="tag-neighbourhood">{{ $listing->neighbourhood->name }}</span>
            @endif
        </div>
        <h3 class="listing-card__name">
            <a href="{{ route('listing.show', $listing->slug) }}">{{ $listing->name }}</a>
        </h3>
        <p class="listing-card__descriptor">
            {{ $listing->category->name ?? '' }}
            @if($listing->price_range && $listing->price_range !== 'na')
                &middot; {{ $listing->price_symbol }}
            @endif
        </p>
        @if($listing->description)
            <p class="listing-card__pitch">{{ Str::limit($listing->description, 100) }}</p>
        @endif
        <a href="{{ route('listing.show', $listing->slug) }}" class="listing-card__cta">View details &rarr;</a>
    </div>
</div>
