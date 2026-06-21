<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    {{-- ── STATIC PAGES ──────────────────────────────────────────── --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('new-to-sagamu') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('list-business') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('donate') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.4</priority>
    </url>

    {{-- ── CATEGORIES ────────────────────────────────────────────── --}}
    @foreach($categories as $category)
    <url>
        <loc>{{ route('category.show', $category->slug) }}</loc>
        <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    {{-- ── NEIGHBOURHOODS ────────────────────────────────────────── --}}
    @foreach($neighbourhoods as $neighbourhood)
    <url>
        <loc>{{ route('neighbourhood.show', $neighbourhood->slug) }}</loc>
        <lastmod>{{ $neighbourhood->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- ── LISTINGS ───────────────────────────────────────────────── --}}
    @foreach($listings as $listing)
    <url>
        <loc>{{ route('listing.show', $listing->slug) }}</loc>
        <lastmod>{{ $listing->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        @if($listing->hero_image)
        <image:image>
            <image:loc>{{ $listing->hero_image }}</image:loc>
            <image:title>{{ $listing->name }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach

    {{-- ── ARTICLES ───────────────────────────────────────────────── --}}
    @foreach($articles as $article)
    <url>
        <loc>{{ route('article.show', $article->slug) }}</loc>
        <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

</urlset>
