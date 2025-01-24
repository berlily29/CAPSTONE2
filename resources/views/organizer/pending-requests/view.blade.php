<x-app-layout>
    <div class="w-full bg-white rounded-lg p-8">
        <div class="w-full">
            <div class="flex flex-col bg-white overflow-hidden ">

                <div class="flex justify-between">
                    <div flex flex-col>
                        <h1 class="ml-2 text-sm  text-gray-500">Events</h1>
                        <h1 class="ml-2 text-3xl font-black text-gray-700">Pending Requests</h1>
                    </div>


                    <a href="{{route('eo.request-event')}}" class="w-[15%] flex items-center justify-center gap-2 bg-pink-500 text-white py-2 px-6 rounded-lg hover:bg-pink-600 transition-all">
                        <span class="material-icons">add_circle</span>
                        <span>Host an Event</span>
                    </a>
                </div>


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
                <div id="pending" class="tab-content">
                    <!-- All Events -->
                    @if($pendings->count()==0)
                    <div class="w-full flex justify-center my-4">
                        <h1 class="text-sm text-gray-300 italic">
                            No data available
                        </h1>
                    </div>
                    @else
                        @include('organizer.pending-requests.pending')
                    @endif
                </div>





                <div id="rejected" class="tab-content hidden">
                @if($terminated->count()==0)
                    <div class="w-full flex justify-center my-4">
                        <h1 class="text-sm text-gray-300 italic">
                            No data available
                        </h1>
                    </div>
                    @else
                        @include('organizer.pending-requests.terminated')
                    @endif
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
