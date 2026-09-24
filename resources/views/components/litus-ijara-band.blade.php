@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $choice = 'group relative rounded-xl border-[1.5px] border-litus-line-2 bg-white px-3 py-3 text-left transition duration-150 hover:-translate-y-0.5 hover:border-litus-primary hover:shadow-[0_6px_16px_rgba(18,87,214,.12)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:translate-y-0 disabled:cursor-not-allowed disabled:border-litus-line disabled:bg-litus-paper-3 disabled:shadow-none disabled:hover:border-litus-line aria-pressed:border-litus-primary aria-pressed:bg-[#EEF4FF] aria-pressed:shadow-[0_6px_16px_rgba(18,87,214,.14)]';
    $check = '<svg class="hidden h-[18px] w-[18px] shrink-0 text-litus-primary group-aria-pressed:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.7-9.3a1 1 0 00-1.4-1.4L9 10.58 7.7 9.3a1 1 0 00-1.4 1.4l2 2a1 1 0 001.4 0l4-4z" clip-rule="evenodd"/></svg>';
    $stepBadge = 'relative grid h-8 w-8 shrink-0 place-items-center rounded-full bg-litus-primary text-[13px] font-bold text-white shadow-[0_4px_10px_rgba(18,87,214,.3)] transition';
    $tick = '<svg class="hidden h-4 w-4" data-check viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>';
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden bg-litus-paper-2 text-litus-text']) }}
         data-ijara-estimator>
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(720px 380px at 96% -4%, rgba(46,116,238,.13), transparent 66%),
            radial-gradient(560px 320px at -4% 100%, rgba(18,87,214,.07), transparent 64%);"></div>

    <div class="litus-container relative z-[2] litus-sec max-md:!py-12">
        {{-- Heading --}}
        <div class="mb-8 flex flex-wrap items-end justify-between gap-x-10 gap-y-5 sm:mb-10">
            <div class="max-w-[640px]">
                <span class="mb-3 inline-flex items-center gap-2 rounded-full bg-[#E4EDFF] px-3 py-1 text-[11px] font-bold uppercase tracking-[0.16em] text-litus-primary">
                    <span class="h-1.5 w-1.5 rounded-full bg-litus-primary"></span>Payment Calculator
                </span>
                <h2 class="font-display text-[clamp(30px,5vw,50px)] font-extrabold leading-[1.05] tracking-[-0.035em] text-litus-text">Plan your next ride</h2>
                <p class="mt-3 text-[15px] leading-[1.6] text-litus-text-2 sm:text-[17px]">Choose your model, Ijara plan and repayment term, then set your advance to see your monthly payment.</p>
            </div>
            <ul class="flex flex-wrap gap-2.5 text-[12.5px] font-semibold text-litus-text-2">
                <li class="inline-flex items-center gap-2 rounded-full border border-litus-line bg-white px-3.5 py-2 shadow-[0_1px_2px_rgba(9,17,32,.04)]">
                    <x-litus-icon name="shield" class="h-4 w-4 text-litus-primary" /> Fixed price, agreed upfront
                </li>
                <li class="inline-flex items-center gap-2 rounded-full border border-litus-line bg-white px-3.5 py-2 shadow-[0_1px_2px_rgba(9,17,32,.04)]">
                    <x-litus-icon name="check-circle" class="h-4 w-4 text-litus-primary" /> Early settlement, no extra charge
                </li>
            </ul>
        </div>

        <div class="grid items-start gap-5 min-[961px]:grid-cols-[1.55fr_1fr] min-[961px]:gap-7">
            {{-- Steps --}}
            <div class="rounded-[22px] border border-litus-line bg-white p-5 shadow-[0_1px_2px_rgba(9,17,32,.05),0_18px_44px_rgba(9,17,32,.07)] sm:p-8">
                {{-- 1. Model --}}
                <div data-step="model" class="grid gap-5 border-b border-litus-line pb-7 md:grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] md:items-center">
                    <div>
                        <div class="mb-4 flex items-center gap-3">
                            <span class="{{ $stepBadge }}"><span data-num>1</span>{!! $tick !!}</span>
                            <label for="ijara-model" class="text-[16px] font-bold text-litus-text">Choose your model</label>
                        </div>
                        <select id="ijara-model" data-ijara-model
                                class="w-full rounded-xl border-[1.5px] border-litus-line-2 bg-white px-4 py-3 text-[14.5px] font-medium text-litus-text shadow-[0_1px_2px_rgba(9,17,32,.04)] transition focus:border-litus-primary focus:outline-none focus:ring-2 focus:ring-litus-primary/25 disabled:opacity-50"></select>
                        <p class="mt-2.5 text-[12.5px] text-litus-text-3" data-ijara-model-hint>Pick a motorcycle to see its price and available plans.</p>
                    </div>
                    <div class="relative flex h-[190px] items-center justify-center overflow-hidden rounded-2xl border border-litus-line bg-[linear-gradient(140deg,#F4F8FF_0%,#E7EFFC_100%)]">
                        <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-litus-primary/10 blur-2xl"></div>
                        <img data-ijara-image src="" alt="" class="relative hidden max-h-[86%] max-w-[86%] object-contain drop-shadow-[0_14px_16px_rgba(9,17,32,.18)]">
                        <div data-ijara-image-empty class="relative px-6 text-center text-[13px] font-medium text-litus-text-3">Your motorcycle preview appears here</div>
                        <span data-ijara-price-chip hidden class="absolute bottom-3 left-3 rounded-full bg-white/95 px-3 py-1.5 text-[12px] font-bold text-litus-text shadow-[0_2px_8px_rgba(9,17,32,.12)]"></span>
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div data-step="plan" class="border-b border-litus-line py-7">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="{{ $stepBadge }}"><span data-num>2</span>{!! $tick !!}</span>
                        <span class="text-[16px] font-bold text-litus-text" id="ijara-plan-label">Select your Ijara plan</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5 min-[560px]:grid-cols-3 lg:grid-cols-5" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $choice }} min-h-[68px]">
                            <span class="flex items-start justify-between gap-1.5">
                                <b class="text-[14.5px] font-bold leading-tight text-litus-text" data-plan-name></b>
                                {!! $check !!}
                            </span>
                            <span class="mt-1 block text-[11.5px] leading-snug text-litus-text-3" data-plan-tag></span>
                        </button>
                    </template>
                </div>

                {{-- 3. Term --}}
                <div data-step="term" class="border-b border-litus-line py-7">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="{{ $stepBadge }}"><span data-num>3</span>{!! $tick !!}</span>
                        <span class="text-[16px] font-bold text-litus-text" id="ijara-term-label">Repayment term</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5 min-[560px]:grid-cols-3 lg:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false" class="{{ $choice }} min-h-[68px]">
                                <span class="flex items-start justify-between gap-1.5">
                                    <span class="text-litus-text"><b class="font-display text-[22px] font-extrabold leading-none tracking-[-0.02em]">{{ $term }}</b> <span class="text-[12px] font-semibold text-litus-text-2">months</span></span>
                                    {!! $check !!}
                                </span>
                                <span class="mt-1.5 block text-[11.5px] font-semibold leading-snug text-litus-primary" data-term-note></span>
                            </button>
                        @endforeach
                    </div>
                    <p class="mt-3 text-[12.5px] text-litus-text-3">Only the months offered on your chosen plan can be selected.</p>
                </div>

                {{-- 4. Advance --}}
                <div data-step="advance" class="pt-7">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="{{ $stepBadge }}"><span data-num>4</span>{!! $tick !!}</span>
                        <label for="ijara-advance" class="text-[16px] font-bold text-litus-text">Advance payment</label>
                    </div>

                    <div class="flex items-center rounded-xl border-[1.5px] border-litus-line-2 bg-white shadow-[0_1px_2px_rgba(9,17,32,.04)] transition focus-within:border-litus-primary focus-within:ring-2 focus-within:ring-litus-primary/25">
                        <span class="border-r border-litus-line px-4 py-3.5 text-[13px] font-bold tracking-wide text-litus-text-2">MVR</span>
                        <input id="ijara-advance" data-ijara-advance type="text" inputmode="numeric" autocomplete="off" placeholder="0"
                               class="w-full rounded-xl border-0 bg-transparent px-4 py-3.5 font-display text-[20px] font-bold text-litus-text placeholder:text-litus-text-3/60 focus:outline-none focus:ring-0 disabled:opacity-50">
                        <span class="whitespace-nowrap pr-4 text-[12.5px] font-semibold text-litus-text-3" data-ijara-advance-pct></span>
                    </div>

                    <div class="mt-4">
                        <input type="range" min="0" max="70" step="1" value="0" data-ijara-slider aria-label="Advance as a percentage of the vehicle price"
                               class="h-2 w-full cursor-pointer accent-litus-primary disabled:cursor-not-allowed disabled:opacity-40">
                        <div class="mt-1 flex justify-between text-[11px] font-medium text-litus-text-3"><span>0%</span><span>35%</span><span>70%</span></div>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-2" data-ijara-presets>
                        @foreach ([0, 10, 20, 30, 40] as $pct)
                            <button type="button" data-preset="{{ $pct }}" disabled
                                    class="rounded-full border border-litus-line-2 bg-white px-3.5 py-1.5 text-[12.5px] font-semibold text-litus-text-2 transition aria-pressed:border-litus-primary aria-pressed:bg-[#EEF4FF] aria-pressed:text-litus-primary hover:border-litus-primary hover:text-litus-primary disabled:cursor-not-allowed disabled:opacity-45 disabled:hover:border-litus-line-2 disabled:hover:text-litus-text-2">
                                {{ $pct === 0 ? 'No advance' : $pct.'%' }}
                            </button>
                        @endforeach
                    </div>

                    <p class="mt-3 text-[12.5px] leading-relaxed text-litus-text-3" data-ijara-advance-hint>Select a model first, then enter the amount you will pay upfront.</p>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="overflow-hidden rounded-[22px] border border-litus-line bg-white shadow-[0_1px_2px_rgba(9,17,32,.05),0_18px_44px_rgba(9,17,32,.09)] min-[961px]:sticky min-[961px]:top-[96px]">
                <div class="relative overflow-hidden bg-litus-ink px-6 pb-6 pt-5 text-white"
                     style="background-image: radial-gradient(420px 220px at 100% 0%, rgba(46,116,238,.5), transparent 70%), linear-gradient(135deg, #050B18, #122240);">
                    <span class="text-[11.5px] font-bold uppercase tracking-[0.16em] text-[#8FB5FF]">Your payment summary</span>
                    <div class="mt-3 flex flex-wrap items-baseline gap-x-2">
                        <b class="font-display text-[clamp(34px,4.4vw,46px)] font-extrabold leading-none tracking-[-0.035em]" data-ijara-monthly>MVR -</b>
                        <span class="text-[14px] font-medium text-white/70" data-ijara-per-month hidden>/ month</span>
                    </div>
                    <p class="mt-2.5 text-[13px] leading-snug text-white/70" data-ijara-headline>Choose a model, plan and term to see your monthly payment.</p>
                </div>

                <div class="px-6 pb-6 pt-5">
                    {{-- Price split --}}
                    <div>
                        <div class="flex h-2.5 overflow-hidden rounded-full bg-litus-paper-3">
                            <span class="h-full bg-[#7FA8F5] transition-[width] duration-500" style="width:0%" data-bar-advance></span>
                            <span class="h-full bg-litus-primary transition-[width] duration-500" style="width:0%" data-bar-leased></span>
                        </div>
                        <div class="mt-2 flex justify-between text-[11.5px] font-semibold text-litus-text-2">
                            <span class="inline-flex items-center gap-1.5"><i class="h-2 w-2 rounded-full bg-[#7FA8F5]"></i>Advance <span data-bar-advance-label>-</span></span>
                            <span class="inline-flex items-center gap-1.5"><i class="h-2 w-2 rounded-full bg-litus-primary"></i>Leased <span data-bar-leased-label>-</span></span>
                        </div>
                    </div>

                    <dl class="mt-4 divide-y divide-litus-line text-[13.5px]">
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Model</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-model>-</dd></div>
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Ijara plan</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-plan>-</dd></div>
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Term</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-term>-</dd></div>
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Vehicle price</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-price>-</dd></div>
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Advance payment</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-advance>-</dd></div>
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Amount to lease</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-financed>-</dd></div>
                        <div class="flex justify-between gap-4 py-3"><dt class="text-litus-text-2">Lease rate <span class="text-litus-text-3" data-ijara-rate-label></span></dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-charge>-</dd></div>
                        <div class="flex items-baseline justify-between gap-4 py-3.5"><dt class="font-semibold text-litus-text">Total to pay over the term</dt><dd class="text-right font-display text-[16px] font-extrabold text-litus-text" data-ijara-summary-total>-</dd></div>
                    </dl>

                    <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                       class="mt-2 flex min-h-[52px] w-full items-center justify-center gap-2 rounded-xl bg-litus-primary px-6 py-3 text-[15px] font-bold text-white shadow-[0_10px_24px_rgba(18,87,214,.32)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover aria-disabled:pointer-events-none aria-disabled:opacity-40 aria-disabled:shadow-none">
                        Continue
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <p class="mt-3 text-center text-[12px] leading-relaxed text-litus-text-3" data-ijara-note>Review your selection before proceeding.</p>
                </div>
            </aside>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
