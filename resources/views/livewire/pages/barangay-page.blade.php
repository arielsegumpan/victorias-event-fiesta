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
                            class="inline-flex justify-center items-center size-15.5 rounded-full border-4 border-orange-50 bg-orange-100 dark:border-orange-900 dark:bg-orange-800">
                            <img class="shrink-0 size-14 object-fit-cover"
                                src="{{ asset(Storage::url($barangay->brgy_logo)) }}" alt="{{ $barangay->brgy_name }}">
                        </div>
                        <div class="shrink-0">
                            <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">{{
                                $barangay->brgy_name }}</h3>
                        </div>
                    </div>
                    <div class="text-gray-600 dark:text-neutral-400">{!! Str::limit($barangay->brgy_desc, 100, '...')
                        !!}</div>

                    <div class="flex -space-x-2 mt-5">
                        <img class="inline-block size-11 rounded-full ring-2 ring-white dark:ring-neutral-900"
                            src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
                            alt="Avatar">
                        <img class="inline-block size-11 rounded-full ring-2 ring-white dark:ring-neutral-900"
                            src="https://images.unsplash.com/photo-1531927557220-a9e23c1e4794?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
                            alt="Avatar">
                        <img class="inline-block size-11 rounded-full ring-2 ring-white dark:ring-neutral-900"
                            src="https://images.unsplash.com/photo-1541101767792-f9b2b1c4f127?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&&auto=format&fit=facearea&facepad=3&w=300&h=300&q=80"
                            alt="Avatar">
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
