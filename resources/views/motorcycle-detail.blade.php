@extends('layouts.litus')

@section('title', 'ADV 160 2026 — LITUS Automobiles')

@section('content')
@php
    $productImages = [
        asset('images/product/' . rawurlencode('premium 125 blue.png')),
        asset('images/product/' . rawurlencode('premium 125 red.png')),
        asset('images/product/' . rawurlencode('special edition 125 green yellow.png')),
    ];

    $spinImageFiles = [
        'download.png',
        'download (1).png',
        'download (2).png',
        'download (3).png',
        'download (4).png',
    ];

    $spin360Dir = public_path('images/360');
    $spinImages = [];
    foreach ($spinImageFiles as $file) {
        if (is_file($spin360Dir . DIRECTORY_SEPARATOR . $file)) {
            $spinImages[] = asset('images/360/' . rawurlencode($file));
        }
    }
    if (empty($spinImages)) {
        $spinImages = $productImages;
    }

    $galleryImages = $productImages;

    $colors = [
        ['label' => 'Green', 'hex' => '#2f3c1c'],
        ['label' => 'Brown', 'hex' => '#5a3515'],
    ];

    $highlights = [
        ['icon' => 'gauge', 'label' => 'Engine Capacity', 'value' => '160cc'],
        ['icon' => 'fuel', 'label' => 'Fuel Tank Capacity', 'value' => '8.1L'],
        ['icon' => 'zap', 'label' => 'Fuel Type', 'value' => 'Gasoline'],
        ['icon' => 'settings', 'label' => 'Transmission', 'value' => 'Automatic CVT Transmission'],
    ];

    $specs = [
        ['icon' => 'gauge', 'label' => 'Engine Capacity', 'value' => '160cc'],
        ['icon' => 'zap', 'label' => 'Fuel Type', 'value' => 'Gasoline'],
        ['icon' => 'settings', 'label' => 'Carburation', 'value' => 'Fuel Injection'],
        ['icon' => 'disc', 'label' => 'Brakes Front', 'value' => 'Disc - ABS'],
        ['icon' => 'disc', 'label' => 'Brakes Rear', 'value' => 'Disc'],
        ['icon' => 'arrow-up-down', 'label' => 'Suspension Front', 'value' => 'Telescopic Fork'],
        ['icon' => 'circle', 'label' => 'Wheels Front', 'value' => 'Cast'],
        ['icon' => 'circle', 'label' => 'Wheels Rear', 'value' => 'Cast'],
        ['icon' => 'fuel', 'label' => 'Fuel Tank Capacity', 'value' => '8.1L'],
        ['icon' => 'arrow-up-down', 'label' => 'Ground Clearance', 'value' => '165 mm'],
        ['icon' => 'shield', 'label' => 'Frame Type', 'value' => 'Double Cradle'],
        ['icon' => 'weight', 'label' => 'Net Weight', 'value' => '134 kg'],
        ['icon' => 'arrow-up-down', 'label' => 'Seat Height', 'value' => '781 mm'],
        ['icon' => 'settings', 'label' => 'Clutch', 'value' => 'Automatic Centrifugal Dry Clutch'],
        ['icon' => 'settings', 'label' => 'Final Drive', 'value' => 'Belt'],
        ['icon' => 'settings', 'label' => 'Transmission Type', 'value' => 'Automatic CVT Transmission'],
    ];

    $specColumns = array_chunk($specs, 8);

    $ownership = [
        ['icon' => 'check-circle', 'title' => 'Easy Application', 'desc' => 'Quick and hassle-free application process.'],
        ['icon' => 'credit-card', 'title' => 'Flexible Payment Options', 'desc' => 'Plans that match your budget.'],
        ['icon' => 'headphones', 'title' => 'Quick Support', 'desc' => 'Get help fast from our experts.'],
        ['icon' => 'wrench', 'title' => 'Service Assistance', 'desc' => 'Ongoing support for a worry-free ride.'],
    ];

    $related = [
        ['name' => 'PCX 160 ABS', 'discount' => 'MVR 11,000', 'img' => $productImages[0], 'slug' => 'pcx-160-abs'],
        ['name' => 'N Max 155 Neo S', 'discount' => 'MVR 14,100', 'img' => $productImages[1], 'slug' => 'n-max-155-neo-s'],
        ['name' => 'Scoopy Prestige 2026', 'discount' => 'MVR 14,000', 'img' => $productImages[2], 'slug' => 'scoopy-prestige-2026'],
    ];

    $heroBg = asset('images/motorcycles/details/' . rawurlencode('ChatGPT Image Jul 4, 2026, 12_38_11 PM.png'));
    $offerBannerBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1400&q=80';

    $heroFeatures = [
        ['icon' => 'star', 'title' => 'Limited-Time Offer', 'desc' => 'Best price, limited period'],
        ['icon' => 'credit-card', 'title' => 'Flexible Ownership', 'desc' => 'Plans that fit you'],
        ['icon' => 'shield', 'title' => 'Genuine Motorcycle', 'desc' => 'Trusted & authentic'],
        ['icon' => 'wrench', 'title' => 'Service Support', 'desc' => "We've got your back"],
    ];
@endphp

<div class="font-sans">

    <x-litus-header active="Motorcycles" />


    {{-- PRODUCT HERO --}}
    <section class="relative min-h-[600px] overflow-hidden border border-[rgba(40,85,130,0.45)] bg-[#06101f] bg-cover bg-center pb-[82px] max-[1100px]:min-h-[520px] max-[1100px]:pb-8"
             style="background-image: linear-gradient(90deg, rgba(3,13,28,0.98) 0%, rgba(3,13,28,0.94) 35%, rgba(3,13,28,0.60) 58%, rgba(3,13,28,0.78) 100%), url('{{ $heroBg }}');">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_72%_48%,rgba(255,255,255,0.12),transparent_28%),linear-gradient(to_bottom,rgba(0,0,0,0.12),rgba(1,8,20,0.95))]"></div>

        <div class="relative z-[2] litus-container pt-14 pb-10 sm:pt-16 sm:pb-12">
            {{-- Desktop hero product image — free-positioned for maximum size --}}
            <x-product-360-viewer
                :frames="$spinImages"
                alt="ADV 160 2026"
                img-class="block h-auto max-h-[min(680px,72vh)] w-auto max-w-[min(820px,55vw)] object-contain object-bottom"
                class="absolute bottom-6 right-0 z-[4] hidden cursor-grab select-none min-[1100px]:block" />

            <div class="relative z-[2] grid grid-cols-1 items-center gap-8 min-[1100px]:pointer-events-none min-[1100px]:grid-cols-[50%_50%] min-[1100px]:gap-5">
                <div class="max-w-[650px] text-left max-[1100px]:mx-auto max-[1100px]:text-center min-[1100px]:pointer-events-auto min-[1100px]:max-w-none">
                    <p class="mb-6 text-base font-black uppercase tracking-[2px] text-[#ff1029] sm:text-lg max-md:mb-5 max-md:text-[15px]">
                        Category: Touring Bikes
                    </p>

                    <h1 class="mb-7 font-display text-[clamp(2.75rem,5.5vw,5.125rem)] font-black leading-none tracking-[-0.02em] text-white drop-shadow-[0_8px_24px_rgba(0,0,0,0.7)] max-md:text-5xl">
                        ADV 160 2026
                    </h1>

                    <div>
                        <p class="text-lg font-extrabold text-white sm:text-[22px]">
                            Original Price:
                            <span class="text-[#d7dce5] line-through opacity-80">MVR 111,750.00</span>
                        </p>
                        <p class="mb-8 text-lg font-extrabold text-white sm:text-[22px]">
                            Sale Price: MVR 95,000.00
                        </p>
                    </div>

                    <div class="relative mb-5 mt-2 inline-block max-[1100px]:mx-auto">
                        <span class="absolute left-2.5 top-[-26px] rounded-t-md bg-[#f40d23] px-3.5 py-2 text-sm font-black text-white">
                            Limited Offer
                        </span>
                        <div class="rounded-[9px] bg-[#f40d23] px-5 py-4 text-2xl font-black text-white shadow-[0_12px_28px_rgba(244,13,35,0.35)] sm:px-[22px] sm:py-[19px] sm:text-[34px]">
                            Special Discount: MVR 16,750
                        </div>
                    </div>

                    <p class="mb-8 text-base font-semibold text-[#d7dce5] max-md:mb-6">
                        This offer valid for Green, Brown Colors.
                    </p>

                    <div class="flex flex-col gap-3 max-[1100px]:mx-auto min-[1100px]:flex-row min-[1100px]:flex-nowrap min-[1100px]:items-stretch min-[1100px]:gap-2.5">
                        <button type="button"
                                class="inline-flex h-11 w-full shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-[#f40d23] px-4 text-sm font-black text-white shadow-[0_10px_24px_rgba(244,13,35,0.32)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9081a] min-[1100px]:h-12 min-[1100px]:w-auto min-[1100px]:px-4 min-[1100px]:text-[13px]">
                            Buy Now
                            <x-litus-icon name="shopping-bag" class="h-4 w-4 shrink-0" />
                        </button>
                        <a href="tel:+9607797442"
                           class="inline-flex h-11 w-full shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-lg border-2 border-white/55 bg-[rgba(4,16,35,0.45)] px-4 text-sm font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#f40d23] hover:bg-[rgba(244,13,35,0.12)] min-[1100px]:h-12 min-[1100px]:w-auto min-[1100px]:px-4 min-[1100px]:text-[13px]">
                            Contact Sales Team
                            <x-litus-icon name="arrow-right" class="h-4 w-4 shrink-0" />
                        </a>
                        <a href="{{ route('ownership-plans') }}"
                           class="inline-flex h-11 w-full shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-lg border-2 border-white/55 bg-[rgba(4,16,35,0.45)] px-4 text-sm font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#f40d23] hover:bg-[rgba(244,13,35,0.12)] min-[1100px]:h-12 min-[1100px]:w-auto min-[1100px]:px-4 min-[1100px]:text-[13px]">
                            <x-litus-icon name="credit-card" class="h-4 w-4 shrink-0" />
                            View Ownership Plans
                        </a>
                    </div>
                </div>

                {{-- Mobile hero product image --}}
                <x-product-360-viewer
                    :frames="$spinImages"
                    alt="ADV 160 2026"
                    img-class="mx-auto max-h-[520px] w-full max-w-[1000px] object-contain"
                    class="relative z-[1] cursor-grab select-none min-[1100px]:hidden" />

                {{-- Desktop spacer keeps grid balance --}}
                <div class="hidden min-[1100px]:block min-[1100px]:min-h-[460px]" aria-hidden="true"></div>
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
                                <h4 class="mb-0.5 text-sm font-extrabold leading-tight text-white sm:text-[15px]">{{ $feature['title'] }}</h4>
                                <p class="text-xs font-medium leading-snug text-[#c9d4df] sm:text-[13px]">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- GALLERY + HIGHLIGHTS --}}
    <section class="border border-[#d9d9d9] bg-[#f8f9fb] py-8 lg:py-10"
             data-product-gallery
             data-images='@json($galleryImages)'>
        <div class="litus-container grid grid-cols-1 items-start gap-8 lg:grid-cols-2 lg:gap-8">
            {{-- Gallery --}}
            <div class="w-full rounded-[14px] border border-black/5 bg-white p-2.5 shadow-[0_12px_35px_rgba(0,0,0,0.08)]">
                <div class="flex items-center justify-center gap-2 py-2 sm:gap-3">
                    <button type="button"
                            data-gallery-prev
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-[#e3e7ec] bg-white text-xl font-light text-[#07152f] shadow-[0_6px_16px_rgba(0,0,0,0.08)] transition-all duration-300 hover:text-[#ff1029] sm:h-[52px] sm:w-[52px]"
                            aria-label="Previous image">
                        <x-litus-icon name="chevron-left" class="h-6 w-6 sm:h-7 sm:w-7" />
                    </button>

                    <img data-gallery-main
                         src="{{ $galleryImages[0] }}"
                         alt="ADV 160 2026"
                         class="min-w-0 flex-1 object-contain transition-opacity duration-300 max-h-[420px] sm:max-h-[480px]">

                    <button type="button"
                            data-gallery-next
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-[#e3e7ec] bg-white text-xl font-light text-[#07152f] shadow-[0_6px_16px_rgba(0,0,0,0.08)] transition-all duration-300 hover:text-[#ff1029] sm:h-[52px] sm:w-[52px]"
                            aria-label="Next image">
                        <x-litus-icon name="chevron-right" class="h-6 w-6 sm:h-7 sm:w-7" />
                    </button>
                </div>

                <div class="mt-3 grid grid-cols-3 gap-3 sm:gap-4">
                    @foreach ($galleryImages as $index => $img)
                        <button type="button"
                                data-gallery-thumb="{{ $index }}"
                                class="flex aspect-[4/3] max-h-[110px] items-center justify-center overflow-hidden rounded-[10px] border-2 bg-white p-1 transition-all duration-300 hover:border-[#ff1029] {{ $index === 0 ? 'border-[#ff6b7b] shadow-[0_0_0_1px_rgba(255,16,41,0.25)]' : 'border-[#e3e7ec]' }}">
                            <img src="{{ $img }}" alt="View {{ $index + 1 }}" class="h-full w-full object-contain">
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Color + specs --}}
            <div class="flex w-full flex-col">
                <h3 class="mb-5 text-[22px] font-black text-[#07152f]">Select Color</h3>

                <div class="mb-7 grid grid-cols-2 gap-4 sm:gap-5">
                    @foreach ($colors as $index => $color)
                        <button type="button"
                                data-gallery-color="{{ $color['label'] }}"
                                data-color-hex="{{ $color['hex'] }}"
                                aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                class="inline-flex h-16 w-full items-center justify-center gap-3 rounded-[11px] border-2 bg-white text-base font-extrabold text-[#3b3f4a] shadow-[0_8px_22px_rgba(0,0,0,0.06)] transition-all duration-300 hover:border-[#ff1029] sm:h-[66px] sm:gap-4 sm:text-[17px] {{ $index === 0 ? 'border-[#ff6b7b] shadow-[0_0_0_1px_rgba(255,16,41,0.25)]' : 'border-[#e5e8ed]' }}">
                            <span class="inline-block h-7 w-7 shrink-0 rounded-full shadow-[inset_0_0_0_2px_rgba(0,0,0,0.15)] sm:h-[30px] sm:w-[30px]" style="background-color: {{ $color['hex'] }}"></span>
                            {{ $color['label'] }}
                        </button>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 sm:gap-3">
                    @foreach ($highlights as $item)
                        <div class="flex min-h-[100px] w-full items-center gap-3.5 rounded-xl border border-[#e1e5ea] bg-white px-4 py-4 shadow-[0_8px_22px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_14px_30px_rgba(0,0,0,0.08)] sm:min-h-[108px] sm:gap-4 sm:px-5 sm:py-5">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center text-[#07152f] sm:h-11 sm:w-11">
                                <x-litus-icon :name="$item['icon']" class="h-7 w-7 sm:h-8 sm:w-8" stroke-width="1.75" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="mb-1 text-xs font-black text-[#151f44] sm:text-sm">{{ $item['label'] }}</h4>
                                <p class="text-base font-black leading-snug text-[#07152f] sm:text-[17px]">
                                    @if (!empty($item['value_html']))
                                        {!! $item['value'] !!}
                                    @else
                                        {{ $item['value'] }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- SPECIFICATIONS + OFFER + OWNERSHIP + RELATED + INQUIRY --}}
    <section class="bg-[#f7f8fa] py-5 pb-7">
        <div class="litus-container space-y-4">

            {{-- Specifications --}}
            <div class="rounded-[14px] border border-[#dfe3ea] bg-white px-5 py-5 shadow-[0_10px_28px_rgba(0,0,0,0.05)] sm:px-8 sm:pb-6 sm:pt-[18px]">
                <div class="mb-3.5 text-center">
                    <span class="mb-1.5 block text-xs font-black uppercase text-[#ff1029]">Technical Details</span>
                    <h2 class="text-[23px] font-black tracking-wide text-[#111b46] sm:text-[28px]">ADV 160 2026 Specifications</h2>
                </div>

                <div class="grid grid-cols-1 gap-2.5 min-[760px]:grid-cols-2 min-[760px]:gap-8">
                    @foreach ($specColumns as $column)
                        <div class="flex flex-col">
                            @foreach ($column as $index => $spec)
                                <div @class([
                                    'grid min-h-[34px] grid-cols-[34px_1fr_1fr] items-center border-b border-[#dfe3ea] text-sm max-md:grid-cols-[30px_1fr] max-md:gap-2 max-md:py-2',
                                    'border-b-0' => $index === count($column) - 1,
                                ])>
                                    <x-litus-icon :name="$spec['icon']" class="h-4 w-4 text-[#111b46] opacity-85" />
                                    <span class="font-bold text-[#1a2554]">{{ $spec['label'] }}</span>
                                    <span class="text-right font-semibold text-[#1f2635] max-md:col-start-2 max-md:text-left">{{ $spec['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Offer banner --}}
            <div class="grid grid-cols-1 items-center gap-6 overflow-hidden rounded-xl bg-cover bg-right px-6 py-8 shadow-[0_12px_32px_rgba(0,0,0,0.16)] min-[1100px]:grid-cols-[auto_1fr_auto] min-[1100px]:gap-8 min-[1100px]:px-9 min-[1100px]:py-[34px] max-[1100px]:text-center"
                 style="background-image: linear-gradient(90deg, rgba(3,13,31,0.98), rgba(4,19,43,0.94)), url('{{ $offerBannerBg }}');">
                <div class="mx-auto flex h-[92px] w-[92px] items-center justify-center rounded-full border-2 border-dashed border-[#ff1029] text-[#ff1029] min-[1100px]:mx-0">
                    <x-litus-icon name="star" class="h-9 w-9" />
                </div>

                <div>
                    <h2 class="mb-3 text-2xl font-black text-white min-[1100px]:text-[27px]">Ready to Own the ADV 160 2026?</h2>
                    <p class="max-w-[620px] text-[15px] font-semibold leading-relaxed text-[#dce5ef] max-[1100px]:mx-auto">
                        Take advantage of our limited offer and ride with confidence, performance, and style.
                    </p>
                </div>

                <div class="flex flex-col items-start gap-3.5 max-[1100px]:mx-auto max-[1100px]:items-center">
                    <div class="flex flex-wrap gap-4 max-[760px]:w-full max-[760px]:flex-col">
                        <button type="button"
                                class="inline-flex h-[52px] min-w-[190px] items-center justify-center gap-3 rounded-md bg-[#f30d23] px-6 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(243,13,35,0.3)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9081a] max-[760px]:w-full">
                            Buy Now
                            <x-litus-icon name="shopping-bag" class="h-4 w-4" />
                        </button>
                        <button type="button"
                                class="inline-flex h-[52px] min-w-[190px] items-center justify-center gap-3 rounded-md border-2 border-white/55 bg-white/[0.03] px-6 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#ff1029] hover:bg-[rgba(255,16,41,0.12)] max-[760px]:w-full">
                            Ask About This Offer
                            <x-litus-icon name="message-circle" class="h-4 w-4" />
                        </button>
                    </div>
                    <p class="pl-0.5 text-[13px] font-semibold text-[#dce5ef] max-[1100px]:text-center">
                        Offer valid for selected colors and subject to availability.
                    </p>
                </div>
            </div>

            {{-- Ownership plans --}}
            <div class="overflow-hidden rounded-xl border border-[#e1e5eb] bg-white shadow-[0_10px_28px_rgba(0,0,0,0.05)] max-[1100px]:grid max-[1100px]:grid-cols-2 max-[760px]:grid-cols-1 min-[1100px]:grid min-[1100px]:grid-cols-[1.25fr_repeat(4,1fr)]">
                <div class="p-7 max-[1100px]:col-span-2 max-[1100px]:text-center max-[760px]:col-span-1">
                    <h2 class="mb-4 text-2xl font-black leading-tight text-[#111b46] min-[1100px]:text-[27px]">
                        Need a Flexible<br>Ownership Plan?
                    </h2>
                    <p class="mb-5 text-sm font-semibold leading-relaxed text-[#4d5969]">
                        Our ownership plans are designed to make your motorcycle journey simple and stress-free.
                    </p>
                    <a href="{{ route('ownership-plans') }}"
                       class="inline-flex items-center gap-2.5 rounded-md bg-[#f30d23] px-6 py-3.5 text-sm font-black text-white">
                        View Ownership Plans
                        <x-litus-icon name="credit-card" class="h-4 w-4" />
                    </a>
                </div>

                @foreach ($ownership as $item)
                    <div class="flex flex-col items-center justify-center border-t border-[#e1e5eb] px-5 py-6 text-center min-[1100px]:border-l min-[1100px]:border-t-0">
                        <x-litus-icon :name="$item['icon']" class="mb-4 h-10 w-10 text-[#111b46] min-[1100px]:h-11 min-[1100px]:w-11" />
                        <h3 class="mb-2.5 text-base font-black text-[#111b46]">{{ $item['title'] }}</h3>
                        <p class="text-[13px] font-semibold leading-snug text-[#4d5969]">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Related products --}}
            <h2 class="pt-2 text-center text-[25px] font-black text-[#111b46]">You May Also Like</h2>

            <div class="grid grid-cols-1 gap-3.5 min-[1100px]:grid-cols-3">
                @foreach ($related as $product)
                    <div class="grid grid-cols-1 items-center gap-4 rounded-lg border border-[#e1e5eb] bg-white px-4 py-3 shadow-[0_8px_22px_rgba(0,0,0,0.04)] min-[480px]:grid-cols-[130px_1fr] min-[480px]:gap-[18px] min-[480px]:px-[18px]">
                        <img src="{{ $product['img'] }}"
                             alt="{{ $product['name'] }}"
                             class="mx-auto h-[85px] w-[120px] object-contain min-[480px]:mx-0">
                        <div class="text-center min-[480px]:text-left">
                            <h3 class="mb-2.5 text-lg font-black text-[#111b46]">{{ $product['name'] }}</h3>
                            <p class="mb-3 text-sm font-black text-[#ff1029]">Discount: {{ $product['discount'] }}</p>
                            <a href="{{ route('motorcycle.show', $product['slug']) }}"
                               class="inline-flex items-center gap-2.5 rounded-[5px] bg-[#061a45] px-5 py-2.5 text-[13px] font-black text-white">
                                View Details
                                <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Questions --}}
            <div class="grid grid-cols-1 items-center gap-6 rounded-[14px] bg-white px-6 py-6 shadow-[0_10px_28px_rgba(0,0,0,0.05)] min-[1100px]:grid-cols-[auto_1fr_auto] min-[1100px]:gap-7 min-[1100px]:px-8 max-[1100px]:text-center">
                <div class="mx-auto flex h-[76px] w-[76px] items-center justify-center rounded-full bg-[#061a45] text-white min-[1100px]:mx-0">
                    <x-litus-icon name="headphones" class="h-8 w-8" />
                </div>

                <div>
                    <h2 class="mb-2 text-2xl font-black text-[#111b46]">Have Questions About This Motorcycle?</h2>
                    <p class="text-[15px] font-semibold leading-snug text-[#3e4858]">
                        Our sales team can help with availability, pricing, ownership plans, and service support.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-4 max-[760px]:w-full max-[760px]:flex-col min-[1100px]:justify-end">
                    <a href="tel:+9607797442"
                       class="inline-flex h-[52px] min-w-[170px] items-center justify-center gap-2.5 rounded-md bg-[#f30d23] px-6 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(243,13,35,0.3)] transition-all hover:bg-[#c9081a] max-[760px]:w-full">
                        Contact Sales Team
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="tel:+9607797442"
                       class="inline-flex h-[52px] min-w-[170px] items-center justify-center gap-2.5 rounded-md border-2 border-[#1d2430] bg-white text-[15px] font-black text-[#1d2430] max-[760px]:w-full">
                        <x-litus-icon name="phone" class="h-4 w-4" />
                        Call Now
                    </a>
                </div>
            </div>

        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
