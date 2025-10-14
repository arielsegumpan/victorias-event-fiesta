<div>
    <!-- Features -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="aspect-w-16 aspect-h-7">
            @if(!isset($this->displayFiestas))
            <img class="w-full object-cover rounded-md h-[350px] xxl:h-[280px]" src="{{ asset(Storage::url($this->displayFiestas[0]['f_images'][0])) }}" alt="{{ $this->displayFiestas[0]['f_name'] }}">
            @else
            <img class="w-full object-cover rounded-md h-[350px] xxl:h-[280px]" src="https://images.unsplash.com/photo-1506157786151-b8491531f063?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1740" alt="No Image">
            @endif
        </div>

        <!-- Grid -->
        <div class="grid gap-8 mt-5 lg:mt-16 lg:grid-cols-3 lg:gap-12">
        <div class="lg:col-span-1">
            <h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-neutral-200">
            We tackle the challenges start-ups face
            </h2>
            <p class="mt-2 text-gray-500 md:mt-4 dark:text-neutral-500">
            Besides working with start-up enterprises as a partner for digitalization, we have built enterprise products for common pain points that we have encountered in various products and projects.
            </p>
        </div>
        <!-- End Col -->

        <div class="lg:col-span-2">
            <div class="grid gap-8 sm:grid-cols-2 md:gap-12">
            <!-- Icon Block -->
            <div class="flex gap-x-5">
                <svg class="mt-1 text-orange-600 shrink-0 size-6 dark:text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="10" x="3" y="11" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><line x1="8" x2="8" y1="16" y2="16"/><line x1="16" x2="16" y1="16" y2="16"/></svg>
                <div class="grow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Creative minds
                </h3>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    We choose our teams carefully. Our people are the secret to great work.
                </p>
                </div>
            </div>
            <!-- End Icon Block -->

            <!-- Icon Block -->
            <div class="flex gap-x-5">
                <svg class="mt-1 text-orange-600 shrink-0 size-6 dark:text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                <div class="grow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Simple and affordable
                </h3>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    From boarding passes to movie tickets, there's pretty much nothing you can't store with Preline.
                </p>
                </div>
            </div>
            <!-- End Icon Block -->

            <!-- Icon Block -->
            <div class="flex gap-x-5">
                <svg class="mt-1 text-orange-600 shrink-0 size-6 dark:text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                <div class="grow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Industry-leading documentation
                </h3>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Our documentation and extensive Client libraries contain everything a business needs to build a custom integration.
                </p>
                </div>
            </div>
            <!-- End Icon Block -->

            <!-- Icon Block -->
            <div class="flex gap-x-5">
                <svg class="mt-1 text-orange-600 shrink-0 size-6 dark:text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <div class="grow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Designing for people
                </h3>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    We actively pursue the right balance between functionality and aesthetics, creating delightful experiences.
                </p>
                </div>
            </div>
            <!-- End Icon Block -->
            </div>
        </div>
        <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Features -->


    <!-- Features -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto mb-8 text-center lg:mb-14">
        <h2 class="text-3xl font-bold text-gray-800 lg:text-4xl dark:text-neutral-200">
        Explore tools
        </h2>
        <p class="mt-3 text-gray-800 dark:text-neutral-200">
        The powerful and flexible theme for all kinds of businesses.
        </p>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="grid max-w-3xl grid-cols-3 gap-6 mx-auto lg:gap-8">
        <!-- Icon Block -->
        <div class="text-center">
        <svg class="mx-auto text-gray-800 shrink-0 size-7 md:size-9 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="10" height="14" x="3" y="8" rx="2"/><path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4"/><path d="M8 18h.01"/></svg>
        <div class="mt-2 sm:mt-6">
            <h3 class="font-semibold text-gray-800 sm:text-lg dark:text-neutral-200">
            Responsive
            </h3>
        </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="text-center">
        <svg class="mx-auto text-gray-800 shrink-0 size-7 md:size-9 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg>
        <div class="mt-2 sm:mt-6">
            <h3 class="font-semibold text-gray-800 sm:text-lg dark:text-neutral-200">
            Customizable
            </h3>
        </div>
        </div>
        <!-- End Icon Block -->

        <!-- Icon Block -->
        <div class="text-center">
        <svg class="mx-auto text-gray-800 shrink-0 size-7 md:size-9 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
        <div class="mt-2 sm:mt-6">
            <h3 class="font-semibold text-gray-800 sm:text-lg dark:text-neutral-200">
            24/7 Support
            </h3>
        </div>
        </div>
        <!-- End Icon Block -->
    </div>
    <!-- End Grid -->

    <!-- Grid -->
    <div class="grid items-center grid-cols-2 gap-2 mt-10 sm:mt-20 md:grid-cols-4 sm:gap-6 lg:gap-8">
        <div class="w-full h-32">
        <img class="object-cover object-center rounded-md size-full" src="https://images.unsplash.com/photo-1606868306217-dbf5046868d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->

        <div class="w-full h-32">
        <img class="object-cover object-center rounded-md size-full" src="https://images.unsplash.com/photo-1587613991119-fbbe8e90531d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->

        <div class="w-full h-32">
        <img class="object-cover object-center rounded-md size-full" src="https://images.unsplash.com/photo-1554295405-abb8fd54f153?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->

        <div class="w-full h-32">
        <img class="object-cover object-center rounded-md size-full" src="https://images.unsplash.com/photo-1640622300473-977435c38c04?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->
    </div>
    <!-- End Grid -->
    </div>
    <!-- End Features -->

    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto mb-10 text-center lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Read our latest Fiesta and Event</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">We've helped some great companies brand, design and get to market.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid gap-6 mb-10 sm:grid-cols-2 lg:grid-cols-4 lg:mb-14">

            @foreach ($this->displayFiestas as $display_fiesta)

            <!-- Card -->
            <a class="flex flex-col transition bg-white border border-gray-200 rounded-md group shadow-2xs hover:shadow-md focus:outline-hidden focus:shadow-md dark:bg-neutral-900 dark:border-neutral-800" href="{{ route('fiesta-eventos-single.page', $display_fiesta->f_slug) }}">
                <div class="aspect-w-16 aspect-h-9">
                    <img class="w-full object-cover rounded-md lg:h-[200px] xl:h-[250px] h-[220px]" src="{{ asset(Storage::url($display_fiesta->f_images[0])) }}" alt="{{ $display_fiesta->f_name }}">
                </div>
                <div class="p-4 md:p-5">
                    <p class="mt-2 text-xs text-gray-600 uppercase dark:text-neutral-400">
                        {{ $display_fiesta->category->cat_name }}
                    </p>
                    <h3 class="mt-2 text-lg font-medium text-gray-800 group-hover:text-orange-600 dark:text-neutral-300 dark:group-hover:text-white">
                        {{ $display_fiesta->f_name }}
                    </h3>
                </div>
            </a>
            <!-- End Card -->

            @endforeach

        </div>
        <!-- End Grid -->

        <!-- Card -->
        <div class="text-center">
            <div class="inline-block bg-white border border-gray-200 rounded-md shadow-2xs dark:bg-neutral-900 dark:border-neutral-800">
            <div class="flex items-center px-4 py-3 gap-x-2">
                <p class="text-gray-600 dark:text-neutral-400">
                Want to read more?
                </p>
                <a class="inline-flex items-center gap-x-1.5 text-orange-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-orange-500" href="{{ route('fiesta-eventos.page') }}">
                Go here
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Blog -->

</div>
