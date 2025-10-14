<div>
    <!-- Icon Blocks -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="text-center">
            <h2 class="text-lg sm:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                {{ __('Barangays') }}
            </h2>

            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos reiciendis accusamus dolores tenetur harum laudantium!
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 items-center gap-6 md:gap-10 pt-9">
            @forelse ($this->barangays as $barangay)
             <!-- Card -->
            <div wire:key='{{ $barangay->id . '-' . $barangay->brgy_slug }}' class="size-full bg-white shadow-lg rounded-2xl p-5 dark:bg-neutral-900">
                <a href="{{ route('barangay-single.page', $barangay->brgy_slug) }}">
                <div class="flex items-center gap-x-4 mb-3">
                    <div
                        class="inline-flex justify-center items-center size-15.5 rounded-full border-4 border-orange-50 bg-orange-100 dark:border-orange-900 dark:bg-orange-800">
                        <img class="shrink-0 size-14 object-fit-cover" src="{{ asset(Storage::url($barangay->brgy_logo)) }}" alt="{{ $barangay->brgy_name }}">
                    </div>
                    <div class="shrink-0">
                        <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">{{ $barangay->brgy_name }}</h3>
                    </div>
                </div>
                <div class="text-gray-600 dark:text-neutral-400">{!! Str::limit($barangay->brgy_desc, 100, '...') !!}</div>
                </a>
            </div>
            <!-- End Card -->
            @empty
                <span>No barangays</span>
            @endforelse


        </div>
    </div>
    <!-- End Icon Blocks -->
</div>
