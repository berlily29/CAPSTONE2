<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <!--Mat-Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=social_leaderboard" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

body {
    font-family: 'Poppins', sans-serif;
}


        .active_link {
            background-color: #fce7f3;
            font-weight: 700
         }

         .active-link:hover {
            background-color: #F472B6;
         }

        .scrollable-content::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-content::-webkit-scrollbar-track {
            background: #ff4081;
        }

        .scrollable-content::-webkit-scrollbar-thumb {
            background-color: #e91e64;
            border-radius: 20px;
        }

        .scrollable-content::-webkit-scrollbar-thumb:hover {
            background-color: #c91459;
        }

    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen">

    <!--


        START OF USER SIDEBAR

    -->
    <!-- sidebar of user sidebar here ========================================================================= -->



    @if(Auth::user()->role =='User')


    <nav class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200">
        <div>
            <!-- Profile -->
            <div class="flex flex-col items-center">
                <img src="{{asset('images/logo/logo.png')}}" alt="" class="w-66 h-66 rounded-full" />

            </div>

            <!-- Account Section -->
            <h1 class="text-lg font-bold  text-pink-600 mb-2">Account</h1>
            <ul class="">
                <!-- Profile -->
                <li class="">
                    <a href="{{route('user.profile')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('user.profile*') ? 'active_link' : '' }}">

                     <span class="material-icons mr-3">account_circle</span>
                        Profile
                    </a>
                </li>

                <!-- Dashboard -->
                <li class="">
                    <a href="{{route('user.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all  {{ Route::is('user.dashboard*') ? 'active_link' : '' }}">
                        <span class="material-icons mr-3">dashboard</span>
                        My Dashboard
                    </a>
                </li>

                <li class="">
                    <a @if(session('is_approved') == false) href = # @else href = "{{route('user.joinevents')}}" @endif
                    class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Request::is('user-joined-events*') ? 'active_link' : '' }}    {{ Request::is('user.channel.index') ? 'active_link' : '' }}
                @if(session('is_approved') === false) opacity-50 cursor-not-allowed @endif">
                        <span class="material-icons mr-3">today</span>
                        Joined Events
                    </a>
                </li>


                <!-- Settings -->
                <li class="">
                    <a href="{{route('user.settings')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                        {{ Request::is('user.settings') ? 'active_link' : '' }}
                      ">
                        <span class="material-icons mr-3">settings</span>
                        Settings
                    </a>
                </li>
            </ul>

            <!-- Features Section -->
            <hr class="my-6 border-gray-200">
            <h1 class="text-lg font-bold  text-pink-600 mb-2">Features</h1>
            <ul>
                <!-- Find Events -->
                <li class="">

                    <a @if(session('is_approved') == false) href = # @else href = "{{route('find-events.index')}}" @endif
                    class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('find-events.index*') ? 'active_link' : '' }}
                     @if(session('is_approved') === false) opacity-50 cursor-not-allowed @endif">

                        <span class="material-icons mr-3">search</span>
                        Find Events
                    </a>
                </li>

                <!-- Gallery -->
                <li class="">
                    <a href="{{route('gallery.index')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('gallery*') ? 'active_link' : '' }}
                     ">
                        <span class="material-icons mr-3">image</span>
                        Gallery
                    </a>
                </li>

                <!-- Top Volunteers -->
                <li class="">
                    <a href="{{route('user.leaderboards')}}" class="flex items-center p-3  text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                      {{ Route::is('user.leaderboards*') ? 'active_link' : '' }}
                       ">
                       <span class="material-symbols-outlined mr-3">social_leaderboard</span>
                        Top Volunteers
                    </a>
                </li>
            </ul>
        </div>


    </nav>



    @endif




    <!--


        START OF ADMIN SIDEBAR
    -->


    @if(Auth::user()->role === 'Admin')
    <!-- sidebar of admin here ========================================================================= -->
    <nav class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200">
        <div>
            <!-- Profile -->
            <div class="flex flex-col items-center">
                <img src="{{asset('images/logo/logo.png')}}" alt="" class="w-66 h-66 rounded-full" />

            </div>

            <ul>


                <li class="">
                    <a href="{{route('admin.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.dashboard*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3">dashboard </span>
                        Dashboard
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.user-management')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.user-management*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3">group </span>
                        User Management
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.manage-events')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.manage-events*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3"> today </span>
                        Manage Events
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.pending-request')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.pending-request*') ? 'active_link' : '' }}
                    ">
                    <span class="material-icons mr-3">schedule</span>
                        Pending Requests
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.settings')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.settings*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3">settings </span>
                        Settings
                    </a>
                </li>

            </ul>
        </div>
    </nav>

    @endif




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
