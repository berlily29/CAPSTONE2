<x-app-layout>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_alt" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">

    <div class="p-8">
        <!-- Smaller Title on top of the User List -->
        <h3 class="text-sm font-medium text-gray-700">Manage</h3>

        <!-- Title for User List -->
        <h1 class="text-3xl font-bold text-gray-800">All Users</h1>

        <!-- Search Bar -->
        <div class="relative mb-4">
            <!-- Container for positioning the search box -->
            <div class="absolute top-4 right-4">
              <input type="text" placeholder="Search..." class="border border-gray-300 p-2 pl-10 pr-4 rounded-lg w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
              <!-- Search Icon inside the input, left side -->
              <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
            </div>
          </div>

        <!-- Filter -->
        <div class="flex justify-start">
            <button class="bg-gray-400 text-white px-6 py-3 rounded-full hover:bg-gray-600 focus:outline-none flex items-center">
                <span class="material-symbols-outlined">
                    filter_alt
                    </span>
              Filter
            </button>
          </div>


          <!-- Users! -->

         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-8">
  <!-- User 1 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <!-- Left-side User Icon (Google Material Icon) -->
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>

    <!-- User Info -->
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 1</h3>
      <p class="text-gray-500">Role: Admin</p>
      <p class="text-sm text-gray-400">Email: user1@example.com</p>
    </div>

    <!-- Right Arrow Icon (Google Material Icon) -->
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 2 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 2</h3>
      <p class="text-gray-500">Role: Moderator</p>
      <p class="text-sm text-gray-400">Email: user2@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 3 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 3</h3>
      <p class="text-gray-500">Role: Member</p>
      <p class="text-sm text-gray-400">Email: user3@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 4 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 4</h3>
      <p class="text-gray-500">Role: Admin</p>
      <p class="text-sm text-gray-400">Email: user4@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 5 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 5</h3>
      <p class="text-gray-500">Role: Moderator</p>
      <p class="text-sm text-gray-400">Email: user5@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 6 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 6</h3>
      <p class="text-gray-500">Role: Member</p>
      <p class="text-sm text-gray-400">Email: user6@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 7 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 7</h3>
      <p class="text-gray-500">Role: Admin</p>
      <p class="text-sm text-gray-400">Email: user7@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 8 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 8</h3>
      <p class="text-gray-500">Role: Moderator</p>
      <p class="text-sm text-gray-400">Email: user8@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>

  <!-- User 9 -->
  <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
    <span class="material-icons text-6xl text-gray-500 mr-4">account_circle</span>
    <div class="flex-grow">
      <h3 class="text-lg font-semibold">User 9</h3>
      <p class="text-gray-500">Role: Member</p>
      <p class="text-sm text-gray-400">Email: user9@example.com</p>
    </div>
    <span class="material-icons text-3xl text-gray-500 ml-4">arrow_forward</span>
  </div>
</div>

    </div>
        </div>


</x-app-layout>
