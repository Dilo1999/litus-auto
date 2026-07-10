@props(['motorcycle'])

<div class="group relative overflow-visible rounded-[24px] border border-[#07152f]/8 bg-white px-5 pb-5 pt-[88px] shadow-[0_20px_50px_rgba(7,21,47,0.12)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_24px_60px_rgba(7,21,47,0.16)] min-[651px]:rounded-[28px] min-[651px]:px-6 min-[651px]:pb-6 min-[651px]:pt-24 min-[1101px]:rounded-[32px] min-[1101px]:px-7 min-[1101px]:pb-7 min-[1101px]:pt-[100px]">
    {{-- Offer ribbon --}}
    <div class="absolute -left-4 top-4 z-[3] min-[651px]:top-6 min-[1101px]:-left-5 min-[1101px]:top-8">
        <span class="absolute bottom-[-18px] left-0 h-5 w-5 bg-[#0037aa] [clip-path:polygon(0_0,100%_0,100%_100%)] min-[1101px]:bottom-[-20px] min-[1101px]:h-5 min-[1101px]:w-5"
              aria-hidden="true"></span>

        <div class="relative flex h-[52px] min-w-[200px] items-center gap-2.5 rounded-r-xl bg-gradient-to-br from-[#004be8] to-[#2685ff] px-3.5 shadow-[0_12px_24px_rgba(0,75,232,0.28)] min-[651px]:h-[56px] min-[651px]:min-w-[220px] min-[651px]:gap-3 min-[651px]:px-5 min-[1101px]:h-[60px] min-[1101px]:min-w-[240px] min-[1101px]:px-6">
            <span class="absolute -right-2.5 top-0 -z-10 hidden h-full w-8 skew-x-[-18deg] rounded-r-xl bg-gradient-to-br from-[#2685ff] to-[#0069ff] min-[651px]:block min-[1101px]:-right-3 min-[1101px]:w-10"
                  aria-hidden="true"></span>

            <div class="flex h-6 w-6 shrink-0 rotate-[30deg] items-center justify-center rounded-lg border-2 border-white text-white min-[651px]:h-7 min-[651px]:w-7 min-[1101px]:h-8 min-[1101px]:w-8">
                <span class="rotate-[-30deg] text-[10px] font-black min-[651px]:text-xs min-[1101px]:text-sm" aria-hidden="true">★</span>
            </div>

            <span class="truncate text-sm font-black uppercase tracking-wide text-white min-[651px]:text-base min-[1101px]:text-lg">
                {{ $motorcycle->offerLabel() }}
            </span>
        </div>
    </div>

    {{-- Product image --}}
    <div class="relative z-[2] flex h-[140px] items-center justify-center min-[651px]:h-[160px] min-[1101px]:h-[175px]">
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="h-full w-full object-contain drop-shadow-[0_20px_14px_rgba(0,0,0,0.2)]">
    </div>

    {{-- Product info --}}
    <div class="relative z-[2] mt-2 text-center min-[1101px]:mt-3">
        <h3 class="mb-3 line-clamp-2 text-lg font-black leading-tight tracking-[-0.5px] text-[#07152f] min-[651px]:text-xl min-[1101px]:text-[22px]">
            {{ $motorcycle->name }}
        </h3>

        <div class="relative mx-auto mb-3 h-[3px] w-[72%] bg-[#e1e7ef] min-[1101px]:mb-3.5">
            <span class="absolute left-1/2 top-0 h-1 w-12 -translate-x-1/2 rounded-full bg-[#1268ff] min-[1101px]:w-14"></span>
        </div>

        <p class="mb-4 text-base font-black text-[#747f91] min-[651px]:text-lg min-[1101px]:mb-5 min-[1101px]:text-xl">
            Discount: <span class="text-[#1268ff]">{{ $motorcycle->formattedDiscount() }}</span>
        </p>

        <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
           class="group relative z-[3] mx-auto flex h-9 w-full items-center justify-center rounded-lg border-2 border-[#0066ff] bg-transparent text-sm font-black text-[#0066ff] transition-all duration-300 hover:-translate-y-0.5 hover:border-transparent hover:bg-gradient-to-r hover:from-[#0066ff] hover:to-[#004fe8] hover:text-white hover:shadow-[0_12px_24px_rgba(0,90,255,0.28)] min-[651px]:h-10 min-[651px]:text-base min-[1101px]:h-11 min-[1101px]:rounded-xl min-[1101px]:text-lg">
            <span class="inline-flex items-center gap-2.5 min-[651px]:gap-3 min-[1101px]:gap-4">
                <img src="{{ asset('images/homepage/cart/icons8-cart-80.png') }}"
                     alt=""
                     aria-hidden="true"
                     class="h-5 w-5 shrink-0 object-contain brightness-0 transition-all duration-300 group-hover:brightness-100 min-[651px]:h-5 min-[651px]:w-5 min-[1101px]:h-6 min-[1101px]:w-6">
                <span class="h-5 w-px shrink-0 bg-[#0066ff]/40 transition-colors duration-300 group-hover:bg-white/45 min-[651px]:h-5 min-[1101px]:h-6"
                      aria-hidden="true"></span>
                <span>Buy Now</span>
            </span>
        </a>
    </div>
</div>
