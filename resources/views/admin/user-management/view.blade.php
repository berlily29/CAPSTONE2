<x-app-layout>
    <div class="bg-gray-50 overflow-hidden min-h-screen">
        <!-- Manage All Users Section -->
        <div class="p-8" id="usersSection">
            <div class="mb-3 pl-2">
                <h1 class="text-lg text-gray-800">Manage</h1>
                <h1 class="text-3xl font-bold text-gray-800">All User</h1>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-4">
                <div class="absolute right-4">
                    <input type="text" placeholder="Search" class="border border-gray-300 p-2 pl-10 pr-4 rounded-lg w-64 text-right focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <span class="material-icons absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
                </div>
            </div>

            <!-- Filter Button -->
            <div class="flex justify-start mb-4">
                <button class="bg-pink-500 text-sm text-white px-4 py-2 rounded-full hover:bg-pink-600 focus:outline-none flex items-center">
                    <span class="material-icons">filter_alt</span>Filter
                </button>
            </div>

            <!-- Users List -->
            <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-4 pt-8">
                <!-- Example User -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">User 1</h3>
                        <p class="text-gray-500">Role: Admin</p>
                        <p class="text-sm text-gray-400">Email: user1@example.com</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">User 2</h3>
                        <p class="text-gray-500">Role: User</p>
                        <p class="text-sm text-gray-400">Email: user1@example.com</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">User 3</h3>
                        <p class="text-gray-500">Role: User</p>
                        <p class="text-sm text-gray-400">Email: user1@example.com</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">User 4</h3>
                        <p class="text-gray-500">Role: User</p>
                        <p class="text-sm text-gray-400">Email: user1@example.com</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">User 5</h3>
                        <p class="text-gray-500">Role: User</p>
                        <p class="text-sm text-gray-400">Email: user1@example.com</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">User 6</h3>
                        <p class="text-gray-500">Role: User</p>
                        <p class="text-sm text-gray-400">Email: user1@example.com</p>
                    </div>
                    <button class="showProfile flex items-center p-2 bg-pink-500 hover:bg-pink-600 text-gray-700 rounded-3xl focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <span class="material-icons text-3xl text-white">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- user's profile -->
        <div id="personalProfile" class="min-h-screen hidden">
            <section class="bg-gray-50 p-8 w-full h-full overflow-auto">

            <div class="flex justify-between pb-7">
                <h1 class="pt-2 text-2xl font-bold text-gray-800">Personal Profile</h1>
                    <button id="exitProfile" class="text-gray-500 text-2xl hover:text-gray-700">
                        <span class= "material-icons">close</span>
                    </button>
            </div>

            <!-- personal infos -->
            <div class="flex">
                <img src="" alt="Profile Picture" class="rounded-md w-24 h-24 bg-gray-400">
            </div>

            <!--- full name -->
            <h3 class="text-md text-gray-500 mb-2 mt-4">Full Name</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">First Name</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Jaira</p>
                </div>

                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Middle Name</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Pascual</p>
                </div>

                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Last Name</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Nunag</p>
                </div>
            </div>

            <!--address-->
            <h3 class="text-md text-gray-500 mb-2 mt-4">Address</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">House Number</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Lot 2 Block 4</p>
                </div>
                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Street</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Tanguile St.</p>
                </div>

                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Barangay</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Dolores</p>
                </div>

                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">City</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">San Fernando</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Province</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">Pampanga</p>
                </div>
                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Postal Code</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">2000</p>
                </div>
            </div>

            <!--phone number-->
            <h3 class="text-md text-gray-500 mb-2 mt-4">Mobile Number</h3>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="border border-gray-300 rounded-md py-3">
                    <h1 class="text-gray-500 font-semibold pl-5 ">Mobile No.</h1>
                    <p class="text-lg mb-2 pl-5 mt-2 font-semibold">09123456789</p>
                </div>
            </div>

            <hr class="opacity-100 mt-8 mb-4">


            <!----points-->
            <div>
                <div class="flex items-center mb-2">
                    <h3 class="text-lg font-semibold">Points:  </h3>
                    <p class="ml-2">100</p>
                </div>
            </div>

            <!--- events -->
            <div>
                <div class="flex items-center mb-2">
                    <h3 class="text-lg font-semibold">Participated Events:  </h3>
                    <p class="ml-2">Dental Outreach Program - 12/2/24 </p>
                </div>
            </div>

            <div class="flex md:justify-end justify-start mt-5">
                <button class="text-white font-semibold py-2 px-4 bg-pink-500 rounded-lg flex items-center hover:bg-pink-600 focus:outline-none sm:text-center">
                <span class="material-icons text-white mr-2">exit_to_app</span>
                    Remove User
                </button>
            </div>
            </section>
        </div>
    </div>

    <script>
        document.querySelectorAll('.showProfile').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('personalProfile').classList.remove('hidden');
                document.getElementById('usersSection').classList.add('hidden');
            });
        });

        document.getElementById('exitProfile').addEventListener('click', () => {
            document.getElementById('personalProfile').classList.add('hidden');
            document.getElementById('usersSection').classList.remove('hidden');
        });
    </script>

</x-app-layout>
