<div class="p-4">
    <!-- Announcement Posts -->
    <div class="space-y-6">
        @foreach($announcements as $announcement)
            <div class="bg-white border border-gray-300 p-6 relative" data-post-id="{{ $announcement->post_id }}">
                <!-- Author and Date -->
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                        <div>
                            <img src="{{ $announcement->channel->event->organizer->user->profile_picture
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
                    <!-- Like/Dislike Button -->
                    <button
                        class="like-btn text-sm px-3 py-1 rounded-md flex items-center justify-center gap-2
                            {{ $announcement->readers->contains('user_id', Auth::user()->user_id) ? 'bg-sky-600 text-white' : 'text-sky-600 border border-sky-600' }}"
                        data-liked="{{ $announcement->readers->contains('user_id', Auth::user()->user_id) ? 'true' : 'false' }}"
                        data-route-like="{{ route('announcement.like', ['id'=> $announcement->channel->channel_id, 'post'=> $announcement->post_id]) }}"
                        data-route-dislike="{{ route('announcement.dislike', ['id'=> $announcement->channel->channel_id, 'post'=> $announcement->post_id]) }}">
                        <span class="material-icons">
                            {{ $announcement->readers->contains('user_id', Auth::user()->user_id) ? 'favorite' : 'favorite_border' }}
                        </span>
                        <span>{{ $announcement->readers->contains('user_id', Auth::user()->user_id) ? 'Liked' : 'Like this post' }}</span>
                    </button>

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
            <div class="text-center py-8 text-lg font-semibold text-gray-500">
                No announcements yet. Stay tuned!
            </div>
        @endif
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
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


    document.addEventListener('DOMContentLoaded', function () {
        const likeButtons = document.querySelectorAll('.like-btn');

        likeButtons.forEach(button => {
            // Initialize button styles on page load
            const isLiked = button.dataset.liked === 'true';
            updateButtonStyles(button, isLiked);

            button.addEventListener('click', function () {
                const currentlyLiked = button.dataset.liked === 'true';
                const route = currentlyLiked ? button.dataset.routeDislike : button.dataset.routeLike;
                const method = currentlyLiked ? 'delete' : 'post';

                console.log(route)

                axios({
                    method: method,
                    url: route,
                    data: { _token: '{{ csrf_token() }}' }
                })
                    .then(response => {
                        if (response.data.success) {
                            const postDiv = button.closest('.relative');
                            const likeCounter = postDiv.querySelector('.like-counter');

                            // Toggle like state
                            const newLikeState = !currentlyLiked;
                            button.dataset.liked = newLikeState ? 'true' : 'false';

                            // Update button styles and text
                            updateButtonStyles(button, newLikeState);

                            // Update the like counter text
                            const totalReaders = response.data.totalReaders;
                            likeCounter.textContent = newLikeState
                                ? `Liked by You${totalReaders > 1 ? ' and ' + (totalReaders - 1) + ' member/s' : ''}`
                                : totalReaders > 0
                                    ? `Liked by ${totalReaders} member/s`
                                    : 'No likes';
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });

        /**
         * Updates the styles of the like button based on its state.
         * @param {HTMLElement} button - The like button element.
         * @param {boolean} isLiked - Whether the button is in the liked state.
         */
        function updateButtonStyles(button, isLiked) {
            if (isLiked) {
                button.classList.add('bg-sky-600', 'text-white');
                button.classList.remove('text-sky-600', 'border', 'border-sky-600');
                button.innerHTML = `
                    <span class="material-icons">favorite</span>
                    <span>Liked</span>
                `;
            } else {
                button.classList.remove('bg-sky-600', 'text-white');
                button.classList.add('text-sky-600', 'border', 'border-sky-600');
                button.innerHTML = `
                    <span class="material-icons">favorite_border</span>
                    <span>Like this post</span>
                `;
            }
        }
    });
</script>
