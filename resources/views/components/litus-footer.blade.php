@php
    $exploreLinks = [
        'Motorcycles' => route('motorcycles'),
        'Promotions' => route('promotions'),
        'Ijara Plans' => route('ownership-plans'),
        'About Us' => route('about'),
        'Gallery' => route('gallery'),
    ];
    $supportLinks = [
        'Service Center' => route('service-center'),
        'Genuine Parts' => route('parts'),
        'Book Appointment' => route('service-center'),
        'Contact Us' => route('contact'),
        'Find a Showroom' => route('about') . '#locations',
    ];
    $socialLinks = [
        ['icon' => 'facebook', 'href' => 'https://www.facebook.com/share/1PVsXTRpay/?mibextid=wwXIfr', 'label' => 'Facebook'],
        ['icon' => 'instagram', 'href' => 'https://www.instagram.com/litusautomobiles?igsi=eXE4OWhyaDl1amJ2', 'label' => 'Instagram'],
        ['icon' => 'tiktok', 'href' => 'https://www.tiktok.com/@litus.automobiles?_r=1&_t=ZS-99PnVP3nKzq', 'label' => 'TikTok'],
        ['icon' => 'message-circle', 'href' => 'https://wa.me/9607797442', 'label' => 'WhatsApp'],
    ];
    $logo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
@endphp

<footer class="border-t border-white/[0.08] bg-litus-ink text-sm text-white/70">
    <div class="litus-container pt-8 pb-5 sm:pt-12 lg:pt-[70px]">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.7fr_1fr_1fr_1.5fr] lg:gap-[38px]">
            {{-- Brand --}}
            <div class="max-lg:text-center">
                <a href="{{ route('home') }}" class="mb-3 inline-flex max-lg:mx-auto lg:mb-4">
                    <img src="{{ $logo }}"
                         alt="LITUS Automobiles"
                         class="h-12 w-auto sm:h-14">
                </a>
                <p class="mx-auto max-w-[320px] text-[13px] leading-relaxed text-white/65 sm:text-sm lg:mx-0 lg:max-w-[300px]">
                    Premium motorcycles, genuine parts and reliable service across the Maldives. Serving riders since 2014.
                </p>
                <div class="mt-4 flex justify-center gap-2 lg:mt-[22px] lg:justify-start">
                    @foreach ($socialLinks as $social)
                        <a href="{{ $social['href'] }}"
                           @if(str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                           class="grid h-10 w-10 place-items-center rounded-xl bg-white/[0.09] text-white transition-colors hover:bg-litus-primary"
                           aria-label="{{ $social['label'] }}">
                            <x-litus-icon :name="$social['icon']" class="h-[15px] w-[15px]" />
                        </a>
                    @endforeach
                </div>

                {{-- Mobile quick actions --}}
                <div class="mt-5 grid grid-cols-2 gap-2 lg:hidden">
                    <a href="tel:+9607797442"
                       class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl border border-white/20 bg-white/[0.06] px-3 text-[13px] font-semibold text-white transition hover:bg-white/10">
                        <x-litus-icon name="phone" class="h-4 w-4 shrink-0" />
                        779 7442
                    </a>
                    <a href="https://wa.me/9607797442"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#1FA855] px-3 text-[13px] font-semibold text-white transition hover:bg-[#178443]">
                        <x-litus-icon name="message-circle" class="h-4 w-4 shrink-0" />
                        WhatsApp
                    </a>
                </div>
            </div>

            {{-- Explore + Support — 2 columns on mobile, grid columns on desktop --}}
            <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:contents">
                <div>
                    <h5 class="mb-3 text-[10.5px] font-bold uppercase tracking-[0.16em] text-white sm:mb-[18px] sm:text-[11.5px]">Explore</h5>
                    <ul class="grid gap-2.5 sm:gap-[11px]">
                        @foreach ($exploreLinks as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="text-[13px] transition-colors hover:text-white sm:text-sm">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h5 class="mb-3 text-[10.5px] font-bold uppercase tracking-[0.16em] text-white sm:mb-[18px] sm:text-[11.5px]">Support</h5>
                    <ul class="grid gap-2.5 sm:gap-[11px]">
                        @foreach ($supportLinks as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="text-[13px] transition-colors hover:text-white sm:text-sm">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Contact --}}
            <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-4 sm:p-5 lg:rounded-none lg:border-0 lg:bg-transparent lg:p-0">
                <h5 class="mb-3 text-[10.5px] font-bold uppercase tracking-[0.16em] text-white sm:mb-[18px] sm:text-[11.5px]">Get in touch</h5>
                <ul class="grid gap-3 sm:gap-[11px]">
                    <li class="flex items-start gap-3 text-[13px] sm:text-sm">
                        <span class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/[0.08] text-white/80 lg:hidden">
                            <x-litus-icon name="map-pin" class="h-3.5 w-3.5" />
                        </span>
                        <span class="leading-relaxed">Ma. Elysium, Buruzu Magu, Malé, Maldives</span>
                    </li>
                    <li class="flex items-center gap-3 text-[13px] sm:text-sm">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/[0.08] text-white/80 lg:hidden">
                            <x-litus-icon name="phone" class="h-3.5 w-3.5" />
                        </span>
                        <a href="tel:+9607797442" class="font-medium text-white/85 transition-colors hover:text-white">+960 779 7442</a>
                    </li>
                    <li class="flex items-center gap-3 text-[13px] sm:text-sm">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/[0.08] text-white/80 lg:hidden">
                            <x-litus-icon name="mail" class="h-3.5 w-3.5" />
                        </span>
                        <a href="mailto:sales@litusgroup.mv" class="transition-colors hover:text-white">sales@litusgroup.mv</a>
                    </li>
                    <li class="flex items-center gap-3 text-[13px] sm:text-sm">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/[0.08] text-white/80 lg:hidden">
                            <x-litus-icon name="clock" class="h-3.5 w-3.5" />
                        </span>
                        <span>Sun - Thu · 9:30 AM - 6:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 flex flex-col items-center gap-2 border-t border-white/10 pt-5 text-center text-[11.5px] leading-relaxed text-white/45 sm:mt-10 sm:text-[12.5px] lg:mt-[52px] lg:flex-row lg:justify-between lg:text-left">
            <span>© {{ date('Y') }} LITUS Automobiles. All rights reserved. Developed by LITUS IT</span>
            <span class="max-lg:hidden">Ijara plans structured to Islamic leasing standards.</span>
        </div>
    </div>
</footer>
