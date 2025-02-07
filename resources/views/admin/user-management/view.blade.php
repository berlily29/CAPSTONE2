<x-app-layout>
    <div class="bg-gray-50 overflow-hidden min-h-screen">
        <div class="p-8" id="usersSection">
            <div class="mb-3 pl-2">
                <h1 class="text-lg text-gray-800">Manage</h1>
                <h1 class="text-3xl font-bold text-gray-800">All User</h1>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-5">
                <form action="{{ route('admin.user-management.filter') }}" method="GET" id="searchForm" class="w-full">
                    <div class="absolute right-4">
                        <input type="text" placeholder="Search" name="search" value="{{ request()->search }}"
                            class="border border-gray-300 p-2 pl-10 pr-4 rounded-lg w-64 text-right focus:outline-none focus:ring-1 focus:ring-blue-400"
                            onkeyup="this.form.submit()">
                        <span class="material-icons absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
                    </div>
                </form>
            </div>

            <div class="flex justify-start items-center mb-4 relative w-[15vw] max-w-md">
                <!-- Filter Button -->

                <!-- Filter form with simple dropdown -->
                <form action="{{ route('admin.user-management.filter') }}" method="GET" id="filterForm" class="ml-4 w-full">
                    <!-- Role select with a pink button style -->
                    <div class="relative">
                        <select name="role" class="border border-pink-500 p-2 pl-10 pr-4 rounded-lg w-full text-left focus:outline-none focus:ring-1 focus:ring-pink-400" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="User" {{ request()->role == 'User' ? 'selected' : '' }}>User</option>
                            <option value="Admin" {{ request()->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Organizer" {{ request()->role == 'Organizer' ? 'selected' : '' }}>Event Organizer</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 pt-8" id="userList">
                @foreach($users as $user)
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center mt-2">
                    <span class="w-10 h-10 rounded-2xl text-6xl text-gray-500 mr-4">
                        <img src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('images/default-dp.jpg') }}"
                            alt="Profile Picture"
                            class="w-full h-full object-cover rounded-full">
                    </span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">{{$user->fname}} {{$user->mname}} {{$user->lname}}</h3>
                        <p class="text-gray-500">Role: {{$user->login->role}}</p>
                        <p class="text-sm text-gray-400">Email: {{$user->login->email}}</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400"
                            onclick="showProfile({{ json_encode(['user' => $user, 'login' => $user->login]) }})">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- User's Profile -->
        <div id="personalProfile" class="min-h-screen hidden">
            <section class="bg-gray-50 p-8 w-full h-full overflow-auto">
                <div class='flex flex-row-reverse w-100'>
                    <button id="exitProfile" class="text-white flex justify-center bg-pink-500 p-2 rounded-md mb-4 hover:bg-pink-600">
                        <span class="material-icons">arrow_back</span> Back to Users
                    </button>
                </div>
                <img id="profileImage" alt="Profile picture" class="w-24 h-24 object-cover rounded">
                <h3 class="text-sm text-gray-400 mb-2 mt-4">Full Name</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">First Name</h2>
                        <p id="firstname" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Middle Name</h2>
                        <p id="middlename" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Last Name</h2>
                        <p id="lastname" class="font-bold text-lg text-gray-600"></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-[60%_20%_20%] gap-4 mb-4">
                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Mobile No.</h2>
                        <p id="mobile_no" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Age</h2>
                        <p id="age" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Gender</h2>
                        <p id="gender" class="font-bold text-lg text-gray-600"></p>
                    </div>
                </div>

                <!-- Address -->
                <h3 class="text-sm text-gray-400 mb-2 mt-4">Complete Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Street</h2>
                        <p id="street" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Barangay</h2>
                        <p id="barangay" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">City</h2>
                        <p id="city" class="font-bold text-lg text-gray-600"></p>
                    </div>

                    <div class="border border-gray-300 rounded-md p-4">
                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Province</h2>
                        <p id="province" class="font-bold text-lg text-gray-600"></p>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-md p-4">
                    <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Postal Code</h2>
                    <p id="postal" class="font-bold text-lg text-gray-600"></p>
                </div>

                <div class=" rounded-md p-4">
                    <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Profile Points</h2>
                    <p id="points" class="font-bold text-lg text-gray-600"></p>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>

<script>
    // Show profile dynamically for the selected user
    function showProfile(data) {
        const profileImage = data.user.profile_picture ? `{{ asset('storage/uploads/profilepic') }}/${data.user.profile_picture}` : '{{ asset('images/default-dp.jpg') }}';
        document.getElementById('profileImage').src = profileImage;
        document.getElementById('firstname').innerText = data.user.fname;
        document.getElementById('middlename').innerText = data.user.mname;
        document.getElementById('lastname').innerText = data.user.lname;
        document.getElementById('mobile_no').innerText = data.user.mobile_no;
        document.getElementById('age').innerText = data.user.age;
        document.getElementById('gender').innerText = data.user.gender;
        document.getElementById('street').innerText = data.user.street;
        document.getElementById('barangay').innerText = data.user.brgy;
        document.getElementById('city').innerText = data.user.city;
        document.getElementById('province').innerText = data.user.province;
        document.getElementById('postal').innerText = data.user.postal_code;
        document.getElementById('points').innerText = data.user.profile_points;

        // Hide users section and show personal profile
        document.getElementById('personalProfile').classList.remove('hidden');
        document.getElementById('usersSection').classList.add('hidden');
    }

    // Close profile and return to users list
    document.getElementById('exitProfile').addEventListener('click', () => {
        document.getElementById('personalProfile').classList.add('hidden');
        document.getElementById('usersSection').classList.remove('hidden');
    });
</script>
