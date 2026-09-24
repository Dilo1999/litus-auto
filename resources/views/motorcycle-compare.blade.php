@extends('layouts.litus')

@section('title', 'Compare Motorcycles - LITUS Automobiles')

@section('content')
@php
    $slugs = $selected->pluck('slug')->all();
    $slots = [$selected->get(0), $selected->get(1)];

    // Category groups: defined groups first, then anything else the models carry.
    $definitions = collect(\App\Models\Motorcycle::specGroupDefinitions());
    $known = $definitions->flatMap(fn ($g) => $g['labels'])->all();
    $groups = $definitions
        ->map(fn ($g) => ['title' => $g['title'], 'labels' => array_values(array_filter($g['labels'], fn ($l) => $labels->contains($l)))])
        ->filter(fn ($g) => $g['labels'] !== [])
        ->values();
    $extra = $labels->reject(fn ($l) => in_array($l, $known, true))->values();
    if ($extra->isNotEmpty()) {
        $groups->push(['title' => 'Additional Details', 'labels' => $extra->all()]);
    }

    $priceOf = fn ($m) => $m ? (($m->hasPromotion() && $m->discountAmount() > 0) ? $m->formattedSalePrice() : $m->formattedOriginalPrice()) : null;
@endphp

<div class="font-sans" data-compare-page data-slugs='@json($slugs)'>
    <x-litus-header active="Motorcycles" />

    {{-- VS stage --}}
    <section class="border-b border-litus-line bg-[#EEEFF1]">
        <div class="litus-container py-8 sm:py-12 lg:py-14">
            <div class="mb-6 text-center sm:mb-9">
                <span class="mb-2 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Vehicle Comparison</span>
                <h1 class="font-display text-[clamp(24px,4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Compare two models</h1>
            </div>

            <div class="grid grid-cols-[1fr_auto_1fr] items-start gap-2 sm:gap-6 lg:gap-10">
                @foreach ($slots as $i => $m)
                    @if ($i === 1)
                        <div class="self-center pt-0 font-display text-[clamp(22px,4vw,44px)] font-bold tracking-tight text-litus-primary sm:pb-16">VS</div>
                    @endif

                    <div class="flex min-w-0 flex-col items-center">
                        <div class="relative aspect-[16/10] w-full overflow-hidden rounded-2xl {{ $m ? 'bg-gradient-to-b from-white to-[#E4E6EA]' : 'bg-[#DEDEDE]' }}">
                            @if ($m)
                                <a href="{{ route('motorcycle.show', $m->slug) }}" class="absolute inset-0 block">
                                    <img src="{{ $m->listImageUrl() }}" alt="{{ $m->name }}" class="absolute inset-0 h-full w-full object-contain object-center p-4 drop-shadow-[0_14px_16px_rgba(0,0,0,0.22)] sm:p-8">
                                </a>
                            @else
                                <x-litus-icon name="bike" class="absolute left-1/2 top-1/2 h-1/2 w-1/2 -translate-x-1/2 -translate-y-1/2 text-[#C4C4C4]" />
                            @endif
                        </div>

                        <div class="mt-4 flex w-full max-w-[420px] items-center gap-2">
                            <label class="sr-only" for="slot-{{ $i }}">{{ $m ? 'Change model' : 'Select motorcycle' }}</label>
                            <select id="slot-{{ $i }}" data-compare-slot="{{ $i }}"
                                    class="min-h-11 min-w-0 flex-1 rounded-lg border border-litus-line-2 bg-white px-3 text-[14px] font-semibold text-litus-text shadow-sm focus:border-litus-primary focus:outline-none focus:ring-2 focus:ring-litus-primary/25 sm:text-[15px]">
                                @unless ($m)
                                    <option value="">Select Motorcycle</option>
                                @endunless
                                @foreach ($all as $opt)
                                    @php $taken = $opt->slug !== ($m->slug ?? null) && in_array($opt->slug, $slugs, true); @endphp
                                    @unless ($taken)
                                        <option value="{{ $opt->slug }}" @selected($m && $opt->slug === $m->slug)>{{ $opt->name }}</option>
                                    @endunless
                                @endforeach
                            </select>
                            @if ($m)
                                <button type="button" data-compare-remove="{{ $i }}" aria-label="Remove {{ $m->name }}" title="Remove"
                                        class="grid h-11 w-11 shrink-0 place-items-center rounded-lg border border-litus-line-2 bg-white text-[18px] leading-none text-litus-text-2 transition hover:border-litus-primary hover:text-litus-primary">&times;</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Specification --}}
    <section class="litus-sec">
        <div class="litus-container">
            <h2 class="mb-5 font-display text-[clamp(20px,3vw,28px)] font-bold uppercase tracking-[-0.01em] text-litus-text">Specification</h2>

            @if ($selected->isEmpty())
                <div class="rounded-2xl border border-dashed border-litus-line-2 px-6 py-12 text-center text-litus-text-2">
                    Select a motorcycle above to start comparing.
                </div>
            @else
                {{-- Price --}}
                <div class="grid grid-cols-[1fr_1fr] items-start gap-x-3 border-b border-litus-line py-5 sm:grid-cols-[1fr_1.4fr_1.4fr] sm:gap-x-6">
                    <div class="col-span-2 mb-1 text-[13px] font-semibold uppercase tracking-wide text-litus-text-2 sm:col-span-1 sm:mb-0 sm:pt-1 sm:text-sm">Price</div>
                    @foreach ($slots as $m)
                        <div class="min-w-0">
                            @if ($m)
                                @if ($m->hasPromotion() && $m->discountAmount() > 0)
                                    <span class="block text-xs text-litus-text-2 line-through">{{ $m->formattedOriginalPrice() }}</span>
                                @endif
                                <div class="font-display text-[clamp(17px,2.4vw,24px)] font-extrabold text-litus-text">{{ $priceOf($m) }}</div>
                                <a href="{{ route('motorcycle.show', $m->slug) }}#enquire" class="mt-1 inline-flex items-center gap-1 text-[11.5px] font-bold uppercase tracking-wide text-litus-primary hover:underline">
                                    Enquire <x-litus-icon name="arrow-right" class="h-3 w-3" />
                                </a>
                            @else
                                <span class="text-litus-text-2">—</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Category accordions --}}
                <div class="mt-6 space-y-3.5">
                    @foreach ($groups as $gi => $group)
                        <details class="group overflow-hidden rounded-xl border border-litus-line bg-white" @if ($gi === 0) open @endif>
                            <summary class="flex cursor-pointer list-none items-center justify-between bg-litus-primary px-4 py-3.5 font-display text-[15px] font-bold uppercase tracking-wide text-white transition hover:bg-litus-primary-hover sm:px-5 sm:py-4 sm:text-[17px] [&::-webkit-details-marker]:hidden">
                                {{ $group['title'] }}
                                <svg class="h-5 w-5 shrink-0 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 8 5 5 5-5"/></svg>
                            </summary>
                            <div>
                                @foreach ($group['labels'] as $ri => $label)
                                    @php
                                        $vals = array_map(fn ($m) => $m?->specValue($label), $slots);
                                        $differs = $selected->count() > 1 && ($vals[0] ?? null) !== ($vals[1] ?? null);
                                    @endphp
                                    <div @class([
                                        'grid grid-cols-2 gap-x-3 border-t border-litus-line px-4 py-3.5 first:border-t-0 sm:grid-cols-[1fr_1.4fr_1.4fr] sm:gap-x-6 sm:px-5',
                                        'bg-[#F3F7FF]' => $differs,
                                    ])>
                                        <div class="col-span-2 mb-1 text-[12.5px] font-semibold text-litus-text-2 sm:col-span-1 sm:mb-0 sm:text-sm">{{ $label }}</div>
                                        @foreach ($vals as $v)
                                            <div class="min-w-0 break-words text-[14px] font-semibold text-litus-text sm:text-[15px]">{{ $v ?: '—' }}</div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </div>

                @if ($selected->count() > 1)
                    <p class="mt-4 flex items-center gap-2 text-[12.5px] text-litus-text-2">
                        <span class="inline-block h-3 w-3 rounded-sm bg-[#F3F7FF] ring-1 ring-litus-line-2"></span> Highlighted rows show where the two models differ.
                    </p>
                @endif
                <p class="mt-3 text-[13px] text-litus-text-2">Specifications shown are indicative. Our sales team confirms the exact specification of the unit you are buying.</p>
            @endif
        </div>
    </section>

    <x-litus-footer />
</div>

<script>
    (function () {
        var KEY = 'litus-compare';
        var root = document.querySelector('[data-compare-page]');
        var slugs = JSON.parse(root.getAttribute('data-slugs') || '[]');
        var base = @json(route('motorcycles.compare'));

        // Empty URL selection: restore from storage; otherwise persist the URL selection.
        try {
            if (!slugs.length) {
                var stored = JSON.parse(localStorage.getItem(KEY) || '[]');
                if (stored.length) { window.location.replace(base + '?models=' + encodeURIComponent(stored.slice(0, 2).join(','))); return; }
            } else {
                localStorage.setItem(KEY, JSON.stringify(slugs));
            }
        } catch (e) {}

        function go(list) {
            list = list.filter(Boolean);
            try { localStorage.setItem(KEY, JSON.stringify(list)); } catch (e) {}
            window.location.href = list.length ? base + '?models=' + encodeURIComponent(list.join(',')) : base;
        }

        document.querySelectorAll('[data-compare-slot]').forEach(function (sel) {
            sel.addEventListener('change', function () {
                var i = parseInt(sel.getAttribute('data-compare-slot'), 10);
                var next = slugs.slice();
                next[i] = sel.value;
                go(next);
            });
        });
        document.querySelectorAll('[data-compare-remove]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var i = parseInt(btn.getAttribute('data-compare-remove'), 10);
                go(slugs.filter(function (_, idx) { return idx !== i; }));
            });
        });
    })();
</script>
@endsection
