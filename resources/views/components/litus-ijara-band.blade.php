@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $choice = 'litus-radio-card group relative flex min-h-[64px] flex-col items-center justify-center gap-0.5 rounded-xl border-[1.5px] border-litus-line bg-white px-2.5 py-3 text-center transition duration-150 hover:border-litus-primary-light focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:border-litus-line disabled:bg-litus-paper-3 disabled:opacity-55 disabled:hover:border-litus-line aria-pressed:border-litus-primary aria-pressed:bg-[#EAF2FF] aria-pressed:shadow-[0_6px_16px_rgba(18,87,214,.12)]';
    $stepBadge = 'grid h-8 w-8 shrink-0 place-items-center rounded-full bg-litus-primary text-[14px] font-bold text-white shadow-[0_4px_10px_rgba(18,87,214,.28)]';
    $stepTitle = 'font-display text-[17px] font-bold tracking-[-0.02em] text-litus-ink';
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden text-litus-text']) }}
         style="background: radial-gradient(760px 320px at 100% 0%, rgba(46,116,238,.10), transparent 68%), radial-gradient(620px 300px at 0% 100%, rgba(90,184,255,.10), transparent 66%), linear-gradient(180deg, #F7FAFF 0%, #EAF2FD 100%);"
         data-ijara-estimator>
    <div class="litus-container relative z-[2] litus-sec-tight !py-6 max-md:!pb-28 max-md:!pt-6">
        {{-- Heading --}}
        <div class="mx-auto mb-4 max-w-[640px] text-center sm:mb-5">
            <span class="mb-1.5 block text-[12px] font-bold uppercase tracking-[0.2em] text-litus-primary md:hidden">Find your next ride</span>
            <h2 class="font-display text-[clamp(22px,3vw,32px)] font-extrabold leading-[1.1] tracking-[-0.03em] text-litus-ink">Choose your bike.<br class="md:hidden"> Make it yours.</h2>
            <p class="mt-1.5 text-[14px] leading-[1.5] text-litus-text-2 sm:text-[15.5px]">Select a model, Ijara plan and lease term to request your quote.</p>
        </div>

        <div class="grid items-start gap-4 min-[961px]:items-stretch min-[961px]:grid-cols-[1.6fr_1fr] min-[961px]:gap-5">
            {{-- Steps --}}
            <div class="max-md:space-y-3 md:rounded-[18px] md:border md:border-litus-line md:bg-white md:p-5 md:shadow-[0_1px_2px_rgba(9,17,32,.04),0_14px_36px_rgba(9,17,32,.06)]">
                {{-- 1. Bike --}}
                <div class="max-md:rounded-2xl max-md:border max-md:border-litus-line max-md:bg-white max-md:p-4 max-md:shadow-[0_1px_2px_rgba(9,17,32,.04),0_10px_28px_rgba(9,17,32,.05)]">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $stepBadge }}">1</span>
                        <h3 class="{{ $stepTitle }}">Choose your bike</h3>
                    </div>
                    <div class="grid gap-5 md:grid-cols-[1.2fr_1fr] md:items-center">
                        <div class="relative flex h-[190px] items-center justify-center rounded-xl max-md:h-[180px]">
                            <img data-ijara-image src="" alt="" class="relative hidden max-h-full max-w-full object-contain drop-shadow-[0_16px_14px_rgba(9,17,32,.2)]">
                            <div data-ijara-image-empty class="px-6 text-center text-[13px] font-medium text-litus-text-3">Your motorcycle preview appears here</div>
                        </div>
                        <div class="flex min-w-0 flex-col">
                            <p class="order-1 font-display text-[clamp(20px,2vw,24px)] font-bold leading-tight tracking-[-0.02em] text-litus-ink" data-ijara-model-name>Select a model</p>
                            <p class="order-2 mt-1 text-[13px] text-litus-text-3" data-ijara-model-hint>Pick a motorcycle to see the plans offered for it.</p>
                            <label for="ijara-model" class="sr-only">Choose your model</label>
                            <div class="litus-select-wrap order-4 mt-3 md:order-3 md:mt-3">
                                <select id="ijara-model" data-ijara-model
                                        class="litus-select w-full cursor-pointer rounded-lg border-[1.5px] border-litus-line-2 bg-white px-3.5 py-2.5 pr-10 text-[14px] font-medium text-litus-text outline-none transition focus:border-litus-primary focus:ring-2 focus:ring-litus-primary/20 disabled:opacity-50"></select>
                                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                            </div>
                            <div class="order-3 mt-3 border-t border-litus-line pt-3 md:order-4 md:mt-3">
                                <span class="text-[12.5px] text-litus-text-3">Vehicle price</span>
                                <b class="mt-0.5 block font-display text-[clamp(19px,2vw,22px)] font-extrabold leading-tight tracking-[-0.025em] text-litus-ink" data-ijara-vehicle-price>-</b>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div class="md:mt-5 md:border-t md:border-litus-line md:pt-4 max-md:rounded-2xl max-md:border max-md:border-litus-line max-md:bg-white max-md:p-4 max-md:shadow-[0_1px_2px_rgba(9,17,32,.04),0_10px_28px_rgba(9,17,32,.05)]">
                    <div class="mb-3 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5 sm:gap-3">
                            <span class="{{ $stepBadge }}">2</span>
                            <h3 class="{{ $stepTitle }} max-sm:whitespace-nowrap max-sm:text-[14.5px]" id="ijara-plan-label">Choose your Ijara plan</h3>
                        </div>
                        <a href="{{ route('ownership-plans') }}" class="inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap text-[13px] font-semibold text-litus-primary transition hover:gap-2.5 max-sm:text-[12.5px]">
                            Compare plans <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[560px]:grid-cols-3 lg:grid-cols-5" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $choice }}">
                            <b class="text-[14px] font-bold leading-tight text-litus-ink" data-plan-name></b>
                            <span class="hidden" data-plan-tag></span>
                            <span class="absolute -right-2 -top-2 hidden h-5 w-5 items-center justify-center rounded-full bg-litus-primary text-white shadow-[0_2px_6px_rgba(18,87,214,.4)] group-aria-pressed:flex" aria-hidden="true">
                                <svg class="h-3 w-3" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10l4 4 8-8"/></svg>
                            </span>
                        </button>
                    </template>
                    <p class="mt-3 flex items-center gap-2 rounded-lg bg-[#EAF2FF] px-3 py-2 text-[12.5px] text-litus-text-2" data-ijara-plan-info-wrap>
                        <svg class="h-4 w-4 shrink-0 text-litus-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <span data-ijara-plan-info>Select a plan to see who it suits.</span>
                    </p>
                </div>

                {{-- 3. Term --}}
                <div class="md:mt-5 md:border-t md:border-litus-line md:pt-4 max-md:rounded-2xl max-md:border max-md:border-litus-line max-md:bg-white max-md:p-4 max-md:shadow-[0_1px_2px_rgba(9,17,32,.04),0_10px_28px_rgba(9,17,32,.05)]">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $stepBadge }}">3</span>
                        <h3 class="{{ $stepTitle }}" id="ijara-term-label">Choose your lease term</h3>
                    </div>
                    {{-- Plan A / Plan B toggle only appears when the model + plan actually offer two rate options --}}
                    <div class="mb-3 hidden items-center gap-3" data-ijara-group-section>
                        <div class="inline-flex gap-1 rounded-xl bg-litus-paper-3 p-1" role="group" aria-label="Plan A or Plan B" data-ijara-group-wrap>
                            <span class="contents" data-ijara-group></span>
                        </div>
                        <template data-ijara-group-template>
                            <button type="button" aria-pressed="false"
                                    class="flex items-baseline gap-1.5 whitespace-nowrap rounded-lg px-3 py-1.5 text-[13px] transition hover:bg-white/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:opacity-45 disabled:hover:bg-transparent aria-pressed:bg-white aria-pressed:shadow-[0_2px_8px_rgba(9,17,32,.12)]">
                                <b class="font-bold text-litus-ink" data-group-label></b>
                                <span class="text-[11.5px] font-medium text-litus-text-3" data-group-months></span>
                            </button>
                        </template>
                        <span class="h-6 w-px bg-litus-line-2" aria-hidden="true"></span>
                        <span class="text-[12.5px] text-litus-text-3">Pick an option to see its months</span>
                    </div>

                    <p class="mb-3 text-[12.5px] text-litus-text-3" data-ijara-term-empty>Choose Plan A or Plan B to pick your months.</p>
                    <div class="grid grid-cols-3 gap-2 min-[480px]:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false"
                                    class="whitespace-nowrap rounded-lg border-[1.5px] border-litus-line-2 bg-white px-3 py-2.5 text-[13px] font-semibold text-litus-ink transition hover:border-litus-primary-light focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:opacity-50 aria-pressed:border-litus-primary aria-pressed:bg-litus-primary aria-pressed:text-white aria-pressed:shadow-[0_4px_12px_rgba(18,87,214,.25)]">{{ $term }} months</button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="flex flex-col overflow-hidden rounded-2xl border border-litus-line bg-white shadow-[0_1px_2px_rgba(9,17,32,.04),0_14px_36px_rgba(9,17,32,.06)]">
                <div class="border-b border-litus-line px-5 py-3.5 sm:px-6">
                    <h3 class="font-display text-[17px] font-bold tracking-[-0.01em] text-litus-ink">Your Ijara summary</h3>
                </div>

                <div class="flex flex-1 flex-col px-5 pb-4 pt-3.5 sm:px-6">
                    <p data-ijara-status data-state="idle" class="litus-ijara-status w-fit">
                        <svg class="h-3.5 w-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <span data-ijara-status-label>Select options</span>
                    </p>

                    <dl class="mt-3.5 flex flex-col divide-y divide-litus-line border-y border-litus-line text-[14px]">
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="text-litus-text-2">Bike</dt>
                            <dd class="text-right font-semibold text-litus-ink" data-ijara-summary-model>-</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="text-litus-text-2">Plan</dt>
                            <dd class="text-right font-semibold text-litus-ink" data-ijara-summary-plan>-</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="text-litus-text-2">Term</dt>
                            <dd class="text-right font-semibold text-litus-ink" data-ijara-summary-term>-</dd>
                        </div>
                    </dl>

                    <div class="mt-3.5 flex items-start gap-2.5 rounded-lg bg-[#EAF2FF] px-3.5 py-2.5">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-litus-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <div class="min-w-0">
                            <p class="text-[12.5px] font-semibold text-litus-ink" data-ijara-quote-title>Choose your options</p>
                            <p class="mt-0.5 text-[12px] leading-snug text-litus-text-2" data-ijara-quote-text>Select a model, plan and lease term to see your figures.</p>
                        </div>
                    </div>

                    <dl class="mt-3.5 flex flex-col divide-y divide-litus-line border-b border-litus-line text-[14px]">
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="text-litus-text-2">Monthly lease</dt>
                            <dd class="text-right text-[15px] font-bold text-litus-ink" data-ijara-monthly>To be confirmed</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="text-litus-text-2">Down payment</dt>
                            <dd class="text-right text-[15px] font-bold text-litus-ink" data-ijara-down>To be confirmed</dd>
                        </div>
                    </dl>

                    <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                       class="mt-3.5 flex min-h-[48px] w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-5 py-2.5 text-[15px] font-semibold text-white shadow-[0_8px_20px_rgba(18,87,214,.25)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover aria-disabled:pointer-events-none aria-disabled:opacity-40 aria-disabled:shadow-none max-md:hidden">
                        <span data-ijara-continue-label>Request a quote</span>
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <p class="mt-2 text-center text-[12px] text-litus-text-3 max-md:hidden" data-ijara-note>Our team will confirm pricing and next steps.</p>

                    <div class="mt-3.5 border-t border-litus-line pt-3.5 text-center md:hidden">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-litus-primary">
                            Need help choosing? <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        {{-- Sticky action bar (mobile). Moved to <body> by home.js so scroll-reveal transforms cannot trap it. --}}
        <div data-ijara-bar class="pointer-events-none fixed inset-x-0 bottom-0 z-[60] translate-y-full border-t border-litus-line bg-white px-4 pb-[calc(0.75rem+env(safe-area-inset-bottom))] pt-2 shadow-[0_-12px_32px_rgba(9,17,32,.14)] transition-transform duration-300 md:hidden">
            <span class="mx-auto mb-1.5 block h-1 w-10 rounded-full bg-litus-line-2" aria-hidden="true"></span>
            <p class="mb-2 text-center text-[12px] font-semibold text-litus-ink" data-ijara-bar-text>Choose your options</p>
            <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
               class="flex min-h-[46px] w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-5 py-2.5 text-[14.5px] font-semibold text-white aria-disabled:pointer-events-none aria-disabled:opacity-40">
                <span data-ijara-continue-label>Request a quote</span>
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
