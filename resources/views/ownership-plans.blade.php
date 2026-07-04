@extends('layouts.litus')

@section('title', 'Ownership Plans — LITUS Automobiles')

@section('content')
@php
    $heroBg = 'https://images.unsplash.com/photo-1550149550-33b46c745e03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1600&q=80';

    $benefits = [
        ['icon' => 'zap', 'label' => 'Flexible ownership options'],
        ['icon' => 'star', 'label' => 'Plans for different budgets'],
        ['icon' => 'check-circle', 'label' => 'Fast transparent approval'],
        ['icon' => 'award', 'label' => 'Early settlement options'],
        ['icon' => 'shield', 'label' => 'Islamic-compliant structure'],
        ['icon' => 'users', 'label' => 'Dedicated support'],
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
            'compare' => ['advance' => 'Lowest', 'guarantor' => 'Required', 'approval' => 'Fast Approval', 'settlement' => 'Available', 'bestFor' => 'Customers with Ijara history'],
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
            'compare' => ['advance' => 'Low', 'guarantor' => 'Immediate Family', 'approval' => 'Easier Qualification', 'settlement' => 'Available', 'bestFor' => 'Family Supported'],
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
            'compare' => ['advance' => 'Reduced', 'guarantor' => 'Employed Guarantor', 'approval' => 'Standard Process', 'settlement' => 'Available', 'bestFor' => 'Employed Customers'],
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
            'compare' => ['advance' => 'Flexible', 'guarantor' => 'Flexible Guarantor', 'approval' => 'Accessible Pathway', 'settlement' => 'Available', 'bestFor' => 'Diverse Income Customers'],
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
            'compare' => ['advance' => 'Higher', 'guarantor' => 'No Guarantor', 'approval' => 'Simple Process', 'settlement' => 'Available', 'bestFor' => 'Independent Customers'],
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
            'compare' => ['advance' => 'Lower Total', 'guarantor' => 'Required', 'approval' => 'Priority Processing', 'settlement' => 'Fixed plan', 'bestFor' => 'Lower cost & faster term'],
        ],
    ];

    $compareRows = [
        ['label' => 'Advance Requirement', 'key' => 'advance'],
        ['label' => 'Guarantor Requirement', 'key' => 'guarantor'],
        ['label' => 'Approval Pathway', 'key' => 'approval'],
        ['label' => 'Early Settlement', 'key' => 'settlement'],
        ['label' => 'Best For', 'key' => 'bestFor'],
    ];

    $steps = [
        ['icon' => 'bike', 'title' => 'Choose Your Ride', 'desc' => 'Select your preferred motorcycle from our collection.'],
        ['icon' => 'file-text', 'title' => 'Select a Plan', 'desc' => 'Choose the ownership plan that suits your budget and documents.'],
        ['icon' => 'check-circle', 'title' => 'Start Riding', 'desc' => 'Complete the process and enjoy your motorcycle with LITUS support.'],
    ];

    $heroStats = [
        ['val' => '6', 'label' => 'Ownership Plans'],
        ['val' => '100%', 'label' => 'Islamic Compliant'],
        ['val' => 'Simple', 'label' => 'Application Process'],
        ['val' => 'Fast', 'label' => 'Transparent Approval'],
    ];
@endphp

<div class="font-sans" data-ownership-plans-page>
    <script type="application/json" id="ownership-plans-data">@json($plans)</script>

    <x-litus-header active="Ownership Plans" />

    {{-- HERO --}}
    <section class="relative min-h-[520px] overflow-hidden bg-[#060E1C] lg:min-h-[560px]">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover opacity-20"
             aria-hidden="true">
        <div class="absolute inset-0 bg-[linear-gradient(110deg,rgba(11,22,40,0.97)_0%,rgba(11,22,40,0.75)_60%,rgba(6,14,28,0.4)_100%)]"></div>

        <div class="relative z-10 litus-container flex flex-col items-center gap-10 py-20 lg:flex-row lg:py-28">
            <div class="text-center lg:w-3/5 lg:text-left">
                <span class="mb-5 inline-block rounded-full border border-[rgba(227,30,37,0.3)] bg-[rgba(227,30,37,0.15)] px-3 py-1 text-xs font-bold uppercase tracking-widest text-litus-red">
                    Ownership Plans
                </span>
                <h1 class="mb-6 font-display text-[clamp(2.4rem,5vw,3.8rem)] font-black leading-[1.05] text-white">
                    Any Bike. Any Budget.<br>
                    <span class="text-litus-red">Anyone Can Own.</span>
                </h1>
                <p class="mx-auto mb-8 max-w-xl text-base leading-relaxed text-gray-300 lg:mx-0 lg:text-lg">
                    Our Islamic-compliant Ijara Plans are designed to make motorcycle ownership more accessible for everyone. Whether you are a salaried employee, freelancer, fisherman, business owner, contractor, or first-time rider, we have an ownership solution that fits your budget and lifestyle.
                </p>
                <div class="flex flex-col justify-center gap-3 sm:flex-row lg:justify-start">
                    <button type="button"
                            data-scroll-plans
                            class="inline-flex items-center justify-center gap-2 rounded-md bg-litus-red px-8 py-3.5 text-sm font-bold text-white transition-opacity hover:opacity-90">
                        Explore Plans
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </button>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center justify-center rounded-md border border-white/30 px-8 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                        Talk to Our Team
                    </a>
                </div>
            </div>

            <div class="mx-auto grid w-full max-w-sm grid-cols-2 gap-3 lg:mx-0 lg:w-2/5">
                @foreach ($heroStats as $stat)
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4 text-center backdrop-blur-sm">
                        <p class="text-2xl font-black text-litus-red">{{ $stat['val'] }}</p>
                        <p class="mt-1 text-xs leading-tight text-gray-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BENEFITS --}}
    <section class="border-b border-gray-100 bg-white py-10">
        <div class="litus-container">
            <div class="flex gap-4 overflow-x-auto pb-2 snap-x snap-mandatory sm:grid sm:grid-cols-3 sm:overflow-visible sm:pb-0 lg:grid-cols-6">
                @foreach ($benefits as $benefit)
                    <div class="flex min-w-[140px] shrink-0 snap-center flex-col items-center gap-2 rounded-2xl px-2 py-4 text-center transition-colors hover:bg-gray-50 sm:min-w-0">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[rgba(227,30,37,0.08)]">
                            <x-litus-icon :name="$benefit['icon']" class="h-5 w-5 text-litus-red" />
                        </div>
                        <p class="text-xs font-semibold leading-tight text-gray-700">{{ $benefit['label'] }}</p>
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
            <div class="mx-auto mt-8 flex max-w-2xl flex-col items-center gap-5 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:flex-row"
                 style="border-left: 4px solid #C89B3C">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[rgba(200,155,60,0.1)]">
                    <x-litus-icon name="message-square" class="h-[22px] w-[22px]" style="color: #C89B3C" />
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <p class="text-base font-black text-gray-900">Not sure which plan is right for you?</p>
                    <p class="mt-0.5 text-sm text-gray-500">Our team can help you choose the ownership plan that best fits your budget and requirements.</p>
                </div>
                <a href="tel:+9607797442"
                   class="flex shrink-0 items-center gap-2 rounded-full bg-litus-navy px-5 py-2.5 text-sm font-bold text-white transition-opacity hover:opacity-90">
                    <x-litus-icon name="phone" class="h-3.5 w-3.5" />
                    Call Us
                </a>
            </div>
        </div>
    </section>

    {{-- COMPARISON TABLE --}}
    <section class="bg-white py-16">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">Compare Plans</span>
                <h2 class="mt-2 font-display text-3xl font-black text-gray-900 lg:text-4xl">Find the Right Ownership Option</h2>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-md">
                <table class="w-full min-w-[700px] border-collapse">
                    <thead>
                        <tr>
                            <th class="w-40 border-b border-gray-100 bg-gray-50 px-4 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                Features
                            </th>
                            @foreach ($plans as $plan)
                                <th class="border-b border-gray-100 px-3 py-4 text-center text-sm font-black"
                                    style="background: {{ $plan['accentLight'] }}; color: {{ $plan['accent'] }}">
                                    {{ $plan['name'] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compareRows as $ri => $row)
                            <tr class="{{ $ri % 2 === 0 ? 'bg-white' : 'bg-gray-50/60' }}">
                                <td class="border-r border-gray-100 px-4 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-600">
                                    {{ $row['label'] }}
                                </td>
                                @foreach ($plans as $plan)
                                    <td class="px-3 py-3.5 text-center text-sm font-medium text-gray-700">
                                        @if ($row['key'] === 'settlement')
                                            @php $val = $plan['compare']['settlement']; @endphp
                                            <span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-bold {{ $val === 'Available' ? 'bg-green-50 text-green-700' : 'bg-orange-50 text-orange-700' }}">
                                                @if ($val === 'Available')
                                                    <x-litus-icon name="check-circle" class="h-[11px] w-[11px]" />
                                                @endif
                                                {{ $val }}
                                            </span>
                                        @else
                                            {{ $plan['compare'][$row['key']] }}
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

    {{-- HOW IT WORKS --}}
    <section class="bg-gray-50 py-14">
        <div class="litus-container">
            <div class="mb-10 text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-litus-red">How Ownership Plans Work</span>
                <h2 class="mt-2 font-display text-2xl font-black text-gray-900 lg:text-3xl">Simple. Transparent. Hassle-Free.</h2>
            </div>

            <div class="flex flex-col items-stretch gap-0 lg:flex-row">
                @foreach ($steps as $i => $step)
                    <div class="flex flex-1 flex-col items-stretch lg:flex-row">
                        <div class="relative mx-2 flex-1 rounded-2xl border border-gray-100 bg-white p-7 text-center shadow-sm transition-shadow hover:shadow-md">
                            <span class="absolute right-4 top-4 flex h-7 w-7 items-center justify-center rounded-full bg-litus-red text-xs font-black text-white">{{ $i + 1 }}</span>
                            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[rgba(227,30,37,0.08)]">
                                <x-litus-icon :name="$step['icon']" class="h-[30px] w-[30px] text-litus-red" />
                            </div>
                            <h3 class="mb-2 text-lg font-black text-gray-900">{{ $step['title'] }}</h3>
                            <p class="text-sm leading-relaxed text-gray-500">{{ $step['desc'] }}</p>
                        </div>
                        @if ($i < count($steps) - 1)
                            <div class="hidden flex-shrink-0 items-center justify-center lg:flex">
                                <x-litus-icon name="arrow-right" class="h-[22px] w-[22px] text-gray-300" />
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-litus-navy py-14">
        <div class="litus-container flex flex-col items-center gap-8 lg:flex-row lg:gap-16">
            <div class="flex-1 text-center lg:text-left">
                <h2 class="mb-3 font-display text-3xl font-black text-white lg:text-4xl">
                    Need Help <span class="text-litus-red">Choosing?</span>
                </h2>
                <p class="leading-relaxed text-gray-400">Our team is here to help you find the ownership plan that best fits your needs.</p>
            </div>
            <div class="flex flex-shrink-0 flex-col gap-3 sm:flex-row">
                <a href="https://wa.me/9607797442"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 rounded-full bg-[#25D366] px-7 py-3.5 text-sm font-bold text-white transition-opacity hover:opacity-90">
                    <x-litus-icon name="message-circle" class="h-4 w-4" />
                    Chat on WhatsApp
                </a>
                <a href="tel:+9607797442"
                   class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 px-7 py-3.5 text-sm font-bold text-white transition-all hover:border-white/60 hover:bg-white/5">
                    <x-litus-icon name="phone" class="h-4 w-4" />
                    Call Us
                </a>
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
