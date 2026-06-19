@extends('layouts.app')

@section('title', 'Sagamu.ng — Your Complete Guide to Life in Sagamu')

@section('content')

<div id="hero-strip">
    <h1>Your complete guide to life in Sagamu</h1>
    <p>Restaurants, sport, health, schools, business and neighbourhood life in one place</p>
</div>

<div id="main-wrap">

    {{-- FEATURED ARTICLE + SIDEBAR --}}
    <div class="featured-grid">
        <article class="featured-article">
            @if($featuredArticle)
                <img src="{{ $featuredArticle->hero_image ?? asset('images/blog (1).jpg') }}" alt="{{ $featuredArticle->title }}" />
                <p class="article-eyebrow">{{ $featuredArticle->kicker ?? 'Sagamu Today' }}</p>
                <h2>{{ $featuredArticle->title }}</h2>
                @if($featuredArticle->author)
                    <p class="article-byline">by {{ $featuredArticle->author }}</p>
                @endif
                <p class="body-text">{{ Str::limit($featuredArticle->excerpt ?? strip_tags($featuredArticle->body), 280) }}</p>
                <a href="{{ route('article.show', $featuredArticle->slug) }}" class="read-more-btn">Read the full story</a>
            @else
                <img src="{{ asset('images/blog (1).jpg') }}" alt="Sagamu" />
                <p class="article-eyebrow">Sagamu Today</p>
                <h2>Sagamu Is Moving: What You Need to Know Right Now</h2>
                <p class="article-byline">by The Sagamu.ng Team</p>
                <p class="body-text">Sagamu is no longer just a junction on the Lagos-Ibadan Expressway. The city is building something. Businesses are opening, a world-class teaching hospital is expanding its services, two football clubs are putting Remo on the national map, and schools across the LGA are investing in new facilities.</p>
                <a href="#" class="read-more-btn">Read the full story</a>
            @endif
        </article>

        <aside class="sidebar">
            <div class="sidebar-widget">
                <h4 class="widget-title">What's New</h4>
                <ul class="widget-links">
                    @forelse($recentArticles as $article)
                        <li><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></li>
                    @empty
                        <li><a href="#">OOUTH opens new cardiac unit this quarter</a></li>
                        <li><a href="#">Remo Stars set for NPFL home opener at Ikenne</a></li>
                        <li><a href="#">New market plaza planned for Makun junction</a></li>
                        <li><a href="#">Three private schools add new laboratory blocks</a></li>
                        <li><a href="#">Sagamu-Ore road repairs scheduled to begin</a></li>
                    @endforelse
                </ul>
            </div>
            <div class="sidebar-widget">
                <h4 class="widget-title">Browse Topics</h4>
                <div class="widget-tags">
                    @foreach($categories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" class="widget-tag">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>

    {{-- EAT & DRINK --}}
    <section class="content-section" id="eat-drink">
        <div class="section-header">
            <h2 class="section-title">Eat &amp; Drink</h2>
            <a href="{{ route('category.show', 'restaurant-buka') }}" class="see-all">See all restaurants</a>
        </div>
        <div class="cards-grid-3">
            @forelse($eatDrinkListings as $listing)
                <x-listing-card :listing="$listing" />
            @empty
                {{-- Static fallback until listings are seeded --}}
                <div class="listing-card">
                    <a href="#"><img src="{{ asset('images/blog (1).jpg') }}" alt="Akarigbo Road Food Strip" /></a>
                    <div class="listing-card__body">
                        <div class="listing-card__tags"><span class="tag-category">Street Food</span><span class="tag-neighbourhood">Sagamu Town</span></div>
                        <h3 class="listing-card__name"><a href="#">Akarigbo Road Food Strip</a></h3>
                        <p class="listing-card__pitch">The densest cluster of eateries in Sagamu. Everything from jollof to pepper soup, open from morning to late.</p>
                        <a href="#" class="listing-card__cta">See listings &rarr;</a>
                    </div>
                </div>
                <div class="listing-card">
                    <a href="#"><img src="{{ asset('images/one.webp') }}" alt="Junction Kitchen" /></a>
                    <div class="listing-card__body">
                        <div class="listing-card__tags"><span class="tag-category">Restaurant</span><span class="tag-neighbourhood">Makun</span></div>
                        <h3 class="listing-card__name"><a href="#">The Junction Kitchen</a></h3>
                        <p class="listing-card__pitch">Proper sit-down dining near the Sagamu interchange. Good for business lunches and family dinners alike.</p>
                        <a href="#" class="listing-card__cta">See listings &rarr;</a>
                    </div>
                </div>
                <div class="listing-card">
                    <a href="#"><img src="{{ asset('images/two.webp') }}" alt="Pepper Soup Mile" /></a>
                    <div class="listing-card__body">
                        <div class="listing-card__tags"><span class="tag-category">Bar &amp; Grill</span><span class="tag-neighbourhood">Sagamu-Ore Road</span></div>
                        <h3 class="listing-card__name"><a href="#">Pepper Soup Mile</a></h3>
                        <p class="listing-card__pitch">Roadside spots that have fed travellers on the Sagamu-Ore road for decades. The catfish is the reason people stop.</p>
                        <a href="#" class="listing-card__cta">See listings &rarr;</a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- SPORTS --}}
    <section class="content-section" id="sports">
        <div class="section-header">
            <h2 class="section-title">Sports</h2>
            <a href="#" class="see-all">All sports coverage</a>
        </div>
        <div class="sports-grid">
            <div class="sports-card">
                <div class="sports-card__icon"><i class="fa fa-futbol-o"></i></div>
                <div>
                    <span class="tag-category" style="display:inline-block;margin-bottom:10px;">NPFL</span>
                    <h3 class="sports-card__name">Remo Stars FC</h3>
                    <p class="sports-card__info">The Sky Blue Stars of Sagamu. One of the best-run clubs in the Nigeria Premier Football League. Home games at Remo Stars Stadium, Ikenne-Remo.</p>
                    <a href="#" class="sports-card__link">Fixtures &amp; news &rarr;</a>
                </div>
            </div>
            <div class="sports-card">
                <div class="sports-card__icon"><i class="fa fa-futbol-o"></i></div>
                <div>
                    <span class="tag-category" style="display:inline-block;margin-bottom:10px;">Local Football</span>
                    <h3 class="sports-card__name">Ebedei FC</h3>
                    <p class="sports-card__info">Grassroots football in Sagamu LGA. Ebedei FC develops young talent and gives competitive players a pathway to the bigger clubs.</p>
                    <a href="#" class="sports-card__link">Follow the club &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    {{-- RECREATION --}}
    <section class="content-section" id="recreation">
        <div class="section-header">
            <h2 class="section-title">Recreation</h2>
            <a href="{{ route('category.show', 'gym-recreation') }}" class="see-all">All venues</a>
        </div>
        <div class="cards-grid-3">
            @forelse($recreationListings as $listing)
                <x-listing-card :listing="$listing" />
            @empty
                <div class="listing-card">
                    <a href="#"><img src="{{ asset('images/tp.png') }}" alt="Football Pitches" /></a>
                    <div class="listing-card__body">
                        <div class="listing-card__tags"><span class="tag-category">Football</span><span class="tag-neighbourhood">Sagamu LGA</span></div>
                        <h3 class="listing-card__name"><a href="#">Public Football Pitches</a></h3>
                        <p class="listing-card__pitch">Several open pitches across Sagamu available for casual games. Some with floodlights for evening play.</p>
                        <a href="#" class="listing-card__cta">Find a pitch &rarr;</a>
                    </div>
                </div>
                <div class="listing-card">
                    <a href="#"><img src="{{ asset('images/one.webp') }}" alt="Gyms in Sagamu" /></a>
                    <div class="listing-card__body">
                        <div class="listing-card__tags"><span class="tag-category">Gym</span><span class="tag-neighbourhood">Sagamu Town</span></div>
                        <h3 class="listing-card__name"><a href="#">Gyms &amp; Fitness Centres</a></h3>
                        <p class="listing-card__pitch">A growing number of gyms now open in Sagamu. Weight rooms, cardio, and group sessions available.</p>
                        <a href="#" class="listing-card__cta">Find a gym &rarr;</a>
                    </div>
                </div>
                <div class="listing-card">
                    <a href="#"><img src="{{ asset('images/two.webp') }}" alt="Courts" /></a>
                    <div class="listing-card__body">
                        <div class="listing-card__tags"><span class="tag-category">Courts</span><span class="tag-neighbourhood">Various</span></div>
                        <h3 class="listing-card__name"><a href="#">Basketball &amp; Tennis Courts</a></h3>
                        <p class="listing-card__pitch">Courts and open recreational spaces used for casual play, community tournaments, and evening sport.</p>
                        <a href="#" class="listing-card__cta">See venues &rarr;</a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    {{-- HEALTHCARE --}}
    <section class="content-section" id="healthcare">
        <div class="section-header">
            <h2 class="section-title">Healthcare</h2>
            <a href="https://oouth.gov.ng" target="_blank" class="see-all">OOUTH website</a>
        </div>
        <div class="oouth-card">
            <div>
                <h3>Olabisi Onabanjo University Teaching Hospital</h3>
                <p class="oouth-body">OOUTH Sagamu is the foremost tertiary health institution in Ogun State. Open to all members of the public, not referral-only. 24-hour Accident and Emergency services. Walk-in outpatient registration available.</p>
                <p class="oouth-meta">Sagamu, Ogun State &nbsp;&middot;&nbsp; 24hr A&amp;E &nbsp;&middot;&nbsp; Walk-in outpatient</p>
                <div class="oouth-actions">
                    <a href="#">Get directions &rarr;</a>
                    <a href="#">Book outpatient &rarr;</a>
                    <a href="#">All departments &rarr;</a>
                </div>
            </div>
            <div>
                <p class="dept-label">Specialist Departments</p>
                <ul class="oouth-depts">
                    <li>Internal Medicine</li><li>General Surgery</li><li>Paediatrics</li>
                    <li>Obstetrics &amp; Gynaecology</li><li>Orthopaedics &amp; Trauma</li>
                    <li>Ophthalmology</li><li>ENT</li><li>Dermatology</li>
                    <li>Psychiatry</li><li>Radiology</li><li>Burns &amp; Plastic Surgery</li>
                    <li>Accident &amp; Emergency</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- SCHOOLS --}}
    <section class="content-section" id="schools">
        <div class="section-header">
            <h2 class="section-title">Schools</h2>
            <a href="{{ route('category.show', 'school') }}" class="see-all">Full directory</a>
        </div>
        <div class="schools-grid">
            <div class="school-item">
                <p class="school-item__type">Public Secondary</p>
                <h3 class="school-item__name"><a href="#">Remo Secondary School</a></h3>
                <p class="school-item__update">One of Ogun State's oldest and most prestigious schools. Strong academic tradition and active alumni association.</p>
            </div>
            <div class="school-item">
                <p class="school-item__type">Private Boarding Secondary</p>
                <h3 class="school-item__name"><a href="#">Mayflower School, Ikenne</a></h3>
                <p class="school-item__update">Founded by Tai Solarin in nearby Ikenne-Remo. Progressive boarding school with competitive academics and a strong sports programme.</p>
            </div>
            <div class="school-item">
                <p class="school-item__type">Public Primary</p>
                <h3 class="school-item__name"><a href="#">State Primary Schools, Sagamu LGA</a></h3>
                <p class="school-item__update">Ogun State government programmes have funded classroom renovations and laboratory equipment across several primary schools in the LGA.</p>
            </div>
            <div class="school-item">
                <p class="school-item__type">List Your School</p>
                <h3 class="school-item__name"><a href="{{ route('list-business') }}">Add a school listing</a></h3>
                <p class="school-item__update">Sagamu.ng is building the full schools directory. Submit your school and we will cover it.</p>
            </div>
        </div>
    </section>

    {{-- NEIGHBOURHOODS --}}
    <section class="content-section" id="neighbourhoods">
        <div class="section-header">
            <h2 class="section-title">Explore by Neighbourhood</h2>
        </div>
        <div class="neighbourhood-grid">
            @forelse($neighbourhoods as $n)
                <a href="{{ route('neighbourhood.show', $n->slug) }}" class="neighbourhood-card">
                    <h3>{{ $n->name }}</h3>
                    <p>{{ Str::limit(strip_tags($n->description), 100) }}</p>
                </a>
            @empty
                <a href="{{ route('neighbourhood.show', 'makun-sagamu') }}" class="neighbourhood-card">
                    <h3>Makun Sagamu</h3>
                    <p>New commercial development along the expressway corridor. Logistics, retail, and hospitality all growing.</p>
                </a>
            @endforelse
        </div>
    </section>

    {{-- BUSINESS --}}
    <section class="content-section" id="business">
        <div class="section-header">
            <h2 class="section-title">Business in Sagamu</h2>
            <a href="#" class="see-all">Full directory</a>
        </div>
        <div class="business-grid">
            <div>
                <p class="business-dir-label">Business Directory</p>
                <ul class="business-list">
                    <li><a href="#">Sagamu Industrial Estate — Plots &amp; Enquiries</a></li>
                    <li><a href="#">Ogun State Chamber of Commerce, Sagamu Branch</a></li>
                    <li><a href="#">Logistics &amp; Haulage Companies on the Corridor</a></li>
                    <li><a href="#">Agro-Processing Operations in Sagamu LGA</a></li>
                    <li><a href="#">Retail &amp; Service Businesses on Akarigbo Road</a></li>
                    <li><a href="#">New Businesses Opening in Sagamu in {{ date('Y') }}</a></li>
                </ul>
            </div>
            <div class="business-cta">
                <h3>List Your Business on Sagamu.ng</h3>
                <p>Reach every resident, visitor, and investor looking at Sagamu. Add your restaurant, shop, clinic, school or service to the directory.</p>
                <a href="{{ route('list-business') }}">Get Listed &rarr;</a>
            </div>
        </div>
    </section>

</div>
@endsection
