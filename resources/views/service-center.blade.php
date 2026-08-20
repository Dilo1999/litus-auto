@extends('layouts.litus')

@section('title', 'Service Centre - LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/service_center/Image.webp');

    $heroFeatures = [
        ['icon' => 'wrench', 'title' => 'Periodic Maintenance', 'desc' => 'Manufacturer schedules'],
        ['icon' => 'shield', 'title' => 'Accident Repairs', 'desc' => 'Full collision & damage'],
        ['icon' => 'zap', 'title' => 'Engine Overhaul', 'desc' => 'Complete restoration'],
        ['icon' => 'bike', 'title' => 'Pick & Drop', 'desc' => 'We come to you'],
    ];

    $capabilities = [
        [
            'icon' => 'wrench',
            'title' => 'Periodic Maintenance',
            'text' => 'Scheduled servicing at the manufacturer’s intervals - typically 1,000 km, then every 6,000 km. This is what keeps a scooter running properly past year three.',
        ],
        [
            'icon' => 'shield',
            'title' => 'Accident Repairs',
            'text' => 'Collision and road damage repaired to the correct standard. We assess the machine fully and show you what we found before starting work.',
        ],
        [
            'icon' => 'zap',
            'title' => 'Engine Overhaul',
            'text' => 'A full strip, inspection and rebuild, usually needed after six to seven years of riding. Any worn part is replaced with a genuine one.',
        ],
        [
            'icon' => 'clock',
            'title' => 'Irregular Maintenance',
            'text' => 'Catch-up servicing for bikes that have missed scheduled intervals. Common, fixable, and better addressed than ignored.',
        ],
    ];

    $bookingPoints = [
        [
            'title' => 'Trained on your engine',
            'text' => 'Our technicians work on Honda and Yamaha every day - not on whatever comes through the door.',
        ],
        [
            'title' => 'Genuine parts, shown to you',
            'text' => 'We keep the old part and show it to you. If we say something needed replacing, you can see why.',
        ],
        [
            'title' => 'Written findings',
            'text' => 'You get the inspection results in writing, with urgent items separated from things that can wait.',
        ],
    ];

    $programs = [
        [
            'q' => 'Periodic Maintenance',
            'a' => 'Maintenance carried out at the intervals set by the manufacturer. These services keep your motorcycle in good shape and ensure a longer life. Honda recommends the first maintenance after 1,000 km, then every 6,000 km. Yamaha recommends a first service after 1,000 km and regular maintenance every 6,000 km thereafter.',
            'open' => true,
        ],
        [
            'q' => 'Irregular Maintenance',
            'a' => 'Maintenance made outside of the recommended periodic schedule. This addresses issues noticed while riding, and is most commonly required when periodic maintenance has been neglected. It is entirely fixable - the sooner it is looked at, the less it costs.',
        ],
        [
            'q' => 'Accident Repairs',
            'a' => 'Repairs for damage sustained in a collision or other road accident. Repairs are made to the standard set out by the manufacturer after sufficient observation. The owner is required to bring the vehicle to a service centre so the diagnosis can proceed properly.',
        ],
        [
            'q' => 'Engine Overhaul',
            'a' => 'Usually required after six or seven years of riding. During the overhaul the engine is fully disassembled and inspected, and any worn part is replaced. We quote you before proceeding, not after.',
        ],
        [
            'q' => 'Pick & Drop Service',
            'a' => 'A LITUS service centre mechanic goes to the location of the vehicle, brings it to the service centre for inspection and repairs, and returns it - a hassle-free experience from start to finish. Availability varies by island; ask when you book.',
        ],
    ];

    $centres = [
        'Malé',
        'Hithadhoo (Addu)',
        'Fuvahmulah',
    ];

    $serviceTypes = [
        'Periodic maintenance',
        'Irregular maintenance',
        'Accident repair',
        'Engine overhaul',
        'Not sure - please advise',
    ];

    $fieldLabel = 'mb-1.5 block text-[12px] font-semibold text-white/70 sm:text-[12.5px]';
    $fieldControl = 'w-full rounded-[10px] border border-white/22 bg-white/[0.08] px-3 py-2.5 text-[14px] text-white outline-none transition placeholder:text-white/40 focus:border-litus-sky/60 focus:bg-white/[0.12] sm:px-3.5 sm:py-3 sm:text-[14.5px]';
@endphp

<div class="font-sans" data-service-center-page>

    <x-litus-header active="Service" />

    {{-- HERO — desktop --}}
    <section class="relative hidden overflow-hidden bg-litus-ink text-white min-[961px]:block">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.28), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.55) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.28]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(48px,6.5vw,88px)] pb-[clamp(40px,5vw,68px)]">
            <div class="max-w-[820px]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">LITUS Service Centre</span>
                <h1 class="font-display text-[clamp(30px,4.2vw,50px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    Expert care for<br><span class="text-litus-sky">every motorcycle.</span>
                </h1>
                <p class="mt-4 max-w-[520px] text-[clamp(16px,1.4vw,18px)] leading-[1.66] text-white/[0.78]">
                    Scheduled maintenance, inspections, accident repairs and engine work - carried out by technicians trained on the exact engines we sell, using genuine parts.
                </p>
                <div class="litus-cta-row mt-6">
                    <a href="#book"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-[15px] text-[15px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                        Book an Appointment
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-[15px] text-[15px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                        Contact Service Team
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/35 backdrop-blur-sm">
            <div class="litus-container grid grid-cols-2 gap-4 py-[22px] lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroFeatures as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div>
                            <b class="block text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
                            <span class="block text-[12.5px] leading-snug text-white/60">{{ $item['desc'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HERO — mobile --}}
    <section class="relative overflow-hidden bg-litus-ink text-white min-[961px]:hidden">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.18]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px;"></div>

        <div class="relative z-[3] flex flex-col">
            <div class="litus-container pt-12 pb-4">
                <div class="max-w-[36rem]">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">LITUS Service Centre</span>
                    <h1 class="max-w-[16ch] font-display text-[clamp(1.85rem,7.2vw,2.25rem)] font-extrabold leading-[1.1] tracking-[-0.032em]">
                        Expert care for <span class="text-litus-sky">every motorcycle.</span>
                    </h1>
                    <p class="mt-3 line-clamp-4 max-w-[38ch] text-[14px] leading-[1.62] text-white/[0.72]">
                        Maintenance, inspections, accident repairs and engine work by technicians trained on the engines we sell, using genuine parts.
                    </p>
                </div>
            </div>

            <div class="litus-container pb-4">
                <div class="flex flex-row gap-2">
                    <a href="#book"
                       class="inline-flex min-h-11 flex-1 items-center justify-center gap-1.5 rounded-xl bg-litus-primary px-3 text-[13px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:bg-litus-primary-hover">
                        Book Now
                        <x-litus-icon name="arrow-right" class="h-3.5 w-3.5 shrink-0" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border-[1.5px] border-white/32 px-3 text-[13px] font-semibold text-white transition hover:border-white hover:bg-white/10">
                        Contact
                    </a>
                </div>
            </div>

            <x-litus-hero-features :features="$heroFeatures" />
        </div>
    </section>

    {{-- CAPABILITIES --}}
    <section class="litus-sec max-md:!py-12">
        <div class="litus-container">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Our Capabilities</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">What we do at our service centres</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Precision tune-ups, inspections, repairs and diagnostics for optimal performance and safety.
                </p>
            </div>

            <div data-home-card-slider-wrap>
                <div
                    data-home-card-slider
                    data-interval="4500"
                    class="grid grid-cols-1 gap-6 max-md:-mx-4 max-md:flex max-md:gap-4 max-md:snap-x max-md:snap-mandatory max-md:overflow-x-auto max-md:scroll-smooth max-md:px-4 max-md:pb-1 max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden sm:grid-cols-2 xl:grid-cols-4">
                    @foreach ($capabilities as $item)
                        <div data-home-card-slide class="max-md:w-[min(88%,340px)] max-md:shrink-0 max-md:snap-center">
                            <article class="group h-full rounded-2xl border border-litus-line bg-white px-4 py-5 shadow-[0_1px_2px_rgba(9,17,32,0.04)] transition duration-200 sm:rounded-[18px] sm:px-[26px] sm:py-[30px] sm:shadow-[0_1px_2px_rgba(9,17,32,.05)] md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]">
                                <div class="mb-3 grid h-10 w-10 place-items-center rounded-[12px] bg-litus-paper-3 text-litus-primary transition duration-200 group-hover:bg-[rgba(18,87,214,0.12)] sm:mb-[18px] sm:h-[42px] sm:w-[42px]">
                                    <x-litus-icon :name="$item['icon']" class="h-4 w-4 sm:h-5 sm:w-5" />
                                </div>
                                <h4 class="mb-2 text-[16px] font-bold text-litus-text sm:text-lg">{{ $item['title'] }}</h4>
                                <p class="text-[14px] leading-relaxed text-litus-text-2 sm:text-[14.5px]">{{ $item['text'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if (count($capabilities) > 1)
                    <div class="mt-4 hidden items-center justify-center gap-1.5 max-md:flex" data-home-card-dots aria-hidden="true">
                        @foreach ($capabilities as $index => $item)
                            <span @class([
                                'h-1.5 rounded-full transition-all duration-300',
                                'w-5 bg-litus-primary' => $index === 0,
                                'w-1.5 bg-litus-line-2' => $index !== 0,
                            ])
                                  data-home-card-dot></span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- BOOKING --}}
    <section id="book" class="scroll-mt-24 overflow-hidden bg-litus-ink text-white">
        <div class="litus-sec max-md:!py-12">
            <div class="litus-container grid grid-cols-1 items-start gap-8 min-[1000px]:grid-cols-[0.85fr_1.15fr] min-[1000px]:gap-12">
                <div class="max-md:order-2">
                    <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky sm:mb-3.5">Book a Service</span>
                    <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em]">Book an appointment</h2>
                    <p class="mt-3 max-w-[460px] text-[15px] leading-[1.66] text-white/[0.74] sm:mt-3.5 sm:text-[clamp(16.5px,1.5vw,19px)]">
                        We confirm every booking within 24 hours, and tell you what the service will involve before you bring the bike in.
                    </p>

                    <ul class="mt-6 grid list-none gap-4 sm:mt-[30px] sm:gap-[18px]">
                        @foreach ($bookingPoints as $index => $point)
                            <li class="flex gap-3 sm:gap-[15px]">
                                <div class="grid h-8 w-8 shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.16)] text-xs font-bold text-litus-sky sm:h-[34px] sm:w-[34px] sm:text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <b class="mb-1 block text-[14.5px] text-white sm:text-[15.5px]">{{ $point['title'] }}</b>
                                    <span class="text-[13px] leading-relaxed text-white/65 sm:text-sm">{{ $point['text'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="max-md:order-1 rounded-2xl border border-white/15 bg-white/[0.06] p-5 backdrop-blur-[10px] sm:rounded-[26px] sm:p-[clamp(22px,3vw,32px)]">
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
            </div>
        </div>
    </section>

    {{-- SERVICE PROGRAMS --}}
    <section id="service-programs" class="litus-sec scroll-mt-24 bg-litus-paper-2 max-md:!py-12">
        <div class="litus-container max-w-[880px]">
            <div class="mx-auto mb-6 max-w-[660px] text-center max-md:mb-5 sm:mb-[clamp(34px,4vw,54px)]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary sm:mb-3.5">Our Service Programs</span>
                <h2 class="font-display text-[clamp(22px,5.5vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Understanding the right service for your motorcycle</h2>
                <p class="mt-3 text-[15px] leading-[1.66] text-litus-text-2 sm:mt-4 sm:text-[clamp(16.5px,1.5vw,19px)]">
                    Choose the right service at the right time to keep your motorcycle running at its best.
                </p>
            </div>

            <div class="overflow-hidden rounded-2xl border border-litus-line bg-white sm:rounded-[18px]">
                @foreach ($programs as $program)
                    <details class="group border-b border-litus-paper-3 last:border-b-0" @if (! empty($program['open'])) open @endif>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-4 py-4 text-[14.5px] font-semibold text-litus-text marker:content-none sm:gap-[18px] sm:px-6 sm:py-[19px] sm:text-[15.5px] [&::-webkit-details-marker]:hidden group-open:text-litus-primary">
                            <span>{{ $program['q'] }}</span>
                            <x-litus-icon name="chevron-down" class="h-4 w-4 shrink-0 transition group-open:rotate-180" />
                        </summary>
                        <div class="px-4 pb-4 text-[14px] leading-relaxed text-litus-text-2 sm:px-6 sm:pb-5 sm:text-[14.5px] sm:leading-normal">
                            <p>{{ $program['a'] }}</p>
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white max-md:hidden">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Need motorcycle service support?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our team is ready to help you book maintenance, repairs, inspections or service guidance.
                </p>
            </div>
            <div class="litus-cta-row">
                <a href="#book"
                   class="inline-flex items-center justify-center rounded-lg bg-litus-primary px-8 py-[17px] text-[15.5px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                    Book Now
                </a>
                <a href="tel:+9607792278"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />
</div>
@endsection
