<div x-data="traderoom" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-96 lg:pt-6">
            <div class="my-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Active Robot</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="w-full bg-dashboard border border-[#26252a] rounded-lg p-4 mb-4">
                    <div class="mb-4">
                        <h2 class="text-white font-bold text-xl">@money($this->amount)</h2>
                        <p class="text-zinc-300 text-[13px]">Profit <span
                                class="text-green-500">+@money($this->profit / 100)</span></p>
                    </div>

                    <div class="flex items-center space-x-3 border border-[#26252a] rounded-lg p-4 mb-4">
                        <div class="flex-1">
                            <template x-if="isBotSearchingForSignal === false">
                                <div class="flex items-center justify-center w-fit">
                                    <p x-text='timer' class="text-white font-medium text-2xl"></p>
                                </div>
                            </template>
                            <template x-if="isBotSearchingForSignal === true">
                                <div wire:ignore class="flex items-center justify-center w-fit">
                                    <i class="fas fa-circle-notch fa-spin fa-2x text-accent"></i>
                                </div>
                            </template>
                        </div>
                        <div class="flex-none w-fit">
                            <template x-if="isBotSearchingForSignal === false">
                                <div class="flex flex-col">
                                    <div>
                                        <p class="text-zinc-300 text-[11px] text-center">Robot is trading</p>
                                    </div>
                                    <div class="flex items-center space-x-1 rounded-lg">
                                        <div>
                                            <img x-bind:src="assetIcon" alt="">
                                        </div>
                                        <div>
                                            <p x-text="asset" class="font-semibold text-white text-[15px]"></p>
                                        </div>
                                        <div class="pb-1">
                                            <span x-text="sentiment"
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-[9px] font-normal text-white"
                                                x-bind:class="sentiment === 'BUY' ? 'bg-green-600' : 'bg-red-600'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template x-if="isBotSearchingForSignal === true">
                                <div class="flex flex-col space-y-1">
                                    <div>
                                        <p class="text-zinc-300 text-[11px] text-center">Fetching signals...</p>
                                    </div>
                                    <div class="flex items-center space-x-1 rounded-lg">
                                        <div class="flex-none animate-pulse-bg size-4 rounded-sm"></div>
                                        <div class="flex-1 animate-pulse-bg size-4 rounded-sm"></div>
                                        <div class="flex-none pb-1 animate-pulse-bg size-4 rounded-sm"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="border border-[#26252a] rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-center space-x-2 pb-2 border-b border-[#26252a]">
                            <div class="flex-none">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_654_51)">
                                        <path
                                            d="M10.9997 1.83331C16.0624 1.83331 20.1663 5.93723 20.1663 11C20.1663 16.0627 16.0624 20.1666 10.9997 20.1666C5.93692 20.1666 1.83301 16.0627 1.83301 11C1.83301 5.93723 5.93692 1.83331 10.9997 1.83331ZM10.9997 3.66665C9.05475 3.66665 7.18949 4.43926 5.81422 5.81453C4.43896 7.1898 3.66634 9.05506 3.66634 11C3.66634 12.9449 4.43896 14.8102 5.81422 16.1854C7.18949 17.5607 9.05475 18.3333 10.9997 18.3333C12.9446 18.3333 14.8099 17.5607 16.1851 16.1854C17.5604 14.8102 18.333 12.9449 18.333 11C18.333 9.05506 17.5604 7.1898 16.1851 5.81453C14.8099 4.43926 12.9446 3.66665 10.9997 3.66665ZM10.9997 5.49998C11.2242 5.50001 11.4409 5.58244 11.6087 5.73164C11.7765 5.88083 11.8837 6.08642 11.9099 6.3094L11.9163 6.41665V7.33331H13.7497C13.9833 7.33357 14.208 7.42304 14.3779 7.58342C14.5478 7.74381 14.6501 7.96302 14.6637 8.19626C14.6774 8.4295 14.6016 8.65916 14.4516 8.83833C14.3016 9.01749 14.0889 9.13263 13.8569 9.16023L13.7497 9.16665H9.16634C9.05181 9.16644 8.94135 9.20911 8.85671 9.28628C8.77207 9.36344 8.71939 9.4695 8.70904 9.58357C8.69869 9.69763 8.73142 9.81144 8.80079 9.90258C8.87016 9.99371 8.97114 10.0556 9.08384 10.076L9.16634 10.0833H12.833C13.4287 10.0819 14.0016 10.3125 14.4302 10.7262C14.8588 11.14 15.1095 11.7044 15.129 12.2998C15.1486 12.8952 14.9355 13.4748 14.5349 13.9158C14.1344 14.3568 13.5779 14.6244 12.9833 14.6621L12.833 14.6666H11.9163V15.5833C11.9161 15.817 11.8266 16.0417 11.6662 16.2116C11.5058 16.3815 11.2866 16.4837 11.0534 16.4974C10.8202 16.5111 10.5905 16.4352 10.4113 16.2852C10.2322 16.1353 10.117 15.9226 10.0894 15.6906L10.083 15.5833V14.6666H8.24967C8.01603 14.6664 7.79131 14.5769 7.62142 14.4165C7.45153 14.2561 7.34929 14.0369 7.3356 13.8037C7.32191 13.5705 7.39779 13.3408 7.54775 13.1616C7.69771 12.9825 7.91042 12.8673 8.14242 12.8397L8.24967 12.8333H12.833C12.9475 12.8335 13.058 12.7908 13.1426 12.7137C13.2273 12.6365 13.28 12.5305 13.2903 12.4164C13.3007 12.3023 13.2679 12.1885 13.1986 12.0974C13.1292 12.0062 13.0282 11.9444 12.9155 11.924L12.833 11.9166H9.16634C8.57061 11.9181 7.99773 11.6875 7.56913 11.2738C7.14052 10.86 6.88988 10.2956 6.87033 9.70019C6.85078 9.10478 7.06386 8.52516 7.4644 8.08418C7.86495 7.6432 8.42147 7.37553 9.01601 7.3379L9.16634 7.33331H10.083V6.41665C10.083 6.17353 10.1796 5.94037 10.3515 5.76847C10.5234 5.59656 10.7566 5.49998 10.9997 5.49998Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_654_51">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Amount</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">@money($this->amount)</div>
                        </div>

                        <div class="flex items-center justify-center space-x-2 py-2 border-b border-[#26252a]">
                            <div class="flex-none">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_655_56)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.41634 11.9167C6.87887 11.9165 7.32436 12.0912 7.66351 12.4057C8.00266 12.7202 8.2104 13.1513 8.24509 13.6125L8.24967 13.75V16.5C8.24982 16.9625 8.07514 17.408 7.76064 17.7472C7.44614 18.0863 7.01507 18.2941 6.55384 18.3288L6.41634 18.3333H3.66634C3.20381 18.3335 2.75832 18.1588 2.41917 17.8443C2.08002 17.5298 1.87228 17.0987 1.83759 16.6375L1.83301 16.5V13.75C1.83286 13.2875 2.00755 12.842 2.32205 12.5028C2.63655 12.1637 3.06762 11.9559 3.52884 11.9212L3.66634 11.9167H6.41634ZM14.6663 15.5833C14.9 15.5836 15.1247 15.6731 15.2946 15.8334C15.4645 15.9938 15.5667 16.213 15.5804 16.4463C15.5941 16.6795 15.5182 16.9092 15.3683 17.0883C15.2183 17.2675 15.0056 17.3827 14.7736 17.4102L14.6663 17.4167H10.9997C10.766 17.4164 10.5413 17.3269 10.3714 17.1666C10.2015 17.0062 10.0993 16.787 10.0856 16.5537C10.0719 16.3205 10.1478 16.0908 10.2977 15.9117C10.4477 15.7325 10.6604 15.6173 10.8924 15.5897L10.9997 15.5833H14.6663ZM6.41634 13.75H3.66634V16.5H6.41634V13.75ZM18.333 11.9167C18.5761 11.9167 18.8093 12.0132 18.9812 12.1852C19.1531 12.3571 19.2497 12.5902 19.2497 12.8333C19.2497 13.0764 19.1531 13.3096 18.9812 13.4815C18.8093 13.6534 18.5761 13.75 18.333 13.75H10.9997C10.7566 13.75 10.5234 13.6534 10.3515 13.4815C10.1796 13.3096 10.083 13.0764 10.083 12.8333C10.083 12.5902 10.1796 12.3571 10.3515 12.1852C10.5234 12.0132 10.7566 11.9167 10.9997 11.9167H18.333ZM6.41634 2.75C6.90257 2.75 7.36889 2.94315 7.7127 3.28697C8.05652 3.63079 8.24967 4.0971 8.24967 4.58333V7.33333C8.24967 7.81956 8.05652 8.28588 7.7127 8.6297C7.36889 8.97351 6.90257 9.16667 6.41634 9.16667H3.66634C3.18011 9.16667 2.7138 8.97351 2.36998 8.6297C2.02616 8.28588 1.83301 7.81956 1.83301 7.33333V4.58333C1.83301 4.0971 2.02616 3.63079 2.36998 3.28697C2.7138 2.94315 3.18011 2.75 3.66634 2.75H6.41634ZM14.6663 6.41667C14.9 6.41693 15.1247 6.50639 15.2946 6.66678C15.4645 6.82717 15.5667 7.04637 15.5804 7.27961C15.5941 7.51285 15.5182 7.74251 15.3683 7.92168C15.2183 8.10084 15.0056 8.21599 14.7736 8.24358L14.6663 8.25H10.9997C10.766 8.24974 10.5413 8.16028 10.3714 7.99989C10.2015 7.8395 10.0993 7.62029 10.0856 7.38705C10.0719 7.15382 10.1478 6.92415 10.2977 6.74499C10.4477 6.56582 10.6604 6.45068 10.8924 6.42308L10.9997 6.41667H14.6663ZM6.41634 4.58333H3.66634V7.33333H6.41634V4.58333ZM18.333 2.75C18.5666 2.75026 18.7914 2.83972 18.9613 3.00011C19.1312 3.1605 19.2334 3.37971 19.2471 3.61295C19.2608 3.84618 19.1849 4.07585 19.0349 4.25501C18.885 4.43418 18.6723 4.54932 18.4403 4.57692L18.333 4.58333H10.9997C10.766 4.58307 10.5413 4.49361 10.3714 4.33322C10.2015 4.17283 10.0993 3.95363 10.0856 3.72039C10.0719 3.48715 10.1478 3.25749 10.2977 3.07832C10.4477 2.89915 10.6604 2.78401 10.8924 2.75642L10.9997 2.75H18.333Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_655_56">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Account</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">{{ $this->accountType }}
                            </div>
                        </div>

                        <div class="flex items-center justify-center space-x-2 py-2 border-b border-[#26252a]">
                            <div class="flex-none">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_655_61)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.5 2.75C18.0188 2.75 19.25 3.98122 19.25 5.5V16.5C19.25 18.0188 18.0188 19.25 16.5 19.25H5.5C3.98122 19.25 2.75 18.0188 2.75 16.5V5.5C2.75 3.98122 3.98122 2.75 5.5 2.75H16.5ZM16.5 4.58333H5.5C4.99374 4.58333 4.58333 4.99374 4.58333 5.5V16.5C4.58333 17.0063 4.99374 17.4167 5.5 17.4167H16.5C17.0063 17.4167 17.4167 17.0063 17.4167 16.5V5.5C17.4167 4.99374 17.0063 4.58333 16.5 4.58333ZM7.79167 12.8333C8.50639 12.8333 9.09375 13.3787 9.16037 14.0759L9.16667 14.2175C9.16667 14.9769 8.55106 15.5925 7.79167 15.5925C7.07694 15.5925 6.48959 15.0472 6.42296 14.3499L6.41667 14.2083C6.41667 13.449 7.03227 12.8333 7.79167 12.8333ZM14.2083 12.8333C14.923 12.8333 15.5104 13.3787 15.577 14.0759L15.5833 14.2175C15.5833 14.9769 14.9677 15.5925 14.2083 15.5925C13.4936 15.5925 12.9063 15.0472 12.8396 14.3499L12.8333 14.2083C12.8333 13.449 13.449 12.8333 14.2083 12.8333ZM11 9.625C11.7147 9.625 12.3021 10.1703 12.3687 10.8676L12.375 11.0092C12.375 11.7685 11.7594 12.3842 11 12.3842C10.2853 12.3842 9.69792 11.8388 9.63129 11.1416L9.625 11C9.625 10.2406 10.2406 9.625 11 9.625ZM7.79167 6.41667C8.50639 6.41667 9.09375 6.96198 9.16037 7.65924L9.16667 7.80083C9.16667 8.56023 8.55106 9.17583 7.79167 9.17583C7.07694 9.17583 6.48959 8.63052 6.42296 7.93326L6.41667 7.79167C6.41667 7.03227 7.03227 6.41667 7.79167 6.41667ZM14.2083 6.41667C14.923 6.41667 15.5104 6.96198 15.577 7.65924L15.5833 7.80083C15.5833 8.56023 14.9677 9.17583 14.2083 9.17583C13.4936 9.17583 12.9063 8.63052 12.8396 7.93326L12.8333 7.79167C12.8333 7.03227 13.449 6.41667 14.2083 6.41667Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_655_61">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Strategy</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">{{ $this->strategy }}</div>
                        </div>

                        <div class="flex items-center justify-center space-x-2 py-2 border-b border-[#26252a]">
                            <div class="flex-none">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_655_66)">
                                        <path
                                            d="M3.66667 3.66669C3.89119 3.66672 4.10789 3.74915 4.27567 3.89834C4.44346 4.04754 4.55065 4.25312 4.57692 4.4761L4.58333 4.58335V16.5H18.3333C18.567 16.5003 18.7917 16.5897 18.9616 16.7501C19.1315 16.9105 19.2337 17.1297 19.2474 17.363C19.2611 17.5962 19.1852 17.8259 19.0353 18.005C18.8853 18.1842 18.6726 18.2993 18.4406 18.3269L18.3333 18.3334H3.66667C3.44214 18.3333 3.22544 18.2509 3.05766 18.1017C2.88988 17.9525 2.78269 17.7469 2.75642 17.5239L2.75 17.4167V4.58335C2.75 4.34024 2.84658 4.10708 3.01849 3.93517C3.19039 3.76326 3.42355 3.66669 3.66667 3.66669ZM18.5112 6.24985C19.3362 6.24985 19.7487 7.24719 19.1657 7.83019L14.0598 12.936C13.8708 13.1249 13.6144 13.2311 13.3471 13.2311C13.0798 13.2311 12.8235 13.1249 12.6344 12.936L10.1062 10.4079L6.86583 13.6483C6.69395 13.8203 6.46078 13.917 6.21762 13.917C5.97445 13.9171 5.74121 13.8206 5.56921 13.6487C5.3972 13.4768 5.30053 13.2437 5.30044 13.0005C5.30035 12.7573 5.39687 12.5241 5.56875 12.3521L9.39308 8.52777C9.48672 8.43409 9.5979 8.35977 9.72027 8.30907C9.84264 8.25837 9.97379 8.23227 10.1062 8.23227C10.2387 8.23227 10.3699 8.25837 10.4922 8.30907C10.6146 8.35977 10.7258 8.43409 10.8194 8.52777L13.3476 11.0559L16.3194 8.08319H15.9399C15.6968 8.08319 15.4636 7.98661 15.2917 7.8147C15.1198 7.64279 15.0233 7.40964 15.0233 7.16652C15.0233 6.92341 15.1198 6.69025 15.2917 6.51834C15.4636 6.34643 15.6968 6.24985 15.9399 6.24985H18.5112Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_655_66">
                                            <rect width="22" height="22" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Profit limit</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">{{ $this->profitLimit }}%
                            </div>
                        </div>
                    </div>

                    <div>
                        <button x-on:click="toggleStopRobotConfirmationModal()" type="button"
                            class="py-2.5 cursor-pointer px-4 w-full md:px-6 text-center gap-x-2 text-sm font-semibold rounded-lg bg-accent text-black focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            Stop the robot
                        </button>
                    </div>

                    <div
                        class="flex items-center space-x-4 mt-4 w-full bg-dashboard rounded-lg p-4 border border-white/10">
                        <div class="flex-1">
                            <p class="text-white text-sm">Track trade on chart</p>
                            <p class="text-zinc-300 text-[11px]">Monitor the movement of the asset as it trades</p>
                        </div>
                        <div>
                            <a href="{{ route('dashboard') }}">
                                <button type="button"
                                    class="py-2 px-4 md:px-6 md:py-3 inline-flex items-center gap-x-1 text-xs font-bold rounded-sm bg-accent text-black focus:outline-hidden">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_656_78)">
                                            <mask id="mask0_656_78" style="mask-type:luminance"
                                                maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                                <path d="M16 0H0V16H16V0Z" fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_656_78)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M5.33366 1.33331C5.49695 1.33333 5.65455 1.39329 5.77657 1.50179C5.8986 1.61029 5.97655 1.75981 5.99566 1.92198L6.00033 1.99998V3.33331C6.51047 3.33329 7.00133 3.52819 7.37253 3.87817C7.74366 4.22814 7.96706 4.70672 7.99699 5.21598L8.00033 5.33331V9.33331C8.00033 9.84345 7.80546 10.3343 7.45546 10.7055C7.10553 11.0766 6.62692 11.3 6.11766 11.33L6.00033 11.3333V14C6.00014 14.1699 5.93507 14.3333 5.81843 14.4569C5.70178 14.5804 5.54236 14.6548 5.37273 14.6648C5.2031 14.6747 5.03607 14.6195 4.90577 14.5104C4.77547 14.4014 4.69173 14.2467 4.67166 14.078L4.66699 14V11.3333C4.15685 11.3333 3.66598 11.1384 3.29482 10.7884C2.92365 10.4385 2.70025 9.95991 2.67033 9.45065L2.66699 9.33331V5.33331C2.66697 4.82317 2.86188 4.33231 3.21185 3.96114C3.56182 3.58997 4.0404 3.36657 4.54966 3.33665L4.66699 3.33331V1.99998C4.66699 1.82317 4.73723 1.6536 4.86225 1.52857C4.98728 1.40355 5.15685 1.33331 5.33366 1.33331ZM11.3337 1.33331C11.4969 1.33333 11.6545 1.39329 11.7766 1.50179C11.8986 1.61029 11.9765 1.75981 11.9957 1.92198L12.0003 1.99998V4.66665C12.5105 4.66662 13.0013 4.86153 13.3725 5.2115C13.7437 5.56147 13.9671 6.04005 13.997 6.54931L14.0003 6.66665V10.6666C14.0003 11.1768 13.8055 11.6676 13.4555 12.0388C13.1055 12.41 12.6269 12.6334 12.1177 12.6633L12.0003 12.6666V14C12.0001 14.1699 11.9351 14.3333 11.8185 14.4569C11.7018 14.5804 11.5423 14.6548 11.3727 14.6648C11.2031 14.6747 11.0361 14.6195 10.9058 14.5104C10.7755 14.4014 10.6917 14.2467 10.6717 14.078L10.667 14V12.6666C10.1569 12.6666 9.66599 12.4718 9.29479 12.1218C8.92366 11.7718 8.70026 11.2932 8.67033 10.784L8.66699 10.6666V6.66665C8.66699 6.15651 8.86186 5.66563 9.21186 5.29447C9.56179 4.92331 10.0404 4.69991 10.5497 4.66998L10.667 4.66665V1.99998C10.667 1.82317 10.7373 1.6536 10.8623 1.52857C10.9873 1.40355 11.1569 1.33331 11.3337 1.33331ZM12.0003 5.99998H10.667C10.5037 6 10.3461 6.05995 10.2241 6.16846C10.1021 6.27696 10.0241 6.42648 10.005 6.58865L10.0003 6.66665V10.6666C10.0003 10.8299 10.0603 10.9875 10.1688 11.1096C10.2773 11.2316 10.4268 11.3095 10.589 11.3286L10.667 11.3333H12.0003C12.1636 11.3333 12.3212 11.2733 12.4433 11.1648C12.5653 11.0563 12.6432 10.9068 12.6623 10.7446L12.667 10.6666V6.66665C12.667 6.50336 12.607 6.34575 12.4985 6.22373C12.39 6.10171 12.2405 6.02375 12.0783 6.00465L12.0003 5.99998ZM6.00033 4.66665H4.66699C4.50371 4.66667 4.3461 4.72662 4.22408 4.83513C4.10205 4.94363 4.0241 5.09315 4.00499 5.25531L4.00033 5.33331V9.33331C4.00035 9.49658 4.0603 9.65418 4.16881 9.77625C4.27731 9.89825 4.42683 9.97618 4.58899 9.99531L4.66699 9.99998H6.00033C6.16361 9.99998 6.32122 9.93998 6.44324 9.83151C6.56527 9.72298 6.64322 9.57351 6.66233 9.41131L6.66699 9.33331V5.33331C6.66697 5.17003 6.60702 5.01242 6.49851 4.8904C6.39001 4.76837 6.24049 4.69042 6.07833 4.67131L6.00033 4.66665Z"
                                                    fill="black" />
                                            </g>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_656_78">
                                                <rect width="16" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    Track
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div x-cloak x-show="isStopRobotConfirmationModalOpen"
                class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="max-w-sm mx-auto flex flex-col bg-[#26252a] rounded-lg pointer-events-auto">
                        <div class="flex justify-between items-center py-3 px-4 dark:border-neutral-700">
                            <h3 class="font-bold text-gray-800 dark:text-white">
                            </h3>
                            <button x-on:click="toggleStopRobotConfirmationModal()" type="button"
                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto text-center">
                            <p class="text-white font-semibold text-xl">
                                Are you sure you want to stop the robot?
                            </p>
                        </div>
                        <div class="py-3 px-4">
                            <div>
                                <button type="button" x-on:click="destroy()" wire:click="stopRobot()"
                                    type="button" wire:loading.attr="disabled"
                                    class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-black cursor-pointer hover:bg-accent-hover focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                    <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                                    <span wire:loading.remove>Stop robot</span>
                                </button>
                            </div>
                            <div class="mt-3">
                                <button x-on:click="toggleStopRobotConfirmationModal()" type="button"
                                    class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs cursor-pointer hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                    data-hs-overlay="#hs-vertically-centered-modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('robot-created', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-black">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-white text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });

        $wire.on('stop-robot-error', (event) => {
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
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-white text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });

        $wire.on('profit-incremented', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-navbar text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('traderoom', () => ({
            isStoppingRobot: false,
            timer: '',
            timeLeft: {},
            timerInterval: null,
            isBotSearchingForSignal: '',
            isStopRobotConfirmationModalOpen: false,
            asset: '',
            assetIcon: '',
            sentiment: '',

            init() {
                // Start the timer when the component initializes
                this.startTimer();
            },

            startTimer() {
                this.timerInterval = setInterval(() => {
                    this.refreshTimer();
                }, 1000);
            },

            stopTimer() {
                if (this.timerInterval) {
                    clearInterval(this.timerInterval);
                    this.timerInterval = null;
                }
            },

            toggleStopRobotConfirmationModal() {
                this.isStopRobotConfirmationModalOpen = !this.isStopRobotConfirmationModalOpen;
            },

            calculateTimeLeftTillNextCheckpoint(checkpoint) {
                let difference = checkpoint - Date.now();

                if (0 > difference) {
                    return {
                        minutes: 0,
                        seconds: 0
                    }
                }

                let minutes = Math.floor((difference / (1000 * 60)) % 60);
                let seconds = Math.floor((difference / 1000) % 60);

                return {
                    minutes: minutes,
                    seconds: seconds
                }
            },

            formatTimeLeft(minutes, seconds) {
                let minuteString = 0;
                let secondString = 0;

                if (minutes < 10) {
                    minuteString = `0${String(minutes)}`;
                } else {
                    minuteString = String(minutes);
                }

                if (seconds < 10) {
                    secondString = `0${String(seconds)}`;
                } else {
                    secondString = String(seconds);
                }

                return `${minuteString}:${secondString}`;
            },

            toggleSearchingForSignals(minutes, seconds) {
                if (minutes === 5 && seconds > 0) {
                    this.isBotSearchingForSignal = true;
                }

                if (minutes === 5 && seconds === 0) {
                    this.isBotSearchingForSignal = false;
                }

                if (minutes <= 4) {
                    this.isBotSearchingForSignal = false;
                }

                if (minutes === 0 && seconds === 0) {
                    this.isBotSearchingForSignal = true;
                }
            },

            refreshTimer() {
                this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                    .timerCheckpoint);
                this.asset = this.$wire.asset;
                this.assetIcon = `/${this.$wire.assetIcon}`
                this.sentiment = this.$wire.sentiment;

                if (Date.now() > this.$wire.timerCheckpoint) {
                    this.$wire.refreshAssetData();
                    this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                        .timerCheckpoint);
                    this.asset = this.$wire.asset;
                    this.assetIcon = `/${this.$wire.assetIcon}`;
                    this.sentiment = this.$wire.sentiment;
                    let nextCheckpoint = new Date(Number(this.$wire.timerCheckpoint)).getTime() + (
                        5 * 60 + 8) * 1000;
                    this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(nextCheckpoint);
                }

                let formatted = this.formatTimeLeft(this.timeLeft.minutes, this.timeLeft.seconds);
                this.timer = formatted;

                this.toggleSearchingForSignals(this.timeLeft.minutes, this.timeLeft.seconds);
            },

            // Clean up when component is destroyed
            destroy() {
                this.stopTimer();
            }
        }))
    })
</script>
