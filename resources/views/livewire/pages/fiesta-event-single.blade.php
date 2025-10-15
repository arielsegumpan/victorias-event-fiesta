<div>
    {{-- @dd($this->fiesta->tags[0]['tag_name']) --}}
    <!-- Blog Article -->
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
            <!-- Content -->
            <div class="lg:col-span-2">
                <!-- MAIN CONTENT -->
                <div class="py-8 lg:pe-8">
                    <div class="space-y-5 lg:space-y-8">

                        <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-hidden focus:underline dark:text-orange-500"
                            href="{{ route('fiesta-eventos.page') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                            {{ __('Back to Fiestas and Eventos') }}
                        </a>

                        <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">{{ $this->fiesta->f_name }}</h2>

                        <div class="flex flex-row gap-x-4">
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                                 <svg class="shrink-0 size-4 text-green-800 dark:text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="40" y="40" width="176" height="176" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="176" y1="24" x2="176" y2="56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="80" y1="24" x2="80" y2="56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="40" y1="88" x2="216" y2="88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><circle cx="128" cy="152" r="12"/></svg>
                                {{  $this->fiesta->f_start_date->format('F j, Y') }}
                            </span>

                            <span class="text-gray-800 dark:text-gray-400">
                                -
                            </span>

                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                <svg class="shrink-0 size-4 text-red-800 dark:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="40" y="40" width="176" height="176" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="176" y1="24" x2="176" y2="56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="80" y1="24" x2="80" y2="56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="40" y1="88" x2="216" y2="88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><circle cx="128" cy="132" r="8"/><circle cx="172" cy="132" r="8"/><circle cx="84" cy="172" r="8"/><circle cx="128" cy="172" r="8"/><circle cx="172" cy="172" r="8"/></svg>
                                {{ $this->fiesta?->f_end_date->format('F j, Y') }}
                            </span>


                        </div>

                        <div class="flex items-center gap-x-5">
                            <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                href="#">
                                <span
                                    class="max-w-40 truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-lg text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-500">{{
                                    Str::title($this->fiesta->category->cat_name) }}</span>

                            </a>
                            <p class="text-xs text-gray-800 sm:text-sm dark:text-neutral-200">{{
                                Str::title($this->fiesta->created_at->diffForHumans()) }}</p>
                        </div>

                        @php
                        $images = array_slice($this->fiesta->f_images, 0, 3);
                        $count = count($images);
                        @endphp

                        @if(!empty($images))
                        <div class="text-center cursor-pointer" aria-haspopup="dialog" aria-expanded="false"
                            aria-controls="hs-slide-down-animation-modal"
                            data-hs-overlay="#hs-slide-down-animation-modal">
                            @if(count($images) === 3)
                            <div class="grid gap-3 lg:grid-cols-2">
                                <div class="grid grid-cols-2 gap-3 lg:grid-cols-1">
                                    @foreach(array_slice($images, 0, 2) as $index => $image)
                                    <figure class="relative w-full h-60" wire:key='{{ $index . ' -' . 'image' }}'>
                                        <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                            src="{{ asset('storage/' . $image) }}" alt="{{ $this->fiesta->f_name }}">
                                    </figure>
                                    @endforeach
                                </div>
                                <figure class="relative w-full h-72 sm:h-96 lg:h-full">
                                    <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                        src="{{ asset('storage/' . $images[2]) }}" alt="{{ $this->fiesta->f_name }}">
                                </figure>
                            </div>
                            @elseif(count($images) === 2)
                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                @foreach($images as $index => $image)
                                <figure class="relative w-full h-72" wire:key='{{ $index . ' -' . 'image' }}'>
                                    <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                        src="{{ asset('storage/' . $image) }}" alt="{{ $this->fiesta->f_name }}">
                                </figure>
                                @endforeach
                            </div>
                            @elseif(count($images) === 1)
                            <div class="w-full">
                                <figure class="relative w-full h-72 sm:h-96">
                                    <img class="absolute top-0 object-cover size-full start-0 rounded-xl"
                                        src="{{ asset('storage/' . $images[0]) }}" alt="{{ $this->fiesta->f_name }}">
                                </figure>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!--MODAL -->
                        <div id="hs-slide-down-animation-modal"
                            class="fixed top-0 hidden overflow-x-hidden overflow-y-auto pointer-events-none hs-overlay size-full start-0 z-80"
                            role="dialog" tabindex="-1" aria-labelledby="hs-slide-down-animation-modal-label">
                            <div
                                class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:max-w-xl sm:w-full sm:mx-auto">
                                <div
                                    class="flex flex-col bg-white border border-gray-200 pointer-events-auto shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                    @if(!empty($images))
                                    <div
                                        class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-neutral-700">
                                        <h3 id="hs-slide-down-animation-modal-label"
                                            class="font-bold text-gray-800 dark:text-white">
                                            {{ $this->fiesta->f_name }}
                                        </h3>
                                        <button type="button"
                                            class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                            aria-label="Close" data-hs-overlay="#hs-slide-down-animation-modal">
                                            <span class="sr-only">{{ __('Close') }}</span>
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6 6 18"></path>
                                                <path d="m6 6 12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 overflow-y-auto">
                                        <!-- Slider -->
                                        <div data-hs-carousel='{
                                        "isAutoHeight": true,
                                        "loadingClasses": "opacity-0"
                                    }' class="relative">
                                            <div
                                                class="relative w-full overflow-hidden bg-white rounded-xl hs-carousel min-h-96">
                                                <div
                                                    class="absolute top-0 bottom-0 flex transition-transform duration-700 opacity-0 hs-carousel-body start-0 flex-nowrap">
                                                    @foreach($images as $index => $image)
                                                    <div class="hs-carousel-slide">
                                                        <div
                                                            class="flex justify-center h-full bg-gray-100 dark:bg-neutral-900">
                                                            <div class="bg-white">
                                                                <img class="object-cover w-full h-[400px]"
                                                                    src="{{ asset('storage/' . $image) }}"
                                                                    alt="{{ $this->fiesta->f_name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <div
                                                    class="absolute w-full overflow-x-auto hs-carousel-pagination bottom-3 start-0">
                                                    <div class="flex flex-row items-center px-2 gap-x-2">
                                                        @foreach($images as $index => $image)
                                                        <div
                                                            class="hs-carousel-pagination-item shrink-0 border border-gray-200 rounded-md overflow-hidden cursor-pointer w-37.5 h-12.5 hs-carousel-active:border-orange-400 dark:border-neutral-700 shadow-md">
                                                            <div
                                                                class="flex justify-center h-full bg-gray-100 dark:bg-neutral-900 ">
                                                                <img class="object-cover w-full h-12"
                                                                    src="{{ asset('storage/' . $image) }}"
                                                                    alt="{{ $this->fiesta->f_name }}">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <button type="button"
                                                    class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                                    <span class="text-2xl" aria-hidden="true">
                                                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="m15 18-6-6 6-6"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="sr-only">{{ __('Previous') }}</span>
                                                </button>
                                                <button type="button"
                                                    class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                                    <span class="sr-only">{{ __('Next') }}</span>
                                                    <span class="text-2xl" aria-hidden="true">
                                                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="m9 18 6-6-6-6"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Slider -->
                                    </div>
                                    @else
                                    <p class="text-gray-800 dark:text-neutral-200">{{ __('No image')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--END OF MODAL -->

                        <div class="text-gray-600 max-w-none dark:text-neutral-200">
                            {!! str( $this->fiesta->f_description)->sanitizeHtml() !!}
                        </div>

                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-y-5 lg:gap-y-0">
                            <!-- Badges/Tags -->
                            <div>
                                @forelse ($this->fiesta->tags ?? [] as $tag)
                                    <a class="m-0.5 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                        href="#">
                                        {{ Str::ucfirst($tag->tag_name) }}
                                    </a>
                                @empty
                                    <span class="text-gray-500 dark:text-neutral-400">{{ __('No tags') }}</span>
                                @endforelse


                            </div>
                            <!-- End Badges/Tags -->

                            <div class="flex justify-end items-center gap-x-1.5">
                                <!-- Button -->
                                <div class="inline-block hs-tooltip">
                                    <button type="button"
                                        class="flex items-center text-sm text-gray-500 hs-tooltip-toggle gap-x-2 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                                        </svg>
                                        875
                                        <span
                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible shadow-2xs dark:bg-black"
                                            role="tooltip">
                                            Like
                                        </span>
                                    </button>
                                </div>
                                <!-- Button -->

                                <div class="block h-3 mx-3 border-gray-300 border-e dark:border-neutral-600"></div>

                                <!-- Button -->
                                <div class="inline-block hs-tooltip">
                                    <button type="button"
                                        class="flex items-center text-sm text-gray-500 hs-tooltip-toggle gap-x-2 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
                                        </svg>
                                        16
                                        <span
                                            class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded-md opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible shadow-2xs dark:bg-black"
                                            role="tooltip">
                                            Comment
                                        </span>
                                    </button>
                                </div>
                                <!-- Button -->

                                <div class="block h-3 mx-3 border-gray-300 border-e dark:border-neutral-600"></div>

                                <!-- Button -->
                                <div class="relative inline-flex hs-dropdown">
                                    <button id="hs-blog-article-share-dropdown" type="button"
                                        class="flex items-center text-sm text-gray-500 hs-dropdown-toggle gap-x-2 hover:text-gray-800 focus:outline-hidden focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                            <polyline points="16 6 12 2 8 6" />
                                            <line x1="12" x2="12" y1="2" y2="15" />
                                        </svg>
                                        Share
                                    </button>
                                    <div class="hs-dropdown-menu w-56 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mb-1 z-10 bg-gray-900 shadow-md rounded-xl p-2 dark:bg-black"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="hs-blog-article-share-dropdown">
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                                <path
                                                    d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                            </svg>
                                            Copy link
                                        </a>
                                        <div class="my-2 border-t border-gray-600 dark:border-neutral-800"></div>
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                            </svg>
                                            Share on Twitter
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                            </svg>
                                            Share on Facebook
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-hidden focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
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
                </div>
                <!-- END OF MAIN CONTENT -->

                <!-- COMMENT SECTION -->
                <livewire:components.fiesta-review :fiesta="$this->fiesta">
                    <!-- END OF COMMENT SECTION -->


            </div>
            <!-- End Content -->

            <!-- Sidebar -->
            <div
                class="lg:col-span-1 lg:w-full lg:h-full lg:bg-linear-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
                <div class="sticky top-0 py-8 start-0 lg:ps-8">
                    <!-- Avatar Media -->
                    <div
                        class="flex items-center pb-8 mb-8 border-b border-gray-200 group gap-x-3 dark:border-neutral-700">
                        <a class="block shrink-0 focus:outline-hidden" href="#">
                            <img class="rounded-full size-10"
                                src="https://avatar.iran.liara.run/username?username={{ $this->fiesta->user?->name }}"
                                alt="{{ $this->fiesta->user->name }}">
                        </a>

                        <a class="block group grow focus:outline-hidden" href="">
                            <h5
                                class="text-sm font-semibold text-gray-800 group-hover:text-gray-600 group-focus:text-gray-600 dark:group-hover:text-neutral-400 dark:group-focus:text-neutral-400 dark:text-neutral-200">
                                {{ $this->fiesta->user->name }}
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-neutral-500">
                                {{ $this->fiesta->user?->name }}
                            </p>
                        </a>

                    </div>
                    <!-- End Avatar Media -->
                    @if(!empty($this->relatedFiesta))
                    <div class="space-y-6">
                        @forelse ($this->relatedFiesta as $getRelatedFiesta)

                        <!-- Media -->
                        <a class="flex items-center group gap-x-6 focus:outline-hidden"
                            href="{{ route('fiesta-eventos-single.page', $getRelatedFiesta->f_slug) }}">
                            <div class="grow">
                                <span
                                    class="text-sm font-bold text-gray-800 group-hover:text-orange-600 group-focus:text-orange-600 dark:text-neutral-200 dark:group-hover:text-orange-500 dark:group-focus:text-orange-500">
                                    {{ Str::title($getRelatedFiesta->f_title) }}
                                </span>
                            </div>

                            <div class="relative overflow-hidden rounded-lg shrink-0 size-20">
                                <img class="absolute top-0 object-cover rounded-lg size-full start-0"
                                    src="{{ asset('storage/' . $getRelatedFiesta->f_images[0]) }}"
                                    alt="{{ $getRelatedFiesta->f_slug }}">
                            </div>
                        </a>
                        <!-- End Media -->

                        @empty
                        <div class="mx-auto text-center text-gray-800 dark:text-neutral-200">
                            <h4 class="font-bold">{{ __('No fiestas related found') }}</h4>
                        </div>
                        @endforelse

                    </div>
                    @endif

                    <div class="lg:mt-8 ">
                        <div>
                            <h1 class="mb-5 text-lg font-bold lg:mb-8 lg:text-3xl dark:text-white">{{ __('Event
                                Reviews') }}</h1>

                            <!-- Header -->
                            <div class="flex items-center justify-between mb-3 gap-x-3">
                                <div class="flex items-center gap-x-2">
                                    <h4 class="font-semibold text-gray-800 dark:text-white">
                                        5.0
                                    </h4>

                                    <!-- Rating -->
                                    <div class="flex">
                                        <svg class="text-orange-400 shrink-0 size-4 dark:text-orange-600"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                        <svg class="text-orange-400 shrink-0 size-4 dark:text-orange-600"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                        <svg class="text-orange-400 shrink-0 size-4 dark:text-orange-600"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                        <svg class="text-orange-400 shrink-0 size-4 dark:text-orange-600"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                        <svg class="text-orange-400 shrink-0 size-4 dark:text-orange-600"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                            </path>
                                        </svg>
                                    </div>
                                    <!-- End Rating -->
                                </div>

                                <a class="inline-flex items-center text-xs font-medium text-orange-600 gap-x-1 decoration-2 hover:underline"
                                    href="#">
                                    See all (4)
                                </a>
                            </div>
                            <!-- End Header -->

                            <div class="mb-3">
                                @foreach ([5 => '🤩', 4 => '😁', 3 => '😐️', 2 => '😔', 1 => '😠'] as $star => $emoji)
                                <div wire:key="star-{{ $star }}"
                                    class="flex items-center mb-1 gap-x-3 whitespace-nowrap">
                                    <div class="w-14 text-end">
                                        <span class="text-sm text-gray-800 dark:text-white">{{ $emoji }} {{ $star }}
                                            star</span>
                                    </div>
                                    <div class="flex w-full h-2 overflow-hidden bg-gray-200 rounded-full dark:bg-neutral-700"
                                        role="progressbar" aria-valuenow="{{ $this->ratingStats[$star]['percentage'] }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <div class="flex flex-col justify-center overflow-hidden text-xs text-center text-white transition duration-500 bg-orange-400 rounded-full whitespace-nowrap dark:bg-orange-600"
                                            style="width: {{ $this->ratingStats[$star]['percentage'] }}%"></div>
                                    </div>
                                    <div class="w-14 text-end">
                                        <span class="text-sm text-gray-800 dark:text-white">
                                            {{ $this->ratingStats[$star]['percentage'] }}%
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @if(!@empty($this->fiesta->barangay))
                        <div class="lg:mt-8 ">
                            <h1 class="mb-5 text-lg font-bold lg:mb-8 lg:text-3xl dark:text-white">{{ __('Event Host')
                                }}</h1>
                            <div class="space-y-6">
                                <div
                                    class="flex flex-col items-center align-middle md:justify-start md:flex-row s-center gap-x-3">
                                    <img src="{{ asset(Storage::url($this->fiesta->barangay->brgy_logo)) ?? '' }}"
                                        alt="{{ $this->fiesta->barangay->brgy_name }}"
                                        class="object-cover w-16 h-16 rounded-full grow-0">
                                    <h2 class="text-2xl font-bold text-neutral-800 dark:text-white">{{
                                        $this->fiesta->barangay->brgy_name }}</h2>
                                </div>
                                <div class="text-gray-600 dark:text-neutral-200">
                                    <p class="mb-2"> {!! Str::limit($this->fiesta->barangay->brgy_desc, 300, '...') !!}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                <!-- End Sidebar -->
            </div>
        </div>
        <!-- End Blog Article -->
    </div>
