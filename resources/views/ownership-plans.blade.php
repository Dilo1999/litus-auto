@extends('layouts.litus')

@section('title', 'Ownership Plans — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/ownership_plans/' . rawurlencode('ChatGPT Image Jul 4, 2026, 02_28_02 PM.png'));

    $benefits = [
        ['icon' => 'users', 'label' => 'Flexible ownership options'],
        ['icon' => 'credit-card', 'label' => 'Plans for different budgets'],
        ['icon' => 'check-circle', 'label' => 'Fast transparent approval'],
        ['icon' => 'calendar', 'label' => 'Early settlement options'],
        ['icon' => 'shield', 'label' => 'Islamic-compliant structure'],
        ['icon' => 'headphones', 'label' => 'Dedicated support'],
    ];

    $plans = [
        [
            'id' => 'prime',
            'name' => 'Prime',
            'tagline' => 'Lowest Advance Payment',
            'desc' => 'Ideal for customers who can provide additional supporting documents or have a proven Ijara repayment history.',
            'points' => ['Lowest advance requirement', 'Fast approval process', 'Flexible early settlement option'],
            'accent' => '#C89B3C',
            'accentLight' => 'rgba(200,155,60,0.1)',
            'icon' => 'star',
            'drawer' => [
                'subtitle' => 'Lowest Advance Payment',
                'fullDesc' => 'Prime Plan is designed for customers seeking the lowest possible advance payment while benefiting from our most competitive ownership structure.',
                'benefits' => ['Lowest advance payment requirement', 'Faster approval process', 'Flexible early settlement option', 'Ideal for customers with strong repayment credentials'],
                'eligibility' => 'Applicants may provide either a 6-month bank statement or a positive Ijara repayment history with LITUS Automobiles. An immediate family guarantor is also required.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', '6-month bank statement or qualifying Ijara repayment history', 'Supporting document confirming immediate family relationship, if required'],
                'whoFor' => 'Customers looking for the lowest advance payment option, access to flexible early settlement, and who can provide additional supporting credentials.',
            ],
            'compare' => ['advance' => 'Lowest', 'guarantor' => 'Required', 'approval' => 'Fast Approval', 'settlement' => 'Available', 'bestFor' => "Customers with\nIjara history"],
        ],
        [
            'id' => 'family',
            'name' => 'Family',
            'tagline' => 'Family Support Makes Ownership Easier',
            'desc' => 'A practical ownership solution for customers supported by an immediate family guarantor.',
            'points' => ['Lower upfront commitment', 'Easier qualification pathway', 'Flexible early settlement option'],
            'accent' => '#3B82F6',
            'accentLight' => 'rgba(59,130,246,0.1)',
            'icon' => 'users',
            'drawer' => [
                'subtitle' => 'Family Support Makes Ownership Easier',
                'fullDesc' => 'Family Plan is designed for customers who have built a positive Ijara repayment history with us and can be supported by an immediate family guarantor.',
                'benefits' => ['Lower advance payment requirement', 'Easier qualification pathway', 'Flexible early settlement option', 'Designed for returning customers'],
                'eligibility' => 'Applicants should have a positive Ijara repayment history with LITUS Automobiles. An immediate family guarantor is also required.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', 'Qualifying Ijara repayment history with LITUS Automobiles', 'Supporting document confirming immediate family relationship, if required'],
                'whoFor' => 'Customers who have demonstrated responsible repayment behaviour with us and would like to benefit from lower upfront costs and flexible early settlement options.',
            ],
            'compare' => ['advance' => 'Low', 'guarantor' => 'Immediate Family', 'approval' => "Easier\nQualification", 'settlement' => 'Available', 'bestFor' => "Family\nSupported"],
        ],
        [
            'id' => 'secure',
            'name' => 'Secure',
            'tagline' => 'Lower Advance With An Employed Guarantor',
            'desc' => 'A balanced option that combines affordability and accountability.',
            'points' => ['Reduced advance payment', 'Flexible ownership options', 'Flexible early settlement option'],
            'accent' => '#16A34A',
            'accentLight' => 'rgba(22,163,74,0.1)',
            'icon' => 'shield',
            'drawer' => [
                'subtitle' => 'Lower Advance With An Employed Guarantor',
                'fullDesc' => 'Secure Plan offers a practical balance between affordability and accountability, making motorcycle ownership more accessible through the support of an employed guarantor.',
                'benefits' => ['Reduced advance payment requirement', 'Flexible early settlement option', 'Suitable for a wide range of customers', 'Straightforward qualification process'],
                'eligibility' => 'An employed guarantor is required. The guarantor should be employed for a minimum period of three months.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', 'Guarantor employment letter confirming minimum employment period'],
                'whoFor' => 'Customers seeking a lower advance payment option and the flexibility of early settlement while being supported by an employed guarantor.',
            ],
            'compare' => ['advance' => 'Reduced', 'guarantor' => 'Employed Guarantor', 'approval' => "Standard\nProcess", 'settlement' => 'Available', 'bestFor' => "Employed\nCustomers"],
        ],
        [
            'id' => 'flexi',
            'name' => 'Flexi',
            'tagline' => 'Designed For More Customers',
            'desc' => 'Greater accessibility for customers with different income situations and backgrounds.',
            'points' => ['Flexible guarantor option', 'Accessible approval pathway', 'Flexible early settlement option'],
            'accent' => '#7C3AED',
            'accentLight' => 'rgba(124,58,237,0.1)',
            'icon' => 'zap',
            'drawer' => [
                'subtitle' => 'Designed For More Customers',
                'fullDesc' => 'Flexi Plan is designed to make ownership accessible to a wider range of customers, including freelancers, self-employed individuals, business owners, fishermen, contractors and customers with non-traditional income sources.',
                'benefits' => ['Flexible guarantor option', 'Flexible early settlement option', 'Accessible approval pathway', 'Designed for diverse income profiles'],
                'eligibility' => 'Customers can nominate a guarantor without strict employment or family relationship requirements.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy'],
                'whoFor' => 'Customers who may not meet the requirements of other plans but are looking for a practical ownership solution with greater flexibility and early settlement options.',
            ],
            'compare' => ['advance' => 'Flexible', 'guarantor' => "Flexible\nGuarantor", 'approval' => "Accessible\nPathway", 'settlement' => 'Available', 'bestFor' => "Diverse Income\nCustomers"],
        ],
        [
            'id' => 'freedom',
            'name' => 'Freedom',
            'tagline' => 'Own Your Bike Without A Guarantor',
            'desc' => 'For customers who prefer a simpler application process and greater independence.',
            'points' => ['No guarantor required', 'Simple approval process', 'Flexible early settlement option'],
            'accent' => '#EA580C',
            'accentLight' => 'rgba(234,88,12,0.1)',
            'icon' => 'award',
            'drawer' => [
                'subtitle' => 'Own Your Bike Without A Guarantor',
                'fullDesc' => 'Freedom Plan is designed for customers who prefer a simpler ownership process without the need for a guarantor.',
                'benefits' => ['No guarantor required', 'Simple application process', 'Faster ownership pathway', 'Greater independence and flexibility', 'Flexible early settlement option available'],
                'eligibility' => 'Freedom Plan requires a higher advance payment compared to other ownership plans, allowing customers to proceed without a guarantor.',
                'docs' => ['Applicant ID card copy', 'Two alternative family contact numbers'],
                'whoFor' => 'Customers who prefer a straightforward ownership process, value flexible early settlement, and can make a higher upfront contribution.',
            ],
            'compare' => ['advance' => 'Higher', 'guarantor' => "No Guarantor\nRequired", 'approval' => "Simple\nProcess", 'settlement' => 'Available', 'bestFor' => "Independent\nCustomers"],
        ],
        [
            'id' => 'premium',
            'name' => 'Premium',
            'tagline' => 'Lower Total Payment. Faster Ownership.',
            'desc' => 'Our shortest-term ownership solution designed for lower overall financing costs.',
            'points' => ['Premium 6, 8 and 12 options', 'Lower total payable amount', 'Faster ownership completion'],
            'accent' => '#E31E25',
            'accentLight' => 'rgba(227,30,37,0.08)',
            'icon' => 'clipboard-list',
            'drawer' => [
                'subtitle' => 'Lower Total Payment. Faster Ownership.',
                'fullDesc' => 'Premium Plan is designed for customers who want to complete ownership sooner while benefiting from a lower overall payable amount compared to longer-term ownership plans.',
                'benefits' => ['Lower total payable amount', 'Faster ownership completion', 'Available in Premium 6, Premium 8 and Premium 12 options', 'Transparent fixed payment structure'],
                'eligibility' => 'Premium Plan is available with a flexible guarantor requirement and is designed for customers comfortable making a higher upfront contribution in exchange for lower overall ownership costs.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy'],
                'whoFor' => 'Customers who prefer shorter ownership periods, lower overall costs and a faster path to full ownership.',
                'important' => 'Unlike Prime, Family, Secure, Flexi and Freedom Plans, Premium Plans operate on a fixed ownership structure. Since the total ownership cost is already reduced and fixed at the start, flexible early settlement benefits are not applicable under Premium Plans.',
            ],
            'compare' => ['advance' => 'Lower Total', 'guarantor' => 'Required', 'approval' => "Priority\nProcessing", 'settlement' => 'Not applicable', 'bestFor' => "Lower cost &\nfaster term"],
        ],
    ];

    $compareRows = [
        ['label' => 'Advance Requirement', 'key' => 'advance'],
        ['label' => 'Guarantor Requirement', 'key' => 'guarantor'],
        ['label' => 'Approval Pathway', 'key' => 'approval'],
        ['label' => 'Early Settlement', 'key' => 'settlement'],
        ['label' => 'Best For', 'key' => 'bestFor'],
    ];

    $planHeaderColors = [
        'prime' => '#e6a500',
        'family' => '#0854d8',
        'secure' => '#0ca35b',
        'flexi' => '#7335a8',
        'freedom' => '#ff5a00',
        'premium' => '#ed001c',
    ];

    $steps = [
        ['icon' => 'bike', 'title' => 'Choose Your Ride', 'desc' => 'Select your preferred motorcycle from our collection.'],
        ['icon' => 'file-text', 'title' => 'Select a Plan', 'desc' => 'Choose the ownership plan that suits your budget and documents.'],
        ['icon' => 'key', 'title' => 'Start Riding', 'desc' => 'Complete the process and enjoy your motorcycle with LITUS support.'],
    ];

    $heroFeatures = [
        ['icon' => 'clipboard-list', 'title' => '6', 'desc' => 'Ownership Plans'],
        ['icon' => 'shield', 'title' => '100%', 'desc' => 'Islamic Compliant'],
        ['icon' => 'file-text', 'title' => 'Simple', 'desc' => 'Application Process'],
        ['icon' => 'check-circle', 'title' => 'Fast', 'desc' => 'Transparent Approval'],
    ];
@endphp

<div class="font-sans" data-ownership-plans-page>
    <script type="application/json" id="ownership-plans-data">@json($plans)</script>

    <x-litus-header active="Ownership Plans" />

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
                <p class="mb-4 text-base font-extrabold uppercase tracking-[2px] text-[#ff1029] sm:text-lg max-md:text-[15px]">
                    Ownership Plans
                </p>

                <h1 class="mb-4 font-display text-[clamp(2.25rem,4.2vw,4.25rem)] font-black leading-[1.05] tracking-[-0.02em] text-white drop-shadow-[0_6px_20px_rgba(0,0,0,0.55)] max-md:text-[2.25rem]">
                    Any Bike. Any Budget.<br>
                    <span class="text-litus-red">Anyone Can Own.</span>
                </h1>

                <p class="mb-6 max-w-[620px] text-base font-medium leading-[1.5] text-[#e6edf5] sm:text-lg sm:leading-[1.55] max-md:text-[17px]">
                    Our Islamic-compliant Ijara Plans are designed to make motorcycle ownership more accessible for everyone. Whether you are a salaried employee, freelancer, fisherman, business owner, contractor, or first-time rider, we have an ownership solution that fits your budget and lifestyle.
                </p>

                <div class="flex flex-row flex-wrap items-center justify-start gap-5 sm:gap-7">
                    <button type="button"
                            data-scroll-plans
                            class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] bg-[#f20d23] px-5 text-base font-extrabold text-white shadow-[0_8px_22px_rgba(242,13,35,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9091c] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Explore Plans
                        <x-litus-icon name="arrow-right" class="h-4 w-4 sm:h-5 sm:w-5" />
                    </button>
                    <a href="{{ route('contact') }}"
                       class="inline-flex h-14 min-w-[200px] items-center justify-center gap-3 rounded-[9px] border-2 border-white/65 bg-[rgba(6,16,28,0.45)] px-5 text-base font-extrabold text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#f20d23] hover:bg-[rgba(242,13,35,0.15)] sm:h-[60px] sm:min-w-[220px] sm:text-lg max-md:w-full max-md:min-w-0">
                        Talk to Our Team
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

    {{-- BENEFITS --}}
    <section class="border border-[#dfe3ea] bg-[#f8f9fb] px-4 py-5 max-[650px]:px-3 max-[650px]:py-4">
        <div class="litus-container">
            <div class="grid grid-cols-1 items-start gap-5 text-center min-[421px]:grid-cols-2 min-[421px]:gap-x-3 min-[421px]:gap-y-4 min-[651px]:grid-cols-3 min-[651px]:gap-y-5 min-[1101px]:grid-cols-6 min-[1101px]:gap-4">
                @foreach ($benefits as $benefit)
                    <div class="flex flex-col items-center">
                        <div class="relative mb-2.5 flex h-14 w-14 items-center justify-center rounded-full border border-[rgba(7,21,47,0.06)] bg-white text-[#07152f] shadow-[0_6px_18px_rgba(0,0,0,0.07)] min-[651px]:mb-3 min-[651px]:h-16 min-[651px]:w-16">
                            <span class="pointer-events-none absolute inset-2 rounded-full border border-[rgba(232,151,50,0.25)]" aria-hidden="true"></span>
                            <x-litus-icon :name="$benefit['icon']" class="relative z-[1] h-5 w-5 text-[#d8902d] min-[651px]:h-[22px] min-[651px]:w-[22px]" />
                        </div>
                        <h3 class="max-w-[155px] text-[13px] font-black leading-snug text-[#07152f] min-[651px]:max-w-[165px] min-[651px]:text-sm">
                            {{ $benefit['label'] }}
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PLAN CARDS --}}
    <section id="ownership-plans" class="bg-gray-50 py-16">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Our Plans</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Our Ownership Plans</h2>
                <p class="mt-2 text-gray-500">Choose the Ijara Plan that suits you best.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div class="group flex flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:shadow-xl"
                         style="border-top: 3px solid {{ $plan['accent'] }}">
                        <div class="p-6 pb-4">
                            <div class="mb-4 flex items-start justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl" style="background: {{ $plan['accentLight'] }}">
                                    <x-litus-icon :name="$plan['icon']" class="h-6 w-6" style="color: {{ $plan['accent'] }}" />
                                </div>
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold" style="background: {{ $plan['accentLight'] }}; color: {{ $plan['accent'] }}">
                                    Ijara Plan
                                </span>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">{{ $plan['name'] }}</h3>
                            <p class="mt-1 mb-3 text-xs font-semibold" style="color: {{ $plan['accent'] }}">{{ $plan['tagline'] }}</p>
                            <p class="text-sm leading-relaxed text-gray-500">{{ $plan['desc'] }}</p>
                        </div>

                        <div class="flex-1 px-6 pb-5">
                            <div class="mb-4 h-px bg-gray-100"></div>
                            <ul class="space-y-2">
                                @foreach ($plan['points'] as $point)
                                    <li class="flex items-start gap-2 text-sm text-gray-600">
                                        <x-litus-icon name="check-circle" class="mt-0.5 h-3.5 w-3.5 shrink-0" style="color: {{ $plan['accent'] }}" />
                                        {{ $point }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="px-6 pb-6">
                            <button type="button"
                                    data-plan-open="{{ $plan['id'] }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold transition-all hover:text-white"
                                    style="background: {{ $plan['accentLight'] }}; color: {{ $plan['accent'] }}; border: 1.5px solid {{ $plan['accent'] }}"
                                    onmouseenter="this.style.background='{{ $plan['accent'] }}'; this.style.color='#fff'"
                                    onmouseleave="this.style.background='{{ $plan['accentLight'] }}'; this.style.color='{{ $plan['accent'] }}'">
                                View Details
                                <x-litus-icon name="chevron-right" class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Help note --}}
            <div class="relative mt-8 w-full overflow-hidden rounded-xl border border-[#e1e5eb] bg-white shadow-[0_10px_28px_rgba(0,0,0,0.06)]">
                <span class="absolute left-0 top-0 h-full w-[5px] rounded-l-xl bg-[#f5b21f]" aria-hidden="true"></span>

                <div class="grid grid-cols-1 items-center gap-5 px-[22px] py-7 text-center min-[701px]:grid-cols-[auto_1fr_auto] min-[701px]:gap-5 min-[701px]:py-[22px] min-[701px]:pl-7 min-[701px]:pr-6 min-[701px]:text-left">
                    <div class="relative mx-auto flex h-[70px] w-[70px] shrink-0 items-center justify-center rounded-full border-2 border-[#f5b21f] bg-[#fffaf0] text-[#f5b21f] min-[701px]:mx-0">
                        <span class="pointer-events-none absolute inset-[9px] rounded-full border border-[rgba(245,178,31,0.45)]" aria-hidden="true"></span>
                        <x-litus-icon name="phone" class="relative z-[1] h-8 w-8" />
                    </div>

                    <div class="min-w-0">
                        <h3 class="mb-2 text-lg font-black text-[#07152f]">Not sure which plan is right for you?</h3>
                        <p class="text-[15px] font-semibold leading-[1.45] text-[#4e5969] min-[701px]:max-w-none">
                            Our team can help you choose the ownership plan that best fits your budget and requirements.
                        </p>
                    </div>

                    <a href="tel:+9607797442"
                       class="inline-flex h-12 min-w-[145px] w-full shrink-0 items-center justify-center gap-2.5 rounded-md bg-[#061a45] px-6 text-sm font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#ff1029] min-[701px]:w-auto">
                        <x-litus-icon name="phone" class="h-4 w-4" />
                        Call Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- COMPARISON TABLE --}}
    <section class="bg-[#f8f9fb] px-5 py-[25px] pb-10 max-md:px-3.5 max-md:py-7 max-md:pb-9">
        <div class="litus-container">
            <div class="mb-5 text-center">
                <span class="mb-2 block text-[13px] font-black uppercase tracking-[0.6px] text-[#ff1029] min-[769px]:text-[15px]">Compare Plans</span>
                <h2 class="font-display text-[28px] font-black leading-[1.1] tracking-[-0.5px] text-[#07152f] min-[769px]:text-4xl">Find the Right Ownership Option</h2>
            </div>

            <div class="overflow-x-auto rounded-[10px] shadow-[0_10px_28px_rgba(0,0,0,0.06)]">
                <table class="w-full min-w-[1100px] border-separate border-spacing-0 overflow-hidden rounded-[10px] bg-white [&_tbody_tr:last-child_td]:border-b-0">
                    <thead>
                        <tr>
                            <th class="w-[210px] border-b border-r border-[#dfe3ea] bg-[#061a45] px-[18px] py-[18px] text-left text-[17px] font-black text-white min-[769px]:text-[17px] max-md:text-[15px]">
                                Features
                            </th>
                            @foreach ($plans as $plan)
                                <th class="border-b border-r border-[#dfe3ea] px-[18px] py-[18px] text-center text-[15px] font-black text-white last:border-r-0 min-[769px]:text-[17px]"
                                    style="background: {{ $planHeaderColors[$plan['id']] }}">
                                    {{ $plan['name'] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compareRows as $row)
                            <tr>
                                <td class="w-[210px] border-b border-r border-[#dfe3ea] bg-[#061a45] px-[18px] py-5 text-left text-[15px] font-black leading-[1.35] text-white max-md:px-3.5 max-md:py-4 max-md:text-sm">
                                    {{ $row['label'] }}
                                </td>
                                @foreach ($plans as $plan)
                                    <td class="border-b border-r border-[#dfe3ea] px-[18px] py-5 text-center align-middle text-[15px] font-bold leading-[1.35] text-[#25304a] last:border-r-0 max-md:px-3.5 max-md:py-4 max-md:text-sm">
                                        @if ($row['key'] === 'settlement')
                                            @php $val = $plan['compare']['settlement']; @endphp
                                            <span class="inline-flex items-center justify-center gap-2.5">
                                                <span class="inline-flex h-[22px] w-[22px] min-w-[22px] items-center justify-center rounded-full bg-[#08a84f] text-sm font-black text-white">✓</span>
                                                @if ($val === 'Available')
                                                    Available
                                                @else
                                                    Not applicable<br>(Fixed Plan)
                                                @endif
                                            </span>
                                        @else
                                            {!! nl2br(e($plan['compare'][$row['key']])) !!}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS + CTA --}}
    <section class="bg-[#f8f9fb] px-5 py-[22px] pb-9 max-[650px]:px-3.5 max-[650px]:py-7 max-[650px]:pb-9">
        <div class="litus-container">
            <div class="mb-[25px] text-center">
                <span class="mb-[7px] block text-sm font-black uppercase tracking-[0.6px] text-[#ff1029]">How Ownership Plans Work</span>
                <h2 class="font-display text-[28px] font-black leading-[1.1] tracking-[-0.5px] text-[#07152f] min-[651px]:text-4xl">Simple. Transparent. Hassle-Free.</h2>
            </div>

            <div class="mb-10 grid grid-cols-1 gap-[18px] min-[1151px]:grid-cols-[1fr_40px_1fr_40px_1fr] min-[1151px]:items-center min-[1151px]:gap-0">
                @foreach ($steps as $i => $step)
                    <div class="grid min-h-0 grid-cols-1 items-center gap-2.5 rounded-[10px] border border-[#e1e5eb] bg-white px-4 py-4 text-center shadow-[0_10px_26px_rgba(0,0,0,0.06)] min-[651px]:grid-cols-[72px_36px_1fr] min-[651px]:gap-3 min-[651px]:px-5 min-[651px]:py-4 min-[651px]:text-left">
                        <div class="mx-auto flex items-center justify-center text-[#061a45] min-[651px]:mx-0">
                            <x-litus-icon :name="$step['icon']" class="h-10 w-10 min-[651px]:h-11 min-[651px]:w-11" />
                        </div>
                        <div class="mx-auto flex h-8 w-8 items-center justify-center rounded-full bg-[#ff1029] text-base font-black text-white shadow-[0_6px_14px_rgba(255,16,41,0.28)] min-[651px]:mx-0 min-[651px]:h-9 min-[651px]:w-9 min-[651px]:text-lg">
                            {{ $i + 1 }}
                        </div>
                        <div>
                            <h3 class="mb-1.5 text-base font-black text-[#07152f] min-[651px]:text-lg">{{ $step['title'] }}</h3>
                            <p class="mx-auto max-w-[290px] text-[13px] font-semibold leading-snug text-[#4d5869] min-[651px]:mx-0 min-[651px]:text-sm">{{ $step['desc'] }}</p>
                        </div>
                    </div>

                    @if ($i < count($steps) - 1)
                        <div class="flex items-center justify-center text-[30px] font-black tracking-[3px] text-[#07152f] min-[1151px]:text-[38px] max-[1150px]:rotate-90">
                            ···›
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="grid grid-cols-1 items-center gap-8 rounded-[10px] border border-white/12 bg-[linear-gradient(135deg,#061a45,#020b1d)] px-[22px] py-[30px] shadow-[0_12px_32px_rgba(0,0,0,0.16)] min-[1151px]:grid-cols-[auto_1fr_auto] min-[1151px]:gap-9 min-[1151px]:px-11">
                <div class="mx-auto flex h-24 w-24 min-w-24 items-center justify-center rounded-full border-2 border-white/50 bg-white/[0.03] text-white min-[1151px]:mx-0">
                    <x-litus-icon name="headphones" class="h-11 w-11" />
                </div>

                <div class="text-center min-[1151px]:text-left">
                    <h2 class="mb-3 text-[25px] font-black tracking-[-0.3px] text-white min-[651px]:text-[29px]">Need Help Choosing?</h2>
                    <p class="mx-auto max-w-[560px] text-base font-semibold leading-[1.55] text-[#d9e2ef] min-[1151px]:mx-0">
                        Our team is here to help you find the ownership plan that best fits your needs.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-[22px] min-[1151px]:justify-end">
                    <a href="https://wa.me/9607797442"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex h-[58px] w-full min-w-0 items-center justify-center gap-3 rounded-[7px] bg-[#ff1029] px-8 text-[17px] font-black text-white shadow-[0_10px_24px_rgba(255,16,41,0.3)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#c9081a] min-[651px]:w-auto min-[651px]:min-w-[260px]">
                        <x-litus-icon name="message-circle" class="h-5 w-5" />
                        Chat on WhatsApp
                    </a>
                    <a href="tel:+9607797442"
                       class="inline-flex h-[58px] w-full min-w-0 items-center justify-center gap-3 rounded-[7px] border-2 border-white/55 bg-white/[0.03] px-8 text-[17px] font-black text-white transition-all duration-300 hover:-translate-y-0.5 hover:border-[#ff1029] hover:bg-[rgba(255,16,41,0.12)] min-[651px]:w-auto min-[651px]:min-w-[260px]">
                        <x-litus-icon name="phone" class="h-5 w-5" />
                        Call Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-litus-footer />

    {{-- PLAN DRAWER --}}
    <div data-plan-drawer-backdrop class="fixed inset-0 z-[60] hidden bg-black/60 backdrop-blur-sm"></div>

    <div data-plan-drawer
         class="fixed top-0 right-0 z-[70] hidden flex h-full w-full flex-col bg-white shadow-2xl sm:w-[430px]">
        <div data-drawer-header-stripe class="flex items-start justify-between border-b border-gray-100 px-6 pb-5 pt-6" style="border-top: 4px solid #E31E25">
            <div>
                <div class="mb-1 flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[rgba(227,30,37,0.08)]">
                        <x-litus-icon name="star" data-drawer-icon class="h-[17px] w-[17px] text-litus-red" />
                    </div>
                    <span data-drawer-badge class="text-xs font-bold uppercase tracking-widest text-litus-red">Ijara Plan</span>
                </div>
                <h2 data-drawer-title class="text-2xl font-black text-gray-900">Plan</h2>
                <p data-drawer-subtitle class="mt-0.5 text-sm font-semibold text-litus-red"></p>
            </div>
            <button type="button"
                    data-plan-drawer-close
                    class="mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 transition-colors hover:bg-gray-200"
                    aria-label="Close plan details">
                <x-litus-icon name="x" class="h-[17px] w-[17px] text-gray-600" />
            </button>
        </div>

        <div class="flex-1 space-y-6 overflow-y-auto px-6 py-5">
            <p data-drawer-desc class="text-sm leading-relaxed text-gray-600"></p>

            <div>
                <h4 class="mb-3 text-sm font-black uppercase tracking-wider text-gray-900">Key Benefits</h4>
                <ul data-drawer-benefits class="space-y-2"></ul>
            </div>

            <div data-drawer-eligibility-box class="rounded-xl p-4" style="background: rgba(227,30,37,0.08)">
                <h4 class="mb-2 text-sm font-black uppercase tracking-wider text-gray-900">Eligibility</h4>
                <p data-drawer-eligibility class="text-sm leading-relaxed text-gray-700"></p>
            </div>

            <div>
                <h4 class="mb-3 text-sm font-black uppercase tracking-wider text-gray-900">Required Documents</h4>
                <ul data-drawer-docs class="space-y-2"></ul>
            </div>

            <div class="rounded-xl bg-gray-50 p-4">
                <h4 class="mb-2 text-sm font-black uppercase tracking-wider text-gray-900">Who Is It For?</h4>
                <p data-drawer-who-for class="text-sm leading-relaxed text-gray-600"></p>
            </div>

            <div data-drawer-important-wrap class="hidden rounded-xl border border-orange-200 bg-orange-50 p-4">
                <h4 class="mb-2 text-xs font-black uppercase tracking-wider text-orange-800">Important Information</h4>
                <p data-drawer-important class="text-xs leading-relaxed text-orange-700"></p>
            </div>
        </div>

        <div class="border-t border-gray-100 bg-white px-6 py-4">
            <a href="https://wa.me/9607797442"
               target="_blank"
               rel="noopener noreferrer"
               class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#25D366] py-3.5 text-sm font-black text-white transition-opacity hover:opacity-90">
                <x-litus-icon name="message-circle" class="h-[17px] w-[17px]" />
                Apply via WhatsApp
            </a>
            <p class="mt-2 text-center text-xs text-gray-400">Our team will guide you through the process.</p>
        </div>
    </div>
</div>
@endsection
