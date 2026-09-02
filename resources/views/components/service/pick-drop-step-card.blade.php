@props([
    'step',
    'index',
])

<article {{ $attributes->class(['group flex h-full flex-col overflow-hidden rounded-[12px] border border-litus-line bg-white shadow-[0_1px_6px_rgba(9,17,32,0.05)] transition duration-200 md:hover:-translate-y-0.5 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_12px_28px_rgba(9,17,32,0.08)]']) }}>
    <div class="relative aspect-[2/1] overflow-hidden bg-litus-paper-3">
        <img src="{{ $step['image'] }}"
             alt="{{ $step['title'] }}"
             class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]"
             loading="lazy">
        <span class="absolute left-2 top-2 grid h-[22px] w-[22px] place-items-center rounded-full bg-litus-primary text-[11px] font-bold text-white shadow-[0_2px_8px_rgba(18,87,214,0.35)]">
            {{ $index + 1 }}
        </span>
    </div>
    <div class="flex flex-1 flex-col px-3 py-2.5">
        <div class="flex items-start gap-2">
            <div class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full bg-[rgba(18,87,214,0.09)] text-litus-primary">
                <x-litus-icon :name="$step['icon']" class="h-3 w-3" />
            </div>
            <div class="min-w-0">
                <h4 class="text-[13px] font-bold leading-snug text-litus-text">{{ $step['title'] }}</h4>
                <p class="mt-0.5 text-[11.5px] leading-snug text-litus-text-2">{{ $step['text'] }}</p>
            </div>
        </div>
    </div>
</article>
