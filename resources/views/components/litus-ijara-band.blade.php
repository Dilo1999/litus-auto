@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $choice = 'group relative rounded-lg border-[1.5px] border-white/15 bg-white/[0.04] px-2.5 py-2 text-center text-white transition duration-200 hover:-translate-y-0.5 hover:border-litus-sky/70 hover:bg-white/[0.09] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-sky/50 disabled:translate-y-0 disabled:cursor-not-allowed disabled:border-white/10 disabled:bg-white/[0.02] disabled:opacity-40 disabled:shadow-none disabled:hover:border-white/10 aria-pressed:border-litus-sky aria-pressed:bg-litus-primary/30 aria-pressed:shadow-[0_0_0_1px_rgba(90,184,255,.5),0_10px_28px_rgba(18,87,214,.45)]';
    $check = '<svg class="hidden h-4 w-4 shrink-0 text-litus-sky group-aria-pressed:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.7-9.3a1 1 0 00-1.4-1.4L9 10.58 7.7 9.3a1 1 0 00-1.4 1.4l2 2a1 1 0 001.4 0l4-4z" clip-rule="evenodd"/></svg>';
    $stepBadge = 'relative grid h-7 w-7 shrink-0 place-items-center rounded-full bg-litus-primary text-[12.5px] font-bold text-white shadow-[0_0_0_4px_rgba(90,184,255,.16),0_6px_14px_rgba(18,87,214,.5)] transition';
    $tick = '<svg class="hidden h-4 w-4" data-check viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>';
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden bg-[#081634] text-white']) }}
         data-ijara-estimator>
    {{-- Background: deep navy fading diagonally into vivid blue --}}
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(760px 480px at 96% 4%, rgba(96,156,255,.38), transparent 66%),
            radial-gradient(620px 420px at 100% 100%, rgba(30,90,220,.55), transparent 70%),
            linear-gradient(118deg, #050B18 0%, #081634 30%, #0C2760 58%, #143C9C 82%, #1A4BC4 100%);"></div>

    <div class="litus-container relative z-[2] py-10 sm:py-12 lg:py-14">
        {{-- Heading --}}
        <div class="mb-6 flex flex-wrap items-end justify-between gap-x-10 gap-y-4 sm:mb-7">
            <div class="max-w-[640px]">
                <span class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/[0.06] px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-litus-sky">
                    <span class="h-1.5 w-1.5 rounded-full bg-litus-sky"></span>Payment Calculator
                </span>
                <h2 class="font-display text-[clamp(26px,4vw,38px)] font-extrabold leading-[1.05] tracking-[-0.035em] text-white">Plan your next ride</h2>
                <p class="mt-2 text-[14px] leading-[1.55] text-white/70 sm:text-[15.5px]">Choose your model, Ijara plan and repayment term, then set your advance to see your monthly payment.</p>
            </div>
            <ul class="flex flex-wrap gap-2.5 text-[12.5px] font-semibold text-white/80">
                <li class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/[0.06] px-3.5 py-2 backdrop-blur-sm">
                    <x-litus-icon name="shield" class="h-4 w-4 text-litus-sky" /> Fixed price, agreed upfront
                </li>
                <li class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/[0.06] px-3.5 py-2 backdrop-blur-sm">
                    <x-litus-icon name="check-circle" class="h-4 w-4 text-litus-sky" /> Early settlement, no extra charge
                </li>
            </ul>
        </div>

        <div class="grid items-start gap-4 min-[961px]:grid-cols-[2fr_1fr] min-[961px]:gap-5">
            {{-- Steps --}}
            <div class="rounded-[18px] border border-white/10 bg-white/[0.05] p-4 shadow-[0_24px_60px_rgba(0,0,0,.35)] backdrop-blur-md sm:p-6">
                {{-- 1. Model --}}
                <div data-step="model" class="grid gap-3 border-b border-white/10 pb-4 md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)] md:items-center">
                    <div>
                        <div class="mb-3 flex items-center gap-3">
                            <span class="{{ $stepBadge }}"><span data-num>1</span>{!! $tick !!}</span>
                            <label for="ijara-model" class="text-[15px] font-bold text-white">Choose your model</label>
                        </div>
                        <select id="ijara-model" data-ijara-model
                                class="w-full rounded-lg border-[1.5px] border-white/20 bg-white/[0.06] px-3.5 py-2.5 text-[14px] font-medium text-white transition [color-scheme:dark] hover:border-litus-sky/60 focus:border-litus-sky focus:outline-none focus:ring-4 focus:ring-litus-sky/25 disabled:opacity-50 [&>option]:bg-litus-ink [&>option]:text-white"></select>
                        <p class="mt-2 text-[12px] text-white/50" data-ijara-model-hint>Pick a motorcycle to see its price and available plans.</p>
                    </div>
                    <div class="relative flex h-[150px] items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-[radial-gradient(ellipse_at_50%_35%,#ffffff_0%,#EEF1F6_55%,#DCE2EC_100%)]">
                        <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-litus-primary/10 blur-2xl"></div>
                        <img data-ijara-image src="" alt="" class="relative hidden max-h-[86%] max-w-[86%] object-contain drop-shadow-[0_14px_16px_rgba(9,17,32,.22)]">
                        <div data-ijara-image-empty class="relative px-6 text-center text-[13px] font-medium text-litus-text-3">Your motorcycle preview appears here</div>
                        <span data-ijara-price-chip hidden class="absolute bottom-3 left-3 rounded-full bg-white/95 px-3 py-1.5 text-[12px] font-bold text-litus-text shadow-[0_2px_8px_rgba(9,17,32,.12)]"></span>
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div data-step="plan" class="border-b border-white/10 py-4">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $stepBadge }}"><span data-num>2</span>{!! $tick !!}</span>
                        <span class="text-[15px] font-bold text-white" id="ijara-plan-label">Select your Ijara plan</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[560px]:grid-cols-3 lg:grid-cols-5" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $choice }} min-h-[40px]" title="">
                            <span class="flex items-center justify-center gap-1.5">
                                <b class="text-[13.5px] font-semibold leading-tight text-white" data-plan-name></b>
                                {!! $check !!}
                            </span>
                            <span class="hidden text-[11px] leading-snug text-white/55" data-plan-tag></span>
                        </button>
                    </template>
                </div>

                {{-- 3. Term --}}
                <div data-step="term" class="border-b border-white/10 py-4">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $stepBadge }}"><span data-num>3</span>{!! $tick !!}</span>
                        <span class="text-[15px] font-bold text-white" id="ijara-term-label">Repayment term</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[560px]:grid-cols-3 lg:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false" class="{{ $choice }} min-h-[40px]">
                                <span class="flex items-center justify-center gap-1.5">
                                    <span class="text-white"><b class="font-display text-[15px] font-bold leading-none">{{ $term }}</b> <span class="text-[12px] font-semibold text-white/60">months</span></span>
                                    {!! $check !!}
                                </span>
                                <span class="block text-[10.5px] font-semibold leading-tight text-litus-sky empty:hidden" data-term-note></span>
                            </button>
                        @endforeach
                    </div>
                    <p class="mt-2 text-[12px] text-white/50">Only the months offered on your chosen plan can be selected.</p>
                </div>

                {{-- 4. Advance --}}
                <div data-step="advance" class="pt-4">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $stepBadge }}"><span data-num>4</span>{!! $tick !!}</span>
                        <label for="ijara-advance" class="text-[15px] font-bold text-white">Advance payment</label>
                    </div>

                    <div class="flex items-center rounded-lg border-[1.5px] border-white/20 bg-white/[0.06] transition focus-within:border-litus-sky focus-within:ring-4 focus-within:ring-litus-sky/25">
                        <span class="border-r border-white/15 px-3.5 py-2.5 text-[12.5px] font-bold tracking-wide text-white/70">MVR</span>
                        <input id="ijara-advance" data-ijara-advance type="text" inputmode="numeric" autocomplete="off" placeholder="0"
                               class="w-full rounded-lg border-0 bg-transparent px-3.5 py-2.5 font-display text-[17px] font-bold text-white placeholder:text-white/30 focus:outline-none focus:ring-0 disabled:opacity-50">
                        <span class="whitespace-nowrap pr-4 text-[12.5px] font-semibold text-white/50" data-ijara-advance-pct></span>
                    </div>

                    <div class="mt-3">
                        <input type="range" min="0" max="70" step="1" value="0" data-ijara-slider aria-label="Advance as a percentage of the vehicle price"
                               class="h-2 w-full cursor-pointer accent-litus-sky disabled:cursor-not-allowed disabled:opacity-40">
                        <div class="mt-1 flex justify-between text-[11px] font-medium text-white/50"><span>0%</span><span>35%</span><span>70%</span></div>
                    </div>

                    <div class="mt-2.5 flex flex-wrap gap-2" data-ijara-presets>
                        @foreach ([0, 10, 20, 30, 40] as $pct)
                            <button type="button" data-preset="{{ $pct }}" disabled
                                    class="rounded-full border border-white/20 bg-white/[0.05] px-3 py-1 text-[12px] font-semibold text-white/80 transition aria-pressed:border-litus-sky aria-pressed:bg-litus-primary/35 aria-pressed:text-white hover:border-litus-sky hover:text-white disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:border-white/20 disabled:hover:text-white/80">
                                {{ $pct === 0 ? 'No advance' : $pct.'%' }}
                            </button>
                        @endforeach
                    </div>

                    <p class="mt-2 text-[12px] leading-relaxed text-white/50" data-ijara-advance-hint>Select a model first, then enter the amount you will pay upfront.</p>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="overflow-hidden rounded-[18px] border border-white/12 bg-white/[0.06] shadow-[0_24px_60px_rgba(0,0,0,.4)] backdrop-blur-md min-[961px]:sticky min-[961px]:top-[84px]">
                <div class="relative overflow-hidden px-5 pb-4 pt-4 text-white"
                     style="background-image: radial-gradient(420px 220px at 100% 0%, rgba(90,184,255,.45), transparent 70%), linear-gradient(135deg, #1257D6, #0B2F7A);">
                    <span class="text-[11.5px] font-bold uppercase tracking-[0.16em] text-white/80">Your payment summary</span>
                    <div class="mt-2 flex flex-wrap items-baseline gap-x-2">
                        <b class="font-display text-[clamp(28px,3.4vw,36px)] font-extrabold leading-none tracking-[-0.035em]" data-ijara-monthly>MVR -</b>
                        <span class="text-[14px] font-medium text-white/70" data-ijara-per-month hidden>/ month</span>
                    </div>
                    <p class="mt-1.5 text-[12.5px] leading-snug text-white/75" data-ijara-headline>Choose a model, plan and term to see your monthly payment.</p>
                </div>

                <div class="px-5 pb-5 pt-4">
                    {{-- Price split --}}
                    <div>
                        <div class="flex h-2.5 overflow-hidden rounded-full bg-white/10">
                            <span class="h-full bg-[#7FA8F5] transition-[width] duration-500" style="width:0%" data-bar-advance></span>
                            <span class="h-full bg-litus-primary transition-[width] duration-500" style="width:0%" data-bar-leased></span>
                        </div>
                        <div class="mt-2 flex justify-between text-[11.5px] font-semibold text-white/70">
                            <span class="inline-flex items-center gap-1.5"><i class="h-2 w-2 rounded-full bg-[#7FA8F5]"></i>Advance <span data-bar-advance-label>-</span></span>
                            <span class="inline-flex items-center gap-1.5"><i class="h-2 w-2 rounded-full bg-litus-primary"></i>Leased <span data-bar-leased-label>-</span></span>
                        </div>
                    </div>

                    <dl class="mt-3 divide-y divide-white/10 text-[13px]">
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Model</dt><dd class="text-right font-semibold text-white" data-ijara-summary-model>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Ijara plan</dt><dd class="text-right font-semibold text-white" data-ijara-summary-plan>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Term</dt><dd class="text-right font-semibold text-white" data-ijara-summary-term>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Vehicle price</dt><dd class="text-right font-semibold text-white" data-ijara-summary-price>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Advance payment</dt><dd class="text-right font-semibold text-white" data-ijara-summary-advance>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Amount to lease</dt><dd class="text-right font-semibold text-white" data-ijara-summary-financed>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-white/60">Lease rate <span class="text-white/45" data-ijara-rate-label></span></dt><dd class="text-right font-semibold text-white" data-ijara-summary-charge>-</dd></div>
                        <div class="flex items-baseline justify-between gap-4 py-2.5"><dt class="font-semibold text-white">Total to pay over the term</dt><dd class="text-right font-display text-[16px] font-extrabold text-litus-sky" data-ijara-summary-total>-</dd></div>
                    </dl>

                    <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                       class="mt-2 flex min-h-[46px] w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[15px] font-bold text-white shadow-[0_12px_28px_rgba(18,87,214,.55)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover aria-disabled:pointer-events-none aria-disabled:opacity-40 aria-disabled:shadow-none">
                        Continue
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <p class="mt-2 text-center text-[11.5px] leading-relaxed text-white/50" data-ijara-note>Review your selection before proceeding.</p>
                </div>
            </aside>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
