@props([
    'inquiryTypes' => [],
    'showrooms' => [],
])

@php
    $fieldLabel = 'mb-1.5 block text-[12px] font-semibold text-litus-text-2 sm:text-[12.5px]';
    $fieldControl = 'w-full rounded-[10px] border border-litus-line-2 bg-white px-3 py-2.5 text-[14px] text-litus-text outline-none transition placeholder:text-litus-text-3 focus:border-litus-primary-light focus:shadow-[0_0_0_3px_rgba(18,87,214,0.12)] sm:px-3.5 sm:py-3 sm:text-[14.5px]';
@endphp

<div {{ $attributes->class(['flex min-h-full flex-col rounded-2xl border border-litus-line bg-white p-5 shadow-[0_2px_8px_rgba(9,17,32,0.06)] sm:rounded-[26px] sm:p-[clamp(20px,3.2vw,40px)] sm:shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]']) }}>
    <div class="hidden flex-1 py-10 text-center" data-contact-success>
        <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full bg-[rgba(18,87,214,0.1)] text-litus-primary">
            <x-litus-icon name="check-circle" class="h-8 w-8" />
        </div>
        <h3 class="font-display text-2xl font-bold text-litus-text">Message sent</h3>
        <p class="mx-auto mt-3 max-w-sm text-[15px] leading-relaxed text-litus-text-2">
            Our team will get back to you within one working day.
        </p>
        <button type="button"
                data-contact-reset
                class="mt-6 text-[14.5px] font-semibold text-litus-primary underline">
            Send another message
        </button>
    </div>

    <form data-contact-form
          action="{{ route('forms.contact') }}"
          method="post"
          class="grid flex-1 grid-cols-1 content-start gap-4 sm:grid-cols-2 sm:gap-5">
        @csrf
        <div class="sm:col-span-2">
            <h3 class="font-display text-[clamp(18px,4vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">Send us a message</h3>
            <p class="mt-1.5 text-[13px] text-litus-text-2 sm:text-sm">Fill in the form and our team will contact you shortly.</p>
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Full name</label>
            <input type="text" name="name" placeholder="Enter your name" required class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Mobile number</label>
            <input type="tel" name="mobile" placeholder="7XXXXXX" required class="{{ $fieldControl }}">
        </div>
        <div class="sm:col-span-2">
            <label class="{{ $fieldLabel }}">Email address</label>
            <input type="email" name="email" placeholder="Enter your email" required class="{{ $fieldControl }}">
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Inquiry type</label>
            <div class="litus-select-wrap">
                <select name="inquiry_type" required class="litus-select {{ $fieldControl }} pr-10">
                    @foreach ($inquiryTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
            </div>
        </div>
        <div>
            <label class="{{ $fieldLabel }}">Nearest showroom</label>
            <div class="litus-select-wrap">
                <select name="showroom" class="litus-select {{ $fieldControl }} pr-10">
                    @foreach ($showrooms as $showroom)
                        <option value="{{ $showroom['name'] }}">{{ $showroom['label'] }}</option>
                    @endforeach
                </select>
                <x-litus-icon name="chevron-down" class="litus-select-chevron h-4 w-4 text-litus-text-3" />
            </div>
        </div>
        <div class="flex min-h-0 flex-col sm:col-span-2">
            <label class="{{ $fieldLabel }}">Message</label>
            <textarea name="message" rows="5" placeholder="How can we help you?" required class="{{ $fieldControl }} min-h-[140px] flex-1 resize-y sm:min-h-[180px]"></textarea>
        </div>
        <div class="mt-auto sm:col-span-2">
            <button type="submit"
                    class="inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-lg bg-litus-primary px-6 py-3 text-[14.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover sm:px-8 sm:py-[17px] sm:text-[15.5px]">
                Send Message
                <x-litus-icon name="arrow-right" class="h-4 w-4" />
            </button>
        </div>
    </form>
</div>
