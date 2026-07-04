@extends('layouts.litus')

@section('title', 'About Us — LITUS Automobiles')

@section('content')
@php
    $teamLeaders = [
        ['name' => 'Mohamed Zahid', 'role' => 'Chief Executive Officer', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80'],
        ['name' => 'Ahmed Zahir', 'role' => 'Chief Operating Officer', 'img' => 'https://images.unsplash.com/photo-1705645930353-0e335311ef20?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80'],
        ['name' => 'Asif Rasheed', 'role' => 'Chief Strategy & Marketing Officer', 'img' => 'https://images.unsplash.com/photo-1718209881007-c0ecdfc00f9d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400&q=80'],
    ];

    $teamMembers = [
        ['name' => 'Mohamed Nazeer', 'role' => 'Manager', 'dept' => 'Parts & Service Center', 'img' => 'https://images.unsplash.com/photo-1613181013804-1dcba09e6a9d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
        ['name' => 'Hifath Ali', 'role' => 'Head of Sales', 'dept' => 'Sales Department', 'img' => 'https://images.unsplash.com/photo-1648474484044-bb82df2f5a1f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
        ['name' => 'Dhanushka', 'role' => 'Inventory Officer', 'dept' => 'Inventory Management', 'img' => 'https://images.unsplash.com/photo-1600878459138-e1123b37cb30?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
        ['name' => 'Mohamed Nafiz', 'role' => 'Lawyer', 'dept' => 'Legal Affairs', 'img' => 'https://images.unsplash.com/photo-1543132220-4bf3de6e10ae?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=300&q=80'],
    ];

    $showrooms = [
        ['name' => 'Malé Showroom', 'address' => 'Chaandhanee Magu, Malé, Maldives', 'featured' => true, 'img' => 'https://images.unsplash.com/photo-1773940792913-94baf5fa0130?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80'],
        ['name' => 'Hithadhoo Showroom', 'address' => 'Fenfiyazmagu, S. Hithadhoo, Maldives', 'featured' => true, 'img' => 'https://images.unsplash.com/photo-1771402382481-de35db6c4159?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80'],
        ['name' => 'Kulhudhuffushi Showroom', 'address' => 'Izzuddeen Magu, Kulhudhuffushi, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1588756681780-9d5859fc2ca0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Nolhivaranfaru Showroom', 'address' => 'Hdh. Nolhivaranfaru Magu, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1582092722992-b2f960bafbfb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Villingili Showroom', 'address' => 'Ameenee Magu, GA. Villingili, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1611956292173-c2445aa61709?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Feydhoo Showroom', 'address' => 'Maathila Magu, S. Feydhoo, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1772090095175-ef442d5f56a8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Fonadhoo Showroom', 'address' => 'Sinajuddeen Magu, L. Fonadhoo, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Head Office', 'address' => 'Ma. Eyrum, Buruzu Magu, Malé, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Hulhumale Showroom', 'address' => 'Nirolhu Magu, Hulhumale, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1602111426534-9c097255ca46?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
        ['name' => 'Thinadhoo Showroom', 'address' => 'Daisy Magu, Thinadhoo, Maldives', 'featured' => false, 'img' => 'https://images.unsplash.com/photo-1629342651203-fab0990d8949?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=500&q=80'],
    ];

    $opStats = [
        ['icon' => 'users', 'title' => 'Dedicated Team', 'desc' => 'Passionate professionals at your service'],
        ['icon' => 'headphones', 'title' => 'Customer Support', 'desc' => 'Always here to help you on your journey'],
        ['icon' => 'shopping-bag', 'title' => 'Sales Assistance', 'desc' => 'Find the perfect ride with expert guidance'],
        ['icon' => 'wrench', 'title' => 'Service Guidance', 'desc' => "From parts to maintenance, we've got you covered"],
    ];

    $operationBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1400&q=80';
    $operationTeamImg = 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=80';
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
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#ff1029] sm:text-lg max-md:text-[15px]">
                    About LITUS Automobiles
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:text-[2.25rem]">
                    Driven by Trust.<br>
                    <span class="text-litus-red">Built for Every Ride.</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55] max-md:text-[17px]">
                    LITUS Automobiles is a leading motorcycle supplier in the Maldives, established in 2014. We offer a wide range of mobility solutions to meet the needs of our customers with quality products and excellent customer service.
                </p>

                <div class="flex flex-row flex-wrap items-center justify-start gap-5 sm:gap-7">
                    <a href="#mission-vision"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] bg-[#f20d23] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(242,13,35,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9091c] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Explore Our Story
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#f20d23] hover:bg-[rgba(242,13,35,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Contact Us
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
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

    {{-- MISSION & VISION --}}
    <section id="mission-vision"
             class="relative min-h-[260px] overflow-hidden border border-[#dcdfe5] py-[38px] pb-[45px] max-sm:py-8 max-sm:pb-[38px]"
             style="background-image: radial-gradient(circle, rgba(7, 21, 47, 0.12) 2px, transparent 2px); background-size: 24px 24px; background-color: #fafafa;">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(250,250,250,0.95)_0%,rgba(250,250,250,0.55)_15%,rgba(250,250,250,0.25)_50%,rgba(250,250,250,0.55)_85%,rgba(250,250,250,0.95)_100%)]"></div>

        <div class="relative z-[2] litus-container">
            <p class="mb-[22px] text-center text-[13px] font-black uppercase tracking-[3px] text-[#f20d23] min-[561px]:text-[15px] min-[561px]:tracking-[4px]">
                Our Mission &amp; Vision
            </p>

            <div class="grid grid-cols-1 gap-[22px] min-[901px]:grid-cols-2">
                @foreach ($missionVision as $item)
                    <div class="flex min-h-[155px] flex-col items-center gap-[22px] rounded-xl border border-[#dfe3ea] bg-white px-[22px] py-7 shadow-[0_12px_28px_rgba(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(0,0,0,0.11)] min-[561px]:flex-row min-[561px]:gap-[38px] min-[561px]:px-[38px] min-[561px]:py-[30px]">
                        <div class="flex h-[95px] w-[95px] shrink-0 items-center justify-center rounded-full bg-[#f0f0f0] text-[#f20d23] min-[561px]:h-[118px] min-[561px]:w-[118px]">
                            <x-litus-icon :name="$item['icon']" class="h-11 w-11 min-[561px]:h-14 min-[561px]:w-14" />
                        </div>
                        <div class="text-center min-[561px]:text-left">
                            <h2 class="mb-[18px] text-[25px] font-black tracking-[-0.5px] text-[#07152f] min-[561px]:text-[30px]">{{ $item['title'] }}</h2>
                            <p class="max-w-[390px] text-[15px] font-semibold leading-[1.55] text-[#586273] min-[561px]:text-base">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LEADERSHIP & OPERATION TEAM --}}
    <section class="bg-[#f8f9fb] py-5 pb-9">
        <div class="litus-container">

            <div class="mb-[15px] text-center">
                <span class="mb-1 block text-[13px] font-black uppercase tracking-[2px] text-[#ff1029]">Leadership Team</span>
                <h2 class="mb-2 text-[27px] font-black leading-none text-[#07152f] min-[651px]:text-[32px]">Our Key Members</h2>
                <p class="text-[13px] font-medium text-[#566070]">
                    Meet the leaders guiding LITUS Automobiles with experience, vision, and commitment.
                </p>
            </div>

            {{-- Leaders --}}
            <div class="mb-[18px] grid grid-cols-1 gap-8 max-[1050px]:mx-auto max-[1050px]:max-w-[650px] min-[1051px]:grid-cols-3">
                @foreach ($teamLeaders as $member)
                    <div class="relative h-[280px] overflow-hidden rounded-lg bg-[#20242c] shadow-[0_10px_25px_rgba(0,0,0,0.18)] min-[651px]:h-[250px]">
                        <img src="{{ $member['img'] }}"
                             alt="{{ $member['name'] }}"
                             class="block h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/92 via-black/25 to-black/[0.05]"></div>
                        <div class="absolute bottom-3.5 left-4 z-[2] text-white">
                            <h3 class="mb-1 text-[19px] font-black">{{ $member['name'] }}</h3>
                            <p class="text-[13px] font-black text-[#ff1029]">{{ $member['role'] }}</p>
                        </div>
                        <a href="#"
                           class="absolute bottom-3.5 right-3.5 z-[3] flex h-8 w-8 items-center justify-center rounded bg-white/90 text-[#07152f] transition-colors hover:bg-white"
                           aria-label="LinkedIn profile for {{ $member['name'] }}">
                            <x-litus-icon name="linkedin" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Team members --}}
            <div class="mb-6 grid grid-cols-1 gap-6 max-[650px]:grid-cols-1 min-[651px]:grid-cols-2 min-[1051px]:grid-cols-4">
                @foreach ($teamMembers as $member)
                    <div class="relative overflow-hidden rounded-lg border border-[#dfe3ea] bg-white shadow-[0_8px_22px_rgba(0,0,0,0.06)]">
                        <div class="h-[155px] overflow-hidden bg-[#edf0f5]">
                            <img src="{{ $member['img'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="block h-full w-full object-cover object-top">
                        </div>
                        <div class="relative min-h-[68px] px-3.5 pb-4 pt-3">
                            <h4 class="mb-1 text-[13px] font-black text-[#111b46]">{{ $member['name'] }}</h4>
                            <p class="text-[11px] font-medium leading-snug text-[#4e5a6a]">
                                {{ $member['role'] }},<br>{{ $member['dept'] }}
                            </p>
                            <a href="#"
                               class="absolute bottom-3.5 right-3 flex h-[27px] w-[27px] items-center justify-center rounded border border-[#dfe3ea] bg-white text-[#07152f] transition-colors hover:bg-gray-50"
                               aria-label="LinkedIn profile for {{ $member['name'] }}">
                                <x-litus-icon name="linkedin" class="h-3 w-3" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Operation team --}}
            <div class="overflow-hidden rounded-[14px] bg-cover bg-center px-5 py-7 pb-[22px] shadow-[0_14px_35px_rgba(0,0,0,0.18)] min-[651px]:px-[38px] min-[651px]:pt-7"
                 style="background-image: linear-gradient(90deg, rgba(3,14,33,0.98), rgba(4,20,46,0.96)), url('{{ $operationBg }}');">
                <div class="grid grid-cols-1 gap-7 min-[1051px]:grid-cols-[38%_62%]">
                    <div>
                        <span class="mb-2.5 block text-[13px] font-black uppercase tracking-[3px] text-[#ff1029]">Our People</span>
                        <h2 class="mb-[18px] text-[28px] font-black leading-tight text-white min-[651px]:text-[33px]">Our Operation Team</h2>
                        <p class="max-w-[470px] text-sm font-medium leading-[1.65] text-[#dbe4ee]">
                            Meet the LITUS Automobiles team, a passionate ensemble of dedicated professionals committed to elevating your motorcycle experience. With a wealth of knowledge and a shared drive to help every rider, our team is here to guide you, answer your questions, and keep your journey smooth from selection to service.
                        </p>
                    </div>

                    <div class="h-[180px] overflow-hidden rounded-lg bg-[#e9edf3] min-[651px]:h-[210px]">
                        <img src="{{ $operationTeamImg }}"
                             alt="LITUS Operation Team"
                             class="block h-full w-full object-cover object-center">
                    </div>

                    <div class="col-span-full mt-2.5 grid grid-cols-1 gap-[22px] min-[651px]:grid-cols-2 min-[1051px]:grid-cols-4">
                        @foreach ($opStats as $stat)
                            <div class="flex items-center gap-[15px] rounded-lg border border-white/25 bg-white/[0.04] px-[18px] py-[17px] max-[650px]:items-start">
                                <div class="flex h-[55px] w-[55px] shrink-0 items-center justify-center rounded-full bg-white text-[#ff1029]">
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
                <span class="mb-1.5 block text-sm font-black uppercase tracking-[3px] text-[#ff1029]">Our Locations</span>
                <h2 class="mb-2 text-[28px] font-black leading-tight text-[#07152f] min-[651px]:text-[34px]">Our Showrooms &amp; Service Centers</h2>
                <p class="text-sm font-semibold leading-normal text-[#555f70] min-[651px]:text-base">
                    Visit our showrooms and service centers across the Maldives for motorcycles, genuine parts, and trusted support.
                </p>
            </div>

            <div class="mb-[18px] grid grid-cols-1 gap-[18px] min-[651px]:grid-cols-2 min-[1101px]:grid-cols-4">
                @foreach ($showrooms as $showroom)
                    <div @class([
                        'overflow-hidden rounded-[9px] border border-[#dfe3ea] bg-white shadow-[0_8px_22px_rgba(0,0,0,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_14px_32px_rgba(0,0,0,0.1)]',
                        'min-[1101px]:col-span-2' => $showroom['featured'],
                    ])>
                        <div @class([
                            'h-[160px] overflow-hidden bg-[#dfe5ec] max-sm:h-[160px]',
                            'min-[651px]:h-[125px]' => ! $showroom['featured'],
                            'min-[651px]:h-[145px]' => $showroom['featured'],
                        ])>
                            <img src="{{ $showroom['img'] }}"
                                 alt="{{ $showroom['name'] }}"
                                 class="block h-full w-full object-cover">
                        </div>
                        <div class="px-[18px] pb-4 pt-3.5">
                            <h3 class="mb-2 text-base font-black text-[#111b46]">{{ $showroom['name'] }}</h3>
                            <p class="mb-3.5 text-[13px] font-semibold leading-snug text-[#404b60]">{{ $showroom['address'] }}</p>
                            <a href="{{ route('contact') }}"
                               class="group/contact inline-flex h-8 min-w-[140px] items-center justify-center gap-3 rounded-[5px] bg-[#061a45] px-[18px] text-[13px] font-black text-white transition-colors duration-300 hover:bg-[#ff1029]">
                                Contact Now
                                <x-litus-icon name="arrow-right" class="h-4 w-4 text-[#ff1029] transition-colors group-hover/contact:text-white" />
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
                    <div class="flex h-[78px] w-[78px] shrink-0 items-center justify-center rounded-full border-[5px] border-white/20 bg-[#e9252f] text-white shadow-[0_0_0_2px_rgba(255,16,41,0.45)] min-[651px]:h-[92px] min-[651px]:w-[92px]">
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
                   class="inline-flex h-[52px] min-w-[190px] items-center justify-center gap-3.5 rounded-md bg-[#f30d23] px-7 text-[15px] font-black text-white shadow-[0_8px_22px_rgba(243,13,35,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9081a] max-sm:w-full">
                    Contact Us
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
                <a href="#locations"
                   class="inline-flex h-[52px] min-w-[190px] items-center justify-center gap-3.5 rounded-md border-2 border-white/55 bg-white/[0.03] px-7 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#ff1029] hover:bg-[rgba(255,16,41,0.12)] max-sm:w-full">
                    View Locations
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
