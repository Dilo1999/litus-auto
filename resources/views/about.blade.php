@extends('layouts.litus')

@section('title', 'About Us - LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/about_us/team-2.png');

    $showroomImage = function (string ...$parts): string {
        return asset('images/about_us/showrooms/' . implode('/', array_map('rawurlencode', $parts)));
    };

    $showrooms = $showrooms ?? [];
    $showroomCount = count($showrooms);

    $heroStrip = [
        ['icon' => 'clock', 'title' => 'Est. 2014', 'sub' => 'Twelve years in the Maldives'],
        ['icon' => 'map-pin', 'title' => $showroomCount.' Showrooms', 'sub' => 'Across the Maldives'],
        ['icon' => 'users', 'title' => 'Thousands of riders', 'sub' => 'Served since we opened'],
        ['icon' => 'shield', 'title' => 'Genuine Units', 'sub' => 'Honda & Yamaha, factory-built'],
    ];

    $timeline = [
        ['year' => '2014', 'title' => 'LITUS Automobiles founded', 'text' => 'Opened in Malé with a focus on making motorcycle ownership reachable.'],
        ['year' => '2016', 'title' => 'Ijara Plans introduced', 'text' => 'Ownership plans structured to Islamic leasing standards.'],
        ['year' => '2019', 'title' => 'Expansion to the atolls', 'text' => 'Hithadhoo showroom opens in Addu City.'],
        ['year' => '2022', 'title' => 'Service network grows', 'text' => 'Full service facilities at Fuvahmulah and Hithadhoo.'],
        ['year' => '2026', 'title' => 'Five showrooms', 'text' => 'Malé, Hulhumalé, Hithadhoo, Fuvahmulah and L. Fonadhoo.'],
    ];

    $missionVision = [
        [
            'icon' => 'zap',
            'title' => 'Our Mission',
            'text' => 'To provide support and leadership in the automobile industry by offering easy and reliable services across the Maldives - so that owning a motorcycle is a decision about what you need, not only about what you can pay upfront.',
        ],
        [
            'icon' => 'shield',
            'title' => 'Our Vision',
            'text' => 'Independent mobility for everyone. A country where distance, island or income does not determine whether you can get where you need to go.',
        ],
    ];

    $teamLeaders = [
        ['name' => 'Mohamed Zahid', 'role' => 'Chairman', 'img' => asset('images/about_us/mohomad_zahid.webp')],
        ['name' => 'Asif Rasheed', 'role' => 'Chief Executive Officer, LITUS Group', 'img' => asset('images/about_us/asif.webp')],
        ['name' => 'Ahmed Zahir', 'role' => 'Chief Operating Officer · Managing Director, LITUS Automobiles', 'img' => asset('images/about_us/ahmed.webp')],
    ];

    $teamMembers = [
        ['name' => 'Mohamed Nazeer', 'role' => 'Manager', 'dept' => 'Parts & Service Center', 'img' => asset('images/about_us/nazeer.webp')],
        ['name' => 'Iffath Ali', 'role' => 'Sales & Marketing Manager', 'dept' => 'Sales & Marketing', 'img' => asset('images/about_us/Iffath.png')],
        ['name' => 'Dhanushka', 'role' => 'Inventory Officer', 'dept' => 'Inventory Management', 'img' => asset('images/about_us/dhanushka.webp')],
        ['name' => 'Mohamed Nafiz', 'role' => 'Legal Team', 'dept' => 'Legal Affairs', 'img' => asset('images/about_us/nafiz.webp')],
    ];

    $galleryTiles = [
        ['label' => 'Showroom', 'img' => $showroomImage("Male' Showroom", 'Malé Showroom.jpg'), 'span' => true],
        ['label' => 'Showroom', 'img' => $showroomImage('Hithadhoo Showroom', 'Hithadhoo Showroom.jpg')],
        ['label' => 'Service', 'img' => $showroomImage('Hulhumale Showroom', 'Hulhumale Showroom.webp')],
        ['label' => 'Lifestyle', 'img' => $showroomImage('Fonadhoo Showroom', 'Fonadhoo Showroom.jpg')],
        ['label' => 'Showroom', 'img' => $showroomImage('Villingili Showroom', 'Villingili Showroom.jpg')],
        ['label' => 'Customer', 'img' => $showroomImage('Thinadhoo Showroom', 'Thinadhoo Showroom.webp')],
        ['label' => 'Showroom', 'img' => $showroomImage('Kudahuvadhoo Showroom', 'Kudahuvadhoo Showroom.jpg')],
    ];
@endphp

<div class="font-sans">

    <x-litus-header active="About" />

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-litus-ink text-white">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_30%] max-md:object-[center_20%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)] max-md:bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.28), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.55) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.28]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(48px,6.5vw,88px)] pb-[clamp(40px,5vw,68px)]">
            <div class="max-w-[820px]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">About LITUS Automobiles</span>
                <h1 class="font-display text-[clamp(30px,4.2vw,50px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    Driven by trust.<br><span class="text-litus-sky">Built for every ride.</span>
                </h1>
                <p class="mt-4 max-w-[620px] text-[clamp(16px,1.4vw,18px)] leading-[1.66] text-white/[0.78]">
                    Established in 2014, LITUS Automobiles is a leading motorcycle supplier in the Maldives. We offer a wide range of mobility solutions to meet the needs of our customers, with quality products and after-sales service that people come back for.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#who-we-are"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-[15px] text-[15px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                        Explore Our Story
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-[15px] text-[15px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/35 backdrop-blur-sm">
            <div class="litus-container grid grid-cols-1 gap-4 py-[22px] sm:grid-cols-2 lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroStrip as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div>
                            <b class="block text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
                            <span class="block text-[12.5px] leading-snug text-white/60">{{ $item['sub'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHO WE ARE --}}
    <section id="who-we-are" class="litus-sec scroll-mt-24">
        <div class="litus-container grid grid-cols-1 gap-14 min-[1000px]:grid-cols-[1.3fr_0.7fr]">
            <div>
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Who We Are</span>
                <h2 class="mb-6 font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">
                    Twelve years of getting Maldivians riding
                </h2>
                <div class="max-w-[720px] text-[16.5px] leading-[1.78] text-[#26324A]">
                    <p class="mb-[17px]">
                        <strong class="font-semibold text-litus-text">LITUS Automobiles started in 2014 with a straightforward observation: plenty of people in the Maldives needed a motorcycle and could afford one monthly, but almost nobody was making that easy.</strong>
                    </p>
                    <p class="mb-[17px]">
                        Buying a scooter outright means finding sixty thousand rufiyaa at once. For most working people that is not a realistic ask, and the alternatives available at the time were either unaffordable or structurally uncomfortable for customers who wanted a Shariah-compliant arrangement. So we built our ownership plans around Islamic leasing standards and named them Ijara Plans - a fixed lease price, agreed in writing at the start, paid monthly, with ownership transferring at the end.
                    </p>
                    <p class="mb-[17px]">
                        That decision shaped the company. Today the majority of the motorcycles leaving our showrooms leave on an Ijara plan, and we have built six variants of it so that a salaried employee in Malé, a fisherman in Laamu and a first-time rider with a family guarantor can each find a structure that works.
                    </p>

                    <h3 class="mb-3 mt-8 font-display text-[23px] font-bold tracking-[-0.028em] text-litus-text">Why we opened across the atolls</h3>
                    <p class="mb-[17px]">
                        We could have stayed in Malé. Most dealerships do. But a rider in Fuvahmulah or Addu needs the same access to genuine parts and a trained technician as someone in the capital, and shipping a scooter back to Malé for a service is not a serious answer. So we opened showrooms in Hithadhoo, Fuvahmulah and L. Fonadhoo, with full service facilities where the volume justifies them.
                    </p>

                    <h3 class="mb-3 mt-8 font-display text-[23px] font-bold tracking-[-0.028em] text-litus-text">What we sell, and how we stand behind it</h3>
                    <p class="mb-[17px]">
                        We supply genuine Honda and Yamaha motorcycles - factory-built machines, the same models and the same specification sold across the region. Not replicas, not rebadged units, not something assembled to look like the real thing.
                    </p>
                    <p class="mb-[17px]">
                        What we add is everything that happens after you ride out. Five showrooms across four islands. Service centres in Malé, Hithadhoo and Fuvahmulah. Genuine parts held in stock rather than ordered when something breaks. Technicians who work on these engines every day. And a LITUS warranty and after-sales commitment that we honour ourselves - so if something goes wrong with a bike you bought from us, you deal with us, in your own atoll.
                    </p>
                    <p>
                        We have also carried Sunra electric bikes in the past. Sunra has been out of stock for over two years now - we would rather say so plainly than leave a listing up that goes nowhere - and we intend to bring it back when supply and pricing make sense.
                    </p>
                </div>
            </div>

            <aside class="min-[1000px]:sticky min-[1000px]:top-[96px] min-[1000px]:self-start">
                <div class="rounded-[26px] border border-litus-line bg-white p-7 shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                    <h4 class="mb-[18px] font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Our journey</h4>
                    <div class="relative pl-[34px] before:absolute before:bottom-1.5 before:left-[9px] before:top-1.5 before:w-0.5 before:bg-litus-line before:content-['']">
                        @foreach ($timeline as $item)
                            <div class="relative pb-[30px] last:pb-0 before:absolute before:-left-[30px] before:top-[5px] before:h-3.5 before:w-3.5 before:rounded-full before:border-[3px] before:border-white before:bg-litus-primary before:shadow-[0_0_0_2px_rgba(18,87,214,0.2)] before:content-['']">
                                <span class="mb-1 block text-xs font-bold uppercase tracking-[0.1em] text-litus-primary">{{ $item['year'] }}</span>
                                <b class="mb-1 block font-display text-[17px] text-litus-text">{{ $item['title'] }}</b>
                                <span class="block text-[14.5px] leading-relaxed text-litus-text-2">{{ $item['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>

    {{-- MISSION & VISION --}}
    <section id="mission-vision" class="litus-sec scroll-mt-24 bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Mission & Vision</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">What we are here to do</h2>
            </div>
            <div class="grid grid-cols-1 gap-6 min-[900px]:grid-cols-2">
                @foreach ($missionVision as $item)
                    <article class="group rounded-[18px] border border-litus-line bg-white px-8 py-9 shadow-[0_1px_2px_rgba(9,17,32,.05)] transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="mb-5 grid h-[42px] w-[42px] place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)]">
                            <x-litus-icon :name="$item['icon']" class="h-5 w-5" />
                        </div>
                        <h4 class="mb-2.5 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">{{ $item['title'] }}</h4>
                        <p class="text-[15.5px] leading-relaxed text-litus-text-2">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LEADERSHIP --}}
    <section class="litus-sec">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Leadership Team</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">The people running LITUS</h2>
            </div>

            <div class="mb-12 grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($teamLeaders as $member)
                    <article class="overflow-hidden rounded-[18px] border border-litus-line bg-white text-center shadow-[0_1px_2px_rgba(9,17,32,.05)] transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="aspect-[4/3] overflow-hidden bg-litus-paper-3">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-full w-full object-cover object-top"
                                 loading="lazy">
                        </div>
                        <div class="px-5 pb-7 pt-[22px]">
                            <h4 class="font-display text-[clamp(20px,2.2vw,24px)] font-semibold tracking-[-0.02em] text-litus-text">{{ $member['name'] }}</h4>
                            <p class="mt-1.5 text-sm font-semibold text-litus-primary">{{ $member['role'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <h3 class="mb-6 text-center font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Management &amp; Departments</h3>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4 md:gap-6">
                @foreach ($teamMembers as $member)
                    <article class="rounded-[18px] border border-litus-line bg-white px-5 py-6 text-center shadow-[0_1px_2px_rgba(9,17,32,.05)] transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="mx-auto mb-3.5 h-[72px] w-[72px] overflow-hidden rounded-full bg-litus-paper-3 md:h-[84px] md:w-[84px]">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-full w-full object-cover object-top"
                                 loading="lazy">
                        </div>
                        <b class="mb-1 block text-[15px] text-litus-text">{{ $member['name'] }}</b>
                        <span class="mb-1.5 block text-sm font-semibold text-litus-primary">{{ $member['role'] }}</span>
                        <span class="block text-[11.5px] text-litus-text-3">{{ $member['dept'] }}</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LOCATIONS --}}
    <section id="locations" class="litus-sec scroll-mt-24 bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Our Locations</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Showrooms and service centres</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Visit our showrooms and service centres across the Maldives for motorcycles, genuine parts and trusted support.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($showrooms as $showroom)
                    @php
                        $coverImage = $showroom['images'][0] ?? ($showroom['img'] ?? null);
                    @endphp
                    <article class="flex h-full flex-col overflow-hidden rounded-[18px] border border-litus-line bg-white shadow-[0_1px_2px_rgba(9,17,32,.05)] transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="relative aspect-[16/11] overflow-hidden bg-litus-paper-3"
                             @if (! empty($showroom['images'])) data-showroom-slider data-interval="4000" @endif>
                            @if (! empty($showroom['images']))
                                @foreach ($showroom['images'] as $index => $image)
                                    <img src="{{ $image }}"
                                         alt="{{ $showroom['name'] }}"
                                         data-showroom-slide
                                         @class([
                                             'absolute inset-0 h-full w-full object-cover transition-opacity duration-700',
                                             'z-[1] opacity-100' => $index === 0,
                                             'z-0 opacity-0' => $index !== 0,
                                         ])
                                         loading="lazy">
                                @endforeach
                                <div class="absolute bottom-2.5 left-1/2 z-[2] flex -translate-x-1/2 gap-1.5">
                                    @foreach ($showroom['images'] as $index => $image)
                                        <span data-showroom-dot
                                              @class([
                                                  'h-1.5 rounded-full bg-white/50 transition-all duration-300',
                                                  'w-5 bg-white' => $index === 0,
                                                  'w-1.5' => $index !== 0,
                                              ])></span>
                                    @endforeach
                                </div>
                            @elseif ($coverImage)
                                <img src="{{ $coverImage }}"
                                     alt="{{ $showroom['name'] }}"
                                     class="h-full w-full object-cover"
                                     loading="lazy">
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col px-[22px] py-5">
                            <div class="mb-3 grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-litus-paper-3 text-litus-primary">
                                <x-litus-icon name="map-pin" class="h-4 w-4" />
                            </div>
                            <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $showroom['name'] }}</h4>
                            <p class="mb-3.5 text-[14.5px] leading-relaxed text-litus-text-2">{{ $showroom['address'] }}</p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                @foreach ($showroom['services'] as $service)
                                    <span class="rounded-full bg-litus-paper-3 px-3 py-1.5 text-[12.5px] font-semibold text-litus-text-2">{{ $service }}</span>
                                @endforeach
                            </div>
                            <a href="tel:{{ preg_replace('/\s+/', '', $showroom['phone']) }}"
                               class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-4 py-3 text-[13.5px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary">
                                <x-litus-icon name="phone" class="h-4 w-4" />
                                {{ $showroom['phone'] }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section id="gallery" class="litus-sec scroll-mt-24">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">LITUS Gallery</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Ride the visual journey</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Our collection of motorcycles, showroom moments, customer experiences and lifestyle photos.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($galleryTiles as $index => $tile)
                    <div @class([
                        'relative overflow-hidden rounded-[14px] bg-litus-paper-3',
                        'aspect-[16/10] md:col-span-2 md:row-span-2 md:aspect-auto md:min-h-[320px]' => $index === 0,
                        'aspect-square' => $index !== 0,
                    ])>
                        <img src="{{ $tile['img'] }}"
                             alt="{{ $tile['label'] }}"
                             class="h-full w-full object-cover"
                             loading="lazy">
                        <span class="absolute bottom-2.5 left-3 rounded-md bg-black/45 px-2 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-white/90">
                            {{ $tile['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="mt-9 text-center">
                <a href="{{ route('gallery') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Open Full Gallery
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Looking for the nearest LITUS showroom?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our team is ready to help you find the right motorcycle, parts, or service support.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Contact Us
                </a>
                <a href="#locations"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    View Locations
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
