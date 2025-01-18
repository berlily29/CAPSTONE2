<x-app-layout>
    <div class="py-8 px-10 bg-white border-b border-gray-200 rounded-lg">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-lg text-gray-500 font-semibold">Manage</h1>
            <h1 class="text-3xl font-black text-gray-700">Pending Requests</h1>
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
                    class="px-3 py-2 font-medium text-gray-500 focus:outline-none hover:text-gray-700"
                    onclick="showTab('events')">
                Events
            </button>
            <!-- Pink Line Highlight -->
            <div id="tab-highlight"
                 class="absolute bottom-0 h-1 bg-pink-500 transition-all"
                 style="left: 0; width: 60px;"></div>
        </div>

        <!-- Users Tab Content -->
        <div id="users" class="tab-content mt-4 pb-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Active Request</h2>
            <!-- Table -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="py-3 px-4 text-left">Name </th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">DATE CREATED</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        

                        @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 flex items-center">
                            <img src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('storage/uploads/profilepic/profile-picture.jpg') }}" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
                                {{ $user->fname }} {{$user->mname}} {{$user->lname}}
                            </td>
                            <td class="py-3 px-4">{{$user->login->email}}</td>
                            <td class="py-3 px-4">{{$user->created_at->format('l, F j, Y g:i A')}}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 text-sm rounded-lg bg-yellow-100 text-yellow-600">
                                    {{$user->account_status}}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                            
                                    <button class="openModal px-4 py-2 text-white bg-pink-500 hover:bg-pink-600 rounded"
                                            data-user-id="{{ $user->user_id }}" 
                                            data-user-email="{{ $user->login->email }}" 
                                            data-user-name="{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}"
                                            data-user-mobile="{{ $user->mobile_no }}" 
                                            data-user-age="{{ $user->age }}" 
                                            data-user-gender="{{ $user->gender }}" 
                                            data-user-house-no="{{ $user->house_no }}" 
                                            data-user-street="{{ $user->street }}" 
                                            data-user-brgy="{{ $user->brgy }}" 
                                            data-user-city="{{ $user->city }}" 
                                            data-user-province="{{ $user->province }}" 
                                            data-user-postal-code="{{ $user->postal_code }}"
                                            data-user-ID-Type="{{ $user->id->id_type }}"
                                            data-user-ID-Attachment = "{{ $user->id->attachment }}"
                                            >
                                            
                                        <span class='material-icons'>rate_review</span>
                                    </button>

                            </td>
                        </tr>
                        @endforeach

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

            <!-- Modal Structure -->
        <div id="myModal" class="modal hidden fixed inset-0 bg-gray-700 bg-opacity-25 flex items-center justify-center ">

            
            <div class="modal-content p-5 flex flex-col bg-white shadow-2xl rounded-l-3xl scrollable-content overflow-y w-2/3 h-2/3 overflow-auto shadow-xl relative">

                <span class="absolute right-6 text-white close-modal cursor-pointer material-icons bg-red-500 w-10 p-2 hover:bg-red-600  rounded-xl mt-2">close</span>

                <div id="modal-body">
                    <!-- User details will be populated here -->
                </div>

            </div>

        </div>


    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            const modal = document.getElementById('myModal');
    const closeModal = document.getElementById('closeModal');
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
                <div class="mb-6">
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
                    <div class="grid grid-cols-1 md:grid-cols-[60%_20%_20%] gap-4 mb-4">
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Mobile No.</h2>
                            <p class="font-bold text-lg text-gray-600">${userMobile}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
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
                    <div class="grid grid-cols-1 md:grid-cols-[70%_30%] gap-4 mb-4">
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Province</h2>
                            <p class="font-bold text-lg text-gray-600">${userProvince}</p>
                        </div>
                        <div class="border border-gray-300 rounded-md p-4">
                            <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Postal Code</h2>
                            <p class="font-bold text-lg text-gray-600">${userPostalCode}</p>
                        </div>
                    </div>

                    <h3 class="text-sm text-gray-400 mb-2 mt-4">Valid ID</h3>
                    <div class="grid grid-cols-1 md:grid-cols-[70%_30%] gap-4 mb-4">
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
               
                <form action="/admin/pending-request/updateStatus/${userId}" method='POST' class='approvalForm flex flex-row-reverse' >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="approveButton" id="approveButtonInput">
                    <button type='button' value='Approved' class='mx-2 bg-pink-500 w-28 hover:bg-pink-600 p-4 text-white rounded-2xl'>Approve</button>
                    <button type='button' value='To-Review' class='mx-2 bg-red-500 w-28 hover:bg-red-600 p-4 text-white rounded-2xl'>Reject</button>
                    
                    </form>
            `;

                modal.classList.remove('hidden'); 
                    });
                });


                closeModalSpan.addEventListener('click', function () {
                    modal.classList.add('hidden'); 
                });

                window.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        modal.classList.add('hidden'); 
                    }


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

                                    form.submit(); 
                                }
                            });
                        });
                    });
        });
    });

    
    </script>
@if(session('msg'))
    <script>
        Swal.fire({
            text: "{{session('msg')}}",
            icon: "success",
            showConfirmButton: false,
            timer:1500
        });
    </script>
@endif

</x-app-layout>
