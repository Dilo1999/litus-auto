@extends('layouts.litus')

@section('title', 'Contact Us — LITUS Automobiles')

@section('content')
@php
    $heroBg = 'https://images.unsplash.com/photo-1605902711622-cfb43c4437d2?auto=format&fit=crop&w=1800&q=80';
    $heroAgentsImg = asset('images/contact us/' . rawurlencode('ChatGPT Image Jul 4, 2026, 11_35_33 AM.png'));

    $heroFeatures = [
        ['icon' => 'phone', 'title' => 'Fast Response', 'desc' => 'Quick answers when you need them.'],
        ['icon' => 'headphones', 'title' => 'Friendly Help', 'desc' => 'A team that listens and cares.'],
        ['icon' => 'mail', 'title' => 'Sales Assistance', 'desc' => 'Guidance for every purchase.'],
        ['icon' => 'wrench', 'title' => 'Service Guidance', 'desc' => 'Expert support for your ride.'],
    ];

    $contactCards = [
        [
            'icon' => 'phone',
            'title' => 'Call Us',
            'value' => '+960 779 7442',
            'action' => 'Call Now',
            'href' => 'tel:+9607797442',
        ],
        [
            'icon' => 'mail',
            'title' => 'Email Us',
            'value' => 'sales@litusgroup.mv',
            'action' => 'Send Email',
            'href' => 'mailto:sales@litusgroup.mv',
        ],
        [
            'icon' => 'map-pin',
            'title' => 'Visit Us',
            'value' => 'Ma. Elyzium, Buruzu Magu,<br>Malé, Maldives',
            'value_html' => true,
            'action' => 'View Location',
            'href' => 'https://maps.google.com/?q=Male,Maldives',
        ],
    ];

    $inquiryTypes = ['Motorcycle Availability', 'Ownership Plans', 'Parts Inquiry', 'Service Booking', 'General Inquiry'];

    $socials = [
        ['icon' => 'facebook', 'href' => '#', 'bg' => 'bg-[#1877f2]', 'label' => 'Facebook'],
        ['icon' => 'instagram', 'href' => '#', 'bg' => 'bg-gradient-to-br from-[#833ab4] via-[#fd1d1d] to-[#fcb045]', 'label' => 'Instagram'],
        ['icon' => 'message-circle', 'href' => 'https://wa.me/9607797442', 'bg' => 'bg-[#25d366]', 'label' => 'WhatsApp'],
        ['icon' => 'mail', 'href' => 'mailto:sales@litusgroup.mv', 'bg' => 'bg-[#f44336]', 'label' => 'Email'],
    ];

    $quickAssistanceBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1200&q=80';
    $mapsEmbedUrl = 'https://www.google.com/maps?q=Ma.%20Elyzium%2C%20Buruzu%20Magu%2C%20Male%2C%20Maldives&output=embed';
    $mapsLinkUrl = 'https://www.google.com/maps/search/?api=1&query=Ma.%20Elyzium%2C%20Buruzu%20Magu%2C%20Male%2C%20Maldives';

    $darkInputCls = 'w-full rounded-xl border border-white/[0.22] bg-[#061326] px-3.5 py-3.5 text-sm text-white placeholder-[#9ca8b7] outline-none transition-all duration-300 focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)] max-md:min-h-12';

    $hoursCards = [
        ['icon' => 'shopping-bag', 'title' => 'Sales Support', 'text' => 'Sun–Thu<br>8:30 AM – 6:00 PM'],
        ['icon' => 'wrench', 'title' => 'Service Center Support', 'text' => 'Sun–Thu<br>8:30 AM – 6:00 PM'],
        ['icon' => 'phone', 'title' => 'Online Inquiry', 'text' => 'Send your inquiry anytime.<br>Our team will respond as soon<br>as possible.'],
    ];
@endphp

<div class="font-sans" data-contact-page>

    <x-litus-header active="Contact Us" />

    {{-- HERO --}}
    <section class="relative min-h-[680px] overflow-hidden border border-[rgba(31,80,130,0.4)] bg-[#061326] bg-cover bg-center pb-[82px] max-md:min-h-0 max-md:overflow-visible max-md:border-0 max-md:bg-[#07152f] max-md:pb-0 max-[1100px]:min-h-0 max-[1100px]:pb-8"
             style="background-image: linear-gradient(90deg, rgba(2,14,32,0.95) 0%, rgba(3,18,40,0.92) 34%, rgba(3,18,40,0.82) 56%, rgba(3,18,40,0.90) 100%), url('{{ $heroBg }}');">
        <div class="pointer-events-none absolute inset-0 z-[1] bg-[radial-gradient(circle_at_30%_45%,rgba(4,42,83,0.6),transparent_35%),radial-gradient(circle_at_75%_45%,rgba(4,33,67,0.55),transparent_38%),linear-gradient(to_bottom,rgba(0,0,0,0.15),rgba(2,10,25,0.96))] max-md:bg-[radial-gradient(ellipse_at_50%_0%,rgba(0,101,239,0.22),transparent_55%),linear-gradient(180deg,#0a1a38_0%,#07152f_55%,#061326_100%)]"></div>

        <img src="{{ $heroAgentsImg }}"
             alt="LITUS customer support team"
             class="pointer-events-none absolute z-[2] bottom-0 left-[max(1.25rem,calc((100vw-90rem)/2+1rem))] hidden h-auto max-h-[720px] w-auto max-w-[min(720px,43vw)] origin-bottom scale-[1.1] object-contain object-bottom min-[1100px]:block"
             width="560"
             height="400"
             decoding="async">

        <div class="relative z-[2] litus-container grid w-full grid-cols-1 gap-6 pb-10 pt-14 max-md:gap-0 max-md:px-0 max-md:pb-0 max-md:pt-3 sm:pt-16 min-[1100px]:grid-cols-[minmax(0,42%)_minmax(0,58%)] min-[1100px]:items-center min-[1100px]:gap-12 min-[1100px]:pb-14 min-[1100px]:pt-16">
            <div class="relative mx-auto w-full max-w-[300px] min-[1100px]:hidden">
                <div class="pointer-events-none absolute inset-x-4 bottom-2 h-16 rounded-full bg-[#0065ef]/28 blur-3xl"></div>
                <img src="{{ $heroAgentsImg }}"
                     alt="LITUS customer support team"
                     class="relative z-[1] mx-auto block h-auto w-full max-h-[230px] object-contain object-bottom"
                     width="560"
                     height="400"
                     decoding="async">
                <div class="pointer-events-none absolute inset-x-0 bottom-0 z-[2] h-12 bg-gradient-to-t from-[#07152f] to-transparent"></div>
            </div>

            <div class="hidden min-[1100px]:block min-[1100px]:min-h-[500px]" aria-hidden="true"></div>

            <div class="relative z-10 min-w-0 max-w-[760px] pl-0 text-center max-md:mx-auto max-md:w-full max-md:px-4 max-md:pb-3 max-md:pt-0 min-[1100px]:col-start-2 min-[1100px]:pl-4 min-[1100px]:text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] max-md:mb-1 max-md:text-[10px] max-md:tracking-[0.18em] sm:text-lg">
                    Customer Support
                </p>

                <h1 class="mb-4 font-montserrat text-[clamp(2.25rem,4.2vw,4.25rem)] font-bold leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:mb-2 max-md:text-[1.7rem] max-md:leading-[1.12]">
                    We're Here to Help<br>
                    You Ride Better
                </h1>

                <p class="mx-auto mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] max-md:mb-3 max-md:max-w-[30ch] max-md:text-[12px] max-md:leading-snug sm:text-lg sm:leading-[1.55] min-[1100px]:mx-0">
                    Questions about motorcycles, ownership plans, parts, or service? Our team is ready to help.
                </p>

                <div class="flex flex-col items-stretch justify-center gap-2.5 max-md:w-full max-md:flex-row max-md:gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7 min-[1100px]:justify-start">
                    <a href="#contact-form"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Contact Now
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                    <a href="https://maps.google.com/?q=Male+Maldives+Buruzu+Magu"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Get Directions
                        <x-litus-icon name="navigation" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- CONTACT CARDS --}}
    <section class="border border-[#d8d8d8] bg-white py-11 pb-14 max-md:border-0 max-md:bg-[#f7f8fa] max-md:py-8 max-md:pb-8">
        <div class="litus-container">
            <div class="mb-7 text-center max-md:mb-4">
                <span class="mb-2.5 block text-sm font-black uppercase text-[#0065ef] max-md:mb-1.5 max-md:text-[11px] max-md:tracking-[0.16em]">Get In Touch</span>
                <h2 class="mb-3 font-montserrat text-[28px] font-bold tracking-[-0.5px] text-[#07152f] max-md:mb-1.5 max-md:text-[22px] sm:text-[34px]">Contact LITUS Automobiles</h2>
                <p class="text-[15px] font-medium leading-normal text-[#4d5566] max-md:mx-auto max-md:max-w-[32ch] max-md:text-[13px] sm:text-base">
                    Reach our team through phone, email, or visit our office.
                </p>
            </div>

            {{-- Mobile: compact action list --}}
            <div class="overflow-hidden rounded-2xl border border-[#e6eaf0] bg-white shadow-[0_8px_24px_rgba(7,21,47,0.05)] md:hidden">
                @foreach ($contactCards as $index => $card)
                    <a href="{{ $card['href'] }}"
                       target="{{ str_starts_with($card['href'], 'http') ? '_blank' : '_self' }}"
                       @if(str_starts_with($card['href'], 'http')) rel="noopener noreferrer" @endif
                       @class([
                           'flex items-center gap-3.5 px-4 py-3.5 active:bg-[#f3f6fa]',
                           'border-t border-[#eef1f5]' => $index > 0,
                       ])>
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#0065ef]/10 text-[#0065ef]">
                            <x-litus-icon :name="$card['icon']" class="h-[18px] w-[18px]" />
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <p class="mb-0.5 text-[11px] font-bold uppercase tracking-[0.06em] text-[#7a8494]">{{ $card['title'] }}</p>
                            <p class="truncate text-[14px] font-extrabold leading-snug text-[#07152f]">
                                @if (!empty($card['value_html']))
                                    {!! str_replace('<br>', ' ', $card['value']) !!}
                                @else
                                    {{ $card['value'] }}
                                @endif
                            </p>
                        </div>
                        <x-litus-icon name="chevron-right" class="h-4 w-4 shrink-0 text-[#9aa3b2]" />
                    </a>
                @endforeach
            </div>

            {{-- Desktop / tablet: original cards --}}
            <div class="mx-auto hidden max-w-[650px] grid-cols-1 gap-3.5 md:grid lg:max-w-none lg:grid-cols-3 lg:gap-4">
                @foreach ($contactCards as $card)
                    <a href="{{ $card['href'] }}"
                       target="{{ str_starts_with($card['href'], 'http') ? '_blank' : '_self' }}"
                       @if(str_starts_with($card['href'], 'http')) rel="noopener noreferrer" @endif
                       class="group flex items-center gap-[22px] rounded-2xl border border-[#e8ecf2] bg-white p-6 shadow-[0_10px_28px_rgba(7,21,47,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_36px_rgba(7,21,47,0.1)] lg:min-h-[145px]">
                        <div class="flex h-[68px] w-[68px] shrink-0 items-center justify-center rounded-full bg-[#061530] text-[#0065ef] shadow-[0_8px_18px_rgba(6,21,48,0.2)]">
                            <x-litus-icon :name="$card['icon']" class="h-[30px] w-[30px]" />
                        </div>

                        <div class="min-w-0 flex-1 text-left">
                            <h3 class="mb-2.5 text-base font-extrabold text-[#07152f]">{{ $card['title'] }}</h3>
                            <p class="mb-6 text-lg font-black leading-[1.35] text-[#07152f] sm:text-[19px]">
                                @if (!empty($card['value_html']))
                                    {!! $card['value'] !!}
                                @else
                                    {{ $card['value'] }}
                                @endif
                            </p>
                            <span class="inline-flex items-center gap-2 text-sm font-black text-[#0065ef] transition-all duration-300 group-hover:gap-3">
                                {{ $card['action'] }}
                                <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FORM + MAP + SOCIAL + QUICK ASSISTANCE --}}
    <section class="bg-[#f8f8f8] py-6 pb-11 max-md:py-8 max-md:pb-10" id="contact-form">
        <div class="litus-container">

            <div class="mb-5 grid grid-cols-1 gap-4 lg:mb-[25px] lg:grid-cols-2 lg:items-stretch lg:gap-5">
                {{-- Message form --}}
                <div class="flex h-full flex-col overflow-hidden rounded-2xl bg-gradient-to-br from-[#06152d] to-[#010a18] p-5 text-white shadow-[0_12px_30px_rgba(0,0,0,0.08)] max-md:rounded-2xl sm:p-7 max-sm:p-5">
                    <h2 class="font-montserrat mb-2 text-[22px] font-bold max-md:text-xl sm:mb-2.5 sm:text-2xl">Send Us a Message</h2>
                    <p class="mb-5 text-sm text-[#b9c3d0] max-md:mb-4">Fill out the form and our team will contact you shortly.</p>

                    <div class="hidden flex-col items-center justify-center py-12 text-center" data-contact-success>
                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-[#0065ef]/15">
                            <x-litus-icon name="check-circle" class="h-8 w-8 text-[#0065ef]" />
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-white">Message Sent!</h3>
                        <p class="max-w-xs text-sm text-[#b9c3d0]">Our team will get back to you within 24 hours.</p>
                        <button type="button" data-contact-reset class="mt-5 min-h-11 text-sm font-bold text-[#0065ef] underline">Send another message</button>
                    </div>

                    <form data-contact-form action="#" method="post" class="flex flex-1 flex-col">
                        @csrf
                        <div class="mb-4 grid grid-cols-1 gap-4 sm:mb-[18px] sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-[13px] font-bold text-white">Full Name</label>
                                <input type="text" name="name" placeholder="Enter your name" class="{{ $darkInputCls }}" required>
                            </div>
                            <div>
                                <label class="mb-2 block text-[13px] font-bold text-white">Mobile Number</label>
                                <input type="tel" name="mobile" placeholder="Enter your mobile number" class="{{ $darkInputCls }}" required>
                            </div>
                        </div>

                        <div class="mb-4 sm:mb-[18px]">
                            <label class="mb-2 block text-[13px] font-bold text-white">Email Address</label>
                            <input type="email" name="email" placeholder="Enter your email address" class="{{ $darkInputCls }}" required>
                        </div>

                        <div class="mb-4 sm:mb-[18px]">
                            <label class="mb-2 block text-[13px] font-bold text-white">Inquiry Type</label>
                            <div class="relative">
                                <select name="inquiry_type" class="{{ $darkInputCls }} cursor-pointer appearance-none pr-10" required>
                                    <option value="" disabled selected>Select inquiry type</option>
                                    @foreach ($inquiryTypes as $type)
                                        <option value="{{ $type }}" class="bg-[#061326]">{{ $type }}</option>
                                    @endforeach
                                </select>
                                <x-litus-icon name="chevron-down" class="pointer-events-none absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-[#9ca8b7]" />
                            </div>
                        </div>

                        <div class="mb-5 sm:mb-[18px]">
                            <label class="mb-2 block text-[13px] font-bold text-white">Message</label>
                            <textarea name="message" placeholder="How can we help you?" class="{{ $darkInputCls }} h-[110px] resize-none sm:h-[95px]" required></textarea>
                        </div>

                        <button type="submit"
                                class="mt-auto flex h-12 w-full items-center justify-center gap-2.5 rounded-xl bg-[#0065ef] text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] sm:h-[52px] sm:rounded-md">
                            Send Message
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>
                    </form>
                </div>

                {{-- Map --}}
                <div class="flex h-full min-h-0 flex-col overflow-hidden rounded-2xl bg-white p-2 shadow-[0_12px_30px_rgba(0,0,0,0.08)] sm:rounded-[10px] sm:p-2.5">
                    <div class="min-h-[240px] flex-1 overflow-hidden rounded-xl bg-[#dde5ef] max-md:min-h-[220px] sm:min-h-[300px] sm:rounded-md">
                        <iframe title="LITUS Group Head Office"
                                src="{{ $mapsEmbedUrl }}"
                                class="block h-full min-h-[240px] w-full border-0 max-md:min-h-[220px] sm:min-h-[300px]"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="shrink-0 rounded-b-xl bg-gradient-to-br from-[#06152d] to-[#010a18] p-4 text-center sm:rounded-b-[7px] sm:p-[18px]">
                        <a href="{{ $mapsLinkUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex h-11 w-full min-w-0 items-center justify-center gap-2.5 rounded-xl border border-white/45 text-sm font-extrabold text-white transition-all duration-300 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)] sm:min-w-[220px] sm:w-auto sm:rounded-[5px]">
                            Open in Google Maps
                            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                </div>
            </div>

            {{-- Connect With Us --}}
            <div class="mb-4 flex flex-col items-center justify-between gap-5 overflow-hidden rounded-2xl bg-white px-5 py-6 shadow-[0_12px_30px_rgba(0,0,0,0.08)] max-lg:text-center sm:gap-6 sm:px-9 sm:py-7 lg:mb-6 lg:flex-row lg:rounded-[10px]">
                <div>
                    <h2 class="font-montserrat mb-1.5 text-xl font-bold text-[#07152f] sm:mb-2 sm:text-2xl">Connect With Us</h2>
                    <p class="text-sm text-[#4f5b6c] sm:text-[15px]">Follow or message us through our social channels.</p>
                </div>
                <div class="flex items-center justify-center gap-4 max-md:w-full max-md:justify-between max-md:px-2 sm:gap-[25px]">
                    @foreach ($socials as $social)
                        <a href="{{ $social['href'] }}"
                           @if(str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                           class="flex h-12 w-12 items-center justify-center rounded-full text-white transition-all duration-300 hover:-translate-y-1 max-md:h-14 max-md:w-14 sm:h-[55px] sm:w-[55px] {{ $social['bg'] }}"
                           aria-label="{{ $social['label'] }}">
                            <x-litus-icon :name="$social['icon']" class="h-6 w-6 max-md:h-6 max-md:w-6 sm:h-[25px] sm:w-[25px]" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Assistance --}}
            <div class="grid grid-cols-1 items-center gap-5 overflow-hidden rounded-2xl bg-cover bg-right px-5 py-7 text-white shadow-[0_12px_30px_rgba(0,0,0,0.08)] max-lg:text-center sm:gap-7 sm:rounded-[10px] sm:px-[38px] sm:py-8 lg:grid-cols-[auto_1fr_auto]"
                 style="background-image: linear-gradient(90deg, rgba(3,13,28,0.98), rgba(3,13,28,0.94)), url('{{ $quickAssistanceBg }}');">
                <div class="mx-auto flex h-[72px] w-[72px] min-w-[72px] items-center justify-center rounded-full border border-white/75 sm:h-[90px] sm:w-[90px] sm:min-w-[90px] lg:mx-0">
                    <x-litus-icon name="phone" class="h-8 w-8 text-white sm:h-10 sm:w-10" />
                </div>

                <div>
                    <h2 class="font-montserrat mb-2 text-xl font-bold sm:mb-2.5 sm:text-2xl">Need Quick Assistance?</h2>
                    <p class="mx-auto max-w-[580px] text-sm leading-relaxed text-[#d7dee9] max-md:max-w-[34ch] sm:text-[15px] lg:mx-0">
                        Our team can help with motorcycle availability, ownership plans, parts, and service bookings.
                    </p>
                </div>

                <div class="flex w-full flex-col gap-2.5 sm:flex-row sm:flex-wrap sm:justify-center sm:gap-[18px] lg:w-auto lg:justify-end">
                    <a href="tel:+9607797442"
                       class="inline-flex h-12 min-w-0 items-center justify-center gap-2.5 rounded-xl bg-[#0065ef] px-6 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] sm:h-[52px] sm:min-w-[165px] sm:rounded-[7px]">
                        Call Now
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="https://wa.me/9607797442"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-12 min-w-0 items-center justify-center gap-2.5 rounded-xl border border-white/55 bg-white/[0.03] px-6 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)] sm:h-[52px] sm:min-w-[165px] sm:rounded-[7px]">
                        WhatsApp Us
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- BUSINESS HOURS --}}
    <section class="border border-[#d9d9d9] bg-[#fafafa] py-11 pb-14 max-md:border-0 max-md:py-9 max-md:pb-10">
        <div class="litus-container">
            <h2 class="mb-7 text-center font-montserrat text-[24px] font-bold tracking-[-0.5px] text-[#07152f] max-md:mb-5 max-md:text-[22px] sm:text-[28px]">Business Hours</h2>

            <div class="mx-auto grid max-w-[650px] grid-cols-1 gap-3.5 max-md:gap-3 lg:max-w-none lg:grid-cols-3 lg:gap-4">
                @foreach ($hoursCards as $card)
                    <div class="group flex items-center gap-4 rounded-2xl border border-[#e8ecf2] bg-white p-4 shadow-[0_10px_28px_rgba(7,21,47,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_36px_rgba(7,21,47,0.1)] max-md:min-h-[92px] sm:gap-[22px] sm:p-6 lg:min-h-[145px]">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#061530] text-white shadow-[0_8px_18px_rgba(6,21,48,0.2)] sm:h-[68px] sm:w-[68px]">
                            <x-litus-icon :name="$card['icon']" class="h-5 w-5 sm:h-[30px] sm:w-[30px]" />
                        </div>
                        <div class="min-w-0 text-left">
                            <h3 class="mb-1 text-[13px] font-extrabold text-[#07152f] sm:mb-2 sm:text-sm">{{ $card['title'] }}</h3>
                            <p class="text-[12px] font-semibold leading-snug text-[#4e5a6a] sm:text-[14px] sm:leading-[1.4]">{!! $card['text'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
