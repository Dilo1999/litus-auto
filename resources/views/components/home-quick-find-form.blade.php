@props([
    'variant' => 'dark',
    'brands' => null,
])

@php
    $isBar = $variant === 'bar';
    $isLight = $variant === 'light' || $isBar;
    $suffix = $isLight ? ($isBar ? 'Bar' : 'Mobile') : 'Desktop';
    $brandList = $brands ?? collect();

    $cardClass = $isLight
        ? ''
        : 'litus-glow-border rounded-[26px] border border-transparent bg-white/[0.06] p-[clamp(26px,3vw,38px)] shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)] backdrop-blur-[10px] overflow-visible';

    $titleClass = $isLight ? 'text-litus-text' : 'text-white';
    $subtitleClass = $isLight ? 'text-litus-text-2' : 'text-white/60';
    $labelClass = $isLight ? 'text-litus-text-2' : 'text-white/70';

    $selectClass = $isLight
        ? 'litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 pr-10 text-sm text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]'
        : 'litus-select litus-select-glass w-full cursor-pointer rounded-[9px] border-[1.5px] border-white/18 bg-white/[0.07] px-3.5 py-3 pr-10 text-sm text-white outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]';

    $chevronClass = $isLight ? 'text-litus-text-3' : 'text-white/55';
@endphp

@if ($isBar)
    <div class="relative flex flex-col gap-5 overflow-hidden rounded-[22px] border border-white/40 bg-white/45 px-5 py-5 shadow-[0_1px_0_0_rgba(255,255,255,0.75)_inset,0_1px_16px_0_rgba(255,255,255,0.25)_inset,0_24px_60px_rgba(9,17,32,0.22)] ring-1 ring-inset ring-white/30 backdrop-blur-2xl backdrop-saturate-[1.8] sm:px-7 sm:py-6 lg:flex-row lg:items-end lg:gap-7">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-white/35 via-white/5 to-transparent" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/95 to-transparent" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-16 -top-20 h-56 w-56 rounded-full bg-white/35 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-20 -left-10 h-44 w-44 rounded-full bg-litus-primary-light/20 blur-3xl" aria-hidden="true"></div>

        <div class="relative shrink-0 lg:pb-[13px]">
            <h4 class="font-display text-[clamp(18px,1.8vw,22px)] font-bold tracking-[-0.02em] {{ $titleClass }}">Find your ride</h4>
        </div>

        <form action="{{ route('motorcycles') }}" method="get" class="relative grid flex-1 grid-cols-2 gap-3.5 sm:grid-cols-3 sm:gap-4 lg:flex lg:items-end" data-quick-find>
            <div class="lg:min-w-[150px] lg:flex-1">
                <label for="fBrand{{ $suffix }}" class="mb-1.5 block text-[12px] font-semibold tracking-[0.02em] {{ $labelClass }}">Model</label>
                <div class="litus-select-wrap">
                    <select id="fBrand{{ $suffix }}" name="brand" class="{{ $selectClass }}">
                        <option value="all">All models</option>
                        @foreach ($brandList as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 {{ $chevronClass }}" />
                </div>
            </div>

            <div class="lg:min-w-[150px] lg:flex-1">
                <label for="fBudget{{ $suffix }}" class="mb-1.5 block text-[12px] font-semibold tracking-[0.02em] {{ $labelClass }}">Budget</label>
                <div class="litus-select-wrap">
                    <select id="fBudget{{ $suffix }}" name="budget" class="{{ $selectClass }}">
                        <option value="999999">Any budget</option>
                        <option value="60000">Under MVR 60,000</option>
                        <option value="80000">Under MVR 80,000</option>
                        <option value="110000">Under MVR 110,000</option>
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 {{ $chevronClass }}" />
                </div>
            </div>

            <div class="col-span-2 sm:col-span-1 lg:min-w-[150px] lg:flex-1">
                <label for="fPay{{ $suffix }}" class="mb-1.5 block text-[12px] font-semibold tracking-[0.02em] {{ $labelClass }}">Payment</label>
                <div class="litus-select-wrap">
                    <select id="fPay{{ $suffix }}" name="pay" class="{{ $selectClass }}">
                        <option value="ijara">Ijara monthly plan</option>
                        <option value="full">Full payment</option>
                        <option value="unsure">Not sure yet</option>
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 {{ $chevronClass }}" />
                </div>
            </div>

            <button type="submit"
                    class="col-span-2 inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-3.5 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:col-span-3 lg:col-span-1 lg:w-auto">
                Show Bikes
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </button>
        </form>
    </div>
@else
    <div @class([$cardClass])>
        <h4 class="mb-1.5 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] {{ $titleClass }}">Find your ride</h4>
        <p class="mb-5 text-xs {{ $subtitleClass }}">Three questions. We will show you what fits.</p>

        <form action="{{ route('motorcycles') }}" method="get" class="space-y-4" data-quick-find>
            <div>
                <label for="fBrand{{ $suffix }}" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] {{ $labelClass }}">Brand</label>
                <div class="litus-select-wrap">
                    <select id="fBrand{{ $suffix }}" name="brand" class="{{ $selectClass }}">
                        <option value="all" class="bg-white text-litus-text">Any brand</option>
                        @foreach ($brandList as $brand)
                            <option value="{{ $brand }}" class="bg-white text-litus-text">{{ $brand }}</option>
                        @endforeach
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 {{ $chevronClass }}" />
                </div>
            </div>

            <div>
                <label for="fBudget{{ $suffix }}" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] {{ $labelClass }}">Budget</label>
                <div class="litus-select-wrap">
                    <select id="fBudget{{ $suffix }}" name="budget" class="{{ $selectClass }}">
                        <option value="999999" class="bg-white text-litus-text">Any budget</option>
                        <option value="60000" class="bg-white text-litus-text">Under MVR 60,000</option>
                        <option value="80000" class="bg-white text-litus-text">Under MVR 80,000</option>
                        <option value="110000" class="bg-white text-litus-text">Under MVR 110,000</option>
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 {{ $chevronClass }}" />
                </div>
            </div>

            <div>
                <label for="fPay{{ $suffix }}" class="mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] {{ $labelClass }}">How you want to pay</label>
                <div class="litus-select-wrap">
                    <select id="fPay{{ $suffix }}" name="pay" class="{{ $selectClass }}">
                        <option value="ijara" class="bg-white text-litus-text">Ijara monthly plan</option>
                        <option value="full" class="bg-white text-litus-text">Full payment</option>
                        <option value="unsure" class="bg-white text-litus-text">Not sure yet</option>
                    </select>
                    <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 {{ $chevronClass }}" />
                </div>
            </div>

            <button type="submit"
                    class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3.5 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                Show Me Motorcycles
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </button>
        </form>
    </div>
@endif
