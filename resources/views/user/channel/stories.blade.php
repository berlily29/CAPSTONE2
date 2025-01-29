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


    <div class=" w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($stories as $story)
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <!-- Story Image -->
            <div class="relative h-48">
                <img src="{{ asset('storage/uploads/story/' . $event->event_id . '/' . $story->image) }}"
                     class="w-full h-full object-cover rounded-t-xl">
                <div class="absolute bottom-2 left-2 bg-sky-600 text-white px-3 py-1 rounded-full text-xs">
                    {{ $story->created_at->diffForHumans() }}
                </div>
            </div>

            <!-- Story Content -->
            <div class="p-4">
                <p class="text-pink-600 mb-3">{{ $story->caption }}</p>

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
        @endforeach


    </div>
</div>
