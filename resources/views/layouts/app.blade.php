<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ── PRIMARY META ──────────────────────────────────────────── --}}
    <title>@yield('title', "Sagamu.ng — Nigeria's Premier City Guide for Sagamu, Ogun State")</title>
    <meta name="description" content="@yield('meta_description', "Sagamu.ng is Nigeria's premier city guide for Sagamu, Ogun State. Find restaurants, schools, hospitals, businesses, and neighbourhood guides — all in one place.")">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="robots" content="@yield('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <meta name="google-site-verification" content="M9-VOSvnJoUqekR9MqocUop2RXfb0RIKDqrA7X1eZoQ">
    <meta name="author" content="Sagamu.ng">
    <meta name="publisher" content="Sagamu.ng">
    <meta name="copyright" content="Sagamu.ng">
    <meta name="language" content="English">
    <meta name="revisit-after" content="3 days">
    <meta name="rating" content="general">

    {{-- ── GEO META (local SEO signal) ───────────────────────────── --}}
    <meta name="geo.region" content="NG-OG">
    <meta name="geo.placename" content="Sagamu, Ogun State, Nigeria">
    <meta name="geo.position" content="6.8416;3.6479">
    <meta name="ICBM" content="6.8416, 3.6479">

    {{-- ── OPEN GRAPH (WhatsApp, Facebook, LinkedIn previews) ────── --}}
    <meta property="og:site_name" content="Sagamu.ng">
    <meta property="og:locale" content="en_NG">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('title', "Sagamu.ng — Nigeria's Premier City Guide")">
    <meta property="og:description" content="@yield('meta_description', "Nigeria's premier city guide for Sagamu, Ogun State.")">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('og_image_alt', "Sagamu.ng — Nigeria's Premier City Guide")">

    {{-- ── TWITTER / X CARD ───────────────────────────────────────── --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@@sagamung">
    <meta name="twitter:title" content="@yield('title', 'Sagamu.ng')">
    <meta name="twitter:description" content="@yield('meta_description', "Nigeria's premier city guide for Sagamu, Ogun State.")">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- ── SITEMAP DISCOVERY ──────────────────────────────────────── --}}
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

    {{-- ── FONTS & ICONS ──────────────────────────────────────────── --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- ── STYLESHEETS ─────────────────────────────────────────────── --}}
    <link rel="stylesheet" href="{{ asset('css/sagamu.css') }}">
    @hasSection('inner_page')
    <link rel="stylesheet" href="{{ asset('css/sagamu-pages.css') }}">
    @endif
    @stack('styles')

    {{-- ── JSON-LD STRUCTURED DATA ────────────────────────────────── --}}
    {{-- @@ escapes @ so Blade does not treat @context/@type/@id as directives --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            {
                "@@type": "Organization",
                "@@id": "{{ url('/') }}/#organization",
                "name": "Sagamu.ng",
                "alternateName": "Sagamu City Guide",
                "url": "{{ url('/') }}",
                "logo": {
                    "@@type": "ImageObject",
                    "url": "{{ asset('images/og-default.jpg') }}",
                    "width": 1200,
                    "height": 630
                },
                "description": "Nigeria's premier city guide for Sagamu, Ogun State.",
                "areaServed": {
                    "@@type": "City",
                    "name": "Sagamu",
                    "containedInPlace": {
                        "@@type": "State",
                        "name": "Ogun State",
                        "containedInPlace": {
                            "@@type": "Country",
                            "name": "Nigeria"
                        }
                    }
                },
                "contactPoint": {
                    "@@type": "ContactPoint",
                    "email": "hello@sagamu.ng",
                    "contactType": "customer service",
                    "availableLanguage": "English"
                }
            },
            {
                "@@type": "WebSite",
                "@@id": "{{ url('/') }}/#website",
                "url": "{{ url('/') }}",
                "name": "Sagamu.ng",
                "description": "Nigeria's premier city guide for Sagamu, Ogun State",
                "publisher": { "@@id": "{{ url('/') }}/#organization" },
                "potentialAction": {
                    "@@type": "SearchAction",
                    "target": {
                        "@@type": "EntryPoint",
                        "urlTemplate": "{{ url('/search') }}?q={search_term_string}"
                    },
                    "query-input": "required name=search_term_string"
                }
            }
        ]
    }
    </script>

    {{-- Page-specific schema pushed from individual views --}}
    @stack('schema')
</head>
<body>

<header id="site-header"></header>

<nav id="mainnav">
    <div id="nav-inner">
        <a href="{{ route('home') }}" @class(['nav-active' => request()->routeIs('home')])>Home</a>
        <a href="{{ route('category.show', 'restaurant-buka') }}" @class(['nav-active' => request()->routeIs('category.show') && request()->route('category')?->slug === 'restaurant-buka'])>Eat &amp; Drink</a>
        <a href="{{ route('home') }}#sports">Sports</a>
        <a href="{{ route('home') }}#recreation">Recreation</a>
        <a href="{{ route('home') }}#healthcare">Healthcare</a>
        <a href="{{ route('home') }}#schools">Schools</a>
        <a href="{{ route('home') }}#business">Business</a>
        <a href="{{ route('home') }}#neighbourhoods">Neighbourhoods</a>
        <a href="#">Markets</a>
        <a href="#">Events</a>
        <a href="#">Property</a>
        <a href="#">Transport</a>
    </div>
</nav>

@yield('content')

<footer id="site-footer">
    <div id="footer-newsletter">
        <h3>Get Sagamu in Your Inbox</h3>
        <form class="newsletter-form" onsubmit="return false;">
            <input type="email" placeholder="Your email address" />
            <button type="submit">Subscribe</button>
        </form>
    </div>
    <div id="footer-links">
        <div class="footer-col">
            <h4>Eat &amp; Drink</h4>
            <a href="{{ route('category.show', 'restaurant-buka') }}">All Restaurants</a>
            <a href="{{ route('category.show', 'bar-grill') }}">Bars &amp; Joints</a>
            <a href="{{ route('category.show', 'street-food') }}">Street Food</a>
        </div>
        <div class="footer-col">
            <h4>Neighbourhoods</h4>
            <a href="{{ route('neighbourhood.show', 'makun-sagamu') }}">Makun Sagamu</a>
            <a href="{{ route('neighbourhood.show', 'isale-sagamu') }}">Isale Sagamu</a>
            <a href="{{ route('neighbourhood.show', 'agbowa') }}">Agbowa</a>
            <a href="{{ route('neighbourhood.show', 'ijoku') }}">Ijoku</a>
        </div>
        <div class="footer-col">
            <h4>Services</h4>
            <a href="{{ route('home') }}#healthcare">OOUTH Healthcare</a>
            <a href="{{ route('category.show', 'school') }}">Schools Directory</a>
            <a href="{{ route('home') }}#business">Business Directory</a>
        </div>
        <div class="footer-col">
            <h4>Sagamu.ng</h4>
            <a href="#">About Us</a>
            <a href="{{ route('list-business') }}">List Your Business</a>
            <a href="{{ route('new-to-sagamu') }}">New to Sagamu?</a>
            <a href="{{ route('donate') }}" class="footer-donate-link">Support This Site &#9829;</a>
            <a href="#">Contact Us</a>
        </div>
    </div>
    <div id="footer-bottom">
        <span>&copy; {{ date('Y') }} Sagamu.ng &mdash; Nigeria's Premier City Guide for Sagamu, Ogun State.</span>
        <div class="social-icons">
            <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
