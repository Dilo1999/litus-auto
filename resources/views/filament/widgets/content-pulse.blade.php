<x-filament::widget class="ad-dash-widget">
    <section aria-labelledby="ad-pulse-title">
        <div class="ad-section-head ad-rise" style="--i: 5">
            <h3 id="ad-pulse-title" class="ad-section-title">Content pulse</h3>
            <p class="ad-section-hint">Live on the storefront vs. total in the admin</p>
        </div>

        <div class="ad-tiles">
            @foreach ($types as $type)
                @php
                    $state = $type['total'] === 0 ? 'empty' : ($type['drafts'] > 0 || $type['live'] < $type['total'] ? 'partial' : 'ok');
                @endphp
                <a href="{{ $type['url'] }}" class="ad-tile ad-rise" style="--ad-pct: {{ $type['percent'] }}%; --i: {{ 6 + $loop->index }}">
                    <div class="ad-tile-head">
                        <span class="ad-tile-icon">
                            <x-dynamic-component :component="$type['icon']" aria-hidden="true" />
                        </span>
                        <span class="ad-tile-label">{{ $type['label'] }}</span>
                        <x-heroicon-o-arrow-sm-right class="ad-tile-go" aria-hidden="true" />
                    </div>

                    <div class="ad-tile-value">
                        <x-admin.count-up :value="$type['live']" />
                        <span class="ad-tile-of">/ {{ $type['total'] }} live</span>
                    </div>

                    <div class="ad-tile-bar" aria-hidden="true"><span></span></div>

                    <div class="ad-tile-foot">
                        <span class="ad-status ad-status--{{ $state }}">
                            @if ($state === 'ok')
                                All live
                            @elseif ($state === 'empty')
                                Nothing yet
                            @elseif ($type['drafts'] > 0)
                                {{ $type['drafts'] }} unpublished
                            @else
                                {{ $type['total'] - $type['live'] }} not live
                            @endif
                        </span>
                        @if ($type['note'])
                            <span class="ad-tile-note">{{ $type['note'] }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</x-filament::widget>
