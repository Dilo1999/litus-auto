@props(['motorcycle'])

<div {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-[18px] border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:border-blue-100 hover:shadow-xl']) }}
     data-motorcycle-card
     data-brand="{{ $motorcycle->brand }}"
     data-name="{{ $motorcycle->name }}">
    <div class="relative overflow-hidden bg-white px-2 py-3">
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="h-48 w-full object-contain transition-transform duration-500 group-hover:scale-105">
        @if ($motorcycle->hasPromotion() && $motorcycle->offer_label)
            <span class="absolute left-3 top-3 rounded-md bg-litus-red px-2.5 py-1 text-xs font-black text-white shadow">{{ $motorcycle->offer_label }}</span>
        @endif
        @if ($motorcycle->brand)
            <span class="absolute right-3 top-3 rounded-md bg-white/90 px-2 py-1 text-xs font-bold text-gray-600 shadow">{{ $motorcycle->brand }}</span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-4">
        @if ($motorcycle->engineCapacity())
            <p class="mb-0.5 text-xs font-semibold text-gray-400">{{ $motorcycle->engineCapacity() }} Engine</p>
        @endif

        <h3 class="mb-2 text-base font-black leading-tight text-gray-900">{{ $motorcycle->name }}</h3>

        @if ($motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0)
            <div class="mb-4 flex items-center gap-1.5">
                <span class="text-xs text-gray-400">Save up to</span>
                <span class="text-lg font-black text-litus-red">{{ $motorcycle->formattedDiscount() }}</span>
            </div>
        @else
            <div class="mb-4 flex items-center gap-1.5">
                <span class="text-xs text-gray-400">Total Price: </span>
                <span class="text-lg font-black text-gray-900">{{ $motorcycle->formattedOriginalPrice() }}</span>
            </div>
        @endif

        <div class="mt-auto flex flex-col gap-2">
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
               class="w-full rounded-xl bg-litus-navy py-2.5 text-center text-sm font-bold text-white transition-opacity hover:opacity-90">Buy Now</a>
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
               class="w-full rounded-xl border border-gray-200 py-2 text-center text-sm font-semibold text-gray-600 transition-colors hover:border-gray-400 hover:text-gray-900">View Details</a>
        </div>
    </div>
</div>
