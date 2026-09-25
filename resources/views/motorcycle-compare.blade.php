@extends('layouts.litus')

@section('title', 'Compare Motorcycles - LITUS Automobiles')

@section('content')
@php
    $slugs = $selected->pluck('slug')->all();
    $slots = [$selected->get(0), $selected->get(1)];
    $both = $selected->count() > 1;

    // Category groups: defined groups first, then anything else the models carry.
    $definitions = collect(\App\Models\Motorcycle::specGroupDefinitions());
    $known = $definitions->flatMap(fn ($g) => $g['labels'])->all();
    $groups = $definitions
        ->map(fn ($g) => [
            'title' => $g['title'],
            'icon' => $g['icon'],
            'labels' => array_values(array_filter($g['labels'], fn ($l) => $labels->contains($l))),
        ])
        ->filter(fn ($g) => $g['labels'] !== [])
        ->values();
    $extra = $labels->reject(fn ($l) => in_array($l, $known, true))->values();
    if ($extra->isNotEmpty()) {
        $groups->push(['title' => 'Additional Details', 'icon' => 'clipboard-list', 'labels' => $extra->all()]);
    }

    $priceOf = fn ($m) => $m ? (($m->hasPromotion() && $m->discountAmount() > 0) ? $m->formattedSalePrice() : $m->formattedOriginalPrice()) : null;

    // Pre-compute rows so differences can be counted and filtered.
    $diffTotal = 0;
    $groups = $groups->map(function ($g) use ($slots, $both, &$diffTotal) {
        $g['rows'] = collect($g['labels'])->map(function ($label) use ($slots, $both, &$diffTotal) {
            $vals = array_map(fn ($m) => $m?->specValue($label), $slots);
            $differs = $both && ($vals[0] ?? null) !== ($vals[1] ?? null);
            $diffTotal += $differs ? 1 : 0;
            return ['label' => $label, 'vals' => $vals, 'differs' => $differs];
        })->all();
        return $g;
    });
@endphp

<div class="bg-litus-paper-2 font-sans" data-compare-page data-slugs='@json($slugs)'>
    <x-litus-header active="Motorcycles" />

    {{-- ================= STAGE ================= --}}
    <section class="relative overflow-hidden bg-litus-ink text-white" data-compare-stage>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 480px at 50% -10%, rgba(46,116,238,.34), transparent 65%),
                radial-gradient(600px 400px at 0% 100%, rgba(90,184,255,.12), transparent 60%),
                radial-gradient(600px 400px at 100% 100%, rgba(90,184,255,.12), transparent 60%);"></div>

        <div class="relative litus-container pb-6 pt-4 sm:pb-8 sm:pt-5">
            <nav class="mb-2 flex items-center justify-center gap-2 text-[11.5px] text-white/55" aria-label="Breadcrumb">
                <a href="{{ route('motorcycles') }}" class="transition hover:text-white">Motorcycles</a>
                <span aria-hidden="true">/</span>
                <span class="text-white/85">Compare</span>
            </nav>

            <div class="mx-auto mb-4 max-w-[760px] text-center sm:mb-5">
                <span class="mb-2 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/[0.06] px-3 py-1 text-[10.5px] font-bold uppercase tracking-[0.18em] text-litus-sky">
                    <span class="h-1.5 w-1.5 rounded-full bg-litus-sky"></span> Vehicle Comparison
                </span>
                <h1 class="font-display text-[clamp(22px,3vw,32px)] font-bold leading-[1.1] tracking-[-0.032em]">Find the right ride, side by side</h1>
                <p class="mt-1.5 text-[13.5px] leading-[1.55] text-white/65 sm:text-[14.5px]">Pick two models to compare price and specifications at a glance.</p>
            </div>

            <div class="mx-auto grid max-w-[980px] grid-cols-1 items-stretch gap-3 md:grid-cols-[1fr_auto_1fr] md:gap-4 lg:gap-5">
                @foreach ($slots as $i => $m)
                    @if ($i === 1)
                        <div class="relative z-10 flex items-center justify-center max-md:-my-5">
                            <span class="grid h-11 w-11 place-items-center rounded-full bg-litus-primary font-display text-[14px] font-extrabold tracking-tight text-white shadow-[0_0_0_5px_rgba(18,87,214,0.28),0_10px_24px_rgba(18,87,214,0.5)] md:h-12 md:w-12 md:text-[15px]">VS</span>
                        </div>
                    @endif

                    <article class="relative flex min-w-0 flex-col overflow-hidden rounded-[18px] border border-white/10 bg-white/[0.05] p-2.5 shadow-[0_18px_44px_rgba(0,0,0,0.35)] backdrop-blur-sm">
                        {{-- Image panel --}}
                        <div class="relative aspect-[8/5] w-full overflow-hidden rounded-xl {{ $m ? 'bg-[radial-gradient(ellipse_at_50%_35%,#ffffff_0%,#EEF1F6_55%,#DCE2EC_100%)]' : 'border-2 border-dashed border-white/20 bg-white/[0.04]' }}">
                            @if ($m)
                                @if ($m->hasPromotion() && $m->discountAmount() > 0)
                                    <span class="absolute left-3 top-3 z-10 rounded-full bg-litus-green px-3 py-1 text-[11px] font-bold text-white shadow">SAVE {{ $m->formattedDiscount() }}</span>
                                @endif
                                <a href="{{ route('motorcycle.show', $m->slug) }}" class="absolute inset-0 block" aria-label="View {{ $m->name }}">
                                    <img src="{{ $m->listImageUrl() }}" alt="{{ $m->name }}"
                                         class="absolute inset-0 h-full w-full origin-center scale-100 object-contain object-center p-2 drop-shadow-[0_16px_14px_rgba(7,19,43,0.28)] transition duration-500 hover:scale-[1.04] sm:p-4">
                                </a>
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-white/60">
                                    <span class="grid h-14 w-14 place-items-center rounded-full border border-white/25 text-[28px] font-light leading-none">+</span>
                                    <span class="text-[14px] font-medium">Add a motorcycle to compare</span>
                                </div>
                            @endif
                        </div>

                        {{-- Identity --}}
                        <div class="px-1 pb-0.5 pt-2.5 sm:px-1.5">
                            @if ($m)
                                <span class="block text-[11px] font-bold uppercase tracking-[0.16em] text-litus-sky">{{ trim(($m->brand ? $m->brand.' · ' : '').($m->category ?: 'Motorcycle')) }}</span>
                                <h2 class="mt-0.5 font-display text-[clamp(16px,1.7vw,20px)] font-bold leading-tight tracking-[-0.02em]">{{ $m->name }}</h2>
                                <div class="mt-0.5 flex flex-wrap items-baseline gap-x-2.5 gap-y-0">
                                    <span class="font-display text-[clamp(15px,1.5vw,18px)] font-extrabold">{{ $priceOf($m) }}</span>
                                    @if ($m->hasPromotion() && $m->discountAmount() > 0)
                                        <span class="text-[13px] text-white/50 line-through">{{ $m->formattedOriginalPrice() }}</span>
                                    @endif
                                </div>
                            @else
                                <span class="block text-[11px] font-bold uppercase tracking-[0.16em] text-white/45">Slot {{ $i + 1 }}</span>
                                <h2 class="mt-0.5 font-display text-[clamp(16px,1.7vw,20px)] font-bold leading-tight tracking-[-0.02em] text-white/60">Choose a model</h2>
                            @endif

                            {{-- Selector --}}
                            <div class="mt-2.5 flex items-center gap-2">
                                <div class="relative min-w-0 flex-1">
                                    <label class="sr-only" for="slot-{{ $i }}">{{ $m ? 'Change model' : 'Select motorcycle' }}</label>
                                    <select id="slot-{{ $i }}" data-compare-slot="{{ $i }}"
                                            class="min-h-10 w-full min-w-0 cursor-pointer appearance-none rounded-lg border border-white/20 bg-white px-3.5 pr-9 text-[13.5px] font-semibold text-litus-text shadow-sm transition hover:border-litus-sky focus:border-litus-sky focus:outline-none focus:ring-4 focus:ring-litus-sky/25 sm:text-[15px]">
                                        @unless ($m)
                                            <option value="">Select motorcycle…</option>
                                        @endunless
                                        @foreach ($all as $opt)
                                            @php $taken = $opt->slug !== ($m->slug ?? null) && in_array($opt->slug, $slugs, true); @endphp
                                            @unless ($taken)
                                                <option value="{{ $opt->slug }}" @selected($m && $opt->slug === $m->slug)>{{ $opt->name }}</option>
                                            @endunless
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-litus-text-2" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 8 5 5 5-5"/></svg>
                                </div>
                                @if ($m)
                                    <button type="button" data-compare-remove="{{ $i }}" aria-label="Remove {{ $m->name }}" title="Remove"
                                            class="grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-white/20 text-white/80 transition hover:border-[#FF6B6B] hover:bg-[#FF6B6B]/15 hover:text-white">
                                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= STICKY MINI BAR ================= --}}
    @if ($selected->isNotEmpty())
        <div class="pointer-events-none fixed inset-x-0 top-[62px] z-[150] -translate-y-3 opacity-0 transition duration-300 data-[on=true]:pointer-events-auto data-[on=true]:translate-y-0 data-[on=true]:opacity-100" data-compare-mini>
            <div class="litus-container">
                <div class="grid grid-cols-[1fr_1fr] gap-3 rounded-2xl border border-litus-line bg-white/95 px-4 py-2.5 shadow-[0_12px_32px_rgba(7,19,43,0.16)] backdrop-blur sm:grid-cols-[1fr_1.4fr_1.4fr] sm:gap-x-6 sm:px-5">
                    <span class="hidden items-center text-[11px] font-bold uppercase tracking-[0.16em] text-litus-text-2 sm:flex">Comparing</span>
                    @foreach ($slots as $m)
                        <div class="flex min-w-0 items-center gap-3">
                            @if ($m)
                                <img src="{{ $m->listImageUrl() }}" alt="" class="hidden h-10 w-14 shrink-0 object-contain sm:block">
                                <div class="min-w-0">
                                    <div class="truncate text-[13px] font-bold text-litus-text sm:text-[14px]">{{ $m->name }}</div>
                                    <div class="text-[12px] font-semibold text-litus-primary">{{ $priceOf($m) }}</div>
                                </div>
                            @else
                                <span class="text-[13px] text-litus-text-2">Add a model</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ================= SPECIFICATION ================= --}}
    <section class="litus-sec">
        <div class="litus-container">
            @if ($selected->isEmpty())
                <div class="mx-auto max-w-[520px] rounded-[22px] border border-dashed border-litus-line-2 bg-white px-6 py-14 text-center">
                    <span class="mx-auto mb-4 grid h-14 w-14 place-items-center rounded-full bg-litus-paper-3 text-litus-primary">
                        <x-litus-icon name="bike" class="h-7 w-7" />
                    </span>
                    <h3 class="font-display text-[20px] font-bold text-litus-text">Nothing to compare yet</h3>
                    <p class="mt-2 text-[14.5px] leading-relaxed text-litus-text-2">Choose a motorcycle above to see its price and full specification here.</p>
                </div>
            @else
                <div class="mb-5 flex flex-col gap-4 sm:mb-7 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="mb-2 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Specification</span>
                        <h2 class="font-display text-[clamp(22px,3.4vw,34px)] font-bold tracking-[-0.028em] text-litus-text">The details that matter</h2>
                    </div>

                    <div class="flex flex-wrap items-center gap-2.5">
                        @if ($both)
                            <label class="inline-flex min-h-10 cursor-pointer select-none items-center gap-2.5 rounded-full border border-litus-line-2 bg-white px-4 text-[13px] font-semibold text-litus-text transition hover:border-litus-primary">
                                <input type="checkbox" data-compare-diff class="peer sr-only">
                                <span class="relative h-5 w-9 rounded-full bg-litus-line-2 transition peer-checked:bg-litus-primary peer-focus-visible:ring-4 peer-focus-visible:ring-litus-primary/25 after:absolute after:left-0.5 after:top-0.5 after:h-4 after:w-4 after:rounded-full after:bg-white after:shadow after:transition peer-checked:after:translate-x-4"></span>
                                Differences only
                                <span class="rounded-full bg-litus-paper-3 px-2 py-0.5 text-[11px] font-bold text-litus-primary">{{ $diffTotal }}</span>
                            </label>
                        @endif
                        <button type="button" data-compare-toggle-all
                                class="inline-flex min-h-10 items-center rounded-full border border-litus-line-2 bg-white px-4 text-[13px] font-semibold text-litus-text transition hover:border-litus-primary hover:text-litus-primary">
                            Collapse all
                        </button>
                    </div>
                </div>

                {{-- Column heads (desktop) --}}
                <div class="hidden grid-cols-[1fr_1.4fr_1.4fr] gap-x-6 px-6 pb-2 sm:grid">
                    <span></span>
                    @foreach ($slots as $m)
                        <span class="truncate text-[12px] font-bold uppercase tracking-[0.14em] text-litus-text-2">{{ $m?->name ?? '—' }}</span>
                    @endforeach
                </div>

                {{-- Price card --}}
                <div class="mb-4 overflow-hidden rounded-2xl border border-litus-line bg-white shadow-[0_2px_10px_rgba(7,19,43,0.04)]">
                    <div class="grid grid-cols-2 items-start gap-x-3 px-4 py-5 sm:grid-cols-[1fr_1.4fr_1.4fr] sm:gap-x-6 sm:px-6">
                        <div class="col-span-2 mb-2 flex items-center gap-3 sm:col-span-1 sm:mb-0">
                            <span class="grid h-9 w-9 place-items-center rounded-[10px] bg-litus-paper-3 text-litus-primary"><x-litus-icon name="credit-card" class="h-[18px] w-[18px]" /></span>
                            <span class="text-[14px] font-bold uppercase tracking-wide text-litus-text">Price</span>
                        </div>
                        @foreach ($slots as $m)
                            <div class="min-w-0">
                                @if ($m)
                                    @if ($m->hasPromotion() && $m->discountAmount() > 0)
                                        <span class="block text-[12px] text-litus-text-2 line-through">{{ $m->formattedOriginalPrice() }}</span>
                                    @endif
                                    <div class="font-display text-[clamp(18px,2.4vw,26px)] font-extrabold tracking-[-0.02em] text-litus-text">{{ $priceOf($m) }}</div>
                                    <a href="{{ route('motorcycle.show', $m->slug) }}#enquire"
                                       class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-litus-primary px-3.5 py-1.5 text-[12px] font-semibold text-white transition hover:bg-litus-primary-hover">
                                        Enquire <x-litus-icon name="arrow-right" class="h-3 w-3" />
                                    </a>
                                @else
                                    <span class="text-litus-text-2">—</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Category accordions --}}
                <div class="space-y-4">
                    @foreach ($groups as $gi => $group)
                        <details class="group overflow-hidden rounded-2xl border border-litus-line bg-white shadow-[0_2px_10px_rgba(7,19,43,0.04)]" data-compare-group open>
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-4 py-4 transition hover:bg-litus-paper-2 sm:px-6 [&::-webkit-details-marker]:hidden">
                                <span class="flex min-w-0 items-center gap-3">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-[10px] bg-litus-primary text-white"><x-litus-icon :name="$group['icon']" class="h-[18px] w-[18px]" /></span>
                                    <span class="truncate font-display text-[16px] font-bold tracking-[-0.01em] text-litus-text sm:text-[18px]">{{ $group['title'] }}</span>
                                    <span class="hidden rounded-full bg-litus-paper-3 px-2.5 py-0.5 text-[11px] font-semibold text-litus-text-2 sm:inline">{{ count($group['rows']) }} items</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-litus-text-2 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 8 5 5 5-5"/></svg>
                            </summary>

                            <div class="border-t border-litus-line">
                                @foreach ($group['rows'] as $row)
                                    <div data-compare-row data-differs="{{ $row['differs'] ? '1' : '0' }}"
                                         class="grid grid-cols-2 gap-x-3 px-4 py-3.5 transition odd:bg-white even:bg-litus-paper-2/60 sm:grid-cols-[1fr_1.4fr_1.4fr] sm:gap-x-6 sm:px-6 {{ $row['differs'] ? '!bg-[#F1F6FF] shadow-[inset_3px_0_0_#1257D6]' : '' }}">
                                        <div class="col-span-2 mb-1 flex items-center gap-2 text-[12.5px] font-semibold text-litus-text-2 sm:col-span-1 sm:mb-0 sm:text-[14px]">
                                            {{ $row['label'] }}
                                            @if ($row['differs'])
                                                <span class="rounded-full bg-litus-primary/10 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-litus-primary">Differs</span>
                                            @endif
                                        </div>
                                        @foreach ($row['vals'] as $v)
                                            <div @class([
                                                'min-w-0 break-words text-[14px] sm:text-[15px]',
                                                'font-semibold text-litus-text' => filled($v),
                                                'text-litus-text-2' => blank($v),
                                            ])>{{ $v ?: '—' }}</div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @endforeach

                    <div class="hidden rounded-2xl border border-dashed border-litus-line-2 bg-white px-6 py-10 text-center text-[14.5px] text-litus-text-2" data-compare-empty>
                        These two models have identical specifications.
                    </div>
                </div>

                <div class="mt-6 rounded-r-[12px] border-l-4 border-litus-primary bg-[#EEF4FF] px-4 py-4 sm:px-6 sm:py-5">
                    <b class="mb-1 block text-[13.5px] text-litus-text sm:text-[14.5px]">Specifications shown are indicative</b>
                    <p class="m-0 text-[13px] leading-relaxed text-[#2A3548] sm:text-[14.5px]">Final specification varies by variant and colour. Our sales team confirms the exact specification of the unit you are buying.</p>
                </div>

                {{-- Bottom CTAs --}}
                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach ($slots as $m)
                        @continue(! $m)
                        <div class="flex items-center justify-between gap-4 rounded-2xl bg-litus-ink p-5 text-white">
                            <div class="min-w-0">
                                <div class="truncate font-display text-[17px] font-bold">{{ $m->name }}</div>
                                <div class="text-[13px] text-litus-sky">{{ $priceOf($m) }}</div>
                            </div>
                            <a href="{{ route('motorcycle.show', $m->slug) }}#enquire"
                               class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-litus-primary px-5 py-3 text-[13.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                                Reserve <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    @endforeach
                </div>
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

        root.querySelectorAll('[data-compare-slot]').forEach(function (sel) {
            sel.addEventListener('change', function () {
                var next = slugs.slice();
                next[parseInt(sel.getAttribute('data-compare-slot'), 10)] = sel.value;
                go(next);
            });
        });
        root.querySelectorAll('[data-compare-remove]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var i = parseInt(btn.getAttribute('data-compare-remove'), 10);
                go(slugs.filter(function (_, idx) { return idx !== i; }));
            });
        });

        // Sticky mini bar once the stage scrolls out of view.
        var stage = root.querySelector('[data-compare-stage]');
        var mini = root.querySelector('[data-compare-mini]');
        if (stage && mini && 'IntersectionObserver' in window) {
            new IntersectionObserver(function (entries) {
                mini.setAttribute('data-on', entries[0].isIntersecting ? 'false' : 'true');
            }, { rootMargin: '-120px 0px 0px 0px', threshold: 0 }).observe(stage);
        }

        // Differences-only filter.
        var groups = root.querySelectorAll('[data-compare-group]');
        var empty = root.querySelector('[data-compare-empty]');
        var diff = root.querySelector('[data-compare-diff]');
        if (diff) {
            diff.addEventListener('change', function () {
                var only = diff.checked, anyVisible = false;
                groups.forEach(function (g) {
                    var visible = 0;
                    g.querySelectorAll('[data-compare-row]').forEach(function (r) {
                        var hide = only && r.getAttribute('data-differs') !== '1';
                        r.classList.toggle('hidden', hide);
                        if (!hide) visible++;
                    });
                    g.classList.toggle('hidden', visible === 0);
                    if (visible) anyVisible = true;
                });
                if (empty) empty.classList.toggle('hidden', anyVisible || !only);
            });
        }

        // Expand / collapse all.
        var toggle = root.querySelector('[data-compare-toggle-all]');
        if (toggle) {
            toggle.addEventListener('click', function () {
                var open = Array.prototype.some.call(groups, function (g) { return g.open; });
                groups.forEach(function (g) { g.open = !open; });
                toggle.textContent = open ? 'Expand all' : 'Collapse all';
            });
        }
    })();
</script>
@endsection
