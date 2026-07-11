@php
    $quickLinks = [
        'Home' => route('home'),
        'About Us' => route('about'),
        'Motorcycles' => route('motorcycles'),
        'Ownership Plans' => route('ownership-plans'),
        'Gallery' => route('gallery'),
        'Contact Us' => route('contact'),
    ];
    $serviceLinks = [
        'Parts' => route('parts'),
        'Service Center' => route('service-center'),
        'Genuine Parts' => route('parts'),
    ];
    $mobileLinks = [
        'Home' => route('home'),
        'Motorcycles' => route('motorcycles'),
        'Parts' => route('parts'),
        'Service' => route('service-center'),
        'Plans' => route('ownership-plans'),
        'Contact' => route('contact'),
    ];
    $socialLinks = [
        ['icon' => 'facebook', 'href' => '#', 'label' => 'Facebook'],
        ['icon' => 'instagram', 'href' => '#', 'label' => 'Instagram'],
        ['icon' => 'message-circle', 'href' => 'https://wa.me/9607797442', 'label' => 'WhatsApp'],
    ];
    $logo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
@endphp

<footer class="bg-litus-footer">

    {{-- Mobile footer --}}
    <div class="litus-container py-6 md:hidden">
        <div class="flex flex-col items-center text-center">
            <a href="{{ route('home') }}" class="mb-3 inline-flex">
                <img src="{{ $logo }}"
                     alt="LITUS Automobiles"
                     class="h-8 w-auto">
            </a>

            <div class="mb-4 flex items-center gap-2">
                @foreach ($socialLinks as $social)
                    <a href="{{ $social['href'] }}"
                       @if(str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                       class="flex h-9 w-9 items-center justify-center rounded-full bg-white/5 text-gray-300 transition-colors hover:bg-white/10 hover:text-white"
                       aria-label="{{ $social['label'] }}">
                        <x-litus-icon :name="$social['icon']" class="h-3.5 w-3.5" />
                    </a>
                @endforeach
            </div>

            <div class="mb-4 grid w-full grid-cols-3 gap-2">
                <a href="tel:+9607797442"
                   class="flex flex-col items-center justify-center gap-1.5 rounded-xl bg-white/[0.04] px-2 py-3 text-center transition-colors active:bg-white/[0.08]">
                    <x-litus-icon name="phone" class="h-4 w-4 text-[#0065ef]" />
                    <span class="text-[11px] font-bold text-white">Call</span>
                </a>
                <a href="https://wa.me/9607797442"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex flex-col items-center justify-center gap-1.5 rounded-xl bg-white/[0.04] px-2 py-3 text-center transition-colors active:bg-white/[0.08]">
                    <x-litus-icon name="message-circle" class="h-4 w-4 text-[#25d366]" />
                    <span class="text-[11px] font-bold text-white">WhatsApp</span>
                </a>
                <a href="mailto:sales@litusgroup.mv"
                   class="flex flex-col items-center justify-center gap-1.5 rounded-xl bg-white/[0.04] px-2 py-3 text-center transition-colors active:bg-white/[0.08]">
                    <x-litus-icon name="mail" class="h-4 w-4 text-[#0065ef]" />
                    <span class="text-[11px] font-bold text-white">Email</span>
                </a>
            </div>

            <nav class="mb-4 flex flex-wrap items-center justify-center gap-x-3 gap-y-2" aria-label="Footer">
                @foreach ($mobileLinks as $label => $url)
                    <a href="{{ $url }}" class="text-[12px] font-semibold text-gray-400 transition-colors hover:text-white">
                        {{ $label }}
                    </a>
                    @if (! $loop->last)
                        <span class="text-white/15" aria-hidden="true">·</span>
                    @endif
                @endforeach
            </nav>

            <p class="text-[11px] text-gray-500">
                © {{ date('Y') }} LITUS Automobiles
            </p>
        </div>
    </div>

    {{-- Desktop / tablet footer --}}
    <div class="litus-container hidden py-10 md:block lg:py-12">
        <div class="mb-8 flex items-start justify-between gap-8">
            <div class="max-w-sm">
                <a href="{{ route('home') }}" class="mb-3 inline-flex">
                    <img src="{{ $logo }}"
                         alt="LITUS Automobiles"
                         class="h-9 w-auto">
                </a>
                <p class="mb-4 text-sm leading-relaxed text-gray-400">
                    Premium motorcycles, genuine parts, and reliable service across the Maldives.
                </p>
                <div class="flex items-center gap-2">
                    @foreach ($socialLinks as $social)
                        <a href="{{ $social['href'] }}"
                           @if(str_starts_with($social['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif
                           class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 text-gray-400 transition-colors hover:border-white/30 hover:text-white"
                           aria-label="{{ $social['label'] }}">
                            <x-litus-icon :name="$social['icon']" class="h-3.5 w-3.5" />
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid flex-1 grid-cols-3 gap-8">
                <div>
                    <h4 class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-white">Quick Links</h4>
                    <ul class="space-y-1.5">
                        @foreach ($quickLinks as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="text-sm text-gray-400 transition-colors hover:text-white">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-white">Services</h4>
                    <ul class="space-y-1.5">
                        @foreach ($serviceLinks as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="text-sm text-gray-400 transition-colors hover:text-white">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-white">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <x-litus-icon name="map-pin" class="h-3.5 w-3.5 shrink-0 text-[#0065ef]" />
                            Malé, Maldives
                        </li>
                        <li>
                            <a href="tel:+9607797442" class="flex items-center gap-2 transition-colors hover:text-white">
                                <x-litus-icon name="phone" class="h-3.5 w-3.5 shrink-0 text-[#0065ef]" />
                                +960 779 7442
                            </a>
                        </li>
                        <li>
                            <a href="mailto:sales@litusgroup.mv" class="flex items-center gap-2 transition-colors hover:text-white">
                                <x-litus-icon name="mail" class="h-3.5 w-3.5 shrink-0 text-[#0065ef]" />
                                sales@litusgroup.mv
                            </a>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-litus-icon name="clock" class="h-3.5 w-3.5 shrink-0 text-[#0065ef]" />
                            Sun–Thu, 8:30 AM – 6:00 PM
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden border-t border-white/10 py-4 md:block">
        <p class="text-center text-xs text-gray-500 sm:text-sm">
            © {{ date('Y') }} LITUS Automobiles. All rights reserved.
        </p>
    </div>
</footer>
