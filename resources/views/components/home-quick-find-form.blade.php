@props([
    'variant' => 'dark',
    'brands' => null,
])

@php
    $isLight = $variant === 'light';
    $suffix = $isLight ? 'Mobile' : 'Desktop';
    $brandList = $brands ?? collect();

    $cardClass = $isLight
        ? ''
        : 'rounded-[26px] border border-white/15 bg-white/[0.06] p-[clamp(26px,3vw,38px)] shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)] backdrop-blur-[10px] overflow-visible';

    $titleClass = $isLight ? 'text-litus-text' : 'text-white';
    $subtitleClass = $isLight ? 'text-litus-text-2' : 'text-white/60';
    $labelClass = $isLight ? 'text-litus-text-2' : 'text-white/70';

    $selectClass = $isLight
        ? 'litus-select w-full cursor-pointer rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 pr-10 text-sm text-litus-text outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]'
        : 'litus-select litus-select-glass w-full cursor-pointer rounded-[9px] border-[1.5px] border-white/18 bg-white/[0.07] px-3.5 py-3 pr-10 text-sm text-white outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]';

    $chevronClass = $isLight ? 'text-litus-text-3' : 'text-white/55';
@endphp

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
