<nav id="adminSidebar" class="w-80 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200 transition-all duration-300">
    <div>
        <button
            id="toggleAdminSidebar"
            class="text-pink-600 hover:bg-pink-100 rounded-full p-2 transition-all duration-300 mb-4 focus:outline-none"
        >
            <span class="material-icons" id="adminToggleIcon">chevron_left</span>
        </button>

        <h1 class="text-lg font-bold text-pink-600 mb-2 sidebar-label">Admin</h1>

        <ul>
            <li>
                <a href="{{route('admin.dashboard')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.dashboard*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">dashboard</span>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.user-management')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.user-management*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">group</span>
                    <span class="sidebar-label">Users</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.manage-events')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.manage-events*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">today</span>
                    <span class="sidebar-label">Events</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.pending-request.application')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.pending-request.application*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">schedule</span>
                    <span class="sidebar-label">Users Approvals</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.pending-request.event')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.pending-request.event*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">free_cancellation</span>
                    <span class="sidebar-label">Event Approvals</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.gallery')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.gallery*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">image</span>
                    <span class="sidebar-label">Gallery</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.settings')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.settings*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">settings</span>
                    <span class="sidebar-label">Settings</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.config')}}" class="flex items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.config*') ? 'active_link' : '' }}">
                    <span class="material-symbols-outlined mr-3 sidebar-icon">manufacturing</span>
                    <span class="sidebar-label">App Config</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    const adminSidebar = document.getElementById('adminSidebar');
    const adminToggleButton = document.getElementById('toggleAdminSidebar');
    const adminToggleIcon = document.getElementById('adminToggleIcon');
    const adminLabels = document.querySelectorAll('.sidebar-label');
    const adminIcons = document.querySelectorAll('.sidebar-icon');

    function updateAdminSidebarState() {
        const isCollapsed = adminSidebar.classList.contains('w-20');
        localStorage.setItem('adminSidebarState', isCollapsed ? 'collapsed' : 'expanded');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedState = localStorage.getItem('adminSidebarState');
        if (savedState === 'collapsed') {
            adminSidebar.classList.add('w-20');
            adminSidebar.classList.remove('w-80');
            adminToggleIcon.textContent = 'chevron_right';
            adminLabels.forEach(label => label.classList.add('hidden'));
            adminIcons.forEach(icon => icon.classList.add('mx-auto'));
        } else {
            adminSidebar.classList.add('w-80');
            adminSidebar.classList.remove('w-20');
            adminToggleIcon.textContent = 'chevron_left';
            adminLabels.forEach(label => label.classList.remove('hidden'));
            adminIcons.forEach(icon => icon.classList.remove('mx-auto'));
        }
    });

    adminToggleButton.addEventListener('click', () => {
        adminSidebar.classList.toggle('w-20');
        adminSidebar.classList.toggle('w-80');
        adminToggleIcon.textContent = adminSidebar.classList.contains('w-20') ? 'chevron_right' : 'chevron_left';
        adminLabels.forEach(label => label.classList.toggle('hidden'));
        adminIcons.forEach(icon => icon.classList.toggle('mx-auto'));
        updateAdminSidebarState();
    });
</script>

<style>
    .sidebar-icon {
        min-width: 24px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .sidebar-label {
        transition: opacity 0.3s, transform 0.3s;
    }

    .w-20 .sidebar-label {
        display: none;
    }

    .w-20 .sidebar-icon {
        margin-left: auto;
        margin-right: auto;
    }

    .sidebar-label.hidden {
        display: none;
    }

    .sidebar-label {
        opacity: 1;
    }
</style>
