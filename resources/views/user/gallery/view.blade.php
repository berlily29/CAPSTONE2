<x-app-layout>
    <div class="min-h-screen bg-white p-8 rounded-lg">
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-700">App Gallery</h2>
            </div>

            @if($live->isEmpty())
                <h1 class="text-sm text-gray-400 italic">No Stories Available</h1>
            @else
                <!-- All Stories Gallery -->
                <div class="flex flex-col gap-0">
                    <h1 class="text-[0.8rem] text-gray-400">All Stories in the App Gallery</h1>
                    <h3 class="text-[2rem] font-black text-gray-600">ALL STORIES</h3>
                </div>

                <!-- Grid Gallery of All Stories -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-3">
                    @php
                        $galleryChannels = \App\Models\Gallery::all();
                        $liveChannelIds = $galleryChannels->pluck('channel_id')->toArray();
                        $stories = \App\Models\Stories::whereIn('channel_id', $liveChannelIds)->get();
                    @endphp

                    @foreach($stories as $storyItem)
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <!-- Story Image -->
                            <div class="relative w-full h-48 bg-gray-200 mb-4 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}"
                                     class="w-full h-full object-cover"
                                     onclick="openStoryPopup('{{ $storyItem->user->fullname }}', '{{ $storyItem->caption }}', '{{ $storyItem->user->fullname }}', '{{ $storyItem->channel->event->title }}', '{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}')">
                            </div>

                            <!-- Story Details -->
                            <div class="flex flex-col gap-0">
                                <h4 class="text-lg font-bold text-pink-600">{{ $storyItem->user->fullname }}</h4>
                                <p class="text-sm text-gray-500">{{ $storyItem->caption }}</p>
                                <p class="text-xs text-gray-400">Event: {{ $storyItem->channel->event->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Story Details Popup -->
    <div id="storyPopup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg w-96">
            <h3 class="text-2xl font-bold mb-4" id="storyTitle">Story Title</h3>
            <p class="text-sm text-gray-500 mb-4" id="storyCaption">Story Caption</p>
            <p class="text-xs text-gray-400" id="storyEvent">Event: </p>

            <!-- Story Image -->
            <div class="relative w-full bg-gray-200 mb-4 rounded-lg overflow-hidden">
                <img id="storyImage" src="" class="w-full h-full object-cover">
            </div>

            <button onclick="closeStoryPopup()" class="mt-4 px-4 py-2 bg-pink-500 text-white rounded-lg">Close</button>
        </div>
    </div>

    <script>
        function openStoryPopup(userName, caption, eventTitle, imageUrl) {
            document.getElementById('storyTitle').innerText = userName;
            document.getElementById('storyCaption').innerText = caption;
            document.getElementById('storyEvent').innerText = "Event: " + eventTitle;
            document.getElementById('storyImage').src = imageUrl;
            document.getElementById('storyPopup').classList.remove('hidden');
        }

        function closeStoryPopup() {
            document.getElementById('storyPopup').classList.add('hidden');
        }
    </script>
</x-app-layout>
