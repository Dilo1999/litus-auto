@extends('layouts.litus')

@section('title', 'Genuine Parts — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/parts/' . rawurlencode('ChatGPT Image Jul 3, 2026, 03_07_42 PM.png'));

    $categories = [
        ['icon' => 'layers', 'title' => 'Body Components', 'desc' => 'Fairings, panels, covers, and bodywork for all models.'],
        ['icon' => 'cpu', 'title' => 'Engine Components', 'desc' => 'Pistons, gaskets, filters, and core engine parts.'],
        ['icon' => 'disc', 'title' => 'Braking Systems', 'desc' => 'Brake pads, discs, calipers, and hydraulic lines.'],
        ['icon' => 'zap', 'title' => 'Electrical & Ignition', 'desc' => 'Batteries, spark plugs, wiring, and ignition systems.'],
        ['icon' => 'settings', 'title' => 'Chassis & Suspension', 'desc' => 'Forks, shocks, frames, and swingarm components.'],
        ['icon' => 'gauge', 'title' => 'Wheels & Tires', 'desc' => 'Rims, spokes, tyres, and valve components.'],
    ];

    $whyGenuine = [
        ['icon' => 'check-circle', 'title' => 'Perfect Fit', 'desc' => 'Designed to match your motorcycle model accurately.'],
        ['icon' => 'shield', 'title' => 'Long-Lasting Quality', 'desc' => 'Durable components made for reliable daily use.'],
        ['icon' => 'gauge', 'title' => 'Better Performance', 'desc' => 'Maintain smooth riding, braking, handling, and engine response.'],
        ['icon' => 'headphones', 'title' => 'Trusted Support', 'desc' => 'Get help from the LITUS parts and service team.'],
    ];

    $steps = [
        ['icon' => 'send', 'title' => 'Submit Your Request', 'desc' => 'Tell us your motorcycle model and the parts you need.'],
        ['icon' => 'check-circle', 'title' => 'Team Verification', 'desc' => 'Our parts team checks availability and compatibility.'],
        ['icon' => 'headphones', 'title' => 'Get Support', 'desc' => 'We contact you with the right part details and next steps.'],
    ];

    $partCategoryOptions = ['Body Covers', 'Engine Components', 'Braking Systems', 'Electrical and Ignition', 'Chassis and Suspension', 'Wheels and Tires'];

    $motorcycleBrands = ['Honda', 'Yamaha', 'Suzuki', 'Piaggio', 'Other'];

    $heroFeatures = [
        ['icon' => 'shield', 'title' => 'Genuine Components', 'desc' => '100% authentic parts.'],
        ['icon' => 'settings', 'title' => 'Quality Checked', 'desc' => 'Tested for safety & durability.'],
        ['icon' => 'phone', 'title' => 'Fast Inquiry Support', 'desc' => 'Quick responses you can count on.'],
        ['icon' => 'wrench', 'title' => 'Service Center Assistance', 'desc' => 'Expert help, whenever you need it.'],
    ];
@endphp

<div class="font-sans" data-parts-page>

    <x-litus-header active="Parts" />

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
                    Genuine Motorcycle Parts
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:mb-2 max-md:text-[1.7rem] max-md:leading-[1.12]">
                    Find Genuine Parts<br>
                    for Every Ride
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] max-md:mb-3.5 max-md:max-w-[34ch] max-md:text-[13px] max-md:leading-snug sm:text-lg sm:leading-[1.55]">
                    Explore a wide range of genuine motorcycle parts built for quality,
                    reliability, safety, and performance - engineered to keep your ride
                    at its best.
                </p>

                <div class="flex flex-col items-stretch justify-start gap-2.5 max-md:w-full max-md:flex-row max-md:gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7">
                    <a href="#inquiry"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Request Parts
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                    <a href="tel:+9603331234"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Contact Parts Team
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- PARTS CATEGORIES --}}
    <section class="bg-white py-16">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Parts Categories</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Motorcycle Genuine Spare Parts</h2>
                <p class="mx-auto mt-2 max-w-xl text-gray-500">Browse our curated selection of genuine motorcycle components, ensuring peak performance, reliability, and longevity.</p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <div class="group flex cursor-pointer items-start gap-5 rounded-2xl border border-gray-100 bg-white p-6 transition-all duration-300 hover:border-blue-100 hover:shadow-lg">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-litus-red/10 transition-transform duration-300 group-hover:scale-105">
                            <x-litus-icon :name="$category['icon']" class="h-[26px] w-[26px] text-litus-red" />
                        </div>
                        <div class="flex-1">
                            <h3 class="mb-1 text-base font-black text-gray-900">{{ $category['title'] }}</h3>
                            <p class="mb-3 text-sm leading-relaxed text-gray-500">{{ $category['desc'] }}</p>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-litus-red">
                                Explore
                                <x-litus-icon name="arrow-right" class="h-3 w-3" />
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY GENUINE PARTS --}}
    <section class="bg-gray-100 py-14">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Why Genuine Parts?</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Built for Safety, Performance, and Reliability</h2>
            </div>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($whyGenuine as $item)
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-md">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-litus-navy/5">
                            <x-litus-icon :name="$item['icon']" class="h-[22px] w-[22px] text-litus-navy" />
                        </div>
                        <h3 class="mb-2 text-base font-black text-gray-900">{{ $item['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                        <div class="mx-auto mt-4 h-1 w-8 rounded-full bg-litus-red"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- INQUIRY FORM --}}
    <section id="inquiry" class="bg-litus-footer py-16">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Parts Inquiry</span>
                <h2 class="mt-2 font-display text-3xl font-black text-white lg:text-4xl">Request the Parts You Need</h2>
                <p class="mt-2 text-gray-400">Fill out the form and our team will help you find the right genuine parts for your motorcycle.</p>
            </div>

            <div class="flex flex-col items-stretch gap-8 lg:flex-row">
                <div class="relative min-h-[400px] overflow-hidden rounded-2xl lg:w-2/5">
                    <img src="https://images.unsplash.com/photo-1573496774426-fe3db3dd1731?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800&q=80"
                         alt="Parts support team"
                         class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-litus-footer/85 via-litus-footer/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <div class="mb-3 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-litus-red">
                                <x-litus-icon name="headphones" class="h-[18px] w-[18px] text-white" />
                            </div>
                            <div>
                                <p class="text-sm font-black text-white">LITUS Parts Team</p>
                                <p class="text-xs text-gray-300">Ready to assist you</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach (['Honda Parts', 'Yamaha Parts', 'Express Inquiry', 'Free Consultation'] as $tag)
                                <div class="flex items-center gap-1.5 text-xs text-gray-300">
                                    <x-litus-icon name="check-circle" class="h-[11px] w-[11px] text-litus-red" />
                                    {{ $tag }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form class="rounded-2xl border border-white/10 bg-white/5 p-7 backdrop-blur-md lg:w-3/5" action="#" method="post">
                    @csrf
                    <input type="hidden" name="category" value="" data-parts-category-input>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Motorcycle Brand</label>
                            <div class="relative z-20" data-parts-brand-select>
                                <input type="hidden" name="brand" value="" required data-parts-brand-input>
                                <button type="button"
                                        data-parts-brand-trigger
                                        aria-haspopup="listbox"
                                        aria-expanded="false"
                                        class="flex w-full cursor-pointer items-center rounded-xl border border-white/15 bg-white/10 px-4 py-3 pr-9 text-left text-sm outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20">
                                    <span data-parts-brand-label class="text-gray-400">Select a Brand</span>
                                </button>
                                <x-litus-icon name="chevron-down" class="pointer-events-none absolute right-3 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-gray-400" />
                                <div data-parts-brand-menu
                                     role="listbox"
                                     class="absolute left-0 right-0 top-full z-30 mt-1 hidden overflow-hidden rounded-xl border border-white/15 bg-[#03045e] shadow-xl">
                                    @foreach ($motorcycleBrands as $brand)
                                        <button type="button"
                                                role="option"
                                                data-parts-brand-option="{{ $brand }}"
                                                class="block w-full px-4 py-3 text-left text-sm text-white transition-colors hover:bg-white/10">
                                            {{ $brand }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Year of Made</label>
                            <input type="text" name="year" placeholder="e.g. 2023"
                                   class="w-full rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-sm text-white placeholder-gray-400 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Motorcycle Model</label>
                            <input type="text" name="model" placeholder="Enter motorcycle model"
                                   class="w-full rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-sm text-white placeholder-gray-400 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Select a Category</label>
                            <div class="grid grid-cols-2 gap-2 max-sm:grid-cols-1 sm:grid-cols-3">
                                @foreach ($partCategoryOptions as $option)
                                    <button type="button"
                                            data-parts-category="{{ $option }}"
                                            class="rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 text-left text-xs font-semibold text-gray-400 transition-all max-sm:min-h-11 max-sm:py-3">
                                        {{ $option }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Parts You Need</label>
                            <textarea name="parts" rows="3" placeholder="Describe the parts you need..."
                                      class="w-full resize-none rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-sm text-white placeholder-gray-400 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20"></textarea>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Your Full Name</label>
                            <input type="text" name="name" placeholder="Your full name"
                                   class="w-full rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-sm text-white placeholder-gray-400 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-300">Contact Number</label>
                            <input type="tel" name="contact" placeholder="Phone number"
                                   class="w-full rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-sm text-white placeholder-gray-400 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20">
                        </div>

                        <div class="pt-1 sm:col-span-2">
                            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-litus-red py-3.5 text-sm font-black text-white transition-opacity hover:opacity-90">
                                <x-litus-icon name="send" class="h-4 w-4" />
                                Send Inquiry
                            </button>
                            <p class="mt-3 text-center text-xs text-gray-500">Our team will respond within 24 hours on business days.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="bg-litus-navy py-14">
        <div class="litus-container flex flex-col items-center justify-between gap-8 lg:flex-row lg:items-center lg:gap-12">
            <div class="min-w-0 flex-1 text-center lg:text-left">
                <h2 class="mb-3 font-display text-3xl font-black text-white lg:text-4xl">
                    Not Sure Which Part<br>
                    <span class="text-litus-red">You Need?</span>
                </h2>
                <p class="max-w-xl leading-relaxed text-gray-400 lg:max-w-2xl">Our parts team can help you identify the correct component for your motorcycle model.</p>
            </div>
            <div class="flex w-full shrink-0 flex-col gap-3 sm:w-auto sm:flex-row lg:justify-end">
                <a href="tel:+9603331234" class="rounded-full bg-litus-red px-8 py-3.5 text-sm font-bold text-white transition-opacity hover:opacity-90">Talk to Parts Team</a>
                <a href="{{ route('service-center') }}" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">Visit Service Center</a>
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="bg-white py-14">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Simple Process</span>
                <h2 class="mt-2 font-display text-2xl font-black text-gray-900 lg:text-3xl">How Parts Inquiry Works</h2>
            </div>
            <div class="flex flex-col items-start lg:flex-row">
                @foreach ($steps as $index => $step)
                    <div class="flex flex-1 flex-col items-start gap-0 lg:flex-row">
                        <div class="group relative flex-1 px-6 py-8 text-center">
                            <div class="relative mb-5 inline-flex">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full border-2 border-dashed border-gray-200 bg-litus-red/5 transition-colors group-hover:border-blue-200">
                                    <x-litus-icon :name="$step['icon']" class="h-6 w-6 text-litus-red" />
                                </div>
                                <span class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-litus-red text-xs font-black text-white">{{ $index + 1 }}</span>
                            </div>
                            <h3 class="mb-2 text-base font-black text-gray-900">{{ $step['title'] }}</h3>
                            <p class="mx-auto max-w-[200px] text-sm leading-relaxed text-gray-500">{{ $step['desc'] }}</p>
                        </div>
                        @if ($index < count($steps) - 1)
                            <div class="hidden items-center justify-center self-center lg:flex">
                                <x-litus-icon name="arrow-right" class="h-[22px] w-[22px] text-gray-300" />
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
