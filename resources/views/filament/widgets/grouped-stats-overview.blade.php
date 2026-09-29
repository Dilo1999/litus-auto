<x-filament::widget class="filament-stats-overview-widget ad-stat-group">
    @if ($heading)
        <div class="ad-stat-group-head">
            <div class="ad-stat-group-title">{{ $heading }}</div>
            @if ($subheading)
                <div class="ad-stat-group-hint">{{ $subheading }}</div>
            @endif
        </div>
    @endif

    <x-filament::stats :columns="$columns">
        @foreach ($cards as $card)
            {{ $card }}
        @endforeach
    </x-filament::stats>
</x-filament::widget>
