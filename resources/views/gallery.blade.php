@extends('layouts.litus')

@section('title', 'Gallery — LITUS Automobiles')

@section('content')
<div class="font-sans" data-gallery-page>
    <script type="application/json" id="gallery-all-images">@json($allImages)</script>
    <script type="application/json" id="gallery-featured-moments">@json($featuredMoments)</script>
    <script type="application/json" id="gallery-cat-colors">@json($catColors)</script>

    <x-litus-header active="Gallery" />

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
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] sm:text-lg max-md:text-[15px]">
                    LITUS Gallery
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:text-[2.25rem]">
                    Ride the<br>
                    <span class="text-litus-red">Visual Journey</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55] max-md:text-[17px]">
                    Explore our collection of motorcycles, showroom moments, customer experiences, and lifestyle shots from LITUS Automobiles.
                </p>

                <div class="mb-6 flex flex-row flex-wrap items-center justify-start gap-5 sm:gap-7">
                    <button type="button"
                            data-gallery-scroll-grid
                            class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        View Gallery
                        <x-litus-icon name="images" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </button>
                    <a href="#gallery-video"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Watch Videos
                        <x-litus-icon name="play" class="h-4 w-4 sm:h-5 sm:w-5" />
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

    {{-- EXPLORE MOMENTS --}}
    <section class="border border-[#dfe3ea] bg-[#f8f9fb] px-5 py-[35px] pb-11 max-[650px]:px-3.5 max-[650px]:py-[30px] max-[650px]:pb-[38px]">
        <div class="litus-container">
            <div class="mb-[25px] grid grid-cols-1 items-start gap-[30px] min-[1051px]:grid-cols-[1fr_auto]">
                <div>
                    <h2 class="mb-2 font-display text-[30px] font-black tracking-[-0.7px] text-[#07152f] min-[651px]:text-[38px]">Explore LITUS Moments</h2>
                    <p class="max-w-[470px] text-sm font-semibold leading-normal text-[#667085] min-[651px]:text-base min-[651px]:leading-[1.5]">
                        Browse our collection of motorcycles, lifestyle shots, showroom images, and video highlights.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2.5 min-[1051px]:justify-end max-[650px]:w-full">
                    @foreach ($momentCategories as $cat)
                        <button type="button"
                                data-gallery-moment-cat="{{ $cat }}"
                                @class([
                                    'h-12 rounded-[9px] border px-[26px] text-sm font-extrabold shadow-[0_6px_16px_rgba(0,0,0,0.05)] transition-all duration-300 max-[650px]:w-full',
                                    'border-litus-red bg-litus-red text-white' => $cat === 'All',
                                    'border-[#dfe3ea] bg-white text-[#1a2554] hover:border-litus-red hover:bg-litus-red hover:text-white' => $cat !== 'All',
                                ])>
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 min-[1051px]:grid-cols-[1.1fr_0.75fr_1fr] min-[1051px]:grid-rows-[260px_190px] max-[1050px]:min-[651px]:grid-cols-2"
                 data-gallery-moments-grid></div>
        </div>
    </section>

    {{-- FULL GRID --}}
    <section id="gallery-grid-section" class="bg-gray-50 py-16">
        <div class="litus-container">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Collection</span>
                    <h2 class="mt-1 font-display text-2xl font-black text-gray-900 lg:text-3xl">Motorcycles Gallery</h2>
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
    <section id="gallery-video" class="bg-white py-16">
        <div class="litus-container flex flex-col items-center gap-10 lg:flex-row lg:gap-16">
            <div class="text-center lg:w-2/5 lg:text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Video Gallery</span>
                <h2 class="mt-2 mb-4 font-display text-2xl font-black text-gray-900 lg:text-3xl">
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
                            <p class="text-sm font-bold text-white">LITUS Automobiles — Latest Launches & Offers 2026</p>
                            <p class="mt-0.5 text-xs text-gray-400">Watch on YouTube · LITUS Official</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- SOCIAL --}}
    <section class="bg-[#f8f9fb] px-5 py-[35px] max-[520px]:px-3.5 max-[520px]:py-[30px]">
        <div class="litus-container">
            @php
                $socialLogo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
                $socialLinks = [
                    ['icon' => 'facebook', 'label' => 'Facebook', 'handle' => '/LITUSAutomobiles', 'href' => '#', 'iconClass' => 'bg-[#1877f2]'],
                    ['icon' => 'instagram', 'label' => 'Instagram', 'handle' => '@litusautomobiles', 'href' => '#', 'iconClass' => 'bg-gradient-to-br from-[#833ab4] via-[#fd1d1d] to-[#fcb045]'],
                    ['icon' => 'message-circle', 'label' => 'WhatsApp', 'handle' => '+960 779 7442', 'href' => 'https://wa.me/9607797442', 'iconClass' => 'bg-[#25d366]'],
                ];
            @endphp

            <div class="rounded-[20px] border border-[#e8ecf2] bg-white shadow-[0_12px_40px_rgba(7,21,47,0.08)]">
                <div class="flex flex-col gap-6 p-5 sm:p-6 min-[1401px]:flex-row min-[1401px]:items-center min-[1401px]:gap-5 min-[1401px]:px-7 min-[1401px]:py-6">
                    <div class="flex items-center gap-4 min-[1401px]:shrink-0">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#07152f] p-3 shadow-[0_8px_20px_rgba(7,21,47,0.18)] min-[1401px]:h-[68px] min-[1401px]:w-[68px] min-[1401px]:p-3.5">
                            <img src="{{ $socialLogo }}" alt="LITUS Automobiles" class="h-full w-full object-contain">
                        </div>
                        <div class="hidden h-12 w-px shrink-0 bg-[#dfe3ea] min-[1401px]:block"></div>
                        <div class="min-w-0">
                            <h2 class="mb-1 text-[17px] font-black leading-tight text-[#07152f] min-[521px]:text-[19px] min-[1401px]:text-[18px]">
                                Follow Our Latest Rides
                            </h2>
                            <p class="text-[12px] font-semibold leading-snug text-[#667085] min-[521px]:text-[13px] min-[1401px]:max-w-[220px]">
                                Stay connected for new arrivals, exclusive offers, showroom updates, and ride moments.
                            </p>
                        </div>
                    </div>

                    <div class="hidden w-px self-stretch bg-[#dfe3ea] min-[1401px]:block"></div>

                    <div class="flex min-w-0 flex-1 flex-col gap-5 min-[1401px]:flex-row min-[1401px]:items-center min-[1401px]:justify-between min-[1401px]:gap-4">
                        <div class="grid grid-cols-1 gap-3 min-[601px]:grid-cols-3 min-[1401px]:flex min-[1401px]:min-w-0 min-[1401px]:flex-1 min-[1401px]:items-center min-[1401px]:justify-center min-[1401px]:gap-0">
                            @foreach ($socialLinks as $index => $social)
                                @if ($index > 0)
                                    <div class="hidden h-10 w-px shrink-0 bg-[#dfe3ea] min-[1401px]:block"></div>
                                @endif
                                <a href="{{ $social['href'] }}"
                                   @if (str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                                   class="group flex items-center gap-2.5 transition-opacity hover:opacity-80 min-[1401px]:shrink-0 min-[1401px]:px-3">
                                    <div @class([
                                        'flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-white shadow-[0_6px_16px_rgba(0,0,0,0.14)] min-[521px]:h-11 min-[521px]:w-11',
                                        $social['iconClass'],
                                    ])>
                                        <x-litus-icon :name="$social['icon']" class="h-[18px] w-[18px]" fill="currentColor" />
                                    </div>
                                    <div class="min-w-0 text-left">
                                        <h3 class="text-[13px] font-extrabold text-[#07152f]">{{ $social['label'] }}</h3>
                                        <p class="text-[11px] font-semibold text-[#667085] min-[1401px]:whitespace-nowrap">{{ $social['handle'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="hidden w-px self-stretch bg-[#dfe3ea] min-[1401px]:block"></div>

                        <div class="flex shrink-0 flex-wrap items-center justify-center gap-3 min-[1401px]:justify-end">
                            <a href="#"
                               class="inline-flex h-10 shrink-0 items-center justify-center gap-2 rounded-full bg-[#061a45] px-5 text-[13px] font-black text-white shadow-[0_8px_20px_rgba(6,26,69,0.22)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0065ef] min-[521px]:h-11 min-[521px]:px-6 min-[521px]:text-sm">
                                <x-litus-icon name="users" class="h-4 w-4" />
                                Follow Us
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex h-10 shrink-0 items-center justify-center gap-2 rounded-full border-2 border-[#66a3ff] bg-white px-5 text-[13px] font-black text-[#0065ef] transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[#0065ef] hover:text-white min-[521px]:h-11 min-[521px]:px-6 min-[521px]:text-sm">
                                <x-litus-icon name="phone" class="h-4 w-4" />
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-litus-footer />

    {{-- LIGHTBOX --}}
    <div data-gallery-lightbox class="fixed inset-0 z-[80] hidden flex items-center justify-center bg-black/90 p-4">
        <button type="button"
                data-gallery-lightbox-close
                class="absolute right-5 top-5 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-white/20"
                aria-label="Close lightbox">
            <x-litus-icon name="x" class="h-5 w-5" />
        </button>
        <div class="w-full max-w-4xl" onclick="event.stopPropagation()">
            <img data-gallery-lightbox-img src="" alt="" class="max-h-[80vh] w-full rounded-xl object-contain shadow-2xl">
            <p data-gallery-lightbox-label class="mt-4 text-center text-base font-bold text-white"></p>
        </div>
    </div>
</div>
@endsection
