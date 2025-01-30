<div class="bg-white rounded-xl overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 relative">
    <div onclick="openModal('modal-{{ $story->id }}')" class="cursor-pointer">
        <div class="relative h-48">
            <img src="{{ asset('storage/uploads/story/' . $story->channel_id . '/' . $story->image) }}"
                 class="w-full h-full object-cover">
            <div class="absolute bottom-2 left-2 bg-black/40 text-white px-3 py-1 rounded-full text-xs backdrop-blur-sm">
                {{ $story->created_at->diffForHumans() }}
            </div>
        </div>
        <div class="p-4">
            <p class="text-pink-600 mb-3 truncate text-sm">{{ $story->caption }}</p>
            <div class="flex items-center gap-2">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-gray-200 overflow-hidden rounded-full">
                    </div>
                </div>
                <div class="text-sm text-pink-500 font-medium">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Story Modal -->
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
                <img src="{{ asset('storage/uploads/story/' . $story->event->event_id . '/' . $story->image) }}" class="w-full h-full object-cover" alt="Story image">
            </div>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium text-pink-600">{{ $story->user->fullname }}</span>
                    <span class="text-sm text-gray-500">{{ $story->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-700 text-sm">{{ $story->caption }}</p>
            </div>
        </div>
    </div>
</div>
