@extends('layouts.litus')

@section('title', 'LITUS Automobiles — Premium Motorcycles in the Maldives')

@section('content')
@php
    $productImages = [
        asset('images/product/' . rawurlencode('premium 125 blue.png')),
        asset('images/product/' . rawurlencode('premium 125 red.png')),
        asset('images/product/' . rawurlencode('special edition 125 green yellow.png')),
    ];

    $topRides = [
        ['model' => 'ADV 160 2026', 'slug' => 'adv-160-2026', 'cc' => '160CC', 'capacity' => '8.1L', 'img' => $productImages[0], 'variant' => 'blue', 'badge' => '★ Best Seller'],
        ['model' => 'Scoopy Prestige 2026', 'slug' => 'scoopy-prestige-2026', 'cc' => '110CC', 'capacity' => '4.2L', 'img' => $productImages[1], 'variant' => 'blue', 'badge' => '★ Best Seller'],
        ['model' => 'Scoopy Club 12 2026', 'slug' => 'scoopy-club-12-2026', 'cc' => '110CC', 'capacity' => '4.2L', 'img' => $productImages[2], 'variant' => 'blue', 'badge' => '★ Best Seller'],
    ];

    $galleryImages = $galleryImages ?? [];

    $services = [
        [
            'title' => 'Application Made Easy',
            'icon' => 'check-circle',
            'img' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80',
            'text' => 'LITUS Automobiles simplifies the process of leasing a motorcycle by eliminating bureaucracy. A simple ID card is required for verification and applications can be made via social media platforms. Customers can choose from upfront or installment options.',
        ],
        [
            'title' => 'Genuine Parts',
            'icon' => 'package',
            'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80',
            'text' => 'LITUS Automobiles provides genuine parts to take care of your beloved motorbike for durability and performance quality. Visit our Service Center for professional service.',
        ],
        [
            'title' => 'Reliable Service',
            'icon' => 'wrench',
            'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80',
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
    <section class="relative min-h-[720px] overflow-hidden lg:min-h-[820px]">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-center"
             aria-hidden="true">
        <div class="absolute inset-0 bg-[linear-gradient(110deg,rgba(0,65,180,0.55)_0%,rgba(11,22,40,0.85)_40%,rgba(11,22,40,0.45)_70%,rgba(11,22,40,0.2)_100%)]"></div>

        <div class="relative z-10 litus-container flex min-h-[720px] flex-col justify-center lg:min-h-[820px]">
            <div class="max-w-xl py-20 text-left lg:py-24">
                <p class="mb-4 text-sm font-bold uppercase tracking-widest text-litus-red sm:text-base">Premium Bikes. Trusted Service.</p>
                <h1 class="mb-6 font-display text-[2.9rem] font-black leading-[1.08] text-white sm:text-[3.25rem] lg:text-[3.85rem]">
                    Ride Your Dream<br>with<br>
                    <span class="text-litus-red">LITUS Automobiles</span>
                </h1>
                <p class="mb-9 max-w-md text-base leading-relaxed text-gray-300 lg:text-lg">
                    Discover premium motorcycles, flexible ownership plans, genuine parts, and trusted service across the Maldives.
                </p>
                <div class="flex flex-col justify-start gap-3 sm:flex-row sm:gap-4">
                    <a href="{{ route('motorcycles') }}"
                       class="flex items-center justify-center gap-2 rounded-md bg-litus-red px-7 py-3.5 text-base font-bold text-white transition-opacity hover:opacity-90">
                        Explore Motorcycles
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ route('ownership-plans') }}"
                       class="rounded-md border border-white/30 px-7 py-3.5 text-base font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                        View Ownership Plans
                    </a>
                </div>
            </div>
        </div>

        {{-- Feature bar --}}
        <div class="relative z-10 border-t border-white/10 bg-black/35 backdrop-blur-sm">
            <div class="litus-container">
                <div class="grid min-h-[120px] grid-cols-1 items-center min-[701px]:grid-cols-2 min-[1100px]:min-h-[130px] min-[1100px]:grid-cols-4">
                    @foreach ($features as $index => $feature)
                        <div @class([
                            'flex items-center gap-3.5 py-8 sm:gap-4 sm:py-9 lg:py-10',
                            'border-b border-white/10 max-md:border-b' => $index < count($features) - 1,
                            'max-md:last:border-b-0',
                            'min-[1100px]:border-r min-[1100px]:border-white/10 min-[1100px]:pr-6' => $index < count($features) - 1,
                            'min-[1100px]:pl-0' => $index === 0,
                            'min-[1100px]:pl-6' => $index > 0,
                            'max-[1100px]:min-[701px]:border-r max-[1100px]:min-[701px]:border-white/10' => in_array($index, [0, 2]),
                            'max-[1100px]:min-[701px]:border-b max-[1100px]:min-[701px]:border-white/10' => in_array($index, [0, 1]),
                            'max-[1100px]:min-[701px]:border-r-0' => $index === 1,
                        ])>
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-litus-red/25 bg-litus-red/15 sm:h-[52px] sm:w-[52px]">
                                <x-litus-icon :name="$feature['icon']" class="h-5 w-5 text-litus-red sm:h-[22px] sm:w-[22px]" />
                            </div>
                            <div class="min-w-0 text-left">
                                <p class="text-sm font-bold leading-tight text-white sm:text-[15px]">{{ $feature['label'] }}</p>
                                <p class="mt-1 text-xs leading-snug text-gray-400 sm:text-[13px]">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ONGOING PROMOTIONS --}}
    <section class="relative overflow-hidden border border-[#dfe3ea] py-[38px] pb-7 max-sm:py-[30px]"
             style="background: linear-gradient(rgba(255,255,255,0.94), rgba(255,255,255,0.94)), radial-gradient(circle at 10% 20%, rgba(6,21,48,0.08), transparent 25%);">
        <div class="pointer-events-none absolute inset-0 opacity-40"
             style="background-image: linear-gradient(30deg, rgba(6,21,48,0.035) 12%, transparent 12.5%, transparent 87%, rgba(6,21,48,0.035) 87.5%, rgba(6,21,48,0.035)), linear-gradient(150deg, rgba(6,21,48,0.035) 12%, transparent 12.5%, transparent 87%, rgba(6,21,48,0.035) 87.5%, rgba(6,21,48,0.035)); background-size: 55px 95px;"></div>

        <div class="relative z-[2] litus-container">
            <div class="mb-9 flex flex-col items-start justify-between gap-5 min-[651px]:mb-[35px] min-[651px]:flex-row min-[651px]:gap-5">
                <div>
                    <span class="mb-1.5 block text-sm font-black uppercase tracking-wide text-[#0065ef]">Special Deals</span>
                    <h2 class="mb-3.5 text-[30px] font-black leading-tight tracking-[-0.5px] text-[#07152f] min-[651px]:text-4xl">Ongoing Promotions</h2>
                    <p class="text-[15px] font-semibold text-[#424c5e]">Limited-time deals on selected motorcycles and scooters.</p>
                </div>
                <a href="{{ route('motorcycles') }}"
                   class="group/viewall inline-flex items-center gap-2.5 text-[15px] font-black text-[#07152f] transition-all duration-300 hover:gap-4 hover:text-[#0065ef] min-[651px]:mt-[58px]">
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

                <div class="grid grid-cols-1 gap-[18px] min-[651px]:grid-cols-2 min-[1101px]:grid-cols-4">
                    @forelse ($promoMotorcycles as $motorcycle)
                        <x-card.promotion-card :motorcycle="$motorcycle" />
                    @empty
                        <div class="col-span-full rounded-[10px] border border-dashed border-[#dfe3ea] bg-white/80 px-6 py-12 text-center">
                            <p class="font-semibold text-[#424c5e]">No active promotions at the moment.</p>
                            <p class="mt-1 text-sm text-[#667085]">Check back soon or browse our full motorcycle range.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- TOP SELLING RIDES --}}
    <section class="border border-white/[0.08] py-[42px] pb-[50px] max-[720px]:py-[34px]"
             style="background: radial-gradient(circle at top left, rgba(14,61,111,0.35), transparent 35%), radial-gradient(circle at bottom right, rgba(14,61,111,0.25), transparent 35%), linear-gradient(135deg, #061326 0%, #071a33 45%, #061326 100%);">
        <div class="litus-container">

            <div class="mb-[30px] flex flex-col items-start justify-between gap-5 min-[721px]:flex-row max-[1100px]:gap-5">
                <div>
                    <span class="mb-2 block text-[15px] font-black uppercase tracking-wide text-[#0065ef]">Customer Favorites</span>
                    <h2 class="mb-3 text-[32px] font-black leading-tight tracking-[-0.5px] text-white min-[721px]:text-[42px]">Top Selling Rides</h2>
                    <p class="text-base font-semibold text-[#d6dee9]">Explore our most popular motorcycles and scooters.</p>
                </div>
                <a href="{{ route('motorcycles') }}"
                   class="group/viewall inline-flex items-center gap-2.5 text-base font-black text-[#0065ef] transition-all duration-300 hover:gap-4 hover:text-white min-[721px]:mt-[55px]">
                    View All Rides
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="grid grid-cols-1 gap-[22px] min-[721px]:gap-[38px] min-[1101px]:grid-cols-3 max-[1100px]:min-[721px]:grid-cols-2">
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
        <div class="relative overflow-hidden py-12 sm:py-16 lg:py-20"
             style="background-image: radial-gradient(circle, rgba(7, 21, 47, 0.10) 2px, transparent 2px); background-size: 24px 24px; background-color: #fafafa;">
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(250,250,250,0.95)_0%,rgba(250,250,250,0.78)_25%,rgba(250,250,250,0.55)_50%,rgba(250,250,250,0.88)_100%)]"></div>

            <div class="relative z-[2] litus-container grid grid-cols-1 items-center justify-between gap-10 max-[950px]:text-center min-[951px]:grid-cols-[38%_52%] min-[951px]:gap-10">
                <div>
                    <span class="mb-2 block text-[13px] font-black uppercase tracking-wide text-[#0065ef]">Stay Updated</span>
                    <h2 class="mb-[18px] text-[34px] font-black leading-tight tracking-[-1px] text-[#07152f] min-[601px]:text-[42px]">What's New?</h2>
                    <p class="mb-7 max-w-[360px] text-[15px] font-semibold leading-snug text-[#384354] max-[950px]:mx-auto">
                        Stay updated with the latest launches, offers, and stories from LITUS Automobiles.
                    </p>
                    <a href="https://youtu.be/o8grf3wSwQU"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-12 min-w-[190px] items-center justify-center gap-3 rounded-md bg-[#0065ef] px-6 text-sm font-black text-white shadow-[0_8px_20px_rgba(0,101,239,0.25)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc]">
                        Watch Latest Updates
                        <x-litus-icon name="play" class="h-3.5 w-3.5" />
                    </a>
                </div>

                <div class="relative mx-auto w-full max-w-[700px] overflow-hidden rounded-[9px] border border-black/15 bg-[#101722] shadow-[0_12px_32px_rgba(0,0,0,0.22)] min-[951px]:mx-0 min-[951px]:max-w-none">
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
        <div class="border-t border-[#e3e6eb] bg-white py-12 sm:py-16 lg:py-20">
            <div class="litus-container">

                <div class="mb-[18px] text-center">
                    <span class="mb-1.5 block text-xs font-black uppercase text-[#0065ef]">Our Services</span>
                    <h2 class="text-[27px] font-black leading-tight tracking-[-0.5px] text-[#07152f] min-[601px]:text-[32px]">What We Offer at LITUS</h2>
                </div>

                <div class="grid grid-cols-1 gap-[26px] max-[950px]:mx-auto max-[950px]:max-w-[650px] min-[951px]:grid-cols-3">
                    @foreach ($services as $service)
                        <div class="overflow-hidden rounded-[11px] border border-[#dfe3ea] bg-white shadow-[0_10px_26px_rgba(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(0,0,0,0.12)]">
                            <div class="relative h-[155px] overflow-hidden bg-[#dfe5ec] min-[601px]:h-[170px]">
                                <img src="{{ $service['img'] }}"
                                     alt="{{ $service['title'] }}"
                                     class="block h-full w-full object-cover">
                                <div class="absolute left-5 top-[18px] flex h-[50px] w-[50px] items-center justify-center rounded-full bg-white text-[#0065ef] shadow-[0_8px_18px_rgba(0,0,0,0.15)]">
                                    <x-litus-icon :name="$service['icon']" class="h-6 w-6" />
                                </div>
                            </div>
                            <div class="px-[22px] pb-6 pt-[18px]">
                                <h3 class="mb-3 text-[17px] font-black text-[#111b46]">{{ $service['title'] }}</h3>
                                <p class="text-[13.5px] font-semibold leading-snug text-[#344052]">{{ $service['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </section>

    {{-- WHO WE ARE --}}
    <section class="relative flex min-h-[360px] items-center overflow-hidden border border-white/12 bg-cover bg-center max-[900px]:min-h-0 max-[900px]:bg-[linear-gradient(90deg,rgba(3,12,28,0.88),rgba(3,12,28,0.94)),url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1800&q=80')] max-[900px]:bg-cover max-[900px]:bg-center"
             style="background-image: linear-gradient(90deg, rgba(3,12,28,0.20) 0%, rgba(3,12,28,0.65) 36%, rgba(3,12,28,0.96) 68%, rgba(3,12,28,0.98) 100%), url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1800&q=80');">
        <div class="pointer-events-none absolute inset-0 z-[1] bg-[linear-gradient(90deg,rgba(3,12,28,0.08)_0%,rgba(3,12,28,0.35)_34%,rgba(3,12,28,0.88)_58%,rgba(3,12,28,0.96)_100%),radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.08),transparent_28%)]"></div>

        <div class="relative z-[2] litus-container grid w-full grid-cols-1 items-center px-[7%] py-[55px] min-[901px]:grid-cols-[48%_52%] max-[600px]:px-5 max-[600px]:py-[45px] max-[900px]:px-6 max-[900px]:py-[60px]">
            <div class="min-h-[250px] max-[900px]:hidden"></div>

            <div class="max-w-[720px] max-[900px]:max-w-full">
                <span class="mb-2 block text-[15px] font-black uppercase tracking-wide text-[#0065ef]">Our Story</span>
                <h2 class="mb-4 text-[34px] font-black leading-tight tracking-[-0.5px] text-white drop-shadow-[0_8px_20px_rgba(0,0,0,0.55)] min-[601px]:text-[44px]">Who We Are</h2>
                <p class="mb-7 max-w-[690px] text-sm font-semibold leading-[1.7] text-[#e3e9f2] drop-shadow-[0_4px_14px_rgba(0,0,0,0.45)] min-[601px]:text-base min-[601px]:leading-[1.65]">
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
    <section class="relative overflow-hidden border border-[#dfe3ea] py-12 sm:py-16 lg:py-20"
             style="background: linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)), radial-gradient(circle at 15% 35%, rgba(7,21,47,0.08), transparent 28%);">
        <div class="pointer-events-none absolute inset-0 opacity-35"
             style="background-image: linear-gradient(30deg, rgba(7,21,47,0.035) 12%, transparent 12.5%, transparent 87%, rgba(7,21,47,0.035) 87.5%), linear-gradient(150deg, rgba(7,21,47,0.035) 12%, transparent 12.5%, transparent 87%, rgba(7,21,47,0.035) 87.5%); background-size: 55px 95px;"></div>

        <div class="relative z-[2] litus-container">
            <div class="mb-[22px] flex flex-col items-start justify-between gap-5 min-[651px]:flex-row">
                <div>
                    <span class="mb-1 block text-[15px] font-black uppercase tracking-wide text-[#0065ef]">Our Gallery</span>
                    <h2 class="mb-2.5 text-[30px] font-black leading-tight tracking-[-0.6px] text-[#07152f] min-[651px]:text-[38px]">Ride the Visual Journey</h2>
                    <p class="text-sm font-semibold leading-normal text-[#4f5b6c] min-[651px]:text-[15px]">
                        Explore our collection of motorcycle rides and lifestyle moments.
                    </p>
                </div>
                <a href="{{ route('gallery') }}"
                   class="group/viewgallery inline-flex items-center gap-2.5 text-[15px] font-black text-[#07152f] transition-all duration-300 hover:gap-4 hover:text-[#0065ef] min-[651px]:mt-[52px]">
                    View Gallery
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="relative min-[1101px]:px-10">
                <button type="button"
                        class="absolute left-0 top-1/2 z-[5] hidden h-[54px] w-[54px] -translate-y-1/2 items-center justify-center rounded-full bg-white text-[#07152f] shadow-[0_10px_24px_rgba(0,0,0,0.12)] transition-colors duration-300 hover:bg-[#0065ef] hover:text-white min-[1101px]:flex"
                        aria-label="Previous gallery images">
                    <x-litus-icon name="chevron-left" class="h-6 w-6" />
                </button>
                <button type="button"
                        class="absolute right-0 top-1/2 z-[5] hidden h-[54px] w-[54px] -translate-y-1/2 items-center justify-center rounded-full bg-white text-[#07152f] shadow-[0_10px_24px_rgba(0,0,0,0.12)] transition-colors duration-300 hover:bg-[#0065ef] hover:text-white min-[1101px]:flex"
                        aria-label="Next gallery images">
                    <x-litus-icon name="chevron-right" class="h-6 w-6" />
                </button>

                <div class="grid grid-cols-1 gap-3 min-[651px]:grid-cols-2 min-[1101px]:grid-cols-4">
                    @foreach ($galleryImages as $image)
                        <div class="group relative h-[210px] overflow-hidden rounded-xl border border-[#dfe3ea] bg-white shadow-[0_10px_24px_rgba(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_36px_rgba(0,0,0,0.12)] min-[1101px]:h-[185px] max-[1100px]:min-[651px]:h-[220px]">
                            <img src="{{ $image['src'] }}"
                                 alt="{{ $image['alt'] }}"
                                 class="block h-full w-full object-cover transition-transform duration-400 group-hover:scale-[1.07]">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/[0.18] to-black/[0.02] opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
