@props(['active' => ''])

@php
    $navLinks = [
        'Home' => route('home'),
        'Motorcycles' => route('motorcycles'),
        'Promotions' => route('promotions'),
        'Ijara Plans' => route('ownership-plans'),
        'Service' => route('service-center'),
        'Parts' => route('parts'),
        'About' => route('about'),
        'Contact' => route('contact'),
    ];

    $logo = asset('images/logo/' . rawurlencode('Litus-Automobiles-white (1).png'));
@endphp

<header class="sticky top-0 z-[200] w-full border-b border-white/[0.09] bg-[rgba(5,11,24,0.94)] backdrop-blur-[16px]"
        data-litus-header>
    <div class="litus-container relative z-[60] flex h-[72px] items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="relative z-[1] flex shrink-0 items-center">
            <img src="{{ $logo }}"
                 alt="LITUS Automobiles"
                 class="h-12 w-auto sm:h-14">
        </a>

        <nav class="absolute left-1/2 top-1/2 hidden -translate-x-1/2 -translate-y-1/2 items-center gap-1 xl:flex 2xl:gap-2.5"
             aria-label="Main navigation">
            @foreach ($navLinks as $label => $url)
                <a href="{{ $url }}"
                   @class([
                       'block whitespace-nowrap rounded-[7px] px-3 py-2 text-[14.5px] font-medium transition-colors duration-150 2xl:px-4 2xl:py-2.5 2xl:text-base',
                       'bg-[rgba(46,116,238,0.24)] text-white' => $active === $label,
                       'text-white/75 hover:bg-white/[0.08] hover:text-white' => $active !== $label,
                   ])>
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <div class="relative z-[1] flex shrink-0 items-center gap-2.5">
            <a href="tel:+9607797442"
               class="hidden items-center gap-2 rounded-lg bg-litus-primary px-[19px] py-2.5 text-[13.5px] font-semibold text-white transition-colors hover:bg-litus-primary-hover sm:inline-flex">
                <x-litus-icon name="phone" class="h-3.5 w-3.5" />
                779 7442
            </a>
            <button type="button"
                    class="inline-flex h-[42px] w-[42px] items-center justify-center rounded-[9px] bg-white/10 text-lg text-white transition-colors hover:bg-white/15 xl:hidden"
                    data-litus-menu-toggle
                    aria-expanded="false"
                    aria-controls="litus-mobile-menu"
                    aria-label="Toggle navigation menu">
                <x-litus-icon name="menu" class="h-5 w-5" data-litus-menu-icon="open" />
                <x-litus-icon name="x" class="hidden h-5 w-5" data-litus-menu-icon="close" />
            </button>
        </div>
    </div>

    <div class="pointer-events-none fixed inset-0 z-[55] bg-black/50 opacity-0 transition-opacity duration-300 xl:hidden"
         data-litus-menu-backdrop
         aria-hidden="true"></div>

    <div id="litus-mobile-menu"
         class="absolute left-0 right-0 top-full z-[58] origin-top scale-y-95 border-t border-white/10 bg-litus-ink opacity-0 invisible transition-all duration-300 ease-out xl:hidden"
         data-litus-mobile-menu
         hidden>
        <div class="flex max-h-[min(78vh,640px)] flex-col">
            <div class="litus-container overflow-y-auto overscroll-contain py-3">
                <nav class="flex flex-col" aria-label="Mobile navigation">
                    @foreach ($navLinks as $label => $url)
                        <a href="{{ $url }}"
                           @class([
                               'block border-b border-white/10 py-4 font-display text-[19px] font-semibold transition-colors',
                               'text-litus-sky' => $active === $label,
                               'text-white/85 hover:text-white' => $active !== $label,
                           ])>
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="border-t border-white/10 bg-black/20 px-4 py-4">
                <div class="litus-container !px-0">
                    <a href="tel:+9607797442"
                       class="flex min-h-12 w-full items-center justify-center gap-2.5 rounded-lg bg-litus-primary px-4 text-[15px] font-semibold text-white transition-colors hover:bg-litus-primary-hover">
                        <x-litus-icon name="phone" class="h-4 w-4" />
                        Call 779 7442
                    </a>
                    <p class="mt-2.5 text-center text-[11px] font-semibold text-white/45">
                        Sun-Thu · 9:30 AM - 6:00 PM
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
