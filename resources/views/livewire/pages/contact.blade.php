<div>
    <!-- Contact Us -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-xl mx-auto">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white">
                    Contact us
                </h1>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    We'd love to talk about how we can help you.
                </p>
            </div>

            @if($submitted)
            <!-- Success Message -->
            <div class="bg-green-50 border-t-2 border-green-500 rounded-lg p-4 dark:bg-green-800/30 mt-5" role="alert"
                tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
                <div class="flex">
                    <div class="shrink-0">
                        <!-- Icon -->
                        <span
                            class="inline-flex justify-center items-center size-8 rounded-full border-4 border-green-100 bg-green-200 text-green-800 dark:border-green-900 dark:bg-green-800 dark:text-green-400">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                </path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                        </span>
                        <!-- End Icon -->
                    </div>
                    <div class="ms-3">
                        <h3 id="hs-bordered-success-style-label" class="text-gray-800 font-semibold dark:text-white">
                            Successfully sent.
                        </h3>
                        <p class="text-sm text-gray-700 dark:text-neutral-400">
                            Your message has been sent successfully. We'll get back to you soon.
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="max-w-lg mx-auto mt-12">
            <!-- Card -->
            <div class="flex flex-col p-4 border border-gray-200 rounded-md sm:p-6 lg:p-8 dark:border-neutral-700">
                <h2 class="mb-8 text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Fill in the form
                </h2>

                <form wire:submit.prevent="submit">
                    <div class="grid gap-4 lg:gap-6">
                        <!-- Grid -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:gap-6">
                            <div>
                                <label for="firstName"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">First Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" wire:model.blur="firstName" name="firstName" id="firstName"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-md sm:text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                @error('firstName')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="lastName"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Last Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" wire:model.blur="lastName" name="lastName" id="lastName"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-md sm:text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                @error('lastName')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- End Grid -->

                        <!-- Grid -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:gap-6">
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" wire:model.blur="email" name="email" id="email" autocomplete="email"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-md sm:text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                @error('email')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Phone Number
                                    <span class="text-red-500">*</span></label>
                                <input type="text" wire:model.blur="phone" name="phone" id="phone"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-md sm:text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                @error('phone')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- End Grid -->

                        <div>
                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Details <span
                                    class="text-red-500">*</span></label>
                            <textarea id="message" wire:model.blur="message" name="message" rows="4"
                                placeholder="Tell us about your inquiry..."
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-md sm:text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>

                            <div class="flex justify-between mt-1">
                                @error('message')
                                <p class="text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @else
                                <p class="text-xs text-gray-500 dark:text-neutral-500">Minimum 10 characters</p>
                                @enderror
                                {{-- <p class="text-xs text-gray-500 dark:text-neutral-500">{{ strlen($message) }}/1000
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <!-- End Grid -->

                    <div class="grid mt-6">
                        <button type="submit" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="inline-flex items-center flex-row justify-center w-full px-4 py-3 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-md gap-x-2 hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="submit">Send inquiry</span>
                            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </div>

                    <div class="mt-3 text-center">
                        <p class="text-sm text-gray-500 dark:text-neutral-500">
                            We'll get back to you in 1-2 business days.
                        </p>
                    </div>
                </form>
            </div>
            <!-- End Card -->
        </div>

        <div class="grid items-center gap-4 mt-12 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
            <!-- Icon Block -->
            <a class="flex flex-col h-full p-4 text-center rounded-md group hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 sm:p-6 dark:hover:bg-neutral-500/10 dark:focus:bg-neutral-500/10"
                href="#">
                <svg class="mx-auto text-gray-800 size-9 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                </svg>
                <div class="mt-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Knowledgebase</h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">We're here to help with any questions or code.
                    </p>
                    <p class="inline-flex items-center mt-5 font-medium text-orange-600 gap-x-1 dark:text-orange-500">
                        Contact support
                        <svg class="transition ease-in-out shrink-0 size-4 group-hover:translate-x-1 group-focus:translate-x-1"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </p>
                </div>
            </a>
            <!-- End Icon Block -->

            <!-- Icon Block -->
            <a class="flex flex-col h-full p-4 text-center rounded-md group hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 sm:p-6 dark:hover:bg-neutral-500/10 dark:focus:bg-neutral-500/10"
                href="#">
                <svg class="mx-auto text-gray-800 size-9 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z" />
                    <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1" />
                </svg>
                <div class="mt-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">FAQ</h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">Search our FAQ for answers to anything you might
                        ask.</p>
                    <p class="inline-flex items-center mt-5 font-medium text-orange-600 gap-x-1 dark:text-orange-500">
                        Visit FAQ
                        <svg class="transition ease-in-out shrink-0 size-4 group-hover:translate-x-1 group-focus:translate-x-1"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </p>
                </div>
            </a>
            <!-- End Icon Block -->

            <!-- Icon Block -->
            <a class="flex flex-col h-full p-4 text-center rounded-md group hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 sm:p-6 dark:hover:bg-neutral-500/10 dark:focus:bg-neutral-500/10"
                href="#">
                <svg class="mx-auto text-gray-800 size-9 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="m7 11 2-2-2-2" />
                    <path d="M11 13h4" />
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                </svg>
                <div class="mt-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Developer APIs</h3>
                    <p class="mt-1 text-gray-500 dark:text-neutral-500">Check out our development quickstart guide.</p>
                    <p class="inline-flex items-center mt-5 font-medium text-orange-600 gap-x-1 dark:text-orange-500">
                        Contact sales
                        <svg class="transition ease-in-out shrink-0 size-4 group-hover:translate-x-1 group-focus:translate-x-1"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </p>
                </div>
            </a>
            <!-- End Icon Block -->
        </div>
    </div>
    <!-- End Contact Us -->
</div>
