@extends('layouts.app')
@section('inner_page', true)

@section('title', 'New to Sagamu? Start Here — Your Relocation Guide — Sagamu.ng')

@section('content')

<div class="welcome-hero">
    <h1>New to Sagamu?</h1>
    <p>Everything you need to settle in quickly. Schools, healthcare, where to eat, where to live, and how to get around — all in one place.</p>
</div>

<div class="welcome-content">

    <p class="welcome-intro">Whether you have just accepted a job at Lafarge, been posted to OOUTH, or simply decided that Sagamu makes more sense than paying Lagos rent — this page is your first stop. Sagamu is not a difficult city to navigate, but knowing where things are before you arrive saves a week of asking around.</p>

    <ol class="step-list">

        <li class="step-item">
            <span class="step-number">01</span>
            <div class="step-body">
                <h2>Schools for Your Children</h2>
                <p>Sagamu has a solid range of schooling options. At the secondary level, Remo Secondary School is one of the most established public schools in Ogun State with a strong academic tradition. For private boarding, Mayflower School in nearby Ikenne-Remo (founded by Tai Solarin) is well-regarded and draws students from across southwest Nigeria.</p>
                <p>Several private schools within Sagamu LGA cater to the professional residential class that has grown with the town. Most offer primary and secondary education. Facilities have been improving as schools respond to the expectations of incoming families from Lagos and other urban centres.</p>
                <p>Ask about proximity to your residence, school bus availability, fees, and examination results before enrolling. Most schools in Sagamu are receptive to parent visits before commitment.</p>
                <a href="{{ route('category.show', 'school') }}">Browse all schools in Sagamu &rarr;</a>
            </div>
        </li>

        <li class="step-item">
            <span class="step-number">02</span>
            <div class="step-body">
                <h2>Healthcare</h2>
                <p>Olabisi Onabanjo University Teaching Hospital (OOUTH) is the most important healthcare facility in the region. It is not a referral-only hospital — walk-in outpatient registration is available. The 24-hour Accident and Emergency department is staffed around the clock. Specialist departments cover everything from internal medicine and paediatrics to orthopaedics and psychiatry.</p>
                <p>For routine and minor health needs, several private clinics and pharmacies operate across Sagamu. Makun has a cluster of pharmacies with reliable stock. If you are managing a chronic condition, register with OOUTH outpatient early rather than waiting for an emergency.</p>
                <a href="{{ route('home') }}#healthcare">OOUTH departments and information &rarr;</a>
            </div>
        </li>

        <li class="step-item">
            <span class="step-number">03</span>
            <div class="step-body">
                <h2>Where to Live</h2>
                <p>Most professionals relocating to Sagamu end up in <strong>Makun</strong> or the surrounding corridor along the expressway side of town. It has the best access to Lagos, newer housing stock, and a growing number of shops and restaurants. Rental prices are higher than the rest of Sagamu but still substantially below Lagos equivalents.</p>
                <p><strong>Isale Sagamu</strong> is the historic town centre. More affordable, more character, more community. Less suited to frequent Lagos commuters but excellent for those who want to feel embedded in the town rather than adjacent to it.</p>
                <p><strong>Agbowa</strong> and <strong>Ijoku</strong> are residential areas with established housing stock and quieter streets. Good options for families who prioritise space and stability over convenience to the expressway.</p>
                <a href="{{ route('home') }}#neighbourhoods">Explore all neighbourhoods &rarr;</a>
            </div>
        </li>

        <li class="step-item">
            <span class="step-number">04</span>
            <div class="step-body">
                <h2>Where to Eat</h2>
                <p>For sit-down dining and business lunches, The Junction Kitchen in Makun is the most reliable option. It does both continental and Nigerian food without cutting corners on either. The pepper soup is worth the trip alone.</p>
                <p>For everyday eating, the Akarigbo Road food strip in Sagamu Town has everything from jollof rice to late-night pepper soup. Mama Titi's on Iperu Road is a Sagamu institution — she has been cooking there for decades and the ofe onugbu is serious food.</p>
                <p>Suya in the evenings comes from the Remo Suya Spot near Agbowa. Bring cash. The Sagamu-Ore Road strip of roadside stops remains the traveller's reference point for catfish pepper soup that has stayed consistent for years.</p>
                <a href="{{ route('category.show', 'restaurant-buka') }}">See all restaurants in Sagamu &rarr;</a>
            </div>
        </li>

        <li class="step-item">
            <span class="step-number">05</span>
            <div class="step-body">
                <h2>Weekends in Sagamu</h2>
                <p>If you follow football, Remo Stars FC plays home games at Remo Stars Stadium in Ikenne-Remo, about 20 minutes from Sagamu Town. They are one of the better-run clubs in the NPFL and matchdays have a proper atmosphere. Check the fixtures and go — it is worth it.</p>
                <p>Several gyms have opened in Sagamu for those who train. Football pitches are scattered across the LGA for casual and organised games. The Sagamu-Abeokuta road passes through pleasant rural terrain and is used for early-morning cycling and running by residents who need to get out of the urban centre.</p>
                <p>Lagos is close enough for an afternoon trip and far enough to feel like a weekend away. Most Sagamu residents make the Lagos run once or twice a month for shopping, entertainment, and social commitments.</p>
                <a href="{{ route('home') }}#recreation">Recreation and leisure in Sagamu &rarr;</a>
            </div>
        </li>

    </ol>

    <div class="quick-ref-box">
        <h2>Quick Reference</h2>
        <table class="quick-ref-table">
            <tr>
                <td>OOUTH Emergency</td>
                <td><a href="tel:+2348012345678">+234 801 234 5678</a> &nbsp;&middot;&nbsp; 24 hours</td>
            </tr>
            <tr>
                <td>OOUTH Address</td>
                <td>OOUTH, Sagamu, Ogun State (GPS: 6.8416, 3.6479)</td>
            </tr>
            <tr>
                <td>Police</td>
                <td>Sagamu Divisional Police HQ &nbsp;&middot;&nbsp; <a href="tel:199">199</a></td>
            </tr>
            <tr>
                <td>Fire Service</td>
                <td>Ogun State Fire Service &nbsp;&middot;&nbsp; <a href="tel:08037145100">0803 714 5100</a></td>
            </tr>
            <tr>
                <td>Bus to Lagos</td>
                <td>Sagamu Bus Park, under the interchange (Lagos buses depart from early morning)</td>
            </tr>
            <tr>
                <td>Bus to Ibadan</td>
                <td>Same bus park &nbsp;&middot;&nbsp; Ibadan-bound buses through the morning</td>
            </tr>
            <tr>
                <td>Market Days</td>
                <td>Isale Sagamu Market: daily &nbsp;&middot;&nbsp; Makun Market: Thursdays &amp; Sundays</td>
            </tr>
        </table>
    </div>

</div>

@endsection
