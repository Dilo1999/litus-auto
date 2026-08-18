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

    $heroFeatures = [
        ['icon' => 'clock', 'title' => 'Est. 2014', 'desc' => 'Twelve years in the Maldives'],
        ['icon' => 'map-pin', 'title' => $showroomCount.' Showrooms', 'desc' => 'Across the Maldives'],
        ['icon' => 'users', 'title' => 'Thousands of riders', 'desc' => 'Served since we opened'],
        ['icon' => 'shield', 'title' => 'Genuine Units', 'desc' => 'Honda & Yamaha, factory-built'],
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

    {{-- HERO — desktop --}}
    <section class="relative hidden overflow-hidden bg-litus-ink text-white min-[961px]:block">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)]"></div>
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
                <div class="litus-cta-row mt-6">
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
            <div class="litus-container grid grid-cols-2 gap-4 py-[22px] lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroFeatures as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div>
                            <b class="block text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
                            <span class="block text-[12.5px] leading-snug text-white/60">{{ $item['desc'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HERO — mobile --}}
    <section class="relative overflow-hidden bg-litus-ink text-white min-[961px]:hidden">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_20%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.18]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px;"></div>

        <div class="relative z-[3] flex flex-col">
            <div class="litus-container pt-12 pb-4">
                <div class="max-w-[36rem]">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">About LITUS Automobiles</span>
                    <h1 class="max-w-[16ch] font-display text-[clamp(1.85rem,7.2vw,2.25rem)] font-extrabold leading-[1.1] tracking-[-0.032em]">
                        Driven by trust. <span class="text-litus-sky">Built for every ride.</span>
                    </h1>
                    <p class="mt-3 line-clamp-4 max-w-[38ch] text-[14px] leading-[1.62] text-white/[0.72]">
                        Since 2014, a leading motorcycle supplier in the Maldives with quality products and after-sales service people come back for.
                    </p>
                </div>
            </div>

            <div class="litus-container pb-4">
                <div class="flex flex-row gap-2">
                    <a href="#who-we-are"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:bg-litus-primary-hover">
                        Our Story
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border-[1.5px] border-white/32 px-3 text-[13px] font-semibold text-white transition hover:border-white hover:bg-white/10">
                        Contact
                    </a>
                </div>
            </div>

            <x-litus-hero-features :features="$heroFeatures" />
        </div>
    </section>

    {{-- WHO WE ARE --}}
    <section id="who-we-are" class="litus-sec scroll-mt-24 max-md:!py-12">
        <div class="litus-container grid grid-cols-1 gap-8 min-[1000px]:grid-cols-[1.3fr_0.7fr] min-[1000px]:gap-14">
            <div>
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Who We Are</span>
                <h2 class="mb-5 font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text sm:mb-6">
                    Twelve years of getting Maldivians riding
                </h2>
                <div class="max-w-[720px] text-[15px] leading-[1.72] text-[#26324A] sm:text-[16.5px] sm:leading-[1.78]">
                    <p class="mb-[17px]">
                        <strong class="font-semibold text-litus-text">LITUS Automobiles started in 2014 with a straightforward observation: plenty of people in the Maldives needed a motorcycle and could afford one monthly, but almost nobody was making that easy.</strong>
                    </p>
                    <p class="mb-[17px]">
                        Buying a scooter outright means finding sixty thousand rufiyaa at once. For most working people that is not a realistic ask, and the alternatives available at the time were either unaffordable or structurally uncomfortable for customers who wanted a Shariah-compliant arrangement. So we built our ownership plans around Islamic leasing standards and named them Ijara Plans - a fixed lease price, agreed in writing at the start, paid monthly, with ownership transferring at the end.
                    </p>
                    <p class="mb-[17px]">
                        That decision shaped the company. Today the majority of the motorcycles leaving our showrooms leave on an Ijara plan, and we have built six variants of it so that a salaried employee in Malé, a fisherman in Laamu and a first-time rider with a family guarantor can each find a structure that works.
                    </p>

                    <h3 class="mb-3 mt-6 font-display text-[19px] font-bold tracking-[-0.028em] text-litus-text sm:mt-8 sm:text-[23px]">Why we opened across the atolls</h3>
                    <p class="mb-[17px]">
                        We could have stayed in Malé. Most dealerships do. But a rider in Fuvahmulah or Addu needs the same access to genuine parts and a trained technician as someone in the capital, and shipping a scooter back to Malé for a service is not a serious answer. So we opened showrooms in Hithadhoo, Fuvahmulah and L. Fonadhoo, with full service facilities where the volume justifies them.
                    </p>

                    <h3 class="mb-3 mt-6 font-display text-[19px] font-bold tracking-[-0.028em] text-litus-text sm:mt-8 sm:text-[23px]">What we sell, and how we stand behind it</h3>
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
                <div class="rounded-2xl border border-litus-line bg-white p-5 shadow-[0_2px_8px_rgba(9,17,32,0.06)] sm:rounded-[26px] sm:p-7 sm:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                    <h4 class="mb-4 font-display text-[clamp(18px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text sm:mb-[18px]">Our journey</h4>
                    <div class="relative pl-7 before:absolute before:bottom-1.5 before:left-[7px] before:top-1.5 before:w-0.5 before:bg-litus-line before:content-[''] sm:pl-[34px] sm:before:left-[9px]">
                        @foreach ($timeline as $item)
                            <div class="relative pb-6 last:pb-0 sm:pb-[30px] before:absolute before:-left-[22px] before:top-[5px] before:h-3 before:w-3 before:rounded-full before:border-[3px] before:border-white before:bg-litus-primary before:shadow-[0_0_0_2px_rgba(18,87,214,0.2)] before:content-[''] sm:before:-left-[30px] sm:before:h-3.5 sm:before:w-3.5">
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
    <section id="mission-vision" class="litus-sec scroll-mt-24 bg-litus-paper-2 max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Mission & Vision</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">What we are here to do</h2>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="5000"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden min-[900px]:grid-cols-2">
                    @foreach ($missionVision as $item)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="group h-full rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-8 sm:py-9 sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mb-3 grid h-10 w-10 place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)] sm:mb-5 sm:h-[42px] sm:w-[42px]">
                                    <x-litus-icon :name="$item['icon']" class="h-4 w-4 sm:h-5 sm:w-5" />
                                </div>
                                <h4 class="mb-2 font-display text-[18px] font-semibold tracking-[-0.02em] text-litus-text sm:mb-2.5 sm:text-[clamp(20px,2.2vw,26px)]">{{ $item['title'] }}</h4>
                                <p class="text-[14px] leading-relaxed text-litus-text-2 sm:text-[15.5px]">{{ $item['text'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($missionVision) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($missionVision as $index => $item)
                            <span @class([
                                'h-1.5 rounded-full transition-all duration-300',
                                'w-5 bg-litus-primary' => $index === 0,
                                'w-1.5 bg-litus-line-2' => $index !== 0,
                            ])
                                  data-home-card-dot></span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- LEADERSHIP --}}
    <section class="litus-sec max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Leadership Team</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">The people running LITUS</h2>
            </div>

            <div data-home-card-slider-wrap class="mb-8 sm:mb-12">
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden md:grid-cols-3">
                    @foreach ($teamLeaders as $member)
                        <div data-home-card-slide class="max-md:w-[min(88%,300px)] max-md:shrink-0 max-md:snap-center">
                            <article class="h-full overflow-hidden rounded-2xl border border-litus-line bg-white text-center shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="aspect-[4/3] overflow-hidden bg-litus-paper-3">
                                    <img src="{{ $member['img'] }}"
                                         alt="{{ $member['name'] }}"
                                         class="h-full w-full object-cover object-top"
                                         loading="lazy">
                                </div>
                                <div class="px-4 pb-5 pt-4 sm:px-5 sm:pb-7 sm:pt-[22px]">
                                    <h4 class="font-display text-[18px] font-semibold tracking-[-0.02em] text-litus-text sm:text-[clamp(20px,2.2vw,24px)]">{{ $member['name'] }}</h4>
                                    <p class="mt-1.5 text-[13px] font-semibold text-litus-primary sm:text-sm">{{ $member['role'] }}</p>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($teamLeaders) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($teamLeaders as $index => $member)
                            <span @class([
                                'h-1.5 rounded-full transition-all duration-300',
                                'w-5 bg-litus-primary' => $index === 0,
                                'w-1.5 bg-litus-line-2' => $index !== 0,
                            ])
                                  data-home-card-dot></span>
                        @endforeach
                    </div>
                @endif
            </div>

            <h3 class="mb-5 text-center font-display text-[clamp(18px,4vw,26px)] font-semibold tracking-[-0.02em] text-litus-text sm:mb-6">Management &amp; Departments</h3>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-2 gap-3 max-md:-mx-4 max-md:flex max-md:gap-3 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden md:grid-cols-4 md:gap-6">
                    @foreach ($teamMembers as $member)
                        <div data-home-card-slide class="max-md:w-[min(72%,240px)] max-md:shrink-0 max-md:snap-center">
                            <article class="h-full rounded-2xl border border-litus-line bg-white px-3 py-4 text-center shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-5 sm:py-6 sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mx-auto mb-3 h-14 w-14 overflow-hidden rounded-full bg-litus-paper-3 sm:mb-3.5 sm:h-16 sm:w-16 md:h-[72px] md:w-[72px] lg:h-[84px] lg:w-[84px]">
                                    <img src="{{ $member['img'] }}"
                                         alt="{{ $member['name'] }}"
                                         class="h-full w-full object-cover object-top"
                                         loading="lazy">
                                </div>
                                <b class="mb-1 block text-[13px] text-litus-text sm:text-[15px]">{{ $member['name'] }}</b>
                                <span class="mb-1 block text-[11.5px] font-semibold leading-snug text-litus-primary sm:mb-1.5 sm:text-sm">{{ $member['role'] }}</span>
                                <span class="block text-[10.5px] leading-snug text-litus-text-3 sm:text-[11.5px]">{{ $member['dept'] }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($teamMembers) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($teamMembers as $index => $member)
                            <span @class([
                                'h-1.5 rounded-full transition-all duration-300',
                                'w-5 bg-litus-primary' => $index === 0,
                                'w-1.5 bg-litus-line-2' => $index !== 0,
                            ])
                                  data-home-card-dot></span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- LOCATIONS --}}
    <section id="locations" class="litus-sec scroll-mt-24 bg-litus-paper-2 max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Our Locations</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Showrooms and service centres</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Visit our showrooms and service centres across the Maldives for motorcycles, genuine parts and trusted support.
                </p>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($showrooms as $showroom)
                        @php
                            $coverImage = $showroom['images'][0] ?? ($showroom['img'] ?? null);
                        @endphp
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-litus-line bg-white shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
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
                        <div class="flex flex-1 flex-col px-4 py-4 sm:px-[22px] sm:py-5">
                            <div class="mb-2.5 grid h-9 w-9 place-items-center rounded-[10px] bg-litus-paper-3 text-litus-primary sm:mb-3 sm:h-[38px] sm:w-[38px]">
                                <x-litus-icon name="map-pin" class="h-4 w-4" />
                            </div>
                            <h4 class="mb-2 text-[16px] font-bold text-litus-text sm:text-lg">{{ $showroom['name'] }}</h4>
                            <p class="mb-3 text-[14px] leading-relaxed text-litus-text-2 sm:mb-3.5 sm:text-[14.5px]">{{ $showroom['address'] }}</p>
                            <div class="mb-3 flex flex-wrap gap-1.5 sm:mb-4 sm:gap-2">
                                @foreach ($showroom['services'] as $service)
                                    <span class="rounded-full bg-litus-paper-3 px-2.5 py-1 text-[11.5px] font-semibold text-litus-text-2 sm:px-3 sm:py-1.5 sm:text-[12.5px]">{{ $service }}</span>
                                @endforeach
                            </div>
                            <a href="tel:{{ preg_replace('/\s+/', '', $showroom['phone']) }}"
                               class="mt-auto inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-4 py-3 text-[13px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary sm:text-[13.5px]">
                                <x-litus-icon name="phone" class="h-4 w-4" />
                                {{ $showroom['phone'] }}
                            </a>
                        </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if ($showroomCount > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($showrooms as $index => $showroom)
                            <span @class([
                                'h-1.5 rounded-full transition-all duration-300',
                                'w-5 bg-litus-primary' => $index === 0,
                                'w-1.5 bg-litus-line-2' => $index !== 0,
                            ])
                                  data-home-card-dot></span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section id="gallery" class="litus-sec scroll-mt-24 max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">LITUS Gallery</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Ride the visual journey</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Our collection of motorcycles, showroom moments, customer experiences and lifestyle photos.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-2.5 sm:gap-4 md:grid-cols-4">
                @foreach ($galleryTiles as $index => $tile)
                    <div @class([
                        'relative overflow-hidden rounded-xl bg-litus-paper-3 sm:rounded-[14px]',
                        'col-span-2 aspect-[16/9] sm:aspect-[16/10] md:col-span-2 md:row-span-2 md:aspect-auto md:min-h-[320px]' => $index === 0,
                        'aspect-square' => $index !== 0,
                    ])>
                        <img src="{{ $tile['img'] }}"
                             alt="{{ $tile['label'] }}"
                             class="h-full w-full object-cover"
                             loading="lazy">
                        <span class="absolute bottom-2 left-2.5 rounded-md bg-black/45 px-1.5 py-0.5 text-[9px] font-semibold uppercase tracking-[0.12em] text-white/90 sm:bottom-2.5 sm:left-3 sm:px-2 sm:py-1 sm:text-[10px]">
                            {{ $tile['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-center sm:mt-9">
                <a href="{{ route('gallery') }}"
                   class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:px-8 sm:py-[17px] sm:text-[15.5px]">
                    Open Full Gallery
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white max-md:hidden">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Looking for the nearest LITUS showroom?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our team is ready to help you find the right motorcycle, parts, or service support.
                </p>
            </div>
            <div class="litus-cta-row">
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
