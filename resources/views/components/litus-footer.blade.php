@php
    $quickLinks = [
        'Home' => route('home'),
        'About Us' => route('about'),
        'Motorcycles' => route('motorcycles'),
        'Ownership Plans' => '#',
        'Gallery' => '#',
    ];
    $serviceLinks = [
        'Parts' => route('parts'),
        'Service Center' => '#',
        'Application Made Easy' => '#',
        'Genuine Parts' => route('parts'),
        'Reliable Service' => '#',
    ];
    $socialLinks = ['facebook', 'instagram', 'message-circle'];
@endphp

<footer class="bg-litus-footer">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-14 sm:grid-cols-2 sm:px-6 lg:grid-cols-4">
        <div>
            <div class="mb-4 flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-sm bg-litus-red">
                    <span class="text-sm font-black text-white">L</span>
                </div>
                <div>
                    <span class="text-lg font-black text-white">LITUS</span>
                    <span class="block text-xs uppercase tracking-widest text-gray-400">Automobiles</span>
                </div>
            </div>
            <p class="mb-5 text-sm leading-relaxed text-gray-400">
                Your trusted partner for premium motorcycles, genuine parts, and reliable service across the Maldives.
            </p>
            <div class="flex gap-3">
                @foreach ($socialLinks as $social)
                    <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 text-gray-400 transition-colors hover:border-white/30 hover:text-white">
                        <x-litus-icon :name="$social" class="h-[15px] w-[15px]" />
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Quick Links</h4>
            <ul class="space-y-2">
                @foreach ($quickLinks as $label => $url)
                    <li><a href="{{ $url }}" class="text-sm text-gray-400 transition-colors hover:text-white">{{ $label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Our Services</h4>
            <ul class="space-y-2">
                @foreach ($serviceLinks as $label => $url)
                    <li><a href="{{ $url }}" class="text-sm text-gray-400 transition-colors hover:text-white">{{ $label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Contact Us</h4>
            <ul class="mb-6 space-y-3">
                <li class="flex items-start gap-2 text-sm text-gray-400">
                    <x-litus-icon name="map-pin" class="mt-0.5 h-3.5 w-3.5 shrink-0 text-litus-red" />
                    Malé, Maldives
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-400">
                    <x-litus-icon name="phone" class="h-3.5 w-3.5 text-litus-red" />
                    +960 333 1234
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-400">
                    <x-litus-icon name="mail" class="h-3.5 w-3.5 text-litus-red" />
                    info@litusautomobiles.mv
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-400">
                    <x-litus-icon name="clock" class="h-3.5 w-3.5 text-litus-red" />
                    Sun–Thu, 8:30 AM – 6:00 PM
                </li>
            </ul>

            <h4 class="mb-3 text-sm font-bold uppercase tracking-wider text-white">Stay Updated</h4>
            <form class="flex" action="#" method="post">
                @csrf
                <input type="email"
                       name="email"
                       placeholder="Your email"
                       class="flex-1 rounded-l-full border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder-gray-500 outline-none">
                <button type="submit" class="flex items-center gap-1 rounded-r-full bg-litus-red px-4 py-2 text-sm font-bold text-white">
                    <x-litus-icon name="send" class="h-[13px] w-[13px]" />
                </button>
            </form>
        </div>
    </div>

    <div class="border-t border-white/10 py-5">
        <p class="text-center text-sm text-gray-500">
            Copyright © 2025 LITUS AUTOMOBILES — All Rights Reserved.
        </p>
    </div>
</footer>
