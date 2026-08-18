@extends('layouts.litus')

@section('title', 'Promotions - LITUS Automobiles')

@section('content')
@php
    $promotions = $promotions ?? collect();
    $brands = $brands ?? collect();
    $featured = $featured ?? null;
    $stats = $stats ?? [
        'campaignCount' => 0,
        'maxSave' => 0,
        'minPrice' => 0,
        'formattedMaxSave' => 'MVR 0',
        'formattedMinPrice' => 'MVR 0',
    ];
    $count = $promotions->count();

    $heroStrip = [
        ['icon' => 'clock', 'title' => 'Dated & Verified', 'sub' => 'Every campaign shows its saving clearly'],
        ['icon' => 'map-pin', 'title' => 'By Showroom', 'sub' => 'Ask us where stock is available'],
        ['icon' => 'shield', 'title' => 'Ijara Eligible', 'sub' => 'Most campaigns work on a plan'],
        ['icon' => 'file-text', 'title' => 'No Fine Print', 'sub' => 'Terms written in plain language'],
    ];

    $steps = [
        ['title' => 'Pick your campaign and model', 'text' => 'Open any live campaign, check the motorcycle it covers, and note the offer details. That tells our team exactly which promotion you mean.'],
        ['title' => 'Talk to our team', 'text' => 'Call, WhatsApp or send the form. If you are buying on an Ijara plan we confirm the documents you need and start your approval the same day.'],
        ['title' => 'Collect at your showroom', 'text' => 'Complete payment or sign your plan, and collect from whichever showroom has the stock for that model.'],
    ];

    $faqs = [
        [
            'q' => 'General campaign terms',
            'a' => '<ul class="mt-2 grid list-disc gap-2 pl-5"><li>All campaign prices are in Maldivian Rufiyaa and include applicable taxes unless stated otherwise.</li><li>Campaigns run while stock lasts, or until the offer is withdrawn and published on this page.</li><li>A campaign applies only to the motorcycles listed with an active promotion.</li><li>One campaign applies per motorcycle. Campaigns cannot be combined unless stated.</li><li>Registration, insurance and accessories are not included unless listed as part of the offer.</li></ul>',
            'open' => true,
        ],
        [
            'q' => 'Terms for Ijara ownership offers',
            'a' => '<ul class="mt-2 grid list-disc gap-2 pl-5"><li>Ijara Plans are structured to Islamic leasing standards. The total lease price is fixed and agreed in writing before you sign.</li><li>Promotional prices reduce the amount your plan is calculated from.</li><li>All applications are subject to assessment and the supporting documents required for your chosen plan.</li><li>Figures shown on this site, including the monthly estimator, are illustrations rather than quotations.</li><li>Early settlement is available on all plans at no additional charge.</li></ul>',
        ],
        [
            'q' => 'Can I use a campaign with an Ijara plan?',
            'a' => '<p>Yes on most campaigns. A price campaign reduces the amount your plan is calculated from, so your monthly amount drops too. If something is cash-only, our sales team will tell you before you commit.</p>',
        ],
        [
            'q' => 'Is the campaign available at my island’s showroom?',
            'a' => '<p>Stock is allocated separately across our showrooms. Contact us with the model you want and we will confirm where it is available. If a transfer is needed, we will tell you the timing and any cost upfront.</p>',
        ],
        [
            'q' => 'Can I reserve a motorcycle before a campaign ends?',
            'a' => '<p>Yes. Contact the sales team with the model you want and we can hold the unit for a short period while your payment or plan application is completed. Reservation terms are confirmed by the team at the time.</p>',
        ],
    ];
@endphp

<div class="font-sans" data-promotions-page>

    <x-litus-header active="Promotions" />

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-litus-ink text-white">
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.34), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.16), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.9) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.42]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(48px,6.5vw,88px)] pb-[clamp(40px,5vw,68px)]">
            <div class="grid items-stretch gap-10 max-[960px]:grid-cols-1 max-[960px]:gap-8 min-[961px]:grid-cols-[1.06fr_0.94fr]">
                <div class="flex flex-col justify-center">
                    <span class="mb-4 inline-flex w-fit max-w-full items-center gap-2.5 rounded-full border border-white/16 bg-white/[0.08] px-4 py-2 text-[12.5px] font-semibold">
                        <span class="litus-live-dot h-[7px] w-[7px] shrink-0 rounded-full bg-[#3DDC84] shadow-[0_0_0_0_rgba(61,220,132,0.7)]" aria-hidden="true"></span>
                        {{ $count }} campaign{{ $count === 1 ? '' : 's' }} running now · Updated {{ now()->format('j M Y') }}
                    </span>
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Ongoing Promotions</span>
                    <h1 class="font-display text-[clamp(30px,4.2vw,50px)] font-bold leading-[1.08] tracking-[-0.032em]">
                        Real offers.<br>Real savings. <span class="text-litus-sky">Right now.</span>
                    </h1>
                    <p class="mt-4 max-w-[540px] text-[clamp(16px,1.4vw,18px)] leading-[1.66] text-white/[0.72]">
                        Every live campaign from LITUS in one place. Open a model to see the campaign price, how much you save, and how to reserve it.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="#offers"
                           class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-[15px] text-[15px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                            Browse All Campaigns
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                        <a href="#alerts"
                           class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-[15px] text-[15px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                            Get Alerts on WhatsApp
                        </a>
                    </div>
                </div>

                @if ($count > 0)
                    <div class="relative flex min-h-[440px] h-full flex-col justify-end overflow-hidden rounded-[22px] border border-white/14 shadow-[0_4px_10px_rgba(9,17,32,.08),0_34px_70px_rgba(9,17,32,.16)] max-[960px]:min-h-[380px]"
                         style="background: linear-gradient(155deg, #061029 0%, #0E2A64 48%, #1B49B8 100%);"
                         data-promo-hero-slider
                         data-interval="4200">
                        <div class="pointer-events-none absolute inset-0"
                             style="background:
                                radial-gradient(480px 300px at 72% 20%, rgba(90,184,255,.36), transparent 62%),
                                linear-gradient(180deg, rgba(6,16,41,.08) 0%, rgba(6,16,41,.35) 42%, rgba(6,16,41,.92) 100%);"></div>

                        <div class="absolute left-6 top-6 z-[4] font-display text-[13px] font-bold tracking-[0.24em] text-white min-[961px]:left-7 min-[961px]:top-7">
                            LITUS<span class="mt-[-2px] block text-[7px] font-medium tracking-[0.36em] text-white/60">AUTOMOBILES</span>
                        </div>

                        <div class="relative z-[2] flex min-h-[280px] flex-1 items-center justify-center px-3 pt-16 max-[960px]:min-h-[240px]">
                            @foreach ($promotions as $index => $model)
                                <img src="{{ $model->listImageUrl() }}"
                                     alt="{{ $model->name }}"
                                     data-promo-hero-slide
                                     data-name="{{ $model->name }}"
                                     data-discount="{{ $model->formattedDiscount() }}"
                                     data-sale="{{ $model->formattedSalePrice() }}"
                                     @class([
                                         'absolute mx-auto max-h-[400px] w-[108%] object-contain drop-shadow-[0_28px_32px_rgba(0,0,0,0.45)] transition-opacity duration-700 max-[960px]:max-h-[300px]',
                                         'z-[1] opacity-100' => $index === 0,
                                         'z-0 opacity-0' => $index !== 0,
                                     ])
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                            @endforeach
                        </div>

                        <div class="relative z-[3] px-6 pb-6 pt-2 min-[961px]:px-7 min-[961px]:pb-7">
                            <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-litus-sky">Limited time campaign</span>

                            <div class="mt-2 flex flex-wrap items-end justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="font-display text-[clamp(22px,2.4vw,30px)] font-extrabold leading-none tracking-[-0.03em]"
                                       data-promo-hero-name>{{ $featured->name }}</p>
                                    <p class="mt-1.5 text-[13px] font-semibold text-white/70">
                                        From <span data-promo-hero-sale>{{ $featured->formattedSalePrice() }}</span>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10.5px] font-semibold uppercase tracking-[0.12em] text-white/55">You save</span>
                                    <span class="font-display text-[clamp(22px,2.4vw,30px)] font-extrabold tracking-[-0.03em]"
                                          data-promo-hero-saving>{{ $featured->formattedDiscount() }}</span>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-white/16 pt-3.5">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-white/45">
                                    {{ $count }} models · All showrooms
                                </p>

                                @if ($count > 1)
                                    <div class="flex gap-1.5">
                                        @foreach ($promotions as $index => $model)
                                            <button type="button"
                                                    data-promo-hero-dot="{{ $index }}"
                                                    aria-label="Show {{ $model->name }}"
                                                    @class([
                                                        'h-1.5 rounded-full transition-all duration-300',
                                                        'w-5 bg-white' => $index === 0,
                                                        'w-1.5 bg-white/50' => $index !== 0,
                                                    ])></button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="relative flex min-h-[360px] h-full flex-col justify-end overflow-hidden rounded-[22px] border border-white/14 p-6 shadow-[0_4px_10px_rgba(9,17,32,.08),0_34px_70px_rgba(9,17,32,.16)] min-[961px]:p-7"
                         style="background: linear-gradient(155deg, #061029 0%, #0E2A64 48%, #1B49B8 100%);">
                        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(420px_260px_at_68%_18%,rgba(90,184,255,.34),transparent_66%)]"></div>
                        <div class="relative z-[2]">
                            <div class="font-display text-[13px] font-bold tracking-[0.24em] text-white">LITUS<span class="mt-[-2px] block text-[7px] font-medium tracking-[0.36em] text-white/60">AUTOMOBILES</span></div>
                            <span class="mt-5 block text-[11.5px] font-bold uppercase tracking-[0.16em] text-litus-sky">Limited time campaign</span>
                            <div class="mt-2.5 font-display text-[clamp(26px,2.8vw,36px)] font-extrabold leading-[1.05] tracking-[-0.03em]">
                                Live offers<br>this month
                            </div>
                            <p class="mt-2.5 text-sm text-white/70">Check back soon for new campaigns</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/26">
            <div class="litus-container grid grid-cols-1 gap-4 py-[22px] sm:grid-cols-2 lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroStrip as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div>
                            <b class="block text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
                            <span class="block text-[12.5px] leading-snug text-white/60">{{ $item['sub'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ABOUT + GLANCE --}}
    <section class="litus-sec">
        <div class="litus-container grid grid-cols-1 gap-14 min-[1000px]:grid-cols-[1.35fr_0.65fr] min-[1000px]:gap-14">
            <div>
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">About Our Promotions</span>
                <h2 class="mb-6 font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">
                    How our campaigns work, and why we tell you when they end
                </h2>
                <div class="max-w-[720px] text-[16.5px] leading-[1.78] text-[#26324A]">
                    <p class="mb-[17px]">
                        <strong class="font-semibold text-litus-text">We do not run promotions on single motorcycles. We run named campaigns, and each campaign covers a group of bikes.</strong>
                        The 2 Payment Plan covers six models. The August Price Drop covers five. Some campaigns, like our Ijara advance reduction, cover every motorcycle we have in stock.
                    </p>
                    <p class="mb-[17px]">
                        That means the question is never just “is this bike on offer?” but “which campaign is it in, and what does that campaign give me?” Every campaign page on this site answers both: it lists the exact motorcycles included, the price of each one under that campaign, and precisely how the campaign works - the payment structure, whether a guarantor is needed, what is waived, and what is not.
                    </p>

                    <h3 class="mb-3 mt-8 font-display text-[23px] font-bold tracking-[-0.028em] text-litus-text">Why every campaign carries a real end date</h3>
                    <p class="mb-[17px]">
                        A “limited offer” badge that never expires is not a limited offer, and after a few months customers stop believing it. So every campaign we publish carries a real closing date. When that date passes, the campaign comes down and prices return to normal. We do not quietly extend a campaign and re-run it the following month under a new name.
                    </p>
                    <p class="mb-[17px]">
                        Our campaigns come from three places: stock that has arrived ahead of schedule, model-year changeovers where we would rather clear the outgoing units, and seasonal campaigns around Ramadan, Eid and the school year. We will always tell you which kind you are looking at.
                    </p>

                    <h3 class="mb-3 mt-8 font-display text-[23px] font-bold tracking-[-0.028em] text-litus-text">Campaigns and Ijara plans work together</h3>
                    <p class="mb-[17px]">
                        A price campaign reduces the amount your ownership plan is calculated from - so if you buy on an Ijara plan, the saving reaches you as a lower monthly amount rather than a lower lump sum. You are not penalised for paying monthly. Our plan campaigns work the other way round: they change the terms rather than the price, and most of them stack with a price campaign on the same bike.
                    </p>

                    <h3 class="mb-3 mt-8 font-display text-[23px] font-bold tracking-[-0.028em] text-litus-text">One campaign per motorcycle</h3>
                    <p class="mb-[17px]">
                        A motorcycle can appear in several campaigns at once, but only one applies to your purchase. Where you have a choice, our team will work out which leaves you better off on the model you want - and tell you, even when it is the one that earns us less.
                    </p>

                    <h3 class="mb-3 mt-8 font-display text-[23px] font-bold tracking-[-0.028em] text-litus-text">Campaigns differ by showroom</h3>
                    <p>
                        We hold stock separately at Malé, Hulhumalé, Hithadhoo, Fuvahmulah and L. Fonadhoo, and a campaign only applies where the stock actually is. Use the showroom filter below to see what you can act on near you. If something you want is on another island, contact us - a transfer is usually possible, and we will tell you the cost and timing upfront rather than after you have committed.
                    </p>
                </div>
            </div>

            <aside class="min-[1000px]:sticky min-[1000px]:top-[96px] min-[1000px]:self-start">
                <div class="rounded-[26px] border border-litus-line bg-white p-[26px] shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                    <h4 class="mb-4 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">This month at a glance</h4>
                    <div class="divide-y divide-litus-line text-[14.5px]">
                        <div class="flex justify-between gap-4 py-3.5"><span class="text-litus-text-2">Live campaigns</span><b class="text-litus-text">{{ $stats['campaignCount'] }}</b></div>
                        <div class="flex justify-between gap-4 py-3.5"><span class="text-litus-text-2">Motorcycles on offer</span><b class="text-litus-text">{{ $count }}</b></div>
                        <div class="flex justify-between gap-4 py-3.5"><span class="text-litus-text-2">Biggest saving</span><b class="text-litus-green">{{ $stats['formattedMaxSave'] }}</b></div>
                        <div class="flex justify-between gap-4 py-3.5"><span class="text-litus-text-2">Campaign prices from</span><b class="text-litus-text">{{ $stats['formattedMinPrice'] }}</b></div>
                        <div class="flex justify-between gap-4 py-3.5"><span class="text-litus-text-2">Ijara eligible</span><b class="text-litus-text">Most models</b></div>
                    </div>
                    <a href="#offers"
                       class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-ink px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-litus-ink-700">
                        Jump to Campaigns
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>
                <div class="mt-[22px] rounded-r-[12px] border-l-4 border-litus-teal bg-[#E6F6F3] px-6 py-5">
                    <b class="mb-1.5 block text-[14.5px] text-litus-text">Prices you can trust</b>
                    <p class="m-0 text-[14.5px] text-[#2A3548]">
                        Every “was” price on this page is the price we were genuinely selling at before the promotion. We do not inflate a price in order to advertise a bigger discount.
                    </p>
                </div>
            </aside>
        </div>
    </section>

    {{-- FEATURED --}}
    @if ($featured && $count > 0)
        @php
            $campaignStarts = $campaign?->starts_at ?? $campaign?->created_at ?? now();
            $campaignEnds = $campaign?->ends_at;
        @endphp
        <section class="litus-sec-tight bg-litus-paper-2">
            <div class="litus-container">
                <div class="relative grid overflow-hidden rounded-[34px] text-white shadow-[0_4px_10px_rgba(9,17,32,.08),0_34px_70px_rgba(9,17,32,.16)] max-[940px]:grid-cols-1 min-[941px]:grid-cols-[1.08fr_0.92fr]"
                     style="background: linear-gradient(115deg, #0B1526, #1B3260 58%, #1D4CBB);">
                    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(600px_340px_at_76%_6%,rgba(90,184,255,.3),transparent_62%)]"></div>

                    <div class="relative z-[3] p-[clamp(30px,4vw,52px)]"
                         data-promo-campaign-copy>
                        <span class="inline-block rounded-md bg-[#F2ECFF] px-[11px] py-1.5 text-[10.5px] font-extrabold uppercase tracking-[0.08em] text-[#6941C6]">★ Campaign of the Month</span>
                        <h3 class="mt-4 font-display text-[clamp(20px,2.6vw,30px)] font-bold tracking-[-0.028em]"
                            data-promo-campaign-title>{{ $featured->name }}</h3>
                        <p class="mt-3 max-w-[520px] text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.76]"
                           data-promo-campaign-note>
                            {{ $featured->offerNote() ?: 'Limited-time campaign pricing on this model. Save now and ride sooner on cash or Ijara terms.' }}
                        </p>

                        <div class="mt-6 flex flex-wrap items-baseline gap-3.5">
                            <span class="font-display text-[48px] font-extrabold tracking-[-0.035em]"
                                  data-promo-campaign-saving>
                                Save {{ $featured->formattedDiscount() }}
                            </span>
                        </div>

                        <div class="mb-1.5 mt-2 flex flex-wrap gap-2" data-promo-campaign-chips>
                            @foreach ($promotions as $index => $model)
                                <button type="button"
                                        data-promo-campaign-chip="{{ $index }}"
                                        data-name="{{ $model->name }}"
                                        data-note="{{ $model->offerNote() ?: 'Limited-time campaign pricing on this model. Save now and ride sooner on cash or Ijara terms.' }}"
                                        data-discount="{{ $model->formattedDiscount() }}"
                                        data-sale="{{ $model->formattedSalePrice() }}"
                                        class="rounded-md px-2.5 py-1.5 text-[11.5px] font-semibold transition {{ $index === 0 ? 'bg-white text-litus-ink' : 'bg-white/12 text-white/88 hover:bg-white/20' }}">
                                    {{ $model->name }}
                                </button>
                            @endforeach
                        </div>

                        <p class="mt-2.5 text-[15px] font-semibold text-litus-sky">
                            {{ $count }} motorcycle{{ $count === 1 ? '' : 's' }} included · campaign prices from {{ $stats['formattedMinPrice'] }}
                        </p>

                        @if ($campaignEnds)
                            <div class="my-[26px] flex flex-wrap gap-[11px]"
                                 data-promo-countdown
                                 data-ends-at="{{ $campaignEnds->toIso8601String() }}">
                                @foreach (['Days', 'Hours', 'Mins', 'Secs'] as $i => $label)
                                    <div class="min-w-[70px] rounded-xl border border-white/17 bg-white/10 px-1.5 py-[11px] text-center">
                                        <b class="block font-display text-[25px] font-bold leading-none" data-cd="{{ $i }}">--</b>
                                        <span class="text-[9.5px] uppercase tracking-[0.13em] text-white/60">{{ $label }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex flex-wrap gap-3">
                            <a href="#offers"
                               class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                                See All {{ $count }} Models
                                <x-litus-icon name="arrow-right" class="h-4 w-4" />
                            </a>
                            <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, I want to reserve the '.$featured->name.' campaign offer.') }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               data-promo-campaign-wa
                               class="inline-flex items-center justify-center gap-2 rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                                <x-litus-icon name="message-circle" class="h-4 w-4" />
                                Reserve on WhatsApp
                            </a>
                        </div>
                        <p class="mt-[18px] text-xs text-white/50">
                            @if ($campaignEnds)
                                Campaign valid {{ $campaignStarts->format('j M Y') }} to {{ $campaignEnds->format('j M Y') }}. Subject to assessment and stock.
                            @else
                                Campaign started {{ $campaignStarts->format('j M Y') }}. Subject to assessment and stock.
                            @endif
                        </p>
                    </div>

                    <div class="relative z-[3] flex min-h-[480px] flex-col justify-end overflow-hidden bg-black/[0.22] max-[940px]:order-first max-[940px]:min-h-[400px]"
                         data-promo-campaign-slider
                         data-interval="4000">
                        <div class="pointer-events-none absolute inset-0"
                             style="background:
                                radial-gradient(520px 340px at 70% 18%, rgba(90,184,255,.28), transparent 62%),
                                linear-gradient(180deg, rgba(6,16,41,.15) 0%, rgba(6,16,41,.55) 48%, rgba(6,16,41,.92) 100%);"></div>

                        <div class="relative z-[2] flex min-h-[320px] flex-1 items-center justify-center px-2 pt-6 max-[940px]:min-h-[260px]">
                            @foreach ($promotions as $index => $model)
                                <img src="{{ $model->listImageUrl() }}"
                                     alt="{{ $model->name }}"
                                     data-promo-campaign-slide
                                     data-name="{{ $model->name }}"
                                     data-note="{{ $model->offerNote() ?: 'Limited-time campaign pricing on this model. Save now and ride sooner on cash or Ijara terms.' }}"
                                     data-discount="{{ $model->formattedDiscount() }}"
                                     data-sale="{{ $model->formattedSalePrice() }}"
                                     @class([
                                         'absolute mx-auto max-h-[560px] w-[118%] object-contain drop-shadow-[0_28px_30px_rgba(0,0,0,0.45)] transition-opacity duration-700 max-[940px]:max-h-[380px]',
                                         'z-[1] opacity-100' => $index === 0,
                                         'z-0 opacity-0' => $index !== 0,
                                     ])
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                            @endforeach
                        </div>

                        <div class="relative z-[3] px-[clamp(22px,3vw,36px)] pb-[clamp(22px,3vw,34px)] pt-2">
                            <div class="mb-3 flex items-end justify-between gap-3">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-litus-sky">Limited time campaign</span>
                                    <p class="mt-1.5 font-display text-[clamp(22px,2.2vw,28px)] font-extrabold leading-none tracking-[-0.03em]"
                                       data-promo-campaign-slide-name>{{ $featured->name }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10.5px] font-semibold uppercase tracking-[0.12em] text-white/55">You save</span>
                                    <span class="font-display text-[clamp(20px,2vw,26px)] font-extrabold tracking-[-0.03em]"
                                          data-promo-campaign-poster-saving>{{ $featured->formattedDiscount() }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-white/16 pt-3.5">
                                <p class="text-[13px] font-semibold text-white/80">
                                    From <span data-promo-campaign-poster-sale>{{ $featured->formattedSalePrice() }}</span>
                                </p>

                                @if ($count > 1)
                                    <div class="flex gap-1.5">
                                        @foreach ($promotions as $index => $model)
                                            <button type="button"
                                                    data-promo-campaign-dot="{{ $index }}"
                                                    aria-label="Show {{ $model->name }}"
                                                    @class([
                                                        'h-1.5 rounded-full transition-all duration-300',
                                                        'w-5 bg-white' => $index === 0,
                                                        'w-1.5 bg-white/50' => $index !== 0,
                                                    ])></button>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-[11px] tracking-[0.06em] text-white/55">
                                        {{ $count }} model · All showrooms
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- FILTERS + GRID --}}
    <section class="litus-sec-tight scroll-mt-24 pb-0" id="offers">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(28px,3vw,42px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">All Live Campaigns</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Find the campaign that fits you</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Filter by brand or sort by saving. Each card shows the campaign price and how much you save.
                </p>
            </div>
        </div>
    </section>

    <section class="sticky top-[72px] z-[100] border-b border-litus-line bg-white/[0.97] py-[15px] backdrop-blur-[12px] max-[820px]:static">
        <div class="litus-container flex flex-wrap items-center gap-3.5">
            <div class="flex flex-wrap gap-2 max-[820px]:w-full max-[820px]:flex-nowrap max-[820px]:overflow-x-auto max-[820px]:pb-1 max-[820px]:[scrollbar-width:none] max-[820px]:[&::-webkit-scrollbar]:hidden">
                <button type="button"
                        data-promo-brand="all"
                        aria-pressed="true"
                        class="inline-flex shrink-0 items-center gap-2 rounded-full border-[1.5px] border-litus-ink bg-litus-ink px-4 py-2 text-[13.5px] font-semibold text-white transition">
                    All Campaigns
                    <span class="rounded-full bg-white/20 px-1.5 py-px text-[11px] font-bold">{{ $count }}</span>
                </button>
                @foreach ($brands as $brand)
                    <button type="button"
                            data-promo-brand="{{ $brand }}"
                            aria-pressed="false"
                            class="inline-flex shrink-0 items-center gap-2 rounded-full border-[1.5px] border-litus-line-2 bg-white px-4 py-2 text-[13.5px] font-semibold text-litus-text-2 transition hover:border-litus-primary-light hover:text-litus-primary">
                        {{ $brand }}
                        <span class="rounded-full bg-litus-paper-3 px-1.5 py-px text-[11px] font-bold text-litus-text-2">
                            {{ $promotions->where('brand', $brand)->count() }}
                        </span>
                    </button>
                @endforeach
            </div>

            <div class="ml-auto flex flex-wrap gap-2.5 max-[820px]:ml-0 max-[820px]:w-full">
                <select data-promo-sort
                        class="w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white py-2.5 pl-3.5 pr-9 text-[13.5px] font-medium text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)] min-[821px]:w-auto">
                    <option value="saving">Sort: Biggest Saving</option>
                    <option value="price">Sort: Lowest Price</option>
                    <option value="latest">Sort: Latest</option>
                </select>
            </div>
        </div>
    </section>

    <section class="bg-white pb-[clamp(62px,7.5vw,116px)] pt-0">
        <div class="litus-container">
            <div class="flex flex-wrap items-center justify-between gap-3 pb-1.5 pt-[26px]">
                <b class="text-[15px] text-litus-text">
                    Showing <span data-promo-count>{{ $count }}</span> offer<span data-promo-count-suffix>{{ $count === 1 ? '' : 's' }}</span>
                </b>
                <button type="button"
                        data-promo-reset
                        class="hidden items-center gap-2 rounded-full border-[1.5px] border-litus-line-2 bg-white px-4 py-2 text-[13.5px] font-semibold text-litus-text-2 transition hover:border-litus-primary-light hover:text-litus-primary">
                    ✕ Clear filters
                </button>
            </div>

            <div class="hidden rounded-[18px] border-[1.5px] border-dashed border-litus-line-2 px-6 py-16 text-center text-litus-text-2"
                 data-promo-empty>
                <p class="font-semibold text-litus-text">No campaigns match these filters</p>
                <p class="mt-1 text-sm">Try another brand or clear filters.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 pt-5 md:grid-cols-2 xl:grid-cols-3"
                 data-promo-grid>
                @forelse ($promotions as $motorcycle)
                    <div data-promo-card
                         data-brand="{{ $motorcycle->brand }}"
                         data-price="{{ $motorcycle->promotionalSalePrice() }}"
                         data-saving="{{ $motorcycle->discountAmount() }}"
                         data-sort="{{ (int) $motorcycle->sort_order }}"
                         data-id="{{ $motorcycle->id }}">
                        <x-card.promotion-card :motorcycle="$motorcycle" />
                    </div>
                @empty
                    <div class="col-span-full rounded-[18px] border border-dashed border-litus-line-2 px-6 py-16 text-center text-litus-text-2">
                        <p class="font-semibold text-litus-text">No active campaigns at the moment.</p>
                        <p class="mt-1 text-sm">Check back soon or browse our full motorcycle range.</p>
                        <a href="{{ route('motorcycles') }}"
                           class="mt-5 inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[14.5px] font-semibold text-white">
                            Browse Motorcycles
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <x-litus-ijara-band />

    {{-- HOW TO JOIN --}}
    <section class="litus-sec bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Simple Process</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">How to join a campaign</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Three steps from the campaign you see here to the keys in your hand.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($steps as $index => $step)
                    <div class="rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px]">
                        <div class="mb-[18px] grid h-[42px] w-[42px] place-items-center rounded-[12px] bg-litus-ink font-display text-[17px] font-bold text-white">
                            {{ $index + 1 }}
                        </div>
                        <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $step['title'] }}</h4>
                        <p class="text-[14.5px] text-litus-text-2">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-9 text-center">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Talk to Sales Team
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="litus-sec">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Good to Know</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Campaign terms and common questions</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    The details that stop surprises at the showroom counter.
                </p>
            </div>

            <div class="mx-auto max-w-[860px] overflow-hidden rounded-[18px] border border-litus-line bg-white">
                @foreach ($faqs as $faq)
                    <details class="group border-b border-litus-paper-3 last:border-b-0" @if (! empty($faq['open'])) open @endif>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-[18px] px-6 py-[19px] text-[15.5px] font-semibold text-litus-text marker:content-none [&::-webkit-details-marker]:hidden group-open:text-litus-primary">
                            <span>{{ $faq['q'] }}</span>
                            <span class="shrink-0 text-[23px] font-light leading-none text-litus-primary group-open:hidden">+</span>
                            <span class="hidden shrink-0 text-[23px] font-light leading-none text-litus-primary group-open:inline">-</span>
                        </summary>
                        <div class="px-6 pb-[22px] text-[14.5px] text-litus-text-2">
                            {!! $faq['a'] !!}
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ALERTS --}}
    <section id="alerts" class="litus-sec-tight scroll-mt-24 bg-litus-paper-2">
        <div class="litus-container">
            <div class="relative grid items-center gap-9 overflow-hidden rounded-[34px] bg-litus-ink p-[clamp(32px,4vw,50px)] text-white max-[860px]:grid-cols-1 min-[861px]:grid-cols-[1.15fr_0.85fr]">
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(560px_300px_at_88%_18%,rgba(31,168,85,.26),transparent_62%)]"></div>
                <div class="relative z-[2]">
                    <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Never Miss an Offer</span>
                    <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Popular models sell out before the campaign ends.</h3>
                    <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.74]">
                        Most LITUS campaigns run for a limited period, and the popular models inside them go early. Join our WhatsApp broadcast and you will hear about each new campaign the morning it goes live.
                    </p>
                </div>
                <div class="relative z-[2] flex flex-wrap gap-3 min-[861px]:justify-end">
                    <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, please add me to campaign WhatsApp alerts.') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1FA855] px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443]">
                        <x-litus-icon name="message-circle" class="h-4 w-4" />
                        Join WhatsApp Alerts
                    </a>
                    <a href="#"
                       class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                        Follow on Facebook
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Not sure which campaign is best for you?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Tell our team your budget and how you want to pay. We will tell you honestly which campaign gets you the most bike for it.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Contact Sales Team
                </a>
                <a href="tel:+9607797442"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    Call 779 7442
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
