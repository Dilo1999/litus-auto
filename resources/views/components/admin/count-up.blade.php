@props(['value' => 0, 'duration' => 900])
{{-- Counts from 0 to $value once on load (Alpine). Renders the real number without JS
     and jumps straight to it when the user prefers reduced motion. --}}
<span
    x-data="{ shown: {{ (int) $value }} }"
    x-init="
        const target = {{ (int) $value }};
        if (target === 0 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        shown = 0;
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / {{ (int) $duration }}, 1);
            shown = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    "
    x-text="shown"
    {{ $attributes }}
>{{ (int) $value }}</span>
