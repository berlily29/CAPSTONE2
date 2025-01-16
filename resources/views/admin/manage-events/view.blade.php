<x-app-layout>
<div class="">
    <div class="p-5 bg-gray-50 min-h-screen">
    
    <div class="mb-3 pl-2">
        <h1 class="text-lg text-gray-800">Manage</h1>
        <h1 class="text-3xl font-bold text-gray-800">Events</h1>        
    </div>

    <div class="flex border-b mb-4 relative">
        <div class="nav-tabs flex items-center space-x-4">
            <button id="active-tab" class="px-2 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black" onclick="showTab('active')">
                Active
            </button>
            
            <button id="post-events-tab" class="text-left  px-4 py-1 font-medium border-b-2 focus:outline-none border-transparent text-black" onclick="showTab('post-events')">
                Post Events
            </button>
        </div>

        <div class="flex justify-end w-3/4">
            <button id="" class="bg-pink-500 text-white py-2 px-2 rounded-2xl mb-3 flex justify-center font-semibold hover:bg-pink-600">
                <span class="flex material-icons mr-2">schedule</span>
                Create Event
            </button>
        </div>


        <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/3 h-1 bg-pink-500 transition-all"></div>
        </div>

        <!--Active-->
        <div id="active" class="tab-content hidden px-4">
            <h2 class="text-lg font-semibold text-gray-700">Active Events</h2>
        </div>

        <!-- Post events -->
        <div id="post-events" class="tab-content hidden px-4">
            <h2 class="text-lg font-semibold text-gray-700">Post Events</h2>
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
            const allTabButtons = document.querySelectorAll('.nav-tabs button');
            allTabButtons.forEach(button => {
                button.classList.remove( 'text-pink-500');
                button.classList.add('border-transparent', 'text-black');
            });

            // Highlight the active tab button
            const activeButton = document.getElementById(`${tabName}-tab`);
            if (activeButton) {
                activeButton.classList.add( 'text-pink-500');
            }
            // Adjust the tab highlight under the active tab
            const highlight = document.getElementById('tab-highlight');
            if (highlight && activeButton) {
                highlight.style.left = activeButton.offsetLeft + 'px';
                highlight.style.width = activeButton.offsetWidth + 'px';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            showTab('active');
        });
    </script>
</x-app-layout>
