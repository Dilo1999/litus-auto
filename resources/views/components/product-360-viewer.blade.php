@props([
    'frames' => [],
    'alt' => 'Product 360 view',
    'imgClass' => 'block object-contain',
])

<div {{ $attributes->class(['group/spin']) }}
     data-product-spin
     data-frames='@json($frames)'>
    <img data-product-spin-img
         src="{{ $frames[0] ?? '' }}"
         alt="{{ $alt }}"
         draggable="false"
         class="pointer-events-auto {{ $imgClass }}">

    <div data-product-spin-hint
         class="pointer-events-none absolute bottom-3 left-1/2 z-[2] flex -translate-x-1/2 items-center gap-2 rounded-full border border-white/20 bg-black/45 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide text-white/90 opacity-0 backdrop-blur-sm transition-opacity duration-300 group-hover/spin:opacity-100 max-[1099px]:opacity-100 sm:text-xs">
        <svg class="h-3.5 w-3.5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
            <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
        </svg>
        Drag to rotate 360°
    </div>
</div>
