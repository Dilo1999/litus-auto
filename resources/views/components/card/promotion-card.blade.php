@props(['motorcycle'])

@php
    $hasPromo = $motorcycle->hasPromotion() && $motorcycle->discountAmount() > 0;
    $price = $hasPromo ? $motorcycle->promotionalSalePrice() : (float) $motorcycle->original_price;
    $monthly = $price > 0 ? (int) (round(($price / 60) / 10) * 10) : null;
@endphp

<article class="group relative flex flex-col overflow-visible rounded-[18px] border border-litus-line bg-white transition duration-200 hover:-translate-y-1 hover:border-litus-line-2 hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
    @if ($hasPromo)
        <div class="pointer-events-none absolute -left-3 top-1 z-10 flex h-[72px] w-[150px] items-center justify-center bg-[url('/images/badges/red-sale.png')] bg-[length:150px_auto] bg-left-top bg-no-repeat">
            <span class="w-[78%] pb-1 text-center font-[Poppins,sans-serif] text-[11.5px] font-extrabold uppercase italic leading-[1.05] tracking-[0.04em] text-white">
                Limited Offer
            </span>
        </div>
    @endif
    <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
       class="relative aspect-[16/11] overflow-hidden rounded-t-[18px] bg-gradient-to-br from-[#122240] to-[#0B47B0]">
        <div class="absolute inset-0 bg-[radial-gradient(420px_260px_at_68%_22%,rgba(90,184,255,0.34),transparent_66%)]"></div>
        @if ($motorcycle->brand)
            <div class="absolute right-[13px] top-[13px] z-[5]">
                <span class="inline-block rounded-md bg-black/50 px-[11px] py-1.5 text-[10.5px] font-extrabold uppercase tracking-[0.08em] text-white backdrop-blur-[5px]">{{ $motorcycle->brand }}</span>
            </div>
        @endif
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="relative z-[3] mx-auto h-[108%] w-[108%] max-w-none object-contain drop-shadow-[0_16px_12px_rgba(0,0,0,0.28)] transition-transform duration-300 group-hover:scale-[1.04]"
             loading="lazy">
    </a>

    <div class="flex flex-1 flex-col px-5 pb-0 pt-5">
        <span class="mb-1.5 block text-[10.5px] font-extrabold uppercase tracking-[0.16em] text-litus-text-3">Promotion</span>
        <h3 class="mb-1.5 text-[18.5px] font-bold leading-snug text-litus-text">
            <a href="{{ route('motorcycle.show', $motorcycle->slug) }}">{{ $motorcycle->name }}</a>
        </h3>
        @if ($motorcycle->engineCapacity())
            <p class="mb-[15px] text-[13.5px] text-litus-text-2">{{ $motorcycle->engineCapacity() }} engine · Limited-time deal</p>
        @endif

        @if ($hasPromo)
            <div class="flex flex-nowrap items-center gap-2">
                <span class="shrink-0 whitespace-nowrap text-sm text-litus-text-3 line-through">{{ $motorcycle->formattedOriginalPrice() }}</span>
                <div class="inline-flex min-w-0 shrink items-center gap-1 whitespace-nowrap rounded-[7px] bg-[#FFF1E6] px-2 py-1 text-[11.5px] font-bold text-[#C2410C]">
                    You save {{ $motorcycle->formattedDiscount() }}
                </div>
            </div>
            <div class="mt-[11px] font-display text-[25px] font-bold tracking-[-0.03em] text-litus-text">
                {{ $motorcycle->formattedSalePrice() }}
            </div>
        @else
            <div class="flex flex-wrap items-baseline gap-[11px]">
                <span class="font-display text-[25px] font-bold tracking-[-0.03em] text-litus-text">{{ $motorcycle->formattedOriginalPrice() }}</span>
            </div>
        @endif

        @if ($monthly)
            <div class="mt-[11px] flex items-center gap-2 rounded-lg bg-[#E6F6F3] px-3 py-2.5 text-[13px] font-semibold text-litus-teal">
                <span aria-hidden="true">◈</span>
                From MVR {{ number_format($monthly) }}/month on an Ijara plan
            </div>
        @endif
    </div>

    <div class="flex gap-2.5 p-5 pt-[17px]">
        <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
           class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-litus-primary px-3 py-3 text-[13.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
            View Details
            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 transition group-hover:translate-x-0.5" />
        </a>
        <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, I am interested in ' . $motorcycle->name) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="inline-flex flex-1 items-center justify-center rounded-lg border-[1.5px] border-litus-line-2 bg-white px-3 py-3 text-[13.5px] font-semibold text-litus-ink transition hover:border-litus-primary-light hover:text-litus-primary">
            WhatsApp
        </a>
    </div>
</article>
