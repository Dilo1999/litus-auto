@props(['motorcycle'])

<div class="group relative overflow-visible rounded-[24px] border border-[#07152f]/8 bg-white px-5 pb-5 pt-[88px] shadow-none transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_24px_60px_rgba(7,21,47,0.16)] max-[650px]:overflow-hidden max-[650px]:rounded-2xl max-[650px]:px-4 max-[650px]:pb-4 max-[650px]:pt-[78px] max-[650px]:shadow-none max-[650px]:hover:shadow-[0_12px_28px_rgba(7,21,47,0.1)] min-[651px]:rounded-[28px] min-[651px]:px-6 min-[651px]:pb-6 min-[651px]:pt-24 min-[1101px]:rounded-[32px] min-[1101px]:px-7 min-[1101px]:pb-7 min-[1101px]:pt-[100px]">
    {{-- Offer ribbon --}}
    <div class="absolute -left-4 top-4 z-[3] max-[650px]:left-0 max-[650px]:right-0 max-[650px]:top-3 min-[651px]:top-6 min-[1101px]:-left-5 min-[1101px]:top-8">
        {{-- Fold shadow under left edge --}}
        <span class="absolute bottom-[-16px] left-0 h-4 w-4 bg-[#0037aa] [clip-path:polygon(0_0,100%_0,100%_100%)] max-[650px]:hidden"
              aria-hidden="true"></span>

        <div class="relative flex h-[52px] min-w-[200px] items-center gap-2.5 bg-gradient-to-br from-[#004be8] to-[#2685ff] py-0 pl-3.5 pr-8 shadow-[0_12px_24px_rgba(0,75,232,0.28)] [clip-path:polygon(0_0,calc(100%-28px)_0,calc(100%-12px)_18%,calc(100%-4px)_38%,100%_50%,calc(100%-4px)_62%,calc(100%-12px)_82%,calc(100%-28px)_100%,0_100%)] max-[650px]:h-auto max-[650px]:min-h-10 max-[650px]:w-[calc(100%-0.5rem)] max-[650px]:max-w-none max-[650px]:gap-2 max-[650px]:py-2 max-[650px]:pl-3 max-[650px]:pr-7 max-[650px]:shadow-md max-[650px]:[clip-path:polygon(0_0,calc(100%-22px)_0,calc(100%-10px)_18%,calc(100%-3px)_38%,100%_50%,calc(100%-3px)_62%,calc(100%-10px)_82%,calc(100%-22px)_100%,0_100%)] min-[651px]:h-[56px] min-[651px]:min-w-[220px] min-[651px]:gap-3 min-[651px]:pl-5 min-[651px]:pr-9 min-[651px]:[clip-path:polygon(0_0,calc(100%-30px)_0,calc(100%-14px)_18%,calc(100%-5px)_38%,100%_50%,calc(100%-5px)_62%,calc(100%-14px)_82%,calc(100%-30px)_100%,0_100%)] min-[1101px]:h-[60px] min-[1101px]:min-w-[240px] min-[1101px]:pl-6 min-[1101px]:pr-10 min-[1101px]:[clip-path:polygon(0_0,calc(100%-32px)_0,calc(100%-15px)_18%,calc(100%-5px)_38%,100%_50%,calc(100%-5px)_62%,calc(100%-15px)_82%,calc(100%-32px)_100%,0_100%)]">
            {{-- Soft depth on the curved tip --}}
            <span class="pointer-events-none absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-[#003fbf]/40 to-transparent max-[650px]:w-6"
                  aria-hidden="true"></span>

            <div class="relative z-[1] flex h-6 w-6 shrink-0 rotate-[30deg] items-center justify-center rounded-lg border-2 border-white text-white max-[650px]:h-5 max-[650px]:w-5 max-[650px]:rounded-md min-[651px]:h-7 min-[651px]:w-7 min-[1101px]:h-8 min-[1101px]:w-8">
                <span class="rotate-[-30deg] text-[10px] font-black max-[650px]:text-[9px] min-[651px]:text-xs min-[1101px]:text-sm" aria-hidden="true">★</span>
            </div>

            <span class="relative z-[1] text-sm font-black uppercase tracking-wide text-white max-[650px]:whitespace-normal max-[650px]:break-words max-[650px]:text-[12px] max-[650px]:leading-tight max-[650px]:tracking-[0.04em] min-[651px]:truncate min-[651px]:text-base min-[1101px]:text-lg">
                {{ $motorcycle->offerLabel() }}
            </span>
        </div>
    </div>

    {{-- Product image --}}
    <div class="relative z-[2] flex h-[140px] items-center justify-center overflow-hidden max-[650px]:h-[150px] min-[651px]:h-[160px] min-[1101px]:h-[175px]">
        <img src="{{ $motorcycle->listImageUrl() }}"
             alt="{{ $motorcycle->name }}"
             class="h-[112%] w-[112%] max-h-none max-w-none object-contain drop-shadow-[0_20px_14px_rgba(0,0,0,0.2)] max-[650px]:drop-shadow-[0_12px_10px_rgba(0,0,0,0.16)]">
    </div>

    {{-- Product info --}}
    <div class="relative z-[2] mt-2 text-center max-[650px]:mt-1.5 min-[1101px]:mt-3">
        <h3 class="mb-3 line-clamp-2 font-a4speed text-lg font-bold leading-tight tracking-[-0.5px] text-[#07152f] max-[650px]:mb-2 max-[650px]:text-[16px] min-[651px]:text-xl min-[1101px]:text-[22px]">
            {{ $motorcycle->name }}
        </h3>

        <div class="relative mx-auto mb-3 h-[3px] w-[72%] bg-[#e1e7ef] max-[650px]:mb-2.5 max-[650px]:w-[60%] min-[1101px]:mb-3.5">
            <span class="absolute left-1/2 top-0 h-1 w-12 -translate-x-1/2 rounded-full bg-[#1268ff] max-[650px]:w-10 min-[1101px]:w-14"></span>
        </div>

        <p class="mb-4 text-base font-black text-[#747f91] max-[650px]:mb-3 max-[650px]:text-sm min-[651px]:text-lg min-[1101px]:mb-5 min-[1101px]:text-xl">
            Discount: <span class="text-[#1268ff]">{{ $motorcycle->formattedDiscount() }}</span>
        </p>

        <a href="{{ route('motorcycle.show', $motorcycle->slug) }}"
           class="group relative z-[3] mx-auto flex h-9 w-full items-center justify-center rounded-lg border-2 border-[#0066ff] bg-transparent text-sm font-black text-[#0066ff] transition-all duration-300 hover:-translate-y-0.5 hover:border-transparent hover:bg-gradient-to-r hover:from-[#0066ff] hover:to-[#004fe8] hover:text-white hover:shadow-[0_12px_24px_rgba(0,90,255,0.28)] max-[650px]:h-11 max-[650px]:rounded-xl max-[650px]:text-[13px] min-[651px]:h-10 min-[651px]:text-base min-[1101px]:h-11 min-[1101px]:rounded-xl min-[1101px]:text-lg">
            <span class="inline-flex items-center gap-2.5 min-[651px]:gap-3 min-[1101px]:gap-4">
                <img src="{{ asset('images/homepage/cart/icons8-cart-80.png') }}"
                     alt=""
                     aria-hidden="true"
                     class="h-5 w-5 shrink-0 object-contain brightness-0 transition-all duration-300 group-hover:brightness-100 max-[650px]:h-4 max-[650px]:w-4 min-[651px]:h-5 min-[651px]:w-5 min-[1101px]:h-6 min-[1101px]:w-6">
                <span class="h-5 w-px shrink-0 bg-[#0066ff]/40 transition-colors duration-300 group-hover:bg-white/45 max-[650px]:h-4 min-[651px]:h-5 min-[1101px]:h-6"
                      aria-hidden="true"></span>
                <span>Buy Now</span>
            </span>
        </a>
    </div>
</div>
