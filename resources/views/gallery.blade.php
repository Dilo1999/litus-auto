@extends('layouts.litus')

@section('title', 'Gallery — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/motorcycles/' . rawurlencode('ChatGPT Image Jul 3, 2026, 02_50_01 PM.png'));
    $videoUrl = 'https://youtu.be/o8grf3wSwQU';
    $videoThumb = 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1000&q=80';

    $catColors = [
        'Motorcycles' => '#E31E25',
        'Scooter' => '#3B82F6',
        'Showroom' => '#7C3AED',
        'Customer Moments' => '#16A34A',
    ];

    $allImages = [
        ['id' => 1,  'cat' => 'Motorcycles',      'label' => 'Adventure Awaits',        'img' => 'https://images.unsplash.com/photo-1759665973333-76aafabd7247?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=900&q=80'],
        ['id' => 2,  'cat' => 'Scooter',          'label' => 'Urban Freedom',           'img' => 'https://images.unsplash.com/photo-1761744384561-0dc984f510c2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 3,  'cat' => 'Showroom',         'label' => 'LITUS Showroom, Malé',    'img' => 'https://images.unsplash.com/photo-1671354925315-229af5178a83?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 4,  'cat' => 'Motorcycles',      'label' => 'Grand Vibes',             'img' => 'https://images.unsplash.com/photo-1777991412484-8fa8cb512e6b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 5,  'cat' => 'Customer Moments', 'label' => 'Ride with Confidence',    'img' => 'https://images.unsplash.com/photo-1767543153176-7ac37c535af6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 6,  'cat' => 'Motorcycles',      'label' => 'Coastal Cruising',        'img' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 7,  'cat' => 'Scooter',          'label' => 'Island Ride',             'img' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 8,  'cat' => 'Motorcycles',      'label' => 'Street Style',            'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 9,  'cat' => 'Showroom',         'label' => 'Premium Display',         'img' => 'https://images.unsplash.com/photo-1676246751280-16f3d4d0db7a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 10, 'cat' => 'Customer Moments', 'label' => 'Happy Riders',            'img' => 'https://images.unsplash.com/photo-1598077737122-925e6f7cf137?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 11, 'cat' => 'Motorcycles',      'label' => 'Ready to Ride',           'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 12, 'cat' => 'Scooter',          'label' => 'Palm Street Cruise',      'img' => 'https://images.unsplash.com/photo-1778874294856-a3e32a698216?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 13, 'cat' => 'Motorcycles',      'label' => 'Power & Precision',       'img' => 'https://images.unsplash.com/photo-1601556402552-23ce8f2b31fc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 14, 'cat' => 'Showroom',         'label' => 'Showroom Floor',          'img' => 'https://images.unsplash.com/photo-1692201841147-3c1c5f87cb05?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 15, 'cat' => 'Customer Moments', 'label' => 'Family Ride Day',         'img' => 'https://images.unsplash.com/photo-1683914791874-3d7cd42e2543?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 16, 'cat' => 'Motorcycles',      'label' => 'Sunset Trail',            'img' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 17, 'cat' => 'Scooter',          'label' => 'City Flow',               'img' => 'https://images.unsplash.com/photo-1611956292173-c2445aa61709?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
        ['id' => 18, 'cat' => 'Customer Moments', 'label' => 'Delivery Ready',          'img' => 'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=700&q=80'],
    ];

    $featuredMoments = [
        ['id' => 1, 'label' => 'Adventure Awaits',       'cat' => 'Motorcycles',      'badge' => 'Motorcycle',       'badgeRed' => false, 'img' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=900&q=80', 'large' => true],
        ['id' => 2, 'label' => 'Urban Freedom',          'cat' => 'Scooter',          'badge' => 'Scooter',          'badgeRed' => false, 'img' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?auto=format&fit=crop&w=700&q=80'],
        ['id' => 3, 'label' => 'LITUS Showroom, Malé',  'cat' => 'Showroom',         'badge' => 'Showroom',         'badgeRed' => false, 'img' => 'https://images.unsplash.com/photo-1560472355-536de3962603?auto=format&fit=crop&w=800&q=80'],
        ['id' => 4, 'label' => 'Island Vibes',           'cat' => 'Motorcycles',      'badge' => 'Lifestyle',        'badgeRed' => true,  'img' => 'https://images.unsplash.com/photo-1600705722908-bab8f59a0862?auto=format&fit=crop&w=700&q=80'],
        ['id' => 5, 'label' => 'Ride with Confidence',   'cat' => 'Customer Moments', 'badge' => 'Customer Moment',  'badgeRed' => true,  'img' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=700&q=80'],
    ];

    $momentCategories = ['All', 'Motorcycles', 'Scooters', 'Showrooms', 'Customer Moments', 'Videos'];

    $heroFeatures = [
        ['icon' => 'bike', 'title' => 'Motorcycles', 'desc' => 'Adventure & street ride moments'],
        ['icon' => 'disc', 'title' => 'Scooters', 'desc' => 'Urban mobility across the islands'],
        ['icon' => 'eye', 'title' => 'Showroom', 'desc' => 'Premium display & launch highlights'],
        ['icon' => 'users', 'title' => 'Customer Moments', 'desc' => 'Real experiences from our riders'],
    ];
@endphp

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
                    Explore our collection of motorcycles, scooters, showroom moments, customer experiences, and lifestyle shots from LITUS Automobiles.
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
                        Browse our collection of motorcycles, scooters, lifestyle shots, showroom images, and video highlights.
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
                    <h2 class="mt-1 font-display text-2xl font-black text-gray-900 lg:text-3xl">Motorcycles & Scooter Gallery</h2>
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
                <a href="{{ $videoUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mx-auto inline-flex items-center gap-2 rounded-full bg-litus-red px-7 py-3 text-sm font-bold text-white transition-opacity hover:opacity-90 lg:mx-0">
                    <x-litus-icon name="play" class="h-4 w-4" fill="currentColor" />
                    Watch Video
                </a>
            </div>

            <div class="w-full lg:w-3/5">
                <a href="{{ $videoUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="group relative block cursor-pointer overflow-hidden rounded-2xl bg-gray-900 shadow-2xl">
                    <img src="{{ $videoThumb }}"
                         alt="LITUS Ride Experience"
                         class="h-64 w-full object-cover opacity-80 transition-opacity duration-300 group-hover:opacity-70 lg:h-80">
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-litus-red shadow-2xl transition-transform duration-300 group-hover:scale-110">
                            <x-litus-icon name="play" class="ml-1.5 h-7 w-7 text-white" fill="currentColor" />
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[rgba(6,14,28,0.9)] to-transparent px-5 py-4">
                        <p class="text-sm font-bold text-white">LITUS Automobiles — Latest Launches & Offers 2026</p>
                        <p class="mt-0.5 text-xs text-gray-400">Watch on YouTube · LITUS Official</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- SOCIAL --}}
    <section class="border border-[#dfe3ea] bg-[#f8f9fb] px-5 py-[35px] max-[520px]:px-3.5 max-[520px]:py-[30px]">
        <div class="litus-container grid grid-cols-1 items-center gap-7 min-[1151px]:grid-cols-[280px_1fr_260px] max-[1150px]:text-center">
            <div>
                <h2 class="mb-4 font-display text-[31px] font-black leading-[1.05] tracking-[-0.7px] text-[#07152f] min-[521px]:text-[38px]">
                    Follow Our<br>Latest Rides
                </h2>
                <p class="max-w-[260px] text-[15px] font-semibold leading-[1.55] text-[#667085] max-[1150px]:mx-auto max-[1150px]:max-w-[520px]">
                    Stay connected for new arrivals, exclusive offers, showroom updates, and ride moments.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-[18px] min-[801px]:grid-cols-3 max-[800px]:mx-auto max-[800px]:w-full max-[800px]:max-w-[520px]">
                @foreach ([
                    ['icon' => 'facebook', 'label' => 'Facebook', 'handle' => '/LITUSAutomobiles', 'iconClass' => 'bg-[#1877f2]'],
                    ['icon' => 'instagram', 'label' => 'Instagram', 'handle' => '@litusautomobiles', 'iconClass' => 'bg-gradient-to-br from-[#833ab4] via-[#fd1d1d] to-[#fcb045]'],
                    ['icon' => 'message-circle', 'label' => 'WhatsApp', 'handle' => '+960 779 7442', 'iconClass' => 'bg-[#25d366]'],
                ] as $social)
                    <a href="#"
                       class="group flex min-h-[125px] items-center gap-[22px] rounded-xl border border-[#dfe3ea] bg-white px-7 py-6 shadow-[0_10px_26px_rgba(0,0,0,0.06)] transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_16px_36px_rgba(0,0,0,0.1)] max-[520px]:px-[22px]">
                        <div @class([
                            'flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-xl text-white shadow-[0_8px_20px_rgba(0,0,0,0.16)] min-[521px]:h-[66px] min-[521px]:w-[66px]',
                            $social['iconClass'],
                        ])>
                            <x-litus-icon :name="$social['icon']" class="h-7 w-7 min-[521px]:h-8 min-[521px]:w-8" fill="currentColor" />
                        </div>
                        <div class="text-left">
                            <h3 class="mb-2 text-lg font-extrabold text-[#07152f]">{{ $social['label'] }}</h3>
                            <p class="text-sm font-semibold text-[#4f5b6c]">{{ $social['handle'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="flex flex-col gap-4 max-[1150px]:mx-auto max-[1150px]:w-full max-[1150px]:max-w-[420px]">
                <a href="#"
                   class="inline-flex h-[58px] w-full items-center justify-center gap-3 rounded-[9px] border-2 border-litus-red bg-litus-red text-[17px] font-black text-white shadow-[0_10px_24px_rgba(0,101,239,0.25)] transition-all duration-300 hover:-translate-y-[3px] hover:border-[#0052cc] hover:bg-[#0052cc]">
                    <x-litus-icon name="users" class="h-6 w-6" />
                    Follow Us
                </a>
                <a href="tel:+9607797442"
                   class="inline-flex h-[58px] w-full items-center justify-center gap-3 rounded-[9px] border-2 border-[#66a3ff] bg-white text-[17px] font-black text-litus-red transition-all duration-300 hover:-translate-y-[3px] hover:border-litus-red hover:bg-litus-red hover:text-white">
                    <x-litus-icon name="phone" class="h-6 w-6" />
                    Contact Us
                </a>
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
