@props([
    'model',
    'slug',
    'cc',
    'capacity',
    'img',
    'brand' => null,
    'price' => null,
    'salePrice' => null,
    'discount' => null,
    'hasPromotion' => false,
    'monthly' => null,
    'variant' => 'blue',
    'badge' => null,
    'exploreHref' => null,
    'exploreLabel' => 'View Details',
])

@php
    $exploreHref = $exploreHref ?? route('motorcycle.show', $slug);
    $showSale = $hasPromotion && $salePrice;
@endphp

<article class="group flex h-full flex-col overflow-hidden rounded-[18px] border border-litus-line bg-white transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
    <a href="{{ route('motorcycle.show', $slug) }}"
       class="relative aspect-[16/11] overflow-hidden bg-gradient-to-br from-[#DFE9F7] to-[#B9CFEC]">
        <img src="{{ $img }}"
             alt="{{ $model }}"
             class="relative z-[3] mx-auto h-[108%] w-[108%] max-w-none object-contain drop-shadow-[0_16px_12px_rgba(0,0,0,0.16)] transition-transform duration-300 group-hover:scale-[1.05]"
             loading="lazy">
    </a>

    <div class="flex flex-1 flex-col px-3.5 pb-0 pt-4 sm:px-5 sm:pt-5">
        @if ($brand)
            <span class="mb-1 block text-[11px] font-extrabold uppercase tracking-[0.18em] text-[#C45C5C]">
                {{ $brand }}
            </span>
        @endif
        <h3 class="mb-1.5 text-base font-bold leading-snug text-litus-text sm:text-[18.5px]">
            <a href="{{ route('motorcycle.show', $slug) }}">{{ $model }}</a>
        </h3>
        <p class="mb-3 text-xs text-litus-text-2 sm:mb-[15px] sm:text-[13.5px]">
            {{ $cc !== '-' ? $cc : '' }}{{ $cc !== '-' && $capacity !== '-' ? ' · ' : '' }}{{ $capacity !== '-' ? 'Tank '.$capacity : '' }}
        </p>

        @if ($price)
            <div class="flex flex-wrap items-baseline gap-[11px]">
                <span class="font-display text-[20px] font-bold tracking-[-0.03em] text-litus-text sm:text-[25px]">{{ $price }}</span>
            </div>
        @endif

        @if ($monthly)
            <div class="mt-[11px] flex items-start gap-2 rounded-lg bg-[#E6F6F3] px-2.5 py-2 text-[11.5px] font-semibold leading-snug text-litus-teal sm:items-center sm:px-3 sm:py-2.5 sm:text-[13px]">
                <span class="shrink-0" aria-hidden="true">◈</span>
                From {{ $monthly }}/month on an Ijara plan
            </div>
        @endif
    </div>

    <div class="p-3.5 pt-4 sm:p-5 sm:pt-[17px]">
        <a href="{{ $exploreHref }}"
           class="inline-flex min-h-11 w-full items-center justify-center gap-1.5 rounded-lg bg-litus-primary px-2 text-[12.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:min-h-0 sm:gap-2 sm:px-3 sm:py-3 sm:text-[13.5px]">
            {{ $exploreLabel }}
            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
        </a>
    </div>
</article>
