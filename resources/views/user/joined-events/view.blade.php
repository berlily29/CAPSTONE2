<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-8">

        <!-- Dashboard Header -->
        <section class="mb-6 text-center md:text-left">
            <h2 class="text-3xl font-bold text-gray-800">My Events</h2>

        </section>

        <!-- Tabs for Upcoming and Completed Events -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200">
            <nav class="flex border-b border-gray-200 relative">
                <button class="flex-1 p-4 text-center font-semibold text-gray-800 hover:text-pink-600 focus:outline-none relative" id="tab-upcoming">
                    Upcoming
                </button>
                <button class="flex-1 p-4 text-center font-semibold text-gray-800 hover:text-pink-600 focus:outline-none relative" id="tab-completed">
                    Completed
                </button>
                <div id="tab-indicator" class="absolute bottom-0 left-0 h-1 bg-pink-600 transition-all duration-300"></div>
            </nav>

            <div id="tab-content" class="p-6">
                <!-- Upcoming Events -->
                <div id="upcoming-events" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Event Name 1</h3>
                        <p class="text-sm text-gray-600">Date: January 20, 2025</p>
                        <p class="text-sm text-gray-600">Location: Virtual</p>
                        <button class="mt-4 bg-pink-500 text-white p-2 rounded-lg w-full hover:bg-pink-600">View Details</button>
                    </div>

                    <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Event Name 2</h3>
                        <p class="text-sm text-gray-600">Date: February 15, 2025</p>
                        <p class="text-sm text-gray-600">Location: On-Site</p>
                        <button class="mt-4 bg-pink-500 text-white p-2 rounded-lg w-full hover:bg-pink-600">View Details</button>
                    </div>
                </div>

                <!-- Completed Events (Hidden by Default) -->
                <div id="completed-events" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Completed Event 1</h3>
                        <p class="text-sm text-gray-600">Date: December 10, 2024</p>
                        <p class="text-sm text-gray-600">Location: Virtual</p>
                        <button class="mt-4 bg-gray-500 text-white p-2 rounded-lg w-full hover:bg-gray-600">View Details</button>
                    </div>

                    <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Completed Event 2</h3>
                        <p class="text-sm text-gray-600">Date: November 5, 2024</p>
                        <p class="text-sm text-gray-600">Location: On-Site</p>
                        <button class="mt-4 bg-gray-500 text-white p-2 rounded-lg w-full hover:bg-gray-600">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>


        // Tab functionality with sliding indicator
        const tabUpcoming = document.getElementById("tab-upcoming");
        const tabCompleted = document.getElementById("tab-completed");
        const upcomingEvents = document.getElementById("upcoming-events");
        const completedEvents = document.getElementById("completed-events");
        const tabIndicator = document.getElementById("tab-indicator");

        function updateIndicator(tabElement) {
            tabIndicator.style.width = `${tabElement.offsetWidth}px`;
            tabIndicator.style.left = `${tabElement.offsetLeft}px`;
        }

        tabUpcoming.addEventListener("click", () => {
            upcomingEvents.classList.remove("hidden");
            completedEvents.classList.add("hidden");
            updateIndicator(tabUpcoming);
        });

        tabCompleted.addEventListener("click", () => {
            completedEvents.classList.remove("hidden");
            upcomingEvents.classList.add("hidden");
            updateIndicator(tabCompleted);
        });

        // Initialize the default tab and indicator position
        tabUpcoming.click();
    </script>
</x-app-layout>
