<x-app-layout>
<div class="pr-4">
    <div class="p-8 bg-gray-50 border-b border-gray-200 min-h-screen">
    
    <div class="mb-3 pl-2">
        <h1 class="text-lg text-gray-800">Manage</h1>
        <h1 class="text-3xl font-bold text-gray-800">Pending Requests</h1>        
    </div>
        
    <div class="flex border-b mb-4 relative">
        <div class="nav-tabs flex items-center space-x-4">
            <button id="users-tab" class="px-2 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black" onclick="showTab('users')">
                Users
            </button>
            
            <button id="events-tab" class="px-4 py-1 font-medium border-b-2 focus:outline-none border-transparent text-black" onclick="showTab('events')">
                 Events
            </button>
        </div>

        <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/3 h-1 bg-pink-500 transition-all"></div>
        </div>

        <!--Active-->
        <div id="users" class="tab-content hidden px-4">
            <h2 class="text-lg font-semibold text-gray-700">Users Request</h2>
        </div>

        <!-- Post events -->
        <div id="events" class="tab-content hidden px-4">
            <h2 class="text-lg font-semibold text-gray-700"> Events Request</h2>
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
            showTab('users');
        });
    </script>

</x-app-layout>
