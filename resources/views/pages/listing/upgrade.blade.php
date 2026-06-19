@extends('layouts.app')
@section('inner_page', true)

@section('title', 'Feature ' . $listing->name . ' on Sagamu.ng')

@section('content')

<nav class="breadcrumb">
    <div class="breadcrumb-inner">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <a href="{{ route('listing.show', $listing->slug) }}">{{ $listing->name }}</a>
        <span class="sep">/</span>
        Get Featured
    </div>
</nav>

<div class="upgrade-wrap">

    <div class="upgrade-main">
        <div class="upgrade-hero">
            <span class="upgrade-badge-preview">Featured</span>
            <h1>Feature <em>{{ $listing->name }}</em> on Sagamu.ng</h1>
            <p class="upgrade-subhead">Get seen first. One payment, permanent placement.</p>
        </div>

        <div class="upgrade-benefits">
            <h2>What you get</h2>
            <ul class="benefit-list">
                <li>
                    <span class="benefit-check">✓</span>
                    <div>
                        <strong>Featured badge</strong> on your listing card and detail page — immediately visible to every visitor
                    </div>
                </li>
                <li>
                    <span class="benefit-check">✓</span>
                    <div>
                        <strong>Top placement</strong> in your category — featured listings always appear before standard ones
                    </div>
                </li>
                <li>
                    <span class="benefit-check">✓</span>
                    <div>
                        <strong>Homepage visibility</strong> — featured listings are pulled into the homepage sections
                    </div>
                </li>
                <li>
                    <span class="benefit-check">✓</span>
                    <div>
                        <strong>Permanent</strong> — this is a one-time payment, not a subscription. No renewals.
                    </div>
                </li>
            </ul>
        </div>

        <div class="upgrade-form-box">
            <div class="upgrade-price-display">
                <span class="upgrade-price">{{ $priceFormatted }}</span>
                <span class="upgrade-price-label">one-time</span>
            </div>

            @if($errors->any())
                <div class="form-error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('listing.upgrade.initiate', $listing->slug) }}">
                @csrf
                <div class="form-group">
                    <label for="email">Your email address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-input"
                           placeholder="you@example.com"
                           value="{{ old('email') }}"
                           required />
                    <p class="form-hint">We will send your payment confirmation here.</p>
                </div>

                <button type="submit" class="upgrade-pay-btn">
                    Pay {{ $priceFormatted }} securely &rarr;
                </button>
            </form>

            <p class="upgrade-trust">
                <img src="https://checkout.paystack.com/assets/img/logos/paystack-logo-dark.svg"
                     alt="Paystack" class="paystack-logo" />
                Secured by Paystack. Your card details never touch our server.
            </p>
        </div>
    </div>

    <aside class="upgrade-aside">
        <div class="upgrade-listing-preview">
            <h4>Your listing</h4>
            <img src="{{ $listing->hero_image ?? asset('images/one.webp') }}"
                 alt="{{ $listing->name }}" class="upgrade-preview-img" />
            <p class="upgrade-preview-name">{{ $listing->name }}</p>
            @if($listing->category)
                <span class="tag-category">{{ $listing->category->name }}</span>
            @endif
            @if($listing->neighbourhood)
                <span class="tag-neighbourhood">{{ $listing->neighbourhood->name }}</span>
            @endif
        </div>

        <div class="upgrade-faq">
            <h4>Questions</h4>
            <dl>
                <dt>Is this really permanent?</dt>
                <dd>Yes. One payment, featured forever. We do not do subscriptions.</dd>
                <dt>What if I need to update my listing?</dt>
                <dd>Contact us at hello@sagamu.ng and we will update it for you.</dd>
                <dt>What if something goes wrong with payment?</dt>
                <dd>Email hello@sagamu.ng with your payment reference and we will sort it manually.</dd>
            </dl>
        </div>
    </aside>

</div>

@endsection
