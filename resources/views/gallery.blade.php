@extends('layouts.litus')

@section('title', 'Gallery - LITUS Automobiles')

@section('content')
<div class="font-sans" data-gallery-page>
    <script type="application/json" id="gallery-all-images">@json($allImages)</script>
    <script type="application/json" id="gallery-featured-moments">@json($featuredMoments)</script>
    <script type="application/json" id="gallery-cat-colors">@json($catColors)</script>

    <x-litus-header active="Gallery" />

    {{-- HERO — desktop --}}
    <section class="relative hidden min-h-[680px] overflow-hidden border border-[rgba(27,74,120,0.45)] bg-[#06101c] pb-[82px] min-[961px]:block max-[1100px]:min-h-0 max-[1100px]:pb-8">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">

        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(3,11,22,0.98)_0%,rgba(3,11,22,0.88)_32%,rgba(3,11,22,0.48)_58%,rgba(3,11,22,0.25)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_70%_35%,rgba(255,255,255,0.08),transparent_28%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.1),rgba(2,10,19,0.95))]"></div>

        <div class="relative z-[2] litus-container pb-12 pt-16 sm:pt-20">
            <div class="max-w-[720px] text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] sm:text-lg">
                    LITUS Gallery
                </p>

                <h1 class="mb-4 font-montserrat text-[clamp(2.25rem,4.2vw,4.25rem)] font-bold leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)]">
                    Ride the<br>
                    <span class="text-litus-red">Visual Journey</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55]">
                    Explore our collection of motorcycles, showroom moments, customer experiences, and lifestyle shots from LITUS Automobiles.
                </p>

                <div class="mb-6 flex flex-col items-stretch justify-start gap-2.5 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7">
                    <button type="button"
                            data-gallery-scroll-grid
                            class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        View Gallery
                        <x-litus-icon name="images" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </button>
                    <a href="#gallery-video"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Watch Videos
                        <x-litus-icon name="play" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- HERO — mobile --}}
    <section class="relative overflow-hidden border-b border-[rgba(27,74,120,0.45)] bg-[#06101c] min-[961px]:hidden">
        <img src="{{ $heroBg }}"
             alt=""
             class="pointer-events-none absolute inset-0 h-full w-full object-cover object-[center_30%] opacity-[0.35]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(11,22,40,0.55)_0%,rgba(11,22,40,0.78)_42%,rgba(11,22,40,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.1),rgba(2,10,19,0.95))]"></div>

        <div class="relative z-[2] flex flex-col">
            <div class="litus-container pt-12 pb-4">
                <div class="max-w-[36rem]">
                    <p class="mb-3 text-[10px] font-extrabold uppercase tracking-[0.18em] text-[#0065ef]">
                        LITUS Gallery
                    </p>
                    <h1 class="max-w-[18ch] font-montserrat text-[clamp(1.7rem,7vw,2.25rem)] font-bold leading-[1.12] tracking-[-0.02em] text-white">
                        Ride the <span class="text-litus-red">Visual Journey</span>
                    </h1>
                    <p class="mt-3 line-clamp-4 max-w-[38ch] text-[13px] leading-snug text-[#e6edf5]/90">
                        Explore motorcycles, showroom moments, customer experiences, and lifestyle shots from LITUS Automobiles.
                    </p>
                </div>
            </div>

            <div class="litus-container pb-4">
                <div class="flex flex-row gap-2">
                    <button type="button"
                            data-gallery-scroll-grid
                            class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-[#0065ef] px-3 text-[13px] font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition hover:bg-[#0052cc]">
                        View Gallery
                        <x-litus-icon name="images" class="h-3.5 w-3.5 shrink-0" />
                    </button>
                    <a href="#gallery-video"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl border border-white/35 bg-white/[0.06] px-3 text-[13px] font-extrabold text-white transition hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)]">
                        Watch Videos
                        <x-litus-icon name="play" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                </div>
            </div>

            <x-litus-hero-features :features="$heroFeatures" />
        </div>
    </section>

    {{-- EXPLORE MOMENTS --}}
    <section class="border-y border-[#dfe3ea] bg-[#f8f9fb] py-7 pb-9 max-md:py-6 max-md:pb-8 md:px-5 md:py-[35px] md:pb-11">
        <div class="litus-container">
            <div class="mb-6 grid grid-cols-1 items-start gap-5 max-md:mb-5 md:mb-[25px] md:gap-[30px] lg:grid-cols-[1fr_auto]">
                <div>
                    <h2 class="mb-2 font-montserrat text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.7px] text-[#07152f]">Explore LITUS Moments</h2>
                    <p class="max-w-[470px] text-[13px] font-semibold leading-snug text-[#667085] md:text-base md:leading-[1.5]">
                        Browse our collection of motorcycles, lifestyle shots, showroom images, and video highlights.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2.5 max-md:-mx-4 max-md:w-[calc(100%+2rem)] max-md:flex-nowrap max-md:overflow-x-auto max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden lg:justify-end">
                    @foreach ($momentCategories as $cat)
                        <button type="button"
                                data-gallery-moment-cat="{{ $cat }}"
                                @class([
                                    'h-11 shrink-0 rounded-[9px] border px-5 text-[13px] font-extrabold shadow-[0_6px_16px_rgba(0,0,0,0.05)] transition-all duration-300 md:h-12 md:px-[26px] md:text-sm',
                                    'border-litus-red bg-litus-red text-white' => $cat === 'All',
                                    'border-[#dfe3ea] bg-white text-[#1a2554] hover:border-litus-red hover:bg-litus-red hover:text-white' => $cat !== 'All',
                                ])>
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <div class="grid grid-cols-1 gap-4 max-md:flex max-md:snap-x max-md:snap-mandatory max-md:gap-3.5 max-md:overflow-x-auto max-md:scroll-smooth max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden md:grid md:grid-cols-2 lg:grid-cols-[1.1fr_0.75fr_1fr] lg:grid-rows-[260px_190px]"
                     data-gallery-moments-grid
                     data-gallery-moments-slider
                     data-interval="4000"></div>

                <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-gallery-moments-dots aria-hidden="true"></div>
            </div>
        </div>
    </section>

    {{-- FULL GRID --}}
    <section id="gallery-grid-section" class="scroll-mt-20 bg-gray-50 py-10 max-md:py-8 sm:py-16">
        <div class="litus-container">
            <div class="mb-6 flex items-end justify-between max-md:mb-5 sm:mb-8">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-litus-red md:text-xs md:tracking-widest">Our Collection</span>
                    <h2 class="mt-1 font-montserrat text-[clamp(22px,5.5vw,40px)] font-bold text-gray-900">Motorcycles Gallery</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2.5 max-md:gap-2 sm:grid-cols-3 sm:gap-3 lg:grid-cols-4" data-gallery-grid></div>

            <div class="mt-6 flex justify-center max-md:mt-5 sm:mt-8">
                <button type="button"
                        data-gallery-load-more
                        class="inline-flex min-h-11 items-center gap-2 rounded-full bg-litus-navy px-6 py-2.5 text-[13px] font-bold text-white transition-opacity hover:opacity-90 max-md:px-5 sm:px-8 sm:py-3 sm:text-sm">
                    Load More
                    <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                </button>
            </div>
            <p class="mt-4 hidden text-center text-[13px] text-gray-400 max-md:mt-3 sm:mt-6 sm:text-sm" data-gallery-load-status></p>
        </div>
    </section>

    {{-- VIDEO --}}
    <section id="gallery-video" class="scroll-mt-20 bg-white py-10 max-md:py-8 sm:py-16">
        <div class="litus-container flex flex-col items-center gap-6 max-md:gap-7 lg:flex-row lg:gap-16">
            <div class="text-center lg:w-2/5 lg:text-left">
                <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-litus-red md:text-xs md:tracking-widest">Video Gallery</span>
                <h2 class="mt-2 mb-3 font-montserrat text-[clamp(22px,5.5vw,40px)] font-bold text-gray-900 max-md:mb-2.5">
                    Watch the LITUS<br>Ride Experience
                </h2>
                <p class="mb-5 text-[13px] leading-relaxed text-gray-500 max-md:mb-4 max-md:mx-auto max-md:max-w-[36ch] sm:mb-6 sm:text-sm">
                    Get a closer look at our motorcycles in action. Explore ride reviews, lifestyle journeys, and stories from our riders across the Maldives.
                </p>
                <button type="button"
                        data-gallery-video-play
                        class="mx-auto inline-flex min-h-11 items-center gap-2 rounded-full bg-litus-red px-6 py-2.5 text-[13px] font-bold text-white transition-opacity hover:opacity-90 max-md:px-5 sm:px-7 sm:py-3 sm:text-sm lg:mx-0">
                    <x-litus-icon name="play" class="h-4 w-4" fill="currentColor" />
                    Watch Video
                </button>
            </div>

            <div class="flex w-full flex-wrap justify-center gap-4 sm:gap-5 lg:w-3/5 lg:justify-end">
                @foreach ($galleryVideos as $video)
                    <div class="relative w-full max-w-[300px] overflow-hidden rounded-xl bg-black shadow-2xl sm:max-w-[340px] max-md:rounded-2xl"
                         data-gallery-video
                         data-video-embed="{{ $video['embed_url'] }}">
                        <div class="aspect-[9/16] w-full" data-gallery-video-player></div>

                        <button type="button"
                                data-gallery-video-play
                                class="group absolute inset-0 flex cursor-pointer flex-col items-center justify-center border-0 bg-transparent p-0 text-left"
                                aria-label="Play LITUS ride experience video">
                            <img src="{{ $video['thumb'] }}"
                                 alt="{{ $video['title'] }}"
                                 class="absolute inset-0 h-full w-full object-cover object-center opacity-80 transition-opacity duration-300 group-hover:opacity-70">
                            <div class="relative z-[1] flex h-14 w-14 items-center justify-center rounded-full bg-litus-red shadow-2xl transition-transform duration-300 group-hover:scale-110 max-md:h-16 max-md:w-16 sm:h-20 sm:w-20">
                                <x-litus-icon name="play" class="ml-1 h-5 w-5 text-white max-md:h-6 max-md:w-6 sm:ml-1.5 sm:h-7 sm:w-7" fill="currentColor" />
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 z-[1] bg-gradient-to-t from-[rgba(6,14,28,0.9)] to-transparent px-4 py-3 max-md:px-3 max-md:py-2.5 sm:px-5 sm:py-4">
                                <p class="text-[12px] font-bold text-white max-md:line-clamp-2 sm:text-sm">{{ $video['title'] }}</p>
                                <p class="mt-0.5 text-[10px] text-gray-400 sm:text-xs">Watch on TikTok · @litus.automobiles</p>
                            </div>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CUSTOMER MOMENTS --}}
    <section id="gallery-customer-moments" class="scroll-mt-20 bg-[#f8f9fb] py-10 max-md:py-8 sm:py-16">
        <div class="litus-container">
            <div class="mb-6 max-w-[640px] max-md:mb-5 sm:mb-8">
                <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-litus-red md:text-xs md:tracking-widest">Customer Moments</span>
                <h2 class="mt-1 font-montserrat text-[clamp(22px,5.5vw,40px)] font-bold text-gray-900">Real rides. Real people.</h2>
                <p class="mt-2.5 text-[13px] font-semibold leading-relaxed text-[#667085] max-md:mt-2 sm:mt-3 sm:text-sm lg:text-base">
                    Moments shared by LITUS riders across the Maldives.
                </p>
            </div>

            @php $customerMoments = $customerMoments ?? []; @endphp

            @if (count($customerMoments) > 0)
                <div class="grid grid-cols-2 gap-2.5 max-md:gap-2 sm:grid-cols-3 sm:gap-3 lg:grid-cols-4" data-gallery-customer-grid>
                    @foreach ($customerMoments as $image)
                        <button type="button"
                                data-gallery-open
                                data-img="{{ $image['img'] }}"
                                data-label="{{ $image['label'] ?: 'Customer Moment' }}"
                                class="group relative aspect-[4/5] overflow-hidden rounded-xl bg-[#0b1528] text-left shadow-[0_10px_28px_rgba(7,21,47,0.12)] max-md:rounded-lg sm:rounded-2xl">
                            <img src="{{ $image['img'] }}"
                                 alt="{{ $image['label'] ?? 'Customer moment' }}"
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy">
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#07152f]/70 via-transparent to-transparent opacity-80"></div>
                            <span class="absolute left-2 top-2 rounded-md bg-[#16A34A] px-2 py-0.5 text-[9px] font-extrabold uppercase tracking-[0.08em] text-white max-md:text-[8.5px] sm:left-3 sm:top-3 sm:px-2.5 sm:py-1 sm:text-[10.5px]">
                                Customer Moment
                            </span>
                            @if (! empty($image['label']))
                                <span class="absolute bottom-2 left-2 right-2 text-[12px] font-bold text-white max-md:line-clamp-2 sm:bottom-3 sm:left-3 sm:right-3 sm:text-[13px]">
                                    {{ $image['label'] }}
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-dashed border-[#cfd6e0] bg-white px-5 py-12 text-center text-[13px] font-semibold text-[#667085] max-md:py-10 sm:rounded-2xl sm:px-6 sm:py-16 sm:text-sm">
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
