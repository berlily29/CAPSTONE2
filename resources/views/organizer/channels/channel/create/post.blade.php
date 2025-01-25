<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Create Post/Announcement</h2>

            <form id="createPostForm" action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Enter the title" required>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Enter the content" required></textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Upload Images (Max: 4)</label>
                    <input type="file" name="images[]" id="images" accept="image/*" multiple
                        class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200" />

                    <!-- Image Previews -->
                    <div id="imagePreviewContainer" class="mt-4 grid grid-cols-4 gap-4"></div>
                </div>

                <!-- Channel ID -->
                <div class="mb-4">
                    <label for="channel_id" class="block text-sm font-medium text-gray-700">Channel ID</label>
                    <input type="text" name="channel_id" id="channel_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Enter the channel ID" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 text-white font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        document.getElementById('images').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = ""; // Clear previous previews

            if (files.length > 4) {
                alert("You can only upload up to 4 images.");
                event.target.value = ""; // Reset the file input
                return;
            }

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-full h-24 object-cover rounded-lg border";
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
</x-app-layout>
