<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">

            <div class="flex items-center mb-3 mt-4 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <div class="flex-1">
                    <h1 class="text-white text-lg md:text-xl lg:text-2xl font-bold tracking-[0.15px]">Robot Settings
                    </h1>
                </div>
            </div>

            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Amount</label>
                    <div class="relative">
                        <input wire:model="amount" type="text"
                            class="bg-transparent text-white border border-white/10 text-sm peer py-2.5 sm:py-3 px-4 ps-11 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <p class="text-white text-sm font-semibold">$</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Account</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.robotPage.toggleTradingAccountSelect()"
                            class="flex items-center space-x-3 py-2.5 sm:py-3 px-4 border border-white/10 bg-brand rounded-lg text-[#FFFFFF]">
                            <div class="flex-1">
                                <p x-text="$wire.accountType" class="text-sm"></p>
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

                    <div class="relative z-100">
                        <div x-cloak x-show="$store.robotPage.isTradingAccountSelectOpen"
                            @click.outside="$store.robotPage.isTradingAccountSelectOpen = false"
                            class="border border-white/10 bg-dashboard absolute rounded-lg w-full overflow-scroll scrollbar-hide p-2 mt-1">
                            <div wire:click="selectAccountType('Demo account', 'demo')"
                                x-on:click="$store.robotPage.isTradingAccountSelectOpen = false"
                                class="hover:bg-white/10 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-lg text-[#FFFFFF]">
                                <div class="flex-1">
                                    <p class="text-sm">Demo Account</p>
                                </div>
                                <div class="flex-none">
                                    <svg x-show="$wire.accountTypeSlug === 'demo'" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_652_45)">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.99967 1.33331C11.6815 1.33331 14.6663 4.31808 14.6663 7.99998C14.6663 11.6818 11.6815 14.6666 7.99967 14.6666C4.31777 14.6666 1.33301 11.6818 1.33301 7.99998C1.33301 4.31808 4.31777 1.33331 7.99967 1.33331ZM7.99967 2.66665C5.05415 2.66665 2.66634 5.05446 2.66634 7.99998C2.66634 10.9455 5.05415 13.3333 7.99967 13.3333C10.9452 13.3333 13.333 10.9455 13.333 7.99998C13.333 5.05446 10.9452 2.66665 7.99967 2.66665ZM7.99967 5.33331C9.47241 5.33331 10.6663 6.52722 10.6663 7.99998C10.6663 9.47271 9.47241 10.6666 7.99967 10.6666C6.52691 10.6666 5.33301 9.47271 5.33301 7.99998C5.33301 6.52722 6.52691 5.33331 7.99967 5.33331ZM7.99967 6.66665C7.26327 6.66665 6.66634 7.26358 6.66634 7.99998C6.66634 8.73638 7.26327 9.33331 7.99967 9.33331C8.73607 9.33331 9.33301 8.73638 9.33301 7.99998C9.33301 7.26358 8.73607 6.66665 7.99967 6.66665Z"
                                                fill="#00A63E" />
                                            <circle cx="8" cy="8" r="4.2" stroke="#00A63E"
                                                stroke-width="3.6" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_652_45">
                                                <rect width="16" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <div wire:click="selectAccountType('Live account', 'live')"
                                x-on:click="$store.robotPage.isTradingAccountSelectOpen = false"
                                class="hover:bg-white/10 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-lg text-[#FFFFFF]">
                                <div class="flex-1">
                                    <p class="text-sm">Live Account</p>
                                </div>
                                <div class="flex-none">
                                    <svg x-show="$wire.accountTypeSlug === 'live'" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_652_45)">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.99967 1.33331C11.6815 1.33331 14.6663 4.31808 14.6663 7.99998C14.6663 11.6818 11.6815 14.6666 7.99967 14.6666C4.31777 14.6666 1.33301 11.6818 1.33301 7.99998C1.33301 4.31808 4.31777 1.33331 7.99967 1.33331ZM7.99967 2.66665C5.05415 2.66665 2.66634 5.05446 2.66634 7.99998C2.66634 10.9455 5.05415 13.3333 7.99967 13.3333C10.9452 13.3333 13.333 10.9455 13.333 7.99998C13.333 5.05446 10.9452 2.66665 7.99967 2.66665ZM7.99967 5.33331C9.47241 5.33331 10.6663 6.52722 10.6663 7.99998C10.6663 9.47271 9.47241 10.6666 7.99967 10.6666C6.52691 10.6666 5.33301 9.47271 5.33301 7.99998C5.33301 6.52722 6.52691 5.33331 7.99967 5.33331ZM7.99967 6.66665C7.26327 6.66665 6.66634 7.26358 6.66634 7.99998C6.66634 8.73638 7.26327 9.33331 7.99967 9.33331C8.73607 9.33331 9.33301 8.73638 9.33301 7.99998C9.33301 7.26358 8.73607 6.66665 7.99967 6.66665Z"
                                                fill="#00A63E" />
                                            <circle cx="8" cy="8" r="4.2" stroke="#00A63E"
                                                stroke-width="3.6" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_652_45">
                                                <rect width="16" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex items-center space-x-2">
                    <div class="flex-1">
                        <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Duration</label>
                        <input type="text" value="{{ $this->strategy['duration'] }} hrs"
                            class="border border-white/10 bg-transparent text-white text-start text-sm py-2.5 sm:py-3 px-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="" readonly>
                    </div>
                    <div class="flex-1">
                        <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Exchange</label>
                        <div
                            class="w-full text-sm self-center text-center border border-white/10 bg-transparent py-2.5 sm:py-3 px-4 rounded-lg text-[#FFFFFF] focus:outline-0">
                            <img class="inline" src="{{ asset('assets/icons/cryptodotcom.svg') }}"
                                alt="cryptodotcom-logo">
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Broker</label>
                        <div
                            class="border border-white/10 bg-transparent w-full text-sm self-center text-center py-2.5 sm:py-3 px-4 rounded-lg text-[#FFFFFF] focus:outline-0">
                            <img class="inline" src="{{ asset('assets/icons/fxpro.svg') }}" alt="oanda-logo">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Strategy</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.robotPage.toggleStrategyListOverlay()"
                            class="flex items-start space-x-2 border border-white/10 bg-transparent px-4 py-4 rounded-lg text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="{{ asset('storage/' . $this->strategy['image_url']) }}"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    {{ $this->strategy['name'] }}
                                </h2>

                                <div>
                                    <div class="flex items-center gap-x-1">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_651_35)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.00003 1.33331C8.16332 1.33333 8.32092 1.39328 8.44295 1.50179C8.56497 1.6103 8.64293 1.75981 8.66203 1.92198L8.6667 1.99998V3.44665C8.98752 3.56004 9.27411 3.75339 9.49938 4.00841C9.72466 4.26343 9.88117 4.57169 9.95411 4.90405C10.0271 5.23641 10.014 5.58188 9.91626 5.9078C9.81849 6.23372 9.63921 6.52932 9.39537 6.76665L9.29937 6.85398L10.522 10.034C11.0693 9.73941 11.561 9.35185 11.9754 8.88865C12.0335 8.82249 12.1042 8.76851 12.1833 8.72982C12.2624 8.69113 12.3484 8.6685 12.4363 8.66323C12.5242 8.65797 12.6123 8.67017 12.6955 8.69914C12.7786 8.72811 12.8552 8.77328 12.9208 8.83202C12.9865 8.89076 13.0398 8.96192 13.0777 9.04139C13.1157 9.12086 13.1375 9.20707 13.142 9.29502C13.1464 9.38298 13.1334 9.47094 13.1037 9.55384C13.0739 9.63673 13.028 9.71291 12.9687 9.77798C12.4758 10.3288 11.895 10.7943 11.25 11.1553L11.0034 11.2866L11.9554 13.7606C12.0155 13.9192 12.0129 14.0946 11.9483 14.2513C11.8836 14.4081 11.7616 14.5343 11.6072 14.6042C11.4528 14.6742 11.2775 14.6828 11.1171 14.6281C10.9566 14.5734 10.823 14.4597 10.7434 14.31L10.7114 14.2393L9.75937 11.7653C9.19937 11.9186 8.60937 12 8.00003 12C7.4787 12 6.9707 11.94 6.4827 11.8266L6.2407 11.7653L5.2887 14.2393C5.22754 14.3979 5.1081 14.5272 4.9548 14.6007C4.80151 14.6741 4.62593 14.6863 4.46398 14.6346C4.30203 14.5829 4.16594 14.4713 4.08355 14.3226C4.00115 14.1739 3.97867 13.9994 4.0207 13.8346L4.0447 13.7606L6.7007 6.85398C6.44157 6.63271 6.24327 6.34891 6.12461 6.02949C6.00595 5.71007 5.97087 5.36563 6.02269 5.02885C6.07451 4.69206 6.21152 4.37411 6.42072 4.10514C6.62992 3.83617 6.90437 3.62511 7.21803 3.49198L7.33337 3.44665V1.99998C7.33337 1.82317 7.4036 1.6536 7.52863 1.52858C7.65365 1.40355 7.82322 1.33331 8.00003 1.33331ZM9.27803 10.5133L8.0547 7.33265L8.00003 7.33331L7.94537 7.33265L6.72203 10.5126C7.14028 10.6153 7.56939 10.667 8.00003 10.6666C8.44003 10.6666 8.8687 10.6133 9.27803 10.5133ZM8.00003 4.66665C7.82322 4.66665 7.65365 4.73688 7.52863 4.86191C7.4036 4.98693 7.33337 5.1565 7.33337 5.33331C7.33337 5.51012 7.4036 5.67969 7.52863 5.80472C7.65365 5.92974 7.82322 5.99998 8.00003 5.99998C8.17684 5.99998 8.34641 5.92974 8.47144 5.80472C8.59646 5.67969 8.6667 5.51012 8.6667 5.33331C8.6667 5.1565 8.59646 4.98693 8.47144 4.86191C8.34641 4.73688 8.17684 4.66665 8.00003 4.66665Z"
                                                    fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_651_35">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="text-[10px] text-zinc-300">
                                            Profit Range: <span>{{ $this->strategy['min_roi'] }}</span>%
                                            to <span>{{ $this->strategy['max_roi'] }}</span>%
                                            in <span>{{ $this->strategy['duration'] }}</span>hrs
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-1">
                                    <div class="flex items-center gap-x-1">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_652_40)">
                                                <path
                                                    d="M2.47503 7.44201L4.26037 8.64467C4.93103 9.09667 4.48303 10.1427 3.6937 9.96934L2.98437 9.81334C3.34456 10.8099 3.9934 11.6766 4.84813 12.303C5.70286 12.9293 6.72477 13.2869 7.78355 13.3302C8.84233 13.3735 9.89001 13.1004 10.793 12.5459C11.696 11.9914 12.4134 11.1805 12.8537 10.2167C12.9294 10.0598 13.0635 9.9387 13.2273 9.87941C13.3911 9.82013 13.5717 9.82733 13.7302 9.89948C13.8888 9.97162 14.0129 10.103 14.0758 10.2654C14.1387 10.4279 14.1356 10.6085 14.067 10.7687C12.7424 13.682 9.4697 15.2973 6.2757 14.4413C4.86652 14.0638 3.62002 13.2346 2.72726 12.0807C1.8345 10.9269 1.34473 9.51217 1.33303 8.05334C1.32837 7.45134 1.99703 7.11867 2.47503 7.44134M7.9997 4.00001C8.16299 4.00003 8.32059 4.05998 8.44261 4.16848C8.56464 4.27699 8.64259 4.42651 8.6617 4.58867L8.66637 4.66667V5.33334H9.9997C10.1696 5.33353 10.3331 5.39859 10.4566 5.51524C10.5802 5.63189 10.6545 5.79131 10.6645 5.96094C10.6744 6.13056 10.6192 6.29759 10.5102 6.4279C10.4011 6.5582 10.2464 6.64194 10.0777 6.66201L9.9997 6.66667H6.66637C6.58307 6.66652 6.50273 6.69756 6.44118 6.75368C6.37962 6.8098 6.34131 6.88693 6.33378 6.96989C6.32626 7.05284 6.35006 7.13561 6.40051 7.20189C6.45096 7.26818 6.5244 7.31317 6.60637 7.32801L6.66637 7.33334H9.33303C9.76629 7.33229 10.1829 7.49999 10.4946 7.8009C10.8064 8.10181 10.9886 8.51228 11.0029 8.94531C11.0171 9.37834 10.8621 9.79988 10.5708 10.1206C10.2795 10.4413 9.87476 10.636 9.44237 10.6633L9.33303 10.6667H8.66637V11.3333C8.66618 11.5033 8.60111 11.6667 8.48447 11.7903C8.36782 11.9138 8.2084 11.9882 8.03877 11.9981C7.86914 12.0081 7.70211 11.9529 7.57181 11.8438C7.44151 11.7348 7.35777 11.5801 7.3377 11.4113L7.33303 11.3333V10.6667H5.9997C5.82978 10.6665 5.66634 10.6014 5.54279 10.4848C5.41923 10.3681 5.34488 10.2087 5.33492 10.0391C5.32496 9.86945 5.38015 9.70242 5.48921 9.57212C5.59827 9.44182 5.75297 9.35808 5.9217 9.33801L5.9997 9.33334H9.33303C9.41633 9.33349 9.49667 9.30245 9.55822 9.24633C9.61978 9.19022 9.65809 9.11308 9.66562 9.03013C9.67314 8.94717 9.64934 8.8644 9.59889 8.79812C9.54844 8.73184 9.475 8.68685 9.39303 8.67201L9.33303 8.66667H6.66637C6.23311 8.66773 5.81647 8.50003 5.50476 8.19911C5.19304 7.8982 5.01076 7.48773 4.99654 7.0547C4.98232 6.62168 5.13729 6.20014 5.42859 5.87942C5.7199 5.55871 6.12464 5.36404 6.55703 5.33667L6.66637 5.33334H7.33303V4.66667C7.33303 4.48986 7.40327 4.32029 7.52829 4.19527C7.65332 4.07024 7.82289 4.00001 7.9997 4.00001ZM9.72637 1.56201C11.1355 1.93942 12.382 2.76853 13.2747 3.92224C14.1675 5.07594 14.6573 6.49059 14.669 7.94934C14.6737 8.55134 14.0057 8.88401 13.5277 8.56134L11.7424 7.35867C11.071 6.90667 11.519 5.86067 12.309 6.03401L13.0177 6.19001C12.6575 5.19344 12.0087 4.32672 11.1539 3.70037C10.2992 3.07402 9.2773 2.71641 8.21852 2.67314C7.15974 2.62987 6.11206 2.9029 5.20906 3.45742C4.30607 4.01194 3.58868 4.82282 3.14837 5.78667C3.11341 5.86831 3.0625 5.94215 2.99862 6.00384C2.93474 6.06553 2.85918 6.11384 2.77637 6.14593C2.69356 6.17801 2.60518 6.19323 2.51641 6.19069C2.42763 6.18815 2.34027 6.16789 2.25943 6.13112C2.1786 6.09434 2.10592 6.04179 2.04568 5.97654C1.98544 5.91129 1.93884 5.83466 1.90862 5.75115C1.8784 5.66764 1.86517 5.57894 1.8697 5.49025C1.87424 5.40155 1.89645 5.31466 1.93503 5.23467C3.2597 2.32134 6.53303 0.706673 9.72637 1.56201Z"
                                                    fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_652_40">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <p class="text-[10px] text-zinc-300">
                                            Minimum Amount: At
                                            least $<span>{{ $this->strategy['min_amount'] }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-none w-4 justify-self-end">
                                <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="14" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-cloak x-show="$store.robotPage.isStrategyListOverlayOpen"
                    class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 pb-16 overflow-scroll scrollbar-hide z-20 bg-dashboard">
                    <div class="flex items-center mb-6">
                        <div class="flex-1">
                            <h2 class="text-white font-semibold md:text-xl lg:text-2xl">Strategy</h2>
                        </div>
                        <div class="flex-1 text-end">
                            <svg x-on:click="$store.robotPage.toggleStrategyListOverlay()"
                                class="inline cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        @foreach ($this->strategies as $strategy)
                            <div wire:key="strategy-{{ $strategy['id'] }}"
                                wire:click="selectStrategy({{ $strategy['id'] }})"
                                x-on:click="$store.robotPage.isStrategyListOverlayOpen = false"
                                class="flex items-start space-x-2 border border-white/10 bg-transparent mb-3 px-4 py-4 rounded-lg text-[#FFFFFF] cursor-pointer">
                                <div class="flex-none w-12">
                                    <img class="w-24" src="{{ asset('storage/' . $strategy['image_url']) }}"
                                        alt="">
                                </div>
                                <div class="flex-1">
                                    <h2 class="font-bold mb-1">
                                        {{ $strategy['name'] }}
                                    </h2>

                                    <div>
                                        <div class="flex items-center gap-x-1">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_651_35)">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.00003 1.33331C8.16332 1.33333 8.32092 1.39328 8.44295 1.50179C8.56497 1.6103 8.64293 1.75981 8.66203 1.92198L8.6667 1.99998V3.44665C8.98752 3.56004 9.27411 3.75339 9.49938 4.00841C9.72466 4.26343 9.88117 4.57169 9.95411 4.90405C10.0271 5.23641 10.014 5.58188 9.91626 5.9078C9.81849 6.23372 9.63921 6.52932 9.39537 6.76665L9.29937 6.85398L10.522 10.034C11.0693 9.73941 11.561 9.35185 11.9754 8.88865C12.0335 8.82249 12.1042 8.76851 12.1833 8.72982C12.2624 8.69113 12.3484 8.6685 12.4363 8.66323C12.5242 8.65797 12.6123 8.67017 12.6955 8.69914C12.7786 8.72811 12.8552 8.77328 12.9208 8.83202C12.9865 8.89076 13.0398 8.96192 13.0777 9.04139C13.1157 9.12086 13.1375 9.20707 13.142 9.29502C13.1464 9.38298 13.1334 9.47094 13.1037 9.55384C13.0739 9.63673 13.028 9.71291 12.9687 9.77798C12.4758 10.3288 11.895 10.7943 11.25 11.1553L11.0034 11.2866L11.9554 13.7606C12.0155 13.9192 12.0129 14.0946 11.9483 14.2513C11.8836 14.4081 11.7616 14.5343 11.6072 14.6042C11.4528 14.6742 11.2775 14.6828 11.1171 14.6281C10.9566 14.5734 10.823 14.4597 10.7434 14.31L10.7114 14.2393L9.75937 11.7653C9.19937 11.9186 8.60937 12 8.00003 12C7.4787 12 6.9707 11.94 6.4827 11.8266L6.2407 11.7653L5.2887 14.2393C5.22754 14.3979 5.1081 14.5272 4.9548 14.6007C4.80151 14.6741 4.62593 14.6863 4.46398 14.6346C4.30203 14.5829 4.16594 14.4713 4.08355 14.3226C4.00115 14.1739 3.97867 13.9994 4.0207 13.8346L4.0447 13.7606L6.7007 6.85398C6.44157 6.63271 6.24327 6.34891 6.12461 6.02949C6.00595 5.71007 5.97087 5.36563 6.02269 5.02885C6.07451 4.69206 6.21152 4.37411 6.42072 4.10514C6.62992 3.83617 6.90437 3.62511 7.21803 3.49198L7.33337 3.44665V1.99998C7.33337 1.82317 7.4036 1.6536 7.52863 1.52858C7.65365 1.40355 7.82322 1.33331 8.00003 1.33331ZM9.27803 10.5133L8.0547 7.33265L8.00003 7.33331L7.94537 7.33265L6.72203 10.5126C7.14028 10.6153 7.56939 10.667 8.00003 10.6666C8.44003 10.6666 8.8687 10.6133 9.27803 10.5133ZM8.00003 4.66665C7.82322 4.66665 7.65365 4.73688 7.52863 4.86191C7.4036 4.98693 7.33337 5.1565 7.33337 5.33331C7.33337 5.51012 7.4036 5.67969 7.52863 5.80472C7.65365 5.92974 7.82322 5.99998 8.00003 5.99998C8.17684 5.99998 8.34641 5.92974 8.47144 5.80472C8.59646 5.67969 8.6667 5.51012 8.6667 5.33331C8.6667 5.1565 8.59646 4.98693 8.47144 4.86191C8.34641 4.73688 8.17684 4.66665 8.00003 4.66665Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_651_35">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            <p class="text-[10px] text-zinc-300">
                                                Profit Range: <span>{{ $strategy['min_roi'] }}</span>%
                                                to <span>{{ $strategy['max_roi'] }}</span>%
                                                in <span>{{ $strategy['duration'] }}</span>hrs
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-1">
                                        <div class="flex items-center gap-x-1">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_652_40)">
                                                    <path
                                                        d="M2.47503 7.44201L4.26037 8.64467C4.93103 9.09667 4.48303 10.1427 3.6937 9.96934L2.98437 9.81334C3.34456 10.8099 3.9934 11.6766 4.84813 12.303C5.70286 12.9293 6.72477 13.2869 7.78355 13.3302C8.84233 13.3735 9.89001 13.1004 10.793 12.5459C11.696 11.9914 12.4134 11.1805 12.8537 10.2167C12.9294 10.0598 13.0635 9.9387 13.2273 9.87941C13.3911 9.82013 13.5717 9.82733 13.7302 9.89948C13.8888 9.97162 14.0129 10.103 14.0758 10.2654C14.1387 10.4279 14.1356 10.6085 14.067 10.7687C12.7424 13.682 9.4697 15.2973 6.2757 14.4413C4.86652 14.0638 3.62002 13.2346 2.72726 12.0807C1.8345 10.9269 1.34473 9.51217 1.33303 8.05334C1.32837 7.45134 1.99703 7.11867 2.47503 7.44134M7.9997 4.00001C8.16299 4.00003 8.32059 4.05998 8.44261 4.16848C8.56464 4.27699 8.64259 4.42651 8.6617 4.58867L8.66637 4.66667V5.33334H9.9997C10.1696 5.33353 10.3331 5.39859 10.4566 5.51524C10.5802 5.63189 10.6545 5.79131 10.6645 5.96094C10.6744 6.13056 10.6192 6.29759 10.5102 6.4279C10.4011 6.5582 10.2464 6.64194 10.0777 6.66201L9.9997 6.66667H6.66637C6.58307 6.66652 6.50273 6.69756 6.44118 6.75368C6.37962 6.8098 6.34131 6.88693 6.33378 6.96989C6.32626 7.05284 6.35006 7.13561 6.40051 7.20189C6.45096 7.26818 6.5244 7.31317 6.60637 7.32801L6.66637 7.33334H9.33303C9.76629 7.33229 10.1829 7.49999 10.4946 7.8009C10.8064 8.10181 10.9886 8.51228 11.0029 8.94531C11.0171 9.37834 10.8621 9.79988 10.5708 10.1206C10.2795 10.4413 9.87476 10.636 9.44237 10.6633L9.33303 10.6667H8.66637V11.3333C8.66618 11.5033 8.60111 11.6667 8.48447 11.7903C8.36782 11.9138 8.2084 11.9882 8.03877 11.9981C7.86914 12.0081 7.70211 11.9529 7.57181 11.8438C7.44151 11.7348 7.35777 11.5801 7.3377 11.4113L7.33303 11.3333V10.6667H5.9997C5.82978 10.6665 5.66634 10.6014 5.54279 10.4848C5.41923 10.3681 5.34488 10.2087 5.33492 10.0391C5.32496 9.86945 5.38015 9.70242 5.48921 9.57212C5.59827 9.44182 5.75297 9.35808 5.9217 9.33801L5.9997 9.33334H9.33303C9.41633 9.33349 9.49667 9.30245 9.55822 9.24633C9.61978 9.19022 9.65809 9.11308 9.66562 9.03013C9.67314 8.94717 9.64934 8.8644 9.59889 8.79812C9.54844 8.73184 9.475 8.68685 9.39303 8.67201L9.33303 8.66667H6.66637C6.23311 8.66773 5.81647 8.50003 5.50476 8.19911C5.19304 7.8982 5.01076 7.48773 4.99654 7.0547C4.98232 6.62168 5.13729 6.20014 5.42859 5.87942C5.7199 5.55871 6.12464 5.36404 6.55703 5.33667L6.66637 5.33334H7.33303V4.66667C7.33303 4.48986 7.40327 4.32029 7.52829 4.19527C7.65332 4.07024 7.82289 4.00001 7.9997 4.00001ZM9.72637 1.56201C11.1355 1.93942 12.382 2.76853 13.2747 3.92224C14.1675 5.07594 14.6573 6.49059 14.669 7.94934C14.6737 8.55134 14.0057 8.88401 13.5277 8.56134L11.7424 7.35867C11.071 6.90667 11.519 5.86067 12.309 6.03401L13.0177 6.19001C12.6575 5.19344 12.0087 4.32672 11.1539 3.70037C10.2992 3.07402 9.2773 2.71641 8.21852 2.67314C7.15974 2.62987 6.11206 2.9029 5.20906 3.45742C4.30607 4.01194 3.58868 4.82282 3.14837 5.78667C3.11341 5.86831 3.0625 5.94215 2.99862 6.00384C2.93474 6.06553 2.85918 6.11384 2.77637 6.14593C2.69356 6.17801 2.60518 6.19323 2.51641 6.19069C2.42763 6.18815 2.34027 6.16789 2.25943 6.13112C2.1786 6.09434 2.10592 6.04179 2.04568 5.97654C1.98544 5.91129 1.93884 5.83466 1.90862 5.75115C1.8784 5.66764 1.86517 5.57894 1.8697 5.49025C1.87424 5.40155 1.89645 5.31466 1.93503 5.23467C3.2597 2.32134 6.53303 0.706673 9.72637 1.56201Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_652_40">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            <p class="text-[10px] text-zinc-300">
                                                Minimum Amount: At
                                                least $<span>{{ $strategy['min_amount'] }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <a wire:click="startRobot()">
                        <button type="button" wire:loading.attr="disabled"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Start robot</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('robotPage', {
            isStrategyListOverlayOpen: false,

            isTradingAccountSelectOpen: false,

            toggleStrategyListOverlay() {
                this.isStrategyListOverlayOpen = !this.isStrategyListOverlayOpen
            },

            toggleTradingAccountSelect() {
                this.isTradingAccountSelectOpen = !this.isTradingAccountSelectOpen
            }
        })
    })
</script>

@script
    <script>
        $wire.on('robot-error', (event) => {
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

        $wire.on('zero-amount-robot-error', (event) => {
            const toastMarkup = `
                <div class="flex items-start p-4">
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

        $wire.on('robot-stopped', (event) => {
            const toastMarkup = `
                <div class="flex items-start p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
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
