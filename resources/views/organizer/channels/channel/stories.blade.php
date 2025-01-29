<!-- Stories Table -->
<div class="overflow-x-auto border border-gray-200 bg-white">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Caption</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($stories as $story)
                @php
                    $imagePath = asset('storage/uploads/story/' . $event->event_id . '/' . $story->image);
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $imagePath }}"
                             class="w-16 h-16 object-cover rounded-md border border-gray-200"
                             alt="Story preview"
                        >
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                        {{ Str::limit($story->caption, 40) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $story->user->fullname }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $story->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button
                            onclick="openModal('modal-{{ $story->id }}')"
                            class="flex items-center gap-2 text-white p-2 rounded-md bg-pink-600 hover:bg-pink-700 transition-colors"
                        >
                            <span class="material-icons">info</span>
                            View Details
                        </button>

                        <!-- Modal -->
                        <div id="modal-{{ $story->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                            <div class="bg-white rounded-lg max-w-2xl w-full mx-4">
                                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                    <h3 class="text-lg font-bold text-gray-700">{{ $story->caption }}</h3>
                                    <button
                                        onclick="closeModal('modal-{{ $story->id }}')"
                                        class="text-gray-400 hover:text-gray-600"
                                    >
                                        <span class="material-icons">close</span>
                                    </button>
                                </div>
                                <div class="p-6">
                                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                                        <img src="{{ $imagePath }}" class="w-full h-full object-cover" alt="Story image">
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
                    </td>
                </tr>
            @endforeach

            @if($stories->isEmpty())
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No stories available
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Simple JavaScript to toggle modals -->
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
