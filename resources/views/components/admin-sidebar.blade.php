
    <nav class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200">
        <div>
        <h1 class="text-lg font-bold  text-pink-600 mb-2">Admin </h1>
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

