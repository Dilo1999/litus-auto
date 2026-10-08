@php
    $radius = 54;
    $circumference = 2 * pi() * $radius;
    $dash = $circumference * $summary['percent'] / 100;
@endphp
<x-filament::widget class="ad-dash-widget">
    <section class="ad-hero2" aria-label="Overview">
        <div class="ad-hero2-main">
            <p class="ad-eyebrow">{{ $today }}</p>
            <h2 class="ad-hero2-title">{{ $greeting }}, <span>{{ $firstName }}</span></h2>
            <p class="ad-hero2-lead">
                Your storefront is <strong>{{ $summary['percent'] }}% live</strong>.
                {{ $summary['live'] }} of {{ $summary['total'] }} items are visible to customers
                @if ($attentionCount > 0)
                    and <a href="#ad-attention">{{ $attentionCount }} {{ $attentionCount === 1 ? 'thing needs' : 'things need' }} a look</a>.
                @else
                    and nothing needs your attention.
                @endif
            </p>

            @if ($quickActions->isNotEmpty())
                <div class="ad-qa" role="group" aria-label="Quick actions">
                    @foreach ($quickActions as $action)
                        <a href="{{ $action['url'] }}" class="ad-qa-btn {{ $loop->first ? 'ad-qa-btn--primary' : '' }}">
                            <x-heroicon-o-plus class="ad-ico-sm" aria-hidden="true" />
                            {{ $action['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="ad-hero2-gauge">
            <svg viewBox="0 0 128 128" class="ad-ring" role="img" aria-label="{{ $summary['percent'] }}% of content is live">
                <circle cx="64" cy="64" r="{{ $radius }}" class="ad-ring-track" />
                <circle cx="64" cy="64" r="{{ $radius }}" class="ad-ring-fill"
                    stroke-dasharray="{{ round($dash, 2) }} {{ round($circumference, 2) }}"
                    transform="rotate(-90 64 64)" />
            </svg>
            <div class="ad-ring-center">
                <span class="ad-ring-value">{{ $summary['percent'] }}<small>%</small></span>
                <span class="ad-ring-label">live</span>
            </div>
        </div>

        <dl class="ad-hero2-stats">
            <div>
                <dt>Live items</dt>
                <dd>{{ $summary['live'] }}</dd>
            </div>
            <div>
                <dt>Unpublished</dt>
                <dd class="{{ $summary['drafts'] > 0 ? 'is-warn' : '' }}">{{ $summary['drafts'] }}</dd>
            </div>
            <div>
                <dt>Promotions running</dt>
                <dd>{{ $runningPromos }}</dd>
            </div>
        </dl>
    </section>
</x-filament::widget>
