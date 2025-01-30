<div class="w-full mx-auto px-4 py-8">
    <!-- Stories Sections -->
    <div class="space-y-8">
        <!-- My Stories Section -->
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-800">My Stories</h2>
                <a href="{{route('user.channel.stories', ['id'=> $event->event_id])}}"
                   class="inline-flex items-center px-4 py-1 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition-colors text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Story
                </a>
            </div>

           @if($myStories->count()==0)
            <div>
                <h1 class="text-sm text-gray-400 italic">Hey, no stories yet! Time to post one</h1>
            </div>
           @endif

            <div class="flex gap-2">
                @foreach($myStories as $story)
                <div class="bg-white rounded-full w-[75px] h-[75px] overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 relative">
                    <!-- Delete Button -->

                    <form method="POST" action="{{route('user.channel.stories.delete', ['id'=> $story->id])}}" class="absolute top-2 right-2 z-10">
                        @csrf @method('DELETE')
                        <button type="button"
                                onclick="Swal.fire({
                                    title: 'Delete Story?',
                                    text: 'This action cannot be undone!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#ec4899',
                                    cancelButtonColor: '#6b7280',
                                    confirmButtonText: 'Delete it!'
                                }).then((result) => { if (result.isConfirmed) this.form.submit() })"
                                class="p-1 mr-1 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>

                    <div onclick="openModal('modal-{{ $story->id }}')"
                         class="cursor-pointer">
                        <div class="relative h-48">
                            <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}"
                                 class="w-full h-full object-cover ">
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- All Stories Section -->
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-800">All Stories</h2>
            </div>

            @if($allStories->count()==0)
            <div>
                <h1 class="text-sm text-gray-400 italic"> No Stories Available</h1>
            </div>
           @endif


            <div class="grid grid-cols-6 gap-4">
                @foreach($allStories as $story)
                <div class="bg-white rounded-xl overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 relative">
                    <div onclick="openModal('modal-{{ $story->id }}')"
                         class="cursor-pointer">
                        <div class="relative h-48">
                            <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}"
                                 class="w-full h-full object-cover ">
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
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
