# Sagamu.ng — Master Plan
> From concept to launch: business strategy, technical architecture, UI/UX, and execution roadmap.

---

## Table of Contents

1. [Executive Summary](#1-executive-summary)
2. [Product Vision](#2-product-vision)
3. [Target Audience](#3-target-audience)
4. [Why This Works (AI-Proof Reasoning)](#4-why-this-works-ai-proof-reasoning)
5. [Content Strategy](#5-content-strategy)
6. [Sagamu Today — The Editorial Engine](#6-sagamu-today--the-editorial-engine)
7. [Monetisation](#7-monetisation)
8. [Marketing & Distribution](#8-marketing--distribution)
9. [UI/UX Design System](#9-uiux-design-system)
10. [Site Structure & Sections](#10-site-structure--sections)
11. [Technical Architecture](#11-technical-architecture)
12. [Infrastructure](#12-infrastructure)
13. [Development Phases](#13-development-phases)
14. [Risks & Mitigations](#14-risks--mitigations)
15. [Lessons from FindExpert](#15-lessons-from-findexpert)

---

## 1. Executive Summary

**Sagamu.ng** is a hyperlocal city guide for Sagamu, Ogun State, Nigeria. It serves as the single authoritative reference for anyone living in, moving to, or doing business in Sagamu — covering restaurants, schools, healthcare, sports, recreation, neighbourhoods, markets, events, property, and transport.

The site is editorially driven (not a directory, not a forum) and monetised through paid business listings, sponsored content, and event promotion. It is built on a static HTML/CSS frontend (designed), migrating to a Laravel backend for content management.

**Domains:** sagamu.ng (primary), sagamu.com.ng (redirects to primary)

---

## 2. Product Vision

> "New to Sagamu? Visit Sagamu.ng"

The core insight: Sagamu has a significant population of relocated professionals — engineers at Lafarge, doctors posted to OOUTH, staff at Coleman Cables, teachers at Babcock University — who arrive in an unfamiliar town with immediate practical needs. They need to know:

- Where to enrol their children in school
- Where to eat that is not a rough roadside spot
- Where to attend church or mosque
- Where to find a gym or recreational facility
- What neighbourhood to rent in
- What is happening in the town socially

Currently they Google each question separately and get poor results. Sagamu.ng answers all of it in one trusted place — written by someone who knows the town.

Secondary audiences: long-term Sagamu residents who want to discover new places, businesses looking for local visibility, diaspora Nigerians curious about home.

---

## 3. Target Audience

### Primary: The Relocated Professional
- Transferred or newly employed at Lafarge, OOUTH, Coleman Cables, Babcock University, or Sagamu-area companies
- Not from Sagamu, has no local network
- Educated, has disposable income
- Has children to enrol in school
- Stays 1–3 years, then leaves — replaced by someone in the same situation
- High intent, high engagement, willing to pay for reliable information (indirectly via the businesses they patronise)

### Secondary: The Long-Term Resident
- Born in or long settled in Sagamu
- Wants to discover new restaurants, follow Remo Stars, stay updated on local events
- Lower urgency but higher loyalty and word-of-mouth value

### Tertiary: The Diaspora
- Grew up in Sagamu, lives abroad or in Lagos
- Reads for nostalgia and to stay connected
- Shares content — valuable for organic growth

### Distribution Insight
HR departments at Lafarge, OOUTH, Coleman Cables onboard new employees regularly. A single email to each HR department offering Sagamu.ng as a relocation resource is a direct distribution channel. These companies have done the audience targeting for you.

---

## 4. Why This Works (AI-Proof Reasoning)

### Why FindExpert failed against AI
FindExpert was a **search and retrieve** product — "find me a plumber in Ogun State." AI does this better. Directory platforms are being disrupted across the board.

### Why Sagamu.ng is different
Sagamu.ng is a **content and context** product. AI cannot reliably tell you:
- Which specific buka on Akarigbo Street has the best ofe onugbu right now
- That OOUTH opened a new dialysis unit last month
- Which private school just completed a new science block and raised their standard
- What Remo Stars' current form looks like this season
- What the Sagamu market crowd is like on Thursdays vs Saturdays

This knowledge does not exist in AI training data in usable form because nobody has written it down properly yet. **Sagamu.ng writing it becomes the source AI eventually cites.**

### Google's direction works in our favour
Google's E-E-A-T algorithm (Experience, Expertise, Authoritativeness, Trustworthiness) rewards exactly what Sagamu.ng should be: a personal, locally grounded, human voice writing with genuine first-hand knowledge. Generic AI-generated city guide copy fails this test. Authentic local editorial content passes it.

### The survivability condition
The site survives if content is **irreplaceably specific and local**.
The site dies if it becomes a thin-description directory.
This is an editorial commitment, not a technology problem.

---

## 5. Content Strategy

### Core Principle
Write as someone who lives in Sagamu, not as someone who Googled Sagamu. Every listing should have a detail that only local knowledge provides.

### Content Sections
| Section | Content Type | Update Frequency |
|---|---|---|
| Eat & Drink | Restaurant/buka listing cards | As new places open |
| Sports | Remo Stars FC, Ebedei FC match coverage, league updates | Weekly during season |
| Recreation | Gyms, fields, leisure spots | Monthly |
| Healthcare | OOUTH updates, private hospitals/clinics | As news breaks |
| Schools | Private and public schools, new facilities, enrolment info | Per term |
| Neighbourhoods | Character, rental cost range, what type of person lives there | Quarterly |
| Business | Directory of companies, new businesses in Sagamu | Monthly |
| Markets | Market days, what each market specialises in | Stable, update as needed |
| Events | Upcoming events, concerts, church programmes, civic events | Weekly |
| Property | Rental listings, estate agents, housing estates | Monthly |
| Transport | Bus routes, ride options, road conditions | As needed |
| What's New | Homepage sidebar widget — latest updates across all categories | Every post |

### Content Bootstrap Workflow
1. **Scrape** — manually browse Google Maps, Facebook, Instagram for business names, addresses, phone numbers. Copy-paste into Filament admin.
2. **Edit** — clean up, add local knowledge, write a proper description (not copied from Google)
3. **Publish** — content goes live
4. **Maintain** — update when things change; use Google Alerts for "Sagamu" to catch news

### What NOT to do
- Do not republish national Nigerian news (Punch, Vanguard, Guardian) — this is duplicate content and loses SEO
- Do not use AI to write listing descriptions — generic prose kills the E-E-A-T signal
- Do not scrape Google Places API — it requires billing and creates a legal and cost dependency
- Do not import social media automatically — embed official posts where relevant, do not scrape

### Factual Notes
- Mayflower School, Sagamu: founded by **Tai Solarin** (not Obafemi Awolowo)
- OOUTH = Olabisi Onabanjo University Teaching Hospital

---

## 6. Sagamu Today — The Editorial Engine

### What It Is

"Sagamu Today" is the editorial voice of the site — a named column (or section) written by "The Sagamu.ng Team" that covers the economic life, business opportunities, and industrial story of Sagamu. It is not a news feed. It is not a press release aggregator. It is insider intelligence, written plainly, for people who want to understand what is actually happening in this town and what they can do about it.

This is the most defensible content on the entire site. Every city guide covers restaurants. Nobody covers the supply chains running through a town.

---

### The Tone

Confident. Knowledgeable. Unpretentious. Written like a smart local who has been paying attention and wants to share what they know. Not academic, not breathless startup-speak, not Nigerian newspaper formal.

The example that defines the voice:

> **Sagamu Is Moving: What You Need to Know Right Now**
> *by The Sagamu.ng Team*
>
> Sagamu is no longer just a junction on the Lagos-Ibadan Expressway. The city is building something. Businesses are opening, a world-class teaching hospital is expanding its services, two football clubs are putting Remo on the national map, and schools across the LGA are investing in new facilities. This is your guide to all of it.

---

### Content Types

**1. The Opportunity Piece**
The signature format. Surfaces a business opportunity that exists in Sagamu's economy but is not obvious to outsiders.

> *"Do you know that wood exporters collect timber from Taraba, truck it to Sagamu, containerise it, and ship it to China? The whole operation passes through this town. If you are a logistics operator, a packaging supplier, or a freight forwarder, there are companies here that need your services — and most of them are not on the internet."*

These pieces do three things at once: they inform readers, they attract the business players described, and they create content that nobody else on the internet has written.

**2. The Industry Spotlight**
A deep-dive on one sector operating in or around Sagamu.

Examples:
- Lafarge and the cement economy — what suppliers do they need, who benefits locally?
- The Sagamu market as a regional distribution node — what comes in, what goes out, who moves it?
- OOUTH and the medical economy — private clinics, pharmacies, medical tourism from nearby towns
- The Remo education belt — Babcock, Mayflower, and the tutoring/accommodation economy around them

**3. The Company Profile**
A plainly written profile of a company operating in or near Sagamu — what they do, how many people they employ, what they buy locally, what opportunities their presence creates.

Target companies:
- Lafarge Africa (cement)
- Coleman Wires & Cables
- Alufoil Products
- OOUTH (as an economic anchor institution)
- Wood/timber export operators
- Agro-processing businesses in Sagamu LGA

**4. The "Sagamu Is Moving" Update**
Regular (monthly or quarterly) state-of-the-town pieces. New businesses that opened, new facilities, what changed.

**5. The Practical Opportunity Guide**
Step-by-step for a specific business type:

> *"If you are a wholesale distributor looking to crack the Sagamu market, here is where the buyers actually are, what they need, and how deals typically get done here."*

---

### Why This Section Is AI-Proof

AI cannot write the wood export story. It does not know timber moves from Taraba through Sagamu to China in containers. It does not know which yard on the Abeokuta Road is where the containers are packed. It does not know who the key brokers are. You know these things, or you can find them out, because you are local. That knowledge advantage is permanent — AI trains on published text, and this text does not exist yet.

---

### Who Reads This Section

- Entrepreneurs and SME owners looking for supply chain angles
- Lagos-based businesses considering expanding into Ogun State
- Corporate procurement teams at Lafarge, OOUTH, and similar — they often source locally if they know local suppliers exist
- Diaspora Nigerians looking for investment/business entry points in Southwest Nigeria
- Journalists and researchers covering Nigerian economic development (they will link to you — SEO gold)

This is also the section most likely to be shared in WhatsApp business groups, which is where business intelligence spreads in Nigeria.

---

### Monetisation Tie-in

"Sagamu Today" creates a premium advertising environment. A company profiled in an Opportunity Piece naturally wants to be featured (and may pay for an enhanced profile listing). An industry spotlight on the Sagamu market attracts wholesale and logistics businesses as advertisers. The editorial credibility of the section makes the surrounding ad space worth more than a plain directory.

---

### Editorial Notes

- No press release regurgitation — rewrite any company information in your own voice
- Every claim should be verifiable — do not state something as fact unless you have seen it or spoken to someone who has
- No em dashes
- No AI-generated copy in this section specifically — the value is the human, local, insider voice

---

## 7. Monetisation

### Phase 1 — Basic (launch to 3 months)
Nothing. Build the audience first. Do not put ads on an empty site.

### Phase 2 — Early Revenue (3–6 months post-launch)
| Revenue Stream | Mechanism | Est. Rate |
|---|---|---|
| Enhanced Listings | Businesses pay to be featured with gallery, WhatsApp button, top placement | ₦5,000–₦15,000/month |
| Sponsored Content | "Brought to you by X School — enrolment open" banner above Schools section | ₦10,000–₦25,000/month |
| Event Promotion | Charge to list events prominently in Events section | ₦3,000–₦8,000/event |

### Phase 3 — Growth Revenue (6+ months)
| Revenue Stream | Notes |
|---|---|
| Classified Ads | Property rentals, job listings (local) |
| Newsletter Sponsorship | Single sponsor per weekly digest once subscriber base grows |
| Business Directory Premium | Verified badge, category priority, contact form |

### Key Insight
You do not need huge traffic to monetise. 500 loyal Sagamu readers is enough to charge a business ₦10,000/month to be featured. That is enough to cover hosting costs and grow from there. The Lafarge/OOUTH staff are the exact demographic local businesses want to reach.

---

## 8. Marketing & Distribution

### Physical (underrated in Nigeria)
- Flyers at Sagamu bus parks (people arriving from Lagos, Ibadan, Abeokuta)
- Notice boards at OOUTH gate and wards
- Lafarge residential estate notice boards
- Federal Housing estate Sagamu
- Church and mosque notice boards
- Sagamu interchange (massive foot traffic)

### Digital
- WhatsApp: share individual articles and listings in Sagamu community groups
- Instagram: post local content with Sagamu geotags
- Twitter/X: post Remo Stars match updates — football content gets shared

### Direct Outreach (high value, low effort)
- Email HR departments at Lafarge, OOUTH, Coleman Cables: offer Sagamu.ng as a free relocation resource for new staff
- Contact Remo Stars FC: offer to be their unofficial local media partner
- Reach out to estate agents in Sagamu: list them for free, they will promote the site to incoming tenants

### SEO (long game)
- Every venue/school/hospital gets its own URL: `/eat/junction-restaurant`, `/schools/mayflower`
- Proper meta titles: "Best Restaurants in Sagamu Ogun State | Sagamu.ng"
- Submit sitemap to Google Search Console at launch
- Write long-form neighbourhood guides — these rank well for "living in Sagamu" type queries

---

## 9. UI/UX Design System

### Design Philosophy
Not AI slop. No em dashes, no gradient backgrounds, no emoji icons, no blue themes. Clean, editorial, warm. Inspired by Time Out London (listing cards), Thrillist (off-white warm background), Nigerian newspaper sites (Punch, Guardian NG) for typography discipline.

### Colour Palette
```
--orange:      #e56010   (primary brand, CTAs, active nav)
--orange-dark: #c0500d   (hover states)
--yellow:      #ffcf21   (masthead underline strip, accent)
--bg:          #f7f4f0   (warm off-white page background)
--bg-white:    #ffffff   (cards, header)
--dark:        #1a1a1a   (hero strip, footer, OOUTH card)
--text:        #2a2a2a   (body copy)
--text-muted:  #777777   (secondary text, captions)
--border:      #e2ddd8   (card borders, section dividers)
```

### Typography
```
--font-display: 'Playfair Display', Georgia, 'Times New Roman', serif
--font-body:    'Plus Jakarta Sans', 'Segoe UI', Helvetica, Arial, sans-serif
```
- Headlines: Playfair Display, 700 weight
- Body: Plus Jakarta Sans, 400/500 weight
- Nav: Plus Jakarta Sans, 700 weight, uppercase, 0.7px letter-spacing
- No em dashes anywhere

### Masthead (current)
- Text: "Welcome to Sagamu"
- Font: Playfair Display, 700, normal (non-italic)
- Size: `clamp(1.6rem, 2.8vw, 2.4rem)`
- Background: white, centred
- Bottom border: 10px solid `#ffcf21`
- Animation: slide in from left (`translateX(-30px)` → `translateX(0)`), 0.55s ease-out
- Padding: `6px 0 1px`

### Hero Strip (current)
- Background: `#1a1a1a`
- H1: "Your complete guide to life in Sagamu"
  - Playfair Display, 700, **italic**
  - Size: `clamp(1.3rem, 2.5vw, 1.9rem)`
  - Colour: white
- Subtext: "Restaurants, sport, health, schools, business and neighbourhood life in one place"
  - Plus Jakarta Sans, colour: #999
- Bottom border: 4px solid orange

### Navigation
- 12 items: Home | Eat & Drink | Sports | Recreation | Healthcare | Schools | Business | Neighbourhoods | Markets | Events | Property | Transport
- Sticky, top: 0, z-index: 100
- Font: Plus Jakarta Sans, 700, uppercase, 0.8rem
- Active/hover: orange text + 3px orange bottom border
- Mobile: `flex-wrap: wrap` (all items visible, wraps to multiple rows)
- Landscape phone: single scrollable row

### Card Design
- Tag chips: orange `tag-category` + dark `tag-neighbourhood`
- Venue name as headline
- Descriptor line (what it is in one line)
- Pitch (1–2 sentences of actual editorial value)
- CTA link: "Find out more ›"

### Responsive Breakpoints
| Breakpoint | Behaviour |
|---|---|
| 1280px (default) | Full desktop, all columns |
| 1024px | Sidebar narrows, neighbourhood 3-col, footer 2×2 |
| 768px | Featured stacks, cards 2-col, nav wraps |
| 480px | Cards single-col, sports card reduced |
| 360px | Neighbourhood single-col, footer single-col |
| landscape + max-height 500px | Compact header, scrollable nav, 2-col cards |

### Layout Constraints
```
--max: 1280px   (max content width)
--pad: 0 5%     (horizontal section padding)
```

---

## 10. Site Structure & Sections

### Homepage Layout (top to bottom)
1. **Masthead** — "Welcome to Sagamu" + yellow strip
2. **Sticky Nav** — 12 items
3. **Hero Strip** — dark, italic tagline
4. **Featured + Sidebar** — lead article (16:9 image) + "What's New" widget + topic tag pills
5. **Eat & Drink** — 3-column listing cards
6. **Sports** — 2-column flex cards (Remo Stars FC, Ebedei FC)
7. **Recreation** — 3-column listing cards (gyms, fields, leisure)
8. **Healthcare** — OOUTH dark card (2-col dept list, yellow heading) + private hospitals
9. **Schools** — 2×2 grid (Mayflower, Remo Secondary, State Primary, Life a Deaf)
10. **Explore by Neighbourhood** — 4-col cards, orange left-border hover
11. **Business in Sagamu** — directory list left + orange CTA card right
12. **Footer** — newsletter row + 4-col links + social bottom bar

### Individual Pages (Phase 2)
- `/eat/[slug]` — full restaurant profile
- `/schools/[slug]` — school detail page
- `/healthcare/[slug]` — hospital/clinic detail
- `/neighbourhood/[slug]` — neighbourhood guide
- `/sports/remo-stars` — Remo Stars FC hub page
- `/events` — full events calendar

### Key Page: "New to Sagamu?"
A dedicated landing page at `/new-to-sagamu` that directly addresses the relocated professional:
- What to sort out first (schools, housing, healthcare)
- Best neighbourhoods to rent
- Where to eat well
- What to do on weekends
- Emergency contacts (OOUTH, police, fire)

This page should be linked from the homepage prominently and is the primary page to share with HR departments.

---

## 11. Technical Architecture

### Stack

| Layer | Technology | Reason |
|---|---|---|
| Framework | Laravel 12 | Runs on PHP shared hosting, excellent ecosystem, FindExpert codebase reuse |
| Admin/CMS | Laravel Filament | Built-in, free, beautiful admin panel — replaces external CMS |
| Database | MySQL (cPanel) | Already included in Go54 hosting |
| Images | Cloudinary | Already integrated in FindExpert codebase, free tier, CDN delivery |
| Email | Brevo (SMTP) | 300 emails/day free, not blacklisted unlike cPanel SMTP |
| Frontend | Blade templates + sagamu.css | Existing design migrated into Laravel views |
| Version Control | GitHub | Free, enables deployment workflow |
| CDN / SSL / DDoS | Cloudflare free tier | Essential for shared hosting protection |

### Database Schema

```
listings
  id, name, slug, category_id, neighbourhood_id
  description, pitch (short), tags (JSON)
  address, phone, whatsapp, website
  profile_image (Cloudinary URL)
  is_featured, is_premium, status
  created_at, updated_at

articles
  id, headline, slug, body (text)
  category, featured_image
  published_at, is_featured

events
  id, title, slug, date, venue
  description, category, image
  is_free, ticket_url

schools
  id, name, slug, type (public/private)
  neighbourhood_id, description
  facilities (JSON), contact, image

neighbourhoods
  id, name, slug, description
  character, rental_range, key_landmarks

newsletter_subscribers
  id, email, subscribed_at, confirmed (boolean)

categories
  id, name, slug, icon, sort_order
```

### Folder Structure

```
sagamu-ng/                      ← lives outside public_html
├── app/
│   ├── Models/
│   │   ├── Listing.php
│   │   ├── Article.php
│   │   ├── Event.php
│   │   ├── School.php
│   │   ├── Neighbourhood.php
│   │   └── NewsletterSubscriber.php
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── ListingController.php
│   │   ├── ArticleController.php
│   │   ├── EventController.php
│   │   └── NewsletterController.php
│   └── Filament/Resources/      ← admin CMS
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── home.blade.php
│   ├── listings/show.blade.php
│   ├── schools/show.blade.php
│   └── neighbourhoods/show.blade.php
├── public/                      ← document root points here
│   ├── css/sagamu.css
│   └── index.php
└── routes/web.php
```

### Reuse from FindExpert
- Cloudinary upload integration (ExpertController → copy to ListingController)
- Nigerian States/LGAs migrations and seeders
- Slug generation (spatie/laravel-sluggable already installed)
- Bootstrap workflow for cPanel deployment

---

## 12. Infrastructure

### Hosting: Go54 Shared Linux (cPanel)

**Critical: Document root fix**
cPanel defaults to `public_html/`. Laravel requires `public/` as document root.
Solution — put Laravel app outside `public_html`:

```
/home/youraccount/
├── sagamu/              ← Laravel app (not web-accessible)
│   ├── app/
│   ├── resources/
│   └── public/
└── public_html/
    └── index.php        ← loads ../sagamu/public/index.php
```

`public_html/index.php`:
```php
<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/../sagamu/vendor/autoload.php';
$app = require_once __DIR__.'/../sagamu/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle($request = Illuminate\Http\Request::capture());
$response->send();
$kernel->terminate($request, $response);
```

**PHP Version**
Set PHP 8.2+ in cPanel → MultiPHP Manager. Laravel 12 requires minimum PHP 8.2.

**Cron Job (cPanel)**
```
* * * * * php /home/youraccount/sagamu/artisan schedule:run >> /dev/null 2>&1
```

### Cloudflare (free)
1. Create Cloudflare account
2. Add sagamu.ng domain
3. Change nameservers at your registrar to Cloudflare's
4. SSL mode: Full (strict)
5. Enable caching for static assets
6. Result: Go54 IP hidden, DDoS protected, CDN active, SSL working

### Domain Strategy
- **Primary**: sagamu.ng
- **Redirect**: sagamu.com.ng → 301 → sagamu.ng (set in Cloudflare Page Rules)
- **www**: www.sagamu.ng → sagamu.ng (Cloudflare CNAME)

### Email: Brevo
- Sign up at brevo.com
- Add and verify sagamu.ng sender domain
- Use SMTP credentials in Laravel `.env`:
  ```
  MAIL_MAILER=smtp
  MAIL_HOST=smtp-relay.brevo.com
  MAIL_PORT=587
  MAIL_USERNAME=your_brevo_login
  MAIL_PASSWORD=your_brevo_smtp_key
  MAIL_FROM_ADDRESS=hello@sagamu.ng
  MAIL_FROM_NAME="Sagamu.ng"
  ```

### Monitoring: UptimeRobot (free)
- Monitor https://sagamu.ng every 5 minutes
- Alert via email/SMS if down
- Shared hosting goes down — you want to know

### Backups
- cPanel → Backup Wizard: weekly full backup
- Download to local machine once a month
- GitHub: code is always backed up via git push

### Local Development: Laragon
- Install Laragon on Windows (bundles PHP 8.2, MySQL, Composer, Nginx)
- Clone repo, `composer install`, configure `.env`
- Develop locally, push to GitHub, pull on Go54 via SSH

### Environment Variables (.env on Go54)
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://sagamu.ng

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=your_cpanel_db
DB_USERNAME=your_cpanel_db_user
DB_PASSWORD=your_cpanel_db_pass

CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name

MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
...
```

---

## 13. Development Phases

### Phase 0 — Setup (before writing a line of Laravel)
- [ ] Verify Cloudinary account (log in, check storage, note credentials)
- [ ] Install Laragon locally
- [ ] Create GitHub repository: `sagamu-ng`
- [ ] Sign up: Cloudflare, Brevo, UptimeRobot, Google Search Console
- [ ] Point sagamu.ng nameservers to Cloudflare
- [ ] Set PHP 8.2 on Go54 cPanel

### Phase 1 — Foundation (launch milestone)
- [ ] Initialise Laravel project
- [ ] Install Filament admin panel
- [ ] Define database migrations (listings, articles, schools, neighbourhoods, categories, newsletter_subscribers)
- [ ] Create Filament resources (admin forms for each content type)
- [ ] Migrate existing sagamu.html/sagamu.css into Blade templates
- [ ] Homepage: pulls real content from DB (Eat & Drink, Sports, Schools, etc.)
- [ ] Newsletter subscribe form → stores email in newsletter_subscribers table
- [ ] Deploy to Go54 with correct document root
- [ ] Configure Brevo SMTP, test newsletter signup email
- [ ] Set up UptimeRobot
- [ ] Submit sitemap to Google Search Console
- [ ] Redirect sagamu.com.ng → sagamu.ng via Cloudflare

**Done = site is live with real content managed via Filament**

### Phase 2 — Individual Pages + SEO (1–2 months post-launch)
- [ ] `/eat/[slug]` — full listing page per venue
- [ ] `/schools/[slug]` — school detail page
- [ ] `/neighbourhood/[slug]` — neighbourhood guide
- [ ] `/new-to-sagamu` — relocation landing page
- [ ] Proper `<meta>` title/description per page
- [ ] OpenGraph images for social sharing
- [ ] Structured data (JSON-LD) for local businesses
- [ ] Outreach to Lafarge/OOUTH HR departments with `/new-to-sagamu` link

### Phase 3 — Community + Revenue (3–6 months post-launch)
- [ ] Premium listing feature (paid enhanced placement)
- [ ] Business submission form → admin review → publish
- [ ] Events calendar with full CRUD
- [ ] Weekly newsletter digest (Laravel scheduler + Brevo)
- [ ] Property listings section
- [ ] Remo Stars match result posting workflow
- [ ] Begin charging for enhanced listings

---

## 14. Risks & Mitigations

| Risk | Likelihood | Impact | Mitigation |
|---|---|---|---|
| Content goes stale, loses trust | High | High | Google Alerts for "Sagamu", quarterly content audit schedule |
| Generic content, loses SEO | Medium | High | Write with specific local detail, avoid AI-generated descriptions |
| Shared hosting downtime | Medium | Medium | Cloudflare caches pages — site still loads even when Go54 is down |
| Low traffic at launch | High | Low | Physical marketing + HR outreach covers initial audience |
| No monetisation in first 3 months | High | Low | Expected — build audience first |
| Cloudinary storage fills up | Low | Medium | Monitor dashboard, Cloudinary free is 25GB — enough for years |
| Brevo daily limit (300/day) hit | Low | Low | Only an issue if newsletter grows large — upgrade is cheap |

---

## 15. Lessons from FindExpert

FindExpert (findexpert.com.ng) was a Nigerian construction professional directory built on Laravel. It was never launched due to:

1. **Wrong build sequence**: 10 features at 60% each, instead of 3 features at 100%
2. **No authentication**: Admin panel completely open, any visitor could edit any listing
3. **No monetisation**: Premium/subscription system was designed but never implemented
4. **Wrong product category**: "Find an expert" is exactly what AI now does better
5. **Google API dependency**: Required billing, restricted usage, creates external dependency

**What Sagamu.ng does differently:**
- Build thin complete slices: Phase 1 ships with only 3 things working end-to-end
- No open admin: Filament admin is password-protected from day one
- Monetisation designed from Phase 2 (not an afterthought)
- Content product, not search product — different competitive landscape
- No Google API: all content is manual/editorial

**FindExpert codebase is not wasted.** Cloudinary integration, Nigerian states/LGAs data, sluggable package, and the Laravel deployment workflow all carry forward directly to Sagamu.ng.

---

*Document last updated: June 2026*
*Current site status: Static HTML/CSS prototype complete (sagamu.html + sagamu.css)*
*Next step: Phase 0 setup*
