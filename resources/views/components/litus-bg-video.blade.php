@props([
    'video',              // ['type' => 'file'|'youtube'|'vimeo', 'src' => string] from PageSetting::parseVideoUrl()
    'media' => null,      // only load the video when this media query matches, e.g. '(min-width: 961px)'
    'poster' => null,
])

{{-- Muted, looped background video that covers its positioned parent. The source is attached by
     the script only when `media` matches, so hidden breakpoints never download it; it fades in
     once playing, leaving whatever sits underneath (usually the fallback image) visible until then. --}}
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0 overflow-hidden opacity-0 transition-opacity duration-700 [container-type:size]']) }}
     aria-hidden="true">
    @if ($video['type'] === 'file')
        <video data-src="{{ $video['src'] }}" @if ($poster) poster="{{ $poster }}" @endif muted loop playsinline preload="none"
               class="absolute inset-0 h-full w-full object-cover"></video>
    @else
        <iframe data-src="{{ $video['src'] }}" title="Background video" tabindex="-1" frameborder="0"
                allow="autoplay; encrypted-media; picture-in-picture"
                class="absolute left-1/2 top-1/2 h-[max(100cqh,56.25cqw)] w-[max(100cqw,177.78cqh)] -translate-x-1/2 -translate-y-1/2"></iframe>
    @endif
</div>
<script>
    (() => {
        const wrap = document.currentScript.previousElementSibling;
        const media = @json($media);
        if (media && !window.matchMedia(media).matches) return;
        const show = () => wrap.classList.replace('opacity-0', 'opacity-100');
        const video = wrap.querySelector('video');
        if (video) {
            video.addEventListener('playing', show, { once: true });
            video.src = video.dataset.src;
            video.play().catch(() => {});
            return;
        }
        const frame = wrap.querySelector('iframe');
        // Give the embed a moment to get past its loading/title frame before fading in.
        frame.addEventListener('load', () => setTimeout(show, 1200), { once: true });
        frame.src = frame.dataset.src;
    })();
</script>
