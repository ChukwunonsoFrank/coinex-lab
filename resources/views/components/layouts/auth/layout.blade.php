<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coinex Lab - Automate Trading With AI</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/7016607b5a.js" crossorigin="anonymous"></script>
    <script async src="https://www.google.com/recaptcha/api.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onRecaptchaSuccess(token) {
            // When reCAPTCHA is successfully completed, send the token to Livewire
            Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).set('gRecaptchaResponse', token);
        }
    </script>
    
    @livewireStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script src="//code.jivosite.com/widget/haRE265EfB" async></script>
</head>

<body>
    <div class="min-h-full relative">
        <nav x-data="{ isMobileMenuOpen: false }" class="bg-white fixed w-full top-0 z-10">
            <div class="mx-auto px-4 lg:px-6">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center space-x-2">
                            <a href="{{ route('home') }}">
                                <img class="w-32" src="{{ asset('assets/logo.png') }}" alt="Coinex logo">
                            </a>
                        </div>
                        <div class="hidden lg:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="/#features"
                                    class="rounded-md px-3 py-2 text-md font-normal text-black">Features</a>
                                <a href="/#how-to-trade"
                                    class="rounded-md px-3 py-2 text-md font-normal text-black">How to trade</a>
                                <a href="/#faqs"
                                    class="rounded-md px-3 py-2 text-md font-normal text-black">FAQs</a>
                                <a href="{{ route('terms') }}"
                                    class="rounded-md px-3 py-2 text-md font-normal text-black">Terms</a>
                                <a href="{{ route('privacy') }}"
                                    class="rounded-md px-3 py-2 text-md font-normal text-black">Privacy</a>
                            </div>
                        </div>
                    </div>

                    <div class="hidden lg:block">
                        <div class="ml-4 flex space-x-4 items-center md:ml-6">
                            <div>
                                <div class="language-select language-select--style ">
                                    <div class="gtranslate_wrapper"></div>
                                </div>
                            </div>
                            <a href="{{ route('register') }}"
                                class="rounded-xs bg-accent px-3.5 py-2.5 text-sm font-medium text-black shadow-xs">Register</a>
                            <a href="{{ route('login') }}"
                                class="rounded-xs px-3.5 py-2.5 text-sm font-medium bg-[#6c859514] text-[#141d22] shadow-xs">Login</a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6 lg:hidden">
                        <div>
                            <div class="language-select language-select--style">
                                <div class="gtranslate_wrapper mb-0.5"></div>
                            </div>
                        </div>
                        <a href="{{ route('login') }}">
                            <div>
                                <p class="text-[15px]">Login</p>
                            </div>
                        </a>
                        <!-- Mobile menu button -->
                        <button class="lg:hidden" type="button" x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
                            class="relative inline-flex items-center justify-center" aria-controls="mobile-menu"
                            aria-expanded="false">
                            {{-- <span class="absolute -inset-0.5"></span> --}}
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block size-6"
                                :class="{ 'hidden': isMobileMenuOpen, 'block': !isMobileMenuOpen }" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden size-6"
                                :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div x-cloak x-show="isMobileMenuOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" class="lg:hidden h-screen" id="mobile-menu">
                <div class="space-y-1 px-4 pt-2 pb-3 sm:px-3">
                    <div>
                        <a href="/#features" x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
                            class="inline-flex gap-x-3 items-center py-3 text-base text-black" aria-current="page">
                            Features
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mt-0.5 lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="/#how-to-trade" x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
                            class="inline-flex gap-x-3 items-center py-3 text-base text-black" aria-current="page">
                            How to trade
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mt-0.5 lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="/#faqs" x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
                            class="inline-flex gap-x-3 items-center py-3 text-base text-black" aria-current="page">
                            FAQs
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mt-0.5 lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('terms') }}"
                            class="inline-flex gap-x-3 items-center py-3 text-base text-black" aria-current="page">
                            Terms and
                            Conditions
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mt-0.5 lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>
                    <div class="border-b-1 pb-4">
                        <a href="{{ route('privacy') }}"
                            class="inline-flex gap-x-3 items-center py-3 text-base text-black">
                            Privacy
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="mt-0.5 lucide lucide-chevron-right-icon lucide-chevron-right">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>

                    <div class="flex items-center mt-8 space-x-4 justify-center">
                        <div>
                            <a href="{{ route('register') }}"
                                class="px-6 py-3 text-base font-semibold rounded-sm bg-[#00bcff] text-black">Register</a>
                        </div>
                        <div>
                            <a href="{{ route('login') }}"
                                class="px-6 py-3 text-base font-semibold rounded-sm bg-[#6c859514] text-[#141d22]">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <footer class="px-4 md:px-14 mt-12 pb-8">
            <div class="border-y pb-12 border-t-[#141d221f]">
                <div class="mt-12">
                    <a href="{{ route('home') }}">
                        <img class="w-32" src="{{ asset('assets/logo.png') }}" alt="Coinex logo">
                    </a>
                </div>

                <div class="text-start">
                    <h4 class="font-condensed mt-4 text-black text-sm leading-8 font-medium">Company
                    </h4>
                    <div>
                        <a class="text-[13px] text-[#141d2299]" href="#">Terms & Conditions</a>
                    </div>
                    <div>
                        <a class="text-[13px] text-[#141d2299]" href="#">Privacy Policy</a>
                    </div>
                </div>

                <div class="mt-8">
                    <p class="text-[13px] text-[#141d2299]">Risk Warning: Our services relate to complex derivative
                        products which are traded outside an exchange. These products come with a high risk of losing
                        money rapidly due to leverage and thus are not appropriate for all investors. Under no
                        circumstances shall Coinex have any liability to any person or entity for any loss or damage in
                        whole or part caused by, resulting from, or relating to any investing activity. </p>

                    <p class="text-[13px] text-[#141d2299] mt-4">**By using this app you will have access to information of
                        a general nature (i.e., that does not
                        address the circumstances of any particular individual). If you require further information, or
                        otherwise a more comprehensive or complete statement of the related matters and regulations, you
                        should
                        seek the advice of a lawyer, your brokerage firm, or from a licensed financial service provider
                        before
                        you start trading</p>
                </div>
            </div>

            <div class="mt-6">
                <img src="{{ asset('assets/images/PCI_DSS_color.svg') }}" alt="" srcset="">
            </div>

            <div class="mt-4">
                <p class="text-[13px] text-[#141d2299]" href="#">&copy; {{ now()->year }} Coinex</p>
            </div>
        </footer>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        window.gtranslateSettings = {
            "default_language": "en",
            "detect_browser_language": true,
            "wrapper_selector": ".gtranslate_wrapper",
            "flag_size": 24,
            "flag_style": "3d"
        }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/popup.js" defer></script>
    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Select all elements with class 'gt_switcher-popup'
            document.querySelectorAll('.gt_switcher-popup').forEach(function(el) {
                // Find all span children and hide them
                el.querySelectorAll('span').forEach(function(span) {
                    span.style.display = 'none';
                });
            });
        });
    </script>
    @livewireScripts
    @vite('resources/js/app.js')
</body>

</html>
