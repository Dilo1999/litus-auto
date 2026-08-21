<x-filament::page>
    <x-filament::card class="max-w-2xl">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-2">
                <h2 class="text-base font-semibold text-gray-950 dark:text-white">
                    Maintenance mode
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    When enabled, all public website pages are replaced with a maintenance screen.
                    The admin panel stays available so you can manage content and turn maintenance off again.
                </p>
            </div>

            <div class="flex shrink-0 items-center gap-3">
                <span @class([
                    'text-sm font-semibold',
                    'text-danger-600' => $maintenanceEnabled,
                    'text-success-600' => ! $maintenanceEnabled,
                ])>
                    {{ $maintenanceEnabled ? 'On' : 'Off' }}
                </span>

                <button type="button"
                        role="switch"
                        aria-checked="{{ $maintenanceEnabled ? 'true' : 'false' }}"
                        aria-label="Toggle maintenance mode"
                        wire:click="$toggle('maintenanceEnabled')"
                        @class([
                            'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2',
                            'bg-primary-600' => $maintenanceEnabled,
                            'bg-gray-200 dark:bg-gray-700' => ! $maintenanceEnabled,
                        ])>
                    <span @class([
                        'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200',
                        'translate-x-5' => $maintenanceEnabled,
                        'translate-x-0' => ! $maintenanceEnabled,
                    ])></span>
                </button>
            </div>
        </div>
    </x-filament::card>
</x-filament::page>
