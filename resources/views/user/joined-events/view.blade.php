<x-app-layout>
    <div class="min-h-screen bg-white rounded-lg">
        <!-- Dashboard Header -->
        <section class="text-center md:text-left p-8">
            <h2 class="text-3xl font-black text-gray-700">My Events</h2>
        </section>

        <hr class="opacity-70">

        <!-- Tabs and Content Layout -->
        <div class="flex">

            <!-- Sidebar for Tabs -->
            <div class="w-1/5 bg-white border-r border-gray-200">
                <nav class="flex flex-col">
                    <button class="tab-button text-center p-4  font-semibold border-b border-gray-200 text-gray-800 hover:text-pink-600 focus:outline-none relative" id="tab-upcoming">
                        Upcoming
                    </button>
                    <button class="tab-button p-4 text-center font-semibold text-gray-800 hover:text-pink-600 focus:outline-none relative" id="tab-completed">
                        Completed
                    </button>
                </nav>
            </div>

            <!-- Main Content Area for Events -->
            <div class="flex-1 p-6">
                <div id="tab-content">
                    <!-- Upcoming Events -->
                    <div id="upcoming-events" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($events->where('date', '>=', now())->isEmpty())
                            <div class="col-span-3 text-center py-8 text-lg font-semibold text-gray-600">
                                No upcoming events
                            </div>
                        @else
                            @foreach ($events as $event)
                                @if (Carbon\Carbon::parse($event->date)->isFuture())
                                    <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200 h-full flex flex-col justify-between">
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
                                        <a href="{{route('user.channel.index', ['id'=> $event->channel_id])}}" class="mt-4 bg-pink-500 text-white p-2 rounded-lg w-full text-center hover:bg-pink-600">
                                            Enter Channel &gt;&gt;
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- Completed Events (Hidden by Default) -->
                    <div id="completed-events" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($events->where('date', '<', now())->isEmpty())
                            <div class="col-span-3 text-center py-8 text-lg font-semibold text-gray-600">
                                No completed events
                            </div>
                        @else
                            @foreach ($events as $event)
                                @if (Carbon\Carbon::parse($event->date)->isPast())
                                    <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200 h-full flex flex-col justify-between">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if (session('joined'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Successfully Joined!',
                text: 'You have successfully joined the event.',
                confirmButtonText: 'OK',
            });
        </script>
    @endif

    <script>
        // Tab functionality with active tab background color change
        const tabUpcoming = document.getElementById("tab-upcoming");
        const tabCompleted = document.getElementById("tab-completed");
        const upcomingEvents = document.getElementById("upcoming-events");
        const completedEvents = document.getElementById("completed-events");

        function setActiveTab(tabElement) {
            // Remove active background from all tabs
            const tabs = document.querySelectorAll(".tab-button");
            tabs.forEach(tab => tab.classList.remove("bg-pink-500", "text-white", "font-semibold"));

            // Add active background and text color to the selected tab
            tabElement.classList.add("bg-pink-500", "text-white", "font-semibold");
        }

        tabUpcoming.addEventListener("click", () => {
            upcomingEvents.classList.remove("hidden");
            completedEvents.classList.add("hidden");
            setActiveTab(tabUpcoming);
        });

        tabCompleted.addEventListener("click", () => {
            completedEvents.classList.remove("hidden");
            upcomingEvents.classList.add("hidden");
            setActiveTab(tabCompleted);
        });

        // Initialize the default tab as 'Upcoming'
        tabUpcoming.click();
    </script>
</x-app-layout>
