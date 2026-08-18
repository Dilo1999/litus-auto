@props([
    'points' => null,
])

@php
    $points = $points ?? [
        'Six plans covering employed, self-employed and family-supported buyers',
        'A fixed total price agreed in writing before you sign',
        'Early settlement available at no extra charge',
        'Applications handled at any of our showrooms',
    ];
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-hidden text-white']) }}
         style="background: linear-gradient(118deg, #052B36, #0A4F55 52%, #0E7F74);">
    <div class="pointer-events-none absolute inset-0"
         style="background: radial-gradient(700px 380px at 84% 12%, rgba(45,212,191,.22), transparent 62%);"></div>
    <div class="relative z-[2] litus-sec max-md:!py-12">
        <div class="litus-container grid items-center gap-8 max-md:gap-7 min-[961px]:grid-cols-[1.05fr_0.95fr] min-[961px]:gap-[52px]">
            {{-- Content — below estimator on mobile for action-first UX --}}
            <div class="max-md:order-2">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-[#5EEAD4] sm:mb-3.5">Ijara Ownership Plans</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold leading-[1.12] tracking-[-0.028em]">
                    Own it this month.<br class="max-sm:hidden"> Pay for it over time.
                </h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-white/[0.78] sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Our Ijara Plans are structured to Islamic leasing standards. You agree one fixed lease price at the start and it never changes - no interest, no compounding, and no penalty charges buried in the small print.
                </p>

                <ul class="mt-5 grid list-none gap-2.5 sm:mt-[26px] sm:gap-[13px] min-[400px]:max-md:grid-cols-2 min-[400px]:max-md:gap-3">
                    @foreach ($points as $point)
                        <li class="flex items-start gap-2.5 rounded-xl border border-white/10 bg-white/[0.06] p-3 text-[13px] leading-snug text-white/90 min-[961px]:border-0 min-[961px]:bg-transparent min-[961px]:p-0 min-[961px]:text-[15px] min-[961px]:leading-normal">
                            <span class="mt-0.5 shrink-0 text-[#5EEAD4]">
                                <x-litus-icon name="check-circle" class="h-4 w-4 min-[961px]:h-[17px] min-[961px]:w-[17px]" />
                            </span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-5 flex flex-row gap-2 sm:mt-8 min-[961px]:flex-wrap min-[961px]:gap-3">
                    <a href="{{ route('ownership-plans') }}"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-teal px-3 py-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(14,147,132,0.28)] transition hover:-translate-y-0.5 sm:gap-2 sm:rounded-lg sm:px-6 sm:py-3.5 sm:text-[14.5px] min-[961px]:flex-none">
                        <span class="min-[400px]:hidden">Compare Plans</span>
                        <span class="hidden min-[400px]:inline">Compare the Six Plans</span>
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
                    <span class="text-[10.5px] uppercase tracking-[0.11em] text-white/60 sm:text-xs">Approx. monthly</span>
                    <b class="mt-1 block font-display text-[clamp(28px,8vw,36px)] text-[#5EEAD4] min-[961px]:text-[36px]" data-ijara-monthly>MVR 1,760</b>
                </div>

                <h4 class="order-2 mb-1 font-display text-[clamp(18px,4.5vw,26px)] font-semibold tracking-[-0.02em] min-[961px]:order-1">Estimate your monthly payment</h4>
                <p class="order-3 mb-4 text-[11.5px] text-white/60 sm:mb-[22px] sm:text-xs min-[961px]:order-2">Indicative only - your final plan is confirmed by our sales team.</p>

                <div class="order-4 space-y-4 min-[961px]:order-3 sm:space-y-0">
                    <div class="sm:mb-4">
                        <label class="mb-2 flex items-center justify-between gap-3 text-[12.5px] font-semibold text-white/70">
                            <span>Motorcycle price</span>
                            <b class="shrink-0 rounded-md bg-white/10 px-2 py-0.5 text-sm text-white" data-ijara-price-label>MVR 48,000</b>
                        </label>
                        <input type="range" min="25000" max="120000" step="1000" value="48000"
                               class="litus-ijara-range w-full" data-ijara-price>
                    </div>
                    <div class="sm:mb-4">
                        <label class="mb-2 flex items-center justify-between gap-3 text-[12.5px] font-semibold text-white/70">
                            <span>Advance payment</span>
                            <b class="shrink-0 rounded-md bg-white/10 px-2 py-0.5 text-sm text-white" data-ijara-adv-label>20%</b>
                        </label>
                        <input type="range" min="10" max="50" step="5" value="20"
                               class="litus-ijara-range w-full" data-ijara-adv>
                    </div>
                    <div class="sm:mb-4">
                        <label class="mb-2 flex items-center justify-between gap-3 text-[12.5px] font-semibold text-white/70">
                            <span>Plan period</span>
                            <b class="shrink-0 rounded-md bg-white/10 px-2 py-0.5 text-sm text-white" data-ijara-term-label>24 months</b>
                        </label>
                        <input type="range" min="12" max="48" step="6" value="24"
                               class="litus-ijara-range w-full" data-ijara-term>
                    </div>
                </div>

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
