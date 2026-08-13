@extends('layouts.litus')

@section('title', 'LITUS Automobiles — Motorcycles, Scooters & Ijara Ownership Plans in the Maldives')

@section('content')
@php
    $promoMotorcycles = $promoMotorcycles ?? collect();
    $topRides = $topRides ?? [];
    $campaignCount = $promoMotorcycles->count();

    $whyLitus = [
        [
            'icon' => 'file-text',
            'title' => 'Application made easy',
            'text' => 'We removed the bureaucracy from motorcycle leasing. Most applications need fewer documents and less waiting than customers expect.',
        ],
        [
            'icon' => 'shield',
            'title' => 'Genuine parts only',
            'text' => 'Every part we fit is genuine and traceable. It protects your warranty, your resale value and — with brakes and tyres — your safety.',
        ],
        [
            'icon' => 'wrench',
            'title' => 'Service you can reach',
            'text' => 'Full service centres in Malé, Hithadhoo and Fuvahmulah, with technicians trained on the specific engines we sell.',
        ],
        [
            'icon' => 'users',
            'title' => 'People who tell you straight',
            'text' => 'If a bike is wrong for how you ride, our team will say so. We would rather sell you the right one than the expensive one.',
        ],
    ];

    $showroomImage = function (string ...$parts): string {
        return asset('images/about_us/showrooms/' . implode('/', array_map('rawurlencode', $parts)));
    };

    $showrooms = [
        [
            'name' => 'Malé Showroom',
            'address' => 'Chaandhanee Magu, Malé, Maldives',
            'featured' => true,
            'images' => [
                $showroomImage("Male' Showroom", 'Malé Showroom.jpg'),
                $showroomImage("Male' Showroom", "Male' Showroom1.webp"),
                $showroomImage("Male' Showroom", "Male' Showroom2.jpg"),
            ],
        ],
        [
            'name' => 'Hithadhoo Showroom',
            'address' => 'Fenfiyazmagu, S. Hithadhoo, Maldives',
            'featured' => true,
            'images' => [
                $showroomImage('Hithadhoo Showroom', 'Hithadhoo Showroom.jpg'),
                $showroomImage('Hithadhoo Showroom', 'Hithadhoo Showroom1.jpg'),
                $showroomImage('Hithadhoo Showroom', 'Hithadhoo Showroom2.jpg'),
            ],
        ],
        [
            'name' => 'Kudahuvadhoo Showroom',
            'address' => 'Izzudheen Magu, Dh. Kudahuvadhoo, Maldives',
            'featured' => false,
            'images' => [
                $showroomImage('Kudahuvadhoo Showroom', 'Kudahuvadhoo Showroom.jpg'),
                $showroomImage('Kudahuvadhoo Showroom', 'Kudahuvadhoo Showroom1.jpg'),
            ],
        ],
        [
            'name' => 'Naifaru Showroom',
            'address' => 'Ifthithaahee Magu, Lh. Naifaru, Maldives',
            'featured' => false,
            'img' => $showroomImage('Naifaru Showroom', 'Naifaru Showroom.webp'),
        ],
        [
            'name' => 'Villingili Showroom',
            'address' => 'Ameenee Magu, GA. Villingili, Maldives',
            'featured' => false,
            'images' => [
                $showroomImage('Villingili Showroom', 'Villingili Showroom.jpg'),
                $showroomImage('Villingili Showroom', 'Villingili Showroom1.jpg'),
                $showroomImage('Villingili Showroom', 'Villingili Showroom2.jpg'),
            ],
        ],
        [
            'name' => 'Feydhoo Showroom',
            'address' => 'Maathila Magu, S. Feydhoo, Maldives',
            'featured' => false,
            'img' => $showroomImage('Feydhoo Showroom', 'Feydhoo Showroom.jpg'),
        ],
        [
            'name' => 'Fonadhoo Showroom',
            'address' => 'Sinajuddeen Magu, L. Fonadhoo, Maldives',
            'featured' => false,
            'images' => [
                $showroomImage('Fonadhoo Showroom', 'Fonadhoo Showroom.jpg'),
                $showroomImage('Fonadhoo Showroom', 'Fonadhoo Showroom1.jpg'),
                $showroomImage('Fonadhoo Showroom', 'Fonadhoo Showroom2.jpg'),
            ],
        ],
        [
            'name' => 'Head Office',
            'address' => 'Ma. Eyrum, Buruzu Magu, Malé, Maldives',
            'featured' => false,
            'img' => $showroomImage('Head Office', 'Head Office.webp'),
        ],
        [
            'name' => 'Hulhumale Showroom',
            'address' => 'Nirolhu Magu, Hulhumale, Maldives',
            'featured' => false,
            'images' => [
                $showroomImage('Hulhumale Showroom', 'Hulhumale Showroom.webp'),
                $showroomImage('Hulhumale Showroom', 'Hulhumale Showroom1.webp'),
                $showroomImage('Hulhumale Showroom', 'Hulhumale Showroom2.webp'),
            ],
        ],
        [
            'name' => 'Thinadhoo Showroom',
            'address' => 'Daisy Magu, Thinadhoo, Maldives',
            'featured' => false,
            'images' => [
                $showroomImage('Thinadhoo Showroom', 'Thinadhoo Showroom.webp'),
                $showroomImage('Thinadhoo Showroom', 'Thinadhoo Showroom1.webp'),
                $showroomImage('Thinadhoo Showroom', 'Thinadhoo Showroom2.webp'),
            ],
        ],
    ];

    $showroomCount = count($showrooms);
    $testimonials = [
        [
            'quote' => 'I had been putting off buying a bike for two years because I could not pay it all at once. The Ijara plan was explained properly, the figure never changed, and I have been riding since March.',
            'name' => 'Ahmed I.',
            'location' => 'Malé',
        ],
        [
            'quote' => 'Bought a Scoopy from the Hithadhoo showroom. What I appreciated most was being told the smaller bike was the right one for me instead of being pushed to the expensive one.',
            'name' => 'Fathimath R.',
            'location' => 'Addu City',
        ],
        [
            'quote' => 'Service centre found a worn brake pad I had not noticed and showed me the old part. That is the kind of thing that keeps me coming back.',
            'name' => 'Ibrahim S.',
            'location' => 'Fuvahmulah',
        ],
    ];

    $heroStrip = [
        ['icon' => 'clock', 'title' => 'Since 2014', 'sub' => 'Twelve years serving Maldivian riders'],
        ['icon' => 'map-pin', 'title' => $showroomCount.' Locations', 'sub' => 'Showrooms & service centers across the Maldives'],
        ['icon' => 'shield', 'title' => 'Ijara Plans', 'sub' => 'Islamic leasing standards'],
        ['icon' => 'wrench', 'title' => 'Full Service', 'sub' => 'Genuine parts, trained technicians'],
    ];
@endphp

<div class="font-sans" data-home-page>

    <x-litus-header active="Home" />

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-litus-ink text-white">
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.34), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.16), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.9) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.42]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(70px,9vw,124px)] pb-[clamp(56px,7vw,96px)]">
            <div class="grid items-center gap-[52px] max-[960px]:grid-cols-1 max-[960px]:gap-9 min-[961px]:grid-cols-[1.06fr_0.94fr]">
                <div>
                    <span class="mb-[22px] inline-flex items-center gap-2.5 rounded-full border border-white/16 bg-white/[0.08] px-4 py-2 text-[12.5px] font-semibold">
                        <span class="litus-live-dot h-[7px] w-[7px] rounded-full bg-[#3DDC84] shadow-[0_0_0_0_rgba(61,220,132,0.7)]" aria-hidden="true"></span>
                        {{ $campaignCount }} campaign{{ $campaignCount === 1 ? '' : 's' }} running now · Updated {{ now()->format('j M Y') }}
                    </span>
                    <h1 class="font-display text-[clamp(40px,6.2vw,78px)] font-extrabold leading-[1.08] tracking-[-0.035em]">
                        Ride your own.<br>
                        <span class="text-litus-sky">From MVR 1,340</span><br>
                        a month.
                    </h1>
                    <p class="mt-[22px] max-w-[520px] text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                        Honda and Yamaha scooters, genuine parts and expert service — across five showrooms in the Maldives. Buy outright, or own it on a Shariah-compliant Ijara plan.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#offers"
                           class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                            See This Month’s Campaigns
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                        <a href="{{ route('ownership-plans') }}"
                           class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                            How Ijara Works
                        </a>
                    </div>
                </div>

                <div class="rounded-[26px] border border-white/15 bg-white/[0.06] p-[clamp(26px,3vw,38px)] shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)] backdrop-blur-[10px]">
                    <h4 class="mb-1.5 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em]">Find your ride</h4>
                    <p class="mb-5 text-xs text-white/60">Three questions. We will show you what fits.</p>
                    <form action="{{ route('motorcycles') }}" method="get" class="space-y-4" data-quick-find>
                        <div>
                            <label for="fBrand" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-white/70">Brand</label>
                            <select id="fBrand" name="brand"
                                    class="w-full rounded-[9px] border-[1.5px] border-white/18 bg-white/[0.07] px-3.5 py-3 text-sm text-white outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                                <option value="all" class="text-litus-text">Any brand</option>
                                <option value="Honda" class="text-litus-text">Honda</option>
                                <option value="Yamaha" class="text-litus-text">Yamaha</option>
                            </select>
                        </div>
                        <div>
                            <label for="fBudget" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-white/70">Budget</label>
                            <select id="fBudget" name="budget"
                                    class="w-full rounded-[9px] border-[1.5px] border-white/18 bg-white/[0.07] px-3.5 py-3 text-sm text-white outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                                <option value="999999" class="text-litus-text">Any budget</option>
                                <option value="60000" class="text-litus-text">Under MVR 60,000</option>
                                <option value="80000" class="text-litus-text">Under MVR 80,000</option>
                                <option value="110000" class="text-litus-text">Under MVR 110,000</option>
                            </select>
                        </div>
                        <div>
                            <label for="fPay" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-white/70">How you want to pay</label>
                            <select id="fPay" name="pay"
                                    class="w-full rounded-[9px] border-[1.5px] border-white/18 bg-white/[0.07] px-3.5 py-3 text-sm text-white outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]">
                                <option class="text-litus-text">Ijara monthly plan</option>
                                <option class="text-litus-text">Full payment</option>
                                <option class="text-litus-text">Not sure yet</option>
                            </select>
                        </div>
                        <button type="submit"
                                class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3.5 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                            Show Me Motorcycles
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/26">
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

    {{-- ONGOING PROMOTIONS --}}
    <section id="offers" class="litus-sec scroll-mt-24">
        <div class="litus-container">
            <div class="mb-[38px] flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-[660px]">
                    <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Ongoing Promotions</span>
                    <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Live campaigns, with real end dates</h2>
                    <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                        Each campaign covers selected motorcycles. Open one to see the model details and the price of each.
                    </p>
                </div>
                <a href="{{ route('motorcycles') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-6 py-3.5 text-[14.5px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary">
                    All {{ $campaignCount }} Campaigns
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($promoMotorcycles->take(3) as $motorcycle)
                    <x-card.promotion-card :motorcycle="$motorcycle" />
                @empty
                    <div class="col-span-full rounded-[18px] border border-dashed border-litus-line-2 bg-litus-paper-2 px-6 py-16 text-center text-litus-text-2">
                        <p class="font-semibold text-litus-text">No active campaigns at the moment.</p>
                        <p class="mt-1 text-sm">Check back soon or browse our full motorcycle range.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- TOP SELLING RIDES --}}
    <section class="litus-sec bg-litus-paper-2">
        <div class="litus-container">
            <div class="mb-[38px] flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-[660px]">
                    <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">The Range</span>
                    <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Top selling rides</h2>
                    <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                        The models Maldivian riders buy most, from 110cc city scooters to 160cc commuters.
                    </p>
                </div>
                <a href="{{ route('motorcycles') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-6 py-3.5 text-[14.5px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary">
                    View All Models
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            <div class="grid grid-cols-1 gap-[22px] sm:grid-cols-2 xl:grid-cols-4">
                @foreach ($topRides as $ride)
                    <x-card.litus-ride-card
                        :model="$ride['model']"
                        :slug="$ride['slug']"
                        :cc="$ride['cc']"
                        :capacity="$ride['capacity']"
                        :img="$ride['img']"
                        :brand="$ride['brand'] ?? null"
                        :price="$ride['price'] ?? null"
                        :salePrice="$ride['salePrice'] ?? null"
                        :discount="$ride['discount'] ?? null"
                        :hasPromotion="$ride['hasPromotion'] ?? false"
                        :monthly="$ride['monthly'] ?? null"
                        :badge="$ride['badge'] ?? null"
                    />
                @endforeach
            </div>
        </div>
    </section>

    {{-- IJARA BAND --}}
    <x-litus-ijara-band />

    {{-- WHY LITUS --}}
    <section class="litus-sec">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Why LITUS</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Twelve years of getting people riding</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    We are not the only place to buy a scooter in the Maldives. These are the reasons people choose us.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-[22px] sm:grid-cols-2 xl:grid-cols-4">
                @foreach ($whyLitus as $item)
                    <div class="rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px] transition duration-200 hover:border-litus-line-2 hover:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                        <div class="mb-[18px] grid h-[46px] w-[46px] place-items-center rounded-[13px] bg-[#DCE8FF] text-[#0B47B0]">
                            <x-litus-icon :name="$item['icon']" class="h-[17px] w-[17px]" />
                        </div>
                        <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $item['title'] }}</h4>
                        <p class="text-[14.5px] text-litus-text-2">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SHOWROOMS --}}
    <section id="showrooms" class="litus-sec scroll-mt-24 bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Our Locations</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Our Showrooms &amp; Service Centers</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Visit our showrooms and service centers across the Maldives for motorcycles, genuine parts, and trusted support.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($showrooms as $showroom)
                    @php
                        $coverImage = $showroom['images'][0] ?? ($showroom['img'] ?? null);
                    @endphp
                    <div class="group flex flex-col overflow-hidden rounded-[18px] border border-litus-line bg-white transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="relative h-[180px] overflow-hidden bg-litus-paper-3 sm:h-[200px]">
                            @if ($coverImage)
                                <img src="{{ $coverImage }}"
                                     alt="{{ $showroom['name'] }}"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"
                                     loading="lazy">
                            @else
                                <div class="grid h-full place-items-center text-litus-primary">
                                    <x-litus-icon name="map-pin" class="h-8 w-8" />
                                </div>
                            @endif
                            @if (! empty($showroom['featured']))
                                <span class="absolute left-3 top-3 rounded-md bg-litus-primary px-2.5 py-1 text-[10.5px] font-extrabold uppercase tracking-[0.08em] text-white">
                                    Featured
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-1 flex-col px-[26px] pb-[26px] pt-5">
                            <div class="mb-3.5 grid h-[46px] w-[46px] place-items-center rounded-[13px] bg-[#DCE8FF] text-[#0B47B0]">
                                <x-litus-icon name="map-pin" class="h-[17px] w-[17px]" />
                            </div>
                            <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $showroom['name'] }}</h4>
                            <p class="mb-5 flex-1 text-[14.5px] text-litus-text-2">{{ $showroom['address'] }}</p>
                            <a href="{{ route('about') }}#locations"
                               class="inline-flex w-full items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-4 py-2.5 text-[13.5px] font-semibold text-litus-ink transition hover:border-litus-primary-light hover:text-litus-primary">
                                <x-litus-icon name="map-pin" class="h-4 w-4" />
                                View Location
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('about') }}#locations"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-6 py-3.5 text-[14.5px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary">
                    View All {{ $showroomCount }} Locations
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="litus-sec">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">From Our Riders</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">What customers say</h2>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($testimonials as $item)
                    <div class="rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px]">
                        <div class="mb-3.5 flex gap-0.5 text-[#F5A524]">
                            @for ($i = 0; $i < 5; $i++)
                                <x-litus-icon name="star" class="h-3.5 w-3.5 fill-current" fill="currentColor" />
                            @endfor
                        </div>
                        <p class="mb-[18px] text-[15px] text-litus-text">“{{ $item['quote'] }}”</p>
                        <div class="flex items-center gap-3">
                            <div class="grid h-[38px] w-[38px] place-items-center rounded-full bg-litus-paper-3 text-sm font-bold text-litus-text-2">
                                {{ mb_substr($item['name'], 0, 1) }}
                            </div>
                            <div>
                                <b class="block text-sm text-litus-text">{{ $item['name'] }}</b>
                                <span class="text-xs text-litus-text-2">{{ $item['location'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SERVICE + PARTS --}}
    <section class="litus-sec-tight bg-litus-paper-2">
        <div class="litus-container grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="rounded-[18px] border border-litus-line bg-white px-8 py-9">
                <div class="mb-[18px] grid h-[46px] w-[46px] place-items-center rounded-[13px] bg-[#DCE8FF] text-[#0B47B0]">
                    <x-litus-icon name="wrench" class="h-[17px] w-[17px]" />
                </div>
                <h4 class="mb-2.5 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Service Centre</h4>
                <p class="mb-[22px] text-[14.5px] text-litus-text-2">
                    Periodic maintenance, accident repairs, engine overhaul and pick-and-drop. Book online and we confirm within 24 hours.
                </p>
                <a href="{{ route('service-center') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-ink px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-litus-ink-700">
                    Book an Appointment
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
            <div class="rounded-[18px] border border-litus-line bg-white px-8 py-9">
                <div class="mb-[18px] grid h-[46px] w-[46px] place-items-center rounded-[13px] bg-[#DCE8FF] text-[#0B47B0]">
                    <x-litus-icon name="zap" class="h-[17px] w-[17px]" />
                </div>
                <h4 class="mb-2.5 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Genuine Parts</h4>
                <p class="mb-[22px] text-[14.5px] text-litus-text-2">
                    Body, engine, braking, electrical, chassis and wheels. Tell us your model and we will confirm the exact part you need.
                </p>
                <a href="{{ route('parts') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-ink px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-litus-ink-700">
                    Request a Part
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="litus-sec-tight bg-litus-ink text-white">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Not sure which bike or plan is right?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Tell our team your budget and how you want to pay. We will tell you honestly which option gets you the most for it.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Talk to Our Team
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
