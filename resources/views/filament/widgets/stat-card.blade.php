@php
    $tone = $getTone();
    $progress = $getProgress();
    $url = $getUrl();
    $tag = $url ? 'a' : 'div';
    $icon = $getIcon();
    $status = $getStatus();
    $description = $getDescription();
@endphp
<{{ $tag }}
    @if ($url) href="{{ $url }}" @endif
    @if ($url && $shouldOpenUrlInNewTab()) target="_blank" @endif
    class="ad-stat ad-stat-{{ $tone }}"
    @if (! is_null($progress)) style="--ad-progress: {{ $progress }}%" @endif
>
    <div class="ad-stat-top">
        @if ($icon)
            <span class="ad-stat-icon">
                <x-dynamic-component :component="$icon" />
            </span>
        @endif

        @if ($status)
            <span class="ad-stat-pill">{{ $status }}</span>
        @endif
    </div>

    <div class="ad-stat-body">
        <div class="ad-stat-value">{{ $getValue() }}</div>
        <div class="ad-stat-label">{{ $getLabel() }}</div>
    </div>

    @if (! is_null($progress))
        <div class="ad-stat-bar-track">
            <div class="ad-stat-bar-fill" style="width: {{ $progress }}%"></div>
        </div>
    @endif

    @if ($description)
        <div class="ad-stat-foot">{{ $description }}</div>
    @endif
</{{ $tag }}>
