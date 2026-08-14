@props(['motorcycle'])

@php
    $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
    $price = $hasPromo ? $motorcycle->promotionalSalePrice() : (float) $motorcycle->original_price;
    $monthly = $price > 0 ? (int) (round(($price / 60) / 10) * 10) : null;
    $category = $motorcycle->category ?: 'Model';
@endphp

<article {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-[18px] border border-litus-line bg-white transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]']) }}
     data-motorcycle-card
     data-brand="{{ $motorcycle->brand }}"
     data-category="{{ $category }}"
     data-name="{{ $motorcycle->name }}"
     data-cc="{{ (int) preg_replace('/\D+/', '', (string) ($motorcycle->engineCapacity() ?? '0')) }}"
     data-price="{{ $price }}"
     data-promotion="{{ $hasPromo ? '1' : '0' }}"
     data-popular="{{ $motorcycle->is_top_selling ? '1' : '0' }}"
     data-sort="{{ (int) $motorcycle->sort_order }}"
     data-id="{{ $motorcycle->id }}">
    <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
       class="relative aspect-[16/11] overflow-hidden bg-gradient-to-br from-[#DFE9F7] to-[#B9CFEC]">
        <div class="absolute left-[13px] right-[13px] top-[13px] z-[5] flex justify-between gap-2">
            <span @class([
                'inline-block rounded-md px-[11px] py-1.5 text-[10.5px] font-extrabold uppercase tracking-[0.08em]',
                'bg-[#DCE8FF] text-[#0B47B0]' => $hasPromo,
                'bg-black/50 text-white backdrop-blur-[5px]' => ! $hasPromo,
            ])>
                {{ $hasPromo ? 'In a campaign' : $category }}
            </span>
            @if ($motorcycle->brand)
                <span class="inline-block rounded-md bg-black/50 px-[11px] py-1.5 text-[10.5px] font-extrabold uppercase tracking-[0.08em] text-white backdrop-blur-[5px]">
                    {{ $motorcycle->brand }}
                </span>
            @endif
        </div>
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="relative z-[3] mx-auto h-full w-[88%] object-contain py-3 drop-shadow-[0_16px_12px_rgba(0,0,0,0.16)] transition-transform duration-300 group-hover:scale-[1.05]"
             loading="lazy">
    </a>

    <div class="flex flex-1 flex-col px-5 pb-0 pt-5">
        <h3 class="mb-1.5 text-[18.5px] font-bold leading-snug text-litus-text max-md:text-base">
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}">{{ $motorcycle->name }}</a>
        </h3>
        <p class="mb-[15px] text-[13.5px] text-litus-text-2 max-md:text-[12px]">
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

        @if ($hasPromo)
            <div class="flex flex-wrap items-baseline gap-[11px]">
                <span class="text-sm text-litus-text-3 line-through">{{ $motorcycle->formattedOriginalPrice() }}</span>
                <span class="font-display text-[25px] font-bold tracking-[-0.03em] text-litus-text max-md:text-[20px]">{{ $motorcycle->formattedSalePrice() }}</span>
            </div>
            <div class="mt-[11px] inline-flex w-fit items-center gap-1.5 rounded-[7px] bg-[#E6F7F0] px-3 py-1.5 text-[12.5px] font-bold text-[#07704E]">
                You save {{ $motorcycle->formattedDiscount() }}
            </div>
        @else
            <div class="flex flex-wrap items-baseline gap-[11px]">
                <span class="font-display text-[25px] font-bold tracking-[-0.03em] text-litus-text max-md:text-[20px]">{{ $motorcycle->formattedOriginalPrice() }}</span>
            </div>
        @endif

        @if ($monthly)
            <div class="mt-[11px] flex items-center gap-2 rounded-lg bg-[#E6F6F3] px-3 py-2.5 text-[13px] font-semibold text-litus-teal max-md:text-[12px]">
                <span aria-hidden="true">◈</span>
                From MVR {{ number_format($monthly) }}/month on an Ijara plan
            </div>
        @endif
    </div>

    <div class="p-5 pt-[17px]">
        <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
           class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-3 py-3 text-[13.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover max-md:py-2.5 max-md:text-[12px]">
            View Details
            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
        </a>
    </div>
</article>
