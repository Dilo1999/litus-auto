@extends('layouts.litus')

@section('title', 'Contact Us - LITUS Automobiles')

@section('content')
@php
    ['desktop' => $heroBg, 'mobile' => $heroBgMobile] = \App\Models\PageSetting::heroForRoute('contact');

    $heroFeatures = [
        ['icon' => 'clock', 'title' => 'Fast Response', 'desc' => 'Within one working day'],
        ['icon' => 'users', 'title' => 'Friendly Help', 'desc' => 'A team that listens and cares'],
        ['icon' => 'file-text', 'title' => 'Sales Assistance', 'desc' => 'Guidance for every purchase'],
        ['icon' => 'wrench', 'title' => 'Service Guidance', 'desc' => 'Support for your ride'],
    ];

    $contactCards = [
        [
            'icon' => 'phone',
            'title' => 'Call us',
            'value' => '+960 779 7442',
            'action' => 'Call Now',
            'href' => 'tel:+9607797442',
        ],
        [
            'icon' => 'message-circle',
            'title' => 'WhatsApp us',
            'value' => '+960 779 7442',
            'action' => 'Open WhatsApp',
            'href' => 'https://wa.me/9607797442',
        ],
        [
            'icon' => 'mail',
            'title' => 'Email us',
            'value' => 'sales@litusgroup.mv',
            'action' => 'Send Email',
            'href' => 'mailto:sales@litusgroup.mv',
        ],
    ];

    $inquiryTypes = [
        'Buying a motorcycle',
        'Ijara ownership plan',
        'A current promotion',
        'Parts',
        'Service booking',
        'Something else',
    ];

    // Locations come from Filament / showrooms table via ContactController
    $visitShowrooms = $visitShowrooms ?? [];

    $showrooms = collect($visitShowrooms)->map(fn ($s) => [
        'name' => $s['name'],
        'label' => $s['name'],
    ])->all();

    $hours = [
        ['label' => 'Sales support', 'value' => 'Sun-Thu · 9:30 AM - 6:00 PM'],
        ['label' => 'Service centre', 'value' => 'Sun-Thu · 9:30 AM - 6:00 PM'],
        ['label' => 'Online inquiry', 'value' => 'Anytime'],
    ];

    $mapsEmbedUrl = 'https://www.google.com/maps?q=Ma.%20Elysium%2C%20Buruzu%20Magu%2C%20Male%2C%20Maldives&output=embed';
    $mapsLinkUrl = 'https://www.google.com/maps/search/?api=1&query=Ma.%20Elysium%2C%20Buruzu%20Magu%2C%20Male%2C%20Maldives';

    $fieldLabel = 'mb-1.5 block text-[12px] font-semibold text-litus-text-2 sm:text-[12.5px]';
    $fieldControl = 'w-full rounded-[10px] border border-litus-line-2 bg-white px-3 py-2.5 text-[14px] text-litus-text outline-none transition placeholder:text-litus-text-3 focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(18,87,214,0.12)] sm:px-3.5 sm:py-3 sm:text-[14.5px]';
@endphp

<div class="font-sans" data-contact-page>

    <x-litus-header active="Contact" />

    {{-- HERO — desktop --}}
    <section class="relative hidden overflow-hidden bg-litus-ink text-white min-[961px]:block">
        <div class="pointer-events-none absolute inset-y-0 right-[2%] z-[1] w-[58%] lg:w-[52%]"
             aria-hidden="true">
            <img src="{{ $heroBg }}"
                 alt=""
                 class="absolute inset-0 h-full w-full origin-bottom scale-[1.22] object-contain object-[center_bottom]">
        </div>
        <div class="pointer-events-none absolute inset-0 z-[2] bg-[linear-gradient(90deg,rgba(5,11,24,0.98)_0%,rgba(5,11,24,0.94)_42%,rgba(5,11,24,0.55)_68%,rgba(5,11,24,0.2)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 z-[2]"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.22), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.45) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 z-[2] opacity-[0.28]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(32px,4vw,56px)] pb-[clamp(28px,3.5vw,44px)]">
            <div class="max-w-[560px] lg:max-w-[580px]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Customer Support</span>
                <h1 class="font-display text-[clamp(28px,3.8vw,46px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    We are here to help<br><span class="text-litus-sky">you ride better.</span>
                </h1>
                <p class="mt-3 max-w-[560px] text-[clamp(15px,1.3vw,17px)] leading-[1.66] text-white/[0.78]">
                    Questions about motorcycles, ownership plans, parts or service? Our team is ready to help - by phone, WhatsApp, email, or in person at any of our showrooms.
                </p>
                <div class="litus-cta-row mt-5">
                    <a href="#contact-form"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-[15px] text-[15px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                        Send a Message
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ $mapsLinkUrl }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-[15px] text-[15px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                        Get Directions
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/35 backdrop-blur-sm">
            <div class="litus-container grid grid-cols-2 gap-0 py-[14px] lg:grid-cols-4 lg:py-[18px]">
                @foreach ($heroFeatures as $index => $item)
                    <div @class([
                        'flex items-center gap-[13px] px-4',
                        'border-r border-white/16' => $index < count($heroFeatures) - 1,
                    ])>
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div class="min-w-0">
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
             class="pointer-events-none absolute inset-0 h-full w-full object-cover object-[center_30%] opacity-[0.35]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.18]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px;"></div>

        <div class="relative z-[3] flex flex-col">
            <div class="litus-container pt-12 pb-4">
                <div class="max-w-[36rem]">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Customer Support</span>
                    <h1 class="max-w-[16ch] font-display text-[clamp(1.85rem,7.2vw,2.25rem)] font-extrabold leading-[1.1] tracking-[-0.032em]">
                        We are here to help <span class="text-litus-sky">you ride better.</span>
                    </h1>
                    <p class="mt-3 line-clamp-4 max-w-[38ch] text-[14px] leading-[1.62] text-white/[0.72]">
                        Questions about motorcycles, plans, parts or service? Reach us by phone, WhatsApp, email, or at any showroom.
                    </p>
                </div>
            </div>

            <div class="litus-container pb-4">
                <div class="flex flex-row gap-2">
                    <a href="#contact-form"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:bg-litus-primary-hover">
                        Message
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                    <a href="{{ $mapsLinkUrl }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border-[1.5px] border-white/32 px-3 text-[13px] font-semibold text-white transition hover:border-white hover:bg-white/10">
                        Directions
                    </a>
                </div>
            </div>

            <x-litus-hero-features :features="$heroFeatures" />
        </div>
    </section>

    {{-- GET IN TOUCH --}}
    <section class="litus-sec max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Get in Touch</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Contact LITUS Automobiles</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Reach our team through phone, WhatsApp, email, or visit our office.
                </p>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden md:grid-cols-3">
                    @foreach ($contactCards as $card)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="group h-full rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-[26px] sm:py-[30px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mb-3 grid h-10 w-10 place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)] sm:mb-[18px] sm:h-[42px] sm:w-[42px]">
                                    <x-litus-icon :name="$card['icon']" class="h-4 w-4 sm:h-5 sm:w-5" />
                                </div>
                                <h4 class="mb-1.5 text-[16px] font-bold text-litus-text sm:text-lg">{{ $card['title'] }}</h4>
                                <p class="mb-3 text-[14px] font-semibold text-litus-text sm:mb-4 sm:text-base">{{ $card['value'] }}</p>
                                <a href="{{ $card['href'] }}"
                                   @if (str_starts_with($card['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                                   class="inline-flex min-h-10 items-center gap-2 text-[13.5px] font-semibold text-litus-primary transition hover:gap-3 sm:text-[14.5px]">
                                    {{ $card['action'] }}
                                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($contactCards) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($contactCards as $index => $card)
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

    {{-- FORM + MAP --}}
    <section id="contact-form" class="litus-sec scroll-mt-24 bg-litus-paper-2 max-md:!py-12">
        <div class="litus-container grid grid-cols-1 items-stretch gap-6 min-[1000px]:grid-cols-2 min-[1000px]:gap-[34px]">
            <div class="max-md:order-1 flex min-h-full flex-col rounded-2xl border border-litus-line bg-white p-5 shadow-[0_2px_8px_rgba(9,17,32,0.06)] sm:rounded-[26px] sm:p-[clamp(20px,3.2vw,40px)] sm:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                <div class="hidden flex-1 py-10 text-center" data-contact-success>
                    <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full bg-[rgba(18,87,214,0.1)] text-litus-primary">
                        <x-litus-icon name="check-circle" class="h-8 w-8" />
                    </div>
                    <h3 class="font-display text-2xl font-bold text-litus-text">Message sent</h3>
                    <p class="mx-auto mt-3 max-w-sm text-[15px] leading-relaxed text-litus-text-2">
                        Our team will get back to you within one working day.
                    </p>
                    <button type="button"
                            data-contact-reset
                            class="mt-6 text-[14.5px] font-semibold text-litus-primary underline">
                        Send another message
                    </button>
                </div>

                <form data-contact-form action="#" method="post" class="grid flex-1 grid-cols-1 content-start gap-4 sm:grid-cols-2 sm:gap-5">
                    @csrf
                    <div class="sm:col-span-2">
                        <h3 class="font-display text-[clamp(18px,4vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Send us a message</h3>
                        <p class="mt-1.5 text-[13px] text-litus-text-2 sm:text-sm">Fill in the form and our team will contact you shortly.</p>
                    </div>
                    <div>
                        <label class="{{ $fieldLabel }}">Full name</label>
                        <input type="text" name="name" placeholder="Enter your name" required class="{{ $fieldControl }}">
                    </div>
                    <div>
                        <label class="{{ $fieldLabel }}">Mobile number</label>
                        <input type="tel" name="mobile" placeholder="7XXXXXX" required class="{{ $fieldControl }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="{{ $fieldLabel }}">Email address</label>
                        <input type="email" name="email" placeholder="Enter your email" required class="{{ $fieldControl }}">
                    </div>
                    <div>
                        <label class="{{ $fieldLabel }}">Inquiry type</label>
                        <div class="litus-select-wrap">
                            <select name="inquiry_type" required class="litus-select {{ $fieldControl }} pr-10">
                                @foreach ($inquiryTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                        </div>
                    </div>
                    <div>
                        <label class="{{ $fieldLabel }}">Nearest showroom</label>
                        <div class="litus-select-wrap">
                            <select name="showroom" class="litus-select {{ $fieldControl }} pr-10">
                                @foreach ($showrooms as $showroom)
                                    <option value="{{ $showroom['name'] }}">{{ $showroom['label'] }}</option>
                                @endforeach
                            </select>
                            <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                        </div>
                    </div>
                    <div class="flex min-h-0 flex-col sm:col-span-2">
                        <label class="{{ $fieldLabel }}">Message</label>
                        <textarea name="message" rows="5" placeholder="How can we help you?" required class="{{ $fieldControl }} min-h-[140px] flex-1 resize-y sm:min-h-[180px]"></textarea>
                    </div>
                    <div class="mt-auto sm:col-span-2">
                        <button type="submit"
                                class="inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:px-8 sm:py-[17px] sm:text-[15.5px]">
                            Send Message
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>
                    </div>
                </form>
            </div>

            <div class="max-md:order-2">
                <div class="overflow-hidden rounded-2xl border border-litus-line bg-litus-paper-3 shadow-[0_1px_2px_rgba(9,17,32,.05)] sm:rounded-[18px]">
                    <div class="relative aspect-[4/3] bg-[#DCE8FF] max-md:aspect-[16/10]">
                        <iframe title="LITUS Head Office map"
                                src="{{ $mapsEmbedUrl }}"
                                class="absolute inset-0 h-full w-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/45 to-transparent px-5 pb-4 pt-10 text-white">
                            <div class="flex items-start gap-2">
                                <x-litus-icon name="map-pin" class="mt-0.5 h-4 w-4 shrink-0" />
                                <div>
                                    <b class="block font-display text-[15px]">Ma. Elysium, Buruzu Magu</b>
                                    <span class="text-[13px] text-white/80">Malé, Maldives</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ $mapsLinkUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mt-3 inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-5 py-3 text-[14px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary sm:mt-3.5 sm:py-3.5 sm:text-[14.5px]">
                    Open in Google Maps
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>

                <div class="mt-4 rounded-2xl border border-litus-line bg-white p-5 shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)] sm:mt-[22px] sm:rounded-[26px] sm:p-[26px]">
                    <h4 class="mb-3 font-display text-[clamp(18px,4vw,24px)] font-semibold tracking-[-0.02em] text-litus-text sm:mb-4">Business hours</h4>
                    <div class="divide-y divide-litus-line text-[14.5px]">
                        @foreach ($hours as $row)
                            <div class="flex flex-col gap-0.5 py-3.5 min-[420px]:flex-row min-[420px]:justify-between min-[420px]:gap-4">
                                <span class="text-litus-text-2">{{ $row['label'] }}</span>
                                <b class="text-litus-text min-[420px]:text-right">{{ $row['value'] }}</b>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-3.5 text-xs text-litus-text-3">
                        Send your inquiry anytime - our team will respond as soon as possible.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- VISIT US --}}
    <section class="litus-sec max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Visit Us</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Our showrooms and service centres</h2>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($visitShowrooms as $showroom)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="group flex h-full flex-col rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-[26px] sm:py-[28px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mb-3 grid h-10 w-10 place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)] sm:mb-4 sm:h-[42px] sm:w-[42px]">
                                    <x-litus-icon name="map-pin" class="h-4 w-4 sm:h-5 sm:w-5" />
                                </div>
                                <h4 class="mb-2 text-[16px] font-bold text-litus-text sm:text-lg">{{ $showroom['name'] }}</h4>
                                <p class="mb-3 text-[14px] leading-relaxed text-litus-text-2 sm:mb-3.5 sm:text-[14.5px]">{{ $showroom['address'] }}</p>
                                <div class="mb-3 flex flex-wrap gap-1.5 sm:mb-4 sm:gap-2">
                                    @foreach ($showroom['services'] as $service)
                                        <span class="rounded-full bg-litus-paper-3 px-2.5 py-1 text-[11.5px] font-semibold text-litus-text-2 sm:px-3 sm:py-1.5 sm:text-[12.5px]">{{ $service }}</span>
                                    @endforeach
                                </div>
                                <a href="tel:{{ preg_replace('/\s+/', '', $showroom['phone']) }}"
                                   class="mt-auto inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg border-[1.5px] border-litus-line-2 bg-white px-4 py-3 text-[13px] font-semibold text-litus-ink transition hover:-translate-y-0.5 hover:border-litus-primary-light hover:text-litus-primary sm:text-[13.5px]">
                                    <x-litus-icon name="phone" class="h-4 w-4" />
                                    {{ $showroom['phone'] }}
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($visitShowrooms) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($visitShowrooms as $index => $showroom)
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
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Need quick assistance?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our team can help with motorcycle availability, ownership plans, parts and service bookings.
                </p>
            </div>
            <div class="litus-cta-row">
                <a href="tel:+9607797442"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Call Now
                </a>
                <a href="https://wa.me/9607797442"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1FA855] px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443]">
                    <x-litus-icon name="message-circle" class="h-4 w-4" />
                    WhatsApp Us
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
