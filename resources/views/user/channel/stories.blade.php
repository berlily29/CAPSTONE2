<!-- Main Container -->
<div class="w-full mx-auto px-4 py-8">
    <!-- Add Story Button -->
    <div class="mb-6 text-right">
        <a href="{{route('user.channel.stories', ['id'=> $event->event_id])}}"
           class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Story
        </a>
    </div>

    <!-- Stories Grid -->
    <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($stories as $story)
        <div
            class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow border border-gray-100 cursor-pointer"
            onclick="openModal({{ $story->id }})"
        >
            <div class="relative h-48">
                <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}"
                     class="w-full h-full object-cover rounded-t-xl">
                <div class="absolute bottom-2 left-2 bg-sky-600 text-white px-3 py-1 rounded-full text-xs">
                    {{ $story->created_at->diffForHumans() }}
                </div>
            </div>

            <!-- Story Content -->
            <div class="p-4">
                <p class="text-pink-600 mb-3 truncate">{{ $story->caption }}</p>

                <!-- User Info -->
                <div class="flex items-center justify-between border-t border-gray-100 pt-3">
                    <div class="flex items-center">
                        <div class="text-sm text-pink-500">
                            <span class="font-medium">{{ $story->user->fullname }}</span>
                        </div>
                    </div>
                    <span class="px-2 py-1 bg-sky-100 text-sky-600 text-xs rounded-full">
                        {{ $story->channel->name }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal-{{ $story->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg max-w-2xl w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-700" id="modal-caption-{{ $story->id }}"></h3>
                    <button
                        onclick="closeModal({{ $story->id }})"
                        class="text-gray-400 hover:text-gray-600"
                    >
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="p-6">
                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                        <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}"
                             class="w-full h-full object-cover" alt="Story image">
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-pink-600" id="modal-user-{{ $story->id }}"></span>
                            <span class="text-sm text-gray-500" id="modal-time-{{ $story->id }}"></span>
                        </div>
                        <p class="text-gray-700 text-sm" id="modal-caption-text-{{ $story->id }}"></p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($stories->isEmpty())
        <div class="text-center text-gray-500 py-4">
            No stories available
        </div>
    @endif
</div>

<!-- Simple JavaScript to toggle modals -->
<script>
    function openModal(storyId) {
        const modal = document.getElementById('modal-' + storyId);
        const story = @json($stories).find(s => s.id === storyId); // Use Laravel data to populate modal content

        document.getElementById('modal-caption-' + storyId).textContent = story.caption;
        document.getElementById('modal-user-' + storyId).textContent = story.user.lname + ', ' + story.user.fname  + ' ' + story.user.mname;
        document.getElementById('modal-time-' + storyId).textContent = story.created_at.split("T")[0] + " | " + story.created_at.split("T")[1].split(".")[0]; // Adjust format if needed
        document.getElementById('modal-caption-text-' + storyId).textContent = story.caption;

        modal.classList.remove('hidden');
    }

    function closeModal(storyId) {
        const modal = document.getElementById('modal-' + storyId);
        modal.classList.add('hidden');
    }
</script>
