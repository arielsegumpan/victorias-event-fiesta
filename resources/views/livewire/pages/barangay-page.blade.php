<div>
    <!-- Icon Blocks -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="text-center">
            <h2 class="text-lg sm:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                {{ __('Barangays') }}
            </h2>

            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos reiciendis accusamus dolores tenetur harum
                laudantium!
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 items-center gap-6 md:gap-10 pt-9">
            @forelse ($this->barangays as $barangay)
            <!-- Card -->
            <div wire:key='{{ $barangay->id . ' -' . $barangay->brgy_slug }}' class="size-full bg-white shadow-lg
                rounded-2xl p-5 dark:bg-neutral-900">
                <a href="{{ route('barangay-single.page', $barangay->brgy_slug) }}">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div
                            class="inline-flex justify-center items-center ">
                            <img class="size-12 object-fit-cover"
                                src="{{ asset(Storage::url($barangay->brgy_logo)) }}" alt="{{ $barangay->brgy_name }}">
                        </div>
                        <div class="shrink-0">
                            <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">{{
                                $barangay->brgy_name }}
                            </h3>

                            <div class="flex flex-row mt-1 items-center justify-start">
                                @if(!empty($barangay->brgy_email))
                                <a href="{{ $barangay->brgy_email }}" class="me-2">
                                    <svg class="shrink-0 size-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M32,56H224a0,0,0,0,1,0,0V192a8,8,0,0,1-8,8H40a8,8,0,0,1-8-8V56A0,0,0,0,1,32,56Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><polyline points="224 56 128 144 32 56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/></svg>
                                </a>
                                @endif
                                @if(!empty($barangay->brgy_facebook))
                                <a href="" class="me-2">
                                    <svg class="shrink-0 size-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><path d="M168,88H152a24,24,0,0,0-24,24V224" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><line x1="96" y1="144" x2="160" y2="144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/></svg>
                                </a>
                                @endif
                                @if(!empty($barangay->brgy_twitter))
                                <a href="" class="me-2">
                                    <svg class="shrink-0 size-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M88,176S32.85,144,40.78,56c0,0,39.66,40,87.22,48V88c0-22,18-40.27,40-40a40.74,40.74,0,0,1,36.67,24H240l-32,32c-4.26,66.84-60.08,120-128,120-32,0-40-12-40-12S72,200,88,176Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/></svg>
                                </a>
                                @endif
                                @if(!empty($barangay->brgy_instagram))
                                <a href="" class="me-2">
                                    <svg class="shrink-0 size-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><circle cx="128" cy="128" r="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><rect x="32" y="32" width="192" height="192" rx="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><circle cx="180" cy="76" r="8"/></svg>
                                </a>
                                @endif
                                @if(!empty($barangay->brgy_youtube))
                                <a href="" class="me-2">
                                    <svg class="shrink-0 size-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="160 128 112 96 112 160 160 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/><path d="M24,128c0,29.91,3.07,47.45,5.41,56.47A16,16,0,0,0,39,195.42C72.52,208.35,128,208,128,208s55.48.35,89-12.58a16,16,0,0,0,9.63-10.95c2.34-9,5.41-26.56,5.41-56.47s-3.07-47.45-5.41-56.47a16,16,0,0,0-9.63-11C183.48,47.65,128,48,128,48s-55.48-.35-89,12.58a16,16,0,0,0-9.63,11C27.07,80.54,24,98.09,24,128Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/></svg>
                                </a>
                                @endif
                                @if(!empty($barangay->brgy_tiktok))
                                <a href="" class="me-2">
                                    <svg class="shrink-0 size-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M168,102a95.55,95.55,0,0,0,56,18V80a56,56,0,0,1-56-56H128V156a28,28,0,1,1-40-25.31V88c-31.83,5.67-56,34.54-56,68a68,68,0,0,0,136,0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/></svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-gray-600 dark:text-neutral-400">{!! Str::limit($barangay->brgy_desc, 100, '...')
                        !!}</div>

                    <div class="flex -space-x-2 mt-5">
                        @forelse ($barangay->brgy_img_gallery as $key => $img_gallery)
                            <img wire:key='{{ $key }}' class="inline-block size-11 rounded-full ring-2 ring-white dark:ring-neutral-900"
                            src="{{ asset(Storage::url($img_gallery)) }}"
                            alt="{{ $barangay->brgy_name }}">

                        @empty
                            <span class="text-gray-600 dark:text-neutral-400 text-center mx-atuo">{{ __('No barangay images') }}</span>
                        @endforelse

                    </div>
                </a>
            </div>
            <!-- End Card -->
            @empty
            <span class="mx-auto text-center">No barangays</span>
            @endforelse


        </div>
    </div>
    <!-- End Icon Blocks -->
</div>
