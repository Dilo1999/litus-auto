@extends('layouts.litus')

@section('title', 'Contact Us — LITUS Automobiles')

@section('content')
@php
    $heroBg = 'https://images.unsplash.com/photo-1605902711622-cfb43c4437d2?auto=format&fit=crop&w=1800&q=80';
    $heroAgentsImg = asset('images/contact us/' . rawurlencode('ChatGPT Image Jul 4, 2026, 11_35_33 AM.png'));

    $heroFeatures = [
        ['icon' => 'phone', 'title' => 'Fast Response', 'desc' => 'Quick answers when you need them.'],
        ['icon' => 'headphones', 'title' => 'Friendly Help Support', 'desc' => 'A team that listens and cares.'],
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
        ['icon' => 'facebook', 'href' => '#', 'bg' => 'bg-[#1877f2]'],
        ['icon' => 'instagram', 'href' => '#', 'bg' => 'bg-gradient-to-br from-[#833ab4] via-[#fd1d1d] to-[#fcb045]'],
        ['icon' => 'message-circle', 'href' => 'https://wa.me/9607797442', 'bg' => 'bg-[#25d366]'],
        ['icon' => 'mail', 'href' => 'mailto:sales@litusgroup.mv', 'bg' => 'bg-[#f44336]'],
    ];

    $quickAssistanceBg = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1200&q=80';
    $mapsEmbedUrl = 'https://www.google.com/maps?q=Ma.%20Elyzium%2C%20Buruzu%20Magu%2C%20Male%2C%20Maldives&output=embed';
    $mapsLinkUrl = 'https://www.google.com/maps/search/?api=1&query=Ma.%20Elyzium%2C%20Buruzu%20Magu%2C%20Male%2C%20Maldives';

    $darkInputCls = 'w-full rounded-[5px] border border-white/[0.22] bg-[#061326] px-3.5 py-[13px] text-sm text-white placeholder-[#9ca8b7] outline-none transition-all duration-300 focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)]';

    $hoursCards = [
        ['icon' => 'shopping-bag', 'title' => 'Sales Support', 'text' => 'Sun–Thu<br>8:30 AM – 6:00 PM'],
        ['icon' => 'wrench', 'title' => 'Service Center Support', 'text' => 'Sun–Thu<br>8:30 AM – 6:00 PM'],
        ['icon' => 'phone', 'title' => 'Online Inquiry', 'text' => 'Send your inquiry anytime.<br>Our team will respond as soon<br>as possible.'],
    ];
@endphp

<div class="font-sans" data-contact-page>

    <x-litus-header active="Contact Us" />

    {{-- HERO --}}
    <section class="relative min-h-[680px] overflow-hidden border border-[rgba(31,80,130,0.4)] bg-[#061326] bg-cover bg-center pb-[82px] max-[1100px]:min-h-0 max-[1100px]:pb-8"
             style="background-image: linear-gradient(90deg, rgba(2,14,32,0.95) 0%, rgba(3,18,40,0.92) 34%, rgba(3,18,40,0.82) 56%, rgba(3,18,40,0.90) 100%), url('{{ $heroBg }}');">
        <div class="pointer-events-none absolute inset-0 z-[1] bg-[radial-gradient(circle_at_30%_45%,rgba(4,42,83,0.6),transparent_35%),radial-gradient(circle_at_75%_45%,rgba(4,33,67,0.55),transparent_38%),linear-gradient(to_bottom,rgba(0,0,0,0.15),rgba(2,10,25,0.96))]"></div>

        {{-- Support agents — outside grid, free bottom alignment (desktop) --}}
        <img src="{{ $heroAgentsImg }}"
             alt="LITUS customer support team"
             class="pointer-events-none absolute z-[2] bottom-0 left-[max(1.25rem,calc((100vw-90rem)/2+1rem))] hidden h-auto max-h-[720px] w-auto max-w-[min(720px,43vw)] origin-bottom scale-[1.1] object-contain object-bottom min-[1100px]:block"
             width="560"
             height="400"
             decoding="async">

        <div class="relative z-[2] litus-container grid w-full grid-cols-1 gap-6 pt-14 pb-10 sm:pt-16 min-[1100px]:grid-cols-[minmax(0,42%)_minmax(0,58%)] min-[1100px]:items-center min-[1100px]:gap-12 min-[1100px]:pb-14 min-[1100px]:pt-16">
            {{-- Mobile image only — no clipping wrapper --}}
            <img src="{{ $heroAgentsImg }}"
                 alt=""
                 aria-hidden="true"
                 class="mx-auto h-auto max-h-[340px] w-full max-w-[520px] origin-bottom scale-105 object-contain object-bottom min-[1100px]:hidden"
                 width="560"
                 height="400"
                 decoding="async">

            {{-- Desktop spacer keeps text column aligned --}}
            <div class="hidden min-[1100px]:block min-[1100px]:min-h-[500px]" aria-hidden="true"></div>

            {{-- Hero content --}}
            <div class="relative z-10 min-w-0 max-w-[760px] pl-0 text-center min-[1100px]:col-start-2 min-[1100px]:pl-4 min-[1100px]:text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] sm:text-lg max-md:text-[15px]">
                    Customer Support
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:text-[2.25rem]">
                    We're Here to Help<br>
                    You Ride Better
                </h1>

                <p class="mx-auto mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55] min-[1100px]:mx-0 max-md:text-[17px]">
                    If you have questions about motorcycles, ownership plans, services, spare parts, or general inquiries, our friendly customer service team is ready to help.
                </p>

                <div class="flex flex-row flex-wrap items-center justify-center gap-5 sm:gap-7 min-[1100px]:justify-start">
                    <a href="#contact-form"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Contact Now
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                    <a href="https://maps.google.com/?q=Male+Maldives+Buruzu+Magu"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Get Directions
                        <x-litus-icon name="navigation" class="h-4 w-4 sm:h-5 sm:w-5" />
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

    {{-- CONTACT CARDS --}}
    <section class="min-h-[360px] border border-[#d8d8d8] bg-white py-11 pb-14">
        <div class="litus-container">
            <div class="mb-7 text-center">
                <span class="mb-2.5 block text-sm font-black uppercase text-[#0065ef]">Get In Touch</span>
                <h2 class="mb-3 font-display text-[28px] font-black tracking-[-0.5px] text-[#07152f] sm:text-[34px]">Contact LITUS Automobiles</h2>
                <p class="text-[15px] font-medium leading-normal text-[#4d5566] sm:text-base">
                    Reach our team through phone, email, social media, or visit our office.
                </p>
            </div>

            <div class="litus-container grid grid-cols-1 gap-4 max-lg:max-w-[650px] lg:grid-cols-3">
                @foreach ($contactCards as $card)
                    <div class="group flex min-h-[145px] items-start gap-[22px] rounded-[10px] border border-black/[0.03] bg-white p-6 shadow-[0_15px_35px_rgba(0,0,0,0.07)] transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_20px_45px_rgba(0,0,0,0.1)] max-sm:flex-col max-sm:p-6">
                        <div class="flex h-[68px] w-[68px] min-w-[68px] items-center justify-center rounded-full bg-[#061530] text-[#0065ef] shadow-[0_8px_18px_rgba(6,21,48,0.25)]">
                            <x-litus-icon :name="$card['icon']" class="h-[30px] w-[30px]" />
                        </div>

                        <div class="min-w-0 text-left">
                            <h3 class="mb-2.5 text-base font-extrabold text-[#07152f]">{{ $card['title'] }}</h3>
                            <p class="mb-6 text-lg font-black leading-[1.35] text-[#07152f] max-sm:text-[18px] sm:text-[19px]">
                                @if (!empty($card['value_html']))
                                    {!! $card['value'] !!}
                                @else
                                    {{ $card['value'] }}
                                @endif
                            </p>
                            <a href="{{ $card['href'] }}"
                               target="{{ str_starts_with($card['href'], 'http') ? '_blank' : '_self' }}"
                               @if(str_starts_with($card['href'], 'http')) rel="noopener noreferrer" @endif
                               class="inline-flex items-center gap-2 text-sm font-black text-[#0065ef] transition-all duration-300 hover:gap-3 hover:text-[#0052cc]">
                                {{ $card['action'] }}
                                <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FORM + MAP + SOCIAL + QUICK ASSISTANCE --}}
    <section class="bg-[#f8f8f8] py-6 pb-11 max-sm:pb-9" id="contact-form">
        <div class="litus-container">

            <div class="mb-6 grid grid-cols-1 gap-5 max-lg:grid-cols-1 lg:mb-[25px] lg:grid-cols-[1fr_1.05fr] lg:gap-5">
                {{-- Message form --}}
                <div class="overflow-hidden rounded-[10px] bg-gradient-to-br from-[#06152d] to-[#010a18] p-7 text-white shadow-[0_12px_30px_rgba(0,0,0,0.08)] max-sm:p-[22px]">
                    <h2 class="mb-2.5 text-2xl font-black">Send Us a Message</h2>
                    <p class="mb-6 text-sm text-[#b9c3d0]">Fill out the form and our team will contact you shortly.</p>

                    <div class="hidden flex-col items-center justify-center py-12 text-center" data-contact-success>
                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-[#0065ef]/15">
                            <x-litus-icon name="check-circle" class="h-8 w-8 text-[#0065ef]" />
                        </div>
                        <h3 class="mb-2 text-xl font-black text-white">Message Sent!</h3>
                        <p class="max-w-xs text-sm text-[#b9c3d0]">Our team will get back to you within 24 hours.</p>
                        <button type="button" data-contact-reset class="mt-5 text-sm font-bold text-[#0065ef] underline">Send another message</button>
                    </div>

                    <form data-contact-form action="#" method="post">
                        @csrf
                        <div class="mb-[18px] grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-4 max-sm:gap-0">
                            <div class="mb-[18px] sm:mb-0">
                                <label class="mb-2 block text-[13px] font-bold text-white">Full Name</label>
                                <input type="text" name="name" placeholder="Enter your name" class="{{ $darkInputCls }}" required>
                            </div>
                            <div class="mb-[18px] sm:mb-0">
                                <label class="mb-2 block text-[13px] font-bold text-white">Mobile Number</label>
                                <input type="tel" name="mobile" placeholder="Enter your mobile number" class="{{ $darkInputCls }}" required>
                            </div>
                        </div>

                        <div class="mb-[18px]">
                            <label class="mb-2 block text-[13px] font-bold text-white">Email Address</label>
                            <input type="email" name="email" placeholder="Enter your email address" class="{{ $darkInputCls }}" required>
                        </div>

                        <div class="mb-[18px]">
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

                        <div class="mb-[18px]">
                            <label class="mb-2 block text-[13px] font-bold text-white">Message</label>
                            <textarea name="message" placeholder="How can we help you?" class="{{ $darkInputCls }} h-[95px] resize-none" required></textarea>
                        </div>

                        <button type="submit"
                                class="flex h-[52px] w-full items-center justify-center gap-2.5 rounded-md bg-[#0065ef] text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc]">
                            Send Message
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>
                    </form>
                </div>

                {{-- Map --}}
                <div class="overflow-hidden rounded-[10px] bg-white p-2.5 shadow-[0_12px_30px_rgba(0,0,0,0.08)]">
                    <div class="h-[300px] overflow-hidden rounded-md bg-[#dde5ef] max-sm:h-[300px] lg:h-[390px]">
                        <iframe title="LITUS Group Head Office"
                                src="{{ $mapsEmbedUrl }}"
                                class="block h-full w-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="rounded-b-[7px] bg-gradient-to-br from-[#06152d] to-[#010a18] p-[18px] text-center">
                        <a href="{{ $mapsLinkUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex h-11 min-w-[220px] items-center justify-center gap-2.5 rounded-[5px] border border-white/45 text-sm font-extrabold text-white transition-all duration-300 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)]">
                            Open in Google Maps
                            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                </div>
            </div>

            {{-- Connect With Us --}}
            <div class="mb-6 flex flex-col items-center justify-between gap-6 overflow-hidden rounded-[10px] bg-white px-7 py-7 shadow-[0_12px_30px_rgba(0,0,0,0.08)] max-lg:text-center sm:px-9 max-lg:gap-[25px] lg:mb-6 lg:flex-row">
                <div>
                    <h2 class="mb-2 text-2xl font-black text-[#07152f]">Connect With Us</h2>
                    <p class="text-[15px] text-[#4f5b6c]">Follow or message us through our social channels.</p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3.5 sm:gap-[25px]">
                    @foreach ($socials as $social)
                        <a href="{{ $social['href'] }}"
                           @if(str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                           class="flex h-12 w-12 items-center justify-center rounded-full text-white transition-all duration-300 hover:-translate-y-[5px] sm:h-[55px] sm:w-[55px] {{ $social['bg'] }}"
                           aria-label="{{ $social['icon'] }}">
                            <x-litus-icon :name="$social['icon']" class="h-6 w-6 sm:h-[25px] sm:w-[25px]" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Assistance --}}
            <div class="grid grid-cols-1 items-center gap-7 overflow-hidden rounded-[10px] bg-cover bg-right px-7 py-8 text-white shadow-[0_12px_30px_rgba(0,0,0,0.08)] max-lg:text-center sm:px-[38px] lg:grid-cols-[auto_1fr_auto] lg:gap-7"
                 style="background-image: linear-gradient(90deg, rgba(3,13,28,0.98), rgba(3,13,28,0.94)), url('{{ $quickAssistanceBg }}');">
                <div class="mx-auto flex h-[90px] w-[90px] min-w-[90px] items-center justify-center rounded-full border border-white/75 lg:mx-0">
                    <x-litus-icon name="phone" class="h-10 w-10 text-white" />
                </div>

                <div>
                    <h2 class="mb-2.5 text-2xl font-black">Need Quick Assistance?</h2>
                    <p class="max-w-[580px] text-[15px] leading-relaxed text-[#d7dee9] max-lg:mx-auto">
                        Our team is ready to help you with motorcycle availability, ownership plans, parts inquiries, and service bookings.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-[18px] max-sm:w-full lg:justify-end">
                    <a href="tel:+9607797442"
                       class="inline-flex h-[52px] min-w-[165px] items-center justify-center gap-2.5 rounded-[7px] bg-[#0065ef] px-6 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-sm:w-full">
                        Call Now
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="https://wa.me/9607797442"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-[52px] min-w-[165px] items-center justify-center gap-2.5 rounded-[7px] border border-white/55 bg-white/[0.03] px-6 text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.12)] max-sm:w-full">
                        WhatsApp Us
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- BUSINESS HOURS --}}
    <section class="border border-[#d9d9d9] bg-[#fafafa] py-11 pb-14">
        <div class="litus-container">
            <h2 class="mb-7 text-center font-display text-[28px] font-black tracking-[-0.5px] text-[#07152f] sm:text-[34px]">Business Hours</h2>

            <div class="litus-container grid grid-cols-1 gap-4 max-lg:max-w-[650px] lg:grid-cols-3">
                @foreach ($hoursCards as $card)
                    <div class="group flex min-h-[145px] items-center gap-[22px] rounded-[10px] border border-black/[0.03] bg-white p-6 shadow-[0_15px_35px_rgba(0,0,0,0.07)] transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_20px_45px_rgba(0,0,0,0.1)] max-[420px]:flex-col max-[420px]:text-center max-sm:flex-col">
                        <div class="flex h-[68px] w-[68px] min-w-[68px] items-center justify-center rounded-full bg-[#061530] text-white shadow-[0_8px_18px_rgba(6,21,48,0.25)]">
                            <x-litus-icon :name="$card['icon']" class="h-[30px] w-[30px]" />
                        </div>
                        <div class="text-left max-[420px]:text-center">
                            <h3 class="mb-2.5 text-base font-extrabold text-[#07152f]">{{ $card['title'] }}</h3>
                            <p class="text-lg font-semibold leading-[1.35] text-[#4e5a6a] max-sm:text-[18px] sm:text-[19px]">{!! $card['text'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
