@extends('layouts.litus')

@section('title', 'Service Center — LITUS Automobiles')

@section('content')
@php
    $heroBg = 'https://images.unsplash.com/photo-1558979159-2b18a4070a87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1600&q=80';
    $teamImg = 'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?auto=format&fit=crop&w=800&q=80';

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
    <section class="relative min-h-[680px] overflow-hidden border border-[rgba(27,74,120,0.45)] bg-[#06101c] pb-[82px] max-[1100px]:min-h-0 max-[1100px]:pb-8">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right]"
             aria-hidden="true">

        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(3,11,22,0.98)_0%,rgba(3,11,22,0.88)_32%,rgba(3,11,22,0.48)_58%,rgba(3,11,22,0.25)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_70%_35%,rgba(255,255,255,0.08),transparent_28%)]"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.1),rgba(2,10,19,0.95))]"></div>

        <div class="relative z-[2] litus-container pt-16 pb-12 sm:pt-20">
            <div class="max-w-[720px] text-left">
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#0065ef] sm:text-lg max-md:text-[15px]">
                    LITUS Service Center
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:text-[2.25rem]">
                    Expert Care for<br>
                    <span class="text-litus-red">Every Motorcycle</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55] max-md:text-[17px]">
                    Book professional motorcycle maintenance, inspections, repairs, and service support from the trusted LITUS Automobiles service team.
                </p>

                <div class="flex flex-row flex-wrap items-center justify-start gap-5 sm:gap-7">
                    <a href="#appointment"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] bg-[#0065ef] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(0,101,239,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Book Appointment
                        <x-litus-icon name="calendar" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                    <a href="tel:+9607797442"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#0065ef] hover:bg-[rgba(0,101,239,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Contact Service Team
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-[3] border-t border-white/12 bg-[rgba(3,13,25,0.78)] backdrop-blur-sm max-[1100px]:relative max-[1100px]:mt-5">
            <div class="litus-container">
                <div class="grid min-h-[76px] grid-cols-1 min-[1100px]:grid-cols-4 max-[1100px]:min-[701px]:grid-cols-2">
                    @foreach ($heroFeatures as $index => $feature)
                        <div @class([
                            'relative flex items-center gap-3 py-3 sm:gap-3.5 min-[1100px]:py-3.5',
                            'border-b border-white/12 max-md:border-b' => $index < count($heroFeatures) - 1,
                            'max-md:last:border-b-0',
                            'min-[1100px]:border-r min-[1100px]:border-white/16 min-[1100px]:pr-4' => $index < count($heroFeatures) - 1,
                            'min-[1100px]:pl-0' => $index === 0,
                            'min-[1100px]:pl-4' => $index > 0,
                            'max-[1100px]:min-[701px]:border-r max-[1100px]:min-[701px]:border-white/16' => in_array($index, [0, 2]),
                            'max-[1100px]:min-[701px]:border-b max-[1100px]:min-[701px]:border-white/12' => in_array($index, [0, 1]),
                            'max-[1100px]:min-[701px]:border-r-0' => $index === 1,
                        ])>
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-white/35 text-white shadow-[0_0_16px_rgba(255,255,255,0.06)] sm:h-10 sm:w-10">
                                <x-litus-icon :name="$feature['icon']" class="h-4 w-4 sm:h-[18px] sm:w-[18px]" />
                            </div>
                            <div class="min-w-0 text-left">
                                <h3 class="mb-0.5 text-sm font-extrabold leading-tight text-white sm:text-[15px]">{{ $feature['title'] }}</h3>
                                <p class="text-xs font-medium leading-snug text-[#c9d4df] sm:text-[13px]">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- WHAT WE OFFER + APPOINTMENT --}}
    <section class="border border-[#dfe3ea] bg-white px-5 py-9 pb-12 max-sm:px-3.5 max-sm:py-8 max-sm:pb-10">
        <div class="litus-container">

            <div class="relative mb-8 text-center">
                <span class="mb-1.5 block text-xs font-black uppercase tracking-wide text-[#0065ef]">Our Capabilities</span>
                <h2 class="mb-2.5 text-[27px] font-black leading-tight text-[#07152f] min-[651px]:text-[34px]">
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

            <div class="mb-9 grid grid-cols-1 gap-[22px] min-[651px]:grid-cols-2 min-[1051px]:mb-9 min-[1051px]:grid-cols-4">
                @foreach ($serviceCards as $card)
                    <div class="min-h-[260px] rounded-[10px] border border-[#e1e5eb] bg-white px-[22px] py-7 text-center shadow-[0_10px_26px_rgba(0,0,0,0.06)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_38px_rgba(0,0,0,0.1)]">
                        <div class="mx-auto mb-[22px] flex h-[92px] w-[92px] items-center justify-center rounded-full bg-[#f1f1f1] text-[#07152f]">
                            <x-litus-icon :name="$card['icon']" class="h-10 w-10" />
                        </div>
                        <h3 class="mb-3.5 text-[21px] font-black leading-tight text-[#111b46]">{{ $card['title'] }}</h3>
                        <p class="mb-[22px] text-[13px] font-semibold leading-snug text-[#5a6575]">{{ $card['desc'] }}</p>
                        <a href="#service-programs"
                           class="group/learn inline-flex items-center gap-1.5 text-[13px] font-black text-[#0065ef] transition-all duration-300 hover:gap-3">
                            Learn More
                            <x-litus-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                @endforeach
            </div>

            <div id="appointment" class="mx-auto grid max-w-[1080px] grid-cols-1 min-[1051px]:grid-cols-[1fr_1.12fr]">
                {{-- Support image --}}
                <div class="relative min-h-[340px] overflow-visible min-[1051px]:min-h-[470px]">
                    <div class="absolute inset-0 overflow-hidden rounded-[10px] shadow-[0_12px_30px_rgba(0,0,0,0.12)] min-[1051px]:rounded-l-[10px] min-[1051px]:rounded-r-none max-[1050px]:rounded-b-none">
                        <img src="{{ $teamImg }}"
                             alt="Service support team"
                             class="absolute inset-0 h-full w-full object-cover object-center">
                        <div class="absolute inset-0 bg-gradient-to-t from-[rgba(3,13,31,0.2)] to-transparent"></div>
                    </div>
                    <div class="absolute z-[5] flex h-[74px] w-[74px] items-center justify-center rounded-full border-[5px] border-white bg-[#061a45] text-white shadow-[0_10px_25px_rgba(0,0,0,0.25)] max-[1050px]:bottom-[-38px] max-[1050px]:left-1/2 max-[1050px]:top-auto max-[1050px]:-translate-x-1/2 min-[1051px]:right-[-36px] min-[1051px]:top-[43%] min-[1051px]:-translate-y-1/2">
                        <x-litus-icon name="headphones" class="h-8 w-8" />
                    </div>
                </div>

                {{-- Booking form --}}
                <div class="rounded-[10px] bg-gradient-to-br from-[#061a45] to-[#020b1d] px-[22px] py-[30px] text-white shadow-[0_12px_30px_rgba(0,0,0,0.15)] min-[651px]:px-11 min-[1051px]:rounded-l-none min-[1051px]:rounded-r-[10px] min-[1051px]:py-[35px] max-[1050px]:rounded-t-none">
                    <span class="mb-2 block text-xs font-black uppercase text-[#0065ef]">Book a Service</span>
                    <h2 class="mb-2.5 text-2xl font-black leading-tight min-[651px]:text-[28px]">Book an Appointment Now</h2>
                    <p class="mb-[26px] text-sm font-semibold text-[#c5cedd]">We will contact you right away.</p>

                    <form data-service-appointment-form>
                        <div class="grid grid-cols-1 gap-0 min-[651px]:grid-cols-2 min-[651px]:gap-[18px]">
                            <div class="mb-[18px]">
                                <label class="mb-2 block text-[13px] font-extrabold text-white">Your Name</label>
                                <input type="text" name="name" placeholder="Enter your name" required
                                       class="h-[45px] w-full rounded-lg border border-white/30 bg-[rgba(4,17,42,0.7)] px-[15px] text-[13px] text-white placeholder-[#9faabd] outline-none transition-all focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)]">
                            </div>
                            <div class="mb-[18px]">
                                <label class="mb-2 block text-[13px] font-extrabold text-white">Your Mobile No</label>
                                <input type="tel" name="mobile" placeholder="Enter mobile number" required
                                       class="h-[45px] w-full rounded-lg border border-white/30 bg-[rgba(4,17,42,0.7)] px-[15px] text-[13px] text-white placeholder-[#9faabd] outline-none transition-all focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)]">
                            </div>
                        </div>

                        <div class="mb-[18px]">
                            <label class="mb-2 block text-[13px] font-extrabold text-white">Your ID No</label>
                            <input type="text" name="id_no" placeholder="Enter ID number"
                                   class="h-[45px] w-full rounded-lg border border-white/30 bg-[rgba(4,17,42,0.7)] px-[15px] text-[13px] text-white placeholder-[#9faabd] outline-none transition-all focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)]">
                        </div>
                        <div class="mb-[18px]">
                            <label class="mb-2 block text-[13px] font-extrabold text-white">Motorcycle Reg No</label>
                            <input type="text" name="reg_no" placeholder="Enter registration number"
                                   class="h-[45px] w-full rounded-lg border border-white/30 bg-[rgba(4,17,42,0.7)] px-[15px] text-[13px] text-white placeholder-[#9faabd] outline-none transition-all focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)]">
                        </div>
                        <div class="mb-[18px]">
                            <label class="mb-2 block text-[13px] font-extrabold text-white">Motorcycle Model</label>
                            <input type="text" name="model" placeholder="Enter motorcycle model"
                                   class="h-[45px] w-full rounded-lg border border-white/30 bg-[rgba(4,17,42,0.7)] px-[15px] text-[13px] text-white placeholder-[#9faabd] outline-none transition-all focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)]">
                        </div>
                        <div class="mb-[18px]">
                            <label class="mb-2 block text-[13px] font-extrabold text-white">Booking Date</label>
                            <input type="date" name="date"
                                   class="h-[45px] w-full cursor-pointer rounded-lg border border-white/30 bg-[rgba(4,17,42,0.7)] px-[15px] text-[13px] text-white outline-none transition-all focus:border-[#0065ef] focus:shadow-[0_0_0_3px_rgba(0,101,239,0.15)] [color-scheme:dark]">
                        </div>

                        <button type="submit"
                                class="mt-2.5 flex h-[55px] w-full items-center justify-center gap-2 rounded-md bg-[#0065ef] text-[15px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0052cc]">
                            Submit Appointment
                            <x-litus-icon name="arrow-right" class="h-4 w-4" />
                        </button>
                        <p class="mt-3 text-center text-xs text-[#9faabd]">Our service team will confirm your booking within 24 hours.</p>
                    </form>

                    <div data-service-appointment-success class="hidden py-8 text-center">
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-[#0065ef]/15">
                            <x-litus-icon name="check-circle" class="h-7 w-7 text-[#0065ef]" />
                        </div>
                        <h3 class="mb-2 text-xl font-black text-white">Appointment Submitted!</h3>
                        <p class="mb-6 text-sm text-[#c5cedd]">Our service team will contact you within 24 hours to confirm your booking.</p>
                        <button type="button" data-service-appointment-reset
                                class="rounded-md border border-white/30 px-6 py-2.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                            Submit Another Request
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- SERVICE PROGRAMS --}}
    <section id="service-programs" class="border border-[#dfe3ea] bg-white px-5 py-6 pb-10 max-sm:px-3.5 max-sm:py-7 max-sm:pb-9">
        <div class="litus-container">

            <div class="mb-7 text-center">
                <span class="mb-2 block text-sm font-black uppercase tracking-wide text-[#0065ef]">Our Service Programs</span>
                <h2 class="text-[25px] font-black leading-tight tracking-tight text-[#07152f] min-[601px]:text-[30px] min-[901px]:text-4xl">
                    Understand the Right Service for Your Motorcycle
                </h2>
            </div>

            <div class="overflow-hidden rounded-[14px] border border-[#dfe3ea] bg-white shadow-[0_10px_28px_rgba(0,0,0,0.06)]">
                @foreach ($servicePrograms as $index => $program)
                    <div @class([
                             'group grid min-h-[112px] items-center gap-[18px] bg-white transition-colors duration-300 hover:bg-[#fbfbfc]',
                             'grid-cols-1 px-[18px] py-6 text-center max-[600px]:gap-3.5',
                             'min-[601px]:grid-cols-[90px_1fr_40px] min-[601px]:px-[18px] min-[601px]:py-[18px] min-[601px]:text-left',
                             'min-[901px]:grid-cols-[115px_1fr_55px] min-[901px]:px-7 min-[901px]:py-[18px]',
                             'border-b border-[#e2e6ec]' => $index < count($servicePrograms) - 1,
                         ])>
                        <div class="mx-auto flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-[#f0f0f0] text-[#07152f] min-[901px]:h-[74px] min-[901px]:w-[74px]">
                            <x-litus-icon :name="$program['icon']" class="h-8 w-8 min-[901px]:h-9 min-[901px]:w-9" />
                        </div>

                        <div>
                            <h3 class="mb-2 text-xl font-black text-[#111b46] min-[901px]:text-[22px]">{{ $program['title'] }}</h3>
                            <p class="mx-auto max-w-[1120px] text-sm font-semibold leading-snug text-[#4d5869] min-[901px]:text-[15px]">{{ $program['text'] }}</p>
                        </div>

                        <span class="text-center text-[28px] font-normal text-[#0065ef] transition-transform duration-300 group-hover:translate-x-1.5 min-[901px]:text-4xl" aria-hidden="true">›</span>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- WHY LITUS --}}
    <section class="bg-white py-14">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Promise</span>
                <h2 class="mt-2 font-display text-2xl font-black text-gray-900 lg:text-3xl">Why Service Your Motorcycle at LITUS?</h2>
            </div>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($whyLitus as $item)
                    <div class="group rounded-2xl border border-gray-100 p-6 text-center transition-all hover:border-blue-100 hover:shadow-md">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-litus-red/8">
                            <x-litus-icon :name="$item['icon']" class="h-5 w-5 text-litus-red" />
                        </div>
                        <h3 class="mb-2 text-base font-black text-gray-900">{{ $item['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="bg-litus-navy py-14">
        <div class="litus-container flex max-w-5xl flex-col items-center gap-8 lg:flex-row lg:gap-16">
            <div class="flex-1 text-center lg:text-left">
                <h2 class="mb-3 font-display text-3xl font-black text-white lg:text-4xl">
                    Need Motorcycle<br>
                    <span class="text-litus-red">Service Support?</span>
                </h2>
                <p class="leading-relaxed text-gray-400">Our team is ready to help you book maintenance, repairs, inspections, or service guidance.</p>
            </div>
            <div class="flex shrink-0 flex-col gap-3 sm:flex-row">
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
