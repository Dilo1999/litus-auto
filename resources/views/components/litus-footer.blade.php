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
        ['icon' => 'facebook', 'href' => '#', 'label' => 'Facebook'],
        ['icon' => 'instagram', 'href' => '#', 'label' => 'Instagram'],
        ['icon' => 'message-circle', 'href' => 'https://wa.me/9607797442', 'label' => 'WhatsApp'],
    ];
    $logo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
@endphp

<footer class="border-t border-white/[0.08] bg-litus-ink pt-12 text-sm text-white/70 sm:pt-[70px]">
    <div class="litus-container">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 sm:gap-[38px] lg:grid-cols-[1.7fr_1fr_1fr_1.5fr]">
            <div>
                <a href="{{ route('home') }}" class="mb-4 inline-flex">
                    <img src="{{ $logo }}"
                         alt="LITUS Automobiles"
                         class="h-14 w-auto">
                </a>
                <p class="max-w-[300px] leading-relaxed">
                    Premium motorcycles, genuine parts and reliable service across the Maldives. Serving riders since 2014 from five showrooms.
                </p>
                <div class="mt-[22px] flex gap-2.5">
                    @foreach ($socialLinks as $social)
                        <a href="{{ $social['href'] }}"
                           @if(str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                           class="grid h-10 w-10 place-items-center rounded-[9px] bg-white/[0.09] text-white transition-colors hover:bg-litus-primary sm:h-9 sm:w-9"
                           aria-label="{{ $social['label'] }}">
                            <x-litus-icon :name="$social['icon']" class="h-[15px] w-[15px]" />
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h5 class="mb-[18px] text-[11.5px] font-bold uppercase tracking-[0.16em] text-white">Explore</h5>
                <ul class="grid gap-3.5 sm:gap-[11px]">
                    @foreach ($exploreLinks as $label => $url)
                        <li>
                            <a href="{{ $url }}" class="transition-colors hover:text-white">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h5 class="mb-[18px] text-[11.5px] font-bold uppercase tracking-[0.16em] text-white">Support</h5>
                <ul class="grid gap-3.5 sm:gap-[11px]">
                    @foreach ($supportLinks as $label => $url)
                        <li>
                            <a href="{{ $url }}" class="transition-colors hover:text-white">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h5 class="mb-[18px] text-[11.5px] font-bold uppercase tracking-[0.16em] text-white">Get in touch</h5>
                <ul class="grid gap-3.5 sm:gap-[11px]">
                    <li>Ma. Elysium, Buruzu Magu, Malé, Maldives</li>
                    <li>
                        <a href="tel:+9607797442" class="transition-colors hover:text-white">+960 779 7442</a>
                    </li>
                    <li>
                        <a href="mailto:sales@litusgroup.mv" class="transition-colors hover:text-white">sales@litusgroup.mv</a>
                    </li>
                    <li>Sun - Thu · 9:30 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col justify-between gap-2 border-t border-white/10 py-5 text-[12.5px] text-white/45 sm:mt-[52px] sm:flex-row sm:flex-wrap sm:gap-3.5">
            <span>© {{ date('Y') }} LITUS Automobiles. All rights reserved. Developed by LITUS IT </span>
            <span>Ijara plans structured to Islamic leasing standards.</span>
        </div>
    </div>
</footer>
