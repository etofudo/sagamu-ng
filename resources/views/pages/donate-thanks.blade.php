@extends('layouts.app')
@section('inner_page', true)

@section('title', 'Thank You — Sagamu.ng')

@section('content')

<div class="payment-result-wrap payment-result-wrap--success">
    <div class="payment-result-icon">♥</div>
    <h1>Thank you.</h1>
    <p class="payment-result-subhead">Your donation of <strong>{{ $txn->amount_formatted }}</strong> has been received.</p>

    <div class="payment-result-detail">
        <div class="payment-detail-row">
            <span>Amount</span>
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
        This keeps Sagamu.ng free and running for everyone in Sagamu.
        If you have any questions about your donation, email
        <a href="mailto:hello@sagamu.ng">hello@sagamu.ng</a>.
    </p>

    <a href="{{ route('home') }}" class="payment-result-btn">
        Back to Sagamu.ng &rarr;
    </a>
</div>

@endsection
