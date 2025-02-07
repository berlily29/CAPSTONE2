<div class="w-full mx-auto px-4 py-8">
    <!-- Stories Sections -->
    <div class="space-y-8">

        <!-- All Stories Section -->
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-700">All Stories</h2>
            </div>

            @if($stories->count() == 0)
            <div>
                <h1 class="text-sm text-gray-400 italic"> No Stories Available</h1>
            </div>
            @endif

            <div class="grid grid-cols-4 gap-4">
                @foreach($stories as $story)
                <div class="bg-white rounded-xl overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 relative">
                    <div onclick="openModal('modal-{{ $story->id }}')" class="cursor-pointer">
                        <div class="relative h-48">
                            <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute bottom-2 left-2 bg-black/40 text-white px-3 py-1 rounded-full text-xs backdrop-blur-sm">
                                {{ $story->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-pink-600 mb-3 truncate text-sm">{{ $story->caption }}</p>
                            <div class="flex items-center gap-2">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gray-200 overflow-hidden">
                                        <img src="{{ $story->user->profile_picture ? asset('storage/uploads/profilepic/' . $story->user->profile_picture) : asset('images/default-dp.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="text-sm text-pink-500 font-medium">
                                    {{ $story->user->fullname }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for each story -->
                <div id="modal-{{ $story->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                    <div class="bg-white rounded-lg max-w-2xl w-full mx-4">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-700">{{ $story->caption }}</h3>
                            <button onclick="closeModal('modal-{{ $story->id }}')"
                                    class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                                <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}" class="w-full h-full object-cover" alt="Story image">
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium text-pink-600">{{ $story->user->fullname }}</span>
                                    <span class="text-sm text-gray-500">{{ $story->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 text-sm">{{ $story->caption }}</p>
                            </div>
                            <!-- Delete Button -->
                            <div class="flex justify-end mt-4">
                                <form action="{{ route('story.delete', ['id' => $story->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this story?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-pink-600 hover:bg-pink-700 text-white rounded-full transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m2 0v14a2 2 0 01-2 2H8a2 2 0 01-2-2V6h12z"/>
</svg>

                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Simple JavaScript to toggle modals -->


@if($story_deleted == true)
<script>
    Swal.fire({
        icon: "success",
        title: "Story Deleted",
        timer: 1500,
        showConfirmButton: false
    })
</script>
@endif

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
