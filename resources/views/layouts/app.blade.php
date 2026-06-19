<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sagamu.ng — Your Complete Guide to Life in Sagamu')</title>
    <meta name="description" content="@yield('meta_description', 'Restaurants, sport, health, schools, business and neighbourhood life in Sagamu, Ogun State.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/sagamu.css') }}">
    @hasSection('inner_page')
    <link rel="stylesheet" href="{{ asset('css/sagamu-pages.css') }}">
    @endif
    @stack('styles')
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
            <a href="#">Contact Us</a>
        </div>
    </div>
    <div id="footer-bottom">
        <span>&copy; {{ date('Y') }} Sagamu.ng. Your City, Your Opportunity.</span>
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
