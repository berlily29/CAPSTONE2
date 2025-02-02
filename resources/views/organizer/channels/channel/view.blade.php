
<head><meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<x-app-layout>

    <div class="w-full bg-white rounded-lg p-8">
        <div class="w-full">

            <div class="flex justify-between items-center pr-4">

                <button onclick="history.back()"
                class="inline-flex items-center mb-4 px-4 py-2 bg-pink-600 text-white border border-pink-600 font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Return to my events
                </button>

            </div>


            <div class="bg-white overflow-hidden shadow-sm">

            <div class="flex justify-between">
                <div>
                    <h1 class="text-sm font-medium text-gray-500">Channel</h1>
                    <h1 class="mb-4 text-3xl font-black text-gray-700">{{$event->title}}</h1>
                </div>

                <div>
                    @if($event->status == 'upcoming' )
                    <form action="{{route('eo.channels.done', ['id'=> $event->event_id])}}" method = "POST">
                        @csrf
                        <button id = "markDoneBtn" type = "button" class="text-white bg-green-600 hover:bg-green-700 transition ease-in duration-300 py-2 px-8 flex items-center gap-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            Mark Event as Done </button>
                    </form>
                    @else
                    <span  class="text-white bg-green-400 transition ease-in duration-300 py-2 px-8 flex items-center gap-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            Event Completed </button>
                    </form>
                    @endif
                </div>

            </div>


                <hr class="opacity-65">

                <div class="w-full">
                    <!-- Navigation Tabs -->
                    <div class="flex border-b mb-4 relative">
                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('announcements')">Announcements</button>
                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('stories')">Stories</button>
                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                        onclick="showTab('volunteers')">Volunteers</button>
                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('event-details')">Event Details</button>


                        <button class="tab-btn px-4 py-2 font-semibold text-black hover:text-gray-600 focus:outline-none transition duration-300 ease-in-out"
                                onclick="showTab('attendance')">Attendance</button>



                        <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/3 h-1 bg-pink-500 transition-all duration-300 ease-in-out"></div>
                    </div>

                    <!-- Tab Contents -->
                    <div class="w-full">
                        <!-- Announcements Tab -->
                        <div id="announcements" class="tab-content hidden">
                            @include('organizer.channels.channel.announcements')
                        </div>

                        <!-- Stories Tab -->
                        <div id="stories" class="tab-content hidden">
                            @include('organizer.channels.channel.stories')
                        </div>

                          <!-- Announcements Tab -->
                          <div id="volunteers" class="tab-content hidden">
                            @include('organizer.channels.channel.volunteers')
                        </div>




                        <!-- Event Details Tab -->
                        <div id="event-details" class="tab-content hidden">
                            @include('user.channel.details')
                        </div>

                        <!-- Attendance Tab -->
                        <div id="attendance" class="tab-content hidden">
                        @if($event->status ==='done')
                        @include('organizer.channels.channel.attendance2')
                        @else
                        @include('organizer.channels.channel.attendance')

                        @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>

document.addEventListener("DOMContentLoaded", function () {
    const markDoneBtn = document.getElementById("markDoneBtn");

    if (markDoneBtn) {
        markDoneBtn.addEventListener("click", function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to mark this event as done!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, mark as done!"
            }).then(async (result) => {  // ✅ Make this an async function
                if (result.isConfirmed) {
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        const form = markDoneBtn.closest('form');

                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            },

                        });

                        const result = await response.json(); // ✅ Use 'await' properly

                        Swal.fire({
                            title: "Success!",
                            text: "Event has been marked as done.",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });

                    } catch (error) {
                        console.error("Error:", error);
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong. Please try again.",
                            icon: "error"
                        });
                    }
                }
            });
        });
    }
});




        function showTab(tabName) {

            sessionStorage.setItem("active", tabName);

            // Hide all tabs
            const allTabs = document.querySelectorAll('.tab-content');
            allTabs.forEach(tab => tab.classList.add('hidden'));

        // Remove active state from all buttons
            const allTabButtons = document.querySelectorAll('.tab-btn');
            allTabButtons.forEach(button => button.classList.remove('font-bold', 'border-b-4', 'border-pink-600'));

            // Show the selected tab
            const selectedTab = document.getElementById(tabName);
            if (selectedTab) selectedTab.classList.remove('hidden');

            // Highlight the active button
            const activeButton = document.querySelector(`[onclick="showTab('${tabName}')"]`);
            if (activeButton) activeButton.classList.add('font-bold', 'border-b-4', 'border-pink-600');

            // Update the highlight position and width
            const highlight = document.getElementById('tab-highlight');
            highlight.style.left = activeButton.offsetLeft + 'px';
            highlight.style.width = activeButton.offsetWidth + 'px';
        }

        // Initialize the page with the default tab
        document.addEventListener('DOMContentLoaded', function () {
            const defTab = sessionStorage.getItem("active") ? sessionStorage.getItem("active") : 'announcements'

            showTab(defTab);

        });







    </script>
</x-app-layout>
