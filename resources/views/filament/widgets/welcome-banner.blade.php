<x-filament::widget class="ad-hero-widget">
    <div class="ad-hero">
        <div class="ad-hero-id">
            <div class="ad-hero-avatar">{{ $initials }}</div>
            <div>
                <div class="ad-hero-greeting">{{ $greeting }}</div>
                <div class="ad-hero-name">{{ $name }}</div>
            </div>
        </div>

        <div class="ad-hero-meta">
            <div class="ad-hero-stat">
                <div class="ad-hero-stat-n">{{ $liveCount }}</div>
                <div class="ad-hero-stat-l">live items</div>
            </div>

            <div class="ad-hero-divider"></div>

            <div class="ad-hero-stat">
                <div class="ad-hero-stat-n {{ $attentionCount > 0 ? 'ad-hero-stat-n--warn' : '' }}">{{ $attentionCount }}</div>
                <div class="ad-hero-stat-l">needs attention</div>
            </div>

            <div class="ad-hero-divider"></div>

            <div class="ad-hero-stat">
                <div class="ad-hero-stat-n">{{ $today }}</div>
                <div class="ad-hero-stat-l">today</div>
            </div>

            <div class="ad-hero-divider"></div>

            <form action="{{ route('filament.auth.logout') }}" method="post">
                @csrf
                <button type="submit" class="ad-hero-signout">Sign out</button>
            </form>
        </div>
    </div>
</x-filament::widget>
