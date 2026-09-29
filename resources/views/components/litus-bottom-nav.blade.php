@php
    $tabs = [
        ['label' => 'Home', 'icon' => 'home', 'url' => route('home'), 'match' => 'home'],
        ['label' => 'Bikes', 'icon' => 'bike', 'url' => route('motorcycles'), 'match' => 'motorcycles*'],
        ['label' => 'Offers', 'icon' => 'zap', 'url' => route('promotions'), 'match' => 'promotions*'],
        ['label' => 'Ijara', 'icon' => 'credit-card', 'url' => route('ownership-plans'), 'match' => 'ownership-plans*'],
        ['label' => 'Contact', 'icon' => 'message-circle', 'url' => route('contact'), 'match' => 'contact*'],
    ];
@endphp

<nav class="fixed inset-x-3 bottom-[calc(0.75rem+env(safe-area-inset-bottom))] z-[70] mx-auto max-w-[420px] rounded-[26px] border border-white/40 bg-white/45 shadow-[0_1px_0_0_rgba(255,255,255,0.7)_inset,0_1px_16px_0_rgba(255,255,255,0.25)_inset,0_12px_32px_rgba(9,17,32,0.18)] ring-1 ring-inset ring-white/30 backdrop-blur-2xl backdrop-saturate-[1.8] xl:hidden"
     data-litus-bottom-nav
     aria-label="Primary">
    <div class="flex items-stretch justify-between px-1 py-1.5">
        @foreach ($tabs as $tab)
            @php $isActive = request()->routeIs($tab['match']); @endphp
            <a href="{{ $tab['url'] }}"
               @class([
                   'flex flex-1 flex-col items-center justify-center gap-1 rounded-[20px] py-2 text-[10.5px] font-semibold tracking-[0.01em] transition-colors duration-150',
                   'text-litus-primary' => $isActive,
                   'text-litus-text-3 hover:text-litus-text-2' => ! $isActive,
               ])
               @if ($isActive) aria-current="page" @endif>
                <x-litus-icon :name="$tab['icon']" class="h-5 w-5" />
                {{ $tab['label'] }}
            </a>
        @endforeach
    </div>
</nav>
