<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <!--Mat-Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .active_link {
            background-color: #fce7f3;
         }

         .active-link:hover { 
            background-color: #F472B6;
         }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen">

    <!-- Sidebar -->
    <nav class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200">
        <div>
            <!-- Profile -->
            <div class="flex flex-col items-center">
                <img src="{{asset('images/logo/logo.png')}}" alt="" class="w-66 h-66 rounded-full" />
              
            </div>

            <!-- Account Section -->
            <h1 class="text-lg font-bold mb-4 text-pink-600">Account</h1>
            <ul>
                <!-- Profile -->
                <li class="mb-4">
                    <a href="{{route('user.profile')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all 
                    {{ Route::is('user.profile*') ? 'active_link' : '' }}">
                   
                     <span class="material-icons mr-3">account_circle</span>
                        Profile
                    </a>
                </li>

                <!-- Dashboard -->
                <li class="mb-4">
                    <a href="{{route('user.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all  {{ Route::is('user.dashboard*') ? 'active_link' : '' }}">
                        <span class="material-icons mr-3">dashboard</span>
                        My Dashboard
                    </a>
                </li>

                <!-- Joined Events -->
                <li class="mb-4">
                    <a href="/user-joined-events" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Request::is('user-joined-events*') ? 'active_link' : '' }}">
                        <span class="material-icons mr-3">check_circle</span>
                        Joined Events
                    </a>
                </li>

                <!-- Settings -->
                <li class="mb-4">
                    <a href="/settings" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all">
                        <span class="material-icons mr-3">settings</span>
                        Settings
                    </a>
                </li>
            </ul>

            <!-- Features Section -->
            <hr class="my-6 border-gray-200">
            <h1 class="text-lg font-bold mb-4 text-pink-600">Features</h1>
            <ul>
                <!-- Find Events -->
                <li class="mb-4">
                    <a href="/user-find-events" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all">
                        <span class="material-icons mr-3">search</span>
                        Find Events
                    </a>
                </li>

                <!-- Gallery -->
                <li class="mb-4">
                    <a href="/user-gallery" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all">
                        <span class="material-icons mr-3">image</span>
                        Gallery
                    </a>
                </li>

                <!-- Top Volunteers -->
                <li class="mb-4">
                    <a href="{{route('user.leaderboards')}}" class="flex items-center p-3  text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                      {{ Route::is('user.leaderboards*') ? 'active_link' : '' }}
                       ">
                        <span class="material-icons mr-3">leaderboard</span>
                        Top Volunteers
                    </a>
                </li>
            </ul>
        </div>

        <!-- Volunteer Button -->
        <div class="w-full mt-8">
            <button class="w-full bg-sky-400 text-white p-3 rounded-lg hover:bg-pink-700 transition-all flex items-center justify-center">
            
                Volunteer to an Event
            </button>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="flex-1 p-6 bg-gray-100 overflow-y-auto">
        <!-- Dropdown Menu -->
        <div class="absolute top-4 right-4">
            <div class="relative inline-block text-left">
                <!-- Button to toggle dropdown -->
                <button onclick="toggleDropdown()" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.94l3.71-3.75a.75.75 0 011.08 1.04l-4.25 4.29a.75.75 0 01-1.08 0l-4.25-4.29a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="origin-top-right absolute right-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                    <!-- Logout Form -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="block px-4 py-2 text-sm text-pink-900 hover:bg-gray-100 w-full text-left">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Content (Place your content here) -->
        <div>{{$slot}}</div>
    </div>

</div>

<!-- JavaScript for the dropdown functionality -->
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('hidden');
    }
</script>

</body>
</html>
