<x-app-layout>
    <div class="py-3 px-10 bg-white border-b border-gray-200">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-lg text-black">Manage</h1>
            <h1 class="text-3xl font-bold text-black">Pending Requests</h1>
        </div>
    
        <!-- Tabs Section -->
        <div class="relative flex items-center space-x-0" style="margin-left: 0;">
            <!-- Users Tab -->
            <button id="users-tab" 
                    class="px-3 py-2 font-medium text-pink-500 focus:outline-none"
                    onclick="showTab('users')">
                Users
            </button>
            <!-- Events Tab -->
            <button id="events-tab" 
                    class="px-3 py-2 font-medium text-black-500 focus:outline-none hover:text-black"
                    onclick="showTab('events')">
                Events
            </button>
            <!-- Pink Line Highlight -->
            <div id="tab-highlight" 
                 class="absolute bottom-0 h-1 bg-pink-500 transition-all"
                 style="left: 0; width: 60px;"></div>
        </div>
    
        <!-- Users Tab Content -->
        <div id="users" class="tab-content px-4 mt-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Active Request</h2>
            <!-- Table -->
            <!-- Table Section -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="py-3 px-4 text-left">User Name</th>
                            <th class="py-3 px-4 text-left">Request Type</th>
                            <th class="py-3 px-4 text-left">Date Requested</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4"></th> <!-- For additional actions -->
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        <!-- Row 1 -->
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                                John Doe
                            </td>
                            <td class="py-3 px-4">Account Verification</td>
                            <td class="py-3 px-4">Jan 15, 2025</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 text-sm rounded-lg bg-yellow-100 text-yellow-600">
                                    Pending
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <button class="text-gray-500 hover:text-gray-700">
                                    ...
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                                Jane Smith
                            </td>
                            <td class="py-3 px-4">Password Reset</td>
                            <td class="py-3 px-4">Jan 12, 2025</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 text-sm rounded-lg bg-green-100 text-green-600">
                                    Approved
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <button class="text-gray-500 hover:text-gray-700">
                                    ...
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                                Michael Brown
                            </td>
                            <td class="py-3 px-4">Account Update</td>
                            <td class="py-3 px-4">Jan 10, 2025</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 text-sm rounded-lg bg-red-100 text-red-600">
                                    Rejected
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <button class="text-gray-500 hover:text-gray-700">
                                    ...
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- Events Tab Content -->
        <div id="events" class="tab-content hidden px-4 mt-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Events Request</h2>
            <p>No events requests at this moment.</p>
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
            const allTabButtons = document.querySelectorAll('.flex button');
            allTabButtons.forEach(button => {
                button.classList.remove('text-pink-500');
                button.classList.add('text-gray-500');
            });
    
            // Highlight the active tab button
            const activeButton = document.getElementById(`${tabName}-tab`);
            if (activeButton) {
                activeButton.classList.add('text-pink-500');
                activeButton.classList.remove('text-gray-500');
    
                // Adjust the pink highlight position
                const highlight = document.getElementById('tab-highlight');
                if (highlight) {
                    highlight.style.left = `${activeButton.offsetLeft}px`;
                    highlight.style.width = `${activeButton.offsetWidth}px`;
                }
            }
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            // Set the default active tab to "users"
            showTab('users');
        });
    </script>
    
    
</x-app-layout>
