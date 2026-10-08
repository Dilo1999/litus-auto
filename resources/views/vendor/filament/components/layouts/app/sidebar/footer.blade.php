@php
    $user = \Filament\Facades\Filament::auth()->user();
    $name = $user ? \Filament\Facades\Filament::getUserName($user) : null;
    $initials = collect(preg_split('/\s+/', trim((string) $name)))
        ->filter()
        ->map(fn (string $part) => mb_substr($part, 0, 1))
        ->take(2)
        ->implode('');
    $role = $user?->role ? str($user->role)->replace('superadmin', 'super admin')->title() : null;
@endphp

@if ($user)
    <div class="ad-side-user">
        <span class="ad-side-user-avatar" aria-hidden="true">{{ mb_strtoupper($initials ?: 'A') }}</span>
        <div class="ad-side-user-text">
            <span class="ad-side-user-name">{{ $name }}</span>
            @if ($role)
                <span class="ad-side-user-role">{{ $role }}</span>
            @endif
        </div>
        <form action="{{ route('filament.auth.logout') }}" method="post">
            @csrf
            <button type="submit" class="ad-side-user-out" aria-label="Sign out" title="Sign out">
                <x-heroicon-o-logout class="h-5 w-5" aria-hidden="true" />
            </button>
        </form>
    </div>
@endif
