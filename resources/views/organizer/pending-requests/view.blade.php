<x-app-layout>
    <div class="w-full bg-white rounded-lg p-8">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm">
            <h1 class="ml-2 text-sm font-bold text-gray-500">Events</h1>
                <h1 class="ml-2 text-3xl font-black text-gray-700">Pending Requests</h1>

                <hr class="opacity-65 my-4">

                <!-- Navigation Tabs -->
                <div class="flex border-b mb-4 relative">

                    <button id="pending-tab" class="px-4 py-2 font-medium border-b-2 focus:outline-none text-black" onclick="showTab('pending')">
                        Pending
                    </button>

                    <button id="rejected-tab" class="px-4 py-2 font-medium border-b-2 focus:outline-none text-black" onclick="showTab('rejected')">
                        Rejected
                    </button>
                    <!-- Active Tab Highlight -->
                    <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/4 h-1 bg-pink-500 transition-all"></div>
                </div>

                <!-- Tab Contents -->
                <div id="all" class="tab-content">
                    <!-- All Events -->
                    <div class="grid xs:grid-cols-1 grid-cols-2 gap-6 mt-4">
                        @foreach($submittedEvents as $event)
                            <div class="bg-white p-6 shadow-lg border border-gray-200 rounded-lg relative">
                                <span class="absolute top-0 left-0 h-full w-2 bg-pink-500"></span>
                                <div class="flex justify-between items-start pl-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                        <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach($event->event_category as $category_id)
                                                @php
                                                    $category = \App\Models\EventCategories::find($category_id);
                                                @endphp
                                                <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <!-- Pending Status -->
                            @if($event->approved == 0)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-yellow-200 text-yellow-600 rounded-lg">
                                    Pending
                                </span>
                            </div>
                            @elseif ($event->approved == 1)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-green-200 text-green-600 rounded-lg">
                                    Approved
                                </span>
                            </div>
                            @else
                            <div class="mt-4">
                            <span class="px-4 py-2 text-sm font-medium bg-red-200 text-red-600 rounded-lg">
                                Rejected
                            </span>
                            </div>
                            @endif
                                    </div>
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
                </div>

                <div id="pending" class="tab-content hidden">
                    <!-- Pending Events -->
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        @foreach($submittedEvents as $event)
                            @if($event->approved == 0)
                                <div class="bg-white p-6 shadow-lg border border-gray-200 rounded-lg relative">
                                    <span class="absolute top-0 left-0 h-full w-2 bg-pink-500"></span>
                                    <div class="flex justify-between items-start pl-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                            <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach($event->event_category as $category_id)
                                                    @php
                                                        $category = \App\Models\EventCategories::find($category_id);
                                                    @endphp
                                                    <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <!-- Pending Status -->
                            @if($event->approved == 0)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-yellow-200 text-yellow-600 rounded-lg">
                                    Pending
                                </span>
                            </div>
                            @elseif ($event->approved == 1)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-green-200 text-green-600 rounded-lg">
                                    Approved
                                </span>
                            </div>
                            @else
                            <div class="mt-4">
                            <span class="px-4 py-2 text-sm font-medium bg-red-200 text-red-600 rounded-lg">
                                Rejected
                            </span>
                            </div>
                            @endif


                                        </div>
                                        <div class="flex items-center justify-center h-full">
                                            <a href="" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                                                <span class="material-icons">info</span>
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div id="approved" class="tab-content hidden">
                    <!-- Approved Events -->
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        @foreach($submittedEvents as $event)
                            @if($event->approved == 1)
                                <div class="bg-white p-6 shadow-lg border border-gray-200 rounded-lg relative">
                                    <span class="absolute top-0 left-0 h-full w-2 bg-pink-500"></span>
                                    <div class="flex justify-between items-start pl-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                            <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach($event->event_category as $category_id)
                                                    @php
                                                        $category = \App\Models\EventCategories::find($category_id);
                                                    @endphp
                                                    <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <!-- Pending Status -->
                            @if($event->approved == 0)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-yellow-200 text-yellow-600 rounded-lg">
                                    Pending
                                </span>
                            </div>
                            @elseif ($event->approved == 1)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-green-200 text-green-600 rounded-lg">
                                    Approved
                                </span>
                            </div>
                            @else
                            <div class="mt-4">
                            <span class="px-4 py-2 text-sm font-medium bg-red-200 text-red-600 rounded-lg">
                                Rejected
                            </span>
                            </div>
                            @endif

                                        </div>
                                        <div class="flex items-center justify-center h-full">
                                            <a href="" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                                                <span class="material-icons">info</span>
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div id="rejected" class="tab-content hidden">
                    <!-- Rejected/Terminated Events -->
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        @foreach($submittedEvents as $event)
                            @if($event->approved == 2)
                                <div class="bg-white p-6 shadow-lg border border-gray-200 rounded-lg relative">
                                    <span class="absolute top-0 left-0 h-full w-2 bg-pink-500"></span>
                                    <div class="flex justify-between items-start pl-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                            <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach($event->event_category as $category_id)
                                                    @php
                                                        $category = \App\Models\EventCategories::find($category_id);
                                                    @endphp
                                                    <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <!-- Pending Status -->
                            @if($event->approved == 0)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-yellow-200 text-yellow-600 rounded-lg">
                                    Pending
                                </span>
                            </div>
                            @elseif ($event->approved == 1)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-green-200 text-green-600 rounded-lg">
                                    Approved
                                </span>
                            </div>
                            @else
                            <div class="mt-4">
                            <span class="px-4 py-2 text-sm font-medium bg-red-200 text-red-600 rounded-lg">
                                Rejected
                            </span>
                            </div>
                            @endif

                                        </div>
                                        <div class="flex items-center justify-center h-full">
                                            <a href="" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                                                <span class="material-icons">info</span>
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
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
            const allTabButtons = document.querySelectorAll('button');
            allTabButtons.forEach(button => {
                button.classList.remove('text-pink-500');
                button.classList.add('text-black');
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

        // Set default tab to "All Events"
        document.addEventListener('DOMContentLoaded', function () {
            showTab('pending');
        });
    </script>
</x-app-layout>
