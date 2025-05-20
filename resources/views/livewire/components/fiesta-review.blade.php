<!-- Comment Form -->
<div class="px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
    <div class="max-w-2xl mx-auto">
      <div class="text-center">
        <h2 class="text-xl font-bold text-gray-800 sm:text-3xl dark:text-white">
          {{ __('Leave a review') }}
        </h2>
      </div>

      <!-- Card -->
      <div class="relative z-10 p-4 mt-5 bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        @if(auth()->check())
        <form wire:submit.prevent="submitReview"
            x-data="dropzoneHandler()"
            x-on:drop.prevent="dropFiles($event)"
            x-on:dragover.prevent
            enctype="multipart/form-data"
            class="space-y-4">


            <div>
                <!-- Rate review -->
                <div class="text-center">
                    <h3 class="text-gray-800 dark:text-white">
                        {{ __('Did you like this event?') }}
                    </h3>

                    <!-- Rating -->
                    <div class="mt-2 flex justify-center items-center space-x-2">
                        @foreach ([1 => '😠', 2 => '😔', 3 => '😐️', 4 => '😁', 5 => '🤩'] as $rate => $emoji)
                            <button
                                type="button"
                                wire:click="$set('rating', {{ $rate }})"
                                class="size-10 inline-flex justify-center items-center text-2xl rounded-full transition
                                    {{ $rating === $rate ? 'bg-orange-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-neutral-700' }}">
                                {{ $emoji }}
                            </button>
                        @endforeach
                    </div>

                    @error('rating')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <!-- End Rating -->

                </div>
                <!-- End Rate review -->
            </div>

            <!-- Review -->
            <div>
                <label class="block mb-2 text-sm font-medium dark:text-white">Comment</label>
                <textarea wire:model.blur="review"
                        rows="5"
                        class="block w-full px-4 py-3 text-sm border-1  rounded-lg focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-400 dark:text-neutral-400 border-neutral-800"
                        placeholder="Leave your review comment here..."></textarea>
                @error('review') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Dropzone Alpine Component -->
            <div
                x-data="{
                    dragging: false,
                    isUploading: false,
                    progress: 0,
                    remove(index) {
                        @this.call('removeTempImage', index);
                    }
                }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >

                <!-- Dropzone -->
                <div
                    class="w-full p-6 border-2 border-dashed border-neutral-800 dark:border-neutral-600 rounded-lg text-center cursor-pointer bg-white hover:bg-neutral-200 dark:hover:bg-neutral-700 transition dark:bg-neutral-800"
                    :class="{ 'border-orange-500': dragging }"
                    x-ref="dropzone"
                    x-on:dragenter="dragging = true"
                    x-on:dragleave="dragging = false"
                    x-on:drop="dragging = false"
                    x-on:click="$refs.fileInput.click()"
                >
                    <input type="file" wire:model="review_images" multiple accept="image/*"
                        class="hidden" x-ref="fileInput" @change="$refs.fileInput.dispatchEvent(new Event('input', { bubbles: true }))">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        {{ __('Drag & drop images or click to upload') }}
                    </p>
                </div>

                <!-- Previews -->
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($review_images as $index => $img)
                        <div class="relative group w-20 h-20">
                            <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover border dark:border-gray-200 border-gray-400 rounded">
                            <!-- Close Icon -->
                            <button type="button"
                                class="absolute top-0 right-0 bg-black bg-opacity-50 text-white text-xs rounded-bl px-1 py-0.5 hidden group-hover:block"
                                x-on:click.prevent="remove({{ $index }})">

                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Upload Progress -->
                <div x-show="isUploading" class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                        <div class="bg-orange-600 h-2 rounded-full transition-all duration-200"
                            :style="`width: ${progress}%`"></div>
                    </div>
                    <p class="text-xs mt-1 text-orange-600">{{ __('Uploading...') }} <span x-text="progress"></span>{{ __('%') }}</p>
                </div>

                <!-- Error Message -->
                @error('review_images.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 rounded-lg">

                    <svg class="shrink-0 size-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>

                    {{ __('Submit Review') }}
            </button>
        </form>
        @else
        <p>
            <div class="flex flex-row items-center justify-center">
                <div class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-orange-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                </div>


                <div class="text-gray-800 dark:text-neutral-400">
                    {{ __('Please') }} <a class="mx-4 font-medium text-orange-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-orange-500" href="{{ route('filament.auth.auth.login') }}">{{ __('login') }}</a> {{ __('to write a review') }}
                </div>
            </div>
        </p>
        @endif

      </div>
      <!-- End Card -->

      <div class="mt-5 lg:mt-7 comments-section">
        <h4 class="my-4 text-xl font-bold text-neutral-900 dark:text-white">Review/s ({{ $reviews->count() }})</h4>

        @forelse($reviews as $review)
        <div class="mb-4 comment">
            <strong class="text-gray-900 dark:text-white">{{ $review->user->name }}</strong>
            <p class="mb-3 ml-5 text-gray-800 lg:ml-8 dark:text-neutral-400">{{ $review->comment }}</p>

           <div class="flex flex-row flex-wrap gap-2 ml-5 lg:ml-8">
                @foreach (json_decode($review->review_images, true) as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Comment Image"
                        class="w-20 h-20 object-cover border rounded">
                @endforeach
            </div>


            <small class="py-4 ml-5 text-xs text-gray-500 lg:ml-8 dark:text-neutral-500">
                <div class="flex flex-row items-center justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ $review->created_at->diffForHumans() }}
                </div>
            </small>

            <hr class="my-4">
        </div>
        @empty
            <p class="text-gray-800 dark:text-neutral-400">{{ __('No reviews yet') }}</p>
        @endforelse


    </div>
    </div>
</div>
<!-- End Comment Form -->
