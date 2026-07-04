@extends('layouts.litus')

@section('title', 'Motorcycles — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

    $products = [
        ['id' => 1,  'name' => 'ADV 160 2026',               'slug' => 'adv-160-2026', 'brand' => 'Honda',  'discount' => 'MVR 16,750', 'cc' => '160cc', 'img' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 2,  'name' => 'ADV 160 2026',               'slug' => 'adv-160-2026', 'brand' => 'Honda',  'discount' => 'MVR 16,750', 'cc' => '160cc', 'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 3,  'name' => 'PCX 160 ABS',                'slug' => 'pcx-160-abs', 'brand' => 'Honda',  'discount' => 'MVR 11,000', 'cc' => '160cc', 'img' => 'https://images.unsplash.com/photo-1611956292173-c2445aa61709?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 4,  'name' => 'N Max 155 Neo S',            'slug' => 'n-max-155-neo-s', 'brand' => 'Yamaha', 'discount' => 'MVR 14,100', 'cc' => '155cc', 'img' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 5,  'name' => 'Aerox Alpha 155 Standard',   'slug' => 'aerox-alpha-155-standard', 'brand' => 'Yamaha', 'discount' => 'MVR 12,500', 'cc' => '155cc', 'img' => 'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 6,  'name' => 'Scoopy Prestige 2026',       'slug' => 'scoopy-prestige-2026', 'brand' => 'Honda',  'discount' => 'MVR 14,000', 'cc' => '110cc', 'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 7,  'name' => 'Scoopy Fashion 2026',        'slug' => 'scoopy-fashion-2026', 'brand' => 'Honda',  'discount' => 'MVR 12,000', 'cc' => '110cc', 'img' => 'https://images.unsplash.com/photo-1598077737122-925e6f7cf137?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 8,  'name' => 'Scoopy Stylish 2026',        'slug' => 'scoopy-stylish-2026', 'brand' => 'Honda',  'discount' => 'MVR 14,000', 'cc' => '110cc', 'img' => 'https://images.unsplash.com/photo-1772090095175-ef442d5f56a8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 9,  'name' => 'Scoopy Prestige 2026',       'slug' => 'scoopy-prestige-2026', 'brand' => 'Honda',  'discount' => 'MVR 11,500', 'cc' => '110cc', 'img' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 10, 'name' => 'Scoopy Club 12 2026',        'slug' => 'scoopy-club-12-2026', 'brand' => 'Honda',  'discount' => 'MVR 13,500', 'cc' => '110cc', 'img' => 'https://images.unsplash.com/photo-1585210256590-fc52fd1e8348?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 11, 'name' => 'Air Blade 125 Sport 2026',   'slug' => 'air-blade-125-sport-2026', 'brand' => 'Honda',  'discount' => 'MVR 14,400', 'cc' => '125cc', 'img' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 12, 'name' => 'Air Blade 125 Special 2026', 'slug' => 'air-blade-125-special-2026', 'brand' => 'Honda',  'discount' => 'MVR 12,900', 'cc' => '125cc', 'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
        ['id' => 13, 'name' => 'Air Blade 125 Standard 2026','slug' => 'air-blade-125-standard-2026', 'brand' => 'Honda',  'discount' => 'MVR 12,900', 'cc' => '125cc', 'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80'],
    ];

    $heroFeatures = [
        ['icon' => 'star', 'title' => 'Limited Offers', 'desc' => 'Seasonal deals on top models'],
        ['icon' => 'package', 'title' => 'Flexible Plans', 'desc' => 'Ownership for every budget'],
        ['icon' => 'check-circle', 'title' => 'Genuine Brands', 'desc' => 'Honda & Yamaha certified'],
        ['icon' => 'wrench', 'title' => 'Service Support', 'desc' => 'Expert after-sales care'],
    ];

    $whyLitus = [
        ['icon' => 'check-circle', 'title' => 'Genuine Motorcycles', 'desc' => 'Every bike is 100% brand-authentic and quality-verified.'],
        ['icon' => 'package', 'title' => 'Easy Applications', 'desc' => 'Simple ID-based lease process via social media platforms.'],
        ['icon' => 'star', 'title' => 'Flexible Ownership', 'desc' => 'Upfront or installment plans tailored for every budget.'],
        ['icon' => 'wrench', 'title' => 'Reliable After-Sales', 'desc' => 'Experienced mechanics and genuine spare parts always ready.'],
    ];
@endphp

<div class="font-sans" data-motorcycles-page>

    <x-litus-header active="Motorcycles" />

    {{-- HERO --}}
    <section class="relative min-h-[680px] overflow-hidden border border-[rgba(27,74,120,0.45)] bg-[#06101c] pb-[82px] max-[1100px]:min-h-0 max-[1100px]:pb-8">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">

        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(3,11,22,0.98)_0%,rgba(3,11,22,0.88)_32%,rgba(3,11,22,0.48)_58%,rgba(3,11,22,0.25)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_70%_35%,rgba(255,255,255,0.08),transparent_28%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.1),rgba(2,10,19,0.95))]"></div>

        <div class="relative z-[2] litus-container pt-16 pb-12 sm:pt-20">
            <div class="max-w-[720px] text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#ff1029] sm:text-lg max-md:text-[15px]">
                    Explore Our Collection
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:text-[2.25rem]">
                    Find the Perfect Ride<br>
                    <span class="text-litus-red">for Your Journey</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55] max-md:text-[17px]">
                    Browse the latest motorcycles and scooters from LITUS Automobiles, with limited-time offers, flexible ownership plans, and trusted after-sales support.
                </p>

                <div class="flex flex-row flex-wrap items-center justify-start gap-5 sm:gap-7">
                    <a href="#inventory"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] bg-[#f20d23] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(242,13,35,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9091c] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        View Motorcycles
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                    <a href="tel:+9603331234"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#f20d23] hover:bg-[rgba(242,13,35,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Contact Sales Team
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-[3] border-t border-white/12 bg-[rgba(3,13,25,0.78)] backdrop-blur-sm max-[1100px]:relative max-[1100px]:mt-5">
            <div class="litus-container">
                <div class="grid min-h-[76px] grid-cols-1 min-[1100px]:grid-cols-4 max-[1100px]:min-[701px]:grid-cols-2">
                    @foreach ($heroFeatures as $index => $feature)
                        <div @class([
                            'relative flex items-center gap-3 py-3 sm:gap-3.5 min-[1100px]:py-3.5',
                            'border-b border-white/12 max-md:border-b' => $index < count($heroFeatures) - 1,
                            'max-md:last:border-b-0',
                            'min-[1100px]:border-r min-[1100px]:border-white/16 min-[1100px]:pr-4' => $index < count($heroFeatures) - 1,
                            'min-[1100px]:pl-0' => $index === 0,
                            'min-[1100px]:pl-4' => $index > 0,
                            'max-[1100px]:min-[701px]:border-r max-[1100px]:min-[701px]:border-white/16' => in_array($index, [0, 2]),
                            'max-[1100px]:min-[701px]:border-b max-[1100px]:min-[701px]:border-white/12' => in_array($index, [0, 1]),
                            'max-[1100px]:min-[701px]:border-r-0' => $index === 1,
                        ])>
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-white/35 text-white shadow-[0_0_16px_rgba(255,255,255,0.06)] sm:h-10 sm:w-10">
                                <x-litus-icon :name="$feature['icon']" class="h-4 w-4 sm:h-[18px] sm:w-[18px]" />
                            </div>
                            <div class="min-w-0 text-left">
                                <h3 class="mb-0.5 text-sm font-extrabold leading-tight text-white sm:text-[15px]">{{ $feature['title'] }}</h3>
                                <p class="text-xs font-medium leading-snug text-[#c9d4df] sm:text-[13px]">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- FILTER BAR --}}
    <section class="border-b border-gray-200 bg-gray-50 py-8">
        <div class="litus-container">
            <div class="flex flex-col items-start gap-4 rounded-2xl bg-white p-5 shadow-md lg:flex-row lg:items-center">
                <div class="relative w-full flex-1">
                    <x-litus-icon name="search" class="absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" />
                    <input type="text"
                           data-motorcycle-search
                           placeholder="Search motorcycles..."
                           class="w-full rounded-xl border border-gray-200 py-2.5 pl-10 pr-4 text-sm text-gray-700 placeholder-gray-400 outline-none transition-all focus:border-red-400 focus:ring-2 focus:ring-red-100">
                </div>

                <div class="flex shrink-0 items-center gap-1 rounded-xl bg-gray-100 p-1">
                    @foreach (['All', 'Honda', 'Yamaha'] as $tab)
                        <button type="button"
                                data-motorcycle-brand="{{ $tab }}"
                                class="rounded-lg px-4 py-2 text-sm font-bold transition-all {{ $tab === 'All' ? 'bg-litus-red text-white' : 'text-gray-500' }}">
                            {{ $tab }}
                        </button>
                    @endforeach
                </div>

                <div class="flex shrink-0 flex-wrap gap-2">
                    @foreach (['Engine Capacity', 'Price Range', 'Availability'] as $filter)
                        <button type="button" class="flex items-center gap-1.5 rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm text-gray-600 transition-colors hover:border-gray-400">
                            {{ $filter }}
                            <x-litus-icon name="chevron-down" class="h-[13px] w-[13px]" />
                        </button>
                    @endforeach
                    <div class="relative">
                        <select class="cursor-pointer appearance-none rounded-xl border border-gray-200 bg-white py-2 pl-3 pr-8 text-sm text-gray-600 outline-none">
                            <option>Sort by Latest</option>
                            <option>Sort by Price</option>
                            <option>Sort by Popular</option>
                        </select>
                        <x-litus-icon name="chevron-down" class="pointer-events-none absolute right-2.5 top-1/2 h-[13px] w-[13px] -translate-y-1/2 text-gray-400" />
                    </div>
                </div>
            </div>

            <p class="mt-3 pl-1 text-sm text-gray-500">
                Showing <span class="font-bold text-gray-800" data-motorcycle-count>{{ count($products) }}</span> motorcycles
                <span data-motorcycle-brand-wrap class="hidden">in <span class="font-bold text-gray-800" data-motorcycle-brand-label></span></span>
            </p>
        </div>
    </section>

    {{-- PRODUCT GRID --}}
    <section id="inventory" class="bg-gray-50 py-14">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Inventory</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Explore Our Ride Collection</h2>
                <p class="mt-2 text-gray-500">Choose from our latest motorcycles and scooters with exclusive promotional offers.</p>
            </div>

            <div class="hidden py-20 text-center text-gray-400" data-motorcycle-empty>
                <x-litus-icon name="search" class="mx-auto mb-3 h-10 w-10 opacity-40" />
                <p class="font-semibold">No motorcycles found</p>
                <p class="mt-1 text-sm">Try a different search or filter.</p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-motorcycle-grid>
                @foreach ($products as $product)
                    <div class="group flex flex-col overflow-hidden rounded-[18px] border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:border-red-100 hover:shadow-xl"
                         data-motorcycle-card
                         data-brand="{{ $product['brand'] }}"
                         data-name="{{ $product['name'] }}">
                        <div class="relative overflow-hidden bg-gray-100">
                            <img src="{{ $product['img'] }}"
                                 alt="{{ $product['name'] }}"
                                 class="h-48 w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute left-3 top-3 rounded-md bg-litus-red px-2.5 py-1 text-xs font-black text-white shadow">Limited Offer</span>
                            <span class="absolute right-3 top-3 rounded-md bg-white/90 px-2 py-1 text-xs font-bold text-gray-600 shadow">{{ $product['brand'] }}</span>
                        </div>
                        <div class="flex flex-1 flex-col p-4">
                            <p class="mb-0.5 text-xs font-semibold text-gray-400">{{ $product['cc'] }} Engine</p>
                            <h3 class="mb-2 text-base font-black leading-tight text-gray-900">{{ $product['name'] }}</h3>
                            <div class="mb-4 flex items-center gap-1.5">
                                <span class="text-xs text-gray-400">Save up to</span>
                                <span class="text-lg font-black text-litus-red">{{ $product['discount'] }}</span>
                            </div>
                            <div class="mt-auto flex flex-col gap-2">
                                <a href="{{ route('motorcycle.show', $product['slug']) }}"
                                   class="w-full rounded-xl bg-litus-navy py-2.5 text-center text-sm font-bold text-white transition-opacity hover:opacity-90">Buy Now</a>
                                <a href="{{ route('motorcycle.show', $product['slug']) }}"
                                   class="w-full rounded-xl border border-gray-200 py-2 text-center text-sm font-semibold text-gray-600 transition-colors hover:border-gray-400 hover:text-gray-900">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <div class="flex items-center gap-2">
                    @foreach ([1, 2, 3] as $n)
                        <button type="button" class="h-9 w-9 rounded-full text-sm font-bold transition-all {{ $n === 1 ? 'bg-litus-red text-white shadow' : 'text-gray-500 hover:bg-gray-100' }}">{{ $n }}</button>
                    @endforeach
                    <span class="px-1 text-gray-400">…</span>
                    <button type="button" class="flex items-center gap-1 rounded-full px-4 py-2 text-sm font-bold text-gray-500 hover:bg-gray-100">
                        Next
                        <x-litus-icon name="arrow-right" class="h-[13px] w-[13px]" />
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="bg-litus-navy py-16">
        <div class="mx-auto flex max-w-5xl flex-col items-center gap-8 px-4 sm:px-6 lg:flex-row lg:gap-16">
            <div class="flex-1 text-center lg:text-left">
                <h2 class="mb-3 font-display text-3xl font-black text-white lg:text-4xl">
                    Need Help Choosing the<br>
                    <span class="text-litus-red">Right Motorcycle?</span>
                </h2>
                <p class="leading-relaxed text-gray-400">
                    Our sales team can help you compare models, understand ownership plans, and choose the best ride for your lifestyle.
                </p>
            </div>
            <div class="flex shrink-0 flex-col gap-3 sm:flex-row">
                <a href="tel:+9603331234" class="rounded-full bg-litus-red px-8 py-3.5 text-sm font-bold text-white">Talk to Sales</a>
                <a href="#" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">View Ownership Plans</a>
            </div>
        </div>
    </section>

    {{-- WHY LITUS --}}
    <section class="bg-white py-14">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Promise</span>
                <h2 class="mt-2 font-display text-2xl font-black text-gray-900 lg:text-3xl">Why Buy from LITUS Automobiles?</h2>
            </div>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($whyLitus as $item)
                    <div class="rounded-2xl border border-gray-100 p-6 text-center transition-all hover:border-red-100 hover:shadow-md">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-litus-red/10">
                            <x-litus-icon :name="$item['icon']" class="h-[22px] w-[22px] text-litus-red" />
                        </div>
                        <h3 class="mb-2 text-base font-black text-gray-900">{{ $item['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
