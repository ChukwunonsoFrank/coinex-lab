 <div class="flex flex-col gap-6 pt-24 pb-4 px-4 md:px-56 lg:px-[35rem]">
     <x-auth-header :title="__('Forgot Password')" :description="__('Enter your email to receive a password reset link')" />

     <!-- Session Status -->
     <x-auth-session-status class="text-center" :status="session('status')" />

     <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-2">
         <!-- Email Address -->
         <label class="block text-xs font-normal text-[#141d22]">Your email address</label>
         <input wire:model="email" type="email"
             class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
             required placeholder="Email">

         <flux:button variant="primary" type="submit" class="w-full rounded-xs bg-accent! text-black! font-normal!">{{ __('Email Password Reset Link') }}
         </flux:button>
     </form>

     <div class="space-x-1 rtl:space-x-reverse text-center text-sm font-normal">
         {{ __('Or, return to') }}
         <flux:link class="text-accent no-underline! text-sm! font-normal!" :href="route('login')">{{ __('log in') }}</flux:link>
     </div>
 </div>
