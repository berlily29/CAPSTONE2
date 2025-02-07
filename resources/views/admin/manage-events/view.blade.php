<x-app-layout>
    <div class="py-8 px-10 bg-white border-b border-gray-200 rounded-lg">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-lg text-gray-500 font-semibold">Manage</h1>
            <h1 class="text-3xl font-black text-gray-700">All Events</h1>
        </div>

        <!-- Tabs with Slider -->
        <div class="relative flex border-b border-gray-200 mb-4">
            <button onclick="showTab('active', this)" id="tab-active"
                class="relative px-6 py-3 text-sm font-medium text-gray-600 focus:outline-none">
                Active Events
            </button>
            <button onclick="showTab('archived', this)" id="tab-archived"
                class="relative px-6 py-3 text-sm font-medium text-gray-600 focus:outline-none">
                Archived Events
            </button>
            <!-- Pink Indicator Slider -->
            <div id="tab-indicator" class="absolute bottom-0 h-1 bg-pink-600 transition-all duration-300 rounded"></div>
        </div>

        <div class="w-full bg-white flex flex-col">
            <!-- Active Events Table -->
            <div id="active-events" class="overflow-x-auto border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Event Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organizer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($upcoming as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $event->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->organizer->user->fullname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('m-d-Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <button onclick="openEventPopup('{{ route('admin.manage-events.view', $event->event_id) }}')"
                                        class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 text-sm font-medium rounded-lg">
                                        VIEW
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if ($upcoming->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No active events.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Archived Events Table (Initially Hidden) -->
            <div id="archived-events" class="overflow-x-auto border border-gray-200 hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Event Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organizer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($done as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $event->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->organizer->user->fullname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('m-d-Y') }}</td>
                            </tr>
                        @endforeach

                        @if ($done->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No archived events.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function showTab(tab, element) {
        // Hide both tables
        document.getElementById('active-events').classList.add('hidden');
        document.getElementById('archived-events').classList.add('hidden');

        // Show the selected table
        if (tab === 'active') {
            document.getElementById('active-events').classList.remove('hidden');
        } else {
            document.getElementById('archived-events').classList.remove('hidden');
        }

        // Move the pink indicator under the active tab
        const indicator = document.getElementById('tab-indicator');
        indicator.style.width = `${element.offsetWidth}px`;
        indicator.style.transform = `translateX(${element.offsetLeft}px)`;
    }

    // Set default active tab on page load
    document.addEventListener("DOMContentLoaded", function() {
        const activeTab = document.getElementById('tab-active');
        showTab('active', activeTab);
    });

    function openEventPopup(url) {
        const width = 1000;
        const height = 600;
        const left = (window.innerWidth - width) / 2;
        const top = (window.innerHeight - height) / 2;
        window.open(url, '_blank', `width=${width},height=${height},left=${left},top=${top}`);
    }
</script>
