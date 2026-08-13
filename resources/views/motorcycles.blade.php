@extends('layouts.litus')

@section('title', 'Motorcycles — LITUS Automobiles')

@section('content')
@php
    $motorcycles = $motorcycles ?? collect();
    $brands = $brands ?? collect();
    $categories = $categories ?? collect();
    $promoCount = $promoCount ?? 0;
    $modelCount = $motorcycles->count();
    $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

    $heroStrip = [
        ['icon' => 'bike', 'title' => $modelCount.' Models', 'sub' => 'Honda, Yamaha and more'],
        ['icon' => 'shopping-bag', 'title' => $promoCount.' In Campaigns', 'sub' => 'Covered by a promotion now'],
        ['icon' => 'shield', 'title' => 'Genuine Units', 'sub' => 'Factory-built, fully supported'],
        ['icon' => 'file-text', 'title' => 'Ijara Ready', 'sub' => 'Every model, six plans'],
    ];

    $buyingGuide = [
        [
            'title' => '110cc – 125cc',
            'text' => 'Right for daily riding inside Malé and Hulhumalé. Light, easy to park, cheapest to run. If most journeys are under fifteen minutes, start here.',
            'models' => ['Scoopy', 'Vision', 'Fazzio'],
        ],
        [
            'title' => '155cc – 160cc',
            'text' => 'Right if you use the link road regularly, carry a passenger often, or want ABS. More comfortable at speed, heavier to manoeuvre.',
            'models' => ['Air Blade', 'PCX', 'N Max'],
        ],
        [
            'title' => 'Adventure & Sport',
            'text' => 'Right if road surfaces are rough where you ride, or you want the sharper handling and suspension travel. A specialist choice.',
            'models' => ['ADV 160', 'Aerox 155'],
        ],
    ];
@endphp

<div class="font-sans" data-motorcycles-page>

    <x-litus-header active="Motorcycles" />

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-litus-ink text-white">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right] max-md:object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)] max-md:bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.28), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.55) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.28]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(70px,9vw,124px)] pb-[clamp(56px,7vw,96px)]">
            <div class="max-w-[820px]">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">The Range</span>
                <h1 class="font-display text-[clamp(32px,4.6vw,56px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    Find the ride<br>for your journey.
                </h1>
                <p class="mt-5 max-w-[560px] text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.78]">
                    Honda and Yamaha models, from 110cc city scooters to 160cc adventure machines. Filter by brand, budget or engine size — every card shows which campaigns that motorcycle is currently in.
                </p>
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

    {{-- FILTER BAR --}}
    <section class="sticky top-[72px] z-[100] border-b border-litus-line bg-white/[0.97] py-[15px] backdrop-blur-[12px] max-[820px]:static"
             id="inventory">
        <div class="litus-container flex flex-wrap items-center gap-3.5">
            <div class="flex flex-wrap gap-2 max-[820px]:w-full max-[820px]:flex-nowrap max-[820px]:overflow-x-auto max-[820px]:pb-1 max-[820px]:[scrollbar-width:none] max-[820px]:[&::-webkit-scrollbar]:hidden"
                 data-motorcycle-chips
                 role="group"
                 aria-label="Filter by category">
                <button type="button"
                        data-motorcycle-category="all"
                        aria-pressed="true"
                        class="inline-flex shrink-0 items-center gap-2 rounded-full border-[1.5px] border-litus-ink bg-litus-ink px-4 py-2 text-[13.5px] font-semibold text-white transition">
                    All Models
                    <span class="rounded-full bg-white/20 px-1.5 py-px text-[11px] font-bold" data-motorcycle-chip-count>{{ $modelCount }}</span>
                </button>
                @foreach ($categories as $category)
                    <button type="button"
                            data-motorcycle-category="{{ $category }}"
                            aria-pressed="false"
                            class="inline-flex shrink-0 items-center gap-2 rounded-full border-[1.5px] border-litus-line-2 bg-white px-4 py-2 text-[13.5px] font-semibold text-litus-text-2 transition hover:border-litus-primary-light hover:text-litus-primary">
                        {{ $category }}
                        <span class="rounded-full bg-litus-paper-3 px-1.5 py-px text-[11px] font-bold text-litus-text-2">
                            {{ $motorcycles->where('category', $category)->count() }}
                        </span>
                    </button>
                @endforeach
            </div>

            <div class="ml-auto flex flex-wrap gap-2.5 max-[820px]:ml-0 max-[820px]:w-full max-[820px]:grid max-[820px]:grid-cols-2">
                <select data-motorcycle-brand
                        class="cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3.5 pr-9 text-[13.5px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] max-[820px]:w-full">
                    <option value="all">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                </select>

                <select data-motorcycle-engine
                        class="cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3.5 pr-9 text-[13.5px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] max-[820px]:w-full">
                    <option value="all">Any Engine Size</option>
                    <option value="110">Up to 110cc</option>
                    <option value="125">Up to 125cc</option>
                    <option value="160">Up to 160cc</option>
                </select>

                <select data-motorcycle-sort
                        class="cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3.5 pr-9 text-[13.5px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] max-[820px]:col-span-2 max-[820px]:w-full">
                    <option value="popular">Sort: Popularity</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="promotion">In Campaigns First</option>
                    <option value="latest">Sort: Latest</option>
                </select>
            </div>
        </div>
    </section>

    {{-- PRODUCT GRID --}}
    <section class="bg-white pb-[clamp(62px,7.5vw,116px)] pt-0">
        <div class="litus-container">
            <div class="flex flex-wrap items-center justify-between gap-3 pb-1.5 pt-[26px]">
                <b class="text-[15px] text-litus-text">
                    Showing <span data-motorcycle-count>{{ $modelCount }}</span> model<span data-motorcycle-count-suffix>{{ $modelCount === 1 ? '' : 's' }}</span>
                </b>
                <button type="button"
                        data-motorcycle-reset
                        class="hidden items-center gap-2 rounded-full border-[1.5px] border-litus-line-2 bg-white px-4 py-2 text-[13.5px] font-semibold text-litus-text-2 transition hover:border-litus-primary-light hover:text-litus-primary">
                    ✕ Clear filters
                </button>
            </div>

            <div class="hidden rounded-[18px] border-[1.5px] border-dashed border-litus-line-2 px-6 py-16 text-center text-litus-text-2"
                 data-motorcycle-empty>
                <x-litus-icon name="search" class="mx-auto mb-3 h-10 w-10 opacity-40" />
                <p class="font-semibold text-litus-text">No motorcycles found</p>
                <p class="mt-1 text-sm">Try a different brand, category, or engine size.</p>
            </div>

            <div class="grid grid-cols-1 gap-[22px] pt-5 sm:grid-cols-2 xl:grid-cols-4"
                 data-motorcycle-grid>
                @forelse ($motorcycles as $motorcycle)
                    <x-card.motorcycle-card :motorcycle="$motorcycle" />
                @empty
                    <div class="col-span-full rounded-[18px] border border-dashed border-litus-line-2 px-6 py-16 text-center text-litus-text-2">
                        <p class="font-semibold text-litus-text">No motorcycles available yet.</p>
                        <p class="mt-1 text-sm">Check back soon or contact our sales team.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BUYING GUIDE --}}
    <section class="litus-sec bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Buying Guide</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Not sure which size you need?</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    A short, honest guide to picking the right engine size for how you actually ride.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($buyingGuide as $guide)
                    <div class="rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px] transition duration-200 hover:border-litus-line-2 hover:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                        <h4 class="mb-2.5 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">{{ $guide['title'] }}</h4>
                        <p class="mb-4 text-[14.5px] text-litus-text-2">{{ $guide['text'] }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($guide['models'] as $model)
                                <span class="rounded-full bg-litus-paper-3 px-3.5 py-1.5 text-[12.5px] font-semibold text-litus-text-2">{{ $model }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- IJARA BAND --}}
    <x-litus-ijara-band />

    {{-- CTA BAND --}}
    <section class="litus-sec-tight bg-litus-ink text-white">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Still deciding between two models?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our sales team compares them with you honestly — including the reasons you might want the cheaper one.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Talk to Sales
                </a>
                <a href="{{ route('promotions') }}"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    See Current Campaigns
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
