@props(['name', 'class' => 'w-4 h-4', 'fill' => 'none'])

@php
$attrs = $attributes->merge(['class' => $class, 'fill' => $fill, 'stroke' => 'currentColor', 'viewBox' => '0 0 24 24', 'stroke-width' => '2', 'stroke-linecap' => 'round', 'stroke-linejoin' => 'round', 'aria-hidden' => 'true']);
@endphp

@switch($name)
    @case('phone')
        <svg {{ $attrs }}><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        @break
    @case('menu')
        <svg {{ $attrs }}><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        @break
    @case('x')
        <svg {{ $attrs }}><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        @break
    @case('chevron-left')
        <svg {{ $attrs }}><path d="m15 18-6-6 6-6"/></svg>
        @break
    @case('chevron-right')
        <svg {{ $attrs }}><path d="m9 18 6-6-6-6"/></svg>
        @break
    @case('play')
        <svg {{ $attrs }}><polygon points="6 3 20 12 6 21 6 3" fill="currentColor" stroke="none"/></svg>
        @break
    @case('map-pin')
        <svg {{ $attrs }}><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
        @break
    @case('clock')
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        @break
    @case('mail')
        <svg {{ $attrs }}><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        @break
    @case('facebook')
        <svg {{ $attrs }}><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        @break
    @case('instagram')
        <svg {{ $attrs }}><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
        @break
    @case('message-circle')
        <svg {{ $attrs }}><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
        @break
    @case('fuel')
        <svg {{ $attrs }}><line x1="3" x2="15" y1="22" y2="22"/><line x1="4" x2="14" y1="9" y2="9"/><path d="M14 22V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v18"/><path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 2 2a2 2 0 0 0 2-2V9.83a2 2 0 0 0-.59-1.42L18 5"/></svg>
        @break
    @case('gauge')
        <svg {{ $attrs }}><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/><path d="M12 6v4"/></svg>
        @break
    @case('check-circle')
        <svg {{ $attrs }}><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
        @break
    @case('wrench')
        <svg {{ $attrs }}><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        @break
    @case('package')
        <svg {{ $attrs }}><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/><path d="m7.5 4.27 9 5.15"/></svg>
        @break
    @case('star')
        <svg {{ $attrs }}><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        @break
    @case('arrow-right')
        <svg {{ $attrs }}><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        @break
    @case('send')
        <svg {{ $attrs }}><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
        @break
@endswitch
