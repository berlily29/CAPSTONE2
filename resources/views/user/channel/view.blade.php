<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="w-full bg-white rounded-lg p-8">
        <div class="w-full">
            <a href="{{ route('user.joinevents') }}"
               class="inline-flex items-center mt-8 mb-4 px-4 py-2 bg-pink-600 text-white border border-pink-600 font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Return to Previous
            </a>

            <div class="bg-white overflow-hidden shadow-sm">
                <h1 class="text-sm font-medium text-gray-500">Channel</h1>
                <h1 class="mb-4 text-3xl font-black text-gray-700">{{$event->title}}</h1>
                <hr class="opacity-65">

                <div class="w-full">
                    <!-- Navigation Tabs -->
                    <div class="flex border-b mb-4 relative">
                        <!-- Announcements Tab -->
                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('announcements')">
                            Announcements
                        </button>


                        <!-- Stories Tab -->
                        <button class="tab-btn px-4 py-2  font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('stories')">
                            Stories
                        </button>

                        <!-- Event Details Tab -->
                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('event-details')">
                            Event Details
                        </button>

                        <!-- Active Tab Border -->
                        <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/3 h-1 bg-pink-500 transition-all duration-300 ease-in-out"></div>
                    </div>

                    <!-- Tab Contents -->
                    <div class="w-full">
                        <!-- Announcements Tab Content -->
                        <div id="announcements" class="tab-content hidden p-6">
                            <h2 class="text-2xl font-bold mb-4 text-sky-600">Announcements</h2>
                            <p class="text-lg text-gray-700">This section contains the latest announcements for the channel. Stay tuned for updates!</p>
                        </div>

                        <!-- Stories Tab Content -->
                        <div id="stories" class="tab-content hidden p-6">
                            <h2 class="text-2xl font-bold mb-4 text-sky-600">Stories/Documentation</h2>
                            <p class="text-lg text-gray-700">In this section, we will share stories and important documentation related to the channel.</p>
                        </div>

                        <!-- Event Details Tab Content -->
                        <div id="event-details" class="tab-content hidden p-6">
                            <h2 class="text-2xl font-bold mb-4 text-sky-600">Event Details</h2>
                            <p class="text-lg text-gray-700">Here you can find detailed information about upcoming events, schedules, and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const allTabs = document.querySelectorAll('.tab-content');
            allTabs.forEach(tab => tab.classList.add('hidden'));

            // Reset all tab buttons' styles
            const allTabButtons = document.querySelectorAll('.tab-btn');
            allTabButtons.forEach(button => {
                button.classList.remove('bg-pink-600', 'text-white', 'font-bold', 'border-b-4', 'border-pink-600');
                button.classList.add('text-black');
            });

            // Show the selected tab content
            const selectedTab = document.getElementById(tabName);
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Set active tab button
            const activeButton = document.querySelector(`[onclick="showTab('${tabName}')"]`);
            if (activeButton) {
                activeButton.classList.add('font-bold', 'border-b-4', 'border-pink-600');

                // Move the highlight border under the active tab
                const highlight = document.getElementById('tab-highlight');
                highlight.style.left = activeButton.offsetLeft + 'px';
                highlight.style.width = activeButton.offsetWidth + 'px';
            }
        }

        // Set default active tab
        document.addEventListener('DOMContentLoaded', function () {
            showTab('announcements');
        });
    </script>
</x-app-layout>
