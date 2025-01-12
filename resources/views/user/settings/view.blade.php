<x-app-layout>


<div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-4 max-w-full">
                    <h1 class="ml-2 mt-5 text-3xl font-bold text-black">Settings</h1>
                </div>

                
                
                <div class="p-3 bg-white border-b border-gray-200">
    
                <!-- Navigation -->
                <div class="flex border-b mb-4">
                    <a 
                        href="{{ route('user.settings.account') }}"
                        class="px-3 py-2 font-medium border-b-2 focus:outline-none 
                            {{ request()->routeIs('user.settings.account') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                        Account Settings
                    </a>
                    <a 
                        href="{{ route('user.settings.userInfo') }}"
                        class="px-4 py-2 font-medium border-b-2 focus:outline-none 
                            {{ request()->routeIs('user.settings.userInfo') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                        Personal Information Settings
                    </a>
                    
                </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>