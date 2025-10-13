<!-- Comment Form -->
<div class="px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
    <div class="max-w-2xl mx-auto">
      <div class="text-center">
        <h2 class="text-xl font-bold text-gray-800 sm:text-3xl dark:text-white">
          {{ __('Leave a review') }}
        </h2>
      </div>

      <!-- Card -->
      <div class="relative z-10 p-4 mt-5 bg-white border rounded-md sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
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
                    <div class="flex items-center justify-center mt-2">

                        <button type="button" class="inline-flex items-center justify-center text-2xl rounded-md size-10 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        😠
                        </button>

                        <button type="button" class="inline-flex items-center justify-center text-2xl rounded-md size-10 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        😔
                        </button>

                        <button type="button" class="inline-flex items-center justify-center text-2xl rounded-md size-10 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        😐️
                        </button>

                        <button type="button" class="inline-flex items-center justify-center text-2xl rounded-md size-10 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        😁
                        </button>

                        <button type="button" class="inline-flex items-center justify-center text-2xl rounded-md size-10 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        🤩
                        </button>

                    </div>
                    <!-- End Rating -->
                </div>
                <!-- End Rate review -->
            </div>

            <!-- Comment -->
            <div>
                <label class="block mb-2 text-sm font-medium dark:text-white">Comment</label>
                <textarea wire:model.blur="comment"
                        rows="5"
                        class="block w-full px-4 py-3 text-sm rounded-md border-1 focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-400 dark:text-neutral-400 border-neutral-800"
                        placeholder="Leave your comment here..."></textarea>
                @error('comment') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
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
                    class="w-full p-6 text-center transition bg-white border-2 border-dashed rounded-md cursor-pointer border-neutral-800 dark:border-neutral-600 hover:bg-neutral-200 dark:hover:bg-neutral-700 dark:bg-neutral-800"
                    :class="{ 'border-orange-500': dragging }"
                    x-ref="dropzone"
                    x-on:dragenter="dragging = true"
                    x-on:dragleave="dragging = false"
                    x-on:drop="dragging = false"
                    x-on:click="$refs.fileInput.click()"
                >
                    <input type="file" wire:model="comment_imgs" multiple accept="image/*"
                        class="hidden" x-ref="fileInput" @change="$refs.fileInput.dispatchEvent(new Event('input', { bubbles: true }))">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Drag & drop images or click to upload
                    </p>
                </div>

                <!-- Previews -->
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($comment_imgs as $index => $img)
                        <div class="relative w-20 h-20 group">
                            <img src="{{ $img->temporaryUrl() }}" class="object-cover w-full h-full border border-gray-400 rounded dark:border-gray-200">
                            <!-- Close Icon -->
                            <button type="button"
                                class="absolute top-0 right-0 bg-black bg-opacity-50 text-white text-xs rounded-md px-1 py-0.5 hidden group-hover:block"
                                x-on:click.prevent="remove({{ $index }})">
                                ✖
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Upload Progress -->
                <div x-show="isUploading" class="mt-2">
                    <div class="w-full h-2 bg-gray-200 rounded-md dark:bg-gray-700">
                        <div class="h-2 transition-all duration-200 bg-orange-600 rounded-md"
                            :style="`width: ${progress}%`"></div>
                    </div>
                    <p class="mt-1 text-xs text-orange-600">Uploading... <span x-text="progress"></span>%</p>
                </div>

                <!-- Error Message -->
                @error('comment_imgs.*')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-orange-600 rounded-md hover:bg-orange-700">

                    <svg class="mr-2 shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>

                    {{ __('Submit Comment') }}
            </button>
        </form>
        @else
        <p>
            <div class="flex flex-row items-center justify-center">
                <div class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-orange-500 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                </div>


                <div class="text-gray-800 dark:text-neutral-400">
                    Please <a class="mx-4 font-medium text-orange-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-orange-500" href="{{ route('filament.auth.auth.login') }}">login</a> to comment
                </div>
            </div>
        </p>
        @endif

      </div>
      <!-- End Card -->

      <div class="mt-5 lg:mt-7 comments-section">
        <h4 class="my-4 text-xl font-bold text-neutral-900 dark:text-white">Comments ({{ $comments->count() }})</h4>

        @forelse($comments as $comment)
        <div class="mb-4 comment">
            <strong class="text-gray-900 dark:text-white">{{ $comment->user->name }}</strong>
            <p class="mb-3 ml-5 text-gray-800 lg:ml-8 dark:text-neutral-400">{{ $comment->comment }}</p>

           <div class="flex flex-row flex-wrap gap-2 ml-5 lg:ml-8">
                @foreach (json_decode($comment->comment_imgs, true) as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Comment Image"
                        class="object-cover w-20 h-20 border rounded">
                @endforeach
            </div>


            <small class="py-4 ml-5 text-xs text-gray-500 lg:ml-8 dark:text-neutral-500">
                <div class="flex flex-row items-center justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </small>

            <hr class="my-4">
        </div>
        @empty
            <p class="text-gray-800 dark:text-neutral-400">{{ __('No comments yet') }}</p>
        @endforelse


    </div>
    </div>
</div>
<!-- End Comment Form -->
