@extends('layouts.litus')

@section('title', $motorcycle->name . ' - LITUS Automobiles')

@section('content')
@php
    $specRows = collect($motorcycle->specs ?? [])
        ->filter(fn ($spec) => filled($spec['value'] ?? null))
        ->values()
        ->map(fn ($spec) => [
            ...$spec,
            'icon' => \App\Models\Motorcycle::iconForSpecLabel($spec['label'] ?? ''),
            'icon_url' => \App\Models\Motorcycle::specIconUrlForLabel($spec['label'] ?? ''),
        ])
        ->all();

    $highlights = $motorcycle->highlights();
    $heroBg = $motorcycle->heroBackgroundUrl();
    $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
    $activePrice = $hasPromo ? $motorcycle->promotionalSalePrice() : (float) $motorcycle->original_price;
    $monthly = $activePrice > 0 ? (int) (round(($activePrice / 60) / 10) * 10) : null;
    $engine = $motorcycle->engineCapacity();
    $keyTech = $highlights[1]['value'] ?? ($highlights[0]['value'] ?? 'LITUS Support');
    $blurb = $motorcycle->offerNote()
        ?: 'Premium build, genuine parts support, and Ijara-ready ownership options across LITUS showrooms in the Maldives.';

    $heroFeatures = [
        ['icon' => 'bike', 'title' => $engine ?: 'Electric', 'desc' => 'Engine capacity'],
        ['icon' => 'zap', 'title' => $keyTech, 'desc' => 'Key technology'],
        ['icon' => 'shield', 'title' => 'LITUS Warranty', 'desc' => 'Backed by our own network'],
        ['icon' => 'map-pin', 'title' => count($showrooms).' Showrooms', 'desc' => 'Ask us where stock is'],
    ];

    $whatsappText = urlencode('Hi LITUS, I am interested in the '.$motorcycle->name.'.');
@endphp

<div class="font-sans"
     data-motorcycle-detail
     data-spin-by-color='@json($spinByColor)'
     data-gallery-by-color='@json($galleryByColor)'>

    <x-litus-header active="Motorcycles" />

    {{-- HERO — desktop --}}
    <section class="relative hidden overflow-hidden bg-litus-ink text-white min-[961px]:block">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_36%,rgba(5,11,24,0.55)_64%,rgba(5,11,24,0.4)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.28), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.5) 100%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(40px,5vw,72px)] pb-[clamp(28px,4vw,52px)]">
            <div class="grid items-center gap-7 min-[961px]:grid-cols-[1.06fr_0.94fr]">
                <div>
                    <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">
                        {{ trim(($motorcycle->brand ? $motorcycle->brand.' · ' : '').($motorcycle->category ?: 'Motorcycle')) }}
                    </span>
                    <h1 class="font-display text-[clamp(28px,4.6vw,56px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                        {{ $motorcycle->name }}
                    </h1>
                    <p class="mt-4 max-w-[520px] text-[clamp(15.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                        {{ $blurb }}
                    </p>

                    <div class="mt-6 sm:mt-[26px]">
                        @if ($hasPromo)
                            <div class="text-[15px] text-white/50 line-through sm:text-base">{{ $motorcycle->formattedOriginalPrice() }}</div>
                            <div class="mt-0.5 font-display text-[clamp(30px,7vw,44px)] font-extrabold tracking-[-0.035em]">{{ $motorcycle->formattedSalePrice() }}</div>
                            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-litus-green px-[15px] py-[7px] text-[12.5px] font-bold text-white sm:text-[13px]">
                                SAVE {{ $motorcycle->formattedDiscount() }}
                            </div>
                        @else
                            <div class="font-display text-[clamp(30px,7vw,44px)] font-extrabold tracking-[-0.035em]">{{ $motorcycle->formattedOriginalPrice() }}</div>
                        @endif

                        @if ($monthly)
                            <div class="mt-3.5 text-[15px] font-semibold text-litus-sky">
                                or from MVR {{ number_format($monthly) }}/month on an Ijara plan
                            </div>
                        @endif
                    </div>

                    <div class="litus-cta-row mt-7">
                        <a href="#enquire"
                           class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                            Reserve This Bike
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                        <a href="{{ route('ownership-plans') }}"
                           class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                            See Ijara Plans
                        </a>
                    </div>
                </div>

                <div class="hidden min-[961px]:flex min-[961px]:flex-col min-[961px]:gap-4"
                     data-product-gallery
                     data-images='@json($galleryImages)'>
                    <div class="relative z-0 aspect-[4/3] overflow-visible">
                        <x-product-360-viewer
                            :frames="$spinImages"
                            alt="{{ $motorcycle->name }}"
                            img-class="mx-auto h-full max-h-[420px] w-full origin-center scale-[1.35] object-contain drop-shadow-[0_18px_20px_rgba(0,0,0,0.35)]"
                            class="relative z-0 flex h-full cursor-grab select-none items-center justify-center px-0 py-0" />
                        @if (empty($spinImages))
                            <img src="{{ $motorcycle->listImageUrl() }}"
                                 alt="{{ $motorcycle->name }}"
                                 class="pointer-events-none absolute inset-0 z-0 m-auto max-h-[88%] max-w-[88%] origin-center scale-[1.35] object-contain">
                        @endif
                    </div>

                    @if (count($colors))
                        <div class="relative z-20 mt-4 flex flex-wrap items-center justify-center gap-3 px-1 pt-2 sm:mt-5 sm:pt-3">
                            @foreach ($colors as $index => $color)
                                <button type="button"
                                        data-gallery-color="{{ $color['label'] }}"
                                        data-color-hex="{{ $color['hex'] }}"
                                        aria-label="{{ $color['label'] }}"
                                        title="{{ $color['label'] }}"
                                        aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                        class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full border-2 bg-transparent p-0.5 transition hover:border-litus-sky {{ $index === 0 ? 'border-litus-sky shadow-[0_0_0_3px_rgba(90,184,255,0.25)]' : 'border-white/30' }}">
                                    <span class="block h-full w-full rounded-full shadow-[inset_0_0_0_1px_rgba(255,255,255,0.2)]"
                                          style="background-color: {{ $color['hex'] }}"></span>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/35 backdrop-blur-sm">
            <div class="litus-container grid grid-cols-2 gap-4 py-[22px] lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroFeatures as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div class="min-w-0">
                            <b class="block truncate text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
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

        <div class="relative z-[3] flex flex-col">
            <div class="litus-container pt-12 pb-3">
                <span class="mb-2 block text-[10.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">
                    {{ trim(($motorcycle->brand ? $motorcycle->brand.' · ' : '').($motorcycle->category ?: 'Motorcycle')) }}
                </span>
                <h1 class="font-display text-[clamp(1.65rem,6.5vw,2rem)] font-extrabold leading-[1.1] tracking-[-0.032em]">
                    {{ $motorcycle->name }}
                </h1>

                <div class="mt-3">
                    @if ($hasPromo)
                        <div class="text-[13px] text-white/50 line-through">{{ $motorcycle->formattedOriginalPrice() }}</div>
                        <div class="font-display text-[clamp(1.75rem,7vw,2.25rem)] font-extrabold tracking-[-0.035em]">{{ $motorcycle->formattedSalePrice() }}</div>
                        <div class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-litus-green px-3 py-1 text-[11px] font-bold text-white">
                            SAVE {{ $motorcycle->formattedDiscount() }}
                        </div>
                    @else
                        <div class="font-display text-[clamp(1.75rem,7vw,2.25rem)] font-extrabold tracking-[-0.035em]">{{ $motorcycle->formattedOriginalPrice() }}</div>
                    @endif

                    @if ($monthly)
                        <div class="mt-2 text-[13px] font-semibold text-litus-sky">
                            From MVR {{ number_format($monthly) }}/month on Ijara
                        </div>
                    @endif
                </div>
            </div>

            <div class="litus-container pb-2"
                 data-product-gallery
                 data-images='@json($galleryImages)'>
                <div class="relative z-0 h-[clamp(300px,58vw,380px)] overflow-visible">
                    <x-product-360-viewer
                        :frames="$spinImages"
                        alt="{{ $motorcycle->name }}"
                        img-class="mx-auto h-full max-h-full w-full max-w-[96%] origin-center object-contain drop-shadow-[0_18px_20px_rgba(0,0,0,0.35)]"
                        class="relative z-0 flex h-full min-h-[300px] cursor-grab select-none items-center justify-center px-0 py-0" />
                    @if (empty($spinImages))
                        <img src="{{ $motorcycle->listImageUrl() }}"
                             alt="{{ $motorcycle->name }}"
                             class="pointer-events-none absolute inset-0 z-0 m-auto max-h-[96%] max-w-[96%] object-contain">
                    @endif
                </div>

                @if (count($colors))
                    <div class="relative z-20 mt-3 flex flex-wrap items-center justify-center gap-2.5 px-1">
                        @foreach ($colors as $index => $color)
                            <button type="button"
                                    data-gallery-color="{{ $color['label'] }}"
                                    data-color-hex="{{ $color['hex'] }}"
                                    aria-label="{{ $color['label'] }}"
                                    title="{{ $color['label'] }}"
                                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                    class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 bg-transparent p-0.5 transition hover:border-litus-sky {{ $index === 0 ? 'border-litus-sky shadow-[0_0_0_3px_rgba(90,184,255,0.25)]' : 'border-white/30' }}">
                                <span class="block h-full w-full rounded-full shadow-[inset_0_0_0_1px_rgba(255,255,255,0.2)]"
                                      style="background-color: {{ $color['hex'] }}"></span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="litus-container pb-4">
                <div class="flex flex-row gap-2">
                    <a href="#enquire"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:bg-litus-primary-hover">
                        Reserve
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                    <a href="{{ route('ownership-plans') }}"
                       class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border-[1.5px] border-white/32 px-3 text-[13px] font-semibold text-white transition hover:border-white hover:bg-white/10">
                        Ijara Plans
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- LIVE OFFER — hidden on mobile (promo shown in hero) --}}
    @if ($hasPromo)
        <div class="border-b border-[#E4D8FF] bg-[#F2ECFF] max-md:hidden">
            <div class="litus-container flex flex-col gap-3 py-4 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-5 sm:py-5">
                <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-3.5">
                    <span class="inline-block rounded-md bg-[#F2ECFF] px-[11px] py-1.5 text-[10.5px] font-extrabold uppercase tracking-[0.08em] text-[#6941C6] ring-1 ring-[#6941C6]/20">Live Offer</span>
                    <b class="text-[13px] leading-snug text-litus-text sm:text-[15px]">{{ $motorcycle->offerLabel() }} on {{ $motorcycle->name }} - save {{ $motorcycle->formattedDiscount() }}</b>
                </div>
                <a href="#enquire"
                   class="inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-[17px] py-2.5 text-[13.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:w-auto">
                    Read the Full Offer
                    <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                </a>
            </div>
        </div>
    @endif

    {{-- SPECS + ENQUIRE --}}
    <section class="litus-sec" id="enquire">
        <div class="litus-container grid grid-cols-1 gap-8 min-[1000px]:grid-cols-[1.5fr_1fr] min-[1000px]:gap-12">
            <div>
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Technical Details</span>
                <h2 class="mb-5 font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text sm:mb-[26px]">
                    {{ $motorcycle->name }} specifications
                </h2>

                <div class="overflow-x-auto [-webkit-overflow-scrolling:touch]">
                    <table class="w-full min-w-[280px] overflow-hidden rounded-2xl border border-litus-line text-sm sm:rounded-[18px]">
                        <thead>
                            <tr class="bg-litus-ink text-left text-white">
                                <th class="px-4 py-3.5 text-[12.5px] font-semibold uppercase tracking-[0.05em]">Specification</th>
                                <th class="px-4 py-3.5 text-[12.5px] font-semibold uppercase tracking-[0.05em]">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specRows as $index => $spec)
                                <tr @class([
                                    'border-t border-litus-line',
                                    'bg-white' => $index % 2 === 0,
                                    'bg-litus-paper-2' => $index % 2 === 1,
                                ])>
                                    <td class="px-3 py-3 text-litus-text sm:px-4 sm:py-3.5">
                                        <span class="inline-flex items-center gap-2 sm:gap-2.5">
                                            <span class="grid h-7 w-7 shrink-0 place-items-center rounded-lg bg-litus-paper-3 text-litus-primary sm:h-8 sm:w-8">
                                                <x-spec-icon
                                                    :icon="$spec['icon'] ?? 'gauge'"
                                                    :icon-url="$spec['icon_url'] ?? null"
                                                    class="h-4 w-4" />
                                            </span>
                                            <span>{{ $spec['label'] }}</span>
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 text-[13px] font-semibold text-litus-text sm:px-4 sm:py-3.5 sm:text-sm">{{ $spec['value'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 rounded-r-[12px] border-l-4 border-litus-primary bg-[#EEF4FF] px-4 py-4 sm:mt-[26px] sm:px-6 sm:py-5">
                    <b class="mb-1.5 block text-[13.5px] text-litus-text sm:text-[14.5px]">Specifications shown are indicative</b>
                    <p class="m-0 text-[13px] leading-relaxed text-[#2A3548] sm:text-[14.5px]">
                        Final specification varies by variant and colour. Our sales team confirms the exact specification of the unit you are buying before you commit.
                    </p>
                </div>
            </div>

            <aside class="min-[1000px]:sticky min-[1000px]:top-[96px] min-[1000px]:self-start">
                <div class="rounded-[20px] border border-litus-line bg-white p-5 shadow-[0_2px_8px_rgba(9,17,32,0.06)] sm:rounded-[26px] sm:p-[clamp(26px,3vw,38px)] sm:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                    <h4 class="mb-4 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Enquire about this model</h4>

                    <form action="{{ route('contact') }}" method="get" class="space-y-4">
                        <input type="hidden" name="model" value="{{ $motorcycle->name }}">

                        <div>
                            <label for="enquiry-name" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-litus-text-2">Your name</label>
                            <input id="enquiry-name"
                                   type="text"
                                   name="name"
                                   placeholder="Full name"
                                   class="w-full rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 text-sm outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                        </div>

                        <div>
                            <label for="enquiry-phone" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-litus-text-2">Mobile number</label>
                            <input id="enquiry-phone"
                                   type="tel"
                                   name="phone"
                                   placeholder="7XXXXXX"
                                   class="w-full rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 text-sm outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                        </div>

                        <div>
                            <label for="enquiry-showroom" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-litus-text-2">Nearest showroom</label>
                            <div class="litus-select-wrap">
                                <select id="enquiry-showroom"
                                        name="showroom"
                                        class="litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 pr-10 text-sm outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                                    @foreach ($showrooms as $showroom)
                                        <option value="{{ $showroom }}">{{ $showroom }}</option>
                                    @endforeach
                                </select>
                                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                            </div>
                        </div>

                        <div>
                            <label for="enquiry-pay" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-litus-text-2">How you want to pay</label>
                            <div class="litus-select-wrap">
                                <select id="enquiry-pay"
                                        name="pay"
                                        class="litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 pr-10 text-sm outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                                    <option>Ijara monthly plan</option>
                                    <option>Full payment</option>
                                    <option>Not decided yet</option>
                                </select>
                                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                            </div>
                        </div>

                        <button type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3.5 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                            Send Enquiry
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>
                    </form>

                    <a href="https://wa.me/9607797442?text={{ $whatsappText }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="mt-2.5 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#1FA855] px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443]">
                        <x-litus-icon name="message-circle" class="h-4 w-4" />
                        WhatsApp Instead
                    </a>
                    <p class="mt-3.5 text-center text-xs text-litus-text-2">We reply within one working day.</p>
                </div>
            </aside>
        </div>
    </section>

    {{-- RELATED --}}
    <section class="litus-sec bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">You May Also Like</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Other models worth comparing</h2>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($related as $relatedMotorcycle)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <x-card.motorcycle-card :motorcycle="$relatedMotorcycle" />
                        </div>
                    @empty
                        <div class="col-span-full rounded-[18px] border border-dashed border-litus-line-2 px-6 py-12 text-center text-litus-text-2 max-md:w-full">
                            More models coming soon.
                        </div>
                    @endforelse
                </div>

                @if ($related->count() > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($related as $index => $relatedMotorcycle)
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

    {{-- CTA — hidden on mobile --}}
    <section class="litus-sec-tight bg-litus-ink text-white max-md:hidden">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Want to see it in person?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Tell us which showroom is nearest and we will confirm whether this model is on the floor before you travel.
                </p>
            </div>
            <div class="litus-cta-row">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Check Availability
                </a>
                <a href="tel:+9607797442"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    Call 779 7442
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
