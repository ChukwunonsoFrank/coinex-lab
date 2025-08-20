<div
    class="bg-dashboard border-b border-white/10 flex space-x-2 p-2 px-4 items-center md:order-1 md:flex-none md:border-none">
    <div class="flex-none">
        @if($this->activeBot)
        <img class="w-8" src="{{ asset($this->assetImageUrl) }}" alt="">
        @else
        <div class="size-8 rounded-full bg-white/10"></div>
        @endif
    </div>
    <div class="flex-none mt-1">
        <p class="text-white text-[12px] font-semibold">
            {{ $this->asset }}
        </p>
        <p class="text-zinc-300 text-[9px] md:text-[10px]">{{ ucfirst($this->assetClass) ?? 'Crypto' }}</p>
    </div>
    <div class="flex-1 text-end">
        @if ($this->isBotActive)
            <span class="flex absolute size-3 -mt-1.5 -me-1.5">
                <span class="animate-ping absolute inline-flex size-full rounded-full bg-green-600 opacity-75"></span>
                <span class="relative inline-flex rounded-full size-3 bg-green-500"></span>
            </span>
        @endif
    </div>
</div>
