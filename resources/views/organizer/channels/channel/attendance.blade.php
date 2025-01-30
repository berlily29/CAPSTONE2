<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 p-6 bg-gray-50 shadow-md rounded-lg">
        <!-- Tab Navigation -->
        <div class="flex flex-col">
            <button id="attendanceTab" class="mb-2 px-4 py-2 text-sm font-semibold text-gray-700 bg-pink-100 hover:bg-pink-200 focus:outline-none focus:bg-pink-200 focus:ring focus:ring-pink-200 transition-all duration-300 rounded-lg">
                Attendance Encoding
            </button>
            <button id="attendeesTab" class="px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-pink-100 focus:outline-none focus:bg-pink-100 focus:ring focus:ring-pink-200 transition-all duration-300 rounded-lg">
                List of Attendees
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 bg-white shadow-md rounded-lg ml-6">
        <!-- Tab Content -->
        <div id="attendanceEncoding" class="tab-content">
            <!-- Attendance Encoding Form -->
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Generate Attendance Token</h2>
            <div id="generateSection">
                <!-- Attendance Encoding Form Content -->
            </div>
        </div>

        <div id="listOfAttendees" class="tab-content hidden">
            <!-- List of Attendees Table -->
            <h2 class="text-lg font-semibold text-gray-700 mb-4">List of Attendees</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 py-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Token</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Only show encoded attendees -->
                         @foreach($attendees as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center text-sm text-gray-700 font-medium">
                                {{$item->user->fullname}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{$item->token}} </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-sm font-medium rounded-lg bg-green-100 text-green-600">Encoded</span>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tailwind JS for switching tabs -->
<script>
    // Set the Attendance Encoding tab to be active by default
    document.getElementById('attendanceEncoding').classList.remove('hidden');
    document.getElementById('listOfAttendees').classList.add('hidden');
    document.getElementById('attendanceTab').classList.add('bg-pink-100');

    document.getElementById('attendanceTab').addEventListener('click', function () {
        document.getElementById('attendanceEncoding').classList.remove('hidden');
        document.getElementById('listOfAttendees').classList.add('hidden');
        this.classList.add('bg-pink-100');
        document.getElementById('attendeesTab').classList.remove('bg-pink-100');
    });

    document.getElementById('attendeesTab').addEventListener('click', function () {
        document.getElementById('attendanceEncoding').classList.add('hidden');
        document.getElementById('listOfAttendees').classList.remove('hidden');
        this.classList.add('bg-pink-100');
        document.getElementById('attendanceTab').classList.remove('bg-pink-100');
    });
</script>
