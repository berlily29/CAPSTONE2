<x-app-layout>
    <div class="min-h-screen bg-gray-50 rounded-xl">
        <!-- Dashboard Header -->
        <section class="px-8 py-6">
            <h2 class="text-3xl font-bold text-pink-600">My Events</h2>
            <p class="text-pink-500 mt-2">Manage your upcoming and past events</p>
        </section>

        <!-- Tabs and Content Layout -->
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar for Tabs -->
            <div class="w-full md:w-64 bg-white border-b md:border-r border-gray-200">
                <nav class="flex md:flex-col">
                    <button class="tab-button flex-1 md:flex-none px-6 py-4 font-semibold text-gray-600 hover:bg-pink-50 transition-colors relative group" id="tab-upcoming">
                        <span class="relative z-10">Upcoming</span>
                        <div class="absolute inset-0 bg-pink-500 opacity-0 group-[.active]:opacity-100 transition-opacity"></div>
                    </button>
                    <button class="tab-button flex-1 md:flex-none px-6 py-4 font-semibold text-gray-600 hover:bg-pink-50 transition-colors relative group" id="tab-completed">
                        <span class="relative z-10">Completed</span>
                        <div class="absolute inset-0 bg-pink-500 opacity-0 group-[.active]:opacity-100 transition-opacity"></div>
                    </button>
                </nav>
            </div>

            <!-- Main Content Area for Events -->
            <div class="flex-1 p-6 bg-gradient-to-br from-white/30 to-pink-50/20">
                <div id="tab-content">
                    <!-- Upcoming Events -->
                    <div id="upcoming-events" class="grid grid-cols-2 gap-6">
                        @if($events->where('date', '>=', now())->isEmpty())
                            <div class="col-span-3 text-center p-8 rounded-xl bg-white/80 backdrop-blur-sm">
                                <div class="text-pink-500 text-2xl mb-4">🎈</div>
                                <h3 class="text-pink-600 font-semibold">No upcoming events</h3>
                                <p class="text-pink-500 text-sm mt-2">Start by joining new events!</p>
                            </div>
                        @else
                            @foreach ($events as $event)
                                @if (Carbon\Carbon::parse($event->date)->isFuture())
                                    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 hover:border-pink-100 group">
                                        <div class="flex justify-center mb-5">
                                            <div class="w-24 h-24 bg-gradient-to-br from-pink-500 to-sky-600 rounded-2xl flex items-center justify-center shadow-lg">
                                                <div class="text-center text-white">
                                                    <div class="text-sm font-bold tracking-wide">{{ Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                                    <div class="text-3xl font-black">{{ Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="text-lg font-bold text-pink-600 mb-2">{{ $event->title }}</h3>
                                        <div class="space-y-2 mb-5">
                                            <div class="flex items-center text-sm text-pink-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ Carbon\Carbon::parse($event->date)->format('F d, Y') }}
                                            </div>
                                            <div class="flex items-center text-sm text-pink-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $event->venue }}
                                            </div>
                                        </div>
                                        <a href="{{route('user.channel.index', ['id'=> $event->channel_id])}}"
                                           class="inline-flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-pink-500 to-sky-600 text-white rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
                                            View Channel
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- Completed Events -->
                    <div id="completed-events" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($events->where('date', '<', now())->isEmpty())
                            <div class="col-span-3 text-center p-8 rounded-xl bg-white/80 backdrop-blur-sm">
                                <div class="text-pink-500 text-2xl mb-4">📚</div>
                                <h3 class="text-pink-600 font-semibold">No past events</h3>
                                <p class="text-pink-500 text-sm mt-2">Your future events will appear here once completed</p>
                            </div>
                        @else
                            @foreach ($events as $event)
                                @if (Carbon\Carbon::parse($event->date)->isPast())
                                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 opacity-75 hover:opacity-100 transition-opacity">
                                        <div class="flex justify-center mb-5">
                                            <div class="w-24 h-24 bg-gradient-to-br from-gray-400 to-sky-400 rounded-2xl flex items-center justify-center shadow-lg">
                                                <div class="text-center text-white">
                                                    <div class="text-sm font-bold tracking-wide">{{ Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                                    <div class="text-3xl font-black">{{ Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="text-lg font-bold text-pink-600 mb-2">{{ $event->title }}</h3>
                                        <div class="space-y-2 mb-5">
                                            <div class="flex items-center text-sm text-pink-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ Carbon\Carbon::parse($event->date)->format('F d, Y') }}
                                            </div>
                                            <div class="flex items-center text-sm text-pink-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $event->venue }}
                                            </div>
                                        </div>
                                        <div class="w-full px-4 py-3 bg-gray-100 text-gray-500 rounded-xl font-semibold text-sm text-center">
                                            Event Completed
                                        </div>
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
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if(session('deleted'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'You’ve Left the Event',
                text: 'You have successfully left the event. We hope to see you again soon!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif



    <script>
        // Modern tab functionality with smooth transitions
        const tabs = {
            upcoming: {
                button: document.getElementById("tab-upcoming"),
                content: document.getElementById("upcoming-events")
            },
            completed: {
                button: document.getElementById("tab-completed"),
                content: document.getElementById("completed-events")
            }
        };

        function activateTab(activeTab) {
            // Remove all active states
            Object.values(tabs).forEach(({ button }) => {
                button.classList.remove('active', 'text-white', 'bg-pink-500');
                button.classList.add('text-gray-600');
            });

            // Hide all content
            Object.values(tabs).forEach(({ content }) => {
                content.classList.add('hidden');
            });

            // Activate selected tab
            activeTab.button.classList.add('active', 'text-white');
            activeTab.button.classList.remove('text-gray-600');
            activeTab.content.classList.remove('hidden');
            activeTab.content.classList.add('animate-fadeIn');
        }

        // Event listeners
        Object.entries(tabs).forEach(([key, tab]) => {
            tab.button.addEventListener('click', () => activateTab(tab));
        });

        // Initialize with upcoming events
        activateTab(tabs.upcoming);
    </script>
</x-app-layout>
