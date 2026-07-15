@extends('layouts.litus')

@section('title', 'Service Center — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/service_center/' . rawurlencode('ChatGPT Image Jul 10, 2026, 10_31_01 AM.png'));
    $teamImg = 'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?auto=format&fit=crop&w=800&q=80';
    $bookingBg = asset('images/service_center/' . rawurlencode('ChatGPT Image Jul 10, 2026, 10_16_22 AM.png'));

    $bookingFeatures = [
        ['icon' => 'headphones', 'title' => 'Expert Support', 'desc' => 'Our team is ready to assist you with the best service.'],
        ['icon' => 'shield', 'title' => 'Genuine Service', 'desc' => '100% genuine parts and trusted service quality.'],
        ['icon' => 'clock', 'title' => 'Quick & Easy', 'desc' => 'Book your service in just a few simple steps.'],
    ];

    $formInputBox = 'flex h-11 items-center gap-3 rounded-lg border border-[#d7dee8] bg-white px-4 transition-all focus-within:border-[#0065ef] focus-within:shadow-[0_0_0_4px_rgba(0,101,239,0.08)]';
    $formInput = 'h-full w-full border-0 bg-transparent text-sm text-[#07152f] outline-none placeholder-[#747f91]';

    $heroFeatures = [
        ['icon' => 'settings', 'title' => 'Periodic Maintenance', 'desc' => 'Scheduled manufacturer services'],
        ['icon' => 'alert-triangle', 'title' => 'Accident Repairs', 'desc' => 'Full collision & damage repair'],
        ['icon' => 'rotate-ccw', 'title' => 'Engine Overhaul', 'desc' => 'Complete engine restoration'],
        ['icon' => 'truck', 'title' => 'Pick & Drop Service', 'desc' => 'We come to you'],
    ];

    $serviceCards = [
        ['icon' => 'settings', 'title' => 'Periodic Maintenance', 'desc' => 'Scheduled tune-ups to keep your motorcycle running at peak condition.'],
        ['icon' => 'alert-triangle', 'title' => 'Accident Repairs', 'desc' => 'Full diagnosis and restoration after collisions or road damage.'],
        ['icon' => 'rotate-ccw', 'title' => 'Engine Overhaul', 'desc' => 'Complete engine disassembly, inspection, and part replacement.'],
        ['icon' => 'wrench', 'title' => 'Irregular Maintenance', 'desc' => 'Targeted repairs for issues noticed outside of scheduled service.'],
    ];

    $servicePrograms = [
        ['icon' => 'settings', 'title' => 'Periodic Maintenance', 'text' => 'Maintenance that is done after driving a specific number of kilometers set by the manufacturer. These services help keep your automobile in top shape and ensure a longer life for the vehicle. Honda recommends first maintenance after 1000km, then every 6000km. Yamaha recommends a first service after 1000km and regular maintenance every 9000km.'],
        ['icon' => 'wrench', 'title' => 'Irregular Maintenance', 'text' => 'Maintenance made outside of the recommended periodic maintenance schedule. These address issues noticed while driving and are most commonly required if periodic maintenance has been neglected.'],
        ['icon' => 'alert-triangle', 'title' => 'Accident Repairs', 'text' => 'This encompasses any damage received due to collisions or other road accidents. Repairs will be made on the outer and inner workings of the motorcycle after sufficient observations have been made. The owner is required to bring the vehicle to a service center and the diagnosis will proceed from there.'],
        ['icon' => 'rotate-ccw', 'title' => 'Engine Overhaul', 'text' => 'An engine overhaul is usually required after 6 to 7 years of driving. During the overhaul, the engine will be fully disassembled and manually inspected for issues. Any and all parts of the motorcycle can be changed upon request.'],
        ['icon' => 'truck', 'title' => 'Pick & Drop Service', 'text' => 'LITUS Service Center mechanics will go to the location of the vehicle and bring it to the service center for inspection and repairs — a hassle-free experience from start to finish.'],
    ];

    $whyLitus = [
        ['icon' => 'users', 'title' => 'Experienced Mechanics', 'desc' => 'Skilled technicians for reliable motorcycle service.'],
        ['icon' => 'check-circle', 'title' => 'Genuine Parts Support', 'desc' => 'Access to trusted genuine parts and accessories.'],
        ['icon' => 'shield', 'title' => 'Professional Inspection', 'desc' => 'Careful checking for safety, performance, and durability.'],
        ['icon' => 'headphones', 'title' => 'Customer Support', 'desc' => 'Friendly assistance from booking to completion.'],
    ];

@endphp

<div class="font-sans" data-service-center-page>

    <x-litus-header active="Service Center" />

    {{-- HERO --}}
    <section class="relative min-h-[680px] overflow-hidden border border-[rgba(27,74,120,0.45)] bg-[#06101c] pb-[82px] max-md:min-h-0 max-md:pb-0 max-[1100px]:min-h-0 max-[1100px]:pb-8">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right] max-md:object-[center_30%]"
             aria-hidden="true">

        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(3,11,22,0.98)_0%,rgba(3,11,22,0.88)_32%,rgba(3,11,22,0.48)_58%,rgba(3,11,22,0.25)_100%)] max-md:bg-[linear-gradient(180deg,rgba(11,22,40,0.55)_0%,rgba(11,22,40,0.78)_42%,rgba(11,22,40,0.92)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_70%_35%,rgba(255,255,255,0.08),transparent_28%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.1),rgba(2,10,19,0.95))]"></div>

        <div class="relative z-[2] litus-container pb-12 pt-16 max-md:pb-5 max-md:pt-16 sm:pt-20">
            <div class="max-w-[720px] text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] max-md:mb-1.5 max-md:text-[10px] max-md:tracking-[0.18em] sm:text-lg">
                    LITUS Service Center
                </p>

                <h1 class="mb-4 font-montserrat text-[clamp(2.25rem,4.2vw,4.25rem)] font-bold leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:mb-2 max-md:text-[1.7rem] max-md:leading-[1.12]">
                    Expert Care for<br>
                    <span class="text-litus-red">Every Motorcycle</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] max-md:mb-3.5 max-md:max-w-[34ch] max-md:text-[13px] max-md:leading-snug sm:text-lg sm:leading-[1.55]">
                    Book professional motorcycle maintenance, inspections, repairs, and service support from the trusted LITUS Automobiles service team.
                </p>

                <div class="flex flex-col items-stretch justify-start gap-2.5 max-md:w-full max-md:flex-row max-md:gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-7">
                    <a href="#appointment"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Book Appointment
                        <x-litus-icon name="calendar" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                    <a href="tel:+9607797442"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-2 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] max-md:h-11 max-md:min-h-11 max-md:min-w-0 max-md:flex-1 max-md:rounded-xl max-md:border-white/35 max-md:bg-white/[0.06] max-md:px-3 max-md:text-[13px] sm:h-[60px] sm:min-w-[220px] sm:text-lg">
                        Contact Service Team
                        <x-litus-icon name="arrow-right" class="h-4 w-4 max-md:h-3.5 max-md:w-3.5 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <x-litus-hero-features :features="$heroFeatures" />
    </section>

    {{-- WHAT WE OFFER + APPOINTMENT --}}
    <section class="border border-[#dfe3ea] bg-white px-5 py-9 pb-16 max-sm:px-3.5 max-sm:py-8 max-sm:pb-12 min-[651px]:pb-20">
        <div class="litus-container">

            <div class="relative mb-8 text-center">
                <span class="mb-1.5 block text-xs font-black uppercase tracking-wide text-[#0065ef]">Our Capabilities</span>
                <h2 class="font-montserrat mb-2.5 text-[27px] font-bold leading-tight text-[#07152f] min-[651px]:text-[34px]">
                    What We Offer at Our Service Centers
                </h2>
                <p class="text-sm font-semibold text-[#556071] min-[651px]:text-[15px]">
                    Precision tune-ups, inspections, repairs, and diagnostics for optimal performance and safety.
                </p>
                <a href="{{ route('contact') }}"
                   class="mt-0 inline-flex items-center rounded-md bg-[#061a45] px-[22px] py-3 text-[13px] font-black text-white transition-colors duration-300 hover:bg-[#0065ef] max-[1050px]:mt-[18px] min-[1051px]:absolute min-[1051px]:right-0 min-[1051px]:top-5">
                    Contact Now
                </a>
            </div>

            <div class="mb-9 grid grid-cols-1 gap-[22px] pb-8 min-[651px]:grid-cols-2 min-[651px]:pb-10 min-[1051px]:mb-9 min-[1051px]:grid-cols-4">
                @foreach ($serviceCards as $card)
                    <div class="min-h-[260px] rounded-[10px] border border-[#e1e5eb] bg-white px-[22px] py-7 text-center shadow-none transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_38px_rgba(0,0,0,0.1)]">
                        <div class="mx-auto mb-[22px] flex h-[92px] w-[92px] items-center justify-center rounded-full bg-[#f1f1f1] text-[#07152f]">
                            <x-litus-icon :name="$card['icon']" class="h-10 w-10" />
                        </div>
                        <h3 class="mb-3.5 text-[21px] font-bold leading-tight text-[#111b46]">{{ $card['title'] }}</h3>
                        <p class="mb-[22px] text-[13px] font-semibold leading-snug text-[#5a6575]">{{ $card['desc'] }}</p>
                        <a href="#service-programs"
                           class="group/learn inline-flex items-center gap-1.5 text-[13px] font-black text-[#0065ef] transition-all duration-300 hover:gap-3">
                            Learn More
                            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                @endforeach
            </div>

            <div id="appointment"
                 class="mx-auto grid max-w-[1450px] grid-cols-1 overflow-hidden rounded-[20px] border border-[#07152f]/[0.06] bg-white shadow-[0_24px_70px_rgba(7,21,47,0.12)] min-[1101px]:grid-cols-[0.58fr_1fr] min-[1101px]:rounded-[28px]">

                {{-- Booking info --}}
                <div class="relative overflow-hidden px-6 py-8 text-white min-[651px]:px-8 min-[651px]:py-9 min-[1101px]:px-10 min-[1101px]:py-10">
                    <img src="{{ $bookingBg }}"
                         alt=""
                         aria-hidden="true"
                         class="pointer-events-none absolute inset-0 h-full w-full object-cover object-[center_65%]">
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[#030e1f]/50 via-[#05152d]/40 to-[#030e1f]/55"></div>
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#020b19]/60 via-[#020b19]/15 to-transparent"></div>
                    <div class="pointer-events-none absolute right-8 top-6 h-[120px] w-[120px] opacity-20 max-[700px]:hidden"
                         style="background-image: radial-gradient(rgba(255,255,255,0.18) 1.5px, transparent 1.5px); background-size: 16px 16px;"></div>

                    <div class="relative z-[2]">
                        <div class="mb-4 flex items-center gap-2.5 text-xs font-extrabold uppercase tracking-wide min-[651px]:text-sm">
                            <x-litus-icon name="award" class="h-5 w-5 text-[#0065ef]" />
                            Book a Service
                        </div>

                        <h2 class="font-montserrat mb-4 text-[clamp(1.875rem,4vw,2.75rem)] font-bold leading-[1.12] tracking-[-0.5px]">
                            Book an<br>
                            Appointment
                            <span class="mt-0.5 block text-[#0065ef]">Now</span>
                        </h2>

                        <div class="mb-4 h-[3px] w-14 rounded-[10px] bg-[#0065ef]"></div>

                        <p class="mb-6 max-w-[390px] text-sm font-medium leading-snug text-[#dbe2ec] min-[651px]:mb-7 min-[651px]:text-[15px]">
                            We will contact you right away to confirm your booking.
                        </p>

                        @foreach ($bookingFeatures as $feature)
                            <div @class([
                                'grid max-w-[390px] gap-3 border-b border-white/15 py-3.5 min-[651px]:grid-cols-[52px_1fr] min-[651px]:items-center min-[651px]:gap-4 min-[651px]:py-4',
                                'border-b-0' => $loop->last,
                                'text-center min-[651px]:text-left' => true,
                            ])>
                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full border-2 border-[#0065ef] text-[#0065ef] min-[651px]:mx-0">
                                    <x-litus-icon :name="$feature['icon']" class="h-5 w-5" />
                                </div>
                                <div>
                                    <h3 class="mb-1 text-sm font-bold min-[651px]:text-base">{{ $feature['title'] }}</h3>
                                    <p class="text-xs leading-snug text-[#dbe2ec] min-[651px]:text-sm">{{ $feature['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Booking form --}}
                <div class="bg-white px-6 py-8 min-[651px]:px-8 min-[651px]:py-9 min-[1101px]:px-10 min-[1101px]:py-10">
                    <form data-service-appointment-form class="grid grid-cols-1 gap-4 min-[651px]:grid-cols-2 min-[651px]:gap-x-6 min-[651px]:gap-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-black text-[#101827]">Your Name</label>
                            <div class="{{ $formInputBox }}">
                                <x-litus-icon name="users" class="h-5 w-5 shrink-0 text-[#68758a]" />
                                <input type="text" name="name" placeholder="Enter your name" required class="{{ $formInput }}">
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-black text-[#101827]">Your Mobile No</label>
                            <div class="{{ $formInputBox }}">
                                <x-litus-icon name="phone" class="h-5 w-5 shrink-0 text-[#68758a]" />
                                <input type="tel" name="mobile" placeholder="Enter mobile number" required class="{{ $formInput }}">
                            </div>
                        </div>

                        <div class="min-[651px]:col-span-2">
                            <label class="mb-2 block text-sm font-black text-[#101827]">Your ID No</label>
                            <div class="{{ $formInputBox }}">
                                <x-litus-icon name="credit-card" class="h-5 w-5 shrink-0 text-[#68758a]" />
                                <input type="text" name="id_no" placeholder="Enter ID number" class="{{ $formInput }}">
                            </div>
                        </div>

                        <div class="min-[651px]:col-span-2">
                            <label class="mb-2 block text-sm font-black text-[#101827]">Motorcycle Reg No</label>
                            <div class="{{ $formInputBox }}">
                                <x-litus-icon name="bike" class="h-5 w-5 shrink-0 text-[#68758a]" />
                                <input type="text" name="reg_no" placeholder="Enter registration number" class="{{ $formInput }}">
                            </div>
                        </div>

                        <div class="min-[651px]:col-span-2">
                            <label class="mb-2 block text-sm font-black text-[#101827]">Motorcycle Model</label>
                            <div class="{{ $formInputBox }}">
                                <x-litus-icon name="bike" class="h-5 w-5 shrink-0 text-[#68758a]" />
                                <input type="text" name="model" placeholder="Enter motorcycle model" class="{{ $formInput }}">
                            </div>
                        </div>

                        <div class="min-[651px]:col-span-2">
                            <label class="mb-2 block text-sm font-black text-[#101827]">Booking Date</label>
                            <div class="{{ $formInputBox }}">
                                <x-litus-icon name="calendar" class="h-5 w-5 shrink-0 text-[#68758a]" />
                                <input type="date" name="date" class="{{ $formInput }} cursor-pointer">
                                <x-litus-icon name="calendar" class="h-5 w-5 shrink-0 text-[#68758a]" />
                            </div>
                        </div>

                        <button type="submit"
                                class="flex h-12 min-[651px]:col-span-2 items-center justify-center gap-3 rounded-lg bg-[#0065ef] text-sm font-black text-white shadow-[0_10px_24px_rgba(0,101,239,0.22)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc]">
                            Submit Appointment
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>

                        <p class="flex items-center justify-center gap-2 text-center text-xs font-medium text-[#5f6b7d] min-[651px]:col-span-2 min-[651px]:text-sm">
                            <x-litus-icon name="shield" class="h-4 w-4 shrink-0 text-[#0065ef]" />
                            Our service team will confirm your booking within 24 hours.
                        </p>
                    </form>

                    <div data-service-appointment-success class="hidden py-8 text-center min-[651px]:py-10">
                        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-[#0065ef]/10">
                            <x-litus-icon name="check-circle" class="h-8 w-8 text-[#0065ef]" />
                        </div>
                        <h3 class="mb-3 text-2xl font-bold text-[#07152f]">Appointment Submitted!</h3>
                        <p class="mx-auto mb-8 max-w-md text-base text-[#5f6b7d]">Our service team will contact you within 24 hours to confirm your booking.</p>
                        <button type="button" data-service-appointment-reset
                                class="inline-flex h-12 items-center justify-center rounded-lg border-2 border-[#0065ef] px-8 text-sm font-black text-[#0065ef] transition-all hover:bg-[#0065ef] hover:text-white">
                            Submit Another Request
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- SERVICE PROGRAMS --}}
    <section id="service-programs"
             class="relative overflow-hidden border border-[#dfe3ea] bg-[radial-gradient(circle_at_left_42%,rgba(0,102,255,0.08),transparent_18%),radial-gradient(circle_at_right_78%,rgba(0,102,255,0.06),transparent_18%),#f8fafc] px-5 py-8 pb-10 max-sm:px-3.5 max-sm:py-7 max-sm:pb-9">
        <div class="pointer-events-none absolute left-0 top-[200px] h-[200px] w-[150px] opacity-40 max-sm:hidden"
             style="background-image: radial-gradient(rgba(0,102,255,0.22) 2px, transparent 2px); background-size: 18px 18px;"></div>
        <div class="pointer-events-none absolute bottom-16 right-0 h-[180px] w-[170px] opacity-40 max-sm:hidden"
             style="background-image: radial-gradient(rgba(0,102,255,0.18) 2px, transparent 2px); background-size: 18px 18px;"></div>

        <div class="litus-container relative z-[2] max-w-[1420px]">
            <div class="mb-7 text-center">
                <span class="mb-3 inline-flex items-center gap-3 text-[11px] font-black uppercase tracking-[3px] text-[#0065ef] min-[651px]:gap-5 min-[651px]:text-xs min-[651px]:tracking-[5px]">
                    <span class="h-0.5 w-6 bg-[#0065ef]"></span>
                    Our Service Programs
                    <span class="h-0.5 w-6 bg-[#0065ef]"></span>
                </span>
                <h2 class="font-montserrat mb-3 text-[clamp(1.75rem,3.5vw,2.75rem)] font-bold leading-[1.12] tracking-[-0.8px] text-[#07152f]">
                    Understand the Right Service for Your Motorcycle
                </h2>
                <p class="mx-auto max-w-2xl text-sm font-medium leading-relaxed text-[#667085] min-[651px]:text-base">
                    Choose the right service at the right time to keep your motorcycle running at its best.
                </p>
            </div>

            <div class="flex flex-col gap-2">
                @foreach ($servicePrograms as $program)
                    <div class="group relative grid min-h-[100px] grid-cols-1 items-center gap-3 overflow-hidden rounded-xl border border-[#e3e8f0] bg-white px-4 py-5 text-center shadow-none transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_14px_32px_rgba(7,21,47,0.08)] min-[651px]:grid-cols-[96px_1fr] min-[651px]:gap-4 min-[651px]:px-4 min-[651px]:py-4 min-[651px]:text-left min-[901px]:grid-cols-[120px_1fr] min-[901px]:gap-4 min-[901px]:px-6 min-[901px]:py-4">
                        <div class="absolute left-0 top-0 h-full w-1 rounded-l-xl bg-[#0065ef]"></div>

                        <div class="mx-auto flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-2xl bg-[#f2f6fb] min-[651px]:ml-2 min-[901px]:h-[84px] min-[901px]:w-[84px]">
                            <div class="relative flex h-11 w-11 items-center justify-center rounded-full border border-dashed border-[#0065ef]/65 text-[#0065ef] min-[901px]:h-[58px] min-[901px]:w-[58px]">
                                <span class="absolute right-2.5 top-0 h-1 w-1 rounded-full bg-[#0065ef]"></span>
                                <span class="absolute bottom-0 left-3.5 h-1 w-1 rounded-full bg-[#0065ef]"></span>
                                <x-litus-icon :name="$program['icon']" class="h-5 w-5 min-[901px]:h-6 min-[901px]:w-6" />
                            </div>
                        </div>

                        <div class="min-w-0">
                            <h3 class="mb-1.5 text-lg font-bold text-[#07152f] min-[901px]:text-xl">{{ $program['title'] }}</h3>
                            <p class="mx-auto max-w-[1040px] text-[13px] font-medium leading-snug text-[#344054] min-[651px]:mx-0 min-[901px]:text-sm min-[901px]:leading-relaxed">{{ $program['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY LITUS --}}
    <section class="bg-white py-14 max-md:py-10">
        <div class="litus-container">
            <div class="mb-10 text-center max-md:mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red max-md:text-[11px] max-md:tracking-[0.14em]">Our Promise</span>
                <h2 class="mt-2 font-montserrat text-2xl font-bold text-gray-900 max-md:text-[24px] lg:text-3xl">Why Service Your Motorcycle at LITUS?</h2>
            </div>
            <div class="grid grid-cols-2 gap-3 max-md:gap-2.5 sm:gap-5 lg:grid-cols-4">
                @foreach ($whyLitus as $item)
                    <div class="group rounded-xl border border-gray-100 p-3 text-center transition-all hover:border-blue-100 hover:shadow-md sm:rounded-2xl sm:p-6">
                        <div class="mx-auto mb-2.5 flex h-10 w-10 items-center justify-center rounded-full bg-litus-red/8 sm:mb-4 sm:h-12 sm:w-12">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4 text-litus-red sm:h-5 sm:w-5" />
                        </div>
                        <h3 class="mb-1 line-clamp-2 text-[13px] font-bold leading-snug text-gray-900 sm:mb-2 sm:text-base">{{ $item['title'] }}</h3>
                        <p class="line-clamp-3 text-[11px] leading-snug text-gray-500 sm:line-clamp-none sm:text-sm sm:leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="bg-litus-navy py-14">
        <div class="litus-container flex flex-col items-center justify-between gap-8 lg:flex-row lg:items-center lg:gap-12">
            <div class="min-w-0 flex-1 text-center lg:text-left">
                <h2 class="mb-3 font-montserrat text-3xl font-bold text-white lg:text-4xl">
                    Need Motorcycle<br>
                    <span class="text-litus-red">Service Support?</span>
                </h2>
                <p class="max-w-xl leading-relaxed text-gray-400 lg:max-w-2xl">Our team is ready to help you book maintenance, repairs, inspections, or service guidance.</p>
            </div>
            <div class="flex w-full shrink-0 flex-col gap-3 sm:w-auto sm:flex-row lg:justify-end">
                <a href="#appointment"
                   class="rounded-full bg-litus-red px-8 py-3.5 text-sm font-bold text-white transition-opacity hover:opacity-90">
                    Book Now
                </a>
                <a href="{{ route('contact') }}"
                   class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />

</div>
@endsection
