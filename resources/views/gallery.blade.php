@extends('layouts.litus')

@section('title', 'Gallery - LITUS Automobiles')

@section('content')
<div class="font-sans" data-gallery-page>
    <script type="application/json" id="gallery-all-images">@json($allImages)</script>
    <script type="application/json" id="gallery-featured-moments">@json($featuredMoments)</script>
    <script type="application/json" id="gallery-cat-colors">@json($catColors)</script>

    <x-litus-header active="Gallery" />

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
                    LITUS Gallery
                </p>

                <h1 class="mb-4 font-montserrat text-[clamp(2.25rem,4.2vw,4.25rem)] font-bold leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:mb-2 max-md:text-[1.7rem] max-md:leading-[1.12]">
                    Ride the<br>
                    <span class="text-litus-red">Visual Journey</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] max-md:mb-3.5 max-md:max-w-[34ch] max-md:text-[13px] max-md:leading-snug sm:text-lg sm:leading-[1.55]">
                    Explore our collection of motorcycles, showroom moments, customer experiences, and lifestyle shots from LITUS Automobiles.
                </p>

                <div class="mb-6 flex flex-col items-stretch justify-start gap-2.5 max-md:mb-0 max-md:w-full max-md:flex-row max-md:gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7">
                    <button type="button"
                            data-gallery-scroll-grid
                            class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        View Gallery
                        <x-litus-icon name="images" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </button>
                    <a href="#gallery-video"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Watch Videos
                        <x-litus-icon name="play" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- EXPLORE MOMENTS --}}
    <section class="border-y border-[#dfe3ea] bg-[#f8f9fb] py-[35px] pb-11 max-[650px]:py-[30px] max-[650px]:pb-[38px] min-[651px]:px-5">
        <div class="litus-container">
            <div class="mb-[25px] grid grid-cols-1 items-start gap-[30px] min-[1051px]:grid-cols-[1fr_auto]">
                <div>
                    <h2 class="mb-2 font-montserrat text-[clamp(24px,6vw,30px)] font-bold tracking-[-0.7px] text-[#07152f] min-[651px]:text-[38px]">Explore LITUS Moments</h2>
                    <p class="max-w-[470px] text-sm font-semibold leading-normal text-[#667085] min-[651px]:text-base min-[651px]:leading-[1.5]">
                        Browse our collection of motorcycles, lifestyle shots, showroom images, and video highlights.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2.5 min-[1051px]:justify-end max-[650px]:-mx-4 max-[650px]:w-[calc(100%+2rem)] max-[650px]:flex-nowrap max-[650px]:overflow-x-auto max-[650px]:px-4 max-[650px]:pb-1 max-[650px]:[scrollbar-width:none] max-[650px]:[&::-webkit-scrollbar]:hidden">
                    @foreach ($momentCategories as $cat)
                        <button type="button"
                                data-gallery-moment-cat="{{ $cat }}"
                                @class([
                                    'h-12 shrink-0 rounded-[9px] border px-[26px] text-sm font-extrabold shadow-[0_6px_16px_rgba(0,0,0,0.05)] transition-all duration-300 max-[650px]:px-5',
                                    'border-litus-red bg-litus-red text-white' => $cat === 'All',
                                    'border-[#dfe3ea] bg-white text-[#1a2554] hover:border-litus-red hover:bg-litus-red hover:text-white' => $cat !== 'All',
                                ])>
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <div class="grid grid-cols-1 gap-4 max-[650px]:flex max-[650px]:snap-x max-[650px]:snap-mandatory max-[650px]:gap-3.5 max-[650px]:overflow-x-auto max-[650px]:scroll-smooth max-[650px]:pb-1 max-[650px]:[scrollbar-width:none] max-[650px]:[&::-webkit-scrollbar]:hidden min-[651px]:grid min-[651px]:grid-cols-2 min-[1051px]:grid-cols-[1.1fr_0.75fr_1fr] min-[1051px]:grid-rows-[260px_190px]"
                     data-gallery-moments-grid
                     data-gallery-moments-slider
                     data-interval="4000"></div>

                <div class="mt-4 hidden items-center justify-center gap-1.5 max-[650px]:flex" data-gallery-moments-dots aria-hidden="true"></div>
            </div>
        </div>
    </section>

    {{-- FULL GRID --}}
    <section id="gallery-grid-section" class="bg-gray-50 py-12 sm:py-16">
        <div class="litus-container">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Collection</span>
                    <h2 class="mt-1 font-montserrat text-2xl font-bold text-gray-900 lg:text-3xl">Motorcycles Gallery</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4" data-gallery-grid></div>

            <div class="mt-8 flex justify-center">
                <button type="button"
                        data-gallery-load-more
                        class="inline-flex items-center gap-2 rounded-full bg-litus-navy px-8 py-3 text-sm font-bold text-white transition-opacity hover:opacity-90">
                    Load More
                    <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                </button>
            </div>
            <p class="mt-6 hidden text-center text-sm text-gray-400" data-gallery-load-status></p>
        </div>
    </section>

    {{-- VIDEO --}}
    <section id="gallery-video" class="bg-white py-12 sm:py-16">
        <div class="litus-container flex flex-col items-center gap-10 lg:flex-row lg:gap-16">
            <div class="text-center lg:w-2/5 lg:text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Video Gallery</span>
                <h2 class="mt-2 mb-4 font-montserrat text-2xl font-bold text-gray-900 lg:text-3xl">
                    Watch the LITUS<br>Ride Experience
                </h2>
                <p class="mb-6 text-sm leading-relaxed text-gray-500">
                    Get a closer look at our motorcycles in action. Explore ride reviews, lifestyle journeys, and stories from our riders across the Maldives.
                </p>
                <button type="button"
                        data-gallery-video-play
                        class="mx-auto inline-flex items-center gap-2 rounded-full bg-litus-red px-7 py-3 text-sm font-bold text-white transition-opacity hover:opacity-90 lg:mx-0">
                    <x-litus-icon name="play" class="h-4 w-4" fill="currentColor" />
                    Watch Video
                </button>
            </div>

            <div class="w-full lg:w-3/5">
                <div class="relative overflow-hidden rounded-2xl bg-gray-900 shadow-2xl"
                     data-gallery-video
                     data-video-embed="{{ $videoEmbedUrl }}">
                    <div class="aspect-video w-full" data-gallery-video-player></div>

                    <button type="button"
                            data-gallery-video-play
                            class="group absolute inset-0 flex cursor-pointer flex-col items-center justify-center border-0 bg-transparent p-0 text-left"
                            aria-label="Play LITUS ride experience video">
                        <img src="{{ $videoThumb }}"
                             alt="LITUS Ride Experience"
                             class="absolute inset-0 h-full w-full object-cover opacity-80 transition-opacity duration-300 group-hover:opacity-70">
                        <div class="relative z-[1] flex h-20 w-20 items-center justify-center rounded-full bg-litus-red shadow-2xl transition-transform duration-300 group-hover:scale-110">
                            <x-litus-icon name="play" class="ml-1.5 h-7 w-7 text-white" fill="currentColor" />
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 z-[1] bg-gradient-to-t from-[rgba(6,14,28,0.9)] to-transparent px-5 py-4">
                            <p class="text-sm font-bold text-white">LITUS Automobiles - Latest Launches & Offers 2026</p>
                            <p class="mt-0.5 text-xs text-gray-400">Watch on YouTube · LITUS Official</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- CUSTOMER MOMENTS --}}
    <section id="gallery-customer-moments" class="scroll-mt-24 bg-[#f8f9fb] py-12 sm:py-16">
        <div class="litus-container">
            <div class="mb-8 max-w-[640px]">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Customer Moments</span>
                <h2 class="mt-1 font-montserrat text-2xl font-bold text-gray-900 lg:text-3xl">Real rides. Real people.</h2>
                <p class="mt-3 text-sm font-semibold leading-relaxed text-[#667085] lg:text-base">
                    Moments shared by LITUS riders across the Maldives.
                </p>
            </div>

            @php $customerMoments = $customerMoments ?? []; @endphp

            @if (count($customerMoments) > 0)
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4" data-gallery-customer-grid>
                    @foreach ($customerMoments as $image)
                        <button type="button"
                                data-gallery-open
                                data-img="{{ $image['img'] }}"
                                data-label="{{ $image['label'] ?: 'Customer Moment' }}"
                                class="group relative aspect-[4/5] overflow-hidden rounded-2xl bg-[#0b1528] text-left shadow-[0_10px_28px_rgba(7,21,47,0.12)]">
                            <img src="{{ $image['img'] }}"
                                 alt="{{ $image['label'] ?? 'Customer moment' }}"
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy">
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#07152f]/70 via-transparent to-transparent opacity-80"></div>
                            <span class="absolute left-3 top-3 rounded-md bg-[#16A34A] px-2.5 py-1 text-[10.5px] font-extrabold uppercase tracking-[0.08em] text-white">
                                Customer Moment
                            </span>
                            @if (! empty($image['label']))
                                <span class="absolute bottom-3 left-3 right-3 text-[13px] font-bold text-white">
                                    {{ $image['label'] }}
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-[#cfd6e0] bg-white px-6 py-16 text-center text-sm font-semibold text-[#667085]">
                    Customer moments coming soon.
                </div>
            @endif
        </div>
    </section>

    <x-litus-footer />

    {{-- LIGHTBOX --}}
    <div data-gallery-lightbox class="fixed inset-0 z-[80] hidden flex items-center justify-center bg-black/90 p-4">
        <button type="button"
                data-gallery-lightbox-close
                class="absolute right-5 top-5 z-[2] flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-white/20 max-md:top-[max(1.25rem,env(safe-area-inset-top))]"
                aria-label="Close lightbox">
            <x-litus-icon name="x" class="h-5 w-5" />
        </button>

        <button type="button"
                data-gallery-lightbox-prev
                onclick="event.stopPropagation()"
                class="absolute left-3 top-1/2 z-[2] flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/25 max-md:h-10 max-md:w-10 sm:left-5"
                aria-label="Previous image">
            <x-litus-icon name="chevron-left" class="h-6 w-6" />
        </button>
        <button type="button"
                data-gallery-lightbox-next
                onclick="event.stopPropagation()"
                class="absolute right-3 top-1/2 z-[2] flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/25 max-md:h-10 max-md:w-10 sm:right-5"
                aria-label="Next image">
            <x-litus-icon name="chevron-right" class="h-6 w-6" />
        </button>

        <div class="w-full max-w-4xl" onclick="event.stopPropagation()">
            <img data-gallery-lightbox-img src="" alt="" class="max-h-[80vh] w-full rounded-xl object-contain shadow-2xl">
            <p data-gallery-lightbox-label class="mt-4 text-center text-base font-bold text-white"></p>
            <p data-gallery-lightbox-counter class="mt-1.5 text-center text-xs font-semibold text-white/60"></p>
        </div>
    </div>
</div>
@endsection
