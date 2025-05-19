<div>
    {{-- @dd($fiesta_top_content) --}}
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        @if(!empty($fiesta_top_content))
        <!-- Grid -->
        <div class="grid sm:grid-cols-2 sm:items-center gap-8">
            <div class="sm:order-2">
                <div class="relative pt-[50%] sm:pt-[100%] rounded-lg">
                    @if(!empty($fiesta_top_content) && !empty($fiesta_top_content->f_images[0]))
                    <img class="size-full absolute top-0 start-0 object-cover rounded-xl h-[250px] lg:h-[600px] xxl:h-[500px]" src="{{ asset(Storage::url($fiesta_top_content->f_images[0])) }}" alt="{{ $fiesta_top_content->f_title }}">
                    @else
                    <p class="text-gray-800 dark:text-neutral-200">{{ __('No image')}}</p>
                    @endif
                </div>
            </div>
            <!-- End Col -->

            <div class="sm:order-1">

                <span class="mb-5 inline-flex items-center max-w-40 truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-lg text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-500">{{ Str::title($fiesta_top_content->category->cat_name) }}</span>

                <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl lg:leading-tight xl:text-5xl xl:leading-tight text-gray-800 dark:text-neutral-200">
                    <a class="hover:text-orange-600 focus:outline-hidden focus:text-orange-600 dark:text-neutral-300 dark:hover:text-white dark:focus:text-white" href="{{ route('fiesta-eventos-single.page', $fiesta_top_content->f_slug) }}">
                        {{ $fiesta_top_content->f_name }}
                    </a>
                </h2>

                <!-- Avatar -->
                <div class="mt-6 sm:mt-10 flex items-center">
                    <div class="shrink-0">
                    <img class="size-10 sm:h-14 sm:w-14 rounded-full" src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Blog Image">
                    </div>

                    <div class="ms-3 sm:ms-4">
                    <p class="sm:mb-1 font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $fiesta_top_content->user->name . ' (' . $fiesta_top_content->user->email .')' ?? '' }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-500">
                        {{ __('Author') }}
                    </p>
                    </div>
                </div>
                <!-- End Avatar -->

                <div class="mt-5">
                    <a class="inline-flex items-center gap-x-1.5 text-orange-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-orange-500" href="{{ route('fiesta-eventos-single.page', $fiesta_top_content->f_slug) }}">
                     {{ __('Read more') }}
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
        @endif

        <!--BLOG CONTENT CARDS-->
        <!-- Grid -->
        <div class="grid lg:grid-cols-2 gap-6 mt-7 md:mt-10 lg:mt-14">

            @forelse ($fiestas as $fiesta)
            <!-- Card -->
            <a wire:key='{{ $fiesta->id . '-' .  $fiesta->f_name }}' class="group relative block rounded-xl focus:outline-hidden" href="{{ route('fiesta-eventos-single.page', $fiesta->f_slug) }}">
                <div class="shrink-0 relative rounded-xl overflow-hidden w-full h-87.5 before:absolute before:inset-x-0 before:z-1 before:size-full before:bg-linear-to-t before:from-gray-900/70">
                    <img class="size-full absolute top-0 start-0 object-cover" src="{{ asset('storage/' . $fiesta->f_images[0]) }}" alt="{{ $fiesta->f_name }}">
                </div>

                <div class="absolute top-0 inset-x-0 z-10">
                    <div class="p-4 flex flex-col h-full sm:p-6">
                    <!-- Avatar -->
                    <div class="flex items-center">
                        <div class="shrink-0">
                        <img class="size-11 border-2 border-white rounded-full" src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
                        </div>
                        <div class="ms-2.5 sm:ms-4">
                        <h4 class="font-semibold text-white">
                            {{ $fiesta->user?->name }}
                        </h4>
                        <p class="text-xs text-white/80">
                            {{ Str::title($fiesta->created_at->diffForHumans()) }}
                        </p>
                        </div>
                    </div>
                    <!-- End Avatar -->
                    </div>
                </div>

                <div class="absolute bottom-0 inset-x-0 z-10">
                    <div class="flex flex-col h-full p-4 sm:p-6">
                    <h3 class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/80 group-focus:text-white/80">
                        {{ $fiesta->f_name }}
                    </h3>
                    <p class="mt-2 text-white/80">
                        {{ $fiesta->strip_content }}
                    </p>
                    </div>
                </div>
            </a>
            <!-- End Card -->

            @empty
                <div class="text-gray-800 dark:text-neutral-200 w-lg mx-auto text-center">
                    <h2 class="text-3xl font-bold">{{ __('No fiestas found') }}</h2>
                </div>
            @endforelse

        </div>
        <!-- End Grid -->
        <!--END OF CONTENT CARDS-->
    </div>
    <!-- End Card Blog -->

</div>
