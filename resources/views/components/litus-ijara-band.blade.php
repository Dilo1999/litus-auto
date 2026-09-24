@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $btn = 'rounded-lg border border-litus-line-2 bg-white px-2 py-2.5 text-center text-[13px] font-semibold leading-tight text-litus-text transition hover:border-litus-primary disabled:cursor-not-allowed disabled:border-litus-line disabled:bg-litus-paper-3 disabled:text-litus-text-3 disabled:hover:border-litus-line aria-pressed:border-litus-primary aria-pressed:bg-litus-primary aria-pressed:text-white';
    $badge = 'grid h-7 w-7 place-items-center rounded-full bg-litus-primary text-[13px] font-bold text-white';
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden bg-litus-paper-2 text-litus-text']) }}
         data-ijara-estimator>
    <div class="pointer-events-none absolute inset-0"
         style="background: radial-gradient(760px 320px at 92% 0%, rgba(18,87,214,.08), transparent 65%);"></div>

    <div class="litus-container relative z-[2] litus-sec max-md:!py-12">
        <div class="mb-7 max-w-[680px] sm:mb-9">
            <span class="mb-2.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Payment Calculator</span>
            <h2 class="font-display text-[clamp(30px,5.2vw,52px)] font-extrabold leading-[1.05] tracking-[-0.035em] text-litus-text">Plan your next ride</h2>
            <p class="mt-3 text-[15px] leading-[1.6] text-litus-text-2 sm:text-[17px]">Choose your model, Ijara plan and repayment term.</p>
        </div>

        <div class="grid items-start gap-5 min-[961px]:grid-cols-[1.6fr_1fr] min-[961px]:gap-6">
            {{-- Steps --}}
            <div class="rounded-2xl border border-litus-line bg-white p-5 shadow-[0_1px_2px_rgba(9,17,32,.05),0_8px_24px_rgba(9,17,32,.05)] sm:p-7">
                {{-- 1. Model --}}
                <div class="flex flex-col gap-4 border-b border-litus-line pb-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="sm:w-[260px] sm:shrink-0">
                        <div class="mb-3 flex items-center gap-3">
                            <span class="{{ $badge }}">1</span>
                            <label for="ijara-model" class="text-[15px] font-bold text-litus-text">Choose your model</label>
                        </div>
                        <select id="ijara-model" data-ijara-model
                                class="w-full rounded-lg border border-litus-line-2 bg-white px-3 py-2.5 text-sm text-litus-text focus:border-litus-primary focus:outline-none focus:ring-1 focus:ring-litus-primary disabled:opacity-50"></select>
                    </div>
                    <div class="flex h-[150px] flex-1 items-center justify-center sm:h-[170px]">
                        <img data-ijara-image src="" alt="" class="hidden max-h-full max-w-full object-contain">
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div class="border-b border-litus-line py-6">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $badge }}">2</span>
                        <span class="text-[15px] font-bold text-litus-text" id="ijara-plan-label">Select your Ijara plan</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[520px]:grid-cols-3 sm:grid-cols-5" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $btn }}"></button>
                    </template>
                </div>

                {{-- 3. Term --}}
                <div class="border-b border-litus-line py-6">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $badge }}">3</span>
                        <span class="text-[15px] font-bold text-litus-text" id="ijara-term-label">Repayment term</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 min-[520px]:grid-cols-3 sm:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false" class="{{ $btn }}">
                                {{ $term }} months
                                <span class="hidden text-[10.5px] font-normal" data-unavailable>Unavailable</span>
                            </button>
                        @endforeach
                    </div>
                    <p class="mt-2.5 text-[12px] text-litus-text-3">Available terms depend on your model and plan.</p>
                </div>

                {{-- 4. Advance --}}
                <div class="pt-6">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="{{ $badge }}">4</span>
                        <label for="ijara-advance" class="text-[15px] font-bold text-litus-text">Advance payment</label>
                    </div>
                    <div class="flex items-center rounded-lg border border-litus-line-2 bg-white focus-within:border-litus-primary focus-within:ring-1 focus-within:ring-litus-primary">
                        <span class="pl-4 text-[15px] font-semibold text-litus-text-3">MVR</span>
                        <input id="ijara-advance" data-ijara-advance type="text" inputmode="numeric" autocomplete="off" placeholder="0"
                               class="w-full rounded-lg border-0 bg-transparent px-3 py-3 text-[15px] font-bold text-litus-text placeholder:text-litus-text-3 focus:outline-none focus:ring-0 disabled:opacity-50">
                    </div>
                    <p class="mt-2 text-[12px] text-litus-text-3" data-ijara-advance-hint>Enter the amount you will pay upfront. It is deducted from the vehicle price.</p>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="overflow-hidden rounded-2xl border border-litus-line bg-white shadow-[0_1px_2px_rgba(9,17,32,.05),0_8px_24px_rgba(9,17,32,.05)] min-[961px]:sticky min-[961px]:top-[96px]">
                <div class="bg-litus-ink px-6 py-4 font-display text-[19px] font-bold text-white">Your payment summary</div>
                <div class="px-6 pb-6 pt-2">
                    <dl class="divide-y divide-litus-line text-[14px]">
                        <div class="flex justify-between gap-4 py-3.5"><dt class="text-litus-text-2">Model</dt><dd class="text-right text-litus-text" data-ijara-summary-model>-</dd></div>
                        <div class="flex justify-between gap-4 py-3.5"><dt class="text-litus-text-2">Ijara plan</dt><dd class="text-right text-litus-text" data-ijara-summary-plan>-</dd></div>
                        <div class="flex justify-between gap-4 py-3.5"><dt class="text-litus-text-2">Term</dt><dd class="text-right text-litus-text" data-ijara-summary-term>-</dd></div>
                        <div class="flex justify-between gap-4 py-3.5"><dt class="text-litus-text-2">Vehicle price</dt><dd class="text-right text-litus-text" data-ijara-summary-price>-</dd></div>
                        <div class="flex justify-between gap-4 py-3.5"><dt class="text-litus-text-2">Advance payment</dt><dd class="text-right font-bold text-litus-text" data-ijara-summary-advance>-</dd></div>
                        <div class="flex justify-between gap-4 py-3.5"><dt class="text-litus-text-2">Amount to lease</dt><dd class="text-right text-litus-text" data-ijara-summary-financed>-</dd></div>
                    </dl>

                    <div class="mt-3 border-t border-litus-line pt-5">
                        <span class="text-[14px] text-litus-text-2">Monthly payment</span>
                        <div class="mt-1 flex items-baseline gap-2">
                            <b class="font-display text-[clamp(30px,4vw,42px)] font-extrabold leading-none tracking-[-0.03em] text-litus-text" data-ijara-monthly>-</b>
                            <span class="text-[14px] text-litus-text-2" data-ijara-per-month hidden>/ month</span>
                        </div>
                        <p class="mt-3 text-[12px] leading-relaxed text-litus-text-3" data-ijara-note>Select a model, plan and term to see your payment.</p>
                    </div>

                    <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                       class="mt-5 flex min-h-12 w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[15px] font-bold text-white transition hover:bg-litus-primary-hover aria-disabled:pointer-events-none aria-disabled:opacity-40">
                        Continue
                        <x-litus-icon name="chevron-right" class="h-4 w-4" />
                    </a>
                    <p class="mt-3 text-center text-[12px] text-litus-text-3">Review your selection before proceeding.</p>
                </div>
            </aside>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
