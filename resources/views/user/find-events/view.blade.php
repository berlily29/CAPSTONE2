<x-app-layout>


    <div class="w-full bg-white rounded-lg p-8">
        <div class="w-full">
            <div class=" bg-white overflow-hidden shadow-sm ">
                    <h1 class="ml-2 mt-5 text-3xl font-black text-gray-700">Events</h1>


                <div class=" bg-white ">
                    <!-- Navigation Tabs -->
                    <div class="flex border-b mb-4 relative">
                        <button id="open-events-tab" class="px-3 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black"
                                onclick="showTab('open-events')">
                            Open Events
                        </button>
                        <button id="nearby-tab" class="px-4 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black"
                                onclick="showTab('nearby')">
                            Nearby me
                        </button>
                        <button id="recommended-tab" class="px-4 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black"
                                onclick="showTab('recommended')">
                            Recommended
                        </button>
                        <!-- Active Tab Highlight -->
                        <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/3 h-1 bg-pink-500 transition-all"></div>
                    </div>

                    <!-- Tab Contents -->
                    <div id="open-events" class="tab-content hidden">
                        <h2 class="text-lg font-semibold text-gray-700">Find events that are currently open for participation.</h2>

                        @foreach ($open_events as $event)
                            <div class="mt-4 bg-white p-6  shadow-lg border border-gray-200 relative">
                                <!-- Book Tag Highlight -->
                                <span class="absolute top-0 left-0 h-full w-2 bg-pink-500 "></span>
                                <div class="flex justify-between items-start pl-4">
                                    <!-- Event Details -->
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                        <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach($event->event_category as $category_id)
                                                @php
                                                    $category = \App\Models\EventCategories::find($category_id)
                                                @endphp

                                                <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                    {{ $category->name }}
                                                </span>

                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Action Button -->
                                    <div class="flex items-center justify-center h-full">
                                        <a href="{{route('find-events.view', ['id'=>$event->event_id])}}" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                                            <span class="material-icons">info</span>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Nearby -->
                    <div id="nearby" class="tab-content hidden">
                        <h2 class="text-lg font-semibold text-gray-700">Discover events close to your location.</h2>

                        @foreach ($nearby_events as $event)
                            <div class="mt-4 bg-white p-6  shadow-lg border border-gray-200 relative">
                                <!-- Book Tag Highlight -->
                                <span class="absolute top-0 left-0 h-full w-2 bg-pink-500"></span>
                                <div class="flex justify-between items-start pl-4">
                                    <!-- Event Details -->
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                        <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @if($event->event_category == 1 || $event->event_category == 6 || $event->event_category == 11 || $event->event_category == 16 || $event->event_category == 20)
                                                <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                    {{ $event->category->name }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                    {{ $event->category->parent->name }}
                                                </span>
                                                <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                    {{ $event->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Action Button -->
                                    <div class="flex items-center justify-center h-full">
                                        <a href="" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                                            <span class="material-icons">info</span>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Recommended -->
                    <div id="recommended" class="tab-content hidden">
                        <h2 class="text-lg font-semibold text-gray-700">Events tailored based on your interests and history.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            const allTabs = document.querySelectorAll('.tab-content');
            allTabs.forEach(tab => tab.classList.add('hidden'));

            // Show the selected tab
            const selectedTab = document.getElementById(tabName);
            selectedTab.classList.remove('hidden');

            // Reset active tab buttons
            const allTabButtons = document.querySelectorAll('.nav-tabs button');
            allTabButtons.forEach(button => {
                button.classList.remove('text-pink-500');
                button.classList.add('border-transparent', 'text-black');
            });

            // Highlight the active tab button
            const activeButton = document.getElementById(`${tabName}-tab`);
            if (activeButton) {
                activeButton.classList.add('text-pink-500');
            }

            // Adjust the tab highlight under the active tab
            const highlight = document.getElementById('tab-highlight');
            if (highlight && activeButton) {
                highlight.style.left = activeButton.offsetLeft + 'px';
                highlight.style.width = activeButton.offsetWidth + 'px';
            }
        }

        // Set default tab to "Open Events"
        document.addEventListener('DOMContentLoaded', function () {
            showTab('open-events');
        });
    </script>
</x-app-layout>
