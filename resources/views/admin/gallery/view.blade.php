<x-app-layout>
    <div class="min-h-screen bg-white p-8 rounded-lg">
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-700">All Stories</h2>
            </div>
            
            @if($live->isEmpty() && $not_included->isEmpty())
                <div>
                    <h1 class="text-sm text-gray-400 italic">No Stories Available</h1>
                </div>
            @else
                <!-- Live Channels Stories -->
                @if(!$live->isEmpty())
                <div class="flex flex-col gap-0">
                    <h1 class="text-[0.8rem] text-gray-400">Channels included in the App Gallery</h1>
                    <h3 class="text-[2rem] font-black text-gray-600">LIVE CHANNELS</h3>
                </div>
                    <div class="grid grid-cols-1 gap-6 mt-3">
                        @foreach($live as $story)
                            @php
                                $stories = \App\Models\Stories::where('channel_id', $story->channel_id)->get();
                            @endphp
                            
                            <div class="bg-white p-4 rounded-lg  border border-gray-200">
                                <h4 class="text-lg font-semibold text-pink-600">{{ $story->event->title }}</h4>

                                <div class="flex flex-col space-y-3 mt-4">
                                    @if($stories->isEmpty())
                                        <span class="text-gray-400 text-sm italic">No stories for this channel</span>
                                    @else
                                        <button class="flex items-center text-sm text-pink-600" onclick="toggleDropdown('live-dropdown-{{ $story->channel_id }}')">
                                            Show Stories
                                            <span class="ml-2 transform transition duration-300 ease-in-out" id="arrow-{{ $story->channel_id }}">
                                                ▼
                                            </span>
                                        </button>
                                        <div id="live-dropdown-{{ $story->channel_id }}" class="grid grid-cols-1 gap-3 hidden mt-3">
                                            @foreach($stories as $storyItem)
                                                <div class="flex-shrink-0">
                                                    <div class="relative w-20 h-20 rounded-lg overflow-hidden">
                                                        <img src="{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <hr class="w-full opacity-65 my-8">
                <!-- Unincluded Channels Stories -->
                @if(!$not_included->isEmpty())
                <div class="flex flex-col gap-0 mt-4">
                    <h1 class="text-[0.8rem] text-gray-400">Channels not included in the App Gallery</h1>
                    <h3 class="text-[2rem] font-black text-gray-600">OPEN CHANNELS</h3>
                </div>
                    <div class="grid grid-cols-1 gap-6 mt-3">
                        @foreach($not_included as $channel)
                            @php
                                $unincludedStories = \App\Models\Stories::where('channel_id', $channel->channel_id)->get();
                            @endphp
                            
                            <div class="bg-white p-4 rounded-lg  border border-gray-200">
                                <h4 class="text-lg font-semibold text-pink-600">{{ $channel->event->title }}</h4>
                                
                                <div class="flex flex-col space-y-3 mt-4">
                                    @if($unincludedStories->isEmpty())
                                        <span class="text-gray-400 text-sm italic">No stories for this channel</span>
                                    @else
                                        <button class="flex items-center text-sm text-pink-600" onclick="toggleDropdown('open-dropdown-{{ $channel->channel_id }}')">
                                            Show Stories
                                            <span class="ml-2 transform transition duration-300 ease-in-out" id="arrow-{{ $channel->channel_id }}">
                                                ▼
                                            </span>
                                        </button>
                                        <div id="open-dropdown-{{ $channel->channel_id }}" class="grid grid-cols-1 gap-3 hidden mt-3">
                                            @foreach($unincludedStories as $storyItem)
                                                <div class="flex-shrink-0">
                                                    <div class="relative w-20 h-20 rounded-lg overflow-hidden">
                                                        <img src="{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    function toggleDropdown(id) {
        var dropdown = document.getElementById(id);
        var arrow = document.getElementById('arrow-' + id.split('-')[2]); // Extract channel_id from the dropdown id

        dropdown.classList.toggle('hidden');
        
        // Toggle arrow rotation
        if (dropdown.classList.contains('hidden')) {
            arrow.textContent = '▼'; // Down arrow when hidden
        } else {
            arrow.textContent = '▲'; // Up arrow when visible
        }
    }
</script>
