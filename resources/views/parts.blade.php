@extends('layouts.litus')

@section('title', 'Genuine Parts - LITUS Automobiles')

@section('content')
@php
    ['desktop' => $heroBg, 'mobile' => $heroBgMobile] = \App\Models\PageSetting::heroForRoute('parts');

    $heroFeatures = [
        ['icon' => 'shield', 'title' => 'Genuine Components', 'desc' => '100% authentic parts'],
        ['icon' => 'check-circle', 'title' => 'Quality Checked', 'desc' => 'Tested for safety & durability'],
        ['icon' => 'clock', 'title' => 'Fast Response', 'desc' => 'Quick inquiry turnaround'],
        ['icon' => 'wrench', 'title' => 'Fitting Available', 'desc' => 'Expert help when you need it'],
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
@endphp

<div class="font-sans" data-parts-page>

    <x-litus-header active="Parts" />

    {{-- HERO — desktop --}}
    <section class="relative hidden overflow-hidden bg-litus-ink text-white min-[961px]:block">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)]"></div>
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
                    A full range of genuine motorcycle parts built for quality, reliability, safety and performance - engineered to keep your ride at its best.
                </p>
                <div class="litus-cta-row mt-6">
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
            <div class="litus-container grid grid-cols-2 gap-4 py-[22px] lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroFeatures as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div>
                            <b class="block text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
                            <span class="block text-[12.5px] leading-snug text-white/60">{{ $item['desc'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HERO — mobile --}}
    <section class="relative overflow-hidden bg-litus-ink text-white min-[961px]:hidden">
        <img src="{{ $heroBgMobile }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.18]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px;"></div>

        <div class="relative z-[3] flex flex-col">
            <div class="litus-container pt-12 pb-4">
                <div class="max-w-[36rem]">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Genuine Motorcycle Parts</span>
                    <h1 class="max-w-[16ch] font-display text-[clamp(1.85rem,7.2vw,2.25rem)] font-extrabold leading-[1.1] tracking-[-0.032em]">
                        Find genuine parts <span class="text-litus-sky">for every ride.</span>
                    </h1>
                    <p class="mt-3 line-clamp-4 max-w-[38ch] text-[14px] leading-[1.62] text-white/[0.72]">
                        Genuine motorcycle parts for quality, reliability, safety and performance, engineered to keep your ride at its best.
                    </p>
                </div>
            </div>

            <div class="litus-container pb-4">
                <div class="flex flex-row gap-2">
                    <a href="#request"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:bg-litus-primary-hover">
                        Request Part
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                    <a href="{{ route('service-center') }}"
                       class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border-[1.5px] border-white/32 px-3 text-[13px] font-semibold text-white transition hover:border-white hover:bg-white/10">
                        Service
                    </a>
                </div>
            </div>

            <x-litus-hero-features :features="$heroFeatures" />
        </div>
    </section>

    {{-- CATEGORIES --}}
    <section class="litus-sec max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Parts Categories</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Motorcycle genuine spare parts</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Browse our stocked selection of genuine motorcycle components, ensuring peak performance, reliability and longevity.
                </p>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($categories as $category)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="group h-full rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-[26px] sm:py-[30px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mb-3 grid h-10 w-10 place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)] sm:mb-[18px] sm:h-[42px] sm:w-[42px]">
                                    <x-litus-icon :name="$category['icon']" class="h-4 w-4 sm:h-5 sm:w-5" />
                                </div>
                                <h4 class="mb-2 text-[16px] font-bold text-litus-text sm:text-lg">{{ $category['title'] }}</h4>
                                <p class="text-[14px] leading-relaxed text-litus-text-2 sm:text-[14.5px]">{{ $category['desc'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($categories) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($categories as $index => $category)
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

    

    {{-- REQUEST FORM --}}
    <section id="request" class="scroll-mt-24 overflow-hidden bg-litus-ink text-white">
        <div class="litus-sec max-md:!py-12">
            <div class="litus-container grid grid-cols-1 items-start gap-8 min-[1000px]:grid-cols-[0.9fr_1.1fr] min-[1000px]:gap-12">
                <div class="max-md:order-2">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky sm:mb-3.5">Parts Inquiry</span>
                    <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em]">Request the parts you need</h2>
                    <p class="mt-3 max-w-[460px] text-[15px] leading-[1.66] text-white/[0.74] sm:mt-3.5 sm:text-[clamp(16.5px,1.5vw,19px)]">
                        Fill in the form and our team will help you find the right genuine part for your motorcycle. If we do not have it in stock we will tell you how long it takes to bring in.
                    </p>

                    <div data-home-card-slider-wrap class="mt-6 sm:mt-8">
                        <div
                            data-home-card-slider
                            data-interval="5000"
                            class="grid grid-cols-1 gap-3.5 max-md:-mx-4 max-md:flex max-md:gap-3 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden sm:grid-cols-3 sm:gap-3.5">
                            @foreach ($inquirySteps as $index => $step)
                                <div data-home-card-slide class="max-md:w-[min(88%,280px)] max-md:shrink-0 max-md:snap-center">
                                    <div class="h-full rounded-2xl border border-white/12 bg-white/[0.05] px-4 py-4 sm:rounded-[18px] sm:px-5 sm:py-5">
                                        <div class="mb-2.5 grid h-8 w-8 place-items-center rounded-[9px] bg-[rgba(90,184,255,0.16)] text-xs font-bold text-litus-sky sm:mb-3 sm:h-[34px] sm:w-[34px] sm:text-sm">
                                            {{ $index + 1 }}
                                        </div>
                                        <b class="mb-1 block text-[14px] text-white sm:text-[15px]">{{ $step['title'] }}</b>
                                        <span class="text-[13px] leading-relaxed text-white/66 sm:text-[13.5px]">{{ $step['text'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if (count($inquirySteps) > 1)
                            <div class="mt-3 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                                @foreach ($inquirySteps as $index => $step)
                                    <span @class([
                                        'h-1.5 rounded-full transition-all duration-300',
                                        'w-5 bg-litus-sky' => $index === 0,
                                        'w-1.5 bg-white/35' => $index !== 0,
                                    ])
                                          data-home-card-dot></span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <x-forms.parts-inquiry-form
                    :brands="$brands"
                    :category-pills="$categoryPills"
                    class="max-md:order-1" />
            </div>
        </div>
    </section>

    {{-- WHY GENUINE --}}
    <section class="litus-sec bg-litus-paper-2 max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Why Genuine Parts?</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Built for safety, performance and reliability</h2>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden sm:grid-cols-2 xl:grid-cols-4">
                    @foreach ($whyGenuine as $item)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="group h-full rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-[26px] sm:py-[30px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mb-3 grid h-10 w-10 place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)] sm:mb-[18px] sm:h-[42px] sm:w-[42px]">
                                    <x-litus-icon :name="$item['icon']" class="h-4 w-4 sm:h-5 sm:w-5" />
                                </div>
                                <h4 class="mb-2 text-[16px] font-bold text-litus-text sm:text-lg">{{ $item['title'] }}</h4>
                                <p class="text-[14px] leading-relaxed text-litus-text-2 sm:text-[14.5px]">{{ $item['desc'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($whyGenuine) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($whyGenuine as $index => $item)
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

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white max-md:hidden">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Not sure which part you need?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our parts team can help you identify the correct component for your motorcycle model.
                </p>
            </div>
            <div class="litus-cta-row">
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
