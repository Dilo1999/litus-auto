@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $choice = 'group relative rounded-xl border-[1.5px] border-litus-line-2 bg-white px-2.5 py-2 text-left transition duration-150 hover:-translate-y-0.5 hover:border-litus-primary hover:shadow-[0_6px_16px_rgba(18,87,214,.12)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:translate-y-0 disabled:cursor-not-allowed disabled:border-litus-line disabled:bg-litus-paper-3 disabled:shadow-none disabled:hover:border-litus-line aria-pressed:border-litus-primary aria-pressed:bg-[#EEF4FF] aria-pressed:shadow-[0_6px_16px_rgba(18,87,214,.14)]';
    $check = '<svg class="hidden h-[18px] w-[18px] shrink-0 text-litus-primary group-aria-pressed:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.7-9.3a1 1 0 00-1.4-1.4L9 10.58 7.7 9.3a1 1 0 00-1.4 1.4l2 2a1 1 0 001.4 0l4-4z" clip-rule="evenodd"/></svg>';
    $stepBadge = 'relative grid h-7 w-7 shrink-0 place-items-center rounded-full bg-litus-primary text-[12px] font-bold text-white shadow-[0_4px_10px_rgba(18,87,214,.3)] transition';
    $tick = '<svg class="hidden h-4 w-4" data-check viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>';
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden bg-litus-paper-2 text-litus-text']) }}
         data-ijara-estimator>
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(720px 380px at 96% -4%, rgba(46,116,238,.13), transparent 66%),
            radial-gradient(560px 320px at -4% 100%, rgba(18,87,214,.07), transparent 64%);"></div>

    <div class="litus-container relative z-[2] litus-sec-tight max-md:!py-6">
        {{-- Heading --}}
        <div class="litus-ijara-head mb-4 flex flex-wrap items-end justify-between gap-x-10 gap-y-3 sm:mb-6">
            <div class="max-w-[640px]">
                <span class="mb-2 inline-flex items-center gap-2 rounded-full bg-[#E4EDFF] px-2.5 py-0.5 text-[10.5px] font-bold uppercase tracking-[0.16em] text-litus-primary">
                    <span class="h-1.5 w-1.5 rounded-full bg-litus-primary"></span>Ijara Payment Calculator
                </span>
                <h2 class="font-display text-[clamp(22px,3.4vw,34px)] font-extrabold leading-[1.05] tracking-[-0.035em] text-litus-text">Plan your next ride</h2>
                <p class="mt-1.5 max-md:hidden text-[13.5px] leading-[1.5] text-litus-text-2 sm:text-[14.5px]">Choose your model, Ijara plan and number of months to see the down payment and monthly lease for that exact combination.</p>
            </div>
            <ul class="flex flex-wrap gap-2 max-sm:hidden text-[11.5px] font-semibold text-litus-text-2 sm:text-[12px]">
                <li class="inline-flex items-center gap-2 rounded-full border border-litus-line bg-white px-2.5 py-1 shadow-[0_1px_2px_rgba(9,17,32,.04)] sm:px-3 sm:py-1.5">
                    <x-litus-icon name="shield" class="h-4 w-4 text-litus-primary" /> Fixed price, agreed upfront
                </li>
                <li class="inline-flex items-center gap-2 rounded-full border border-litus-line bg-white px-2.5 py-1 shadow-[0_1px_2px_rgba(9,17,32,.04)] sm:px-3 sm:py-1.5">
                    <x-litus-icon name="check-circle" class="h-4 w-4 text-litus-primary" /> Early settlement, no extra charge
                </li>
            </ul>
        </div>

        <div class="grid items-start gap-4 min-[961px]:grid-cols-[1.6fr_1fr] min-[961px]:gap-5">
            {{-- Steps --}}
            <div class="rounded-[18px] border border-litus-line bg-white p-3.5 shadow-[0_1px_2px_rgba(9,17,32,.05),0_18px_44px_rgba(9,17,32,.07)] sm:p-5">
                {{-- 1. Model --}}
                <div data-step="model" class="grid gap-4 border-b border-litus-line pb-4 md:grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] md:items-center">
                    <div>
                        <div class="mb-2.5 flex items-center gap-2.5">
                            <span class="{{ $stepBadge }}"><span data-num>1</span>{!! $tick !!}</span>
                            <label for="ijara-model" class="text-[14.5px] font-bold text-litus-text">Choose your model</label>
                        </div>
                        <select id="ijara-model" data-ijara-model
                                class="w-full rounded-xl border-[1.5px] border-litus-line-2 bg-white px-3.5 py-2 text-[14px] font-medium text-litus-text shadow-[0_1px_2px_rgba(9,17,32,.04)] transition focus:border-litus-primary focus:outline-none focus:ring-2 focus:ring-litus-primary/25 disabled:opacity-50"></select>
                        <p class="mt-1.5 text-[12px] text-litus-text-3" data-ijara-model-hint>Pick a motorcycle to see the plans offered for it.</p>
                    </div>
                    <div class="relative max-md:hidden flex h-[170px] items-center md:h-[120px] justify-center overflow-hidden rounded-2xl border border-litus-line bg-[linear-gradient(140deg,#F4F8FF_0%,#E7EFFC_100%)]">
                        <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-litus-primary/10 blur-2xl"></div>
                        <img data-ijara-image src="" alt="" class="relative hidden max-h-[100%] max-w-[86%] max-md:mt-6 max-md:max-h-[80%] object-contain drop-shadow-[0_14px_16px_rgba(9,17,32,.18)]">
                        <div data-ijara-image-empty class="relative px-6 text-center text-[13px] font-medium text-litus-text-3">Your motorcycle preview appears here</div>
                        <span data-ijara-price-chip hidden class="absolute left-2 top-2 rounded-full md:bottom-2 md:top-auto bg-white/95 px-2 py-0.5 text-[10px] font-semibold leading-tight text-litus-text shadow-[0_1px_4px_rgba(9,17,32,.12)]"></span>
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div data-step="plan" class="border-b border-litus-line py-4">
                    <div class="mb-2.5 flex items-center gap-2.5">
                        <span class="{{ $stepBadge }}"><span data-num>2</span>{!! $tick !!}</span>
                        <span class="text-[14.5px] font-bold text-litus-text" id="ijara-plan-label">Select your Ijara plan</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[560px]:grid-cols-3 lg:grid-cols-5 [&>button:last-child:nth-child(odd)]:col-span-2 min-[560px]:[&>button:last-child:nth-child(odd)]:col-span-1" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $choice }} min-h-[64px] max-sm:min-h-0">
                            <span class="flex items-start justify-between gap-1.5">
                                <b class="text-[14.5px] font-bold leading-tight text-litus-text" data-plan-name></b>
                                {!! $check !!}
                            </span>
                            <span class="mt-1 block text-[11.5px] leading-snug text-litus-text-3 max-sm:hidden" data-plan-tag></span>
                            <span class="mt-1.5 block text-[11.5px] font-semibold leading-snug text-litus-primary" data-plan-from></span>
                        </button>
                    </template>
                </div>

                {{-- 3. Term --}}
                <div data-step="term" class="pt-4">
                    <div class="mb-2.5 flex items-center gap-2.5">
                        <span class="{{ $stepBadge }}"><span data-num>3</span>{!! $tick !!}</span>
                        <span class="text-[14.5px] font-bold text-litus-text" id="ijara-term-label">Number of months</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 lg:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false" class="{{ $choice }} min-h-[68px] max-sm:min-h-[58px]">
                                <span class="flex items-start justify-between gap-1.5">
                                    <span class="text-litus-text"><b class="font-display text-[19px] font-extrabold leading-none tracking-[-0.02em]">{{ $term }}</b> <span class="text-[12px] font-semibold text-litus-text-2 max-sm:hidden">months</span></span>
                                    {!! $check !!}
                                </span>
                                <span class="mt-1 block whitespace-nowrap text-[11px] max-sm:whitespace-normal max-sm:text-[10.5px] max-sm:leading-tight font-bold leading-snug text-litus-primary" data-term-monthly></span>
                                <span class="block text-[11px] leading-snug text-litus-text-3 max-sm:hidden" data-term-down></span>
                            </button>
                        @endforeach
                    </div>
                    <p class="mt-2 text-[11.5px] text-litus-text-3 max-md:hidden">Down payment and monthly lease change with the bike, the plan and the number of months.</p>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="overflow-hidden rounded-[18px] border border-litus-line bg-white shadow-[0_1px_2px_rgba(9,17,32,.05),0_18px_44px_rgba(9,17,32,.09)] min-[961px]:sticky min-[961px]:top-[96px]">
                <div class="relative overflow-hidden px-5 pb-4 pt-4 text-white"
                     style="background-image: radial-gradient(420px 220px at 100% 0%, rgba(46,116,238,.5), transparent 70%), linear-gradient(135deg, #07132B, #122240);">
                    <span class="text-[11.5px] font-bold uppercase tracking-[0.16em] text-[#8FB5FF]">Your Ijara summary</span>
                    <p class="mt-2 text-[12.5px] text-white/70">Monthly lease</p>
                    <div class="flex flex-wrap items-baseline gap-x-2">
                        <b class="font-display text-[clamp(28px,3.2vw,36px)] font-extrabold leading-none tracking-[-0.035em]" data-ijara-monthly>MVR -</b>
                        <span class="text-[14px] font-medium text-white/70" data-ijara-per-month hidden>/ month</span>
                    </div>
                    <p class="mt-1.5 text-[12.5px] leading-snug text-white/70" data-ijara-headline>Choose a model, plan and number of months.</p>
                </div>

                <div class="px-5 pb-4 pt-3.5">
                    <div class="rounded-xl border border-litus-line bg-litus-paper-2 px-3.5 py-2.5">
                        <span class="text-[12.5px] font-semibold text-litus-text-2">Down payment</span>
                        <b class="mt-0.5 block font-display text-[21px] font-extrabold leading-tight tracking-[-0.025em] text-litus-text" data-ijara-down>MVR -</b>
                    </div>

                    <dl class="mt-1.5 max-md:hidden divide-y divide-litus-line text-[13px]">
                        <div class="flex justify-between gap-4 py-2"><dt class="text-litus-text-2">Model</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-model>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-litus-text-2">Ijara plan</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-plan>-</dd></div>
                        <div class="flex justify-between gap-4 py-2"><dt class="text-litus-text-2">Number of months</dt><dd class="text-right font-semibold text-litus-text" data-ijara-summary-term>-</dd></div>
                    </dl>

                    <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                       class="mt-2 flex min-h-[44px] w-full items-center justify-center gap-2 rounded-xl bg-litus-primary px-5 py-2 text-[14px] font-bold text-white shadow-[0_10px_24px_rgba(18,87,214,.32)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover aria-disabled:pointer-events-none aria-disabled:opacity-40 aria-disabled:shadow-none">
                        <span data-ijara-continue-label>Continue</span>
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <p class="mt-2 text-center text-[11.5px] leading-snug text-litus-text-3 max-md:hidden" data-ijara-note>Review your selection before proceeding.</p>
                </div>
            </aside>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
