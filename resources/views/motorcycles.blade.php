@extends('layouts.litus')

@section('title', 'Motorcycles - LITUS Automobiles')

@section('content')
@php
    $motorcycles = $motorcycles ?? collect();
    $brands = $brands ?? collect();
    $categories = $categories ?? collect();
    $promoCount = $promoCount ?? 0;
    $modelCount = $motorcycles->count();
    $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));

    $heroFeatures = [
        ['icon' => 'bike', 'title' => $modelCount.' Models', 'desc' => 'Honda, Yamaha and more'],
        ['icon' => 'shopping-bag', 'title' => $promoCount.' In Campaigns', 'desc' => 'Covered by a promotion now'],
        ['icon' => 'shield', 'title' => 'Genuine Units', 'desc' => 'Factory-built, fully supported'],
        ['icon' => 'file-text', 'title' => 'Ijara Ready', 'desc' => 'Every model, six plans'],
    ];

    $buyingGuide = [
        [
            'title' => '110cc - 125cc',
            'text' => 'Right for daily riding inside Malé and Hulhumalé. Light, easy to park, cheapest to run. If most journeys are under fifteen minutes, start here.',
            'models' => ['Scoopy', 'Vision', 'Fazzio'],
        ],
        [
            'title' => '155cc - 160cc',
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

    {{-- HERO — desktop --}}
    <section class="relative hidden overflow-hidden bg-litus-ink text-white min-[961px]:block">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)]"></div>
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
                <h1 class="font-display text-[clamp(29px,4.6vw,56px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    Find the ride<br>for your journey.
                </h1>
                <p class="mt-4 max-w-[560px] text-[clamp(15.5px,1.5vw,19px)] leading-[1.66] text-white/[0.78] sm:mt-5">
                    Honda and Yamaha models, from 110cc city scooters to 160cc adventure machines. Filter by brand, budget or engine size - every card shows which campaigns that motorcycle is currently in.
                </p>
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
             class="absolute inset-0 h-full w-full object-cover object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.18]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px;"></div>

        <div class="relative z-[3] flex flex-col">
            <div class="litus-container pt-24 pb-4">
                <div class="max-w-[36rem]">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">The Range</span>
                    <h1 class="max-w-[16ch] font-display text-[clamp(1.85rem,7.2vw,2.25rem)] font-extrabold leading-[1.1] tracking-[-0.032em]">
                        Find the ride for your journey.
                    </h1>
                    <p class="mt-3 line-clamp-3 max-w-[36ch] text-[14px] leading-[1.62] text-white/[0.72]">
                        Honda and Yamaha from 110cc city scooters to 160cc adventure machines. Filter by brand, budget or engine size.
                    </p>
                    <a href="#inventory"
                       class="mt-5 inline-flex min-h-11 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-5 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:bg-litus-primary-hover">
                        Browse Models
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                </div>
            </div>

            <x-litus-hero-features :features="$heroFeatures" />
        </div>
    </section>

    {{-- FILTER BAR --}}
    <section class="sticky top-[72px] z-[100] border-b border-litus-line bg-white/[0.97] py-3 backdrop-blur-[12px] sm:py-[15px]"
             id="inventory">
        <div class="litus-container flex flex-wrap items-center gap-3 sm:gap-3.5">
            <div class="flex w-full gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:flex-wrap sm:overflow-visible sm:pb-0"
                 data-motorcycle-chips
                 role="group"
                 aria-label="Filter by category">
                <button type="button"
                        data-motorcycle-category="all"
                        aria-pressed="true"
                        class="inline-flex shrink-0 items-center gap-2 rounded-full border-[1.5px] border-litus-ink bg-litus-ink px-3.5 py-2 text-[13px] font-semibold text-white transition sm:px-4 sm:text-[13.5px]">
                    All Models
                    <span class="rounded-full bg-white/20 px-1.5 py-px text-[11px] font-bold" data-motorcycle-chip-count>{{ $modelCount }}</span>
                </button>
                @foreach ($categories as $category)
                    <button type="button"
                            data-motorcycle-category="{{ $category }}"
                            aria-pressed="false"
                            class="inline-flex shrink-0 items-center gap-2 rounded-full border-[1.5px] border-litus-line-2 bg-white px-3.5 py-2 text-[13px] font-semibold text-litus-text-2 transition hover:border-litus-primary-light hover:text-litus-primary sm:px-4 sm:text-[13.5px]">
                        {{ $category }}
                        <span class="rounded-full bg-litus-paper-3 px-1.5 py-px text-[11px] font-bold text-litus-text-2">
                            {{ $motorcycles->where('category', $category)->count() }}
                        </span>
                    </button>
                @endforeach
            </div>

            <div class="grid w-full grid-cols-2 gap-2 sm:ml-auto sm:flex sm:w-auto sm:flex-wrap sm:gap-2.5">
                <div class="litus-select-wrap min-w-0">
                    <select data-motorcycle-brand
                            class="litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3 pr-10 text-[13px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] sm:pl-3.5 sm:text-[13.5px]">
                        <option value="all">All Brands</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                </div>

                <div class="litus-select-wrap min-w-0">
                    <select data-motorcycle-engine
                            class="litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3 pr-10 text-[13px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] sm:pl-3.5 sm:text-[13.5px]">
                        <option value="all">Any Engine Size</option>
                        <option value="110">Up to 110cc</option>
                        <option value="125">Up to 125cc</option>
                        <option value="160">Up to 160cc</option>
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                </div>

                <div class="litus-select-wrap col-span-2 min-w-0 sm:col-span-1">
                    <select data-motorcycle-sort
                            class="litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3 pr-10 text-[13px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] sm:pl-3.5 sm:text-[13.5px]">
                        <option value="popular">Sort: Popularity</option>
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="promotion">In Campaigns First</option>
                        <option value="latest">Sort: Latest</option>
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                </div>
            </div>
        </div>
    </section>

    {{-- PRODUCT GRID --}}
    <section class="bg-white pb-[clamp(48px,7.5vw,116px)] pt-0">
        <div class="litus-container">
            <div class="flex flex-wrap items-center justify-between gap-3 pb-1 pt-4 sm:pt-[26px]">
                <b class="text-[14px] text-litus-text sm:text-[15px]">
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

            <div class="grid grid-cols-1 gap-4 pt-5 min-[400px]:grid-cols-2 sm:gap-[22px] xl:grid-cols-4"
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
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Buying Guide</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Not sure which size you need?</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    A short, honest guide to picking the right engine size for how you actually ride.
                </p>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden md:grid-cols-3">
                    @foreach ($buyingGuide as $guide)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="h-full rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-[26px] sm:py-[30px] sm:shadow-none md:hover:border-litus-line-2 md:hover:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                                <h4 class="mb-2 font-display text-[17px] font-semibold tracking-[-0.02em] text-litus-text sm:mb-2.5 sm:text-[clamp(20px,2.2vw,26px)]">{{ $guide['title'] }}</h4>
                                <p class="mb-3 text-[13px] leading-relaxed text-litus-text-2 sm:mb-4 sm:text-[14.5px] sm:leading-normal">{{ $guide['text'] }}</p>
                                <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                    @foreach ($guide['models'] as $model)
                                        <span class="rounded-full bg-litus-paper-3 px-3 py-1 text-[11.5px] font-semibold text-litus-text-2 sm:px-3.5 sm:py-1.5 sm:text-[12.5px]">{{ $model }}</span>
                                    @endforeach
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($buyingGuide) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($buyingGuide as $index => $guide)
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

    {{-- IJARA BAND --}}
    <x-litus-ijara-band />

    {{-- CTA BAND — hidden on mobile (footer has contact actions) --}}
    <section class="litus-sec-tight bg-litus-ink text-white max-md:hidden">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Still deciding between two models?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our sales team compares them with you honestly - including the reasons you might want the cheaper one.
                </p>
            </div>
            <div class="litus-cta-row">
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
