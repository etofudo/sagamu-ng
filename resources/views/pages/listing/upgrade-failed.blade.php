@extends('layouts.app')
@section('inner_page', true)

@section('title', 'Payment Unsuccessful — Sagamu.ng')

@section('content')

<div class="payment-result-wrap payment-result-wrap--failed">
    <div class="payment-result-icon payment-result-icon--failed">✕</div>
    <h1>Payment not completed</h1>
    <p class="payment-result-subhead">Your card was not charged. <strong>{{ $listing->name }}</strong> has not been featured.</p>

    <p class="payment-result-note">
        This can happen if the payment was cancelled, the card was declined, or there was a network issue.
        Please try again. If the problem continues, email
        <a href="mailto:hello@sagamu.ng">hello@sagamu.ng</a> with your reference:
        <strong>{{ $txn->reference }}</strong>
    </p>

    <div class="payment-result-actions">
        <a href="{{ route('listing.upgrade', $listing->slug) }}" class="payment-result-btn">
            Try again &rarr;
        </a>
        <a href="{{ route('listing.show', $listing->slug) }}" class="payment-result-btn payment-result-btn--ghost">
            Back to listing
        </a>
    </div>
</div>

@endsection
