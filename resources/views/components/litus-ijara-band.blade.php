@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $choice = 'litus-radio-card group relative flex flex-col justify-center rounded-xl border-[1.5px] border-litus-line bg-white px-2.5 py-2.5 text-left transition duration-150 hover:border-litus-primary-light focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:border-litus-line disabled:bg-litus-paper-3 disabled:opacity-55 disabled:hover:border-litus-line aria-pressed:border-litus-primary aria-pressed:bg-[#EAF2FF] aria-pressed:shadow-[0_6px_16px_rgba(18,87,214,.12)]';
    $radio = '<span class="litus-radio" aria-hidden="true"></span>';
    $stepBadge = 'grid h-8 w-8 shrink-0 place-items-center rounded-full bg-litus-primary text-[14px] font-bold text-white shadow-[0_4px_10px_rgba(18,87,214,.28)]';
    $stepTitle = 'font-display text-[17px] font-bold tracking-[-0.02em] text-litus-ink';
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden text-litus-text']) }}
         style="background: radial-gradient(760px 320px at 100% 0%, rgba(46,116,238,.10), transparent 68%), radial-gradient(620px 300px at 0% 100%, rgba(90,184,255,.10), transparent 66%), linear-gradient(180deg, #F7FAFF 0%, #EAF2FD 100%);"
         data-ijara-estimator>
    <div class="litus-container relative z-[2] litus-sec-tight max-md:!py-7">
        {{-- Heading --}}
        <div class="mx-auto mb-6 max-w-[640px] text-center sm:mb-7">
            <h2 class="font-display text-[clamp(24px,3.6vw,38px)] font-extrabold leading-[1.1] tracking-[-0.03em] text-litus-ink">Choose your bike. Make it yours.</h2>
            <p class="mt-2 text-[14px] leading-[1.55] text-litus-text-2 max-md:hidden sm:text-[15.5px]">Select a model, Ijara plan and lease term to request your quote.</p>
        </div>

        <div class="grid items-start gap-4 min-[961px]:grid-cols-[1.6fr_1fr] min-[961px]:gap-5">
            {{-- Steps --}}
            <div class="rounded-[18px] border border-litus-line bg-white p-4 shadow-[0_1px_2px_rgba(9,17,32,.04),0_14px_36px_rgba(9,17,32,.06)] sm:p-6">
                {{-- 1. Bike --}}
                <div>
                    <div class="mb-3.5 flex items-center gap-3">
                        <span class="{{ $stepBadge }}">1</span>
                        <h3 class="{{ $stepTitle }}">Choose your bike</h3>
                    </div>
                    <div class="grid gap-5 md:grid-cols-[1.05fr_1fr] md:items-center">
                        <div class="relative flex h-[210px] items-center justify-center overflow-hidden rounded-xl bg-[linear-gradient(140deg,#F1F5FB_0%,#E3EBF7_100%)] max-md:hidden">
                            <img data-ijara-image src="" alt="" class="relative hidden max-h-[92%] max-w-[92%] object-contain drop-shadow-[0_16px_14px_rgba(9,17,32,.2)]">
                            <div data-ijara-image-empty class="px-6 text-center text-[13px] font-medium text-litus-text-3">Your motorcycle preview appears here</div>
                        </div>
                        <div class="min-w-0">
                            <p class="font-display text-[clamp(20px,2.2vw,26px)] font-bold leading-tight tracking-[-0.02em] text-litus-ink" data-ijara-model-name>Select a model</p>
                            <p class="mt-1 text-[13px] text-litus-text-3" data-ijara-model-hint>Pick a motorcycle to see the plans offered for it.</p>
                            <label for="ijara-model" class="sr-only">Choose your model</label>
                            <div class="litus-select-wrap mt-3.5">
                                <select id="ijara-model" data-ijara-model
                                        class="litus-select w-full cursor-pointer rounded-lg border-[1.5px] border-litus-line-2 bg-white px-3.5 py-2.5 pr-10 text-[14px] font-medium text-litus-text outline-none transition focus:border-litus-primary focus:ring-2 focus:ring-litus-primary/20 disabled:opacity-50"></select>
                                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                            </div>
                            <div class="mt-4 border-t border-litus-line pt-3.5">
                                <span class="text-[12.5px] text-litus-text-3">Vehicle price</span>
                                <b class="mt-0.5 block font-display text-[clamp(22px,2.4vw,28px)] font-extrabold leading-tight tracking-[-0.025em] text-litus-ink" data-ijara-vehicle-price>-</b>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div class="mt-6 border-t border-litus-line pt-5">
                    <div class="mb-3.5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="{{ $stepBadge }}">2</span>
                            <h3 class="{{ $stepTitle }}" id="ijara-plan-label">Choose your Ijara plan</h3>
                        </div>
                        <a href="{{ route('ownership-plans') }}" class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-litus-primary transition hover:gap-2.5 max-sm:hidden">
                            Compare plans <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[560px]:grid-cols-3 lg:grid-cols-5 [&>button:last-child:nth-child(odd)]:col-span-2 min-[560px]:[&>button:last-child:nth-child(odd)]:col-span-1" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $choice }} min-h-[58px]">
                            <span class="flex items-center gap-2.5">
                                {!! $radio !!}
                                <b class="text-[14px] font-bold leading-tight text-litus-ink" data-plan-name></b>
                            </span>
                            <span class="mt-0.5 block whitespace-nowrap pl-[26px] text-[10.5px] leading-snug text-litus-text-3 max-sm:hidden" data-plan-tag></span>
                        </button>
                    </template>
                    <p class="mt-3 flex items-center gap-2 rounded-lg bg-[#EAF2FF] px-3 py-2 text-[12.5px] text-litus-text-2 max-md:hidden" data-ijara-plan-info-wrap>
                        <svg class="h-4 w-4 shrink-0 text-litus-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <span data-ijara-plan-info>Select a plan to see who it suits.</span>
                    </p>
                </div>

                {{-- 3. Term --}}
                <div class="mt-6 border-t border-litus-line pt-5">
                    <div class="mb-3.5 flex items-center gap-3">
                        <span class="{{ $stepBadge }}">3</span>
                        <h3 class="{{ $stepTitle }}" id="ijara-term-label">Choose your lease term</h3>
                    </div>
                    <div class="grid grid-cols-3 gap-2 lg:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false" class="{{ $choice }} min-h-[46px] !flex-row !items-center !justify-start gap-2.5">
                                {!! $radio !!}
                                <span class="whitespace-nowrap text-[14px] font-semibold text-litus-ink">{{ $term }}<span class="max-sm:hidden"> months</span></span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="rounded-[18px] border border-litus-line bg-white p-4 shadow-[0_1px_2px_rgba(9,17,32,.04),0_14px_36px_rgba(9,17,32,.06)] sm:p-5 min-[961px]:sticky min-[961px]:top-[96px]">
                <div class="flex items-center justify-between gap-3">
                    <h3 class="font-display text-[18px] font-bold tracking-[-0.02em] text-litus-ink">Your Ijara summary</h3>
                    <span class="litus-ijara-status" data-ijara-status data-state="idle">Select options</span>
                </div>

                <div class="mt-4 flex items-center gap-3.5 max-md:hidden">
                    <div class="grid h-[64px] w-[84px] shrink-0 place-items-center overflow-hidden rounded-lg bg-[linear-gradient(140deg,#F1F5FB_0%,#E3EBF7_100%)]">
                        <img data-ijara-thumb src="" alt="" class="hidden h-full w-full object-contain p-1">
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-[15px] font-bold text-litus-ink" data-ijara-summary-model>No model selected</p>
                        <p class="text-[13px] text-litus-text-2" data-ijara-summary-price>-</p>
                    </div>
                </div>

                <dl class="mt-3.5 divide-y divide-litus-line border-y border-litus-line text-[13.5px] max-md:hidden">
                    <div class="flex items-start justify-between gap-4 py-2.5">
                        <dt class="text-litus-text-2">Ijara plan</dt>
                        <dd class="text-right"><b class="block font-bold text-litus-ink" data-ijara-summary-plan>-</b><span class="block text-[12px] text-litus-text-3" data-ijara-summary-plan-tag></span></dd>
                    </div>
                    <div class="flex items-center justify-between gap-4 py-2.5">
                        <dt class="text-litus-text-2">Lease term</dt>
                        <dd class="font-bold text-litus-ink" data-ijara-summary-term>-</dd>
                    </div>
                </dl>

                <div class="mt-3.5 flex items-start gap-3 rounded-xl bg-[#EAF2FF] px-3.5 py-3 max-md:hidden">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-[#D6E5FF] text-litus-primary"><x-litus-icon name="file-text" class="h-[18px] w-[18px]" /></span>
                    <div class="min-w-0">
                        <p class="text-[13.5px] font-bold text-litus-ink" data-ijara-quote-title>Choose your options</p>
                        <p class="mt-0.5 text-[12.5px] leading-snug text-litus-text-2" data-ijara-quote-text>Select a model, plan and lease term to see your figures.</p>
                    </div>
                </div>

                <dl class="mt-3 divide-y divide-litus-line rounded-xl bg-litus-paper-2 px-3.5 text-[13.5px]">
                    <div class="flex items-center justify-between gap-4 py-2.5">
                        <dt class="text-litus-text-2">Monthly lease</dt>
                        <dd class="text-right font-bold text-litus-ink" data-ijara-monthly>To be confirmed</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4 py-2.5">
                        <dt class="text-litus-text-2">Down payment</dt>
                        <dd class="text-right font-bold text-litus-ink" data-ijara-down>To be confirmed</dd>
                    </div>
                </dl>

                <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                   class="mt-3.5 flex min-h-[46px] w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-5 py-2.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-litus-primary-hover aria-disabled:pointer-events-none aria-disabled:opacity-40">
                    <span data-ijara-continue-label>Request a quote</span>
                    <x-litus-icon name="arrow-right" class="h-4 w-4" />
                </a>
                <p class="mt-2.5 text-center text-[12px] leading-snug text-litus-text-3 max-md:hidden" data-ijara-note>Send your selection to our team for pricing and next steps.</p>

                <div class="mt-3.5 border-t border-litus-line pt-3.5 text-center max-md:hidden">
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-litus-primary transition hover:gap-2.5">
                        Need help choosing? <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                    </a>
                </div>
            </aside>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
