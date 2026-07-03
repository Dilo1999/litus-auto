@extends('layouts.litus')

@section('title', 'ADV 160 2026 — LITUS Automobiles')

@section('content')
@php
    $galleryImages = [
        'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=900&q=80',
        'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=900&q=80',
        'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=900&q=80',
        'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=900&q=80',
    ];

    $colors = [
        ['label' => 'Green', 'hex' => '#4a7c59'],
        ['label' => 'Brown', 'hex' => '#7c5c3a'],
    ];

    $highlights = [
        ['icon' => 'gauge', 'label' => 'Engine Capacity', 'value' => '160cc'],
        ['icon' => 'fuel', 'label' => 'Fuel Tank', 'value' => '8.1L'],
        ['icon' => 'zap', 'label' => 'Fuel Type', 'value' => 'Gasoline'],
        ['icon' => 'settings', 'label' => 'Transmission', 'value' => 'Auto CVT'],
    ];

    $specs = [
        ['icon' => 'gauge', 'label' => 'Engine Capacity', 'value' => '160cc'],
        ['icon' => 'zap', 'label' => 'Fuel Type', 'value' => 'Gasoline'],
        ['icon' => 'settings', 'label' => 'Carburation', 'value' => 'Fuel Injection'],
        ['icon' => 'disc', 'label' => 'Brakes Front', 'value' => 'Disc – ABS'],
        ['icon' => 'disc', 'label' => 'Brakes Rear', 'value' => 'Disc'],
        ['icon' => 'arrow-up-down', 'label' => 'Suspension Front', 'value' => 'Telescopic Fork'],
        ['icon' => 'circle', 'label' => 'Wheels Front', 'value' => 'Cast'],
        ['icon' => 'circle', 'label' => 'Wheels Rear', 'value' => 'Cast'],
        ['icon' => 'fuel', 'label' => 'Fuel Tank Capacity', 'value' => '8.1L'],
        ['icon' => 'arrow-up-down', 'label' => 'Ground Clearance', 'value' => '165 mm'],
        ['icon' => 'shield', 'label' => 'Frame Type', 'value' => 'Double Cradle'],
        ['icon' => 'weight', 'label' => 'Net Weight', 'value' => '134 kg'],
        ['icon' => 'arrow-up-down', 'label' => 'Seat Height', 'value' => '781 mm'],
        ['icon' => 'settings', 'label' => 'Clutch', 'value' => 'Auto Centrifugal Dry'],
        ['icon' => 'settings', 'label' => 'Final Drive', 'value' => 'Belt'],
        ['icon' => 'settings', 'label' => 'Transmission', 'value' => 'Automatic CVT'],
    ];

    $ownership = [
        ['icon' => 'check-circle', 'title' => 'Easy Application', 'desc' => 'Simple ID-based process'],
        ['icon' => 'credit-card', 'title' => 'Flexible Payments', 'desc' => 'Upfront or installments'],
        ['icon' => 'headphones', 'title' => 'Quick Support', 'desc' => 'Fast response every step'],
        ['icon' => 'wrench', 'title' => 'Service Assistance', 'desc' => 'Full after-sales care'],
    ];

    $related = [
        ['name' => 'PCX 160 ABS', 'discount' => 'MVR 11,000', 'img' => 'https://images.unsplash.com/photo-1611956292173-c2445aa61709?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80', 'slug' => 'pcx-160-abs'],
        ['name' => 'N Max 155 Neo S', 'discount' => 'MVR 14,100', 'img' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80', 'slug' => 'n-max-155-neo-s'],
        ['name' => 'Scoopy Prestige 2026', 'discount' => 'MVR 14,000', 'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600&q=80', 'slug' => 'scoopy-prestige-2026'],
    ];

    $trustBadges = [
        ['icon' => 'star', 'text' => 'Limited-Time Offer'],
        ['icon' => 'credit-card', 'text' => 'Flexible Plans'],
        ['icon' => 'check-circle', 'text' => 'Genuine Motorcycle'],
        ['icon' => 'wrench', 'text' => 'Service Support'],
    ];
@endphp

<div class="font-sans">

    <x-litus-header active="Motorcycles" />

    {{-- BREADCRUMB --}}
    <div class="border-b border-white/10 bg-litus-navy">
        <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-3 text-xs text-gray-400 sm:px-6">
            <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
            <span>/</span>
            <a href="{{ route('motorcycles') }}" class="transition-colors hover:text-white">Motorcycles</a>
            <span>/</span>
            <span class="text-gray-300">ADV 160 2026</span>
        </div>
    </div>

    {{-- PRODUCT HERO --}}
    <section class="relative overflow-hidden bg-[linear-gradient(135deg,#060E1C_0%,#0B1628_60%,#0f1e35_100%)]">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(227,30,37,0.08)_0%,transparent_65%)]"></div>

        <div class="relative z-10 mx-auto flex max-w-7xl flex-col items-center gap-10 px-4 py-14 sm:px-6 lg:flex-row lg:py-20">
            <div class="text-center lg:w-[45%] lg:text-left">
                <div class="mb-4 flex flex-wrap items-center justify-center gap-2 lg:justify-start">
                    <span class="rounded-full border border-litus-red/40 bg-litus-red/10 px-3 py-1 text-xs font-bold text-litus-red">
                        Touring Bikes
                    </span>
                    <span class="rounded-full bg-litus-red px-3 py-1 text-xs font-black text-white">Limited Offer</span>
                </div>

                <h1 class="mb-6 font-display text-4xl font-black leading-none text-white sm:text-5xl lg:text-6xl">
                    ADV 160<br><span class="text-litus-red">2026</span>
                </h1>

                <div class="mb-2">
                    <p class="text-sm text-gray-400 line-through">Original: MVR 111,750.00</p>
                    <p class="mt-1 text-3xl font-black text-white">MVR 95,000.00</p>
                </div>

                <div class="mb-3 inline-flex items-center gap-2 rounded-xl border border-litus-red/30 bg-litus-red/15 px-4 py-2.5">
                    <x-litus-icon name="star" class="h-3.5 w-3.5 text-litus-red" />
                    <span class="text-sm font-black text-litus-red">Special Price: MVR 16,750 off</span>
                </div>
                <p class="mb-7 text-xs italic text-gray-400">This offer is valid for green and brown colors.</p>

                <div class="mb-7 flex flex-col justify-center gap-3 sm:flex-row lg:justify-start">
                    <button type="button" class="rounded-xl bg-litus-red px-8 py-3.5 text-sm font-black text-white">Buy Now</button>
                    <a href="tel:+9603331234" class="rounded-xl border border-white/30 px-6 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">Contact Sales Team</a>
                    <a href="#" class="flex items-center justify-center gap-1.5 rounded-xl border border-white/20 px-6 py-3.5 text-sm font-bold text-white transition-all hover:bg-white/5">
                        <x-litus-icon name="credit-card" class="h-3.5 w-3.5" />
                        Ownership Plans
                    </a>
                </div>

                <div class="mx-auto grid max-w-xs grid-cols-2 gap-2 lg:mx-0">
                    @foreach ($trustBadges as $badge)
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <x-litus-icon :name="$badge['icon']" class="h-3 w-3 text-litus-red" />
                            {{ $badge['text'] }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative flex w-full justify-center lg:w-[55%] lg:justify-end">
                <div class="relative w-full max-w-xl">
                    <div class="absolute inset-0 rounded-3xl bg-[radial-gradient(ellipse,#E31E25,transparent_70%)] opacity-15"></div>
                    <img src="{{ $galleryImages[0] }}"
                         alt="ADV 160 2026"
                         class="relative max-h-[420px] w-full object-contain drop-shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section class="bg-gray-50 py-12" data-product-gallery data-images='@json($galleryImages)'>
        <div class="mx-auto max-w-5xl px-4 sm:px-6">
            <div class="overflow-hidden rounded-2xl bg-white shadow-md">
                <div class="relative overflow-hidden bg-gray-50">
                    <img data-gallery-main
                         src="{{ $galleryImages[0] }}"
                         alt="ADV 160 2026"
                         class="h-72 w-full object-contain transition-opacity duration-300 sm:h-96">
                    <button type="button" data-gallery-prev class="absolute left-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md transition-shadow hover:shadow-lg" aria-label="Previous image">
                        <x-litus-icon name="chevron-left" class="h-[18px] w-[18px] text-gray-600" />
                    </button>
                    <button type="button" data-gallery-next class="absolute right-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-md transition-shadow hover:shadow-lg" aria-label="Next image">
                        <x-litus-icon name="chevron-right" class="h-[18px] w-[18px] text-gray-600" />
                    </button>
                    <div class="absolute left-4 top-4">
                        <span class="rounded-md bg-litus-red px-3 py-1.5 text-xs font-black text-white shadow">Limited Offer</span>
                    </div>
                </div>

                <div class="flex flex-col items-start justify-between gap-4 p-5 sm:flex-row sm:items-center">
                    <div class="flex gap-2 overflow-x-auto pb-1">
                        @foreach ($galleryImages as $index => $img)
                            <button type="button"
                                    data-gallery-thumb="{{ $index }}"
                                    class="h-16 w-16 shrink-0 overflow-hidden rounded-xl border-2 transition-all {{ $index === 0 ? 'border-litus-red' : 'border-transparent' }}">
                                <img src="{{ $img }}" alt="View {{ $index + 1 }}" class="h-full w-full object-cover">
                            </button>
                        @endforeach
                    </div>

                    <div class="shrink-0">
                        <p class="mb-2 text-xs font-bold uppercase tracking-wider text-gray-500">Select Color</p>
                        <div class="flex gap-2">
                            @foreach ($colors as $index => $color)
                                <button type="button"
                                        data-gallery-color="{{ $color['label'] }}"
                                        data-color-hex="{{ $color['hex'] }}"
                                        aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                        class="flex items-center gap-2 rounded-lg border-2 px-3 py-2 text-xs font-bold transition-all {{ $index === 0 ? 'border-litus-red bg-litus-red/10 text-litus-red' : 'border-gray-200 text-gray-500' }}"
                                        @if($index === 0) style="border-color: {{ $color['hex'] }}; color: {{ $color['hex'] }}; background-color: {{ $color['hex'] }}15;" @endif>
                                    <span class="h-4 w-4 rounded-full border border-white/30 shadow-sm" style="background-color: {{ $color['hex'] }}"></span>
                                    {{ $color['label'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- HIGHLIGHTS --}}
    <section class="bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6">
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($highlights as $item)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 text-center shadow-sm transition-shadow hover:shadow-md">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-litus-red/10">
                            <x-litus-icon :name="$item['icon']" class="h-[22px] w-[22px] text-litus-red" />
                        </div>
                        <p class="mb-1 text-xs uppercase tracking-wider text-gray-400">{{ $item['label'] }}</p>
                        <p class="text-base font-black text-gray-900">{{ $item['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SPECIFICATIONS --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-5xl px-4 sm:px-6">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Technical Details</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">ADV 160 2026 Specifications</h2>
                <p class="mt-2 text-gray-500">Explore the main features and technical specifications of this motorcycle.</p>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2">
                    @foreach ($specs as $index => $spec)
                        <div class="flex items-center gap-4 border-b border-gray-100 px-6 py-4 transition-colors hover:bg-gray-50 {{ $index % 2 === 0 ? 'sm:border-r' : '' }}">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-litus-navy/5">
                                <x-litus-icon :name="$spec['icon']" class="h-4 w-4 text-litus-navy" />
                            </div>
                            <div class="flex flex-1 items-center justify-between gap-4">
                                <span class="text-sm text-gray-500">{{ $spec['label'] }}</span>
                                <span class="text-right text-sm font-bold text-gray-900">{{ $spec['value'] }}</span>
                            </div>
                            <div class="h-5 w-1 shrink-0 rounded-full bg-litus-red/50"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- PROMO CTA --}}
    <section class="bg-litus-navy py-14">
        <div class="mx-auto max-w-5xl px-4 text-center sm:px-6">
            <span class="mb-4 inline-block rounded-full border border-litus-red/30 bg-litus-red/15 px-3 py-1 text-xs font-bold uppercase tracking-widest text-litus-red">Limited Offer</span>
            <h2 class="mb-3 font-display text-3xl font-black text-white lg:text-4xl">
                Ready to Own the <span class="text-litus-red">ADV 160 2026?</span>
            </h2>
            <p class="mx-auto mb-8 max-w-md text-gray-400">Take advantage of this limited offer and speak with our sales team today.</p>
            <div class="mb-4 flex flex-col justify-center gap-3 sm:flex-row">
                <button type="button" class="rounded-full bg-litus-red px-8 py-3.5 text-sm font-bold text-white">Buy Now</button>
                <button type="button" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">Ask About This Offer</button>
            </div>
            <p class="text-xs italic text-gray-500">Offer valid for selected colors and subject to availability.</p>
        </div>
    </section>

    {{-- OWNERSHIP PLANS --}}
    <section class="bg-gray-50 py-14">
        <div class="mx-auto max-w-5xl px-4 text-center sm:px-6">
            <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Flexible Ownership</span>
            <h2 class="mb-2 mt-2 font-display text-2xl font-black text-gray-900 lg:text-3xl">Need a Flexible Ownership Plan?</h2>
            <p class="mx-auto mb-8 max-w-lg text-sm text-gray-500">LITUS Automobiles offers simple and flexible ownership plans to help you ride your dream motorcycle with ease.</p>

            <div class="mb-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($ownership as $item)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 text-center shadow-sm transition-shadow hover:shadow-md">
                        <div class="mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-full bg-litus-red/10">
                            <x-litus-icon :name="$item['icon']" class="h-5 w-5 text-litus-red" />
                        </div>
                        <p class="mb-1 text-sm font-black text-gray-900">{{ $item['title'] }}</p>
                        <p class="text-xs text-gray-400">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <a href="#" class="inline-flex items-center gap-2 rounded-full bg-litus-navy px-8 py-3 text-sm font-bold text-white">
                View Ownership Plans
                <x-litus-icon name="arrow-right" class="h-[15px] w-[15px]" />
            </a>
        </div>
    </section>

    {{-- RELATED --}}
    <section class="bg-white py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Similar Models</span>
                <h2 class="mt-2 font-display text-2xl font-black text-gray-900 lg:text-3xl">You May Also Like</h2>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach ($related as $product)
                    <div class="group overflow-hidden rounded-[18px] border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:border-red-100 hover:shadow-xl">
                        <div class="relative overflow-hidden bg-gray-100">
                            <img src="{{ $product['img'] }}"
                                 alt="{{ $product['name'] }}"
                                 class="h-48 w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute left-3 top-3 rounded-md bg-litus-red px-2.5 py-1 text-xs font-black text-white">Limited Offer</span>
                        </div>
                        <div class="p-5">
                            <h3 class="mb-1 text-base font-black text-gray-900">{{ $product['name'] }}</h3>
                            <div class="mb-4 flex items-center gap-1.5">
                                <span class="text-xs text-gray-400">Save up to</span>
                                <span class="text-lg font-black text-litus-red">{{ $product['discount'] }}</span>
                            </div>
                            <a href="{{ route('motorcycle.show', $product['slug']) }}"
                               class="block w-full rounded-xl bg-litus-navy py-2.5 text-center text-sm font-bold text-white">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- INQUIRY CTA --}}
    <section class="bg-litus-footer py-14">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6">
            <div class="mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-litus-red/15">
                <x-litus-icon name="headphones" class="h-[22px] w-[22px] text-litus-red" />
            </div>
            <h2 class="mb-3 font-display text-2xl font-black text-white lg:text-3xl">Have Questions About This Motorcycle?</h2>
            <p class="mx-auto mb-8 max-w-md text-gray-400">Our sales team can help you with availability, pricing, ownership plans, and service support.</p>
            <div class="flex flex-col justify-center gap-3 sm:flex-row">
                <a href="tel:+9603331234" class="rounded-full bg-litus-red px-8 py-3.5 text-sm font-bold text-white">Contact Sales Team</a>
                <a href="tel:+9603331234" class="flex items-center justify-center gap-2 rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                    <x-litus-icon name="phone" class="h-[15px] w-[15px]" />
                    Call Now
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
