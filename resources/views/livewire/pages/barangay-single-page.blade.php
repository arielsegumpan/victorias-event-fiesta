<div>
    {{-- @dd($this->barangay) --}}
    <!-- Blog Article -->
    <div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-2xl">
            @if($this->currentCaptain?->user?->name)
            <!-- Avatar Media -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                    <div class="shrink-0">
                        <img class="size-12 rounded-full"
                            src="https://avatar.iran.liara.run/username?username={{ $this->currentCaptain->user->name ?? 'user' }}"
                            alt="{{ $this->currentCaptain->user->name ?? 'N/A' }}">
                    </div>

                    <div class="grow">
                        <div class="flex justify-between items-center gap-x-2">
                            <div>
                                <!-- Tooltip -->
                                <div class="hs-tooltip [--trigger:hover] [--placement:bottom] inline-block">
                                    <div class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
                                        <span class="font-semibold text-gray-800 dark:text-neutral-200">
                                            {{ $this->currentCaptain->user->name}}
                                        </span>
                                        @if($this->currentCaptain?->user?->roles->first()->name)
                                        <div class="inline-flex flex-wrap gap-2">
                                            <div>
                                                <span
                                                    class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                    <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path
                                                            d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                                        </path>
                                                        <path d="m9 12 2 2 4-4"></path>
                                                    </svg>
                                                    {{ Str::title($this->currentCaptain?->user?->roles->first()->name) }}
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Tooltip -->

                                <ul class="text-xs text-gray-500 dark:text-neutral-500">
                                    <li
                                        class="inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:size-1 before:bg-gray-300 before:rounded-full dark:text-neutral-400 dark:before:bg-neutral-600">
                                        {{ $this->currentCaptain?->user?->email ?? 'N/A' }}
                                    </li>
                                    @if ($this->currentCaptain?->term_start && $this->currentCaptain?->term_end)
                                    <li
                                        class="inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:size-1 before:bg-gray-300 before:rounded-full dark:text-neutral-400 dark:before:bg-neutral-600">
                                        {{ $this->currentCaptain->term_start->format('M d, Y') . ' - ' .
                                        $this->currentCaptain->term_end->format('M d, Y') }}
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Avatar Media -->
            @endif

            <!-- Content -->
            <div class="space-y-5 md:space-y-8">
                <div class="space-y-3">
                    <div class="flex flex-row ">
                        <img class="object-cover h-16 w-16 rounded-lg me-4 border-1 border-amber-300"
                            src="{{ asset(Storage::url($this->barangay->brgy_logo)) }}"
                            alt="{{ $this->barangay->brgy_name }}">
                        <div>
                            <h2 class="text-2xl font-bold md:text-3xl dark:text-white">
                                {{ $this->barangay->brgy_name }}
                            </h2>
                            <div class="flex flex-row mt-1 items-center justify-start">
                                @if(!empty($this->barangay->brgy_email))
                                <a href="mailto:{{ $this->barangay->brgy_email }}" class="me-2">
                                    <svg class="shrink-0 size-6 text-amber-500 dark:text-amber-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <path
                                            d="M32,56H224a0,0,0,0,1,0,0V192a8,8,0,0,1-8,8H40a8,8,0,0,1-8-8V56A0,0,0,0,1,32,56Z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="8" />
                                        <polyline points="224 56 128 144 32 56" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8" />
                                    </svg>
                                </a>
                                @endif
                                @if(!empty($this->barangay->brgy_facebook))
                                <a href="{{ $this->barangay->brgy_facebook }}" target="_blank" rel="noopener noreferrer"
                                    class="me-2">
                                    <svg class="shrink-0 size-6 text-amber-500 dark:text-amber-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8" />
                                        <path d="M168,88H152a24,24,0,0,0-24,24V224" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8" />
                                        <line x1="96" y1="144" x2="160" y2="144" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8" />
                                    </svg>
                                </a>
                                @endif
                                @if(!empty($this->barangay->brgy_twitter))
                                <a href="{{ $this->barangay->brgy_twitter }}" target="_blank" rel="noopener noreferrer"
                                    class="me-2">
                                    <svg class="shrink-0 size-6 text-amber-500 dark:text-amber-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <path
                                            d="M88,176S32.85,144,40.78,56c0,0,39.66,40,87.22,48V88c0-22,18-40.27,40-40a40.74,40.74,0,0,1,36.67,24H240l-32,32c-4.26,66.84-60.08,120-128,120-32,0-40-12-40-12S72,200,88,176Z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="8" />
                                    </svg>
                                </a>
                                @endif
                                @if(!empty($this->barangay->brgy_instagram))
                                <a href="{{ $this->barangay->brgy_twitter }}" target="_blank" rel="noopener noreferrer"
                                    class="me-2">
                                    <svg class="shrink-0 size-6 text-amber-500 dark:text-amber-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <circle cx="128" cy="128" r="40" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8" />
                                        <rect x="32" y="32" width="192" height="192" rx="48" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="8" />
                                        <circle cx="180" cy="76" r="8" />
                                    </svg>
                                </a>
                                @endif
                                @if(!empty($this->barangay->brgy_youtube))
                                <a href="{{ $this->barangay->brgy_youtube }}" target="_blank" rel="noopener noreferrer"
                                    class="me-2">
                                    <svg class="shrink-0 size-6 text-amber-500 dark:text-amber-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <polygon points="160 128 112 96 112 160 160 128" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="8" />
                                        <path
                                            d="M24,128c0,29.91,3.07,47.45,5.41,56.47A16,16,0,0,0,39,195.42C72.52,208.35,128,208,128,208s55.48.35,89-12.58a16,16,0,0,0,9.63-10.95c2.34-9,5.41-26.56,5.41-56.47s-3.07-47.45-5.41-56.47a16,16,0,0,0-9.63-11C183.48,47.65,128,48,128,48s-55.48-.35-89,12.58a16,16,0,0,0-9.63,11C27.07,80.54,24,98.09,24,128Z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="8" />
                                    </svg>
                                </a>
                                @endif
                                @if(!empty($this->barangay->brgy_tiktok))
                                <a href="{{ $this->barangay->brgy_tiktok }}" target="_blank" rel="noopener noreferrer"
                                    class="me-2">
                                    <svg class="shrink-0 size-6 text-amber-500 dark:text-amber-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <path
                                            d="M168,102a95.55,95.55,0,0,0,56,18V80a56,56,0,0,1-56-56H128V156a28,28,0,1,1-40-25.31V88c-31.83,5.67-56,34.54-56,68a68,68,0,0,0,136,0Z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="8" />
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $images = array_slice($this->barangay->brgy_img_gallery, 0, 3);
                    $count = count($images);
                @endphp

                @if(!empty($images))
                <div class="text-center cursor-pointer" aria-haspopup="dialog" aria-expanded="false"
                    aria-controls="hs-slide-down-animation-modal" data-hs-overlay="#hs-slide-down-animation-modal">
                    @if(count($images) === 3)
                    <div class="grid gap-3 lg:grid-cols-2">
                        <div class="grid grid-cols-2 gap-3 lg:grid-cols-1">
                            @foreach(array_slice($images, 0, 2) as $index => $image)
                            <figure class="relative w-full h-60" wire:key="{{ $index . '-image' }}">
                                <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                    src="{{ asset('storage/' . $image) }}" alt="{{ $this->barangay->brgy_name }}">
                            </figure>
                            @endforeach
                        </div>
                        <figure class="relative w-full h-72 sm:h-96 lg:h-full">
                            <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                src="{{ asset('storage/' . $images[2]) }}" alt="{{ $this->barangay->brgy_name }}">
                        </figure>
                    </div>
                    @elseif(count($images) === 2)
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @foreach($images as $index => $image)
                        <figure class="relative w-full h-72" wire:key="{{ $index . '-image' }}">
                            <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                src="{{ asset('storage/' . $image) }}" alt="{{ $this->barangay->brgy_name }}">
                        </figure>
                        @endforeach
                    </div>
                    @elseif(count($images) === 1)
                    <div class="w-full">
                        <figure class="relative w-full h-72 sm:h-96">
                            <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                src="{{ asset('storage/' . $images[0]) }}" alt="{{ $this->barangay->brgy_name }}">
                        </figure>
                    </div>
                    @endif
                </div>
                @endif

                <div class="text-lg text-gray-800 dark:text-neutral-200">
                    <article class="prose">
                        {!! str($this->barangay->brgy_desc)->sanitizeHtml() !!}
                    </article>
                </div>


            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- End Blog Article -->

    <!-- Sticky Share Group -->
    <div class="sticky bottom-6 inset-x-0 text-center">
        <div class="inline-block bg-white shadow-md rounded-full py-3 px-4 dark:bg-neutral-800">
            <div class="flex items-center gap-x-1.5">
                <!-- Button -->
                <div class="hs-tooltip inline-block">
                    <button type="button"
                        class="hs-tooltip-toggle flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                        </svg>
                        875
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-black"
                            role="tooltip">
                            Like
                        </span>
                    </button>
                </div>
                <!-- Button -->

                <div class="block h-3 border-e border-gray-300 mx-3 dark:border-neutral-600"></div>

                <!-- Button -->
                <div class="hs-tooltip inline-block">
                    <button type="button"
                        class="hs-tooltip-toggle flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
                        </svg>
                        16
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-black"
                            role="tooltip">
                            Comment
                        </span>
                    </button>
                </div>
                <!-- Button -->

                <div class="block h-3 border-e border-gray-300 mx-3 dark:border-neutral-600"></div>

                <!-- Button -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-blog-article-share-dropdown" type="button"
                        class="flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                            <polyline points="16 6 12 2 8 6" />
                            <line x1="12" x2="12" y1="2" y2="15" />
                        </svg>
                        Share
                    </button>
                    <div class="hs-dropdown-menu w-56 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mb-1 z-10 bg-gray-900 shadow-md rounded-xl p-2 dark:bg-neutral-950"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-blog-article-share-dropdown">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                            </svg>
                            Copy link
                        </a>
                        <div class="border-t border-gray-600 my-2 dark:border-neutral-800"></div>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                            Share on Twitter
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                            Share on Facebook
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                            </svg>
                            Share on LinkedIn
                        </a>
                    </div>
                </div>
                <!-- Button -->
            </div>
        </div>
    </div>
    <!-- End Sticky Share Group -->
</div>
