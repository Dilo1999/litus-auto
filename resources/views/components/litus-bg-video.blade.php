@props([
    'video',              // ['type' => 'file'|'youtube'|'vimeo', 'src' => string] from PageSetting::parseVideoUrl()
    'media' => null,      // only load the video when this media query matches, e.g. '(min-width: 961px)'
    'poster' => null,
    'sound' => false,     // show a sound on/off button (browsers only allow autoplay while muted)
    'videoClass' => '',   // extra classes for an uploaded <video>, e.g. 'object-[center_right]'
])

@php
    // Vimeo's background mode is always silent, so sound is only offered for files and YouTube.
    $withSound = $sound && in_array($video['type'], ['file', 'youtube'], true);
    $src = $video['src'];
@endphp

{{-- Muted, looped background video that covers its positioned parent. The source is attached by
     the script only when `media` matches, so hidden breakpoints never download it; it fades in
     once playing, leaving whatever sits underneath (usually the fallback image) visible until then. --}}
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0']) }} data-bg-video>
    <div class="absolute inset-0 overflow-hidden opacity-0 transition-opacity duration-700 [container-type:size]" data-bg-video-media aria-hidden="true">
        @if ($video['type'] === 'file')
            <video data-src="{{ $src }}" @if ($poster) poster="{{ $poster }}" @endif muted loop playsinline preload="none"
                   class="absolute inset-0 h-full w-full object-cover {{ $videoClass }}"></video>
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
        // Only fade in once the player reports real playback, so a blocked embed (e.g. YouTube's
        // "confirm you're not a bot" screen) never covers the fallback image. YouTube shows its
        // play/pause/skip overlay for ~3s after playback starts, so wait it out before fading in.
        const isYouTube = @json($video['type'] === 'youtube');
        const post = (msg) => frame.contentWindow.postMessage(JSON.stringify(msg), '*');
        const onMessage = (event) => {
            if (event.source !== frame.contentWindow) return;
            let data = event.data;
            try { if (typeof data === 'string') data = JSON.parse(data); } catch { return; }
            if (!data) return;
            const state = isYouTube
                ? data.event === 'onStateChange' ? data.info : data.info?.playerState
                : null;
            const playing = isYouTube ? state === 1 : data.event === 'play' || data.event === 'playProgress';
            if (isYouTube && data.event === 'onReady') {
                post({ event: 'command', func: 'addEventListener', args: ['onStateChange'] });
            }
            if (!isYouTube && data.event === 'ready') {
                post({ method: 'addEventListener', value: 'play' });
                post({ method: 'addEventListener', value: 'playProgress' });
            }
            // YouTube is looped here rather than with loop=1&playlist=…, which turns the embed into
            // a playlist with prev/next buttons and reloads (flashing the controls) on every loop.
            if (isYouTube && state === 0) {
                post({ event: 'command', func: 'seekTo', args: [0, true] });
                post({ event: 'command', func: 'playVideo', args: [] });
            }
            if (playing && !shown) {
                shown = true;
                setTimeout(show, isYouTube ? 3500 : 600);
                if (!isYouTube) window.removeEventListener('message', onMessage);
            }
        };
        let shown = false;
        window.addEventListener('message', onMessage);
        frame.addEventListener('load', () => {
            if (isYouTube) post({ event: 'listening', id: 'bg-video', channel: 'widget' });
        }, { once: true });
        frame.src = frame.dataset.src;
    })();
</script>
