<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <!--Mat-Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

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



    @if(Auth::user()->role ==='User' || Auth::user()->role ==='Organizer' && !(Route::is('eo.*'))    )
            @include('components.user-sidebar')
    @endif


    <!--
    ADMIN SIDEBAR
    -->

    @if(Auth::user()->role === 'Admin')
            @include('components.admin-sidebar')
    @endif

    @if(Auth::user()->role === 'Organizer' && Route::is('eo.*'))
        @include('components.organizer-sidebar')
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
