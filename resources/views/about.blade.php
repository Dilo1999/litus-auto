@extends('layouts.litus')

@section('title', 'About Us — LITUS Automobiles')

@section('content')
@php
    $teamLeaders = [
        ['name' => 'Mohamed Zahid', 'role' => 'Chief Executive Officer', 'img' => asset('images/about_us/mohomad_zahid.webp')],
        ['name' => 'Ahmed Zahir', 'role' => 'Chief Operating Officer', 'img' => asset('images/about_us/ahmed.webp')],
        ['name' => 'Asif Rasheed', 'role' => 'Chief Strategy & Marketing Officer', 'img' => asset('images/about_us/asif.webp')],
    ];

    $teamMembers = [
        ['name' => 'Mohamed Nazeer', 'role' => 'Manager', 'dept' => 'Parts & Service Center', 'img' => asset('images/about_us/nazeer.webp')],
        ['name' => 'Hifath Ali', 'role' => 'Head of Sales', 'dept' => 'Sales Department', 'img' => asset('images/about_us/Iffath.png')],
        ['name' => 'Dhanushka', 'role' => 'Inventory Officer', 'dept' => 'Inventory Management', 'img' => asset('images/about_us/dhanushka.webp')],
        ['name' => 'Mohamed Nafiz', 'role' => 'Lawyer', 'dept' => 'Legal Affairs', 'img' => asset('images/about_us/nafiz.webp')],
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

    $opStats = [
        ['icon' => 'users', 'title' => 'Dedicated Team', 'desc' => 'Passionate professionals at your service'],
        ['icon' => 'headphones', 'title' => 'Customer Support', 'desc' => 'Always here to help you on your journey'],
        ['icon' => 'shopping-bag', 'title' => 'Sales Assistance', 'desc' => 'Find the perfect ride with expert guidance'],
        ['icon' => 'wrench', 'title' => 'Service Guidance', 'desc' => "From parts to maintenance, we've got you covered"],
    ];

    $operationBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1400&q=80';
    $operationTeamImg = asset('images/about_us/team-2.png');
    $locationsBannerBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1600&q=80';

    $heroBg = 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1600&q=80';

    $heroFeatures = [
        ['icon' => 'star', 'title' => 'Est. 2014', 'desc' => 'Established in 2014'],
        ['icon' => 'check-circle', 'title' => '11+', 'desc' => 'Largest Motorcycle Dealer'],
        ['icon' => 'package', 'title' => '100%', 'desc' => 'Genuine Parts'],
        ['icon' => 'wrench', 'title' => '12+', 'desc' => 'Reliable Service Centers'],
    ];

    $missionVision = [
        ['icon' => 'target', 'title' => 'Our Mission', 'text' => 'To provide support and leadership in the automobile industry by offering easy and reliable services across the Maldives.', 'accent' => 'red'],
        ['icon' => 'eye', 'title' => 'Our Vision', 'text' => 'Independent mobility for everyone.', 'accent' => 'navy'],
    ];
@endphp

<div class="font-sans">

    <x-litus-header active="About Us" />

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
                    About LITUS Automobiles
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:mb-2 max-md:text-[1.7rem] max-md:leading-[1.12]">
                    Driven by Trust.<br>
                    <span class="text-litus-red">Built for Every Ride.</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] max-md:mb-3.5 max-md:max-w-[34ch] max-md:text-[13px] max-md:leading-snug sm:text-lg sm:leading-[1.55]">
                    LITUS Automobiles is a leading motorcycle supplier in the Maldives, established in 2014. We offer a wide range of mobility solutions to meet the needs of our customers with quality products and excellent customer service.
                </p>

                <div class="flex flex-col items-stretch justify-start gap-2.5 max-md:w-full max-md:flex-row max-md:gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7">
                    <a href="#mission-vision"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Explore Our Story
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Contact Us
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- MISSION & VISION --}}
    <section id="mission-vision"
             class="relative overflow-hidden border border-[#dcdfe5] py-6 pb-8 max-sm:py-5 max-sm:pb-6"
             style="background-image: radial-gradient(circle, rgba(7, 21, 47, 0.12) 2px, transparent 2px); background-size: 24px 24px; background-color: #fafafa;">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(250,250,250,0.95)_0%,rgba(250,250,250,0.55)_15%,rgba(250,250,250,0.25)_50%,rgba(250,250,250,0.55)_85%,rgba(250,250,250,0.95)_100%)]"></div>

        <div class="relative z-[2] litus-container">
            <p class="mb-4 text-center text-xs font-black uppercase tracking-[2px] text-[#0065ef] min-[561px]:text-[13px] min-[561px]:tracking-[3px]">
                Our Mission &amp; Vision
            </p>

            <div class="grid grid-cols-1 gap-4 min-[901px]:grid-cols-2">
                @foreach ($missionVision as $item)
                    <div class="flex flex-col items-center gap-4 rounded-xl border border-[#dfe3ea] bg-white px-5 py-5 shadow-[0_10px_24px_rgba(0,0,0,0.07)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_14px_32px_rgba(0,0,0,0.1)] min-[561px]:flex-row min-[561px]:gap-5 min-[561px]:px-6 min-[561px]:py-5">
                        <div class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-full bg-[#f0f0f0] text-[#0065ef] min-[561px]:h-20 min-[561px]:w-20">
                            <x-litus-icon :name="$item['icon']" class="h-8 w-8 min-[561px]:h-9 min-[561px]:w-9" />
                        </div>
                        <div class="text-center min-[561px]:text-left">
                            <h2 class="mb-2.5 text-xl font-black tracking-[-0.5px] text-[#07152f] min-[561px]:text-2xl">{{ $item['title'] }}</h2>
                            <p class="max-w-[390px] text-sm font-semibold leading-relaxed text-[#586273]">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LEADERSHIP & OPERATION TEAM --}}
    <section class="bg-[radial-gradient(circle_at_top,rgba(20,105,255,0.05),transparent_35%)] bg-[#f7f9fc] py-10 pb-14">
        <div class="litus-container max-w-[1500px]">

            <div class="mb-10 text-center min-[651px]:mb-[42px]">
                <span class="mb-5 inline-flex items-center gap-3 text-xs font-black uppercase tracking-[4px] text-[#0065ef] min-[651px]:gap-[18px] min-[651px]:text-base min-[651px]:tracking-[6px]">
                    <span class="h-0.5 w-8 bg-gradient-to-r from-transparent to-[#0065ef] min-[651px]:w-[42px]"></span>
                    Leadership Team
                    <span class="h-0.5 w-8 bg-gradient-to-l from-transparent to-[#0065ef] min-[651px]:w-[42px]"></span>
                </span>
                <h2 class="mb-5 text-[clamp(2.625rem,5vw,4rem)] font-black leading-[1.05] tracking-[-1.5px] text-[#07152f]">Our Key Members</h2>
                <div class="mx-auto mb-[22px] h-1 w-[70px] rounded-[10px] bg-[#0065ef]"></div>
                <p class="text-[15px] font-semibold leading-relaxed text-[#667085] min-[651px]:text-lg">
                    Meet the talented leaders driving our vision and growth with dedication and expertise.
                </p>
            </div>

            {{-- Leaders --}}
            <div class="mb-[34px] grid grid-cols-1 gap-6 min-[1151px]:grid-cols-3">
                @foreach ($teamLeaders as $member)
                    <div class="relative mx-auto flex w-full min-h-[440px] overflow-hidden rounded-[10px] border border-[#07152f]/[0.08] bg-[#061a45] shadow-[0_18px_42px_rgba(7,21,47,0.14)] max-[700px]:min-h-[480px] min-[701px]:min-h-[275px] min-[1151px]:mx-0 min-[1151px]:max-w-none max-[1150px]:max-w-[760px]">
                        <div class="pointer-events-none absolute inset-0 z-[1] opacity-25"
                             style="background-image: radial-gradient(rgba(255,255,255,0.09) 1px, transparent 1px); background-size: 12px 12px;"></div>
                        <div class="pointer-events-none absolute inset-0 z-[2] bg-[linear-gradient(to_top,rgba(3,15,39,0.98)_0%,rgba(3,15,39,0.68)_58%,rgba(3,15,39,0.10)_100%)] min-[701px]:bg-[radial-gradient(circle_at_30%_55%,rgba(0,105,255,0.22),transparent_30%),linear-gradient(90deg,rgba(3,15,39,0.98)_0%,rgba(3,15,39,0.82)_45%,rgba(3,15,39,0.10)_100%)]"></div>

                        <div class="relative z-[4] flex w-full flex-col justify-end px-6 pb-7 pt-[210px] text-white max-[700px]:pb-8 max-[700px]:pt-[200px] min-[701px]:w-[52%] min-[701px]:justify-center min-[701px]:py-7 min-[701px]:pl-[26px] min-[701px]:pr-0 min-[701px]:pt-7">
                            <div class="mb-9 hidden h-[54px] w-[54px] items-center justify-center rounded-full border border-[#0065ef]/45 text-[#0065ef] min-[701px]:flex">
                                <x-litus-icon name="award" class="h-6 w-6" />
                            </div>
                            <h3 class="mb-2.5 text-[25px] font-black leading-[1.15]">{{ $member['name'] }}</h3>
                            <p class="mb-[22px] text-base font-medium text-[#e5ecf5]">{{ $member['role'] }}</p>
                            <div class="h-[3px] w-8 rounded-[10px] bg-[#0065ef]"></div>
                        </div>

                        <div class="absolute right-0 top-0 z-[3] h-[65%] w-full min-[701px]:bottom-0 min-[701px]:top-auto min-[701px]:h-full min-[701px]:w-[58%]">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-full w-full object-cover object-top min-[701px]:object-bottom">
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Team members --}}
            <div class="mb-6 grid grid-cols-1 gap-6 min-[701px]:grid-cols-2 min-[1151px]:grid-cols-4">
                @foreach ($teamMembers as $member)
                    <div class="min-h-[335px] rounded-[10px] border border-[#07152f]/[0.05] bg-white px-7 pb-[26px] pt-7 text-center shadow-[0_14px_34px_rgba(7,21,47,0.08)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_46px_rgba(7,21,47,0.12)]">
                        <div class="mx-auto h-[150px] w-[150px] overflow-hidden rounded-full bg-[#eef2f7] shadow-[0_12px_28px_rgba(7,21,47,0.08)]">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="h-full w-full object-cover object-top">
                        </div>
                        <div class="relative z-[3] mx-auto -mt-[22px] mb-[18px] flex h-[52px] w-[52px] items-center justify-center rounded-full border border-[#e2e8f0] bg-white text-[#0065ef] shadow-[0_8px_22px_rgba(7,21,47,0.08)]">
                            <x-litus-icon name="award" class="h-6 w-6" />
                        </div>
                        <h4 class="mb-3 text-[22px] font-black text-[#07152f]">{{ $member['name'] }}</h4>
                        <p class="mb-[22px] text-base font-extrabold text-[#0065ef]">{{ $member['role'] }}</p>
                        <div class="mx-auto mb-5 h-px w-[150px] bg-[#dce3ed]"></div>
                        <p class="mx-auto max-w-[230px] text-base font-medium leading-snug text-[#667085]">{{ $member['dept'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Operation team --}}
            <div class="overflow-hidden rounded-[14px] bg-cover bg-center px-5 py-7 pb-[22px] shadow-[0_14px_35px_rgba(0,0,0,0.18)] min-[651px]:px-[38px] min-[651px]:pt-7"
                 style="background-image: linear-gradient(90deg, rgba(3,14,33,0.98), rgba(4,20,46,0.96)), url('{{ $operationBg }}');">
                <div class="grid grid-cols-1 gap-7 min-[1051px]:grid-cols-[38%_62%] min-[1051px]:items-stretch">
                    <div class="flex flex-col justify-center">
                        <span class="mb-2.5 block text-[13px] font-black uppercase tracking-[3px] text-[#0065ef]">Our People</span>
                        <h2 class="mb-[18px] text-[28px] font-black leading-tight text-white min-[651px]:text-[33px]">Our Operation Team</h2>
                        <p class="max-w-[470px] text-sm font-medium leading-[1.65] text-[#dbe4ee]">
                            Meet the LITUS Automobiles team, a passionate ensemble of dedicated professionals committed to elevating your motorcycle experience. With a wealth of knowledge and a shared drive to help every rider, our team is here to guide you, answer your questions, and keep your journey smooth from selection to service.
                        </p>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-white/10 bg-white px-3 pt-3">
                        <img src="{{ $operationTeamImg }}"
                             alt="LITUS Operation Team"
                             class="block w-full h-auto object-contain">
                    </div>

                    <div class="col-span-full mt-2.5 grid grid-cols-1 gap-[22px] min-[651px]:grid-cols-2 min-[1051px]:grid-cols-4">
                        @foreach ($opStats as $stat)
                            <div class="flex items-center gap-[15px] rounded-lg border border-white/25 bg-white/[0.04] px-[18px] py-[17px] max-[650px]:items-start">
                                <div class="flex h-[55px] w-[55px] shrink-0 items-center justify-center rounded-full bg-white text-[#0065ef]">
                                    <x-litus-icon :name="$stat['icon']" class="h-6 w-6" />
                                </div>
                                <div>
                                    <h4 class="mb-1 text-sm font-black text-white">{{ $stat['title'] }}</h4>
                                    <p class="text-xs leading-snug text-[#dbe4ee]">{{ $stat['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- SHOWROOMS & SERVICE CENTERS --}}
    <section id="locations" class="bg-[#f7f8fa] pt-5 max-sm:pt-[18px]">
        <div class="litus-container">

            <div class="mb-[18px] text-center">
                <span class="mb-1.5 block text-sm font-black uppercase tracking-[3px] text-[#0065ef]">Our Locations</span>
                <h2 class="mb-2 text-[28px] font-black leading-tight text-[#07152f] min-[651px]:text-[34px]">Our Showrooms &amp; Service Centers</h2>
                <p class="text-sm font-semibold leading-normal text-[#555f70] min-[651px]:text-base">
                    Visit our showrooms and service centers across the Maldives for motorcycles, genuine parts, and trusted support.
                </p>
            </div>

            <div class="mb-6 grid grid-cols-1 gap-5 min-[651px]:grid-cols-2 min-[651px]:gap-6 min-[1101px]:grid-cols-4">
                @foreach ($showrooms as $showroom)
                    <div @class([
                        'overflow-hidden border border-[#dfe3ea] bg-white shadow-[0_8px_22px_rgba(0,0,0,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_14px_32px_rgba(0,0,0,0.1)]',
                        'rounded-xl' => $showroom['featured'],
                        'rounded-[9px]' => ! $showroom['featured'],
                        'min-[1101px]:col-span-2' => $showroom['featured'],
                    ])>
                        <div @class([
                            'overflow-hidden bg-[#dfe5ec]',
                            'relative' => ! empty($showroom['images']),
                            'h-[220px]' => $showroom['featured'],
                            'h-[200px]' => ! $showroom['featured'],
                            'min-[651px]:h-[280px]' => $showroom['featured'],
                            'min-[651px]:h-[220px]' => ! $showroom['featured'],
                        ])
                             @if (! empty($showroom['images'])) data-showroom-slider data-interval="4000" @endif>
                            @if (! empty($showroom['images']))
                                @foreach ($showroom['images'] as $index => $image)
                                    <img src="{{ $image }}"
                                         alt="{{ $showroom['name'] }}"
                                         data-showroom-slide
                                         @class([
                                             'absolute inset-0 block h-full w-full object-cover transition-opacity duration-700',
                                             'z-[1] opacity-100' => $index === 0,
                                             'z-0 opacity-0' => $index !== 0,
                                         ])>
                                @endforeach
                                <div class="absolute bottom-3 left-1/2 z-[2] flex -translate-x-1/2 gap-1.5">
                                    @foreach ($showroom['images'] as $index => $image)
                                        <span data-showroom-dot
                                              @class([
                                                  'h-1.5 rounded-full bg-white/50 transition-all duration-300',
                                                  'w-5 bg-white' => $index === 0,
                                                  'w-1.5' => $index !== 0,
                                              ])></span>
                                    @endforeach
                                </div>
                            @else
                                <img src="{{ $showroom['img'] }}"
                                     alt="{{ $showroom['name'] }}"
                                     class="block h-full w-full object-cover">
                            @endif
                        </div>
                        <div @class([
                            'px-[18px] pb-4 pt-3.5' => ! $showroom['featured'],
                            'px-6 pb-6 pt-5' => $showroom['featured'],
                        ])>
                            <h3 @class([
                                'mb-2 font-black text-[#111b46]',
                                'text-base' => ! $showroom['featured'],
                                'text-lg min-[651px]:text-xl' => $showroom['featured'],
                            ])>{{ $showroom['name'] }}</h3>
                            <p @class([
                                'mb-3.5 font-semibold leading-snug text-[#404b60]',
                                'text-[13px]' => ! $showroom['featured'],
                                'text-sm min-[651px]:text-[15px]' => $showroom['featured'],
                            ])>{{ $showroom['address'] }}</p>
                            <a href="{{ route('contact') }}"
                               @class([
                                   'group/contact inline-flex items-center justify-center gap-3 rounded-[5px] bg-[#061a45] font-black text-white transition-colors duration-300 hover:bg-[#0065ef]',
                                   'h-8 min-w-[140px] px-[18px] text-[13px] max-md:h-10' => ! $showroom['featured'],
                                   'h-10 min-w-[160px] px-6 text-sm' => $showroom['featured'],
                               ])>
                                Contact Now
                                <x-litus-icon name="arrow-right" class="h-4 w-4 text-[#0065ef] transition-colors group-hover/contact:text-white" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- LOCATIONS CTA BANNER --}}
    <section class="border-t border-white/[0.08] bg-cover bg-center py-[30px]"
             style="background-image: linear-gradient(90deg, rgba(3,13,31,0.98), rgba(4,19,43,0.96)), url('{{ $locationsBannerBg }}');">
        <div class="litus-container grid grid-cols-1 items-center gap-[22px] min-[1101px]:grid-cols-[auto_1fr_auto] min-[1101px]:gap-9 max-[1100px]:text-center">

            <div class="flex items-center justify-center gap-6 min-[1101px]:justify-start">
                <div class="relative">
                    <div class="flex h-[78px] w-[78px] shrink-0 items-center justify-center rounded-full border-[5px] border-white/20 bg-[#0065ef] text-white shadow-[0_0_0_2px_rgba(0,101,239,0.45)] min-[651px]:h-[92px] min-[651px]:w-[92px]">
                        <x-litus-icon name="map-pin" class="h-8 w-8 min-[651px]:h-10 min-[651px]:w-10" />
                    </div>
                    <div class="pointer-events-none absolute -right-[70px] top-[15px] hidden h-[55px] w-[75px] rotate-[20deg] rounded-full border-r-[3px] border-t-[3px] border-dashed border-white/55 min-[651px]:block"></div>
                </div>
                <div class="hidden h-[75px] w-px bg-white/22 min-[1101px]:block"></div>
            </div>

            <div>
                <h2 class="mb-2 text-[25px] font-black text-white min-[651px]:text-[32px]">Looking for the Nearest LITUS Showroom?</h2>
                <p class="text-[15px] font-semibold text-[#d6deea]">
                    Our team is ready to help you find the right motorcycle, parts, or service support.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-[22px] max-sm:w-full max-sm:flex-col min-[1101px]:justify-end">
                <a href="{{ route('contact') }}"
                   class="inline-flex h-[52px] min-w-[190px] items-center justify-center gap-3.5 rounded-md bg-[#0065ef] px-7 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-sm:w-full">
                    Contact Us
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
                <a href="#locations"
                   class="inline-flex h-[52px] min-w-[190px] items-center justify-center gap-3.5 rounded-md border-2 border-white/55 bg-white/[0.03] px-7 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)] max-sm:w-full">
                    View Locations
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
