<head>

<meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

      <!--Mat-Icon -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">



    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        a {
            cursor: pointer;
        }
    </style>
</head>

<head><meta name="csrf-token" content="{{ csrf_token() }}">
</head>




    <div class="w-full bg-white rounded-lg p-8">
        <div class="w-full">



            <div class="bg-white overflow-hidden shadow-sm">

            <div class="flex justify-between">
                <div>
                    <h1 class="text-sm font-medium text-gray-500">Channel</h1>
                    <h1 class="mb-4 text-3xl font-black text-gray-700">{{$event->title}}</h1>
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
                        onclick="showTab('volunteers')">Channel Members</button>
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
                            @include('admin.manage-events.announcements')
                        </div>

                        <!-- Stories Tab -->
                        <div id="stories" class="tab-content hidden">
                            @include('admin.manage-events.stories')
                        </div>

                          <!-- Announcements Tab -->
                          <div id="volunteers" class="tab-content hidden">
                            @include('admin.manage-events.volunteers')
                        </div>




                        <!-- Event Details Tab -->
                        <div id="event-details" class="tab-content hidden">
                            @include('user.channel.details')
                        </div>

                        <!-- Attendance Tab -->
                        <div id="attendance" class="tab-content hidden">
                        @include('admin.manage-events.attendance2')


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



<script>
    // Approve Button Click Handler
    document.getElementById('approveButton').addEventListener('click', function () {
        Swal.fire({
            title: "Do you want to approve this event?",
            showCancelButton: true,
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('approveButton').closest('form'); // Get the form
                const actionUrl = form.getAttribute('action'); // Form action URL
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Get CSRF token

                // Send the approval request via fetch
                fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Event has been approved',
                                showConfirmButton: false,
                                timer: 1500

                            }).then(() => {
                                window.close(); // Close the current window
                                window.opener.location.reload(); // Reload the parent window
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to approve the event. Please try again.',
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again later.',
                        });
                    });
            }
        });
    });

    // Reject Button Click Handler
    document.getElementById('rejectButton').addEventListener('click', function () {

                let event_id = "{{$event->event_id}}";
                console.log(event_id);
                window.location.href = `/admin/pending-request/event/${event_id}/termination`;

    });
</script>
