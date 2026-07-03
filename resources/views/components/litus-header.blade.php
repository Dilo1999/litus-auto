@props(['active' => ''])

@php
    $navLinks = [
        'Home' => route('home'),
        'About Us' => route('about'),
        'Motorcycles' => route('motorcycles'),
        'Ownership Plans' => '#',
        'Parts' => route('parts'),
        'Service Center' => '#',
        'Contact Us' => '#',
        'Gallery' => '#',
    ];
@endphp

<header class="sticky top-0 z-50 w-full bg-litus-navy">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:h-[68px]">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="flex h-8 w-8 items-center justify-center rounded-sm bg-litus-red">
                <span class="text-sm font-black text-white">L</span>
            </div>
            <div>
                <span class="block text-lg font-black leading-none tracking-wide text-white">LITUS</span>
                <span class="block text-xs uppercase leading-none tracking-widest text-gray-400">Automobiles</span>
            </div>
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
