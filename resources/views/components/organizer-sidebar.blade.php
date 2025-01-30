<nav id="sidebar" class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200 transition-all duration-300">
    <div>
        <button
            id="toggleSidebar"
            class="text-pink-600 hover:bg-pink-100 rounded-full p-2 transition-all duration-300 mb-4 focus:outline-none"
        >
            <span class="material-icons" id="toggleIcon">chevron_left</span>
        </button>

        <h1 class="text-sm font-bold text-gray-400 sidebar-label">Event Organizer</h1>
        <h1 class="text-[2rem] font-black text-pink-600 mb-2 sidebar-label">My Portal</h1>

        <hr class="my-4 opacity-65">
        <ul>
            <li>
                <a href="{{route('eo.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('eo.dashboard') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">dashboard</span>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{route('eo.pending-requests')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('eo.pending-requests*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">schedule</span>
                    <span class="sidebar-label">Requests</span>
                </a>
            </li>

            <li>
                <a href="{{route('eo.channels')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('eo.channels*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">event</span>
                    <span class="sidebar-label">My Events</span>
                </a>
            </li>



            <hr class="opacity-65 my-4">
            <li>
                <a href="{{route('user.dashboard')}}" class="flex items-center p-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('admin.settings*') ? 'active_link' : '' }}">
                    <span class="material-icons mr-3 sidebar-icon">keyboard_return</span>
                    <span class="sidebar-label">Return to User Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('toggleSidebar');
    const toggleIcon = document.getElementById('toggleIcon');
    const labels = document.querySelectorAll('.sidebar-label');
    const icons = document.querySelectorAll('.sidebar-icon');

    // Function to update the sidebar state in localStorage
    function updateSidebarState() {
        const isCollapsed = sidebar.classList.contains('w-20');
        localStorage.setItem('sidebarState', isCollapsed ? 'collapsed' : 'expanded');
    }

    // Initialize sidebar state on page load
    document.addEventListener('DOMContentLoaded', () => {
        const savedState = localStorage.getItem('sidebarState');
        if (savedState === 'collapsed') {
            sidebar.classList.add('w-20');
            sidebar.classList.remove('w-64');
            toggleIcon.textContent = 'chevron_right';
            labels.forEach(label => label.classList.add('hidden'));
            icons.forEach(icon => icon.classList.add('mx-auto'));  // Center icons in collapsed state
        } else {
            sidebar.classList.add('w-64');
            sidebar.classList.remove('w-20');
            toggleIcon.textContent = 'chevron_left';
            labels.forEach(label => label.classList.remove('hidden'));
            icons.forEach(icon => icon.classList.remove('mx-auto'));
        }
    });

    // Toggle sidebar and save state on button click
    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('w-20');
        sidebar.classList.toggle('w-64');
        toggleIcon.textContent = sidebar.classList.contains('w-20') ? 'chevron_right' : 'chevron_left';
        labels.forEach(label => label.classList.toggle('hidden'));
        icons.forEach(icon => icon.classList.toggle('mx-auto'));
        updateSidebarState();
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
