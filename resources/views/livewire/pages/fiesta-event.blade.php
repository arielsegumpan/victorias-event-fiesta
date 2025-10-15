<div>
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        @if(!empty($this->fiestaTopContent))
        <!-- Grid -->
        <div class="grid gap-8 sm:grid-cols-2 sm:items-center ">
            <div class="sm:order-2">
                <div class="relative pt-[30%] sm:pt-[70%] rounded-md">
                    @if(!empty($this->fiestaTopContent) && !empty($this->fiestaTopContent->f_images[0]))
                    <img class="size-full absolute top-0 start-0 object-cover rounded-2xl h-[250px] lg:h-[450px] xxl:h-[450px]" src="{{ asset(Storage::url($this->fiestaTopContent->f_images[0])) }}" alt="{{ $this->fiestaTopContent->f_title }}">
                    @else
                    <p class="text-gray-800 dark:text-neutral-200">{{ __('No image')}}</p>
                    @endif
                </div>
            </div>
            <!-- End Col -->

            <div class="sm:order-1">

                <span class="mb-5 inline-flex items-center max-w-40 truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-500">{{ Str::title($this->fiestaTopContent->category->cat_name) }}</span>

                <h2 class="text-2xl font-bold text-gray-800 md:text-3xl lg:text-4xl lg:leading-tight xl:text-5xl xl:leading-tight dark:text-neutral-200">
                    <a class="hover:text-orange-600 focus:outline-hidden focus:text-orange-600 dark:text-neutral-300 dark:hover:text-white dark:focus:text-white" href="{{ route('fiesta-eventos-single.page', $this->fiestaTopContent->f_slug) }}">
                        {{ $this->fiestaTopContent->f_name }}
                    </a>
                </h2>

                <!-- Avatar -->
                <div class="flex items-center mt-6 sm:mt-10">
                    <div class="shrink-0">
                    <img class="rounded-md size-10 sm:h-14 sm:w-14" src="https://avatar.iran.liara.run/username?username={{ $this->fiestaTopContent->user->name }}" alt="{{ $this->fiestaTopContent->user->name }}">
                    </div>

                    <div class="ms-3 sm:ms-4">
                    <p class="font-semibold text-gray-800 sm:mb-1 dark:text-neutral-200">
                        {{ $this->fiestaTopContent->user->name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-500">
                        {{ $this->fiestaTopContent->user->email }}
                    </p>
                    </div>
                </div>
                <!-- End Avatar -->

                <div class="mt-5">
                    <a class="inline-flex items-center gap-x-1.5 text-orange-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-orange-500" href="{{ route('fiesta-eventos-single.page', $this->fiestaTopContent->f_slug) }}">
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
        <div class="grid gap-6 lg:grid-cols-2 mt-7 md:mt-10 lg:mt-14">

            @forelse ($this->fiestas as $fiesta)
            <!-- Card -->
            <a wire:key='{{ $fiesta->id . '-' .  $fiesta->f_name }}' class="relative block rounded-md group focus:outline-hidden" href="{{ route('fiesta-eventos-single.page', $fiesta->f_slug) }}">
                <div class="shrink-0 relative rounded-md overflow-hidden w-full h-87.5 before:absolute before:inset-x-0 before:z-1 before:size-full before:bg-linear-to-t before:from-gray-900/70">
                    <img class="absolute top-0 object-cover size-full start-0 rounded-2xl" src="{{ asset('storage/' . $fiesta->f_images[0]) }}" alt="{{ $fiesta->f_name }}">
                </div>

                <div class="absolute inset-x-0 top-0 z-10">
                    <div class="flex flex-col h-full p-4 sm:p-6">
                    <!-- Avatar -->
                    <div class="flex items-center">
                        <div class="shrink-0">
                        <img class="border-none rounded-md size-11" src="https://avatar.iran.liara.run/username?username={{ $fiesta->user?->name }}" alt="{{ $fiesta->user?->name }}">
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

                <div class="absolute inset-x-0 bottom-0 z-10">
                    <div class="flex flex-col h-full p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-white sm:text-3xl group-hover:text-white/80 group-focus:text-white/80">
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
                <div class="mx-auto text-center col-span-2 text-gray-800 dark:text-neutral-200 w-lg">
                    <div class="max-w-2xl text-center mx-auto">
                        <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl dark:text-white">
                            {{ __('No fiesta is created') }}
                        </h1>
                        <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400"> {{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos reiciendis accusamus dolores tenetur harum laudantium!') }} </p>
                    </div>
                </div>

                <div class="col-span-2">
                    <img src="{{ asset('imgs/fiesta-404.jpg') }}" alt="" class="w-full object-cover h-96 sm:h-80 rounded-lg">
                </div>

            @endforelse

        </div>
        <!-- End Grid -->
        <!--END OF CONTENT CARDS-->
    </div>
    <!-- End Card Blog -->

</div>
