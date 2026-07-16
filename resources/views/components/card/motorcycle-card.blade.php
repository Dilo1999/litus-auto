@props(['motorcycle'])

<div {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-[18px] border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:border-blue-100 hover:shadow-xl max-md:rounded-2xl']) }}
     data-motorcycle-card
     data-brand="{{ $motorcycle->brand }}"
     data-name="{{ $motorcycle->name }}"
     data-cc="{{ (int) preg_replace('/\D+/', '', (string) ($motorcycle->engineCapacity() ?? '0')) }}"
     data-price="{{ $motorcycle->hasPromotion() ? (float) $motorcycle->sale_price : (float) $motorcycle->original_price }}"
     data-promotion="{{ $motorcycle->hasPromotion() ? '1' : '0' }}"
     data-popular="{{ $motorcycle->is_top_selling ? '1' : '0' }}"
     data-sort="{{ (int) $motorcycle->sort_order }}"
     data-id="{{ $motorcycle->id }}">
    <div class="relative overflow-hidden bg-white px-2 py-3 max-md:px-1.5 max-md:py-2">
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="h-48 w-full object-contain transition-transform duration-500 group-hover:scale-105 max-md:h-28">
        @if ($motorcycle->hasPromotion())
            <span class="absolute left-3 top-3 rounded-md bg-litus-red px-2.5 py-1 text-xs font-black text-white shadow max-md:left-1.5 max-md:top-1.5 max-md:rounded max-md:px-1.5 max-md:py-0.5 max-md:text-[9px]">{{ $motorcycle->offerLabel() }}</span>
        @endif
        @if ($motorcycle->brand)
            <span class="absolute right-3 top-3 rounded-md bg-white/90 px-2 py-1 text-xs font-bold text-gray-600 shadow max-md:right-1.5 max-md:top-1.5 max-md:rounded max-md:px-1.5 max-md:py-0.5 max-md:text-[9px]">{{ $motorcycle->brand }}</span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-4 max-md:p-2.5">
        @if ($motorcycle->engineCapacity())
            <p class="mb-0.5 text-xs font-semibold text-gray-400 max-md:text-[10px]">{{ $motorcycle->engineCapacity() }} Engine</p>
        @endif

        <h3 class="mb-2 text-base font-bold leading-tight text-gray-900 max-md:mb-1.5 max-md:line-clamp-2 max-md:text-[13px]">{{ $motorcycle->name }}</h3>

        @if ($motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0)
            <div class="mb-4 flex flex-wrap items-center gap-1 max-md:mb-2.5 max-md:gap-0.5">
                <span class="text-xs text-gray-400 max-md:text-[10px]">Save up to</span>
                <span class="text-lg font-black text-litus-red max-md:text-sm">{{ $motorcycle->formattedDiscount() }}</span>
            </div>
        @else
            <div class="mb-4 flex flex-wrap items-center gap-1 max-md:mb-2.5 max-md:gap-0.5">
                <span class="text-xs text-gray-400 max-md:text-[10px]">Total Price:</span>
                <span class="text-lg font-black text-gray-900 max-md:text-sm">{{ $motorcycle->formattedOriginalPrice() }}</span>
            </div>
        @endif

        <div class="mt-auto flex flex-col gap-2 max-md:gap-1.5">
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
               class="w-full rounded-xl bg-litus-navy py-2.5 text-center text-sm font-bold text-white transition-opacity hover:opacity-90 max-md:rounded-lg max-md:py-2 max-md:text-[11px]">Buy Now</a>
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
               class="w-full rounded-xl border border-gray-200 py-2 text-center text-sm font-semibold text-gray-600 transition-colors hover:border-gray-400 hover:text-gray-900 max-md:rounded-lg max-md:py-1.5 max-md:text-[11px]">View Details</a>
        </div>
    </div>
</div>
