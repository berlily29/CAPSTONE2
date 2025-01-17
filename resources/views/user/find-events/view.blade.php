<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-4 max-w-full">
                    <h1 class="ml-2 mt-5 text-3xl font-bold text-black">Events</h1>
                </div>

                <div class="py-3 px-8  bg-white border-b border-gray-200">
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
                    <div id="open-events" class="tab-content hidden px-4">
                        <h2 class="text-lg font-semibold text-gray-700">Find events that are currently open for participation.</h2>

                        @foreach ([
                            ['id' => 1, 'name' => 'Event 1', 'date' => 'January 15, 2025', 'venue' => 'Barangay Hall', 'category' => 'Sports'],
                            ['id' => 2, 'name' => 'Event 2', 'date' => 'February 20, 2025', 'venue' => 'Barangay Hall', 'category' => 'Nature'],
                            ['id' => 3, 'name' => 'Event 3', 'date' => 'March 25, 2025', 'venue' => 'Barangay Hall', 'category' => 'Sports']
                        ] as $event)

                            <div class="mt-4 event bg-white p-6 rounded-lg shadow-lg">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-bold">{{ $event['name'] }}</h3>
                                    <button class="bg-pink-500 text-white p-3 rounded-full hover:bg-pink-600 transition" onclick="toggleEventDetails('event{{ $event['id'] }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Event Details -->
                                <div id="event{{ $event['id'] }}-details" class="event-details hidden mt-4">
                                    <div class="nav-tabs flex mb-4 space-x-4">
                                        <button id="event{{ $event['id'] }}-detail-tab" class="px-3 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black"
                                            onclick="showEventTab('event{{ $event['id'] }}', 'detail')">
                                            Event Details
                                        </button>
                                        <button id="event{{ $event['id'] }}-organizer-tab" class="px-3 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black"
                                            onclick="showEventTab('event{{ $event['id'] }}', 'organizer')">
                                            Organizer Details
                                        </button>
                                    </div>

                                    <!-- Content -->
                                    <div id="event{{ $event['id'] }}-detail" class="tab-content mt-4 hidden">
                                        <div class="text-black space-y-2">
                                            <p><strong>Event Name:</strong> {{ $event['name'] }}</p>
                                            <p><strong>Date:</strong> {{ $event['date'] }}</p>
                                            <p><strong>Venue:</strong> {{ $event['venue'] }}</p>
                                            <p><strong>Category:</strong> {{ $event['category'] }}</p>
                                        </div>

                                        <div class="mt-4">
                                            <button class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition">
                                                Join Event
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Event organizer -->
                                    <div id="event{{ $event['id'] }}-organizer" class="tab-content mt-4 hidden">
                                        <p class="text-black">Event Organizer Details go here</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Nearby -->
                    <div id="nearby" class="tab-content hidden">
                        <h2 class="text-lg font-semibold text-gray-700">Discover events close to your location.</h2>
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
        function toggleEventDetails(eventId) {
            const eventDetails = document.getElementById(`${eventId}-details`);
            eventDetails.classList.toggle('hidden');
        }

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
                button.classList.remove( 'text-pink-500');
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

        function showEventTab(eventId, tabType) {
            const allTabs = document.querySelectorAll(`#${eventId}-details .tab-content`);
            allTabs.forEach(function(tab) {
                tab.classList.add('hidden');
            });

            const selectedTab = document.getElementById(`${eventId}-${tabType}`);
            selectedTab.classList.remove('hidden');

            const allTabButtons = document.querySelectorAll(`#${eventId}-details .nav-tabs button`);
            allTabButtons.forEach(function(button) {
                button.classList.remove( 'text-pink-500');
                button.classList.add('border-transparent', 'text-black');
            });

            const activeButton = document.getElementById(`${eventId}-${tabType}-tab`);
            activeButton.classList.add( 'text-pink-500');
        }

        // Set default tab to "Open Events"
        document.addEventListener('DOMContentLoaded', function () {
            showTab('open-events');
        });
    </script>

</x-app-layout>
