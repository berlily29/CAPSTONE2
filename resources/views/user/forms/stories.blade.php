<x-app-layout>
    <div class="min-h-screen bg-white py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-4 text-center">
                <h1 class="text-3xl text-gray-600">Story for <strong class="font-black"> {{$event->title}}</strong></h1>
                <p class="text-gray-400">Share your moments with the community</p>
            </div>

            <!-- Story Form -->
            <form action="{{route('user.channel.stories.post')}}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
                @csrf

                <input type="text" name="event" value="{{$event->event_id}}" hidden>
                <!-- Image Upload Section -->
                <div class="mb-8">


                    <label class="block text-pink-600 font-medium mb-3">Story Image</label>
                    <div x-data="{ isUploading: false, preview: null }" class="relative group">
                        <!-- File Input -->
                        <input
                            type="file"
                            name="image"
                            id="image"
                            required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="
                                isUploading = true;
                                const file = $event.target.files[0];
                                preview = URL.createObjectURL(file);
                                isUploading = false;
                            "
                        >

                        <!-- Upload Box -->
                        <div class="border-2 border-dashed border-pink-200 rounded-xl p-6 text-center transition-all group-hover:border-pink-300">
                            <div x-show="!preview" class="space-y-3">
                                <div class="mx-auto text-pink-500">
                                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-pink-600 font-medium">Click to upload or drag and drop</p>
                                <p class="text-sm text-pink-400">PNG, JPG up to 5MB</p>
                            </div>

                            <!-- Preview -->
                            <div x-show="preview" class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                <img :src="preview" alt="Preview" class="object-cover w-full h-64 rounded-lg">
                            </div>
                        </div>

                        <!-- Loading State -->
                        <div x-show="isUploading" class="absolute inset-0 bg-white/80 flex items-center justify-center rounded-xl">
                            <div class="animate-spin rounded-full h-8 w-8 border-2 border-pink-500 border-t-transparent"></div>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Caption Input -->
                <div class="mb-8">
                    <label for="caption" class="block text-pink-600 font-medium mb-3">Story Caption</label>
                    <textarea
                        name="caption"
                        id="caption"
                        required
                        rows="4"
                        class="w-full px-4 py-3 border border-pink-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent placeholder-pink-300"
                        placeholder="What's happening?..."
                    >{{ old('caption') }}</textarea>
                    @error('caption')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Form Actions -->
                <div class="flex justify-end gap-4">
                    <a href="{{ url()->previous() }}" class="px-6 py-2.5 text-pink-600 hover:bg-pink-50 rounded-xl transition-colors">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-2.5 bg-pink-600 text-white rounded-xl font-medium hover:shadow-lg transition-all"
                    >
                        Post Story
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Alpine.js for interactive elements -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-app-layout>
