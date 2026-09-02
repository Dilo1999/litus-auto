@props([
    'step',
    'index',
])

<article {{ $attributes->class(['group flex h-full flex-col overflow-hidden rounded-[14px] border border-litus-line bg-white shadow-[0_2px_8px_rgba(9,17,32,0.05)] transition duration-200 md:hover:-translate-y-1 md:hover:border-litus-line-2 md:hover:shadow-[0_2px_6px_rgba(9,17,32,0.06),0_18px_42px_rgba(9,17,32,0.10)]']) }}>
    <div class="relative aspect-[16/10] overflow-hidden bg-litus-paper-3">
        <img src="{{ $step['image'] }}"
             alt="{{ $step['title'] }}"
             class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
             loading="lazy">
        <span class="absolute left-2.5 top-2.5 grid h-[26px] w-[26px] place-items-center rounded-full bg-litus-primary text-[12px] font-bold text-white shadow-[0_4px_12px_rgba(18,87,214,0.35)]">
            {{ $index + 1 }}
        </span>
    </div>
    <div class="flex flex-1 flex-col px-3.5 pb-3.5 pt-3 sm:px-4 sm:pb-4 sm:pt-3.5">
        <div class="mb-2 grid h-7 w-7 place-items-center rounded-full bg-[rgba(18,87,214,0.09)] text-litus-primary">
            <x-litus-icon :name="$step['icon']" class="h-3.5 w-3.5" />
        </div>
        <h4 class="mb-1 text-[14px] font-bold leading-snug text-litus-text">{{ $step['title'] }}</h4>
        <p class="text-[12.5px] leading-relaxed text-litus-text-2">{{ $step['text'] }}</p>
    </div>
</article>
