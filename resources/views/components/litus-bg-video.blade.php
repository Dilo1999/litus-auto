@props([
    'video',              // ['type' => 'file'|'youtube'|'vimeo', 'src' => string] from PageSetting::parseVideoUrl()
    'media' => null,      // only load the video when this media query matches, e.g. '(min-width: 961px)'
    'poster' => null,
    'sound' => false,     // show a sound on/off button (browsers only allow autoplay while muted)
])

@php
    // Vimeo's background mode is always silent, so sound is only offered for files and YouTube.
    $withSound = $sound && in_array($video['type'], ['file', 'youtube'], true);
    $src = $video['src'] . ($withSound && $video['type'] === 'youtube' ? '&enablejsapi=1' : '');
@endphp

{{-- Muted, looped background video that covers its positioned parent. The source is attached by
     the script only when `media` matches, so hidden breakpoints never download it; it fades in
     once playing, leaving whatever sits underneath (usually the fallback image) visible until then. --}}
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0']) }} data-bg-video>
    <div class="absolute inset-0 overflow-hidden opacity-0 transition-opacity duration-700 [container-type:size]" data-bg-video-media aria-hidden="true">
        @if ($video['type'] === 'file')
            <video data-src="{{ $src }}" @if ($poster) poster="{{ $poster }}" @endif muted loop playsinline preload="none"
                   class="absolute inset-0 h-full w-full object-cover"></video>
        @else
            <iframe data-src="{{ $src }}" title="Background video" tabindex="-1" frameborder="0"
                    allow="autoplay; encrypted-media; picture-in-picture"
                    class="absolute left-1/2 top-1/2 h-[max(100cqh,56.25cqw)] w-[max(100cqw,177.78cqh)] -translate-x-1/2 -translate-y-1/2"></iframe>
        @endif
    </div>
    @if ($withSound)
        <button type="button" aria-pressed="false" aria-label="Turn sound on"
                class="pointer-events-auto absolute bottom-3 right-3 z-[3] hidden h-10 w-10 place-items-center rounded-full bg-black/55 text-white shadow-lg backdrop-blur transition hover:bg-black/75 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70 min-[961px]:bottom-5 min-[961px]:right-5 min-[961px]:h-11 min-[961px]:w-11"
                data-bg-video-sound>
            <x-litus-icon name="volume-x" class="h-5 w-5" data-sound-off />
            <x-litus-icon name="volume-2" class="hidden h-5 w-5" data-sound-on />
        </button>
    @endif
</div>
<script>
    (() => {
        const root = document.currentScript.previousElementSibling;
        const media = @json($media);
        if (media && !window.matchMedia(media).matches) return;
        const wrap = root.querySelector('[data-bg-video-media]');
        const button = root.querySelector('[data-bg-video-sound]');
        const video = wrap.querySelector('video');
        const frame = wrap.querySelector('iframe');
        const show = () => {
            wrap.classList.replace('opacity-0', 'opacity-100');
            if (button) button.classList.replace('hidden', 'grid');
        };

        if (button) {
            const ytCommand = (func, args = []) =>
                frame.contentWindow.postMessage(JSON.stringify({ event: 'command', func, args }), '*');
            button.addEventListener('click', () => {
                const on = button.getAttribute('aria-pressed') !== 'true';
                if (video) {
                    video.muted = !on;
                    if (on) video.play().catch(() => {});
                } else {
                    ytCommand(on ? 'unMute' : 'mute');
                    if (on) { ytCommand('setVolume', [100]); ytCommand('playVideo'); }
                }
                button.setAttribute('aria-pressed', String(on));
                button.setAttribute('aria-label', on ? 'Turn sound off' : 'Turn sound on');
                button.querySelector('[data-sound-off]').classList.toggle('hidden', on);
                button.querySelector('[data-sound-on]').classList.toggle('hidden', !on);
            });
        }

        if (video) {
            video.addEventListener('playing', show, { once: true });
            video.src = video.dataset.src;
            video.play().catch(() => {});
            return;
        }
        // Give the embed a moment to get past its loading/title frame before fading in.
        frame.addEventListener('load', () => setTimeout(show, 1200), { once: true });
        frame.src = frame.dataset.src;
    })();
</script>
