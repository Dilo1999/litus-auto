@props([
    'brands' => [],
    'categoryPills' => [],
])

@php
    $fieldLabel = 'mb-1.5 block text-[12px] font-semibold text-white/70 sm:text-[12.5px]';
    $fieldControl = 'w-full rounded-[10px] border border-white/22 bg-white/[0.08] px-3 py-2.5 text-[14px] text-white outline-none transition placeholder:text-white/40 focus:border-litus-sky/60 focus:bg-white/[0.12] sm:px-3.5 sm:py-3 sm:text-[14.5px]';
@endphp

<div {{ $attributes->class(['rounded-2xl border border-white/15 bg-white/[0.06] p-5 backdrop-blur-[10px] sm:rounded-[26px] sm:p-[clamp(22px,3vw,32px)]']) }}>
    <form data-parts-inquiry-form class="grid grid-cols-1 gap-3.5 sm:grid-cols-2 sm:gap-4" action="#" method="post">
        @csrf
        <input type="hidden" name="category" value="" data-parts-category-input>

        <div>
            <label class="{{ $fieldLabel }}">Motorcycle brand</label>
            <div class="litus-select-wrap">
                <select name="brand" required class="litus-select litus-select-glass {{ $fieldControl }} pr-10 [color-scheme:dark]">
                    <option value="">Select a brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-white/60" />
            </div>
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Year of make</label>
            <input type="text" name="year" placeholder="e.g. 2023" class="{{ $fieldControl }}">
        </div>
        <div class="sm:col-span-2">
            <label class="{{ $fieldLabel }}">Motorcycle model</label>
            <input type="text" name="model" placeholder="Enter motorcycle model" class="{{ $fieldControl }}">
        </div>
        <div class="sm:col-span-2">
            <label class="{{ $fieldLabel }}">Select a category</label>
            <div class="mt-1 flex gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:flex-wrap sm:overflow-visible sm:pb-0">
                @foreach ($categoryPills as $pill)
                    <button type="button"
                            data-parts-category="{{ $pill }}"
                            class="shrink-0 rounded-full border border-white/12 bg-white/[0.09] px-3 py-1.5 text-[12px] font-semibold text-white/80 transition hover:border-white/25 hover:bg-white/[0.14] sm:px-3.5 sm:text-[12.5px]">
                        {{ $pill }}
                    </button>
                @endforeach
            </div>
        </div>
        <div class="sm:col-span-2">
            <label class="{{ $fieldLabel }}">Parts you need</label>
            <textarea name="parts" rows="3" placeholder="Describe the parts you need…" class="{{ $fieldControl }} min-h-[88px] resize-y sm:min-h-[96px]"></textarea>
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Your full name</label>
            <input type="text" name="name" placeholder="Full name" class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Contact number</label>
            <input type="tel" name="contact" placeholder="7XXXXXX" class="{{ $fieldControl }}">
        </div>
        <div class="sm:col-span-2">
            <button type="submit"
                    class="inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:px-8 sm:py-[17px] sm:text-[15.5px]">
                Send Inquiry
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </button>
            <p class="mt-3 text-center text-xs text-white/50 sm:mt-3.5">
                Our team will respond within one working day.
            </p>
        </div>
    </form>

    <div data-parts-inquiry-success class="hidden py-10 text-center">
        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full bg-[rgba(90,184,255,0.16)] text-litus-sky">
            <x-litus-icon name="check-circle" class="h-8 w-8" />
        </div>
        <h3 class="font-display text-2xl font-bold text-white">Inquiry sent</h3>
        <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-white/70">
            Our parts team will respond within one working day with availability and next steps.
        </p>
        <button type="button"
                data-parts-inquiry-reset
                class="mt-7 inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-3.5 text-[14.5px] font-semibold text-white transition hover:border-white hover:bg-white/10">
            Send Another Inquiry
        </button>
    </div>
</div>
