@extends('layouts.litus')

@section('title', 'Ijara Plans — LITUS Automobiles')

@section('content')
@php
    $heroBg = asset('images/ownership_plans/' . rawurlencode('ChatGPT Image Jul 4, 2026, 02_28_02 PM.png'));

    $heroStrip = [
        ['icon' => 'file-text', 'title' => '6 Plans', 'sub' => 'One will fit your situation'],
        ['icon' => 'shield', 'title' => 'Fixed Price', 'sub' => 'Agreed in writing upfront'],
        ['icon' => 'clock', 'title' => 'Fast Approval', 'sub' => 'Subject to assessment'],
        ['icon' => 'check-circle', 'title' => 'Early Settlement', 'sub' => 'No additional charge'],
    ];

    $plans = [
        [
            'id' => 'prime',
            'name' => 'Prime',
            'tag' => 'Lowest advance',
            'color' => '#C2650B',
            'bg' => '#FFF3E4',
            'accent' => '#C2650B',
            'accentLight' => '#FFF3E4',
            'icon' => 'star',
            'desc' => 'For customers who can provide supporting documents or have a previous ownership history with us.',
            'pts' => ['Lowest advance requirement', 'Fast approval pathway', 'Flexible early settlement'],
            'best' => 'Customers with LITUS history',
            'drawer' => [
                'subtitle' => 'Lowest Advance Payment',
                'fullDesc' => 'Prime Plan is designed for customers seeking the lowest possible advance payment while benefiting from our most competitive ownership structure.',
                'benefits' => ['Lowest advance payment requirement', 'Faster approval process', 'Flexible early settlement option', 'Ideal for customers with strong repayment credentials'],
                'eligibility' => 'Applicants may provide either a 6-month bank statement or a positive Ijara repayment history with LITUS Automobiles. An immediate family guarantor is also required.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', '6-month bank statement or qualifying Ijara repayment history', 'Supporting document confirming immediate family relationship, if required'],
                'whoFor' => 'Customers looking for the lowest advance payment option, access to flexible early settlement, and who can provide additional supporting credentials.',
            ],
        ],
        [
            'id' => 'family',
            'name' => 'Family',
            'tag' => 'Family guarantor',
            'color' => '#1257D6',
            'bg' => '#DCE8FF',
            'accent' => '#1257D6',
            'accentLight' => '#DCE8FF',
            'icon' => 'users',
            'desc' => 'A practical route for customers supported by an immediate family guarantor.',
            'pts' => ['Lower upfront commitment', 'Simple qualification pathway', 'Flexible early settlement'],
            'best' => 'Family-supported buyers',
            'drawer' => [
                'subtitle' => 'Family Support Makes Ownership Easier',
                'fullDesc' => 'Family Plan is designed for customers who have built a positive Ijara repayment history with us and can be supported by an immediate family guarantor.',
                'benefits' => ['Lower advance payment requirement', 'Easier qualification pathway', 'Flexible early settlement option', 'Designed for returning customers'],
                'eligibility' => 'Applicants should have a positive Ijara repayment history with LITUS Automobiles. An immediate family guarantor is also required.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', 'Qualifying Ijara repayment history with LITUS Automobiles', 'Supporting document confirming immediate family relationship, if required'],
                'whoFor' => 'Customers who have demonstrated responsible repayment behaviour with us and would like to benefit from lower upfront costs and flexible early settlement options.',
            ],
        ],
        [
            'id' => 'secure',
            'name' => 'Secure',
            'tag' => 'Employer guarantee',
            'color' => '#0E9384',
            'bg' => '#E6F6F3',
            'accent' => '#0E9384',
            'accentLight' => '#E6F6F3',
            'icon' => 'shield',
            'desc' => 'A balanced option for customers whose employer will act as guarantor.',
            'pts' => ['Reduced advance payment', 'Flexible ownership options', 'Flexible early settlement'],
            'best' => 'Employed customers',
            'drawer' => [
                'subtitle' => 'Lower Advance With An Employed Guarantor',
                'fullDesc' => 'Secure Plan offers a practical balance between affordability and accountability, making motorcycle ownership more accessible through the support of an employed guarantor.',
                'benefits' => ['Reduced advance payment requirement', 'Flexible early settlement option', 'Suitable for a wide range of customers', 'Straightforward qualification process'],
                'eligibility' => 'An employed guarantor is required. The guarantor should be employed for a minimum period of three months.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy', 'Guarantor employment letter confirming minimum employment period'],
                'whoFor' => 'Customers seeking a lower advance payment option and the flexibility of early settlement while being supported by an employed guarantor.',
            ],
        ],
        [
            'id' => 'flexi',
            'name' => 'Flexi',
            'tag' => 'For mixed incomes',
            'color' => '#6941C6',
            'bg' => '#F2ECFF',
            'accent' => '#6941C6',
            'accentLight' => '#F2ECFF',
            'icon' => 'zap',
            'desc' => 'Built for customers whose income comes from more than one source or varies month to month.',
            'pts' => ['Flexible guarantor option', 'Accessible approval pathway', 'Flexible early settlement'],
            'best' => 'Freelancers & fishermen',
            'drawer' => [
                'subtitle' => 'Designed For More Customers',
                'fullDesc' => 'Flexi Plan is designed to make ownership accessible to a wider range of customers, including freelancers, self-employed individuals, business owners, fishermen, contractors and customers with non-traditional income sources.',
                'benefits' => ['Flexible guarantor option', 'Flexible early settlement option', 'Accessible approval pathway', 'Designed for diverse income profiles'],
                'eligibility' => 'Customers can nominate a guarantor without strict employment or family relationship requirements.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy'],
                'whoFor' => 'Customers who may not meet the requirements of other plans but are looking for a practical ownership solution with greater flexibility and early settlement options.',
            ],
        ],
        [
            'id' => 'freedom',
            'name' => 'Freedom',
            'tag' => 'No guarantor',
            'color' => '#C4320A',
            'bg' => '#FFECE5',
            'accent' => '#C4320A',
            'accentLight' => '#FFECE5',
            'icon' => 'award',
            'desc' => 'For customers who prefer a simpler application process with greater independence.',
            'pts' => ['No guarantor required', 'Simpler approval process', 'Flexible early settlement'],
            'best' => 'Independent customers',
            'drawer' => [
                'subtitle' => 'Own Your Bike Without A Guarantor',
                'fullDesc' => 'Freedom Plan is designed for customers who prefer a simpler ownership process without the need for a guarantor.',
                'benefits' => ['No guarantor required', 'Simple application process', 'Faster ownership pathway', 'Greater independence and flexibility', 'Flexible early settlement option available'],
                'eligibility' => 'Freedom Plan requires a higher advance payment compared to other ownership plans, allowing customers to proceed without a guarantor.',
                'docs' => ['Applicant ID card copy', 'Two alternative family contact numbers'],
                'whoFor' => 'Customers who prefer a straightforward ownership process, value flexible early settlement, and can make a higher upfront contribution.',
            ],
        ],
        [
            'id' => 'premium',
            'name' => 'Premium',
            'tag' => 'Lowest total cost',
            'color' => '#0E9F6E',
            'bg' => '#E6F7F0',
            'accent' => '#0E9F6E',
            'accentLight' => '#E6F7F0',
            'icon' => 'clipboard-list',
            'desc' => 'Our shortest-term ownership route, designed for the lowest overall lease cost.',
            'pts' => ['Highest advance, shortest term', 'Lowest total lease amount', 'Fastest ownership completion'],
            'best' => 'Lowest cost & short term',
            'drawer' => [
                'subtitle' => 'Lower Total Payment. Faster Ownership.',
                'fullDesc' => 'Premium Plan is designed for customers who want to complete ownership sooner while benefiting from a lower overall payable amount compared to longer-term ownership plans.',
                'benefits' => ['Lower total payable amount', 'Faster ownership completion', 'Available in Premium 6, Premium 8 and Premium 12 options', 'Transparent fixed payment structure'],
                'eligibility' => 'Premium Plan is available with a flexible guarantor requirement and is designed for customers comfortable making a higher upfront contribution in exchange for lower overall ownership costs.',
                'docs' => ['Applicant ID card copy', 'Guarantor ID card copy'],
                'whoFor' => 'Customers who prefer shorter ownership periods, lower overall costs and a faster path to full ownership.',
                'important' => 'Unlike Prime, Family, Secure, Flexi and Freedom Plans, Premium Plans operate on a fixed ownership structure. Since the total ownership cost is already reduced and fixed at the start, flexible early settlement benefits are not applicable under Premium Plans.',
            ],
        ],
    ];

    $steps = [
        [
            'title' => 'Choose your ride',
            'text' => 'Select your preferred motorcycle from our range, or from any of this month’s promotions. The offer discount is applied before your plan is calculated.',
        ],
        [
            'title' => 'Select a plan',
            'text' => 'Choose the plan that suits your budget and the documents you can provide. We show you the total lease price and the monthly amount side by side, in writing.',
        ],
        [
            'title' => 'Start riding',
            'text' => 'Complete the process, collect from your showroom, and enjoy your motorcycle. Early settlement stays available throughout at no extra charge.',
        ],
    ];

    $faqs = [
        [
            'q' => 'Is there any interest charged?',
            'a' => 'No. An Ijara plan is a lease structured to Islamic leasing standards, not a loan. There is no interest and no interest rate. You agree a fixed total lease price at the start and pay it in equal monthly amounts. That figure does not change and does not compound.',
        ],
        [
            'q' => 'What happens if I want to pay it off early?',
            'a' => 'You can settle early on any of our six plans, at no additional charge. Speak to our team and they will confirm the settlement figure for your plan.',
        ],
        [
            'q' => 'Can I use a promotion discount with a plan?',
            'a' => 'Yes on most offers. The discount reduces the price your plan is calculated from, so your monthly amount is lower too. Where an offer is cash-only, it is stated clearly on that offer’s page.',
        ],
        [
            'q' => 'Do I need a guarantor?',
            'a' => 'It depends on the plan. The Freedom plan requires no guarantor. Family and Secure use a family member or employer respectively. Our team will confirm what your chosen plan needs before you start the application.',
        ],
        [
            'q' => 'How long does approval take?',
            'a' => 'Usually a few working days once your documents are complete — longer if anything is missing. If you are applying against a promotion deadline, start early and we will tell you honestly whether it is likely to clear in time.',
        ],
        [
            'q' => 'What if my income varies month to month?',
            'a' => 'The Flexi plan is built for exactly that — customers whose income comes from more than one source or changes seasonally. Fishermen, freelancers and small business owners most often use it.',
        ],
    ];

    $needs = [
        ['label' => 'Maldivian ID card', 'value' => 'Always'],
        ['label' => 'Proof of income', 'value' => 'Most plans'],
        ['label' => 'Guarantor', 'value' => 'Plan dependent'],
        ['label' => 'Advance payment', 'value' => 'From 15%'],
        ['label' => 'Plan period', 'value' => '12–48 months'],
    ];
@endphp

<div class="font-sans" data-ownership-plans-page>
    <script type="application/json" id="ownership-plans-data">@json($plans)</script>

    <x-litus-header active="Ijara Plans" />

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-litus-ink text-white">
        <img src="{{ $heroBg }}"
             alt=""
             class="absolute inset-0 h-full w-full object-cover object-[center_right] max-md:object-[center_30%]"
             aria-hidden="true">
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(90deg,rgba(5,11,24,0.96)_0%,rgba(5,11,24,0.88)_34%,rgba(5,11,24,0.55)_62%,rgba(5,11,24,0.35)_100%)] max-md:bg-[linear-gradient(180deg,rgba(5,11,24,0.55)_0%,rgba(5,11,24,0.78)_42%,rgba(5,11,24,0.94)_100%)]"></div>
        <div class="pointer-events-none absolute inset-0"
             style="background:
                radial-gradient(900px 520px at 82% 6%, rgba(46,116,238,.28), transparent 62%),
                radial-gradient(680px 460px at 2% 96%, rgba(90,184,255,.12), transparent 60%),
                linear-gradient(180deg, transparent 40%, rgba(5,11,24,.55) 100%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.28]"
             style="background-image: linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px); background-size: 76px 76px; mask-image: radial-gradient(700px 500px at 30% 30%, #000, transparent 78%);"></div>

        <div class="relative z-[3] litus-container py-[clamp(48px,6.5vw,88px)] pb-[clamp(40px,5vw,68px)]">
            <div class="max-w-[820px]">
                <span class="mb-3 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-sky">Ownership Plans</span>
                <h1 class="font-display text-[clamp(30px,4.2vw,50px)] font-bold leading-[1.08] tracking-[-0.032em] drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
                    Any bike. Any budget.<br><span class="text-litus-sky">Anyone can own.</span>
                </h1>
                <p class="mt-4 max-w-[600px] text-[clamp(16px,1.4vw,18px)] leading-[1.66] text-white/[0.78]">
                    Our Ijara Plans are structured to Islamic leasing standards and designed to make motorcycle ownership reachable — whether you are salaried, self-employed, a fisherman, a business owner, or buying your first bike.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#compare"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-litus-primary px-7 py-[15px] text-[15px] font-semibold text-white shadow-[0_8px_22px_rgba(18,87,214,0.3)] transition hover:-translate-y-0.5 hover:bg-litus-primary-hover">
                        Compare the Six Plans
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-7 py-[15px] text-[15px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                        Talk to Our Team
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-[3] border-t border-white/11 bg-black/35 backdrop-blur-sm">
            <div class="litus-container grid grid-cols-1 gap-4 py-[22px] sm:grid-cols-2 lg:grid-cols-4 lg:gap-2.5">
                @foreach ($heroStrip as $item)
                    <div class="flex items-center gap-[13px]">
                        <div class="grid h-[38px] w-[38px] shrink-0 place-items-center rounded-[10px] bg-[rgba(90,184,255,0.15)] text-litus-sky">
                            <x-litus-icon :name="$item['icon']" class="h-4 w-4" />
                        </div>
                        <div>
                            <b class="block text-sm font-semibold leading-snug text-white">{{ $item['title'] }}</b>
                            <span class="block text-[12.5px] leading-snug text-white/60">{{ $item['sub'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="litus-sec">
        <div class="litus-container grid grid-cols-1 gap-14 min-[1000px]:grid-cols-[1.35fr_0.65fr]">
            <div>
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">How It Works</span>
                <h2 class="mb-6 font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">
                    An Ijara plan is a lease, not a loan
                </h2>
                <div class="max-w-[720px] text-[16.5px] leading-[1.78] text-[#26324A]">
                    <p class="mb-[17px]">
                        <strong class="font-semibold text-litus-text">There is no interest and no interest rate.</strong>
                        Instead we agree a total lease price with you at the start — one figure, in writing, before anything is signed — and you pay it in equal monthly amounts over an agreed period. That figure never changes. It does not compound, and it does not increase if a payment is late.
                    </p>
                    <p class="mb-[17px]">
                        At the end of the plan, ownership of the motorcycle transfers to you. If you want to settle early at any point, you can, and there is no additional charge for doing so.
                    </p>
                    <p class="mb-[17px]">
                        We built six plans rather than one because the Maldives does not have one kind of buyer. A salaried employee in Malé, a fisherman in Laamu with income that varies by season, and a first-time rider with a family guarantor all need different structures. The plan below that fits your situation is the one our team will steer you toward — including when that is the cheaper one.
                    </p>
                </div>

                <div class="mt-8 rounded-r-[12px] border-l-4 border-litus-teal bg-[#E6F6F3] px-6 py-5">
                    <b class="mb-1.5 block text-[14.5px] text-litus-text">What we will not tell you</b>
                    <p class="m-0 text-[14.5px] leading-relaxed text-[#2A3548]">
                        We do not advertise “guaranteed approval”, and we will not quote you a monthly figure we cannot honour. Every application is assessed individually. If a plan is unlikely to work for you, our team will say so at the start rather than take you through a process that ends in a decline.
                    </p>
                </div>
            </div>

            <aside class="min-[1000px]:sticky min-[1000px]:top-[96px] min-[1000px]:self-start">
                <div class="rounded-[26px] border border-litus-line bg-white p-[26px] shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]">
                    <h4 class="mb-4 font-display text-[clamp(20px,2.2vw,26px)] font-semibold tracking-[-0.02em] text-litus-text">What you will need</h4>
                    <div class="divide-y divide-litus-line text-[14.5px]">
                        @foreach ($needs as $need)
                            <div class="flex justify-between gap-4 py-3.5">
                                <span class="text-litus-text-2">{{ $need['label'] }}</span>
                                <b class="text-litus-text">{{ $need['value'] }}</b>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('contact') }}"
                       class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-litus-ink px-6 py-3.5 text-[14.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-litus-ink-700">
                        Check My Eligibility
                        <x-litus-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- SIX PLANS --}}
    <section id="compare" class="litus-sec scroll-mt-24 bg-litus-paper-2">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Our Plans</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Six ways to own your motorcycle</h2>
                <p class="mt-4 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-litus-text-2">
                    Choose the plan that fits your situation. Our team will confirm which you qualify for.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($plans as $plan)
                    <article class="flex h-full flex-col rounded-[18px] border border-litus-line bg-white px-[26px] py-[28px] shadow-[0_1px_2px_rgba(9,17,32,.05),0_6px_16px_rgba(9,17,32,.05)]"
                             style="border-top: 4px solid {{ $plan['color'] }}">
                        <div class="mb-3.5 flex items-start justify-between gap-3">
                            <h4 class="font-display text-[clamp(20px,2.2vw,24px)] font-semibold tracking-[-0.02em] text-litus-text">{{ $plan['name'] }}</h4>
                            <span class="shrink-0 rounded-md px-2.5 py-1 text-[10.5px] font-extrabold uppercase tracking-[0.06em]"
                                  style="background: {{ $plan['bg'] }}; color: {{ $plan['color'] }}">
                                {{ $plan['tag'] }}
                            </span>
                        </div>
                        <p class="mb-[18px] text-[14.5px] leading-relaxed text-litus-text-2">{{ $plan['desc'] }}</p>
                        <ul class="mb-5 grid list-none gap-2.5">
                            @foreach ($plan['pts'] as $pt)
                                <li class="flex gap-2.5 text-sm text-litus-text">
                                    <span class="mt-0.5 shrink-0" style="color: {{ $plan['color'] }}">
                                        <x-litus-icon name="check-circle" class="h-4 w-4" />
                                    </span>
                                    <span>{{ $pt }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-auto border-t border-litus-line pt-3.5">
                            <div class="mb-4 flex items-start justify-between gap-3">
                                <span class="text-[12.5px] text-litus-text-3">Best for</span>
                                <b class="text-right text-[13px] font-semibold text-litus-text">{{ $plan['best'] }}</b>
                            </div>
                            <button type="button"
                                    data-plan-open="{{ $plan['id'] }}"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg border-[1.5px] px-4 py-3 text-[13.5px] font-semibold transition hover:-translate-y-0.5"
                                    style="border-color: {{ $plan['color'] }}; color: {{ $plan['color'] }}; background: {{ $plan['bg'] }}">
                                View Details
                                <x-litus-icon name="chevron-right" class="h-4 w-4" />
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mx-auto mt-9 max-w-[900px] rounded-r-[12px] border-l-4 border-[#C89B3C] bg-[#FFF8EB] px-6 py-5">
                <b class="mb-1.5 block text-[14.5px] text-litus-text">Not sure which plan is right?</b>
                <p class="m-0 text-[14.5px] leading-relaxed text-[#2A3548]">
                    Call us on 779 7442 or visit any showroom. Our team will look at your situation and tell you which of the six is the best fit — and which you are likely to be approved for.
                </p>
            </div>
        </div>
    </section>

    <x-litus-ijara-band />

    {{-- HOW OWNERSHIP WORKS --}}
    <section class="litus-sec">
        <div class="litus-container">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Simple. Transparent. Hassle-free.</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">How ownership plans work</h2>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($steps as $index => $step)
                    <div class="rounded-[18px] border border-litus-line bg-white px-[26px] py-[30px]">
                        <div class="mb-[18px] grid h-[42px] w-[42px] place-items-center rounded-[12px] bg-litus-ink font-display text-[17px] font-bold text-white">
                            {{ $index + 1 }}
                        </div>
                        <h4 class="mb-2 text-lg font-bold text-litus-text">{{ $step['title'] }}</h4>
                        <p class="text-[14.5px] text-litus-text-2">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="litus-sec bg-litus-paper-2">
        <div class="litus-container max-w-[880px]">
            <div class="mx-auto mb-[clamp(34px,4vw,54px)] max-w-[660px] text-center">
                <span class="mb-3.5 block text-[11.5px] font-bold uppercase tracking-[0.19em] text-litus-primary">Questions</span>
                <h2 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em] text-litus-text">Common questions about Ijara plans</h2>
            </div>
            <div class="overflow-hidden rounded-[18px] border border-litus-line bg-white">
                @foreach ($faqs as $faq)
                    <details class="group border-b border-litus-paper-3 last:border-b-0">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-[18px] px-6 py-[19px] text-[15.5px] font-semibold text-litus-text marker:content-none [&::-webkit-details-marker]:hidden group-open:text-litus-primary">
                            <span>{{ $faq['q'] }}</span>
                            <x-litus-icon name="chevron-down" class="h-4 w-4 shrink-0 transition group-open:rotate-180" />
                        </summary>
                        <div class="px-6 pb-5 text-[14.5px] leading-relaxed text-litus-text-2">
                            <p>{{ $faq['a'] }}</p>
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="litus-sec-tight bg-litus-ink text-white">
        <div class="litus-container flex flex-wrap items-center justify-between gap-7">
            <div class="max-w-[560px]">
                <h3 class="font-display text-[clamp(26px,3.4vw,40px)] font-bold tracking-[-0.028em]">Ready to find your plan?</h3>
                <p class="mt-3 text-[clamp(16.5px,1.5vw,19px)] leading-[1.66] text-white/[0.72]">
                    Our team will look at your situation and tell you which of the six plans fits — and what you will need to bring.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, I would like to check which Ijara plan fits me.') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1FA855] px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#178443]">
                    <x-litus-icon name="message-circle" class="h-4 w-4" />
                    Chat on WhatsApp
                </a>
                <a href="tel:+9607797442"
                   class="inline-flex items-center justify-center rounded-lg border-[1.5px] border-white/32 px-8 py-[17px] text-[15.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:border-white hover:bg-white/10">
                    Call 779 7442
                </a>
            </div>
        </div>
    </section>

    <x-litus-footer />

    {{-- PLAN DETAILS MODAL --}}
    <div data-plan-modal
         class="fixed inset-0 z-[70] hidden items-center justify-center p-4 sm:p-6"
         role="dialog"
         aria-modal="true"
         aria-labelledby="plan-modal-title">
        <div data-plan-drawer-backdrop class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <div data-plan-drawer
             class="relative z-[1] flex max-h-[min(90vh,760px)] w-full max-w-[560px] flex-col overflow-hidden rounded-[22px] bg-white shadow-[0_24px_80px_rgba(9,17,32,.28)]">
            <div data-drawer-header-stripe class="flex shrink-0 items-start justify-between border-b border-gray-100 px-6 pb-5 pt-6 max-md:px-4 max-md:pb-4 max-md:pt-5" style="border-top: 4px solid #1257D6">
                <div>
                    <div class="mb-1 flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[rgba(18,87,214,0.1)]">
                            <x-litus-icon name="star" data-drawer-icon class="h-[17px] w-[17px] text-litus-primary" />
                        </div>
                        <span data-drawer-badge class="text-xs font-bold uppercase tracking-widest text-litus-primary">Ijara Plan</span>
                    </div>
                    <h2 id="plan-modal-title" data-drawer-title class="font-display text-2xl font-bold text-gray-900">Plan</h2>
                    <p data-drawer-subtitle class="mt-0.5 text-sm font-semibold text-litus-primary"></p>
                </div>
                <button type="button"
                        data-plan-drawer-close
                        class="mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 transition-colors hover:bg-gray-200"
                        aria-label="Close plan details">
                    <x-litus-icon name="x" class="h-[17px] w-[17px] text-gray-600" />
                </button>
            </div>

            <div class="min-h-0 flex-1 space-y-6 overflow-y-auto px-6 py-5 max-md:space-y-5 max-md:px-4 max-md:py-4">
                <p data-drawer-desc class="text-sm leading-relaxed text-gray-600"></p>

                <div>
                    <h4 class="mb-3 text-sm font-bold uppercase tracking-wider text-gray-900">Key Benefits</h4>
                    <ul data-drawer-benefits class="space-y-2"></ul>
                </div>

                <div data-drawer-eligibility-box class="rounded-xl p-4" style="background: rgba(18,87,214,0.08)">
                    <h4 class="mb-2 text-sm font-bold uppercase tracking-wider text-gray-900">Eligibility</h4>
                    <p data-drawer-eligibility class="text-sm leading-relaxed text-gray-700"></p>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-bold uppercase tracking-wider text-gray-900">Required Documents</h4>
                    <ul data-drawer-docs class="space-y-2"></ul>
                </div>

                <div class="rounded-xl bg-gray-50 p-4">
                    <h4 class="mb-2 text-sm font-bold uppercase tracking-wider text-gray-900">Who Is It For?</h4>
                    <p data-drawer-who-for class="text-sm leading-relaxed text-gray-600"></p>
                </div>

                <div data-drawer-important-wrap class="hidden rounded-xl border border-orange-200 bg-orange-50 p-4">
                    <h4 class="mb-2 text-xs font-bold uppercase tracking-wider text-orange-800">Important Information</h4>
                    <p data-drawer-important class="text-xs leading-relaxed text-orange-700"></p>
                </div>
            </div>

            <div class="shrink-0 border-t border-gray-100 bg-white px-6 py-4 max-md:px-4 max-md:py-3.5">
                <a href="https://wa.me/9607797442?text={{ urlencode('Hi LITUS, I would like to apply for an Ijara plan.') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#25D366] py-3.5 text-sm font-black text-white transition-opacity hover:opacity-90 max-md:min-h-11 max-md:py-3">
                    <x-litus-icon name="message-circle" class="h-[17px] w-[17px]" />
                    Apply via WhatsApp
                </a>
                <p class="mt-2 text-center text-xs text-gray-400">Our team will guide you through the process.</p>
            </div>
        </div>
    </div>
</div>
@endsection
