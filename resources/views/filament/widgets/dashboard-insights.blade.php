<x-filament::widget class="ad-dash-widget">
    <div class="ad-bento">
        {{-- Latest motorcycles --}}
        <section class="ad-card ad-bento-bikes" aria-labelledby="ad-bikes-title">
            <header class="ad-card-head">
                <div>
                    <h3 id="ad-bikes-title" class="ad-card-title">Latest motorcycles</h3>
                    <p class="ad-card-sub">Most recently added to the catalogue</p>
                </div>
                <a href="{{ $bikesUrl }}" class="ad-link">View all <x-heroicon-o-arrow-sm-right class="ad-ico-sm" aria-hidden="true" /></a>
            </header>

            @if ($bikes->isEmpty())
                <div class="ad-empty">
                    <span class="ad-empty-icon"><x-heroicon-o-truck aria-hidden="true" /></span>
                    <p>No motorcycles yet.</p>
                </div>
            @else
                <div class="ad-bikes">
                    @foreach ($bikes as $bike)
                        <a href="{{ $bike['url'] }}" class="ad-bike">
                            <div class="ad-bike-media">
                                @if ($bike['image'])
                                    <img src="{{ $bike['image'] }}" alt="" loading="lazy">
                                @else
                                    <x-heroicon-o-photograph class="ad-bike-placeholder" aria-hidden="true" />
                                @endif
                                <span class="ad-badge {{ $bike['live'] ? 'ad-badge--success' : 'ad-badge--neutral' }}">{{ $bike['live'] ? 'Live' : 'Draft' }}</span>
                            </div>
                            <div class="ad-bike-body">
                                @if ($bike['brand'])
                                    <span class="ad-bike-brand">{{ $bike['brand'] }}</span>
                                @endif
                                <span class="ad-bike-name">{{ $bike['name'] }}</span>
                                <span class="ad-bike-meta">
                                    @if ($bike['price'])
                                        <span class="ad-num">{{ $bike['price'] }}</span>
                                    @endif
                                    @if ($bike['topSelling'])
                                        <span class="ad-bike-flag">Top seller</span>
                                    @endif
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Needs attention --}}
        <section class="ad-card ad-bento-attention" id="ad-attention" aria-labelledby="ad-attn-title">
            <header class="ad-card-head">
                <div>
                    <h3 id="ad-attn-title" class="ad-card-title">Needs attention</h3>
                    <p class="ad-card-sub">Things to fix or finish</p>
                </div>
                @if ($attention->isNotEmpty())
                    <span class="ad-count">{{ $attention->count() }}</span>
                @endif
            </header>

            @if ($attention->isEmpty())
                <div class="ad-empty ad-empty--ok">
                    <span class="ad-empty-icon"><x-heroicon-o-check-circle aria-hidden="true" /></span>
                    <p><strong>All clear.</strong> Everything is published and up to date.</p>
                </div>
            @else
                <ul class="ad-list">
                    @foreach ($attention as $item)
                        <li class="ad-list-row">
                            <span class="ad-list-icon ad-tone--{{ $item['tone'] }}">
                                <x-dynamic-component :component="$item['icon']" aria-hidden="true" />
                            </span>
                            <span class="ad-list-text">{{ $item['text'] }}</span>
                            <a href="{{ $item['url'] }}" class="ad-list-action">{{ $item['action'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        {{-- Recent activity --}}
        <section class="ad-card ad-bento-activity" aria-labelledby="ad-activity-title">
            <header class="ad-card-head">
                <div>
                    <h3 id="ad-activity-title" class="ad-card-title">Recent activity</h3>
                    <p class="ad-card-sub">Latest edits across the admin</p>
                </div>
            </header>

            @if ($activity->isEmpty())
                <div class="ad-empty"><p>No activity yet.</p></div>
            @else
                <ol class="ad-feed">
                    @foreach ($activity as $event)
                        <li>
                            <a href="{{ $event['url'] }}" class="ad-feed-row">
                                <span class="ad-feed-icon"><x-dynamic-component :component="$event['icon']" aria-hidden="true" /></span>
                                <span class="ad-feed-text">
                                    <span class="ad-feed-title">{{ $event['title'] }}</span>
                                    <span class="ad-feed-meta">{{ $event['kind'] }} {{ $event['verb'] }}</span>
                                </span>
                                <time class="ad-feed-time" datetime="{{ $event['at']->toIso8601String() }}" title="{{ $event['at']->format('j M Y, H:i') }}">{{ $event['at']->shortRelativeDiffForHumans() }}</time>
                            </a>
                        </li>
                    @endforeach
                </ol>
            @endif
        </section>
    </div>
</x-filament::widget>
