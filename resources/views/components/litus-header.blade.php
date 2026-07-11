@props(['active' => ''])

@php
    $navLinks = [
        'Home' => route('home'),
        'About Us' => route('about'),
        'Motorcycles' => route('motorcycles'),
        'Ownership Plans' => route('ownership-plans'),
        'Parts' => route('parts'),
        'Service Center' => route('service-center'),
        'Contact Us' => route('contact'),
        'Gallery' => route('gallery'),
    ];

    $logo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
@endphp

<header class="sticky top-0 z-50 w-full bg-litus-header" data-litus-header>
    <div class="relative z-[60] litus-container flex h-16 items-center justify-between lg:h-[68px]">
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
                    class="inline-flex min-h-11 min-w-11 items-center justify-center rounded-full text-white transition-colors hover:bg-white/10 lg:hidden"
                    data-litus-menu-toggle
                    aria-expanded="false"
                    aria-controls="litus-mobile-menu"
                    aria-label="Toggle navigation menu">
                <x-litus-icon name="menu" class="h-[22px] w-[22px]" data-litus-menu-icon="open" />
                <x-litus-icon name="x" class="hidden h-[22px] w-[22px]" data-litus-menu-icon="close" />
            </button>
        </div>
    </div>

    {{-- Mobile menu backdrop --}}
    <div class="pointer-events-none fixed inset-0 z-[55] bg-black/50 opacity-0 transition-opacity duration-300 lg:hidden"
         data-litus-menu-backdrop
         aria-hidden="true"></div>

    {{-- Mobile menu panel --}}
    <div id="litus-mobile-menu"
         class="absolute left-0 right-0 top-full z-[58] origin-top scale-y-95 border-t border-white/10 bg-[#03045e] opacity-0 invisible transition-all duration-300 ease-out lg:hidden"
         data-litus-mobile-menu
         hidden>
        <div class="flex max-h-[min(78vh,640px)] flex-col">
            <div class="litus-container overflow-y-auto overscroll-contain py-3">
                <p class="mb-2 px-1 text-[11px] font-black uppercase tracking-[0.18em] text-[#0065ef]">Menu</p>

                <nav class="flex flex-col gap-1" aria-label="Mobile navigation">
                    @foreach ($navLinks as $label => $url)
                        <a href="{{ $url }}"
                           @class([
                               'group flex min-h-12 items-center justify-between gap-3 rounded-xl px-3.5 py-3 text-[15px] font-bold transition-all duration-200',
                               'bg-[#0065ef]/15 text-white ring-1 ring-[#0065ef]/35' => $active === $label,
                               'text-gray-200 hover:bg-white/5 hover:text-white' => $active !== $label,
                           ])>
                            <span class="flex items-center gap-3">
                                @if ($active === $label)
                                    <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#0065ef]" aria-hidden="true"></span>
                                @else
                                    <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-white/20 transition-colors group-hover:bg-[#0065ef]" aria-hidden="true"></span>
                                @endif
                                {{ $label }}
                            </span>
                            <x-litus-icon name="chevron-right" class="h-4 w-4 shrink-0 text-white/35 transition-all duration-200 group-hover:translate-x-0.5 group-hover:text-[#0065ef]" />
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="border-t border-white/10 bg-[#02033f] px-4 py-4">
                <div class="litus-container !px-0">
                    <a href="tel:+9603331234"
                       class="flex min-h-12 w-full items-center justify-center gap-2.5 rounded-xl bg-[#0065ef] px-4 text-[15px] font-black text-white shadow-[0_10px_24px_rgba(0,101,239,0.35)] transition-all duration-200 active:scale-[0.98]">
                        <x-litus-icon name="phone" class="h-4 w-4" />
                        Call Now
                    </a>
                    <p class="mt-2.5 text-center text-[11px] font-semibold text-white/45">
                        Sun–Thu, 8:30 AM – 6:00 PM
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
