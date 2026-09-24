@props([
    'points' => null,
])

@php
    $planWord = \App\Support\IjaraPlans::countWord();
    $points = $points ?? [
        ucfirst($planWord).' plans covering employed, self-employed and family-supported buyers',
        'A fixed total price agreed in writing before you sign',
        'Early settlement available at no extra charge',
        'Applications handled at any of our showrooms',
    ];
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden text-white']) }}
         style="background: linear-gradient(118deg, #061029, #0E2A64 52%, #1B49B8);">
    <div class="pointer-events-none absolute inset-0"
         style="background: radial-gradient(700px 380px at 84% 12%, rgba(90,184,255,.28), transparent 62%);"></div>
    <div class="relative z-[2] litus-sec max-md:!py-12">
        <div class="litus-container grid items-center gap-8 max-md:gap-7 min-[961px]:grid-cols-[1.05fr_0.95fr] min-[961px]:gap-[52px]">
            {{-- Content — below estimator on mobile for action-first UX --}}
            <div class="max-md:order-2">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky sm:mb-3.5">Ijara Ownership Plans</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold leading-[1.12] tracking-[-0.028em]">
                    Own it this month.<br class="max-sm:hidden"> Pay for it over time.
                </h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-white/[0.78] sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Our Ijara Plans are structured to Islamic leasing standards. You agree one fixed lease price at the start and it never changes - no interest, no compounding, and no penalty charges buried in the small print.
                </p>

                <ul class="mt-5 grid list-none gap-2.5 sm:mt-[26px] sm:gap-[13px] min-[400px]:max-md:grid-cols-2 min-[400px]:max-md:gap-3">
                    @foreach ($points as $point)
                        <li class="flex items-start gap-2.5 rounded-xl border border-white/10 bg-white/[0.06] p-3 text-[13px] leading-snug text-white/90 min-[961px]:border-0 min-[961px]:bg-transparent min-[961px]:p-0 min-[961px]:text-[15px] min-[961px]:leading-normal">
                            <span class="mt-0.5 shrink-0 text-litus-sky">
                                <x-litus-icon name="check-circle" class="h-4 w-4 min-[961px]:h-[17px] min-[961px]:w-[17px]" />
                            </span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-5 flex flex-row gap-2 sm:mt-8 min-[961px]:flex-wrap min-[961px]:gap-3">
                    <a href="{{ route('ownership-plans') }}"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-3 py-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.35)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:gap-2 sm:rounded-lg sm:px-6 sm:py-3.5 sm:text-[14.5px] min-[961px]:flex-none">
                        <span class="min-[400px]:hidden">Compare Plans</span>
                        <span class="hidden min-[400px]:inline">Compare the {{ ucfirst($planWord) }} Plans</span>
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0 sm:h-4 sm:w-4" />
                    </a>
                    <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, I would like to check Ijara eligibility.') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-[#1FA855] px-3 py-3 text-[13px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443] sm:gap-2 sm:rounded-lg sm:px-6 sm:py-3.5 sm:text-[14.5px] min-[961px]:flex-none">
                        <x-litus-icon name="message-circle" class="h-3.5 w-3.5 shrink-0 sm:h-4 sm:w-4" />
                        Check Eligibility
                    </a>
                </div>
            </div>

            {{-- Estimator — first on mobile so users can try numbers immediately --}}
            <div class="flex max-md:order-1 flex-col rounded-[20px] border border-white/16 bg-white/[0.07] p-5 backdrop-blur-[8px] sm:rounded-[22px] sm:p-[clamp(20px,3vw,38px)] min-[961px]:rounded-[26px]"
                 data-ijara-estimator>
                <div class="order-1 mb-5 rounded-[14px] bg-black/26 px-4 py-4 text-center min-[961px]:order-4 min-[961px]:my-[22px] min-[961px]:mb-0 sm:px-5 sm:py-5">
                    <div data-ijara-result hidden>
                        <p class="text-[12px] font-semibold text-white/80" data-ijara-summary></p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <div>
                                <span class="text-[10.5px] uppercase tracking-[0.11em] text-white/60 sm:text-xs">Minimum advance</span>
                                <b class="mt-1 block font-display text-[clamp(20px,5.5vw,26px)] text-white" data-ijara-advance></b>
                            </div>
                            <div>
                                <span class="text-[10.5px] uppercase tracking-[0.11em] text-white/60 sm:text-xs">Monthly payment</span>
                                <b class="mt-1 block font-display text-[clamp(20px,5.5vw,26px)] text-litus-sky" data-ijara-monthly></b>
                            </div>
                        </div>
                    </div>
                    <p class="text-[13px] text-white/70" data-ijara-empty>Select a model, plan and term to see your payment.</p>
                </div>

                <h4 class="order-2 mb-1 font-display text-[clamp(18px,4.5vw,26px)] font-semibold tracking-[-0.02em] min-[961px]:order-1">Check your monthly payment</h4>
                <p class="order-3 mb-4 text-[11.5px] text-white/60 sm:mb-[22px] sm:text-xs min-[961px]:order-2">Approved minimum advance and monthly payment - final plan is confirmed by our sales team.</p>

                <div class="order-4 space-y-4 min-[961px]:order-3 sm:space-y-0">
                    @foreach ([['model', 'Vehicle model'], ['plan', 'Ijara plan']] as [$field, $label])
                        <div class="sm:mb-4">
                            <label class="mb-2 block text-[12.5px] font-semibold text-white/70" for="ijara-{{ $field }}">{{ $label }}</label>
                            <select id="ijara-{{ $field }}" data-ijara-{{ $field }}
                                    class="w-full rounded-lg border border-white/20 bg-[#0E2A64] px-3 py-2.5 text-sm text-white disabled:opacity-50">
                            </select>
                        </div>
                    @endforeach
                    <div class="sm:mb-4">
                        <span class="mb-2 block text-[12.5px] font-semibold text-white/70" id="ijara-term-label">Repayment term</span>
                        <div class="grid grid-cols-2 gap-2 min-[400px]:grid-cols-3" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                            @foreach (\App\Support\IjaraPlans::termsFor() as $term)
                                <button type="button" data-term="{{ $term }}" aria-pressed="false"
                                        class="rounded-lg border border-white/20 bg-white px-2 py-2 text-center text-[13px] font-semibold leading-tight text-slate-800 transition disabled:cursor-not-allowed disabled:bg-white/25 disabled:text-white/50 aria-pressed:border-[#E31E25] aria-pressed:bg-[#E31E25] aria-pressed:text-white">
                                    {{ $term }} months
                                    <span class="hidden text-[10.5px] font-normal" data-unavailable>Unavailable</span>
                                </button>
                            @endforeach
                        </div>
                        <p class="mt-2 text-[11.5px] text-white/60">Available terms depend on your model and plan.</p>
                    </div>
                </div>
                <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>

                <p class="order-5 mt-4 text-[11px] leading-relaxed text-white/55 sm:text-[11.5px] min-[961px]:order-5 min-[961px]:mt-0 min-[961px]:hidden">
                    Fixed Ijara lease illustration — not a quotation. Final amounts depend on plan, model and documents.
                </p>
                <p class="order-5 hidden text-[11.5px] leading-relaxed text-white/55 min-[961px]:order-5 min-[961px]:block min-[961px]:mt-0">
                    Illustration based on a fixed Ijara lease price agreed upfront. This is not an interest calculation, and not a quotation or offer of finance. Final amounts depend on the plan, model and documents provided.
                </p>
            </div>
        </div>
    </div>
</section>
