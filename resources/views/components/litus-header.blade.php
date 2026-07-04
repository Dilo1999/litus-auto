@props(['active' => ''])

@php
    $navLinks = [
        'Home' => route('home'),
        'About Us' => route('about'),
        'Motorcycles' => route('motorcycles'),
        'Ownership Plans' => '#',
        'Parts' => route('parts'),
        'Service Center' => '#',
        'Contact Us' => route('contact'),
        'Gallery' => '#',
    ];

    $logo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
@endphp

<header class="sticky top-0 z-50 w-full bg-litus-navy">
    <div class="litus-container flex h-16 items-center justify-between lg:h-[68px]">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center">
            <img src="{{ $logo }}"
                 alt="LITUS Automobiles"
                 class="h-9 w-auto sm:h-10">
        </a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Main navigation">
            @foreach ($navLinks as $label => $url)
                <a href="{{ $url }}"
                   class="rounded px-3 py-1.5 text-sm font-medium transition-colors {{ $active === $label ? 'text-litus-red' : 'text-gray-300 hover:text-white' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            <a href="tel:+9603331234"
               class="hidden items-center gap-1.5 rounded-full bg-litus-red px-4 py-2 text-sm font-bold text-white transition-opacity hover:opacity-90 sm:flex">
                <x-litus-icon name="phone" class="h-3.5 w-3.5" />
                Call Now
            </a>
            <button type="button"
                    class="text-white lg:hidden"
                    data-litus-menu-toggle
                    aria-expanded="false"
                    aria-controls="litus-mobile-menu"
                    aria-label="Toggle navigation menu">
                <x-litus-icon name="menu" class="h-[22px] w-[22px]" data-litus-menu-icon="open" />
                <x-litus-icon name="x" class="hidden h-[22px] w-[22px]" data-litus-menu-icon="close" />
            </button>
        </div>
    </div>

    <div id="litus-mobile-menu" class="hidden border-t border-white/10 px-4 pb-4 pt-2 lg:hidden" data-litus-mobile-menu>
        @foreach ($navLinks as $label => $url)
            <a href="{{ $url }}" class="block py-2 text-sm font-medium text-gray-200 hover:text-white">{{ $label }}</a>
        @endforeach
        <a href="tel:+9603331234"
           class="mt-3 flex w-fit items-center gap-2 rounded-full bg-litus-red px-4 py-2 text-sm font-bold text-white">
            <x-litus-icon name="phone" class="h-3.5 w-3.5" />
            Call Now
        </a>
    </div>
</header>
