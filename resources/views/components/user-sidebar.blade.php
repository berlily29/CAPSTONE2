<nav id="sidebar" class="w-64 bg-white text-gray-900 p-6 flex flex-col justify-between h-screen border-r border-gray-200 transition-all duration-300">
    <div>
        <!-- Toggle Button -->
        <button
            id="toggleSidebar"
            class="text-pink-600 hover:bg-pink-100 rounded-full p-2 transition-all duration-300 mb-4 focus:outline-none"
        >
            <span class="material-icons" id="toggleIcon">chevron_left</span>
        </button>

        <!-- Account Section -->
        <h1 class="text-lg font-bold text-pink-600 sidebar-label">Account</h1>
        <ul>
            <li>
                <a href="{{ route('user.profile') }}"
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('user.profile*') ? 'active_link' : '' }} pr-2">
                    <span class="material-icons sidebar-icon">account_circle</span>
                    <span class="sidebar-label">Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.dashboard') }}"
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3  text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('user.dashboard*') ? 'active_link' : '' }} ">
                    <span class="material-icons sidebar-icon">dashboard</span>
                    <span class="sidebar-label">My Dashboard</span>
                </a>
            </li>
            <li>
                <a @if(session('is_approved') == false) href="#" @else href="{{ route('user.joinevents') }}" @endif
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('user-joined-events*') ? 'active_link' : '' }}
                    @if(session('is_approved') === false) opacity-50 cursor-not-allowed @endif">
                    <span class="material-icons sidebar-icon">today</span>
                    <span class="sidebar-label">Joined Events</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.settings') }}"
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('user.settings*') ? 'active_link' : '' }}">
                    <span class="material-icons sidebar-icon">settings</span>
                    <span class="sidebar-label">Settings</span>
                </a>
            </li>
        </ul>

        <!-- Features Section -->
        <hr class="my-6 border-gray-200">
        <h1 class="text-lg font-bold text-pink-600 mb-2 sidebar-label">Features</h1>
        <ul>
            <li>
                <a @if(session('is_approved') == false) href="#" @else href="{{ route('find-events.index') }}" @endif
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('find-events.index*') ? 'active_link' : '' }}
                    @if(session('is_approved') === false) opacity-50 cursor-not-allowed @endif">
                    <span class="material-icons sidebar-icon">search</span>
                    <span class="sidebar-label">Find Events</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.index') }}"
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('gallery*') ? 'active_link' : '' }}">
                    <span class="material-icons sidebar-icon">image</span>
                    <span class="sidebar-label">Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.leaderboards') }}"
                    class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('user.leaderboards*') ? 'active_link' : '' }}">
                    <span class="material-symbols-outlined sidebar-icon">social_leaderboard</span>
                    <span class="sidebar-label">Top Volunteers</span>
                </a>
            </li>

            <hr class="my-4 opacity-65">
            <!-- Conditional Links -->
            @if(Auth::user()->role === 'Organizer')
                <li>
                    <a  href="{{ route('eo.dashboard') }}"
                        class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('eo.dashboard*') ? 'active_link' : '' }}">
                        <span class="material-symbols-outlined sidebar-icon">deployed_code_account</span>
                        <span class="sidebar-label">My Portal</span>
                    </a>
                </li>
            @else
                <li>
                    <a @if(session('eo_ban') == true || session('is_approved') == false) href="#" @else href="{{ route('application.index') }}" @endif
                        class="flex gap-2 items-center pr-8 pt-3 pb-3 pl-3 text-pink-600 hover:bg-pink-100 rounded-lg transition-all {{ Route::is('application.index*') ? 'active_link' : '' }}
                        @if(session('eo_ban') === true || session('is_approved') == false) opacity-50 cursor-not-allowed @endif">
                        <span class="material-symbols-outlined sidebar-icon">send</span>
                        <span class="sidebar-label">Apply as Event Organizer</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>


<script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('toggleSidebar');
    const toggleIcon = document.getElementById('toggleIcon');
    const labels = document.querySelectorAll('.sidebar-label');

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
        } else {
            sidebar.classList.add('w-64');
            sidebar.classList.remove('w-20');
            toggleIcon.textContent = 'chevron_left';
            labels.forEach(label => label.classList.remove('hidden'));
        }
    });

    // Toggle sidebar and save state on button click
    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('w-20');
        sidebar.classList.toggle('w-64');
        toggleIcon.textContent = sidebar.classList.contains('w-20') ? 'chevron_right' : 'chevron_left';
        labels.forEach(label => label.classList.toggle('hidden'));
        updateSidebarState();
    });
</script>



<style>
    .sidebar-icon {
        min-width: 24px;
        text-align: center;
    }

    .sidebar-label {
        transition: opacity 0.3s, transform 0.3s;
    }

    .w-20 .sidebar-label {
        display: none;
    }


</style>

