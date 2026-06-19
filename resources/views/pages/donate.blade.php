@extends('layouts.app')
@section('inner_page', true)

@section('title', 'Support Sagamu.ng — Keep the Directory Free')

@section('content')

<div class="donate-wrap">

    <div class="donate-main">
        <div class="donate-hero">
            <h1>Support Sagamu.ng</h1>
            <p>Sagamu.ng is free to use and always will be. If it has saved you a phone call, helped you find a school, or pointed you to a good meal — consider buying the team a coffee.</p>
        </div>

        @if($errors->any())
            <div class="form-error-box">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('donate.initiate') }}" id="donate-form">
            @csrf

            <div class="form-group">
                <label>Choose an amount</label>
                <div class="donate-preset-grid">
                    @foreach($presets as $preset)
                        <button type="button"
                                class="donate-preset-btn"
                                data-amount="{{ $preset }}">
                            ₦{{ number_format($preset) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="amount">Or enter your own amount (₦)</label>
                <div class="donate-custom-wrap">
                    <span class="donate-naira-symbol">₦</span>
                    <input type="number"
                           id="amount"
                           name="amount"
                           class="form-input donate-amount-input"
                           placeholder="e.g. 1500"
                           min="{{ $minNaira }}"
                           max="{{ $maxNaira }}"
                           step="1"
                           value="{{ old('amount') }}"
                           required />
                </div>
                <p class="form-hint">Minimum ₦{{ number_format($minNaira) }}. Whole naira only.</p>
            </div>

            <div class="form-group">
                <label for="donate-email">Your email</label>
                <input type="email"
                       id="donate-email"
                       name="email"
                       class="form-input"
                       placeholder="you@example.com"
                       value="{{ old('email') }}"
                       required />
            </div>

            <button type="submit" class="upgrade-pay-btn">
                Donate securely &rarr;
            </button>
        </form>

        <p class="upgrade-trust" style="margin-top:20px;">
            <img src="https://checkout.paystack.com/assets/img/logos/paystack-logo-dark.svg"
                 alt="Paystack" class="paystack-logo" />
            Secured by Paystack.
        </p>
    </div>

    <aside class="donate-aside">
        <div class="donate-why">
            <h3>Why donate?</h3>
            <p>Sagamu.ng costs money to run — hosting, domain, maintenance, and the time it takes to verify listings and write accurate content about the town.</p>
            <p>There are no banner ads. There are no trackers. Listings are free. Donations keep it that way.</p>
            <p>Every naira donated goes directly into keeping the directory online and up to date.</p>
        </div>
    </aside>

</div>

@push('scripts')
<script>
document.querySelectorAll('.donate-preset-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.getElementById('amount').value = this.dataset.amount;
        document.querySelectorAll('.donate-preset-btn').forEach(function(b) {
            b.classList.remove('donate-preset-btn--active');
        });
        this.classList.add('donate-preset-btn--active');
    });
});
</script>
@endpush

@endsection
