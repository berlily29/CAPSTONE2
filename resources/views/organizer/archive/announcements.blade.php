
<style>
#img {
    width: 40px;
    height: 40px;
}
</style>
<div class="">
    <!-- Announcement Posts -->

    <div class="w-full flex">

    </div>
    <div class="space-y-6 py-4">
        @foreach($announcements as $announcement)
        <div class="bg-white border border-gray-300 p-6 relative" data-post-id="{{ $announcement->post_id }}">
            <!-- Author and Date -->
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-4">
                    <div>
                        <img id="img" src="{{ $announcement->channel->event->organizer->user->profile_picture
                            ? asset('storage/uploads/profilepic/' . $announcement->channel->event->organizer->user->profile_picture)
                            : asset('images/default-dp.jpg') }}"
                            alt=""
                            class="w-[40px] h-[40px] rounded-full">
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-500"><span class="font-semibold text-gray-800">{{ $announcement->channel->event->organizer->user->fullname }}</span></p>
                        <p class="text-sm text-gray-500">Date: {{ $announcement->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>

            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $announcement->title }}</h3>
            <p class="text-gray-700 leading-relaxed">{{ $announcement->content }}</p>

            @if($announcement->images)
            <div class="w-[50%] mt-4 grid gap-2
                @if($announcement->images && count(json_decode($announcement->images)) === 1)
                    grid-cols-1
                @elseif($announcement->images && count(json_decode($announcement->images)) === 2)
                    grid-cols-2
                @elseif($announcement->images)
                    grid-cols-2
                @endif
                    ">
                @foreach(json_decode($announcement->images) as $image)
                <div class="relative">
                    <img src="{{ asset('storage/uploads/posts/' . $announcement->channel_id . '/' . $announcement->post_id . '/' . $image) }}"
                         alt="Announcement Image"
                         class="w-full object-cover rounded-md cursor-pointer"
                         onclick="openImageModal('{{ asset('storage/uploads/posts/' . $announcement->channel_id . '/' . $announcement->post_id . '/' . $image) }}')"/>
                </div>
                @endforeach
            </div>
            @endif

            <hr class="opacity-65 my-4">
            <div class="w-full flex gap-4">
                <!-- Likes Counter -->
                <div class="flex gap-2 items-center">
                    <span class="material-icons text-gray-400">favorite</span>
                    <span class="text-sm text-gray-400 like-counter">
                        @if($announcement->total_readers > 0)
                            @if($announcement->readers->contains('user_id', Auth::user()->user_id))
                                @if($announcement->total_readers == 1)
                                    Liked by You
                                @else
                                    Liked by You and {{ $announcement->total_readers - 1 }} member/s
                                @endif
                            @else
                                Liked by {{ $announcement->total_readers }} member/s
                            @endif
                        @else
                            No likes
                        @endif
                    </span>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Modal for Expanded Image -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
            <div class="relative">
                <img id="modalImage" src="" alt="Expanded Image" class="rounded-lg max-w-full max-h-[90vh]">
                <button class="absolute top-2 right-2 bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg"
                        onclick="closeImageModal()">×</button>
            </div>
        </div>

        @if ($announcements->isEmpty())
        <div class="text-center py-8 text-lg italic text-gray-400">
            No announcements on this channel.
        </div>
        @endif
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function posttoggle(button) {
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('hidden');
    }

    function openImageModal(imageUrl) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageUrl;
        modal.classList.remove('hidden');
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }



    function confirmDelete(postId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this post. This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/delete/${postId}`, {
                data: {
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}" // Include CSRF token if necessary
                }
            })
            .then(response => {
                if (response.data.success) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your post has been deleted.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload the page after the timer
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'There was an issue deleting the post.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire(
                    'Error!',
                    'There was an error processing your request.',
                    'error'
                );
            });
        }
    });
}

</script>
