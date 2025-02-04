<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Mat-Icon -->
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
            font-weight: 700;
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

        /* Make the top bar sticky */
        .top-bar {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: white;
        }

        /* Make the content area scrollable */
        .scrollable-content {
            height: calc(100vh - 96px); /* Adjust this value depending on the height of your top bar */
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen">

    <!-- Sidebar (for user, admin, or organizer) -->
    @if(Auth::user()->role === 'User' || Auth::user()->role === 'Organizer' && !(Route::is('eo.*')))
        @include('components.user-sidebar')
    @endif

    @if(Auth::user()->role === 'Admin')
        @include('components.admin-sidebar')
    @endif

    @if(Auth::user()->role === 'Organizer' && Route::is('eo.*'))
        @include('components.organizer-sidebar')
    @endif

    <!-- Main Content Area -->
    <div class="flex-1 bg-gray-100 overflow-y-auto">
        <!-- Dropdown Menu -->
        <div class="top-bar bg-white w-full border-b border-gray-200 py-4 px-8 flex justify-between">
            <div class="flex items-center gap-4">
                <img src="{{asset('images/logo/logo_shape.png')}}" class="w-[50px] h-[50px]" alt="">

                <div class="flex flex-col gap-0">
                    <h1 class="text-gray-600 text-xl font-black">{{$title ?? config('app.name')}}</h1>
                    <h1 class="text-gray-600 text-[0.8rem] mt-[-0.3rem]">Angat Buhay Pampanga</h1>
                </div>
            </div>

            <div class="flex gap-2">
                <div class="flex items-center gap-2 px-4 border border-gray-300 rounded-full">
                    <img
                    src="{{ Auth::user()->user->profile_picture ? asset('storage/uploads/profilepic/' . Auth::user()->user->profile_picture) : asset('images/default-dp.jpg') }}"
                    alt="" class="w-[32px] h-[32px] rounded-full">
                    <div class="flex flex-col justify-center">
                        <h1 class="text-gray-700 font-semibold"> {{Auth::user()->user->fullname}}</h1>
                        <h1 class="text-gray-500 text-[0.8rem] mt-[-0.4rem]"> {{Auth::user()->email}}</h1>
                    </div>
                    <div class="flex items-center">
                        <!-- Button to toggle dropdown -->
                        <button onclick="toggleDropdown()" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                            <svg class="ml-2 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.94l3.71-3.75a.75.75 0 011.08 1.04l-4.25 4.29a.75.75 0 01-1.08 0l-4.25-4.29a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="origin-top-right absolute right-14 mt-16 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                            <!-- Logout Form -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="block p-4 text-sm text-pink-900 hover:bg-gray-100 w-full text-left">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content (Place your content here) -->
        <div class="scrollable-content p-4">{{$slot}}</div>
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
