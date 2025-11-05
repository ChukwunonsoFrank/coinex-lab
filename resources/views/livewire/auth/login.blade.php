<div class="flex flex-col gap-6 pt-24 pb-4 px-4 md:px-56 lg:px-[35rem]">
    <x-auth-header :title="__('Sign in to Coinex Lab')" :description="__('')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-2">
        <!-- Email Address -->
        <label class="block text-xs font-normal text-[#141d22]">Your email address</label>
        <input wire:model="email" type="email"
            class="py-3 px-4 block w-full border text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
            autocomplete="email" required placeholder="">

        <!-- Password -->
        <label class="mt-4 block text-xs font-normal text-[#141d22]">Password</label>
        <input wire:model="password" type="password"
            class="py-3 px-4 block w-full border text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
            autocomplete="current-password" required placeholder="">

        <div class="mt-2">
            <div wire:ignore class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"
                data-callback="onRecaptchaSuccess"></div>
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit"
                class="w-full rounded-xs bg-accent! text-black! font-normal!">{{ __('Continue') }}</flux:button>
        </div>
    </form>


    @if (Route::has('password.request'))
        <div class="space-x-1 rtl:space-x-reverse text-center">
            <flux:link class="text-accent no-underline! text-sm! font-normal!" :href="route('password.request')">
                {{ __('I forgot my password') }}</flux:link>
        </div>
    @endif

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-700 font-normal mb-3">
            {{ __('Don\'t have an account?') }}
            <flux:link class="text-accent font-normal! no-underline!" :href="route('register')">{{ __('Sign Up') }}
            </flux:link>
        </div>
    @endif
</div>

@script
    <script>
        $wire.on('login-error', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-alert-icon lucide-shield-alert"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white" style="margin-bottom: 0 !important;">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 z-100 absolute top-0 start-1/2 -translate-x-1/2 z-50 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-[#26252a] text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 5000,
                close: false,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
