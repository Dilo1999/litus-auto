@props(['features' => []])

@if (count($features))
    <div class="absolute bottom-0 left-0 right-0 z-[3] border-t border-white/12 bg-[rgba(3,13,25,0.78)] backdrop-blur-sm max-md:relative max-md:mt-0 max-md:border-t-0 max-md:bg-transparent max-md:px-0 max-md:pb-4 max-[1100px]:relative max-[1100px]:mt-5 max-md:max-[1100px]:mt-0"
         data-hero-features>
        <div class="litus-container max-md:!px-0">
            <div data-hero-feature-slider
                 data-interval="3500"
                 class="grid min-h-[76px] grid-cols-1 max-md:flex max-md:min-h-0 max-md:snap-x max-md:snap-mandatory max-md:gap-3 max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden min-[768px]:max-[1099px]:grid-cols-2 min-[1100px]:grid-cols-4">
                @foreach ($features as $index => $feature)
                    <div @class([
                        'relative flex items-center gap-3 py-3 sm:gap-3.5 min-[1100px]:py-3.5',
                        'max-md:w-[78%] max-md:shrink-0 max-md:snap-center max-md:flex-row max-md:items-center max-md:gap-3 max-md:rounded-2xl max-md:border max-md:border-white/12 max-md:bg-white/[0.06] max-md:px-4 max-md:py-3.5 max-md:text-left',
                        'min-[768px]:border-b min-[768px]:border-white/12' => $index < count($features) - 1,
                        'min-[1100px]:border-b-0 min-[1100px]:border-r min-[1100px]:border-white/16 min-[1100px]:pr-4' => $index < count($features) - 1,
                        'min-[1100px]:pl-0' => $index === 0,
                        'min-[1100px]:pl-4' => $index > 0,
                        'min-[768px]:max-[1099px]:border-r min-[768px]:max-[1099px]:border-white/16' => in_array($index, [0, 2]),
                        'min-[768px]:max-[1099px]:border-b min-[768px]:max-[1099px]:border-white/12' => in_array($index, [0, 1]),
                        'min-[768px]:max-[1099px]:border-r-0' => $index === 1,
                    ])
                         data-hero-feature-slide>
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-white/35 text-white shadow-[0_0_16px_rgba(255,255,255,0.06)] max-md:h-10 max-md:w-10 max-md:border-[#0065ef]/40 max-md:bg-[#0065ef]/15 sm:h-10 sm:w-10">
                            <x-litus-icon :name="$feature['icon']" class="h-4 w-4 max-md:h-4 max-md:w-4 max-md:text-[#0065ef] sm:h-[18px] sm:w-[18px]" />
                        </div>
                        <div class="min-w-0 text-left">
                            <h3 class="mb-0.5 text-sm font-extrabold leading-tight text-white max-md:mb-0.5 max-md:text-[13px] sm:text-[15px]">{{ $feature['title'] }}</h3>
                            <p class="text-xs font-medium leading-snug text-[#c9d4df] max-md:line-clamp-2 max-md:text-[11px] sm:text-[13px]">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3 hidden items-center justify-center gap-1.5 max-md:flex" data-hero-feature-dots aria-hidden="true">
                @foreach ($features as $index => $feature)
                    <span @class([
                        'h-1.5 rounded-full transition-all duration-300',
                        'w-5 bg-[#0065ef]' => $index === 0,
                        'w-1.5 bg-white/35' => $index !== 0,
                    ])
                          data-hero-feature-dot></span>
                @endforeach
            </div>
        </div>
    </div>
@endif
