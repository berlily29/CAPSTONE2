<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex flex-col items-center py-4 gap-0">
                <h1 class="text-sm text-gray-500 mb-[-0.5rem]">{{$event->title}}</h1>
                <h1 class="text-2xl font-black text-gray-700 mb-4">New Post</h1>
            </div>

            <form id="createPostForm" action="{{route('eo.channel.post.publish',['id'=>$event->event_id])}}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full rounded-md p-4 border border-gray-300  focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Enter the title" required>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="mt-1 block w-full rounded-md p-4 border border-gray-300  focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
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

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 text-white font-semibold text-sm uppercase rounded-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Image Preview and Form Submission -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Image Preview Logic
        document.getElementById('images').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = ""; // Clear previous previews

            if (files.length > 4) {
                alert("You can only upload up to 4 images.");
                event.target.value = ""; // Reset the file input
                return;
            }

            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = "relative group";

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-full h-24 object-cover rounded-lg border";

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = "×";
                    removeBtn.className = "absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity";
                    removeBtn.addEventListener('click', () => {
                        wrapper.remove();
                        // Remove the corresponding file from the input
                        const dataTransfer = new DataTransfer();
                        Array.from(files).forEach((f, i) => {
                            if (i !== index) dataTransfer.items.add(f);
                        });
                        event.target.files = dataTransfer.files;
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });

        // Form Submission Logic
        document.getElementById('createPostForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Post Created!',
                        text: 'Your post has been successfully created.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "{{ url('/portal/channels/' . $event->channel_id) }}"; // Update the URL to your desired redirect location
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again.',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.',
                });
            });
        });
    </script>
</x-app-layout>
