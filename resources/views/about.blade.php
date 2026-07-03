@extends('layouts.litus')

@section('title', 'About Us — LITUS Automobiles')

@section('content')
@php
    $teamLeaders = [
        ['name' => 'Mohamed Zahid', 'role' => 'Chief Executive Officer', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80'],
        ['name' => 'Ahmed Zahir', 'role' => 'Chief Operating Officer', 'img' => 'https://images.unsplash.com/photo-1705645930353-0e335311ef20?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80'],
        ['name' => 'Asif Rasheed', 'role' => 'Chief Strategy & Marketing Officer', 'img' => 'https://images.unsplash.com/photo-1718209881007-c0ecdfc00f9d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80'],
    ];

    $teamMembers = [
        ['name' => 'Mohamed Nazeer', 'role' => 'Manager', 'dept' => 'Parts & Service Center', 'img' => 'https://images.unsplash.com/photo-1613181013804-1dcba09e6a9d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
        ['name' => 'Hifath Ali', 'role' => 'Head of Sales', 'dept' => 'Sales Department', 'img' => 'https://images.unsplash.com/photo-1648474484044-bb82df2f5a1f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
        ['name' => 'Dhanushka', 'role' => 'Inventory Officer', 'dept' => 'Inventory Management', 'img' => 'https://images.unsplash.com/photo-1600878459138-e1123b37cb30?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
        ['name' => 'Mohamed Nafiz', 'role' => 'Lawyer', 'dept' => 'Legal Affairs', 'img' => 'https://images.unsplash.com/photo-1543132220-4bf3de6e10ae?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
    ];

    $showrooms = [
        ['name' => 'Malé Showroom', 'address' => 'Chaandhanee Magu, Malé, Maldives', 'featured' => true, 'img' => 'https://images.unsplash.com/photo-1773940792913-94baf5fa0130?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80'],
        ['name' => 'Hithadhoo Showroom', 'address' => 'Fenfiyazmagu, S. Hithadhoo, Maldives', 'featured' => true, 'img' => 'https://images.unsplash.com/photo-1771402382481-de35db6c4159?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80'],
        ['name' => 'Kulhudhuffushi Showroom', 'address' => 'Izzuddeen Magu, Kulhudhuffushi, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Nolhivaranfaru Showroom', 'address' => 'Hdh. Nolhivaranfaru Magu, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Villingili Showroom', 'address' => 'Ameenee Magu, GA. Villingili, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1611956292173-c2445aa61709?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Feydhoo Showroom', 'address' => 'Maathila Magu, S. Feydhoo, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1772090095175-ef442d5f56a8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Fonadhoo Showroom', 'address' => 'Sinajuddeen Magu, L. Fonadhoo, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Head Office', 'address' => 'Ma. Eyrum, Buruzu Magu, Malé, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Hulhumale Showroom', 'address' => 'Nirolhu Magu, Hulhumale, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Thinadhoo Showroom', 'address' => 'Daisy Magu, Thinadhoo, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
    ];

    $opStats = [
        ['icon' => 'users', 'label' => 'Dedicated Team', 'value' => '50+'],
        ['icon' => 'headphones', 'label' => 'Customer Support', 'value' => '24/7'],
        ['icon' => 'shopping-bag', 'label' => 'Sales Assistance', 'value' => 'Expert'],
        ['icon' => 'wrench', 'label' => 'Service Guidance', 'value' => 'Pro'],
    ];

    $trustBadges = [
        ['icon' => 'star', 'val' => 'Est. 2014', 'label' => 'Established in 2014'],
        ['icon' => 'check-circle', 'val' => '11+', 'label' => 'Largest Motorcycle Dealer'],
        ['icon' => 'package', 'val' => '100%', 'label' => 'Genuine Parts'],
        ['icon' => 'wrench', 'val' => '12+', 'label' => 'Reliable Service Centers'],
    ];

    $missionVision = [
        ['icon' => 'target', 'title' => 'Our Mission', 'text' => 'To provide support and leadership in the automobile industry by offering easy and reliable services across the Maldives.', 'accent' => 'red'],
        ['icon' => 'eye', 'title' => 'Our Vision', 'text' => 'Independent mobility for everyone.', 'accent' => 'navy'],
    ];
@endphp

<div class="font-sans">

    <x-litus-header active="About Us" />

    {{-- HERO --}}
    <section class="relative min-h-[640px] overflow-hidden bg-litus-footer lg:min-h-[720px]">
        <img src="https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1600&q=80"
             alt="About LITUS"
             class="absolute inset-0 h-full w-full object-cover opacity-30">
        <div class="absolute inset-0 bg-[linear-gradient(110deg,rgba(139,0,0,0.55)_0%,rgba(20,20,40,0.6)_60%,transparent_100%)]"></div>

        <div class="relative z-10 mx-auto flex max-w-7xl flex-col items-center gap-10 px-4 py-24 sm:px-6 lg:flex-row lg:py-32">
            <div class="text-center lg:w-3/5 lg:text-left">
                <span class="mb-5 inline-block rounded-full border border-litus-red/30 bg-litus-red/15 px-3 py-1 text-xs font-bold uppercase tracking-widest text-litus-red">
                    About LITUS Automobiles
                </span>
                <h1 class="mb-5 font-display text-4xl font-black leading-[1.1] text-white sm:text-5xl lg:text-6xl">
                    Driven by Trust.<br>
                    <span class="text-litus-red">Built for Every Ride.</span>
                </h1>
                <p class="mx-auto mb-8 max-w-xl text-base leading-relaxed text-gray-300 lg:mx-0 lg:text-lg">
                    LITUS Automobiles is a leading motorcycle supplier in the Maldives, established in 2014. We offer a wide range of mobility solutions to meet the needs of our customers with quality products and excellent customer service.
                </p>
                <div class="flex flex-col justify-center gap-3 sm:flex-row lg:justify-start">
                    <a href="#mission-vision"
                       class="flex items-center justify-center gap-2 rounded-md bg-litus-red px-7 py-3 text-sm font-bold text-white">
                        Explore Our Story
                        <x-litus-icon name="arrow-right" class="h-[15px] w-[15px]" />
                    </a>
                    <a href="#"
                       class="rounded-md border border-white/30 px-7 py-3 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                        Contact Us
                    </a>
                </div>
            </div>

            <div class="mx-auto grid w-full max-w-sm grid-cols-2 gap-4 lg:mx-0 lg:w-2/5">
                @foreach ($trustBadges as $badge)
                    <div class="rounded-xl border border-white/10 bg-white/[0.06] p-4 text-center backdrop-blur-sm">
                        <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-litus-red/20">
                            <x-litus-icon :name="$badge['icon']" class="h-[18px] w-[18px] text-litus-red" />
                        </div>
                        <p class="text-xl font-black text-white">{{ $badge['val'] }}</p>
                        <p class="mt-0.5 text-xs leading-tight text-gray-400">{{ $badge['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- MISSION & VISION --}}
    <section id="mission-vision" class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Purpose</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Our Mission &amp; Vision</h2>
            </div>
            <div class="mx-auto grid max-w-4xl grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach ($missionVision as $item)
                    <div class="flex flex-col gap-5 rounded-2xl bg-white p-8 shadow-md transition-shadow hover:shadow-xl">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full {{ $item['accent'] === 'red' ? 'bg-litus-red/10' : 'bg-litus-navy/8' }}">
                            <x-litus-icon :name="$item['icon']" class="h-[26px] w-[26px] {{ $item['accent'] === 'red' ? 'text-litus-red' : 'text-litus-navy' }}" />
                        </div>
                        <div>
                            <h3 class="mb-2 text-xl font-black text-gray-900">{{ $item['title'] }}</h3>
                            <p class="leading-relaxed text-gray-500">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LEADERSHIP TEAM --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-12 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Leadership Team</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Our Key Members</h2>
                <p class="mx-auto mt-2 max-w-lg text-gray-500">Meet the leaders guiding LITUS Automobiles with experience, vision, and commitment.</p>
            </div>

            <div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach ($teamLeaders as $member)
                    <div class="group overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-md transition-shadow hover:shadow-xl">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-litus-navy/75 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <p class="text-base font-black text-white">{{ $member['name'] }}</p>
                                <p class="mt-0.5 text-xs text-gray-300">{{ $member['role'] }}</p>
                            </div>
                            <a href="#" class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm transition-colors hover:bg-white/40" aria-label="LinkedIn profile for {{ $member['name'] }}">
                                <x-litus-icon name="linkedin" class="h-[13px] w-[13px] text-white" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-4">
                @foreach ($teamMembers as $member)
                    <div class="group overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition-shadow hover:shadow-md">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-litus-navy/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3">
                                <p class="text-sm font-bold leading-tight text-white">{{ $member['name'] }}</p>
                            </div>
                        </div>
                        <div class="px-3 py-3">
                            <p class="text-xs font-semibold text-gray-800">{{ $member['role'] }}</p>
                            @if ($member['dept'])
                                <p class="mt-0.5 text-xs text-gray-400">{{ $member['dept'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- OPERATION TEAM --}}
    <section class="bg-litus-navy py-16">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-10 px-4 sm:px-6 lg:flex-row lg:gap-14">
            <div class="w-full lg:w-3/5">
                <img src="https://images.unsplash.com/photo-1573496774426-fe3db3dd1731?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=900&q=80"
                     alt="LITUS Operation Team"
                     class="h-72 w-full rounded-2xl object-cover shadow-2xl lg:h-96">
            </div>

            <div class="text-center lg:w-2/5 lg:text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our People</span>
                <h2 class="mb-4 mt-2 font-display text-3xl font-black text-white lg:text-4xl">Our Operation Team</h2>
                <p class="mb-8 text-sm leading-relaxed text-gray-400">
                    Meet the LITUS Automobiles team, a passionate ensemble of dedicated professionals committed to elevating your motorcycle experience. With a wealth of knowledge and a shared drive to help every rider, our team is here to guide you, answer your questions, and keep your journey smooth from selection to service.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($opStats as $stat)
                        <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                            <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-full bg-litus-red/15">
                                <x-litus-icon :name="$stat['icon']" class="h-4 w-4 text-litus-red" />
                            </div>
                            <p class="text-lg font-black text-white">{{ $stat['value'] }}</p>
                            <p class="mt-0.5 text-xs text-gray-400">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- SHOWROOMS & SERVICE CENTERS --}}
    <section id="locations" class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Locations</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Our Showrooms &amp; Service Centers</h2>
                <p class="mx-auto mt-2 max-w-xl text-gray-500">Visit our showrooms and service centers across the Maldives for motorcycles, genuine parts, and trusted support.</p>
            </div>

            <div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach (array_filter($showrooms, fn ($s) => $s['featured']) as $showroom)
                    <div class="group overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $showroom['img'] }}"
                                 alt="{{ $showroom['name'] }}"
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-litus-navy/70 via-transparent to-transparent"></div>
                            <span class="absolute left-3 top-3 rounded-full bg-litus-red px-2.5 py-1 text-xs font-bold text-white">Featured</span>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-black text-gray-900">{{ $showroom['name'] }}</h3>
                            <p class="mt-1 flex items-center gap-1.5 text-sm text-gray-500">
                                <x-litus-icon name="map-pin" class="h-[13px] w-[13px] text-litus-red" />
                                {{ $showroom['address'] }}
                            </p>
                            <div class="mt-4 flex items-center gap-3">
                                <a href="#" class="rounded-full bg-litus-red px-5 py-2 text-sm font-bold text-white">Contact Now</a>
                                <a href="#" class="flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-gray-800">
                                    View on Map
                                    <x-litus-icon name="arrow-right" class="h-3 w-3" />
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (array_filter($showrooms, fn ($s) => ! $s['featured']) as $showroom)
                    <div class="group overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition-shadow hover:shadow-md">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ $showroom['img'] }}"
                                 alt="{{ $showroom['name'] }}"
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-4">
                            <h3 class="text-base font-black text-gray-900">{{ $showroom['name'] }}</h3>
                            <p class="mt-1 flex items-start gap-1.5 text-xs leading-snug text-gray-500">
                                <x-litus-icon name="map-pin" class="mt-0.5 h-[11px] w-[11px] shrink-0 text-litus-red" />
                                {{ $showroom['address'] }}
                            </p>
                            <div class="mt-3 flex items-center gap-3">
                                <a href="#" class="rounded-full bg-litus-red px-4 py-1.5 text-xs font-bold text-white">Contact Now</a>
                                <a href="#" class="flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-gray-700">
                                    Map
                                    <x-litus-icon name="arrow-right" class="h-[11px] w-[11px]" />
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="bg-litus-navy py-14">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6">
            <div class="mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-litus-red/15">
                <x-litus-icon name="map-pin" class="h-[22px] w-[22px] text-litus-red" />
            </div>
            <h2 class="mb-3 font-display text-3xl font-black text-white lg:text-4xl">Looking for the Nearest LITUS Showroom?</h2>
            <p class="mb-8 text-gray-400">Our team is ready to help you find the right motorcycle, parts, or service support.</p>
            <div class="flex flex-col justify-center gap-3 sm:flex-row">
                <a href="#" class="rounded-full bg-litus-red px-8 py-3 text-sm font-bold text-white">Contact Us</a>
                <a href="#locations" class="rounded-full border border-white/30 px-8 py-3 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">View Locations</a>
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
