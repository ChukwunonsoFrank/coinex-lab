<div class="flex flex-col gap-6 px-4 pt-24 pb-4 md:px-56 lg:px-[35rem]">
    <x-auth-header :title="__('Create an account')" :description="__('')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-2">
        <!-- Name -->
        <label class="block text-xs font-normal text-[#141d22]">Fullname</label>
        <input wire:model="name" type="text" class="py-3 px-4 block w-full border text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="name" required placeholder="">

        <!-- Email Address -->
        <label for="input-label" class="block text-xs font-normal text-[#141d22]">Your email address</label>
        <input wire:model="email" type="email" class="py-3 px-4 block w-full border text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="email" required placeholder="">

        <!-- Password -->
        <label class="mt-4 block text-xs font-normal text-[#141d22]">Password</label>
        <input wire:model="password" type="password" class="py-3 px-4 block w-full border text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="new-password" required placeholder="">

        <!-- Confirm Password -->
        <label class="mt-4 block text-xs font-normal text-[#141d22]">Confirm Password</label>
        <input wire:model="password_confirmation" type="password" class="py-3 px-4 block w-full border text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="new-password" required placeholder="">

        <div class="flex space-x-3 mb-3">
            <div class="flex-none">
                <input wire:model="termsAndPrivacyPolicyAccepted" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-accent checked:border-accent disabled:opacity-50 disabled:pointer-events-none" id="hs-default-checkbox">
            </div>
            <div class="flex-1">
                <p class="text-sm text-[#141d22] font-normal">I confirm that I am 18 years old or older and accept the <a class="text-accent font-normal" href="{{ route('terms') }}">Terms & Conditions</a> and <a class="text-accent font-normal" href="{{ route('privacy') }}">Privacy Policy</a></p>
            </div>
        </div>

        <div class="mt-2">
            <div wire:ignore class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}" data-callback="onRecaptchaSuccess"></div>
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full rounded-xs bg-accent! text-black! font-normal!">
                {{ __('Create Account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm font-normal text-[#141d22] mb-3">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" class="text-accent no-underline!">{{ __('Log in') }}</flux:link>
    </div>
</div>

@script
    <script>
        $wire.on('signup-error', (event) => {
            const toastMarkup = `
                <div class="flex p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-gray-700 dark:text-neutral-400">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 fixed -top-37.5 right-5 z-90 transition-all duration-300 w-80 bg-white text-sm text-gray-700 border border-gray-200 rounded-xl shadow-lg [&>.toast-close]:hidden dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
