@php
    $pct = fn (int $v) => $axisMax > 0 ? round($v / $axisMax * 100, 2) : 0;
@endphp
<x-filament::widget class="ad-dash-widget">
    <div>
    <section
        class="ad-card ad-inq ad-rise"
        style="--i: 11"
        aria-labelledby="ad-inq-title"
        x-data="{ hidden: {}, hover: null }"
    >
        <header class="ad-card-head">
            <div>
                <h3 id="ad-inq-title" class="ad-card-title">Website inquiries</h3>
                <p class="ad-card-sub">Form submissions per month · last 12 months</p>
            </div>
            <span class="ad-inq-total"><span class="ad-num">{{ number_format($grandTotal) }}</span> total</span>
        </header>

        {{-- Legend doubles as the per-type summary and a series toggle --}}
        <div class="ad-inq-legend" role="group" aria-label="Show or hide inquiry types">
            @foreach ($series as $s)
                <button
                    type="button"
                    class="ad-inq-key ad-series-{{ $s['key'] }}"
                    x-on:click="hidden['{{ $s['key'] }}'] = ! hidden['{{ $s['key'] }}']"
                    x-bind:class="{ 'is-off': hidden['{{ $s['key'] }}'] }"
                    x-bind:aria-pressed="(! hidden['{{ $s['key'] }}']).toString()"
                    aria-pressed="true"
                >
                    <span class="ad-inq-key-top">
                        <span class="ad-inq-swatch" aria-hidden="true"></span>
                        <span class="ad-inq-key-label">{{ $s['label'] }}</span>
                    </span>
                    <span class="ad-inq-key-value">
                        <span class="ad-num">{{ $s['current'] }}</span>
                        <small>{{ $currentMonth }} so far</small>
                    </span>
                    <span class="ad-inq-key-foot">
                        @if ($s['delta'] !== null)
                            <span class="ad-delta {{ $s['delta'] >= 0 ? 'is-up' : 'is-down' }}">
                                {{ $s['delta'] >= 0 ? '▲' : '▼' }} {{ abs($s['delta']) }}%
                            </span>
                            {{ $comparisonLabel }}
                        @else
                            {{ $s['previous'] }} {{ $comparisonLabel }}
                        @endif
                        <span class="ad-inq-key-sep">·</span>
                        <span class="ad-num">{{ $s['total'] }}</span> in 12 mo
                    </span>
                </button>
            @endforeach
        </div>

        {{-- Grouped bar chart --}}
        <div class="ad-chart-scroll">
            <div class="ad-chart" role="img" aria-label="Grouped bar chart of monthly sales, parts and service inquiries over the last 12 months. A data table follows.">
                <div class="ad-chart-grid" aria-hidden="true">
                    @foreach ($ticks as $tick)
                        <div class="ad-chart-gridline" style="bottom: {{ $pct($tick) }}%">
                            <span class="ad-num">{{ $tick }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="ad-chart-cols">
                    @foreach ($months as $i => $month)
                        <div
                            class="ad-chart-col {{ $month['isCurrent'] ? 'is-current' : '' }}"
                            style="--i: {{ $i }}"
                            x-on:mouseenter="hover = {{ $i }}"
                            x-on:mouseleave="hover = null"
                            x-bind:class="{ 'is-hover': hover === {{ $i }} }"
                        >
                            <div class="ad-chart-bars">
                                @foreach ($series as $s)
                                    <span
                                        class="ad-chart-bar ad-series-{{ $s['key'] }}"
                                        style="height: {{ $pct($s['values'][$i]) }}%"
                                        x-show="! hidden['{{ $s['key'] }}']"
                                    ></span>
                                @endforeach
                            </div>
                            <span class="ad-chart-x">{{ $month['short'] }}</span>

                            <div class="ad-chart-tip {{ $i >= count($months) - 3 ? 'is-left' : '' }}" x-show="hover === {{ $i }}" x-cloak>
                                <div class="ad-chart-tip-title">{{ $month['long'] }}@if ($month['isCurrent']) <span>· so far</span>@endif</div>
                                @foreach ($series as $s)
                                    <div class="ad-chart-tip-row ad-series-{{ $s['key'] }}" x-show="! hidden['{{ $s['key'] }}']">
                                        <span class="ad-inq-swatch" aria-hidden="true"></span>
                                        <span>{{ $s['label'] }}</span>
                                        <b class="ad-num">{{ $s['values'][$i] }}</b>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($grandTotal === 0)
                    <div class="ad-chart-empty">
                        <span class="ad-empty-icon"><x-heroicon-o-chart-bar aria-hidden="true" /></span>
                        <p><strong>No inquiries recorded yet.</strong></p>
                        <p>Sales, parts and service form submissions are counted from now on and will appear here.</p>
                    </div>
                @endif
            </div>
        </div>

        <details class="ad-chart-table">
            <summary>View as table</summary>
            <div class="ad-chart-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Month</th>
                            @foreach ($series as $s)
                                <th scope="col" class="is-num">{{ $s['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_reverse($months, true) as $i => $month)
                            <tr>
                                <th scope="row">{{ $month['long'] }}</th>
                                @foreach ($series as $s)
                                    <td class="is-num ad-num">{{ $s['values'][$i] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>
    </section>
    </div>
</x-filament::widget>
