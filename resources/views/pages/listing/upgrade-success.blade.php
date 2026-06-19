@extends('layouts.app')
@section('inner_page', true)

@section('title', $listing->name . ' is now Featured — Sagamu.ng')

@section('content')

<div class="payment-result-wrap payment-result-wrap--success">
    <div class="payment-result-icon">✓</div>
    <h1>Payment successful</h1>
    <p class="payment-result-subhead"><strong>{{ $listing->name }}</strong> is now featured on Sagamu.ng.</p>

    <div class="payment-result-detail">
        <div class="payment-detail-row">
            <span>Amount paid</span>
            <strong>{{ $txn->amount_formatted }}</strong>
        </div>
        <div class="payment-detail-row">
            <span>Reference</span>
            <strong>{{ $txn->reference }}</strong>
        </div>
        <div class="payment-detail-row">
            <span>Email</span>
            <strong>{{ $txn->email }}</strong>
        </div>
        <div class="payment-detail-row">
            <span>Date</span>
            <strong>{{ $txn->paid_at?->format('d M Y, g:ia') }}</strong>
        </div>
    </div>

    <p class="payment-result-note">
        A confirmation has been recorded. Save your reference number above.
        If you have any questions, email <a href="mailto:hello@sagamu.ng">hello@sagamu.ng</a>.
    </p>

    <a href="{{ route('listing.show', $listing->slug) }}" class="payment-result-btn">
        View your featured listing &rarr;
    </a>
</div>

@endsection
