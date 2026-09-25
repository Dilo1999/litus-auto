@props(['motorcycle'])

@php
    $price = (float) $motorcycle->original_price;
    $monthly = $price > 0 ? (int) (round(($price / 60) / 10) * 10) : null;
    $category = $motorcycle->category ?: 'Model';
@endphp

<article {{ $attributes->merge(['class' => 'group relative flex flex-col overflow-hidden rounded-[18px] border border-litus-line bg-white transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)] sm:overflow-visible']) }}
     data-motorcycle-card
     data-brand="{{ $motorcycle->brand }}"
     data-category="{{ $category }}"
     data-name="{{ $motorcycle->name }}"
     data-cc="{{ (int) preg_replace('/\D+/', '', (string) ($motorcycle->engineCapacity() ?? '0')) }}"
     data-price="{{ $price }}"
     data-promotion="0"
     data-popular="{{ $motorcycle->is_top_selling ? '1' : '0' }}"
     data-sort="{{ (int) $motorcycle->sort_order }}"
     data-id="{{ $motorcycle->id }}">
    <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
       class="relative aspect-[5/4] overflow-hidden rounded-t-[18px] bg-gradient-to-br from-[#DFE9F7] to-[#B9CFEC]">
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="relative z-[3] mx-auto h-full w-full max-w-none object-contain drop-shadow-[0_16px_12px_rgba(0,0,0,0.16)] transition-transform duration-300 group-hover:scale-[1.05] sm:h-[108%] sm:w-[108%]"
             loading="lazy">
    </a>

    <div class="flex flex-1 flex-col px-3.5 pb-0 pt-3 sm:px-5">
        @if ($motorcycle->brand)
            <span class="mb-1 block text-[11px] font-extrabold uppercase tracking-[0.18em] text-[#C45C5C]">
                {{ $motorcycle->brand }}
            </span>
        @endif
        <h3 class="mb-1.5 text-[18.5px] font-bold leading-snug text-litus-text max-md:text-base">
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}">{{ $motorcycle->name }}</a>
        </h3>
        <p class="mb-2 text-[13.5px] text-litus-text-2 max-md:text-[12px]">
            @if ($motorcycle->engineCapacity())
                {{ $motorcycle->engineCapacity() }}
            @endif
            @if ($motorcycle->engineCapacity() && $motorcycle->fuelTankCapacity())
                ·
            @endif
            @if ($motorcycle->fuelTankCapacity())
                Tank {{ $motorcycle->fuelTankCapacity() }}
            @endif
        </p>

        <div class="flex flex-wrap items-baseline gap-[11px]">
            <span class="font-display text-[25px] font-bold tracking-[-0.03em] text-litus-text max-md:text-[20px]">{{ $motorcycle->formattedOriginalPrice() }}</span>
        </div>

        @if ($monthly)
            <div class="mt-[11px] flex items-start gap-2 rounded-lg bg-[#E6F6F3] px-2.5 py-2 text-[11.5px] font-semibold leading-snug text-litus-teal sm:items-center sm:px-3 sm:py-2.5 sm:text-[13px]">
                <span class="shrink-0" aria-hidden="true">◈</span>
                From MVR {{ number_format($monthly) }}/month on an Ijara plan
            </div>
        @endif
    </div>

    <div class="px-3.5 pb-4 pt-3 sm:px-5">
        <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
           class="inline-flex min-h-11 w-full items-center justify-center gap-1.5 rounded-lg bg-litus-primary px-2 text-[12.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:min-h-0 sm:gap-2 sm:px-3 sm:py-2.5 sm:text-[13.5px]">
            View Details
            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
        </a>
    </div>
</article>
