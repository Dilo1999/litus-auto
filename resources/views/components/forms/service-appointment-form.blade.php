@props([
    'centres' => [],
    'serviceTypes' => [],
])

@php
    $fieldLabel = 'mb-1.5 block text-[12px] font-semibold text-white/70 sm:text-[12.5px]';
    $fieldControl = 'w-full rounded-[10px] border border-white/22 bg-white/[0.08] px-3 py-2.5 text-[14px] text-white outline-none transition placeholder:text-white/40 focus:border-litus-sky/60 focus:bg-white/[0.12] sm:px-3.5 sm:py-3 sm:text-[14.5px]';
@endphp

<div {{ $attributes->class(['rounded-2xl border border-white/15 bg-white/[0.06] p-5 backdrop-blur-[10px] sm:rounded-[26px] sm:p-[clamp(22px,3vw,32px)]']) }}>
    <form data-service-appointment-form class="grid grid-cols-1 gap-3.5 sm:grid-cols-2 sm:gap-4">
        <div>
            <label class="{{ $fieldLabel }}">Your name</label>
            <input type="text" name="name" placeholder="Full name" required class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Mobile number</label>
            <input type="tel" name="mobile" placeholder="7XXXXXX" required class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Motorcycle model</label>
            <input type="text" name="model" placeholder="e.g. PCX 160" class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Registration number</label>
            <input type="text" name="reg_no" placeholder="Reg. no" class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Service centre</label>
            <div class="litus-select-wrap">
                <select name="centre" class="litus-select litus-select-glass {{ $fieldControl }} pr-10 [color-scheme:dark]">
                    @foreach ($centres as $centre)
                        <option value="{{ $centre }}">{{ $centre }}</option>
                    @endforeach
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-white/60" />
            </div>
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Preferred date</label>
            <input type="date" name="date" class="{{ $fieldControl }} [color-scheme:dark]">
        </div>
        <div class="sm:col-span-2">
            <label class="{{ $fieldLabel }}">Type of service</label>
            <div class="litus-select-wrap">
                <select name="service_type" class="litus-select litus-select-glass {{ $fieldControl }} pr-10 [color-scheme:dark]">
                    @foreach ($serviceTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-white/60" />
            </div>
        </div>
        <div class="sm:col-span-2">
            <label class="{{ $fieldLabel }}">Anything we should know?</label>
            <textarea name="notes" rows="3" placeholder="Noises, warning lights, when it started…" class="{{ $fieldControl }} min-h-[88px] resize-y sm:min-h-[96px]"></textarea>
        </div>
        <div class="sm:col-span-2">
            <button type="submit"
                    class="inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:px-8 sm:py-[17px] sm:text-[15.5px]">
                Submit Appointment
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </button>
            <p class="mt-3 text-center text-xs text-white/50 sm:mt-3.5">
                Our service team will confirm your booking within 24 hours.
            </p>
        </div>
    </form>

    <div data-service-appointment-success class="hidden py-10 text-center">
        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full bg-[rgba(90,184,255,0.16)] text-litus-sky">
            <x-litus-icon name="check-circle" class="h-8 w-8" />
        </div>
        <h3 class="font-display text-2xl font-bold text-white">Appointment submitted</h3>
        <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-white/70">
            Our service team will contact you within 24 hours to confirm your booking.
        </p>
        <button type="button"
                data-service-appointment-reset
                class="mt-7 inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-3.5 text-[14.5px] font-semibold text-white transition hover:border-white hover:bg-white/10">
            Submit Another Request
        </button>
    </div>
</div>
