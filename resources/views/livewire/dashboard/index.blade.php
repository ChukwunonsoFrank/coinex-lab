<div class="lg:px-0 h-full">
    <div class="md:hidden h-full">
        <div class="tradingview-widget-container mb-2">
            <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                {
                    "autosize": true,
                    "symbol": "{{ $this->activeBotTickerSymbol }}",
                    "interval": "{{ $this->chartDuration }}",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "3",
                    "locale": "en",
                    "allow_symbol_change": true,
                    "backgroundColor": "#030712",
                    "calendar": false,
                    "hide_top_toolbar": true,
                    "hide_volume": true,
                    "support_host": "https://www.tradingview.com"
                }
            </script>
        </div>
    </div>

    <div class="hidden md:block lg:hidden h-full">
        <div class="tradingview-widget-container mb-2">
            <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                {
                    "autosize": true,
                    "symbol": "{{ $this->activeBotTickerSymbol }}",
                    "interval": "{{ $this->chartDuration }}",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "3",
                    "locale": "en",
                    "allow_symbol_change": true,
                    "backgroundColor": "#030712",
                    "calendar": false,
                    "hide_top_toolbar": true,
                    "hide_volume": true,
                    "support_host": "https://www.tradingview.com"
                }
            </script>
        </div>
    </div>

    <div class="hidden lg:flex h-full">
        <livewire:dashboard.partials.desktop-navbar />

        <div class="h-full flex-1">
            <div class="tradingview-widget-container mb-2">
                <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "autosize": true,
                        "symbol": "{{ $this->activeBotTickerSymbol }}",
                        "interval": "{{ $this->chartDuration }}",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "3",
                        "locale": "en",
                        "allow_symbol_change": true,
                        "backgroundColor": "#030712",
                        "calendar": false,
                        "hide_top_toolbar": true,
                        "hide_volume": true,
                        "support_host": "https://www.tradingview.com"
                    }
                </script>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('message', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-black">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-white text-sm rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 6000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript

