@php
    $terms = \App\Support\IjaraPlans::termsFor();
    $card = 'rounded-3xl border border-[#d6e1ee] bg-white/95 p-5 shadow-[0_18px_50px_rgba(33,72,120,.08),0_2px_8px_rgba(33,72,120,.03)] sm:p-[25px]';
    $stepHead = 'mb-5 flex items-start justify-between gap-4 max-[520px]:flex-col max-[520px]:gap-3';
    $stepBadge = 'grid h-[38px] w-[38px] shrink-0 place-items-center rounded-full bg-litus-primary text-[16px] font-extrabold text-white shadow-[0_6px_14px_rgba(18,87,214,.25)]';
    $stepTitle = 'font-display text-[19px] font-extrabold tracking-[-0.02em] text-litus-ink sm:text-[20px]';
    $stepSub = 'mt-0.5 text-[13px] leading-normal text-[#71809c]';
    $pillBtn = 'inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap rounded-full border border-[#bfd3ee] bg-white px-4 py-2.5 text-[13px] font-bold text-litus-primary transition hover:border-litus-primary hover:bg-[#eef5ff] max-sm:px-3 max-sm:py-2 max-sm:text-[12px]';
    $checkBadge = 'absolute -right-2 -top-2 hidden h-[22px] w-[22px] place-items-center rounded-full bg-litus-primary text-white shadow-[0_4px_8px_rgba(18,87,214,.25)] ring-2 ring-white group-aria-pressed:grid';
    $choice = 'group relative flex min-h-[70px] items-center gap-2.5 rounded-[14px] border border-[#dfe7f1] bg-[#f9fbfe] p-3 text-left transition duration-200 hover:-translate-y-px hover:border-[#8eb7ef] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:translate-y-0 disabled:hover:border-[#dfe7f1] aria-pressed:border-litus-primary aria-pressed:bg-[#f1f6ff] aria-pressed:shadow-[0_0_0_.5px_var(--color-litus-primary),0_4px_14px_rgba(18,87,214,.08)]';
    $planIcons = ['prime' => 'crown', 'family' => 'users', 'secure' => 'shield', 'flexi' => 'refresh-cw', 'freedom' => 'send', 'premium' => 'award'];
    $specs = ['engine' => [null, 'Engine'], 'transmission' => ['settings', 'Transmission'], 'tank' => ['fuel', 'Fuel tank']];
    $steps = ['Select Model', 'Plan & Terms', 'Get Quote'];
@endphp

<section {{ $attributes->merge(['class' => 'relative overflow-clip text-litus-text']) }}
         style="background: radial-gradient(760px 320px at 100% 0%, rgba(46,116,238,.10), transparent 68%), radial-gradient(620px 300px at 0% 100%, rgba(90,184,255,.10), transparent 66%), linear-gradient(180deg, #F7FAFF 0%, #EAF2FD 100%);"
         data-ijara-estimator>
    <div class="litus-container relative z-[2] litus-sec-tight !py-24 max-md:!pb-28 max-md:!pt-[72px]">
        {{-- Heading --}}
        <div class="mx-auto mb-5 max-w-[640px] text-center">
            <span class="mb-1.5 block text-[12px] font-bold uppercase tracking-[0.2em] text-litus-primary md:hidden">Find your next ride</span>
            <h2 class="font-display text-[clamp(22px,3vw,32px)] font-extrabold leading-[1.1] tracking-[-0.03em] text-litus-ink">Choose your bike.<br class="md:hidden"> Make it yours.</h2>
            <p class="mt-1 text-[14px] leading-[1.5] text-litus-text-2 sm:text-[15.5px]">Select a model, Ijara plan and lease term to request your quote.</p>
        </div>

        {{-- Progress --}}
        <ol class="mb-7 flex items-center justify-center gap-3 sm:gap-4" aria-label="Quote progress">
            @foreach ($steps as $i => $label)
                @if ($i > 0)
                    <li class="h-px w-6 bg-[#b8c7da] sm:w-[70px]" aria-hidden="true"></li>
                @endif
                <li class="litus-ijara-step" data-ijara-step="{{ $i + 1 }}" data-state="{{ $i === 0 ? 'active' : 'todo' }}" @if ($i === 0) aria-current="step" @endif>
                    <span class="litus-ijara-step-num">{{ $i + 1 }}</span>
                    <span class="max-sm:sr-only">{{ $label }}</span>
                </li>
            @endforeach
        </ol>

        <div class="grid items-start gap-5 min-[961px]:grid-cols-[minmax(0,1.65fr)_minmax(340px,.95fr)] min-[961px]:gap-[22px]">
            {{-- Steps --}}
            <div class="flex min-w-0 flex-col gap-[18px]">
                {{-- 1. Bike --}}
                <div class="{{ $card }}">
                    <div class="{{ $stepHead }}">
                        <div class="flex items-start gap-3.5">
                            <span class="{{ $stepBadge }}">1</span>
                            <div>
                                <h3 class="{{ $stepTitle }}">Choose your bike</h3>
                                <p class="{{ $stepSub }}">Select a model to see available plans and terms</p>
                            </div>
                        </div>
                        <a href="{{ route('motorcycles') }}" class="{{ $pillBtn }}">
                            View all models <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>

                    <div class="grid items-center gap-6 md:grid-cols-[1.1fr_1fr] md:gap-7">
                        <div class="relative flex min-h-[245px] items-center justify-center overflow-hidden rounded-[22px] bg-[radial-gradient(circle_at_center,#fff_0%,#edf4fb_100%)] max-md:min-h-[220px]">
                            <span data-ijara-watermark class="pointer-events-none absolute left-[4%] top-[3%] select-none whitespace-nowrap font-display text-[clamp(64px,9vw,120px)] font-black leading-none tracking-[-0.07em] text-[#dfe6ef] opacity-80" aria-hidden="true"></span>
                            <img data-ijara-image src="" alt="" class="relative z-[2] hidden max-h-[230px] w-[88%] object-contain drop-shadow-[0_18px_14px_rgba(0,0,0,.13)]">
                            <div data-ijara-image-empty class="relative z-[2] px-6 text-center text-[13px] font-medium text-litus-text-3">Your motorcycle preview appears here</div>
                        </div>

                        <div class="flex min-w-0 flex-col">
                            <span data-ijara-brand class="mb-1 hidden text-[12px] font-bold uppercase tracking-[0.16em] text-litus-primary"></span>
                            <p class="font-display text-[clamp(24px,2.4vw,30px)] font-extrabold leading-tight tracking-[-0.025em] text-litus-ink" data-ijara-model-name>Select a model</p>
                            <p class="mt-1.5 text-[14px] text-[#71809c]" data-ijara-model-hint>Pick a motorcycle to see the plans offered for it.</p>

                            <label for="ijara-model" class="sr-only">Choose your model</label>
                            <div class="litus-select-wrap mt-4">
                                <select id="ijara-model" data-ijara-model
                                        class="litus-select w-full cursor-pointer rounded-xl border-[1.5px] border-litus-line-2 bg-white px-3.5 py-2.5 pr-10 text-[14px] font-semibold text-litus-text outline-none transition focus:border-litus-primary focus:ring-2 focus:ring-litus-primary/20 disabled:opacity-50"></select>
                                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
                            </div>

                            <div data-ijara-specs class="mt-5 hidden grid-cols-3 gap-3.5">
                                @foreach ($specs as $key => [$icon, $label])
                                    <div data-ijara-spec="{{ $key }}" class="flex min-w-0 items-center gap-2 max-[420px]:flex-col max-[420px]:text-center">
                                        @if ($key === 'engine')
                                            <img src="{{ asset('images/details_page/'.rawurlencode('icons8-engine-50 (2).png')) }}" alt="" class="h-5 w-5 shrink-0 object-contain" aria-hidden="true">
                                        @else
                                            <x-litus-icon :name="$icon" class="h-5 w-5 shrink-0 text-[#203656]" />
                                        @endif
                                        <div class="min-w-0">
                                            <span class="block truncate text-[13px] font-extrabold text-litus-ink" data-spec-value></span>
                                            <span class="mt-0.5 block text-[10.5px] text-[#71809c]">{{ $label }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-5 rounded-2xl bg-gradient-to-br from-[#f5f9ff] to-[#eef5ff] p-[18px]">
                                <span class="mb-1 block text-[12px] text-[#647590]">Vehicle price</span>
                                <b class="block font-display text-[clamp(24px,2.6vw,30px)] font-extrabold leading-tight tracking-[-0.025em] text-litus-ink min-h-[1.25em]" data-ijara-vehicle-price></b>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Plan --}}
                <div class="{{ $card }}">
                    <div class="{{ $stepHead }}">
                        <div class="flex items-start gap-3.5">
                            <span class="{{ $stepBadge }}">2</span>
                            <div>
                                <h3 class="{{ $stepTitle }}" id="ijara-plan-label">Choose your Ijara plan</h3>
                                <p class="{{ $stepSub }}">Select a plan that suits your needs</p>
                            </div>
                        </div>
                        <a href="{{ route('ownership-plans') }}" class="{{ $pillBtn }}">
                            <x-litus-icon name="bar-chart" class="h-3.5 w-3.5" /> Compare plans <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 min-[560px]:grid-cols-3 xl:grid-cols-5" role="group" aria-labelledby="ijara-plan-label" data-ijara-plan-group></div>
                    <template data-ijara-plan-template>
                        <button type="button" aria-pressed="false" class="{{ $choice }}">
                            <span class="grid h-6 w-6 shrink-0 place-items-center text-litus-primary">
                                @foreach ($planIcons as $key => $icon)
                                    <x-litus-icon :name="$icon" class="hidden h-5 w-5" data-plan-icon="{{ $key }}" />
                                @endforeach
                                <x-litus-icon name="file-text" class="hidden h-5 w-5" data-plan-icon="" />
                            </span>
                            <span class="min-w-0">
                                <b class="block text-[13.5px] font-extrabold leading-tight text-litus-ink" data-plan-name></b>
                                <span class="mt-0.5 block text-[10.5px] leading-tight text-[#71809c]" data-plan-tag></span>
                            </span>
                            <span class="{{ $checkBadge }}" aria-hidden="true"><x-litus-icon name="check" class="h-3 w-3" stroke-width="3" /></span>
                        </button>
                    </template>

                    <p class="mt-3.5 flex items-center gap-2 rounded-[11px] bg-[#edf4ff] px-3.5 py-3 text-[12.5px] text-[#647590]" data-ijara-plan-info-wrap>
                        <x-litus-icon name="info" class="h-4 w-4 shrink-0 text-litus-primary" />
                        <span data-ijara-plan-info>Select a plan to see who it suits.</span>
                    </p>
                </div>

                {{-- 3. Term --}}
                <div class="{{ $card }}">
                    <div class="{{ $stepHead }}">
                        <div class="flex items-start gap-3.5">
                            <span class="{{ $stepBadge }}">3</span>
                            <div>
                                <h3 class="{{ $stepTitle }}" id="ijara-term-label">Choose your lease term</h3>
                                <p class="{{ $stepSub }}">Select the repayment term</p>
                            </div>
                        </div>
                        <p class="flex items-center gap-1.5 self-center text-[12px] text-[#71809c] max-sm:hidden">
                            <x-litus-icon name="calendar" class="h-4 w-4" /> Monthly payment will update automatically
                        </p>
                    </div>

                    {{-- Plan A / Plan B toggle only appears when the model + plan actually offer two rate options --}}
                    <div class="mb-4 hidden flex-wrap items-center gap-3" data-ijara-group-section>
                        <div class="inline-flex gap-[3px] rounded-xl bg-[#eff4fa] p-[5px]" role="group" aria-label="Plan A or Plan B" data-ijara-group-wrap>
                            <span class="contents" data-ijara-group></span>
                        </div>
                        <template data-ijara-group-template>
                            <button type="button" aria-pressed="false"
                                    class="flex items-baseline gap-1.5 whitespace-nowrap rounded-[9px] px-[18px] py-2 text-[13.5px] font-bold text-[#6f7f98] transition hover:bg-white/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:opacity-45 disabled:hover:bg-transparent aria-pressed:bg-white aria-pressed:text-litus-ink aria-pressed:shadow-[0_3px_10px_rgba(27,51,87,.09)]">
                                <b data-group-label></b>
                                <span class="text-[11.5px] font-medium text-[#8593aa]" data-group-months></span>
                            </button>
                        </template>
                        <span class="text-[12.5px] text-[#71809c]">Pick an option to see its months</span>
                    </div>

                    <p class="mb-3 text-[12.5px] text-[#71809c]" data-ijara-term-empty>Choose Plan A or Plan B to pick your months.</p>
                    <div class="grid grid-cols-3 gap-2.5 min-[480px]:grid-cols-5" role="group" aria-labelledby="ijara-term-label" data-ijara-term>
                        @foreach ($terms as $term)
                            <button type="button" data-term="{{ $term }}" aria-pressed="false"
                                    class="group flex h-[50px] items-center justify-center gap-1.5 whitespace-nowrap rounded-[11px] border border-[#dfe7f1] bg-white px-2 text-[13.5px] font-bold text-[#35425a] transition hover:border-litus-primary hover:text-litus-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-litus-primary/40 disabled:cursor-not-allowed disabled:opacity-45 disabled:hover:border-[#dfe7f1] disabled:hover:text-[#35425a] aria-pressed:border-litus-primary aria-pressed:bg-litus-primary aria-pressed:text-white aria-pressed:shadow-[0_6px_14px_rgba(18,87,214,.2)] aria-pressed:hover:text-white">
                                <span class="hidden h-[18px] w-[18px] shrink-0 place-items-center rounded-full bg-white text-litus-primary group-aria-pressed:grid" aria-hidden="true"><x-litus-icon name="check" class="h-3 w-3" stroke-width="3" /></span>
                                {{ $term }} months
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Summary — on mobile this becomes a popup that opens once model + plan + term are all picked --}}
            <aside data-ijara-summary
                   class="flex flex-col overflow-hidden rounded-[25px] bg-[linear-gradient(145deg,#123873_0%,#1157ce_48%,#2773ed_100%)] shadow-[0_22px_55px_rgba(20,78,160,.16)] min-[961px]:sticky min-[961px]:top-24 max-[960px]:fixed max-[960px]:inset-x-0 max-[960px]:bottom-0 max-[960px]:top-auto max-[960px]:z-[80] max-[960px]:max-h-[85vh] max-[960px]:translate-y-full max-[960px]:overflow-y-auto max-[960px]:rounded-b-none max-[960px]:transition-transform max-[960px]:duration-300">
                <div class="relative flex items-center gap-4 px-6 pb-[22px] pt-6 text-white sm:px-7 sm:pt-7">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-full border border-white/15 bg-white/15">
                        <x-litus-icon name="file-text" class="h-6 w-6" />
                    </span>
                    <div class="min-w-0 max-[960px]:pr-8">
                        <h3 class="font-display text-[21px] font-bold tracking-[-0.01em] sm:text-[22px]">Your Ijara summary</h3>
                        <p class="mt-1 text-[12.5px] text-white/80">Review your selection and get your final quote</p>
                    </div>
                    <button type="button" data-ijara-summary-close aria-label="Close" class="absolute right-4 top-4 hidden h-9 w-9 place-items-center rounded-full text-white/80 transition hover:bg-white/15 hover:text-white max-[960px]:grid">
                        <x-litus-icon name="x" class="h-[18px] w-[18px]" />
                    </button>
                </div>

                <div class="mx-3 mb-3 flex flex-1 flex-col rounded-[22px] bg-white p-4 sm:p-5">
                    <div data-ijara-status data-state="idle" class="litus-ijara-status" role="status" aria-live="polite">
                        <span class="litus-ijara-status-dot">
                            <x-litus-icon name="info" class="h-4 w-4" data-status-icon="idle" />
                            <x-litus-icon name="alert-triangle" class="h-4 w-4" data-status-icon="quote" />
                            <x-litus-icon name="check" class="h-4 w-4" stroke-width="3" data-status-icon="ready" />
                        </span>
                        <div class="min-w-0">
                            <strong class="litus-ijara-status-title block text-[13.5px] font-bold" data-ijara-status-label>Select your options</strong>
                            <small class="litus-ijara-status-text mt-0.5 block text-[11.5px] leading-snug" data-ijara-quote-text>Select a model, plan and lease term to see your figures.</small>
                        </div>
                    </div>

                    <dl class="mt-1.5 divide-y divide-[#e5eaf1] text-[13.5px]">
                        <div class="flex min-h-[53px] items-center justify-between gap-3">
                            <dt class="flex items-center gap-2.5 text-[#647590]"><x-litus-icon name="bike" class="h-5 w-5 shrink-0 text-[#3f587a]" /> Bike model</dt>
                            <dd class="text-right font-extrabold text-litus-ink" data-ijara-summary-model>-</dd>
                        </div>
                        <div class="flex min-h-[53px] items-center justify-between gap-3">
                            <dt class="flex items-center gap-2.5 text-[#647590]"><x-litus-icon name="file-text" class="h-5 w-5 shrink-0 text-[#3f587a]" /> Ijara plan</dt>
                            <dd class="text-right font-extrabold text-litus-ink" data-ijara-summary-plan>-</dd>
                        </div>
                        <div class="flex min-h-[53px] items-center justify-between gap-3">
                            <dt class="flex items-center gap-2.5 text-[#647590]"><x-litus-icon name="calendar" class="h-5 w-5 shrink-0 text-[#3f587a]" /> Lease term</dt>
                            <dd class="text-right font-extrabold text-litus-ink" data-ijara-summary-term>-</dd>
                        </div>
                        <div class="flex min-h-[53px] items-center justify-between gap-3">
                            <dt class="flex items-center gap-2.5 text-[#647590]"><x-litus-icon name="wallet" class="h-5 w-5 shrink-0 text-[#3f587a]" /> Monthly lease</dt>
                            <dd class="text-right text-[16px] font-extrabold text-litus-primary sm:text-[17px]" data-ijara-monthly>To be confirmed</dd>
                        </div>
                        <div class="flex min-h-[53px] items-center justify-between gap-3">
                            <dt class="flex items-center gap-2.5 text-[#647590]"><x-litus-icon name="hand-coins" class="h-5 w-5 shrink-0 text-[#3f587a]" /> Down payment</dt>
                            <dd class="text-right text-[16px] font-extrabold text-litus-primary sm:text-[17px]" data-ijara-down>To be confirmed</dd>
                        </div>
                    </dl>

                    <div class="mt-3 flex items-center gap-3 rounded-[13px] bg-gradient-to-br from-[#f0f6ff] to-[#e5f0ff] p-4">
                        <x-litus-icon name="coins" class="h-7 w-7 shrink-0 text-litus-primary" />
                        <div class="min-w-0 flex-1">
                            <strong class="block text-[13.5px] font-bold text-litus-primary">Total amount</strong>
                            <small class="block text-[10.5px] leading-snug text-[#6d7c94]">(Down payment + All monthly payments)</small>
                        </div>
                        <b class="whitespace-nowrap text-right font-display text-[clamp(20px,2vw,24px)] font-extrabold text-litus-primary data-[pending=true]:text-[14px] data-[pending=true]:font-bold" data-ijara-total data-pending="true">To be confirmed</b>
                    </div>

                    <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
                       class="mt-[18px] flex h-[55px] w-full items-center justify-center gap-2.5 rounded-xl bg-gradient-to-r from-litus-primary to-[#1768ea] text-[15px] font-extrabold text-white shadow-[0_8px_18px_rgba(18,87,214,.24)] transition hover:-translate-y-0.5 hover:shadow-[0_12px_24px_rgba(18,87,214,.3)] aria-disabled:pointer-events-none aria-disabled:opacity-40 aria-disabled:shadow-none">
                        <span data-ijara-continue-label>Request a quote</span>
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>

                    <p class="mt-3.5 rounded-[11px] bg-[#f1f6fd] px-4 py-3 text-center text-[11.5px] leading-relaxed text-[#71809a]">
                        <x-litus-icon name="info" class="mr-1 inline h-3.5 w-3.5 -translate-y-px text-litus-primary" />
                        <span data-ijara-note>Our team will confirm pricing and next steps.</span>
                    </p>

                    <div class="mt-3.5 border-t border-litus-line pt-3.5 text-center md:hidden">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-[13.5px] font-semibold text-litus-primary">
                            Need help choosing? <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        <div data-ijara-summary-backdrop class="max-[960px]:fixed max-[960px]:inset-0 max-[960px]:z-[75] max-[960px]:bg-litus-ink/50 max-[960px]:backdrop-blur-[2px] max-[960px]:opacity-0 max-[960px]:pointer-events-none max-[960px]:transition-opacity max-[960px]:duration-300"></div>

        {{-- Sticky action bar (mobile). Moved to <body> by home.js so scroll-reveal transforms cannot trap it. --}}
        <div data-ijara-bar class="hidden pointer-events-none fixed inset-x-0 bottom-0 z-[60] translate-y-full border-t border-litus-line bg-white px-4 pb-[calc(0.75rem+env(safe-area-inset-bottom))] pt-2 shadow-[0_-12px_32px_rgba(9,17,32,.14)] transition-transform duration-300 md:hidden">
            <span class="mx-auto mb-1.5 block h-1 w-10 rounded-full bg-litus-line-2" aria-hidden="true"></span>
            <p class="mb-2 text-center text-[12px] font-semibold text-litus-ink" data-ijara-bar-text>Choose your options</p>
            <a href="#" target="_blank" rel="noopener noreferrer" data-ijara-continue aria-disabled="true"
               class="flex min-h-[46px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-litus-primary to-[#1768ea] px-5 py-2.5 text-[14.5px] font-bold text-white aria-disabled:pointer-events-none aria-disabled:opacity-40">
                <span data-ijara-continue-label>Request a quote</span>
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>

        <script type="application/json" data-ijara-data>@json(\App\Support\IjaraRates::calculatorData())</script>
    </div>
</section>
