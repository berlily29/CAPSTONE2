<x-app-layout>

<div id="loader" class="hidden absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
<div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-pink-500"></div>
        <p class="mt-4 text-gray-700">Processing, please wait...</p>
    </div>
</div>



    <div class="py-8 px-10 bg-white border-b border-gray-200 rounded-lg">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-lg text-gray-500 font-semibold">Manage</h1>
            <h1 class="text-3xl font-black text-gray-700">Applications</h1>
        </div>

        <!-- Tabs Section -->
        <div class="relative flex items-center space-x-0" style="margin-left: 0;">
            <!-- Users Tab -->
            <button id="users-tab"
                    class="px-3 py-2 font-medium text-pink-500 focus:outline-none"
                    onclick="showTab('users')">
                User Requests
            </button>
            <!-- Events Tab -->
            <button id="eo_application-tab"
                    class="px-3 py-2 font-medium text-gray-500 focus:outline-none hover:text-gray-700"
                    onclick="showTab('eo_application')">
                Event Organizer Requests
            </button>
            <!-- Pink Line Highlight -->
            <div id="tab-highlight"
                 class="absolute bottom-0 h-1 bg-pink-500 transition-all"
                 style="left: 0; width: 60px;"></div>
        </div>

        <!-- Users Tab Content -->
        <div id="users" class="tab-content mt-4 pb-4">
            @include('admin.pending-request.users')
        </div>

        <!-- eo_application Tab Content -->
        <div id="eo_application" class="tab-content hidden px-4 mt-4">
            @include('admin.pending-request.eventorganizer')
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="myModal" class="modal hidden fixed inset-0 bg-gray-700 bg-opacity-25 flex items-center justify-center">
        <div class="modal-content p-5 bg-white shadow-2xl rounded-2xl w-full max-w-3xl h-auto max-h-[90vh] overflow-y-auto relative">
            <span class="absolute right-6 text-white close-modal cursor-pointer material-icons bg-red-500 w-10 p-2 hover:bg-red-600 rounded-xl mt-2">close</span>
            <div id="modal-body">
                <!-- User details will be populated here -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

          let admin_pending_active = sessionStorage.getItem('admin_pending_active')
            if (admin_pending_active === null) {
                showTab('users');
            } else {
                showTab(admin_pending_active)
            }

        function showTab(tabName) {
            sessionStorage.setItem('admin_pending_active', tabName);

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

            const modal = document.getElementById('myModal');
            const closeModalSpan = document.querySelector('.close-modal');

            // Open modal when button is clicked
            document.querySelectorAll('.openModal').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-user-id');
                    const userEmail = this.getAttribute('data-user-email');
                    const userName = this.getAttribute('data-user-name');
                    const userMobile = this.getAttribute('data-user-mobile');
                    const userAge = this.getAttribute('data-user-age');
                    const userGender = this.getAttribute('data-user-gender');
                    const userHouseNo = this.getAttribute('data-user-house-no');
                    const userStreet = this.getAttribute('data-user-street');
                    const userBrgy = this.getAttribute('data-user-brgy');
                    const userCity = this.getAttribute('data-user-city');
                    const userProvince = this.getAttribute('data-user-province');
                    const userPostalCode = this.getAttribute('data-user-postal-code');
                    const userIDType = this.getAttribute('data-user-ID-Type');
                    const userIDAttachment = this.getAttribute('data-user-ID-attachment');

                    // Populate modal with user details
                    document.getElementById('modal-body').innerHTML = `
                        <div class="mb-6 w-full p-4">
                            <h3 class="text-lg font-bold mt-2 text-gray-700 mb-2">Personal Information</h3>
                            <h3 class="text-sm text-gray-400 mb-2 mt-4">Full Name</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="border border-gray-300 rounded-md p-4">
                                    <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">First Name</h2>
                                    <p class="font-bold text-lg text-gray-600">${userName.split(' ')[0]}</p>
                                </div>
                                <div class="border border-gray-300 rounded-md p-4">
                                    <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Middle Name</h2>
                                    <p class="font-bold text-lg text-gray-600">${userName.split(' ')[1] || ''}</p>
                                </div>
                                <div class="border border-gray-300 rounded-md p-4">
                                    <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Last Name</h2>
                                    <p class="font-bold text-lg text-gray-600">${userName.split(' ')[2]}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-[60%_20%_20%] mb-4">
                        <div class="w-[95%] border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Mobile No.</h2>
                            <p class="font-bold text-lg text-gray-600">${userMobile}</p>
                        </div>
                        <div class="w-[90%] border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Age</h2>
                            <p class="font-bold text-lg text-gray-600">${userAge}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Gender</h2>
                            <p class="font-bold text-lg text-gray-600">${userGender === 'male' ? 'M' : 'F'}</p>
                        </div>
                    </div>
                    <h3 class="text-sm text-gray-400 mb-2 mt-4">Complete Address</h3><div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">House No.</h2>
                            <p class="font-bold text-lg text-gray-600">${userHouseNo}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Street</h2>
                            <p class="font-bold text-lg text-gray-600">${userStreet}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Barangay</h2>
                            <p class="font-bold text-lg text-gray-600">${userBrgy}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">City</h2>
                            <p class="font-bold text-lg text-gray-600">${userCity}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-[70%_30%] mb-4">
                        <div class="w-[95%] border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Province</h2>
                            <p class="font-bold text-lg text-gray-600">${userProvince}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Postal Code</h2>
                            <p class="font-bold text-lg text-gray-600">${userPostalCode}</p>
                        </div>
                    </div>

                    <h3 class="text-sm text-gray-400 mb-2 mt-4">Valid ID</h3>
                    <div class="gap-4 mb-4">
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">ID Type</h2>
                            <p class="font-bold text-lg text-gray-600 mb-4">${userIDType}</p>
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Uploaded:</h2>
                            <div class='flex w-full items-center justify-center'>
                            <img src="{{asset('storage/uploads/id/${userIDAttachment}')}}" class='w-96 h-96'>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="/admin/pending-request/approveStatus/${userId}" method='POST' class='approvalForm flex flex-row-reverse' >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="approveButton" id="approveButtonInput">
                    <button type='button' value='Approved' class='mx-2 bg-pink-500 w-28 hover:bg-pink-600 p-4 text-white rounded-2xl'>Approve</button>
                    <button type='button' value='To-Review' class='mx-2 bg-red-500 w-28 hover:bg-red-600 p-4 text-white rounded-2xl'>Reject</button>

                    </form>

                    `;
                    modal.classList.remove('hidden');

                    document.querySelectorAll('.approvalForm>Button').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        const form = button.closest('.approvalForm');
        const action = button.value;
        document.getElementById('approveButtonInput').value = action;

        Swal.fire({
            title: `Are you sure you want to mark the user as '${action}'?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#ef4444',
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                // Show the loader while processing
                const loader = document.getElementById('loader');
                loader.classList.remove('hidden');

                // Submit the form or do other actions here after a delay
                setTimeout(() => {
                    // Continue with form submission after the loader
                    if (action == 'Approved') {
                        form.submit();
                    } else if (action == 'To-Review') {
                        document.getElementById('modal-body').innerHTML =
                                        `
                                        <h3 class="text-lg font-bold mt-2 text-gray-700 mb-2">Rejection Form</h3>
                                        <form action="/admin/pending-request/rejectStatus/${userId}" method='POST' class='approvalForm'>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="PUT">

                                            <label for="rejectionReason" class="block mb-2 text-sm font-medium text-gray-700">Reason for Rejection:</label>
                                            <select name="rejectionReason" id="rejectionReason" class="border border-gray-300 rounded-md p-2 mb-4 w-full" onchange="toggleOtherField()">
                                                <option value="" disabled selected>Select a reason</option>
                                                <option value="wrong_document">Submitted Wrong Document</option>
                                                <option value="fake_document">Fake Document</option>
                                                <option value="not_eligible">Not Eligible</option>
                                                <option value="other">Other</option>
                                            </select>

                                            <!-- Text field for "Other" reason -->
                                            <div id="otherReasonContainer" class="hidden mb-4">
                                                <label for="otherReason" class="block mb-2 text-sm font-medium text-gray-700">Please specify:</label>
                                                <input type="text" name="otherReason" id="otherReason" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Enter your reason here">
                                            </div>
                                            <div class='flex flex-row-reverse w-full'>
                                            <button type='submit' value='Reject' class='mx-2 bg-red-500 w-32 hover:bg-red-600 p-4 text-white rounded-2xl'>Send Notice</button>
                                            </div>
                                        </form>`;
                    }

                    // Hide the loader after processing
                    loader.classList.add('hidden');
                }, 3000); // Adjust the delay for your email processing or backend delay
            }
        });
    });
});


                });
            });

            closeModalSpan.addEventListener('click', function () {
                modal.classList.add('hidden');

            });

            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

        });

        function toggleOtherField() {
            const rejectionReason = document.getElementById('rejectionReason').value;
            const otherReasonContainer = document.getElementById('otherReasonContainer');

            if (rejectionReason === 'other') {
                otherReasonContainer.classList.remove('hidden');
            } else {
                otherReasonContainer.classList.add('hidden');
            }
    }


    </script>

    @if(session('msg'))
        <script>
            Swal.fire({
                text: "{{session('msg')}}",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
</x-app-layout>
