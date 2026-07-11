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

<div {{ $attributes->merge(['class' => 'group relative min-h-[520px] overflow-hidden rounded-xl border border-[#07152f]/5 bg-white shadow-[0_18px_45px_rgba(7,21,47,0.08)] transition-all duration-350 hover:-translate-y-2.5 hover:shadow-[0_28px_65px_rgba(7,21,47,0.13)] max-[720px]:min-h-0 max-[720px]:rounded-2xl']) }}>
    <div class="pointer-events-none absolute inset-0 z-[1] bg-[linear-gradient(135deg,transparent_0_58%,rgba(7,21,47,0.035)_58%_72%,transparent_72%)]"></div>

    @if ($badge)
        <div class="absolute left-7 top-[26px] z-[4] inline-flex h-9 items-center gap-2 rounded-[22px] px-[18px] text-xs font-black uppercase text-white shadow-[0_10px_22px_rgba(0,0,0,0.15)] max-[720px]:left-4 max-[720px]:top-4 max-[720px]:h-8 max-[720px]:px-3.5 max-[720px]:text-[10px] {{ $styles['badge'] }}">
            {{ $badge }}
        </div>
    @endif

    <a href="{{ route('motorcycle.show', $slug) }}"
       class="absolute inset-0 z-[2]"
       aria-label="View {{ $model }}"></a>

    <div class="pointer-events-none relative z-[3] flex h-[285px] items-center justify-center overflow-hidden px-6 pb-2 pt-9 max-[720px]:h-[220px] max-[720px]:px-4 max-[720px]:pt-8">
        <img src="{{ $img }}"
             alt="{{ $model }}"
             class="h-[106%] w-[106%] max-h-none max-w-none object-contain drop-shadow-[0_22px_16px_rgba(0,0,0,0.18)] transition-transform duration-350 group-hover:scale-[1.1]">
    </div>

    <div class="pointer-events-none relative z-[3] px-[30px] pb-0 pt-3 text-center max-[720px]:px-5">
        <div class="mx-auto mb-[26px] h-[3px] w-11 rounded-[10px] max-[720px]:mb-4 {{ $styles['line'] }}"></div>

        <h3 class="mb-6 text-[23px] font-black text-[#07152f] max-[720px]:mb-4 max-[720px]:text-[20px]">{{ $model }}</h3>

        <div class="flex items-center justify-center gap-[18px] text-[15px] font-extrabold text-[#344054] max-[720px]:gap-3 max-[720px]:text-[13px]">
            <span class="inline-flex items-center gap-2">
                <x-litus-icon name="gauge" class="h-4 w-4 text-[#344054]" />
                {{ $cc }}
            </span>
            <span class="h-[22px] w-px bg-[#dce3ed]" aria-hidden="true"></span>
            <span class="inline-flex items-center gap-2">
                <x-litus-icon name="fuel" class="h-4 w-4 text-[#344054]" />
                Capacity {{ $capacity }}
            </span>
        </div>
    </div>

    <div class="relative z-[4] mt-[26px] flex h-[68px] items-center justify-center max-[720px]:mt-5 max-[720px]:h-14 {{ $styles['footer'] }}">
        <a href="{{ $exploreHref }}"
           class="group/btn inline-flex min-h-11 items-center gap-[18px] text-[17px] font-black transition-all duration-300 group-hover/btn:gap-[26px] max-[720px]:text-[15px] {{ $styles['btn'] }}">
            {{ $exploreLabel }}
            <x-litus-icon name="arrow-right" class="h-4 w-4" />
        </a>
    </div>
</div>
