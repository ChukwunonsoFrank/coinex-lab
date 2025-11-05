<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="my-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Make a deposit</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Amount</label>
                    <div class="relative">
                        <input wire:model="amount" type="text"
                            class="text-white border border-white/10 bg-transparent text-sm peer py-2.5 sm:py-3 px-4 ps-11 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <p class="text-white text-sm font-semibold">$</p>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Payment method</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.depositPage.togglePaymentMethodSelect()"
                            class="flex items-center space-x-3 py-2.5 sm:py-3 px-4 border border-white/10 bg-transparent rounded-lg text-[#FFFFFF]">
                            <div class="flex-none">
                                <img src="{{ asset('storage/' . $this->paymentMethod['icon_url']) }}">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">{{ $this->paymentMethod['name'] }}</p>
                            </div>
                            <div class="flex-none justify-self-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div x-cloak x-show="$store.depositPage.isPaymentMethodSelectOpen"
                            @click.outside="$store.depositPage.isPaymentMethodSelectOpen = false"
                            class="border border-white/10 bg-dashboard absolute rounded-lg w-full overflow-scroll scrollbar-hide z-10 p-2 mt-1">
                            @foreach ($this->paymentMethods as $method)
                                <div wire:key="payment-method-{{ $method['id'] }}"
                                    wire:click="selectPaymentMethod({{ $method['id'] }})"
                                    x-on:click="$store.depositPage.isPaymentMethodSelectOpen = false"
                                    class="hover:bg-white/10 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-md text-[#FFFFFF]">
                                    <div class="flex-none">
                                        <img src="{{ asset('storage/' . $method['icon_url']) }}">
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm">{{ $method['name'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div>
                    <a wire:click="confirmDeposit()">
                        <button type="button" wire:loading.attr="disabled"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Proceed</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('depositPage', {
            isPaymentMethodSelectOpen: false,

            togglePaymentMethodSelect() {
                this.isPaymentMethodSelectOpen = !this.isPaymentMethodSelectOpen
            }
        })
    })
</script>

@script
    <script>
        $wire.on('deposit-error', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-alert-icon lucide-shield-alert"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-black">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-white text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
