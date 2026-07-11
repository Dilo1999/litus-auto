@extends('layouts.litus')

@section('title', 'LITUS Automobiles — Premium Motorcycles in the Maldives')

@section('content')
@php
    $topRides = $topRides ?? [];

    $galleryImages = $galleryImages ?? [];

    $services = [
        [
            'title' => 'Application Made Easy',
            'icon' => 'check-circle',
            'img' => asset('images/homepage/' . rawurlencode('Application Made Easy.webp')),
            'text' => 'LITUS Automobiles simplifies the process of leasing a motorcycle by eliminating bureaucracy. A simple ID card is required for verification and applications can be made via social media platforms. Customers can choose from upfront or installment options.',
        ],
        [
            'title' => 'Genuine Parts',
            'icon' => 'package',
            'img' => asset('images/homepage/' . rawurlencode('Genuine Parts.webp')),
            'text' => 'LITUS Automobiles provides genuine parts to take care of your beloved motorbike for durability and performance quality. Visit our Service Center for professional service.',
        ],
        [
            'title' => 'Reliable Service',
            'icon' => 'wrench',
            'img' => asset('images/homepage/' . rawurlencode('Reliable Service.webp')),
            'text' => 'LITUS Automobiles provides dependable motorcycle servicing at our Service Centers staffed with experienced mechanics and state-of-the-art tools and equipment. Our team aims to offer premium and reliable service to all customers.',
        ],
    ];

    $features = [
        ['icon' => 'package', 'label' => 'Genuine Parts', 'desc' => '100% authentic & quality assured'],
        ['icon' => 'check-circle', 'label' => 'Easy Applications', 'desc' => 'Simple process, minimal documentation'],
        ['icon' => 'wrench', 'label' => 'Reliable Service', 'desc' => 'Expert mechanics, trusted support'],
        ['icon' => 'star', 'label' => 'Flexible Plans', 'desc' => 'Ownership options for everyone'],
    ];

    $heroBg = asset('images/homepage/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_22_48 PM.png'));
@endphp

<div class="font-sans">

    <x-litus-header active="Home" />

    {{-- HERO --}}
    <section class="relative min-h-[640px] overflow-hidden max-md:min-h-0 lg:min-h-[720px]">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-center max-md:object-[center_30%]"
             aria-hidden="true">
        <div class="absolute inset-0 bg-[linear-gradient(110deg,rgba(0,65,180,0.55)_0%,rgba(11,22,40,0.85)_40%,rgba(11,22,40,0.45)_70%,rgba(11,22,40,0.2)_100%)] max-md:bg-[linear-gradient(180deg,rgba(11,22,40,0.55)_0%,rgba(11,22,40,0.78)_42%,rgba(11,22,40,0.92)_100%)]"></div>

        <div class="relative z-10 litus-container flex min-h-[640px] flex-col justify-center max-md:min-h-0 max-md:justify-end lg:min-h-[720px]">
            <div class="max-w-xl py-16 text-left max-md:pb-8 max-md:pt-24 lg:py-20">
                <p class="mb-4 text-sm font-bold uppercase tracking-widest text-litus-red max-md:mb-3 max-md:text-[11px] max-md:tracking-[0.18em] sm:text-base">Premium Bikes. Trusted Service.</p>
                <h1 class="mb-6 font-display text-[2.9rem] font-black leading-[1.08] text-white max-md:mb-4 max-md:text-[2.35rem] max-md:leading-[1.05] sm:text-[3.25rem] lg:text-[3.85rem]">
                    Ride Your Dream<br class="hidden sm:inline"><span class="sm:hidden"> </span>with<br>
                    <span class="text-litus-red">LITUS Automobiles</span>
                </h1>
                <p class="mb-9 max-w-md text-base leading-relaxed text-gray-300 max-md:mb-6 max-md:text-[15px] max-md:leading-snug lg:text-lg">
                    Discover premium motorcycles, flexible ownership plans, genuine parts, and trusted service across the Maldives.
                </p>
                <div class="flex flex-col justify-start gap-3 max-md:gap-2.5 sm:flex-row sm:gap-4">
                    <a href="{{ route('motorcycles') }}"
                       class="flex min-h-12 items-center justify-center gap-2 rounded-md bg-litus-red px-7 py-3.5 text-base font-bold text-white transition-opacity hover:opacity-90 max-md:w-full max-md:text-[15px]">
                        Explore Motorcycles
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ route('ownership-plans') }}"
                       class="flex min-h-12 items-center justify-center rounded-md border border-white/30 px-7 py-3.5 text-center text-base font-bold text-white transition-all hover:border-white/60 hover:bg-white/5 max-md:w-full max-md:border-white/40 max-md:bg-white/5 max-md:text-[15px]">
                        View Ownership Plans
                    </a>
                </div>
            </div>
        </div>

        {{-- Feature bar --}}
        <div class="relative z-10 border-t border-white/10 bg-black/35 backdrop-blur-sm max-md:bg-black/50">
            <div class="litus-container">
                <div class="grid min-h-[120px] grid-cols-1 items-center max-md:min-h-0 max-md:grid-cols-2 max-md:gap-0 min-[701px]:grid-cols-2 min-[1100px]:min-h-[130px] min-[1100px]:grid-cols-4">
                    @foreach ($features as $index => $feature)
                        <div @class([
                            'flex items-center gap-3.5 py-8 sm:gap-4 sm:py-9 lg:py-10',
                            'max-md:gap-2.5 max-md:px-1 max-md:py-4',
                            'border-b border-white/10 max-md:border-b' => $index < count($features) - 1,
                            'max-md:last:border-b-0',
                            'max-md:border-r max-md:border-white/10' => in_array($index, [0, 2]),
                            'max-md:border-b-0' => in_array($index, [2, 3]),
                            'min-[1100px]:border-r min-[1100px]:border-white/10 min-[1100px]:pr-6' => $index < count($features) - 1,
                            'min-[1100px]:pl-0' => $index === 0,
                            'min-[1100px]:pl-6' => $index > 0,
                            'max-[1100px]:min-[701px]:border-r max-[1100px]:min-[701px]:border-white/10' => in_array($index, [0, 2]),
                            'max-[1100px]:min-[701px]:border-b max-[1100px]:min-[701px]:border-white/10' => in_array($index, [0, 1]),
                            'max-[1100px]:min-[701px]:border-r-0' => $index === 1,
                        ])>
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-litus-red/25 bg-litus-red/15 max-md:h-10 max-md:w-10 sm:h-[52px] sm:w-[52px]">
                                <x-litus-icon :name="$feature['icon']" class="h-5 w-5 text-litus-red max-md:h-4 max-md:w-4 sm:h-[22px] sm:w-[22px]" />
                            </div>
                            <div class="min-w-0 text-left">
                                <p class="text-sm font-bold leading-tight text-white max-md:text-[12px] sm:text-[15px]">{{ $feature['label'] }}</p>
                                <p class="mt-1 text-xs leading-snug text-gray-400 max-md:mt-0.5 max-md:line-clamp-2 max-md:text-[10px] sm:text-[13px]">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ONGOING PROMOTIONS --}}
    <section class="relative overflow-hidden border border-[#dfe3ea] bg-[#f7f8fa] py-[38px] pb-7 max-md:border-0 max-md:py-8 max-md:pb-8 max-sm:py-7 min-[651px]:bg-white">
        <div class="pointer-events-none absolute inset-0 hidden opacity-100 min-[651px]:block"
             style="background: linear-gradient(rgba(255,255,255,0.94), rgba(255,255,255,0.94)), radial-gradient(circle at 10% 20%, rgba(6,21,48,0.08), transparent 25%);"></div>
        <div class="pointer-events-none absolute inset-0 hidden opacity-40 min-[651px]:block"
             style="background-image: linear-gradient(30deg, rgba(6,21,48,0.035) 12%, transparent 12.5%, transparent 87%, rgba(6,21,48,0.035) 87.5%, rgba(6,21,48,0.035)), linear-gradient(150deg, rgba(6,21,48,0.035) 12%, transparent 12.5%, transparent 87%, rgba(6,21,48,0.035) 87.5%, rgba(6,21,48,0.035)); background-size: 55px 95px;"></div>

        <div class="relative z-[2] litus-container max-md:!px-0">
            <div class="mb-9 flex flex-col items-start justify-between gap-5 max-md:mb-5 max-md:gap-3 max-md:px-4 min-[651px]:mb-[35px] min-[651px]:flex-row min-[651px]:gap-5">
                <div class="max-md:w-full">
                    <div class="mb-2 flex items-center justify-between gap-3 max-md:mb-1.5">
                        <span class="block text-sm font-black uppercase tracking-wide text-[#0065ef] max-md:text-[11px] max-md:tracking-[0.14em]">Special Deals</span>
                        <a href="{{ route('motorcycles') }}"
                           class="hidden items-center gap-1.5 text-[12px] font-black text-[#0065ef] max-md:inline-flex">
                            View all
                            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                    <h2 class="mb-3.5 text-[30px] font-black leading-tight tracking-[-0.5px] text-[#07152f] max-md:mb-1.5 max-md:text-[24px] min-[651px]:text-4xl">Ongoing Promotions</h2>
                    <p class="text-[15px] font-semibold text-[#424c5e] max-md:max-w-[32ch] max-md:text-[13px] max-md:leading-snug">Limited-time deals on selected motorcycles and scooters.</p>
                </div>
                <a href="{{ route('motorcycles') }}"
                   class="group/viewall inline-flex min-h-11 items-center gap-2.5 text-[15px] font-black text-[#07152f] transition-all duration-300 hover:gap-4 hover:text-[#0065ef] max-md:hidden min-[651px]:mt-[58px]">
                    View All Promotions
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="relative min-[1101px]:px-[42px]">
                <button type="button"
                        class="absolute left-0 top-1/2 z-[5] hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white text-3xl leading-none text-[#07152f] shadow-[0_10px_24px_rgba(0,0,0,0.12)] transition-colors duration-300 hover:bg-[#0065ef] hover:text-white min-[1101px]:flex"
                        aria-label="Previous promotions">
                    <x-litus-icon name="chevron-left" class="h-6 w-6" />
                </button>
                <button type="button"
                        class="absolute right-0 top-1/2 z-[5] hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white text-3xl leading-none text-[#07152f] shadow-[0_10px_24px_rgba(0,0,0,0.12)] transition-colors duration-300 hover:bg-[#0065ef] hover:text-white min-[1101px]:flex"
                        aria-label="Next promotions">
                    <x-litus-icon name="chevron-right" class="h-6 w-6" />
                </button>

                <div class="grid grid-cols-1 gap-x-7 gap-y-6 max-[650px]:flex max-[650px]:snap-x max-[650px]:snap-mandatory max-[650px]:gap-3.5 max-[650px]:overflow-x-auto max-[650px]:scroll-smooth max-[650px]:px-4 max-[650px]:pb-1 max-[650px]:[scrollbar-width:none] max-[650px]:[&::-webkit-scrollbar]:hidden min-[651px]:grid-cols-2 min-[1101px]:grid-cols-4"
                     data-promo-slider>
                    @forelse ($promoMotorcycles as $motorcycle)
                        <div class="max-[650px]:w-[86%] max-[650px]:shrink-0 max-[650px]:snap-center min-[651px]:contents">
                            <x-card.promotion-card :motorcycle="$motorcycle" />
                        </div>
                    @empty
                        <div class="col-span-full rounded-[10px] border border-dashed border-[#dfe3ea] bg-white/80 px-6 py-12 text-center max-[650px]:mx-4 max-[650px]:w-auto">
                            <p class="font-semibold text-[#424c5e]">No active promotions at the moment.</p>
                            <p class="mt-1 text-sm text-[#667085]">Check back soon or browse our full motorcycle range.</p>
                        </div>
                    @endforelse
                </div>

                @if ($promoMotorcycles->isNotEmpty())
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-[650px]:flex" aria-hidden="true">
                        @foreach ($promoMotorcycles as $index => $motorcycle)
                            <span @class([
                                'h-1.5 rounded-full transition-all',
                                'w-5 bg-[#0065ef]' => $index === 0,
                                'w-1.5 bg-[#c5ccd6]' => $index !== 0,
                            ])></span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- TOP SELLING RIDES --}}
    <section class="border border-white/[0.08] py-[42px] pb-[50px] max-[720px]:py-8 max-[720px]:pb-10"
             style="background: radial-gradient(circle at top left, rgba(14,61,111,0.35), transparent 35%), radial-gradient(circle at bottom right, rgba(14,61,111,0.25), transparent 35%), linear-gradient(135deg, #061326 0%, #071a33 45%, #061326 100%);">
        <div class="litus-container">

            <div class="mb-[30px] flex flex-col items-start justify-between gap-5 max-[720px]:mb-6 max-[720px]:gap-3 min-[721px]:flex-row max-[1100px]:gap-5">
                <div>
                    <span class="mb-2 block text-[15px] font-black uppercase tracking-wide text-[#0065ef] max-[720px]:mb-1.5 max-[720px]:text-[11px] max-[720px]:tracking-[0.14em]">Customer Favorites</span>
                    <h2 class="mb-3 text-[32px] font-black leading-tight tracking-[-0.5px] text-white max-[720px]:mb-2 max-[720px]:text-[26px] min-[721px]:text-[42px]">Top Selling Rides</h2>
                    <p class="text-base font-semibold text-[#d6dee9] max-[720px]:text-sm">Explore our most popular motorcycles and scooters.</p>
                </div>
                <a href="{{ route('motorcycles') }}"
                   class="group/viewall inline-flex min-h-11 items-center gap-2.5 text-base font-black text-[#0065ef] transition-all duration-300 hover:gap-4 hover:text-white min-[721px]:mt-[55px]">
                    View All Rides
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="grid grid-cols-1 gap-[22px] max-[720px]:gap-4 min-[721px]:gap-[38px] min-[1101px]:grid-cols-3 max-[1100px]:min-[721px]:grid-cols-2">
                @foreach ($topRides as $ride)
                    <x-card.litus-ride-card
                        :model="$ride['model']"
                        :slug="$ride['slug']"
                        :cc="$ride['cc']"
                        :capacity="$ride['capacity']"
                        :img="$ride['img']"
                        :variant="$ride['variant']"
                        :badge="$ride['badge']"
                    />
                @endforeach
            </div>

        </div>
    </section>

    {{-- WHAT'S NEW + WHAT WE OFFER --}}
    <section class="border border-[#dfe3ea] bg-[#f8f9fb]">

        {{-- Updates --}}
        <div class="relative overflow-hidden py-12 max-md:py-9 sm:py-16 lg:py-20"
             style="background-image: radial-gradient(circle, rgba(7, 21, 47, 0.10) 2px, transparent 2px); background-size: 24px 24px; background-color: #fafafa;">
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(250,250,250,0.95)_0%,rgba(250,250,250,0.78)_25%,rgba(250,250,250,0.55)_50%,rgba(250,250,250,0.88)_100%)]"></div>

            <div class="relative z-[2] litus-container grid grid-cols-1 items-center justify-between gap-10 max-md:gap-6 max-[950px]:text-center min-[951px]:grid-cols-[38%_52%] min-[951px]:gap-10">
                <div>
                    <span class="mb-2 block text-[13px] font-black uppercase tracking-wide text-[#0065ef] max-md:text-[11px] max-md:tracking-[0.14em]">Stay Updated</span>
                    <h2 class="mb-[18px] text-[34px] font-black leading-tight tracking-[-1px] text-[#07152f] max-md:mb-3 max-md:text-[26px] min-[601px]:text-[42px]">What's New?</h2>
                    <p class="mb-7 max-w-[360px] text-[15px] font-semibold leading-snug text-[#384354] max-md:mb-5 max-md:text-sm max-[950px]:mx-auto">
                        Stay updated with the latest launches, offers, and stories from LITUS Automobiles.
                    </p>
                    <a href="https://youtu.be/o8grf3wSwQU"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-12 min-w-[190px] items-center justify-center gap-3 rounded-md bg-[#0065ef] px-6 text-sm font-black text-white shadow-[0_8px_20px_rgba(0,101,239,0.25)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:w-full max-md:max-w-[320px]">
                        Watch Latest Updates
                        <x-litus-icon name="play" class="h-3.5 w-3.5" />
                    </a>
                </div>

                <div class="relative mx-auto w-full max-w-[700px] overflow-hidden rounded-[9px] border border-black/15 bg-[#101722] shadow-[0_12px_32px_rgba(0,0,0,0.22)] max-md:rounded-xl min-[951px]:mx-0 min-[951px]:max-w-none">
                    <div class="relative aspect-video w-full">
                        <iframe title="LITUS Automobiles – Latest Launches &amp; Offers"
                                src="https://www.youtube.com/embed/o8grf3wSwQU"
                                class="absolute inset-0 h-full w-full border-0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen
                                loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        {{-- Services --}}
        <div class="relative overflow-hidden border-t border-[#e3e6eb] py-10 max-md:py-8 sm:py-12 lg:py-14"
             style="background: radial-gradient(circle at left 25%, rgba(0,101,239,0.06), transparent 22%), radial-gradient(circle at right 72%, rgba(0,101,239,0.05), transparent 22%), linear-gradient(135deg, #ffffff 0%, #f6f9fd 55%, #ffffff 100%);">
            <div class="pointer-events-none absolute left-0 top-28 h-[180px] w-[140px] opacity-40 max-md:hidden"
                 style="background-image: radial-gradient(rgba(0,101,239,0.18) 2px, transparent 2px); background-size: 18px 18px;"></div>
            <div class="pointer-events-none absolute -right-[100px] bottom-6 h-[240px] w-[240px] max-md:hidden"
                 style="background: linear-gradient(135deg, transparent 0 35%, rgba(7,21,47,0.035) 35% 47%, transparent 47%), linear-gradient(135deg, transparent 0 55%, rgba(7,21,47,0.035) 55% 68%, transparent 68%);"></div>

            <div class="relative z-[2] litus-container">
                <div class="mb-7 text-center max-md:mb-5 min-[651px]:mb-8">
                    <div class="mb-2.5 inline-flex items-center gap-3 text-[11px] font-black uppercase tracking-[0.24em] text-[#0065ef] min-[651px]:gap-4 min-[651px]:text-xs min-[651px]:tracking-[0.28em]">
                        <span class="inline-block h-0.5 w-3 bg-[#0065ef] min-[651px]:w-6"></span>
                        Our Services
                        <span class="inline-block h-0.5 w-3 bg-[#0065ef] min-[651px]:w-6"></span>
                    </div>
                    <h2 class="mb-2 text-[28px] font-black leading-tight tracking-[-0.6px] text-[#07152f] max-md:text-[26px] min-[651px]:text-[34px]">
                        What We Offer at LITUS
                    </h2>
                    <p class="mx-auto max-w-[640px] text-sm font-medium leading-normal text-[#667085] max-md:px-1 min-[651px]:text-[15px]">
                        Quality service, genuine parts, and customer satisfaction — that’s the LITUS promise.
                    </p>
                </div>

                <div class="mx-auto grid max-w-[560px] grid-cols-1 gap-5 max-md:-mx-4 max-md:flex max-md:max-w-none max-md:snap-x max-md:snap-mandatory max-md:gap-4 max-md:overflow-x-auto max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden min-[1101px]:max-w-none min-[1101px]:grid-cols-3">
                    @foreach ($services as $service)
                        <article class="group relative overflow-hidden rounded-xl border border-[rgba(7,21,47,0.05)] bg-white shadow-[0_12px_28px_rgba(7,21,47,0.07)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_40px_rgba(7,21,47,0.11)] max-md:w-[88%] max-md:shrink-0 max-md:snap-center max-md:rounded-2xl min-[1101px]:min-h-[520px]">
                            <div class="relative">
                                <div class="relative h-[200px] overflow-hidden bg-[#dce3ed] max-md:h-[210px] max-[650px]:h-[210px] min-[651px]:h-[230px] max-md:min-[651px]:h-[210px]">
                                    <img src="{{ $service['img'] }}"
                                         alt="{{ $service['title'] }}"
                                         class="block h-full w-full object-cover transition-transform duration-[450ms] ease-out group-hover:scale-105"
                                         loading="lazy">
                                </div>
                                <div class="pointer-events-none absolute -bottom-10 -left-[10%] -right-[10%] z-[2] h-[88px] rounded-t-[50%] bg-white max-md:-bottom-9 max-md:h-[80px] max-[650px]:-bottom-9 max-[650px]:h-[80px]"></div>
                            </div>

                            <div class="absolute left-1/2 top-[168px] z-[5] flex h-[64px] w-[64px] -translate-x-1/2 items-center justify-center rounded-full bg-white text-[#0065ef] shadow-[0_10px_22px_rgba(7,21,47,0.12)] max-md:top-[178px] max-md:h-[64px] max-md:w-[64px] max-[650px]:top-[178px] max-[650px]:h-[64px] max-[650px]:w-[64px] min-[651px]:top-[196px] min-[651px]:h-[70px] min-[651px]:w-[70px] max-md:min-[651px]:top-[178px] max-md:min-[651px]:h-[64px] max-md:min-[651px]:w-[64px]">
                                <x-litus-icon :name="$service['icon']" class="h-8 w-8 max-md:h-8 max-md:w-8 max-[650px]:h-8 max-[650px]:w-8 min-[651px]:h-9 min-[651px]:w-9 max-md:min-[651px]:h-8 max-md:min-[651px]:w-8" />
                            </div>

                            <div class="relative z-[3] -mt-px bg-white px-5 pb-7 pt-14 text-center max-md:px-5 max-md:pb-6 max-md:pt-14 max-[650px]:px-5 max-[650px]:pb-6 max-[650px]:pt-14 min-[651px]:px-7 min-[651px]:pb-8 min-[651px]:pt-16 max-md:min-[651px]:px-5 max-md:min-[651px]:pb-6 max-md:min-[651px]:pt-14">
                                <h3 class="mb-2.5 text-lg font-black leading-tight text-[#07152f] max-md:mb-2.5 max-md:text-[18px] max-[650px]:mb-2.5 max-[650px]:text-[18px] min-[651px]:text-[20px] max-md:min-[651px]:mb-2.5 max-md:min-[651px]:text-[18px]">{{ $service['title'] }}</h3>
                                <div class="mx-auto mb-3.5 h-0.5 w-9 rounded-full bg-[#0065ef] max-md:mb-3.5 max-[650px]:mb-3.5"></div>
                                <p class="text-left text-[13px] font-medium leading-snug text-[#344054] max-md:line-clamp-5 max-md:text-center max-md:text-[13.5px] max-md:leading-relaxed max-[650px]:line-clamp-5 max-[650px]:text-center max-[650px]:text-[13.5px] min-[651px]:text-[13.5px] min-[651px]:leading-[1.55]">
                                    {{ $service['text'] }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <p class="mt-3 hidden text-center text-xs font-semibold text-[#8a94a6] max-md:block">Swipe for more services</p>
            </div>
        </div>

    </section>

    {{-- WHO WE ARE --}}
    <section class="relative flex min-h-[360px] items-center overflow-hidden border border-white/12 bg-cover bg-center max-[900px]:min-h-0 max-[900px]:bg-[linear-gradient(90deg,rgba(3,12,28,0.88),rgba(3,12,28,0.94)),url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1800&q=80')] max-[900px]:bg-cover max-[900px]:bg-center"
             style="background-image: linear-gradient(90deg, rgba(3,12,28,0.20) 0%, rgba(3,12,28,0.65) 36%, rgba(3,12,28,0.96) 68%, rgba(3,12,28,0.98) 100%), url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1800&q=80');">
        <div class="pointer-events-none absolute inset-0 z-[1] bg-[linear-gradient(90deg,rgba(3,12,28,0.08)_0%,rgba(3,12,28,0.35)_34%,rgba(3,12,28,0.88)_58%,rgba(3,12,28,0.96)_100%),radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.08),transparent_28%)] max-[900px]:bg-[linear-gradient(180deg,rgba(3,12,28,0.55)_0%,rgba(3,12,28,0.88)_45%,rgba(3,12,28,0.96)_100%)]"></div>

        <div class="relative z-[2] litus-container grid w-full grid-cols-1 items-center px-[7%] py-[55px] min-[901px]:grid-cols-[48%_52%] max-[600px]:px-4 max-[600px]:py-10 max-[900px]:px-5 max-[900px]:py-12">
            <div class="min-h-[250px] max-[900px]:hidden"></div>

            <div class="max-w-[720px] max-[900px]:max-w-full">
                <span class="mb-2 block text-[15px] font-black uppercase tracking-wide text-[#0065ef] max-md:text-[11px] max-md:tracking-[0.14em]">Our Story</span>
                <h2 class="mb-4 text-[34px] font-black leading-tight tracking-[-0.5px] text-white drop-shadow-[0_8px_20px_rgba(0,0,0,0.55)] max-md:mb-3 max-md:text-[28px] min-[601px]:text-[44px]">Who We Are</h2>
                <p class="mb-7 max-w-[690px] text-sm font-semibold leading-[1.7] text-[#e3e9f2] drop-shadow-[0_4px_14px_rgba(0,0,0,0.45)] max-md:mb-5 max-md:line-clamp-6 max-md:text-[13.5px] max-md:leading-relaxed min-[601px]:text-base min-[601px]:leading-[1.65]">
                    Established in 2014, LITUS Automobiles stands as the premier destination for motorcycles in the Maldives. As the largest motorcycle dealer, we specialize in the sale, lease, and service of top-notch motorcycles. Our commitment extends to providing genuine spare parts, ensuring every ride is a journey of excellence. At LITUS, we don't just sell motorcycles; we turn aspirations into reality and transform dreams of the open road into adventures that thrill. Join us and discover the joy of riding with LITUS Automobiles — where every adventure begins.
                </p>
                <a href="{{ route('about') }}"
                   class="inline-flex h-[52px] min-w-[200px] items-center justify-center gap-3.5 rounded-md bg-[#0065ef] px-7 text-[15px] font-black text-white shadow-[0_10px_26px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-[600px]:w-full">
                    Find Out More
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section class="relative overflow-hidden bg-[#f4f6f9] py-12 max-md:py-9 sm:py-16 lg:py-20"
             data-home-gallery>
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#0065ef]/35 to-transparent"></div>

        <div class="litus-container">
            <div class="mb-8 flex flex-col items-start justify-between gap-5 max-md:mb-5 max-md:gap-3 min-[651px]:mb-10 min-[651px]:flex-row min-[651px]:items-end">
                <div class="max-w-[560px]">
                    <span class="mb-1.5 block text-[13px] font-black uppercase tracking-[0.14em] text-[#0065ef] max-md:text-[11px]">Our Gallery</span>
                    <h2 class="mb-2.5 text-[30px] font-black leading-tight tracking-[-0.6px] text-[#07152f] max-md:mb-2 max-md:text-[26px] min-[651px]:text-[38px]">Ride the Visual Journey</h2>
                    <p class="text-sm font-semibold leading-normal text-[#4f5b6c] min-[651px]:text-[15px]">
                        Explore our collection of motorcycle rides and lifestyle moments.
                    </p>
                </div>
                <a href="{{ route('gallery') }}"
                   class="group/viewgallery inline-flex min-h-11 items-center gap-2.5 text-[15px] font-black text-[#07152f] transition-all duration-300 hover:gap-4 hover:text-[#0065ef] max-md:text-[#0065ef]">
                    View Gallery
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="relative">
                <button type="button"
                        data-home-gallery-prev
                        class="absolute -left-3 top-1/2 z-[5] hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-[#dfe3ea] bg-white text-[#07152f] shadow-[0_8px_20px_rgba(7,21,47,0.12)] transition-all duration-300 hover:border-[#0065ef] hover:bg-[#0065ef] hover:text-white min-[1101px]:-left-5 min-[1101px]:flex"
                        aria-label="Previous gallery images">
                    <x-litus-icon name="chevron-left" class="h-5 w-5" />
                </button>
                <button type="button"
                        data-home-gallery-next
                        class="absolute -right-3 top-1/2 z-[5] hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-[#dfe3ea] bg-white text-[#07152f] shadow-[0_8px_20px_rgba(7,21,47,0.12)] transition-all duration-300 hover:border-[#0065ef] hover:bg-[#0065ef] hover:text-white min-[1101px]:-right-5 min-[1101px]:flex"
                        aria-label="Next gallery images">
                    <x-litus-icon name="chevron-right" class="h-5 w-5" />
                </button>

                <div class="-mx-1 flex gap-3 overflow-x-auto px-1 pb-2 scroll-smooth snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden max-md:-mx-4 max-md:gap-3 max-md:px-4 min-[1101px]:gap-4"
                     data-home-gallery-track>
                    @forelse ($galleryImages as $image)
                        <a href="{{ route('gallery') }}"
                           class="group relative aspect-[4/5] w-[78%] shrink-0 snap-start overflow-hidden rounded-2xl bg-[#0b1528] shadow-[0_14px_36px_rgba(7,21,47,0.14)] transition-transform duration-300 hover:-translate-y-1 max-md:w-[72%] max-md:rounded-xl min-[651px]:w-[46%] min-[1101px]:w-[calc((100%-3rem)/4)]">
                            <img src="{{ $image['src'] }}"
                                 alt="{{ $image['alt'] }}"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                 loading="lazy">
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#07152f]/55 via-transparent to-transparent opacity-70 transition-opacity duration-300 group-hover:opacity-90 max-md:opacity-90"></div>
                            <span class="pointer-events-none absolute bottom-4 left-4 right-4 translate-y-1 text-[13px] font-bold text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100 max-md:translate-y-0 max-md:opacity-100">
                                View in gallery
                            </span>
                        </a>
                    @empty
                        <div class="flex h-[280px] w-full items-center justify-center rounded-2xl border border-dashed border-[#cfd6e0] bg-white text-sm font-semibold text-[#6b7788]">
                            Gallery images coming soon.
                        </div>
                    @endforelse
                </div>
                @if (count($galleryImages) > 0)
                    <p class="mt-3 hidden text-center text-xs font-semibold text-[#8a94a6] max-md:block">Swipe to browse photos</p>
                @endif
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
