@extends('layouts.litus')

@section('title', $motorcycle->name . ' — LITUS Automobiles')

@section('content')
@php
    $ownership = [
        ['icon' => 'check-circle', 'title' => 'Easy Application', 'desc' => 'Quick and hassle-free application process.'],
        ['icon' => 'credit-card', 'title' => 'Flexible Payment Options', 'desc' => 'Plans that match your budget.'],
        ['icon' => 'headphones', 'title' => 'Quick Support', 'desc' => 'Get help fast from our experts.'],
        ['icon' => 'wrench', 'title' => 'Service Assistance', 'desc' => 'Ongoing support for a worry-free ride.'],
    ];

    $heroFeatures = [
        ['icon' => 'star', 'title' => 'Limited-Time Offer', 'desc' => 'Best price, limited period'],
        ['icon' => 'credit-card', 'title' => 'Flexible Ownership', 'desc' => 'Plans that fit you'],
        ['icon' => 'shield', 'title' => 'Genuine Motorcycle', 'desc' => 'Trusted & authentic'],
        ['icon' => 'wrench', 'title' => 'Service Support', 'desc' => "We've got your back"],
    ];

    $offerBannerBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1400&q=80';
    $specs = $motorcycle->specs ?? [];
    $highlights = $motorcycle->highlights();
    $specGroups = $motorcycle->specGroups();
    $heroBg = $motorcycle->heroBackgroundUrl();
    $galleryMainBg = asset('images/details_page/' . rawurlencode('ChatGPT Image Jul 9, 2026, 02_17_21 PM.png'));

    $galleryFeatures = [
        ['icon' => 'shield', 'title' => 'Genuine Quality', 'desc' => '100% genuine parts & trusted quality'],
        ['icon' => 'wrench', 'title' => 'Service Support', 'desc' => 'Expert service & maintenance across Maldives'],
        ['icon' => 'check-circle', 'title' => 'Warranty Coverage', 'desc' => 'Reliable warranty & extended protection'],
        ['icon' => 'star', 'title' => 'Trusted Brand', 'desc' => 'LITUS Automobiles – trusted by hundreds'],
    ];
@endphp

<div class="font-sans" data-motorcycle-detail data-spin-by-color='@json($spinByColor)' data-gallery-by-color='@json($galleryByColor)'>

    <x-litus-header active="Motorcycles" />


    {{-- PRODUCT HERO --}}
    <section class="relative min-h-[600px] overflow-hidden border border-[rgba(40,85,130,0.45)] bg-[#06101f] bg-cover bg-center pb-[82px] max-md:min-h-0 max-md:pb-0 max-[1100px]:min-h-[520px] max-[1100px]:pb-8"
             style="background-image: linear-gradient(90deg, rgba(3,13,28,0.98) 0%, rgba(3,13,28,0.94) 35%, rgba(3,13,28,0.60) 58%, rgba(3,13,28,0.78) 100%), url('{{ $heroBg }}');">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_72%_48%,rgba(255,255,255,0.12),transparent_28%),linear-gradient(to_bottom,rgba(0,0,0,0.12),rgba(1,8,20,0.95))] max-md:bg-[linear-gradient(180deg,rgba(11,22,40,0.55)_0%,rgba(11,22,40,0.78)_42%,rgba(11,22,40,0.92)_100%)]"></div>

        <div class="relative z-[2] litus-container pb-10 pt-14 max-md:pb-5 max-md:pt-16 sm:pb-12 sm:pt-16">
            {{-- Desktop hero product image — free-positioned for maximum size --}}
            <x-product-360-viewer
                :frames="$spinImages"
                alt="{{ $motorcycle->name }}"
                img-class="block h-auto max-h-[min(680px,72vh)] w-auto max-w-[min(820px,55vw)] object-contain object-bottom"
                class="absolute bottom-6 right-0 z-[4] hidden cursor-grab select-none min-[1100px]:block" />

            <div class="relative z-[2] grid grid-cols-1 items-center gap-8 max-md:gap-5 min-[1100px]:pointer-events-none min-[1100px]:grid-cols-[50%_50%] min-[1100px]:gap-5">
                <div class="max-w-[650px] text-left max-[1100px]:mx-auto max-[1100px]:text-center min-[1100px]:pointer-events-auto min-[1100px]:max-w-none">
                    <p class="mb-6 text-base font-black uppercase tracking-[2px] text-[#0065ef] max-md:mb-1.5 max-md:text-[10px] max-md:tracking-[0.18em] sm:text-lg">
                        {{ $motorcycle->category }}
                    </p>

                    <h1 class="mb-7 font-display text-[clamp(2.75rem,5.5vw,5.125rem)] font-bold leading-none tracking-[-0.02em] text-white drop-shadow-[0_8px_24px_rgba(0,0,0,0.7)] max-md:mb-3 max-md:text-[1.85rem] max-md:leading-[1.05]">
                        {{ $motorcycle->name }}
                    </h1>

                    <div>
                        @if ($motorcycle->hasPromotion())
                            <p class="text-lg font-extrabold text-white sm:text-[22px]">
                                <span class="text-[#d7dce5] line-through opacity-80">{{ $motorcycle->formattedOriginalPrice() }}</span>
                            </p>
                            <p class="mb-8 text-lg font-extrabold text-white sm:text-[22px]">
                                {{ $motorcycle->formattedSalePrice() }}
                            </p>
                        @else
                            <p class="mb-8 text-lg font-extrabold text-white sm:text-[22px]">
                                {{ $motorcycle->formattedOriginalPrice() }}
                            </p>
                        @endif
                    </div>

                    @if ($motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0)
                    <div class="relative mb-5 mt-2 inline-block max-md:block max-md:w-full max-[1100px]:mx-auto">
                        <span class="absolute left-2.5 top-[-26px] rounded-t-md bg-[#0065ef] px-3.5 py-2 text-sm font-black text-white max-md:static max-md:mb-2 max-md:inline-block">
                            {{ $motorcycle->offerLabel() }}
                        </span>
                        <div class="rounded-[9px] border-2 border-[#0065ef] bg-transparent px-5 py-4 text-2xl font-black text-[#0065ef] transition-all duration-300 hover:bg-[#0065ef] hover:text-white hover:shadow-[0_12px_28px_rgba(0,101,239,0.35)] max-md:w-full max-md:px-4 max-md:py-3 max-md:text-lg sm:px-[22px] sm:py-[19px] sm:text-[34px]">
                            Special Discount: {{ $motorcycle->formattedDiscount() }}
                        </div>
                    </div>
                    @endif

                    @if ($motorcycle->hasPromotion() && $motorcycle->offer_note)
                    <p class="mb-8 text-base font-semibold text-[#d7dce5] max-md:mb-6">
                        {{ $motorcycle->offer_note }}
                    </p>
                    @endif

                    <div class="flex flex-col gap-2.5 max-[1100px]:mx-auto min-[1100px]:flex-row min-[1100px]:flex-nowrap min-[1100px]:items-stretch min-[1100px]:gap-4">
                        <div class="flex flex-col gap-2.5 max-md:flex-row max-md:gap-2 min-[1100px]:contents">
                            <a href="tel:+9607797442"
                               class="inline-flex h-[52px] w-full shrink-0 items-center justify-center gap-2.5 rounded-md bg-[#0065ef] px-6 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(0,101,239,0.3)] transition-all hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] min-[1100px]:w-auto">
                                Contact Sales Team
                                <x-litus-icon name="arrow-right" class="h-4 w-4 shrink-0 max-md:h-3.5 max-md:w-3.5" />
                            </a>
                            <a href="tel:+9607797442"
                               class="inline-flex h-[52px] w-full shrink-0 items-center justify-center gap-2.5 rounded-md border-2 border-[#1d2430] bg-white px-6 text-[15px] font-black text-[#1d2430] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] min-[1100px]:w-auto">
                                <x-litus-icon name="phone" class="h-4 w-4 shrink-0 max-md:h-3.5 max-md:w-3.5" />
                                Call Now
                            </a>
                        </div>
                        <a href="{{ route('ownership-plans') }}"
                           class="inline-flex h-11 w-full shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-lg border-2 border-white/55 bg-[rgba(4,16,35,0.45)] px-4 text-sm font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)] max-md:h-11 max-md:min-h-11 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] min-[1100px]:h-12 min-[1100px]:w-auto min-[1100px]:px-4 min-[1100px]:text-[13px]">
                            <x-litus-icon name="credit-card" class="h-4 w-4 shrink-0 max-md:h-3.5 max-md:w-3.5" />
                            View Ownership Plans
                        </a>
                    </div>
                </div>

                {{-- Mobile hero product image --}}
                <x-product-360-viewer
                    :frames="$spinImages"
                    alt="{{ $motorcycle->name }}"
                    img-class="mx-auto max-h-[520px] w-full max-w-[1000px] object-contain max-md:max-h-[40vh]"
                    class="relative z-[1] cursor-grab select-none min-[1100px]:hidden" />

                {{-- Desktop spacer keeps grid balance --}}
                <div class="hidden min-[1100px]:block min-[1100px]:min-h-[460px]" aria-hidden="true"></div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- GALLERY + HIGHLIGHTS --}}
    <section class="bg-[#f4f7fb] py-10 lg:py-12"
             data-product-gallery
             data-images='@json($galleryImages)'>
        <div class="litus-container">
            <div class="grid grid-cols-1 items-start gap-8 min-[1150px]:grid-cols-[1.08fr_0.95fr] min-[1150px]:items-stretch min-[1150px]:gap-10">
                {{-- Gallery --}}
                <div class="animate-on-scroll relative w-full overflow-hidden rounded-2xl border border-[#07152f]/5 bg-white shadow-[0_14px_35px_rgba(7,21,47,0.07)]"
                     data-animate="slideLeft">
                    <button type="button"
                            data-gallery-expand
                            class="absolute right-3 top-3 z-10 flex h-10 w-10 items-center justify-center text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.55)] transition-all duration-300 hover:scale-110 hover:text-[#0065ef] min-[1150px]:right-4 min-[1150px]:top-4 min-[1150px]:h-11 min-[1150px]:w-11"
                            aria-label="Expand image">
                        <svg class="h-4 w-4 min-[1150px]:h-5 min-[1150px]:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M15 3h6v6"/><path d="m21 3-7 7"/><path d="m3 21 7-7"/><path d="M9 21H3v-6"/>
                        </svg>
                    </button>

                    <div class="relative flex h-[340px] w-full items-center justify-center overflow-hidden bg-cover bg-center max-md:h-[260px] min-[1150px]:h-[440px]"
                         style="background-image: url('{{ $galleryMainBg }}');">
                        <button type="button"
                                data-gallery-prev
                                class="absolute left-2 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.55)] transition-all duration-300 hover:scale-110 hover:text-[#0065ef] min-[1150px]:left-3 min-[1150px]:h-12 min-[1150px]:w-12"
                                aria-label="Previous image">
                            <x-litus-icon name="chevron-left" class="h-5 w-5 min-[1150px]:h-6 min-[1150px]:w-6" />
                        </button>

                        <img data-gallery-main
                             src="{{ $galleryImages[0] ?? '' }}"
                             alt="{{ $motorcycle->name }}"
                             class="relative z-[1] h-full w-full max-w-none object-contain drop-shadow-[0_20px_14px_rgba(0,0,0,0.16)] transition-opacity duration-300">

                        <button type="button"
                                data-gallery-next
                                class="absolute right-2 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.55)] transition-all duration-300 hover:scale-110 hover:text-[#0065ef] min-[1150px]:right-3 min-[1150px]:h-12 min-[1150px]:w-12"
                                aria-label="Next image">
                            <x-litus-icon name="chevron-right" class="h-5 w-5 min-[1150px]:h-6 min-[1150px]:w-6" />
                        </button>
                    </div>

                    <div class="px-5 pb-5 pt-4 min-[1150px]:px-6 min-[1150px]:pb-6 min-[1150px]:pt-5">
                        <div class="grid grid-cols-3 gap-2.5 min-[700px]:grid-cols-5 min-[1150px]:gap-3.5"
                             data-gallery-thumbs></div>

                        <div class="mt-4 flex justify-center gap-2"
                             data-gallery-dots
                             aria-hidden="true"></div>
                    </div>
                </div>

                {{-- Color + specs + actions --}}
                <div class="animate-on-scroll flex w-full flex-col justify-between gap-5 min-[1150px]:gap-6"
                     data-animate="slideRight"
                     data-delay="0.1">
                    <div>
                        <h3 class="mb-5 text-xl font-bold text-[#07152f] min-[1150px]:mb-6 min-[1150px]:text-2xl">Select Color</h3>

                        <div class="flex flex-wrap items-center gap-4 min-[1150px]:gap-5">
                            @foreach ($colors as $index => $color)
                                <button type="button"
                                        data-gallery-color="{{ $color['label'] }}"
                                        data-color-hex="{{ $color['hex'] }}"
                                        aria-label="{{ $color['label'] }}"
                                        title="{{ $color['label'] }}"
                                        aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                        class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border-2 bg-white p-1 transition-all duration-300 hover:border-[#1f7bff] min-[1150px]:h-12 min-[1150px]:w-12 {{ $index === 0 ? 'border-[#1f7bff] shadow-[0_0_0_3px_rgba(31,123,255,0.2)]' : 'border-[#dce3ed]' }}">
                                    <span class="block h-full w-full rounded-full shadow-[inset_0_0_0_1px_rgba(0,0,0,0.12)]"
                                          style="background-color: {{ $color['hex'] }}"></span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 min-[700px]:grid-cols-2 min-[1150px]:gap-4">
                        @foreach ($highlights as $item)
                            <div class="animate-on-scroll flex min-h-[118px] w-full items-center gap-4 rounded-2xl border border-[#07152f]/5 bg-white px-4 py-5 shadow-[0_14px_35px_rgba(7,21,47,0.07)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_18px_40px_rgba(7,21,47,0.1)] min-[1150px]:min-h-[128px] min-[1150px]:gap-4 min-[1150px]:px-5 min-[1150px]:py-6"
                                 data-animate="fadeInUp"
                                 data-delay="{{ $loop->index * 0.1 }}">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#f1f5fb] text-[#061a45] min-[1150px]:h-12 min-[1150px]:w-12">
                                    <x-spec-icon :icon="$item['icon']" :icon-url="$item['icon_url']" class="h-7 w-7 min-[1150px]:h-8 min-[1150px]:w-8" stroke-width="1.75" />
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="mb-1 text-sm font-bold text-[#07152f] min-[1150px]:mb-1.5 min-[1150px]:text-base">{{ $item['label'] }}</h4>
                                    <p class="text-lg font-black leading-tight text-[#07152f] min-[1150px]:text-xl">
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

                    <div class="grid grid-cols-1 gap-4 min-[700px]:grid-cols-2 min-[1150px]:mt-2">
                        <a href="tel:+9607797442"
                           class="inline-flex h-[56px] w-full items-center justify-center gap-2.5 rounded-md bg-[#0065ef] px-6 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(0,101,239,0.3)] transition-all hover:bg-[#0052cc]">
                            Contact Sales Team
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                        <a href="tel:+9607797442"
                           class="inline-flex h-[56px] w-full items-center justify-center gap-2.5 rounded-md border-2 border-[#1d2430] bg-white text-[15px] font-black text-[#1d2430]">
                            <x-litus-icon name="phone" class="h-4 w-4" />
                            Call Now
                        </a>
                    </div>
                </div>
            </div>

            {{-- Feature bar --}}
            <div class="animate-on-scroll mt-8 grid grid-cols-1 gap-4 rounded-2xl border border-[#07152f]/5 bg-white px-5 py-6 shadow-[0_14px_35px_rgba(7,21,47,0.07)] min-[700px]:grid-cols-2 min-[1150px]:mt-10 min-[1150px]:grid-cols-4 min-[1150px]:gap-5 min-[1150px]:px-8 min-[1150px]:py-7"
                 data-animate="fadeInUp"
                 data-delay="0.15">
                @foreach ($galleryFeatures as $index => $feature)
                    <div @class([
                        'relative flex items-center gap-4 min-[1150px]:gap-5',
                        'min-[1150px]:after:absolute min-[1150px]:after:-right-2.5 min-[1150px]:after:top-1/2 min-[1150px]:after:h-12 min-[1150px]:after:w-px min-[1150px]:after:-translate-y-1/2 min-[1150px]:after:bg-[#dce3ed]' => $index < count($galleryFeatures) - 1,
                        'max-[1150px]:min-[700px]:after:hidden' => in_array($index, [1, 3]),
                        'max-[700px]:after:hidden' => $index < count($galleryFeatures) - 1,
                    ])>
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#061a45] text-white min-[1150px]:h-12 min-[1150px]:w-12">
                            <x-litus-icon :name="$feature['icon']" class="h-5 w-5 min-[1150px]:h-6 min-[1150px]:w-6" />
                        </div>
                        <div class="min-w-0">
                            <h4 class="mb-0.5 text-base font-bold text-[#07152f] min-[1150px]:mb-1 min-[1150px]:text-lg">{{ $feature['title'] }}</h4>
                            <p class="text-xs font-medium leading-snug text-[#07152f] min-[1150px]:text-sm min-[1150px]:leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SPECIFICATIONS + OFFER + OWNERSHIP + RELATED + INQUIRY --}}
    <section class="bg-[#f7f8fa] py-5 pb-7">
        <div class="litus-container space-y-4">

            {{-- Specifications --}}
            @php
                $keySpecLabels = ['Engine Capacity', 'Fuel Tank Capacity', 'Seat Height', 'Net Weight'];
                $flatSpecs = collect($specGroups)->flatMap(fn ($group) => $group['specs']);
                $keySpecs = collect($keySpecLabels)
                    ->map(fn ($label) => $flatSpecs->firstWhere('label', $label))
                    ->filter()
                    ->values();
            @endphp
            <div class="animate-on-scroll" data-animate="fadeInUp" data-motorcycle-specs>
                <div class="mb-6 text-center sm:mb-8">
                    <span class="mb-2 block text-xs font-black uppercase tracking-[0.08em] text-[#0065ef]">Technical Details</span>
                    <h2 class="font-montserrat text-[23px] font-bold tracking-wide text-[#111b46] sm:text-[28px]">{{ $motorcycle->name }} Specifications</h2>
                </div>

                @if ($keySpecs->isNotEmpty())
                    <div class="mb-5 grid grid-cols-2 gap-3 min-[900px]:grid-cols-4 min-[900px]:gap-4">
                        @foreach ($keySpecs as $keySpec)
                            <div class="rounded-xl border border-[#e3e8f0] bg-white px-4 py-4 text-center transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_12px_28px_rgba(7,21,47,0.08)] sm:px-5 sm:py-5">
                                <p class="mb-1.5 text-[11px] font-bold uppercase tracking-[0.06em] text-[#7a8494] sm:text-xs">{{ $keySpec['label'] }}</p>
                                <p class="font-montserrat text-xl font-bold leading-none text-[#07152f] sm:text-2xl">{{ $keySpec['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="overflow-hidden rounded-2xl border border-[#e3e8f0] bg-white">
                    <div class="border-b border-[#eef1f5] bg-[#fbfcfe]">
                        <div class="flex gap-1 overflow-x-auto px-3 py-2.5 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:gap-2 sm:px-4"
                             role="tablist"
                             aria-label="Specification categories"
                             data-specs-tabs>
                            @foreach ($specGroups as $group)
                                <button type="button"
                                        role="tab"
                                        id="spec-tab-{{ $loop->index }}"
                                        aria-controls="spec-panel-{{ $loop->index }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                        data-specs-tab="{{ $loop->index }}"
                                        @class([
                                            'inline-flex shrink-0 items-center gap-2 rounded-xl px-3.5 py-2.5 text-[13px] font-bold transition-all duration-200 sm:px-4 sm:text-sm',
                                            'bg-[#0065ef] text-white shadow-[0_8px_18px_rgba(0,101,239,0.22)]' => $loop->first,
                                            'bg-transparent text-[#4d5869] hover:bg-[#f0f4f9] hover:text-[#07152f]' => ! $loop->first,
                                        ])>
                                    <x-litus-icon :name="$group['icon']" class="h-4 w-4 shrink-0" />
                                    <span class="whitespace-nowrap">{{ $group['title'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-4 sm:p-6" data-specs-panels>
                        @foreach ($specGroups as $group)
                            <div id="spec-panel-{{ $loop->index }}"
                                 role="tabpanel"
                                 aria-labelledby="spec-tab-{{ $loop->index }}"
                                 data-specs-panel="{{ $loop->index }}"
                                 @class([
                                     'hidden' => ! $loop->first,
                                 ])>
                                <div class="mb-4 flex items-center gap-3 sm:mb-5">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#0065ef]/10 text-[#0065ef]">
                                        <x-litus-icon :name="$group['icon']" class="h-5 w-5" />
                                    </div>
                                    <div>
                                        <h3 class="font-montserrat text-base font-bold text-[#07152f] sm:text-lg">{{ $group['title'] }}</h3>
                                        <p class="text-xs font-medium text-[#7a8494]">{{ count($group['specs']) }} specifications</p>
                                    </div>
                                </div>

                                <div class="divide-y divide-[#eef1f5] overflow-hidden rounded-xl border border-[#eef1f5]">
                                    @foreach ($group['specs'] as $spec)
                                        <div class="grid grid-cols-[minmax(0,1fr)_auto] items-center gap-4 bg-white px-4 py-3.5 transition-colors hover:bg-[#f8fafc] sm:grid-cols-[40px_minmax(0,1fr)_auto] sm:gap-4 sm:px-5 sm:py-4">
                                            <div class="hidden h-9 w-9 items-center justify-center rounded-lg bg-[#f3f6fa] text-[#07152f] sm:flex">
                                                <x-spec-icon :icon="$spec['icon']" :icon-url="$spec['icon_url']" class="h-5 w-5 shrink-0" />
                                            </div>
                                            <span class="text-[13px] font-semibold leading-snug text-[#4d5869] sm:text-sm">{{ $spec['label'] }}</span>
                                            <span class="text-right text-[13px] font-black leading-snug text-[#07152f] sm:text-sm">{{ $spec['value'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Offer banner --}}
            <div class="animate-on-scroll my-8 grid grid-cols-1 items-center gap-4 overflow-hidden rounded-xl bg-cover bg-right px-8 py-6 shadow-[0_12px_32px_rgba(0,0,0,0.16)] min-[1100px]:my-10 min-[1100px]:grid-cols-[auto_1fr_auto] min-[1100px]:gap-6 min-[1100px]:px-12 min-[1100px]:py-7 max-[1100px]:text-center"
                 data-animate="fadeInUp"
                 style="background-image: linear-gradient(90deg, rgba(3,13,31,0.98), rgba(4,19,43,0.94)), url('{{ $offerBannerBg }}');">
                <div class="mx-auto flex h-[72px] w-[72px] items-center justify-center rounded-full border-2 border-dashed border-[#0065ef] text-[#0065ef] min-[1100px]:mx-0">
                    <x-litus-icon name="star" class="h-7 w-7" />
                </div>

                <div>
                    <h2 class="font-montserrat mb-2 text-xl font-bold text-white min-[1100px]:text-2xl">Ready to Own the {{ $motorcycle->name }}?</h2>
                    <p class="max-w-[620px] text-sm font-semibold leading-relaxed text-[#dce5ef] min-[1100px]:text-[15px] max-[1100px]:mx-auto">
                        Take advantage of our limited offer and ride with confidence, performance, and style.
                    </p>
                </div>

                <div class="flex flex-col items-start gap-2.5 max-[1100px]:mx-auto max-[1100px]:items-center">
                    <div class="flex flex-wrap gap-3 max-[760px]:w-full max-[760px]:flex-col">
                        <button type="button"
                                class="inline-flex h-11 min-w-[170px] items-center justify-center gap-2.5 rounded-md bg-[#0065ef] px-5 text-sm font-black text-white shadow-[0_8px_22px_rgba(0,101,239,0.3)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-[760px]:w-full">
                            Buy Now
                            <x-litus-icon name="shopping-bag" class="h-4 w-4" />
                        </button>
                        <button type="button"
                                class="inline-flex h-11 min-w-[170px] items-center justify-center gap-2.5 rounded-md border-2 border-white/55 bg-white/[0.03] px-5 text-sm font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)] max-[760px]:w-full">
                            Ask About This Offer
                            <x-litus-icon name="message-circle" class="h-4 w-4" />
                        </button>
                    </div>
                    <p class="pl-0.5 text-xs font-semibold text-[#dce5ef] min-[1100px]:text-[13px] max-[1100px]:text-center">
                        Offer valid for selected colors and subject to availability.
                    </p>
                </div>
            </div>

            {{-- Ownership plans --}}
            <div class="animate-on-scroll overflow-hidden rounded-xl border border-[#e1e5eb] bg-white shadow-[0_10px_28px_rgba(0,0,0,0.05)] max-[1100px]:grid max-[1100px]:grid-cols-2 max-[760px]:grid-cols-1 min-[1100px]:grid min-[1100px]:grid-cols-[1.25fr_repeat(4,1fr)]"
                 data-animate="fadeInUp"
                 data-delay="0.1">
                <div class="p-5 max-[1100px]:col-span-2 max-[1100px]:text-center max-[760px]:col-span-1 min-[1100px]:p-6">
                    <h2 class="font-montserrat mb-3 text-xl font-bold leading-tight text-[#111b46] min-[1100px]:text-2xl">
                        Need a Flexible<br>Ownership Plan?
                    </h2>
                    <p class="mb-4 text-xs font-semibold leading-relaxed text-[#4d5969] min-[1100px]:text-sm">
                        Our ownership plans are designed to make your motorcycle journey simple and stress-free.
                    </p>
                    <a href="{{ route('ownership-plans') }}"
                       class="inline-flex items-center gap-2 rounded-md bg-[#0065ef] px-5 py-2.5 text-xs font-black text-white min-[1100px]:text-sm">
                        View Ownership Plans
                        <x-litus-icon name="credit-card" class="h-3.5 w-3.5 min-[1100px]:h-4 min-[1100px]:w-4" />
                    </a>
                </div>

                @foreach ($ownership as $item)
                    <div class="flex flex-col items-center justify-center border-t border-[#e1e5eb] px-4 py-4 text-center min-[1100px]:border-l min-[1100px]:border-t-0 min-[1100px]:px-5 min-[1100px]:py-5">
                        <x-litus-icon :name="$item['icon']" class="mb-2.5 h-8 w-8 text-[#111b46] min-[1100px]:mb-3 min-[1100px]:h-9 min-[1100px]:w-9" />
                        <h3 class="mb-1.5 text-sm font-bold text-[#111b46] min-[1100px]:text-base">{{ $item['title'] }}</h3>
                        <p class="text-xs font-semibold leading-snug text-[#4d5969] min-[1100px]:text-[13px]">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Related products --}}
            <h2 class="font-montserrat animate-on-scroll pt-2 text-center text-[25px] font-bold text-[#111b46]"
                data-animate="fadeInUp">You May Also Like</h2>

            <div class="grid grid-cols-1 gap-3.5 min-[1100px]:grid-cols-3">
                @foreach ($related as $product)
                    <div class="animate-on-scroll grid grid-cols-1 items-center gap-4 rounded-lg border border-[#e1e5eb] bg-white px-4 py-3 shadow-[0_8px_22px_rgba(0,0,0,0.04)] min-[480px]:grid-cols-[130px_1fr] min-[480px]:gap-[18px] min-[480px]:px-[18px]"
                         data-animate="fadeInUp"
                         data-delay="{{ $loop->index * 0.12 }}">
                        <img src="{{ $product['img'] }}"
                             alt="{{ $product['name'] }}"
                             class="mx-auto h-[85px] w-[120px] object-contain min-[480px]:mx-0">
                        <div class="text-center min-[480px]:text-left">
                            <h3 class="mb-2.5 text-lg font-bold text-[#111b46]">{{ $product['name'] }}</h3>
                            @if (! empty($product['discount']))
                            <p class="mb-3 text-sm font-black text-[#0065ef]">Discount: {{ $product['discount'] }}</p>
                            @endif
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
            <div class="animate-on-scroll grid grid-cols-1 items-center gap-6 rounded-[14px] bg-white px-6 py-6 shadow-[0_10px_28px_rgba(0,0,0,0.05)] min-[1100px]:grid-cols-[auto_1fr_auto] min-[1100px]:gap-7 min-[1100px]:px-8 max-[1100px]:text-center"
                 data-animate="fadeInUp"
                 data-delay="0.1">
                <div class="mx-auto flex h-[76px] w-[76px] items-center justify-center rounded-full bg-[#061a45] text-white min-[1100px]:mx-0">
                    <x-litus-icon name="headphones" class="h-8 w-8" />
                </div>

                <div>
                    <h2 class="font-montserrat mb-2 text-2xl font-bold text-[#111b46]">Have Questions About This Motorcycle?</h2>
                    <p class="text-[15px] font-semibold leading-snug text-[#3e4858]">
                        Our sales team can help with availability, pricing, ownership plans, and service support.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-4 max-[760px]:w-full max-[760px]:flex-col min-[1100px]:justify-end">
                    <a href="tel:+9607797442"
                       class="inline-flex h-[52px] min-w-[170px] items-center justify-center gap-2.5 rounded-md bg-[#0065ef] px-6 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(0,101,239,0.3)] transition-all hover:bg-[#0052cc] max-[760px]:w-full">
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
