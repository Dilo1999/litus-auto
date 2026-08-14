@extends('layouts.litus')

@section('title', 'Genuine Parts — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/parts/' . rawurlencode('ChatGPT Image Jul 3, 2026, 03_07_42 PM.png'));

    $heroStrip = [
        ['icon' => 'shield', 'title' => 'Genuine Components', 'sub' => '100% authentic parts'],
        ['icon' => 'check-circle', 'title' => 'Quality Checked', 'sub' => 'Tested for safety & durability'],
        ['icon' => 'clock', 'title' => 'Fast Response', 'sub' => 'Quick inquiry turnaround'],
        ['icon' => 'wrench', 'title' => 'Fitting Available', 'sub' => 'Expert help when you need it'],
    ];

    $categories = [
        ['icon' => 'layers', 'title' => 'Body Components', 'desc' => 'Fairings, panels, covers and bodywork for all models.'],
        ['icon' => 'cpu', 'title' => 'Engine Components', 'desc' => 'Pistons, gaskets, filters, and core engine parts.'],
        ['icon' => 'disc', 'title' => 'Braking Systems', 'desc' => 'Brake pads, discs, calipers and hydraulic lines.'],
        ['icon' => 'zap', 'title' => 'Electrical & Ignition', 'desc' => 'Batteries, spark plugs, wiring and ignition systems.'],
        ['icon' => 'settings', 'title' => 'Chassis & Suspension', 'desc' => 'Forks, shocks, frames and swingarm components.'],
        ['icon' => 'gauge', 'title' => 'Wheels & Tyres', 'desc' => 'Rims, spokes, tyres and tube components.'],
    ];

    $whyGenuine = [
        ['icon' => 'check-circle', 'title' => 'Perfect fit', 'desc' => 'Designed to match your motorcycle model accurately, so nothing is forced or adapted.'],
        ['icon' => 'shield', 'title' => 'Long lasting quality', 'desc' => 'Durable components made for reliable daily use in island conditions.'],
        ['icon' => 'gauge', 'title' => 'Better performance', 'desc' => 'Maintains smooth riding, braking and engine response as designed.'],
        ['icon' => 'headphones', 'title' => 'Trusted support', 'desc' => 'Backed by the LITUS parts and service team, with warranty intact.'],
    ];

    $inquirySteps = [
        ['title' => 'Submit your request', 'text' => 'Tell us your model and the parts you need.'],
        ['title' => 'Team verification', 'text' => 'Our parts team checks availability and compatibility.'],
        ['title' => 'Get support', 'text' => 'We confirm price, timing and fitting options.'],
    ];

    $categoryPills = ['Body', 'Engine', 'Braking', 'Electrical', 'Chassis', 'Wheels & Tyres'];
    $brands = ['Honda', 'Yamaha', 'Sunra'];

    $fieldLabel = 'mb-1.5 block text-[12.5px] font-semibold text-white/70';
    $fieldControl = 'w-full rounded-[10px] border border-white/22 bg-white/[0.08] px-3.5 py-3 text-[14.5px] text-white outline-none transition placeholder:text-white/40 focus:border-litus-sky/60 focus:bg-white/[0.12]';
@endphp

<div class="font-sans" data-parts-page>

    <x-litus-header active="Parts" />

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-litus-ink text-white">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right] max-md:object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)] max-md:bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.28), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.55) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.28]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(48px,6.5vw,88px)] pb-[clamp(40px,5vw,68px)]">
            <div class="max-w-[820px]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Genuine Motorcycle Parts</span>
                <h1 class="font-display text-[clamp(30px,4.2vw,50px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    Find genuine parts<br><span class="text-litus-sky">for every ride.</span>
                </h1>
                <p class="mt-4 max-w-[520px] text-[clamp(16px,1.4vw,18px)] leading-[1.66] text-white/[0.78]">
                    A full range of genuine motorcycle parts built for quality, reliability, safety and performance — engineered to keep your ride at its best.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#request"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-[15px] text-[15px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                        Request a Part
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ route('service-center') }}"
                       class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-[15px] text-[15px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                        Visit Service Centre
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/35 backdrop-blur-sm">
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

    {{-- CATEGORIES --}}
    <section class="litus-sec">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Parts Categories</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Motorcycle genuine spare parts</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Browse our stocked selection of genuine motorcycle components, ensuring peak performance, reliability and longevity.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($categories as $category)
                    <article class="group rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px] shadow-[0_1px_2px_rgba(9,17,32,.05)] transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="mb-[18px] grid h-[42px] w-[42px] place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)]">
                            <x-litus-icon :name="$category['icon']" class="h-5 w-5" />
                        </div>
                        <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $category['title'] }}</h4>
                        <p class="text-[14.5px] leading-relaxed text-litus-text-2">{{ $category['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY GENUINE --}}
    <section class="litus-sec bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Why Genuine Parts?</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Built for safety, performance and reliability</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @foreach ($whyGenuine as $item)
                    <article class="group rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px] shadow-[0_1px_2px_rgba(9,17,32,.05)] transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                        <div class="mb-[18px] grid h-[42px] w-[42px] place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)]">
                            <x-litus-icon :name="$item['icon']" class="h-5 w-5" />
                        </div>
                        <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $item['title'] }}</h4>
                        <p class="text-[14.5px] leading-relaxed text-litus-text-2">{{ $item['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- REQUEST FORM --}}
    <section id="request" class="scroll-mt-24 overflow-hidden bg-litus-ink text-white">
        <div class="litus-sec">
            <div class="litus-container grid grid-cols-1 items-start gap-12 min-[1000px]:grid-cols-[0.9fr_1.1fr] min-[1000px]:gap-12">
                <div>
                    <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Parts Inquiry</span>
                    <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Request the parts you need</h2>
                    <p class="mt-3.5 max-w-[460px] text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.74]">
                        Fill in the form and our team will help you find the right genuine part for your motorcycle. If we do not have it in stock we will tell you how long it takes to bring in.
                    </p>

                    <div class="mt-8 grid grid-cols-1 gap-3.5 sm:grid-cols-3">
                        @foreach ($inquirySteps as $index => $step)
                            <div class="rounded-[18px] border border-white/12 bg-white/[0.05] px-5 py-5">
                                <div class="mb-3 grid h-[34px] w-[34px] place-items-center rounded-[9px] bg-[rgba(90,184,255,0.16)] text-sm font-bold text-litus-sky">
                                    {{ $index + 1 }}
                                </div>
                                <b class="mb-1 block text-[15px] text-white">{{ $step['title'] }}</b>
                                <span class="text-[13.5px] leading-relaxed text-white/66">{{ $step['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[26px] border border-white/15 bg-white/[0.06] p-[clamp(22px,3vw,32px)] backdrop-blur-[10px]">
                    <form data-parts-inquiry-form class="grid grid-cols-1 gap-4 sm:grid-cols-2" action="#" method="post">
                        @csrf
                        <input type="hidden" name="category" value="" data-parts-category-input>

                        <div>
                            <label class="{{ $fieldLabel }}">Motorcycle brand</label>
                            <select name="brand" required class="{{ $fieldControl }} [color-scheme:dark]">
                                <option value="" class="text-litus-text">Select a brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand }}" class="text-litus-text">{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="{{ $fieldLabel }}">Year of make</label>
                            <input type="text" name="year" placeholder="e.g. 2023" class="{{ $fieldControl }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="{{ $fieldLabel }}">Motorcycle model</label>
                            <input type="text" name="model" placeholder="Enter motorcycle model" class="{{ $fieldControl }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="{{ $fieldLabel }}">Select a category</label>
                            <div class="mt-1 flex flex-wrap gap-2.5">
                                @foreach ($categoryPills as $pill)
                                    <button type="button"
                                            data-parts-category="{{ $pill }}"
                                            class="rounded-full border border-white/12 bg-white/[0.09] px-3.5 py-1.5 text-[12.5px] font-semibold text-white/80 transition hover:border-white/25 hover:bg-white/[0.14]">
                                        {{ $pill }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="{{ $fieldLabel }}">Parts you need</label>
                            <textarea name="parts" rows="3" placeholder="Describe the parts you need…" class="{{ $fieldControl }} min-h-[96px] resize-y"></textarea>
                        </div>
                        <div>
                            <label class="{{ $fieldLabel }}">Your full name</label>
                            <input type="text" name="name" placeholder="Full name" class="{{ $fieldControl }}">
                        </div>
                        <div>
                            <label class="{{ $fieldLabel }}">Contact number</label>
                            <input type="tel" name="contact" placeholder="7XXXXXX" class="{{ $fieldControl }}">
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                                Send Inquiry
                                <x-litus-icon name="arrow-right" class="h-4 w-4" />
                            </button>
                            <p class="mt-3.5 text-center text-xs text-white/50">
                                Our team will respond within one working day.
                            </p>
                        </div>
                    </form>

                    <div data-parts-inquiry-success class="hidden py-10 text-center">
                        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full bg-[rgba(90,184,255,0.16)] text-litus-sky">
                            <x-litus-icon name="check-circle" class="h-8 w-8" />
                        </div>
                        <h3 class="font-display text-2xl font-bold text-white">Inquiry sent</h3>
                        <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-white/70">
                            Our parts team will respond within one working day with availability and next steps.
                        </p>
                        <button type="button"
                                data-parts-inquiry-reset
                                class="mt-7 inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-3.5 text-[14.5px] font-semibold text-white transition hover:border-white hover:bg-white/10">
                            Send Another Inquiry
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Not sure which part you need?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our parts team can help you identify the correct component for your motorcycle model.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="#request"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Talk to Parts Team
                </a>
                <a href="{{ route('service-center') }}"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    Visit Service Centre
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
