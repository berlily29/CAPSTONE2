<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-4 max-w-full">
                    <h1 class="ml-2 mt-5 text-3xl font-bold text-black">Events</h1>
                </div>
                
                <div class="p-3 bg-white border-b border-gray-200">
    
                <!-- Navigation -->
                <div class="flex border-b mb-4">
                    <a 
                        href="{{ route('find-events.open') }}"
                        class="px-3 py-2 font-medium border-b-2 focus:outline-none 
                            {{ request()->routeIs('find-events.open') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                        Open Events
                    </a>
                    <a 
                        href="{{ route('find-events.nearby') }}"
                        class="px-4 py-2 font-medium border-b-2 focus:outline-none 
                            {{ request()->routeIs('find-events.nearby') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                        Nearby me
                    </a>
                    <a 
                        href="{{ route('find-events.recommended') }}"
                        class="px-4 py-2 font-medium border-b-2 focus:outline-none 
                            {{ request()->routeIs('find-events.recommended') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                        Recommended
                    </a>
                </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
