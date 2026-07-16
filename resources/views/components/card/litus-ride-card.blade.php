@props([
    'model',
    'slug',
    'cc',
    'capacity',
    'img',
    'variant' => 'blue',
    'badge' => null,
    'exploreHref' => null,
    'exploreLabel' => 'Explore More',
])

@php
    $exploreHref = $exploreHref ?? route('motorcycles');
    $engineIcon = asset('images/details_page/' . rawurlencode('icons8-engine-50 (2).png'));

    $styles = match ($variant) {
        'red' => [
            'badge' => 'bg-[#f23838]',
            'line' => 'bg-[#f23838]',
            'footer' => 'bg-[#fff0f0]',
            'btn' => 'text-[#f23838]',
        ],
        'green' => [
            'badge' => 'bg-[#13b85a]',
            'line' => 'bg-[#13b85a]',
            'footer' => 'bg-[#ecfff3]',
            'btn' => 'text-[#13a84f]',
        ],
        default => [
            'badge' => 'bg-[#0069ff]',
            'line' => 'bg-[#0069ff]',
            'footer' => 'bg-[#eef5ff]',
            'btn' => 'text-[#0069ff]',
        ],
    };
@endphp

<div {{ $attributes->merge(['class' => 'group relative flex h-full min-h-0 flex-col overflow-hidden rounded-xl border border-[#07152f]/5 bg-white shadow-none transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_40px_rgba(7,21,47,0.12)] max-[720px]:rounded-2xl']) }}>
    <div class="pointer-events-none absolute inset-0 z-[1] bg-[linear-gradient(135deg,transparent_0_58%,rgba(7,21,47,0.035)_58%_72%,transparent_72%)]"></div>

    @if ($badge)
        <div class="absolute left-4 top-4 z-[4] inline-flex h-7 items-center gap-1.5 rounded-full px-3 text-[10px] font-black uppercase text-white shadow-[0_8px_16px_rgba(0,0,0,0.12)] max-[720px]:left-3.5 max-[720px]:top-3.5 {{ $styles['badge'] }}">
            {{ $badge }}
        </div>
    @endif

    <a href="{{ route('motorcycle.show', $slug) }}"
       class="absolute inset-0 z-[2]"
       aria-label="View {{ $model }}"></a>

    <div class="pointer-events-none relative z-[3] flex h-[245px] items-center justify-center overflow-hidden px-4 pb-1 pt-8 max-[720px]:h-[240px] max-[720px]:px-4 max-[720px]:pt-8 min-[1101px]:h-[230px]">
        <img src="{{ $img }}"
             alt="{{ $model }}"
             class="h-[112%] w-[112%] max-h-none max-w-none object-contain drop-shadow-[0_16px_12px_rgba(0,0,0,0.16)] transition-transform duration-300 group-hover:scale-[1.06]">
    </div>

    <div class="pointer-events-none relative z-[3] flex-1 px-4 pb-0 pt-3.5 text-center max-[720px]:px-4">
        <div class="mx-auto mb-4.5 h-[3px] w-9 rounded-[10px] max-[720px]:mb-3.5 {{ $styles['line'] }}"></div>

        <h3 class="mb-4 text-[18px] font-bold leading-snug text-[#07152f] max-[720px]:mb-3 max-[720px]:text-[19px] min-[1101px]:text-[18px]">{{ $model }}</h3>

        <div class="flex flex-wrap items-center justify-center gap-x-2.5 gap-y-1 text-[13px] font-extrabold text-[#344054] max-[720px]:text-[14px] min-[1101px]:text-[13px]">
            <span class="inline-flex items-center gap-1.5">
                <img src="{{ $engineIcon }}"
                     alt=""
                     class="h-4 w-4 shrink-0 object-contain"
                     aria-hidden="true">
                {{ $cc }}
            </span>
            <span class="h-4 w-px bg-[#dce3ed]" aria-hidden="true"></span>
            <span class="inline-flex items-center gap-1.5">
                <x-litus-icon name="fuel" class="h-4 w-4 text-[#344054]" />
                Capacity {{ $capacity }}
            </span>
        </div>
    </div>

    <div class="relative z-[4] mt-6 flex h-[60px] items-center justify-center max-[720px]:mt-5 max-[720px]:h-14 {{ $styles['footer'] }}">
        <a href="{{ $exploreHref }}"
           class="group/btn inline-flex min-h-10 items-center gap-3 text-[14px] font-black transition-all duration-300 group-hover/btn:gap-4 max-[720px]:text-[15px] min-[1101px]:text-[13px] {{ $styles['btn'] }}">
            {{ $exploreLabel }}
            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
        </a>
    </div>
</div>
