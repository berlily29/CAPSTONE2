<x-app-layout>


    <div class="w-full bg-white rounded-lg px-8 py-2">
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
                    <div id="open-events" class="tab-content">
                        @include('user.find-events.open')
                    </div>

                    <div id="nearby" class="tab-content">
                        @include('user.find-events.nearby')
                    </div>

                    <div id="recommended" class="tab-content">
                        @include('user.find-events.recommended')
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
     function showTab(tabName) {
    // Save selected tab in session storage
    sessionStorage.setItem('event_tab', tabName);

    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');

    });

    // Show the selected tab
    const selectedTab = document.getElementById(tabName);
    if (selectedTab) {
        selectedTab.classList.remove('hidden');
    }


    // Reset active tab buttons
    document.querySelectorAll('.border-b.mb-4 button').forEach(button => {
        button.classList.remove('text-pink-500');
        button.classList.add('border-transparent', 'text-black');
    });

    // Highlight the active tab button
    const activeButton = document.getElementById(`${tabName}-tab`);
    if (activeButton) {
        activeButton.classList.add('text-pink-500');

        // Adjust tab highlight position
        const highlight = document.getElementById('tab-highlight');
        if (highlight) {
            setTimeout(() => {
                highlight.style.left = activeButton.offsetLeft + 'px';
                highlight.style.width = activeButton.offsetWidth + 'px';
            }, 50);
        }
    }
}

// Set default tab to "Open Events"
document.addEventListener('DOMContentLoaded', function () {
    let deftab = sessionStorage.getItem('event_tab') || 'open-events';
    showTab(deftab);
});

    </script>
</x-app-layout>
