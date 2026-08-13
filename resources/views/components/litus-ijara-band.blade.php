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
    <div class="relative z-[2] litus-sec">
        <div class="litus-container grid items-center gap-[52px] max-[960px]:grid-cols-1 min-[961px]:grid-cols-[1.05fr_0.95fr]">
            <div>
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-[#5EEAD4]">Ijara Ownership Plans</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">
                    Own it this month.<br>Pay for it over time.
                </h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.78]">
                    Our Ijara Plans are structured to Islamic leasing standards. You agree one fixed lease price at the start and it never changes — no interest, no compounding, and no penalty charges buried in the small print.
                </p>
                <ul class="mt-[26px] grid list-none gap-[13px]">
                    @foreach ($points as $point)
                        <li class="flex gap-3 text-[15px] text-white/90">
                            <span class="mt-0.5 shrink-0 text-[#5EEAD4]">
                                <x-litus-icon name="check-circle" class="h-[17px] w-[17px]" />
                            </span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('ownership-plans') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-teal px-6 py-3.5 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(14,147,132,0.28)] transition hover:-translate-y-0.5">
                        Compare the Six Plans
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, I would like to check Ijara eligibility.') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1FA855] px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443]">
                        <x-litus-icon name="message-circle" class="h-4 w-4" />
                        Check Eligibility
                    </a>
                </div>
            </div>

            <div class="rounded-[26px] border border-white/16 bg-white/[0.07] p-[clamp(26px,3vw,38px)] backdrop-blur-[8px]"
                 data-ijara-estimator>
                <h4 class="mb-1 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em]">Estimate your monthly payment</h4>
                <p class="mb-[22px] text-xs text-white/60">Indicative only — your final plan is confirmed by our sales team.</p>

                <div class="mb-4">
                    <label class="mb-1.5 flex justify-between text-[12.5px] font-semibold text-white/70">
                        Motorcycle price
                        <b class="text-white" data-ijara-price-label>MVR 48,000</b>
                    </label>
                    <input type="range" min="25000" max="120000" step="1000" value="48000"
                           class="w-full accent-[#5EEAD4]" data-ijara-price>
                </div>
                <div class="mb-4">
                    <label class="mb-1.5 flex justify-between text-[12.5px] font-semibold text-white/70">
                        Advance payment
                        <b class="text-white" data-ijara-adv-label>20%</b>
                    </label>
                    <input type="range" min="10" max="50" step="5" value="20"
                           class="w-full accent-[#5EEAD4]" data-ijara-adv>
                </div>
                <div class="mb-4">
                    <label class="mb-1.5 flex justify-between text-[12.5px] font-semibold text-white/70">
                        Plan period
                        <b class="text-white" data-ijara-term-label>24 months</b>
                    </label>
                    <input type="range" min="12" max="48" step="6" value="24"
                           class="w-full accent-[#5EEAD4]" data-ijara-term>
                </div>

                <div class="my-[22px] rounded-[14px] bg-black/26 px-5 py-5 text-center">
                    <span class="text-xs uppercase tracking-[0.11em] text-white/60">Approx. monthly</span>
                    <b class="mt-1 block font-display text-[36px] text-[#5EEAD4]" data-ijara-monthly>MVR 1,760</b>
                </div>
                <p class="text-[11.5px] leading-relaxed text-white/55">
                    Illustration based on a fixed Ijara lease price agreed upfront. This is not an interest calculation, and not a quotation or offer of finance. Final amounts depend on the plan, model and documents provided.
                </p>
            </div>
        </div>
    </div>
</section>
