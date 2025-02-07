<x-app-layout>
    <div class="min-h-screen bg-white p-8 rounded-lg">
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-700">All Stories</h2>
            </div>

            <!-- Live Channels Stories -->
            <div class="flex flex-col gap-0">
                <h1 class="text-[0.8rem] text-gray-400">Channels included in the App Gallery</h1>
                <h3 class="text-[2rem] font-black text-gray-600">LIVE CHANNELS</h3>
            </div>

            @if($live->isEmpty())
                <div>
                    <h1 class="text-sm text-gray-400 italic">No Stories Available</h1>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 mt-3">
                    @foreach($live as $story)
                        @php
                            $stories = \App\Models\Stories::where('channel_id', $story->channel_id)->get();
                        @endphp

                        <div class="bg-white p-4 rounded-lg border border-gray-200 flex justify-between items-center">
                            <div>
                                <h4 class="text-lg font-semibold text-pink-600">{{ $story->event->title }}</h4>
                                <div class="flex flex-col space-y-3 mt-4">
                                    @if($stories->isEmpty())
                                        <span class="text-gray-400 text-sm italic">No stories for this channel</span>
                                    @else
                                        <button class="flex items-center text-sm text-pink-600" onclick="toggleItemDropdown('live-dropdown-{{ $story->event_id }}')">
                                            Show Images
                                            <span class="ml-2 transform transition duration-300 ease-in-out" data-arrow="live-dropdown-{{ $story->event_id }}">▼</span>
                                        </button>

                                        <div id="live-dropdown-{{ $story->event_id }}" class="grid grid-cols-8 gap-2 hidden mt-3">
                                            @foreach($stories as $storyItem)
                                                <div class="flex-shrink-0">
                                                    <div class="relative w-20 h-40 rounded-lg overflow-hidden">
                                                        <img src="{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}" class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('admin.gallery.delete', ['id' => $story->event_id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-pink-600 text-white px-3 py-1 rounded-lg text-sm">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

            <hr class="w-full opacity-65 my-8">

            <!-- Unincluded Channels Stories -->
            <div class="flex flex-col gap-0 mt-4">
                <h1 class="text-[0.8rem] text-gray-400">Channels not included in the App Gallery</h1>
                <h3 class="text-[2rem] font-black text-gray-600">OPEN CHANNELS</h3>
            </div>

            @if($not_included->isEmpty())
                <div>
                    <h1 class="text-sm text-gray-400 italic">No Stories Available</h1>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 mt-3">
                    @foreach($not_included as $story)
                        @php
                            $stories = \App\Models\Stories::where('channel_id', $story->event_id)->get();
                        @endphp

                        <div class="bg-white p-4 rounded-lg border border-gray-200 flex justify-between items-center">
                            <div>
                                <h4 class="text-lg font-semibold text-pink-600">{{ $story->event->title }}</h4>
                                <div class="flex flex-col space-y-3 mt-4">
                                    @if($stories->isEmpty())
                                        <span class="text-gray-400 text-sm italic">No stories for this channel</span>
                                    @else
                                        <button class="flex items-center text-sm text-pink-600" onclick="toggleItemDropdown('open-dropdown-{{ $story->event_id }}')">
                                            Show Images
                                            <span class="ml-2 transform transition duration-300 ease-in-out" data-arrow="open-dropdown-{{ $story->event_id }}">▼</span>
                                        </button>

                                        <div id="open-dropdown-{{ $story->event_id }}" class="grid grid-cols-8 gap-2 hidden mt-3">
                                            @foreach($stories as $storyItem)
                                                <div class="flex-shrink-0">
                                                    <div class="relative w-20 h-40 rounded-lg overflow-hidden">
                                                        <img src="{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}" class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('admin.gallery.add', ['id' => $story->event_id]) }}" method="POST">
                                @csrf
                                <button class="bg-pink-600 text-white px-3 py-1 rounded-lg text-sm">Add</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    function toggleItemDropdown(id) {
        var dropdown = document.getElementById(id);
        var arrow = document.querySelector(`[data-arrow="${id}"]`);

        dropdown.classList.toggle('hidden');

        // Toggle arrow rotation
        if (dropdown.classList.contains('hidden')) {
            arrow.textContent = '▼'; // Down arrow when hidden
        } else {
            arrow.textContent = '▲'; // Up arrow when visible
        }
    }
</script>
