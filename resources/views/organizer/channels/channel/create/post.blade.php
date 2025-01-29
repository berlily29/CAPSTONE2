<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex flex-col items-center py-4 gap-0">
                <h1 class="text-sm text-gray-500 mb-[-0.5rem]">{{$event->title}}</h1>
                @if($editmode)
                    <h1 class="text-2xl font-black text-gray-700 mb-4">Edit Post</h1>
                @else
                    <h1 class="text-2xl font-black text-gray-700 mb-4">New Post</h1>
                @endif
            </div>

            <form id="createPostForm"
                @if($editmode)
                    action="{{route('eo.channel.post.edit',['id'=>$post->post_id])}}"
                @else
                    action="{{route('eo.channel.post.publish',['id'=>$event->event_id])}}"
                @endif
                method="POST" enctype="multipart/form-data">

                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title"
                        @if($editmode) value="{{$post->title}}" @endif
                        class="mt-1 block w-full rounded-md p-4 border border-gray-300 focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Enter the title" required>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="mt-1 block w-full rounded-md p-4 border border-gray-300 focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                        placeholder="Enter the content" required>@if($editmode){{$post->content}}@endif</textarea>
                </div>

                <!-- Image Upload & Preview -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Images</label>

                    <!-- Edit Images Button -->
                    <button type="button" id="toggleEditImages"
                        class="mb-2 px-3 py-1 text-sm bg-gray-200 rounded-lg hover:bg-gray-300">Edit Images</button>

                    <!-- Image Previews (Default) -->
                    <div id="imagePreviewContainer" class="mt-4 grid grid-cols-4 gap-4">
                        @if($editmode && $post->images)
                            @foreach(json_decode($post->images) as $image)
                                @php
                                    $imagePath = asset('storage/uploads/posts/' . $post->channel_id . '/' . $post->post_id . '/' . $image);
                                @endphp
                                <div class="relative edit-image-preview">
                                    <img src="{{ $imagePath }}" class="w-full h-24 object-cover rounded-lg border">
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Hidden File Upload (Initially Disabled) -->
                    <input type="file" name="images[]" id="images" accept="image/*" multiple disabled
                        class="hidden mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200" />

                    <!-- Hidden Input to Track Image Changes -->
                    <input type="hidden" name="images_changed" id="images_changed" value="0">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 text-white font-semibold text-sm uppercase rounded-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                        @if($editmode) Update Post @else Create Post @endif
                    </button>
                </div>
            </form>
        </div>
    </div>

   <!-- Add this script section at the bottom of your file -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('createPostForm');
        const channelId = "{{ $event->channel_id }}";

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Post ' + (@json($editmode) ? 'updated' : 'created') + ' successfully!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = `/portal/channels/${channelId}`;
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Something went wrong!',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred!',
                    icon: 'error'
                });
            });
        });
    });
</script>
</x-app-layout>
