<x-app-layout>

<div class="bg-white rounded-lg p-8">
    <div class="max-w-7xl ">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="max-w-full">
                        <h1 class="text-3xl font-black text-gray-700">Settings</h1>
                    </div>


            <div class="border-b border-gray-200 grid lg:grid-cols-3">

                <!-- Navigation -->
                <div class="nav-tabs md:col-span-3 lg:col-span-1 flex flex-col w-full p-4 relative">
                    <button
                    id="profileSettings-tab"
                    onclick="showTab('profileSettings')"
                    class="text-left px-3 py-2 font-medium border-r-4 hover:bg-gray-100 border-transparent text-black">
                        <div class='flex flex-row items-center'>
                            <span class='material-icons mx-2'>person</span>
                            <p>Profile</p>
                        </div>
                    </button>
                    <button
                    id="informationSettings-tab"
                    onclick="showTab('informationSettings')"
                    class="text-left px-3 py-2 font-medium border-r-4 hover:bg-gray-100 border-transparent text-black">
                        <div class='flex flex-row items-center'>
                            <span class='material-icons mx-2'>import_contacts</span>
                            <p>Personal Information</p>
                        </div>
                    </button>

                    <button
                    id="passwordSettings-tab"
                    onclick="showTab('passwordSettings')"
                    class="text-left px-3 py-2 font-medium border-r-4 hover:bg-gray-100 border-transparent text-black">
                        <div class='flex flex-row items-center'>
                            <span class='material-symbols-outlined mx-2'>password</span>
                            <p>Password</p>
                        </div>
                    </button>
                </div>

            <div id='profileSettings' class='tab-content grid grid-cols-1 col-span-2 p-3'>
                @include('user.settings.profile')
            </div>

            <div id='informationSettings' class='tab-content w-full grid grid-cols-1 col-span-2 p-3 hidden'>
                @include('user.settings.accountDetails')
            </div>

            <div id='passwordSettings' class="tab-content grid grid-cols-1 col-span-2 p-3 hidden">
                @include('user.settings.password')
            </div>


        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.getElementById('changeProfileButton').addEventListener('change', function() {
        document.getElementById('saveButton').classList.remove('hidden');

        if (this.files && this.files[0]) {
        var reader = new FileReader();

        // Set the onload function to update the image source
        reader.onload = function(e) {
            document.getElementById('editImage').src = e.target.result;
        }

        reader.readAsDataURL(this.files[0]);
    }
    });

    function showTab(tabName) {

    sessionStorage.setItem('active_tab', tabName);

    const allTabs = document.querySelectorAll(`.tab-content`);
    allTabs.forEach(function(tab) {
        tab.classList.add('hidden');
    });

    // Show the selected tab content
    const selectedTab = document.getElementById(`${tabName}`);
    selectedTab.classList.remove('hidden');

    const allTabButtons = document.querySelectorAll(`.nav-tabs > button`);
    allTabButtons.forEach(function(button) {
        button.classList.remove('border-pink-500','bg-gray-100', 'text-pink-500');
        button.classList.add('border-transparent', 'text-black');
    });

    // Add active styles to the clicked tab button
    const activeButton = document.getElementById(`${tabName}-tab`);
    if (activeButton) {
        activeButton.classList.add('border-pink-500','bg-gray-100', 'text-pink-500');
        activeButton.classList.remove('border-transparent','text-black');
    }

    }

    document.getElementById('editButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to edit your personal information.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Edit',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit();

            }
        });
    });

    document.getElementById('saveButton').addEventListener('click', function() {
        document.getElementById('changeProfilePicForm').submit();

    })

    document.getElementById('deleteButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete your profile picture.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();

            }
        });
    });
</script>



@if(session('page') == "1")
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            showTab('profileSettings');
        });

        Swal.fire({
            text: "{{session('msg')}}",
            icon: "success",
            showConfirmButton: false,
            timer:1500

        });
    </script>

@elseif(session('page') == "2")
<script>
    document.addEventListener('DOMContentLoaded', function () {
                showTab('informationSettings')
            });

        Swal.fire({
            text: "{{session('msg')}}",
            icon: "success",
            showConfirmButton: false,
            timer:1500

        });
    </script>
@elseif(session('page') == "3")
<script>
    document.addEventListener('DOMContentLoaded', function () {
                showTab('passwordSettings')
            });

        Swal.fire({
            text: "{{session('msg')}}",
            icon: "success",
            showConfirmButton: false,
            timer:1500

        });
    </script>
@else
<script>
      let active_tab = sessionStorage.getItem('active_tab')
            if (!active_tab) {
                showTab('profileSettings');
            } else {
                showTab(active_tab)
            }
    </script>
@endif

@if($errors)
    @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
    <script>
        showTab('passwordSettings')
        </script>
    @elseif ($errors->has('fname') || $errors->has('mname') || $errors->has('lname')|| $errors->has('age')
        || $errors->has('gender')|| $errors->has('province')|| $errors->has('city')|| $errors->has('brgy')
        || $errors->has('postal_code')|| $errors->has('house_no') || $errors->has('street'))
    <script>
        showTab('informationSettings')
        </script>
    @else
    <script>
        showTab('profileSettings')
        </script>
    @endif
@endif

</x-app-layout>
