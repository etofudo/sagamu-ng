@extends('layouts.app')
@section('inner_page', true)

@section('title', 'List Your Business on Sagamu.ng — Get Found by Sagamu Residents')

@section('content')

<div id="hero-strip">
    <h1>List Your Business on Sagamu.ng</h1>
    <p>Reach every resident, visitor, and investor looking at Sagamu</p>
</div>

<div class="form-page-wrap">

    <div class="listing-form">
        <h2>Tell us about your business</h2>
        <p class="form-subhead">Fill in the details below. We review every submission and publish within 48 hours. Your listing appears in the relevant section of Sagamu.ng and is searchable by neighbourhood and category.</p>

        @if(session('success'))
            <div style="background:#e8f5e9;border:1px solid #4caf50;color:#2e7d32;padding:16px 20px;border-radius:6px;margin-bottom:24px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('list-business.submit') }}">
            @csrf

            <div class="form-group">
                <label>Business Name <span class="req">*</span></label>
                <input type="text" name="name" class="form-input @error('name') is-invalid @enderror"
                       placeholder="e.g. The Junction Kitchen" value="{{ old('name') }}" required />
                @error('name')<p class="form-hint" style="color:red;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Category <span class="req">*</span></label>
                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ old('category') === $cat->name ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')<p class="form-hint" style="color:red;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Neighbourhood <span class="req">*</span></label>
                <select name="neighbourhood" class="form-select @error('neighbourhood') is-invalid @enderror" required>
                    <option value="">Select a neighbourhood</option>
                    @foreach($neighbourhoods as $n)
                        <option value="{{ $n->name }}" {{ old('neighbourhood') === $n->name ? 'selected' : '' }}>
                            {{ $n->name }}
                        </option>
                    @endforeach
                    <option value="Other / Multiple">Other / Multiple</option>
                </select>
                @error('neighbourhood')<p class="form-hint" style="color:red;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Description <span class="req">*</span></label>
                <textarea name="description" class="form-textarea @error('description') is-invalid @enderror"
                          placeholder="Tell us what your business does, what makes it worth visiting or calling, and anything customers should know before they come. Write as you would speak to a new customer." required>{{ old('description') }}</textarea>
                <p class="form-hint">Minimum 60 words. Generic descriptions will be edited before publishing.</p>
                @error('description')<p class="form-hint" style="color:red;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Street Address <span class="req">*</span></label>
                <input type="text" name="address" class="form-input @error('address') is-invalid @enderror"
                       placeholder="e.g. 14 Makun Road, near Sagamu Interchange" value="{{ old('address') }}" required />
                @error('address')<p class="form-hint" style="color:red;">{{ $message }}</p>@enderror
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>Phone Number <span class="req">*</span></label>
                    <input type="tel" name="phone" class="form-input @error('phone') is-invalid @enderror"
                           placeholder="+234 801 234 5678" value="{{ old('phone') }}" required />
                    @error('phone')<p class="form-hint" style="color:red;">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label>WhatsApp Number</label>
                    <input type="tel" name="whatsapp" class="form-input" placeholder="+234 801 234 5678" value="{{ old('whatsapp') }}" />
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>Opening Hours</label>
                    <input type="text" name="opening_hours" class="form-input" placeholder="e.g. Mon-Sat 8am-10pm" value="{{ old('opening_hours') }}" />
                </div>
                <div class="form-group">
                    <label>Price Range</label>
                    <select name="price_range" class="form-select">
                        <option value="">Select</option>
                        <option value="budget" {{ old('price_range') === 'budget' ? 'selected' : '' }}>&#x20A6; (Budget)</option>
                        <option value="mid" {{ old('price_range') === 'mid' ? 'selected' : '' }}>&#x20A6;&#x20A6; (Mid-range)</option>
                        <option value="premium" {{ old('price_range') === 'premium' ? 'selected' : '' }}>&#x20A6;&#x20A6;&#x20A6; (Premium)</option>
                        <option value="na" {{ old('price_range') === 'na' ? 'selected' : '' }}>Not applicable</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Website (if any)</label>
                <input type="url" name="website" class="form-input" placeholder="https://" value="{{ old('website') }}" />
            </div>

            <div class="form-group">
                <label>Your Name &amp; Email (for correspondence)</label>
                <div class="form-row-2">
                    <input type="text" name="contact_name" class="form-input" placeholder="Your name" value="{{ old('contact_name') }}" />
                    <input type="email" name="contact_email" class="form-input" placeholder="your@email.com" value="{{ old('contact_email') }}" />
                </div>
                <p class="form-hint">Not published. Used only to confirm your listing and send any questions.</p>
            </div>

            <button type="submit" class="form-submit-btn">Submit for review</button>
        </form>
    </div>

    <aside>
        <div class="form-benefits">
            <h3>Why list on Sagamu.ng?</h3>
            <div class="benefit-item">
                <span class="benefit-icon"><i class="fa fa-users"></i></span>
                <div>
                    <h4>Reach the right audience</h4>
                    <p>Sagamu.ng is built specifically for people living in and moving to Sagamu. Every visitor is a potential customer who needs local services.</p>
                </div>
            </div>
            <div class="benefit-item">
                <span class="benefit-icon"><i class="fa fa-search"></i></span>
                <div>
                    <h4>Searchable by neighbourhood</h4>
                    <p>Residents search by area. Your listing appears when someone looks for businesses in your neighbourhood.</p>
                </div>
            </div>
            <div class="benefit-item">
                <span class="benefit-icon"><i class="fa fa-whatsapp"></i></span>
                <div>
                    <h4>WhatsApp button on your listing</h4>
                    <p>Customers can tap directly to WhatsApp you. No barriers, no forms, just a direct message.</p>
                </div>
            </div>
            <div class="benefit-item">
                <span class="benefit-icon"><i class="fa fa-check-circle"></i></span>
                <div>
                    <h4>Free to list</h4>
                    <p>Basic listings are free. Enhanced features are available for businesses that want more visibility.</p>
                </div>
            </div>
            <div class="benefit-item">
                <span class="benefit-icon"><i class="fa fa-clock-o"></i></span>
                <div>
                    <h4>Live within 48 hours</h4>
                    <p>We review every submission. Once approved, your listing goes live immediately.</p>
                </div>
            </div>
        </div>
    </aside>

</div>

<div class="form-footer-note">
    <p>Already listed? <a href="#">Contact us to update your listing</a> &nbsp;&middot;&nbsp; Questions? <a href="#">hello@sagamu.ng</a></p>
</div>

@endsection
