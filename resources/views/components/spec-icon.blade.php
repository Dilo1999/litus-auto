@props(['icon', 'iconUrl' => null])

@if ($iconUrl)
    <img src="{{ $iconUrl }}"
         alt=""
         {{ $attributes->merge(['class' => 'shrink-0 object-contain']) }}
         aria-hidden="true">
@else
    <x-litus-icon :name="$icon" {{ $attributes }} />
@endif
