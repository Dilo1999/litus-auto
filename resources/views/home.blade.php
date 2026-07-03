@extends('layouts.litus')

@section('title', 'LITUS Automobiles — Premium Motorcycles in the Maldives')

@section('content')
@php
    $navLinks = ['Home', 'About Us', 'Motorcycles', 'Ownership Plans', 'Parts', 'Service Center', 'Contact Us', 'Gallery'];

    $promoCards = [
        ['model' => 'ADV 160 2026', 'discount' => 'MVR 16,750', 'img' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['model' => 'ADV 160 2026', 'discount' => 'MVR 16,750', 'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['model' => 'PCX 160 ABS', 'discount' => 'MVR 11,000', 'img' => 'https://images.unsplash.com/photo-1611956292173-c2445aa61709?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['model' => 'N Max 155 Neo S', 'discount' => 'MVR 14,100', 'img' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
    ];

    $topRides = [
        ['model' => 'ADV 160 2026', 'cc' => '160CC', 'capacity' => '8.1L', 'img' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['model' => 'Scoopy Prestige 2026', 'cc' => '110CC', 'capacity' => '4.2L', 'img' => 'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['model' => 'Scoopy Club 12 2026', 'cc' => '110CC', 'capacity' => '4.2L', 'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
    ];

    $galleryImages = [
        ['src' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80', 'alt' => 'Motorcycle lifestyle'],
        ['src' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80', 'alt' => 'Scooter ride'],
        ['src' => 'https://images.unsplash.com/photo-1598077737122-925e6f7cf137?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80', 'alt' => 'White scooter'],
        ['src' => 'https://images.unsplash.com/photo-1585210256590-fc52fd1e8348?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80', 'alt' => 'Red motorcycle'],
    ];

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

    $heroImg = 'https://images.unsplash.com/photo-1609630875171-b1321377ee65?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1200&q=80';
@endphp

<div class="font-sans">

    {{-- HEADER --}}
    <header class="sticky top-0 z-50 w-full bg-litus-navy">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:h-[68px]">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-sm bg-litus-red">
                    <span class="text-sm font-black text-white">L</span>
                </div>
                <div>
                    <span class="block text-lg font-black leading-none tracking-wide text-white">LITUS</span>
                    <span class="block text-xs uppercase leading-none tracking-widest text-gray-400">Automobiles</span>
                </div>
            </a>

            <nav class="hidden items-center gap-1 lg:flex" aria-label="Main navigation">
                @foreach ($navLinks as $link)
                    <a href="#"
                       class="rounded px-3 py-1.5 text-sm font-medium transition-colors {{ $link === 'Home' ? 'text-litus-red' : 'text-gray-300 hover:text-white' }}">
                        {{ $link }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                <a href="tel:+9603331234"
                   class="hidden items-center gap-1.5 rounded-full bg-litus-red px-4 py-2 text-sm font-bold text-white transition-opacity hover:opacity-90 sm:flex">
                    <x-litus-icon name="phone" class="h-3.5 w-3.5" />
                    Call Now
                </a>
                <button type="button"
                        class="text-white lg:hidden"
                        data-litus-menu-toggle
                        aria-expanded="false"
                        aria-controls="litus-mobile-menu"
                        aria-label="Toggle navigation menu">
                    <x-litus-icon name="menu" class="h-[22px] w-[22px]" data-litus-menu-icon="open" />
                    <x-litus-icon name="x" class="hidden h-[22px] w-[22px]" data-litus-menu-icon="close" />
                </button>
            </div>
        </div>

        <div id="litus-mobile-menu" class="hidden border-t border-white/10 px-4 pb-4 pt-2 lg:hidden" data-litus-mobile-menu>
            @foreach ($navLinks as $link)
                <a href="#" class="block py-2 text-sm font-medium text-gray-200 hover:text-white">{{ $link }}</a>
            @endforeach
            <a href="tel:+9603331234"
               class="mt-3 flex w-fit items-center gap-2 rounded-full bg-litus-red px-4 py-2 text-sm font-bold text-white">
                <x-litus-icon name="phone" class="h-3.5 w-3.5" />
                Call Now
            </a>
        </div>
    </header>

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-[linear-gradient(110deg,#8B0000_0%,#5a0a0a_20%,#1a1a2e_55%,#0d1b3e_100%)]">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(ellipse at 80% 60%, #1a3a6b 0%, transparent 55%);"></div>

        <div class="relative z-10 mx-auto flex min-h-[520px] max-w-7xl flex-col items-center px-4 sm:px-6 lg:min-h-[560px] lg:flex-row">
            <div class="py-16 text-center lg:w-[44%] lg:py-20 lg:text-left">
                <p class="mb-3 text-xs font-bold uppercase tracking-widest text-litus-red">Premium Bikes. Trusted Service.</p>
                <h1 class="mb-5 font-display text-[2.6rem] font-black leading-[1.1] text-white sm:text-5xl lg:text-[3.4rem]">
                    Ride Your Dream<br>with<br>
                    <span class="text-litus-red">LITUS Automobiles</span>
                </h1>
                <p class="mx-auto mb-8 max-w-sm text-sm leading-relaxed text-gray-300 lg:mx-0 lg:text-base">
                    Discover premium motorcycles, flexible ownership plans, genuine parts, and trusted service across the Maldives.
                </p>
                <div class="flex flex-col justify-center gap-3 sm:flex-row lg:justify-start">
                    <a href="#"
                       class="flex items-center justify-center gap-2 rounded-md bg-litus-red px-6 py-3 text-sm font-bold text-white transition-opacity hover:opacity-90">
                        Explore Motorcycles
                        <x-litus-icon name="arrow-right" class="h-[15px] w-[15px]" />
                    </a>
                    <a href="#"
                       class="rounded-md border border-white/30 px-6 py-3 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                        View Ownership Plans
                    </a>
                </div>
            </div>

            <div class="flex w-full items-end justify-center self-stretch pt-8 lg:w-[56%] lg:justify-end lg:pt-0">
                <img src="{{ $heroImg }}"
                     alt="LITUS motorcycles and rider"
                     class="w-full max-w-2xl object-contain object-bottom lg:max-w-none"
                     style="max-height: 560px;">
            </div>
        </div>

        {{-- Feature bar --}}
        <div class="relative z-10 border-t border-white/10 bg-black/35 backdrop-blur-sm">
            <div class="mx-auto grid max-w-7xl grid-cols-2 gap-6 px-4 py-5 sm:grid-cols-4 sm:px-6">
                @foreach ($features as $feature)
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-litus-red/25 bg-litus-red/15">
                            <x-litus-icon :name="$feature['icon']" class="h-[17px] w-[17px] text-litus-red" />
                        </div>
                        <div>
                            <p class="text-sm font-bold leading-tight text-white">{{ $feature['label'] }}</p>
                            <p class="mt-0.5 text-xs leading-snug text-gray-400">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ONGOING PROMOTIONS --}}
    <section class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Special Deals</span>
                    <h2 class="mt-1 font-display text-3xl font-black text-gray-900 lg:text-4xl">Ongoing Promotions</h2>
                    <p class="mt-1 text-gray-500">Limited-time deals on selected motorcycles and scooters.</p>
                </div>
                <a href="#" class="hidden items-center gap-1 text-sm font-semibold text-gray-500 transition-colors hover:text-gray-800 sm:flex">
                    View All Promotions
                    <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                </a>
            </div>

            <div class="relative">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($promoCards as $card)
                        <div class="group overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-xl">
                            <div class="relative">
                                <img src="{{ $card['img'] }}"
                                     alt="{{ $card['model'] }}"
                                     class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <span class="absolute left-3 top-3 rounded-full bg-litus-red px-2.5 py-1 text-xs font-bold text-white">
                                    Limited Offer
                                </span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-base font-black text-gray-900">{{ $card['model'] }}</h3>
                                <p class="mt-0.5 text-sm text-gray-500">Save up to</p>
                                <p class="mt-1 text-xl font-black text-litus-red">{{ $card['discount'] }}</p>
                                <button type="button" class="mt-3 w-full rounded-full bg-litus-red py-2 text-sm font-bold text-white transition-opacity hover:opacity-90">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="absolute -left-5 top-1/2 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-lg hover:bg-gray-50 lg:flex" aria-label="Previous promotions">
                    <x-litus-icon name="chevron-left" class="h-[18px] w-[18px] text-gray-600" />
                </button>
                <button type="button" class="absolute -right-5 top-1/2 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-lg hover:bg-gray-50 lg:flex" aria-label="Next promotions">
                    <x-litus-icon name="chevron-right" class="h-[18px] w-[18px] text-gray-600" />
                </button>
            </div>
        </div>
    </section>

    {{-- TOP SELLING RIDES --}}
    <section class="bg-litus-navy py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Customer Favorites</span>
                    <h2 class="mt-1 font-display text-3xl font-black text-white lg:text-4xl">Top Selling Rides</h2>
                    <p class="mt-1 text-gray-400">Explore our most popular motorcycles and scooters.</p>
                </div>
                <a href="#" class="hidden items-center gap-1 text-sm font-semibold text-gray-400 transition-colors hover:text-white sm:flex">
                    View All Rides
                    <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach ($topRides as $ride)
                    <div class="group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.04] transition-colors hover:border-red-500/40">
                        <div class="relative overflow-hidden">
                            <img src="{{ $ride['img'] }}"
                                 alt="{{ $ride['model'] }}"
                                 class="h-52 w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-litus-navy/80 via-transparent to-transparent"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-black text-white">{{ $ride['model'] }}</h3>
                            <div class="mt-3 flex items-center gap-4">
                                <div class="flex items-center gap-1.5 text-sm text-gray-400">
                                    <x-litus-icon name="gauge" class="h-3.5 w-3.5 text-litus-red" />
                                    {{ $ride['cc'] }}
                                </div>
                                <div class="flex items-center gap-1.5 text-sm text-gray-400">
                                    <x-litus-icon name="fuel" class="h-3.5 w-3.5 text-litus-red" />
                                    Capacity {{ $ride['capacity'] }}
                                </div>
                            </div>
                            <button type="button" class="mt-4 w-full rounded-full border-2 border-litus-red py-2.5 text-sm font-bold text-litus-red transition-all hover:bg-litus-red hover:text-white">
                                Explore More
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHAT'S NEW --}}
    <section class="bg-white py-16">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-10 px-4 sm:px-6 lg:flex-row lg:gap-16">
            <div class="lg:w-1/2">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Stay Updated</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">What's New?</h2>
                <p class="mt-3 max-w-md leading-relaxed text-gray-500">
                    Stay updated with the latest launches, offers, and stories from LITUS Automobiles.
                </p>
                <a href="#"
                   class="mt-6 inline-flex items-center gap-2 rounded-full bg-litus-red px-6 py-3 text-sm font-bold text-white transition-opacity hover:opacity-90">
                    <x-litus-icon name="play" class="h-3.5 w-3.5" />
                    Watch Latest Updates
                </a>
            </div>

            <div class="w-full lg:w-1/2">
                <div class="group relative cursor-pointer overflow-hidden rounded-2xl shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80"
                         alt="Latest updates"
                         class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-105 lg:h-72">
                    <div class="absolute inset-0 flex items-center justify-center bg-black/40">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-litus-red shadow-xl transition-transform group-hover:scale-110">
                            <x-litus-icon name="play" class="ml-1 h-[22px] w-[22px] text-white" />
                        </div>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <span class="text-sm font-bold text-white">LITUS Automobiles – Latest Launches &amp; Offers</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- WHAT WE OFFER --}}
    <section class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Services</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">What We Offer at LITUS</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach ($services as $service)
                    <div class="overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-xl">
                        <div class="relative">
                            <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}" class="h-44 w-full object-cover">
                            <div class="absolute -bottom-5 left-5 flex h-10 w-10 items-center justify-center rounded-full bg-litus-red shadow-lg">
                                <x-litus-icon :name="$service['icon']" class="h-[18px] w-[18px] text-white" />
                            </div>
                        </div>
                        <div class="px-5 pb-5 pt-8">
                            <h3 class="text-lg font-black text-gray-900">{{ $service['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-gray-500">{{ $service['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHO WE ARE --}}
    <section class="relative overflow-hidden py-24">
        <img src="https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1600&q=80"
             alt="Motorcycle rider"
             class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-[rgba(6,14,28,0.95)] via-[rgba(6,14,28,0.7)] to-[rgba(6,14,28,0.3)]"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6">
            <div class="max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Story</span>
                <h2 class="mb-5 mt-2 font-display text-3xl font-black text-white lg:text-5xl">Who We Are</h2>
                <p class="max-w-xl text-base leading-relaxed text-gray-300 lg:text-lg">
                    Established in 2014, LITUS Automobiles stands as the premier destination for motorcycles in the Maldives. As the largest motorcycle dealer, we specialize in the sale, lease, and service of top-notch motorcycles. Our commitment extends to providing genuine spare parts, ensuring every ride is a journey of excellence. At LITUS, we don't just sell motorcycles; we turn aspirations into reality and transform dreams of the open road into adventures that thrill. Join us and discover the joy of riding with LITUS Automobiles — where every adventure begins.
                </p>
                <a href="#"
                   class="mt-7 inline-block rounded-full bg-litus-red px-7 py-3 text-sm font-bold text-white transition-opacity hover:opacity-90">
                    Find Out More
                </a>
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Gallery</span>
                    <h2 class="mt-1 font-display text-3xl font-black text-gray-900 lg:text-4xl">Ride the Visual Journey</h2>
                    <p class="mt-1 text-gray-500">Explore our collection of motorcycles, scooters, and customer moments.</p>
                </div>
                <a href="#" class="hidden items-center gap-1 text-sm font-semibold text-gray-500 transition-colors hover:text-gray-800 sm:flex">
                    View Gallery
                    <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                </a>
            </div>

            <div class="relative">
                <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                    @foreach ($galleryImages as $image)
                        <div class="group cursor-pointer overflow-hidden rounded-xl">
                            <img src="{{ $image['src'] }}"
                                 alt="{{ $image['alt'] }}"
                                 class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105 lg:h-52">
                        </div>
                    @endforeach
                </div>

                <button type="button" class="absolute -left-4 top-1/2 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-lg hover:bg-gray-50 lg:flex" aria-label="Previous gallery images">
                    <x-litus-icon name="chevron-left" class="h-[18px] w-[18px] text-gray-600" />
                </button>
                <button type="button" class="absolute -right-4 top-1/2 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-lg hover:bg-gray-50 lg:flex" aria-label="Next gallery images">
                    <x-litus-icon name="chevron-right" class="h-[18px] w-[18px] text-gray-600" />
                </button>
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
