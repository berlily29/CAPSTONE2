<x-app-layout>
    <div class="min-h-screen bg-white rounded-lg">

        <!-- Dashboard Header -->
        <section class="text-center md:text-left p-8">
            <h2 class="text-3xl font-black text-gray-700">My Events</h2>
        </section>

        <hr class="opacity-70">
        <!-- Tabs for Upcoming and Completed Events -->
        <div class="bg-white">
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
                <div id="upcoming-events" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($events as $event)
                        @if (Carbon\Carbon::parse($event->date)->isFuture())
                            <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200 h-full flex flex-col justify-between">
                                <!-- Custom Date Icon -->
                                <div class="flex justify-center items-center mb-4">
                                    <div class="flex items-center justify-center w-20 h-20 bg-pink-500 text-white rounded-full">
                                        <div class="text-center">
                                            <div class="text-lg font-bold">{{ Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                            <div class="text-2xl font-extrabold">{{ Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-800">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">Date: {{ Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                                <p class="text-sm text-gray-600">Location: {{ $event->venue }}</p>
                                <a href="" class="mt-4 bg-pink-500 text-white p-2 rounded-lg w-full text-center hover:bg-pink-600">
                                    Enter Channel &gt;&gt;
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Completed Events (Hidden by Default) -->
                <div id="completed-events" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($events as $event)
                        @if (Carbon\Carbon::parse($event->date)->isPast())
                            <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200 h-full flex flex-col justify-between">
                                <!-- Custom Date Icon -->
                                <div class="flex justify-center items-center mb-4">
                                    <div class="flex items-center justify-center w-20 h-20 bg-gray-500 text-white rounded-full">
                                        <div class="text-center">
                                            <div class="text-lg font-bold">{{ Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                            <div class="text-2xl font-extrabold">{{ Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-800">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">Date: {{ Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                                <p class="text-sm text-gray-600">Location: {{ $event->venue }}</p>
                                <a href="" class="mt-4 bg-gray-500 text-white p-2 rounded-lg w-full text-center hover:bg-gray-600">
                                    Enter Channel &gt;&gt;
                                </a>
                            </div>
                        @endif
                    @endforeach
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
