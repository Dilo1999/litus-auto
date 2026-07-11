@extends('layouts.litus')

@section('title', 'Motorcycles — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

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
    <section class="relative min-h-[680px] overflow-hidden border border-[rgba(27,74,120,0.45)] bg-[#06101c] pb-[82px] max-md:min-h-0 max-md:pb-0 max-[1100px]:min-h-0 max-[1100px]:pb-8">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right] max-md:object-[center_30%]"
             aria-hidden="true">

        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(3,11,22,0.98)_0%,rgba(3,11,22,0.88)_32%,rgba(3,11,22,0.48)_58%,rgba(3,11,22,0.25)_100%)] max-md:bg-[linear-gradient(180deg,rgba(11,22,40,0.55)_0%,rgba(11,22,40,0.78)_42%,rgba(11,22,40,0.92)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_70%_35%,rgba(255,255,255,0.08),transparent_28%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.1),rgba(2,10,19,0.95))]"></div>

        <div class="relative z-[2] litus-container pb-12 pt-16 max-md:pb-5 max-md:pt-16 sm:pt-20">
            <div class="max-w-[720px] text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] max-md:mb-1.5 max-md:text-[10px] max-md:tracking-[0.18em] sm:text-lg">
                    Explore Our Collection
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:mb-2 max-md:text-[1.7rem] max-md:leading-[1.12]">
                    Find the Perfect Ride<br>
                    <span class="text-litus-red">for Your Journey</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] max-md:mb-3.5 max-md:max-w-[34ch] max-md:text-[13px] max-md:leading-snug sm:text-lg sm:leading-[1.55]">
                    Browse the latest motorcycles and scooters from LITUS Automobiles, with limited-time offers, flexible ownership plans, and trusted after-sales support.
                </p>

                <div class="flex flex-col items-stretch justify-start gap-2.5 max-md:w-full max-md:flex-row max-md:gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7">
                    <a href="#inventory"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        View Motorcycles
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                    <a href="tel:+9603331234"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Contact Sales Team
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
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
                           class="w-full rounded-xl border border-gray-200 py-2.5 pl-10 pr-4 text-sm text-gray-700 placeholder-gray-400 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                </div>

                <div class="flex shrink-0 items-center gap-1 rounded-xl bg-gray-100 p-1 max-lg:w-full max-lg:flex-wrap">
                    <button type="button"
                            data-motorcycle-brand="All"
                            class="rounded-lg px-4 py-2 text-sm font-bold transition-all bg-litus-red text-white max-lg:min-h-10">
                        All
                    </button>
                    @foreach ($brands as $brand)
                        <button type="button"
                                data-motorcycle-brand="{{ $brand }}"
                                class="rounded-lg px-4 py-2 text-sm font-bold text-gray-500 transition-all max-lg:min-h-10">
                            {{ $brand }}
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
                Showing <span class="font-bold text-gray-800" data-motorcycle-count>{{ $motorcycles->count() }}</span> motorcycles
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
                @forelse ($motorcycles as $motorcycle)
                    <x-card.motorcycle-card :motorcycle="$motorcycle" />
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500">
                        <p class="font-semibold">No motorcycles available yet.</p>
                        <p class="mt-1 text-sm">Check back soon or contact our sales team.</p>
                    </div>
                @endforelse
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
                <a href="{{ route('ownership-plans') }}" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">View Ownership Plans</a>
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
                    <div class="rounded-2xl border border-gray-100 p-6 text-center transition-all hover:border-blue-100 hover:shadow-md">
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
