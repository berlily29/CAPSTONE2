
    <nav class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200">
        <div>

        <h1 class="text-sm font-bold  text-gray-400">Event Organizer</h1>

            <h1 class=" text-[2rem] font-black text-pink-600 mb-2">My Portal</h1>


            <hr class="my-4 opacity-65" >
            <ul>


                <li class="">
                    <a href="{{route('eo.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('eo.dashboard') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3">dashboard </span>
                        Dashboard
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.user-management')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.user-management*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3">schedule </span>
                        Pending Request
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.manage-events')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.manage-events*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3"> tab </span>
                        Channels
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

                <hr class="opacity-65 my-4">
                <li class="">
                    <a href="{{route('user.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all
                    {{ Route::is('admin.settings*') ? 'active_link' : '' }}
                    ">
                        <span class="material-icons mr-3">keyboard_return </span>
                        Return to User Dashboard
                    </a>
                </li>


            </ul>
        </div>
    </nav>
