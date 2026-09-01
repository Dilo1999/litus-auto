@props([
    'model',
    'showrooms' => [],
    'whatsappNumber' => '9607797442',
])

@php
    $fieldLabel = 'mb-1.5 block text-[12.5px] font-semibold tracking-[0.02em] text-litus-text-2';
    $fieldControl = 'w-full rounded-[9px] border-[1.5px] border-litus-line-2 bg-white px-3.5 py-3 text-sm outline-none transition focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(46,116,238,0.14)]';
    $whatsappText = urlencode('Hi LITUS, I am interested in the '.$model.'.');
@endphp

<div {{ $attributes->class(['rounded-[20px] border border-litus-line bg-white p-5 shadow-[0_2px_8px_rgba(9,17,32,0.06)] sm:rounded-[26px] sm:p-[clamp(26px,3vw,38px)] sm:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]']) }}>
    <h4 class="mb-4 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Enquire about this model</h4>

    <form data-motorcycle-enquiry-form
          action="{{ route('forms.motorcycle-enquiry') }}"
          method="post"
          class="space-y-4">
        @csrf
        <input type="hidden" name="model" value="{{ $model }}">

        <div>
            <label for="enquiry-name" class="{{ $fieldLabel }}">Your name</label>
            <input id="enquiry-name"
                   type="text"
                   name="name"
                   placeholder="Full name"
                   required
                   class="{{ $fieldControl }}">
        </div>

        <div>
            <label for="enquiry-phone" class="{{ $fieldLabel }}">Mobile number</label>
            <input id="enquiry-phone"
                   type="tel"
                   name="mobile"
                   placeholder="7XXXXXX"
                   required
                   class="{{ $fieldControl }}">
        </div>

        <div>
            <label for="enquiry-showroom" class="{{ $fieldLabel }}">Nearest showroom</label>
            <div class="litus-select-wrap">
                <select id="enquiry-showroom"
                        name="showroom"
                        class="litus-select {{ $fieldControl }} cursor-pointer pr-10">
                    @foreach ($showrooms as $showroom)
                        <option value="{{ $showroom }}">{{ $showroom }}</option>
                    @endforeach
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
            </div>
        </div>

        <div>
            <label for="enquiry-pay" class="{{ $fieldLabel }}">How you want to pay</label>
            <div class="litus-select-wrap">
                <select id="enquiry-pay"
                        name="payment"
                        class="litus-select {{ $fieldControl }} cursor-pointer pr-10">
                    <option>Ijara monthly plan</option>
                    <option>Full payment</option>
                    <option>Not decided yet</option>
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
            </div>
        </div>

        <button type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3.5 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
            Send Enquiry
            <x-litus-icon name="arrow-right" class="h-4 w-4" />
        </button>
    </form>

    <div data-motorcycle-enquiry-success class="hidden py-8 text-center">
        <div class="mx-auto mb-4 grid h-14 w-14 place-items-center rounded-full bg-[rgba(18,87,214,0.1)] text-litus-primary">
            <x-litus-icon name="check-circle" class="h-7 w-7" />
        </div>
        <h5 class="font-display text-xl font-bold text-litus-text">Enquiry sent</h5>
        <p class="mx-auto mt-2 max-w-[280px] text-sm leading-relaxed text-litus-text-2">
            Our sales team will contact you within one working day.
        </p>
        <button type="button"
                data-motorcycle-enquiry-reset
                class="mt-5 inline-flex items-center justify-center rounded-lg border-[1.5px] border-litus-line-2 px-5 py-2.5 text-sm font-semibold text-litus-text transition hover:border-litus-primary-light hover:text-litus-primary">
            Send Another Enquiry
        </button>
    </div>

    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappText }}"
       target="_blank"
       rel="noopener noreferrer"
       class="mt-2.5 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#1FA855] px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443]">
        <x-litus-icon name="message-circle" class="h-4 w-4" />
        WhatsApp Instead
    </a>
    <p class="mt-3.5 text-center text-xs text-litus-text-2">We reply within one working day.</p>
</div>
