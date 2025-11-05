<div class="flex flex-col gap-6">
    <div class="flex w-full flex-col text-start">
        <flux:heading class="font-semibold font-condensed text-3xl tracking-tight text-white" size="xl">
            Reset password</flux:heading>
        <flux:subheading class="text-sm text-white font-normal">Please enter your new password below</flux:subheading>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="resetPassword" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" :placeholder="__('Email address')" />

        <!-- Password -->
        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password"
            :placeholder="__('Password')" />

        <!-- Confirm Password -->
        <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password" required
            autocomplete="new-password" :placeholder="__('Confirm password')" />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Reset password') }}
            </flux:button>
        </div>
    </form>
</div>
