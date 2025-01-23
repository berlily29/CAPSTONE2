<x-app-layout>

<div class="bg-white rounded-lg p-8">
        <div class="max-w-7xl ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class=" max-w-full">
                    <h1 class="text-3xl font-black text-gray-700">Settings</h1>
                </div>


                <div class="bg-white border-b border-gray-200">

                <!-- Navigation -->
                    <div  class="nav-tabs flex border-b relative">
                    <button
                        id="accountDetails-tab"
                         onclick="showTab('accountDetails')"
                        class="px-3 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black">
                        Account Settings
                    </button>
                    <button
                        id="userInfo-tab"
                       onclick="showTab('userInfo')"
                        class="px-3 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black">
                        Personal Information Settings
                    </button>

                    <div id="tab-highlight" class="absolute bottom-0 left-0 w-1/3 h-1 bg-pink-500 transition-all"></div>

                </div>

            <div id='accountDetails' class='tab-content grid md:grid-cols-1 gap-2 lg:grid-cols-2 p-3'>
                <div class="flex items-center flex-col bg-gray-200 rounded-lg p-3">
                    <h2 class="w-full text-2xl font-bold text-gray-800 mb-4">Edit Profile Picture</h2>

                    <img id='editImage' src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('storage/uploads/profilepic/profile-picture.jpg') }}" alt="{{$user->profile_picture}}" class="w-48 h-48 rounded bg-gray-300 mr-4">

                    <div class='grid md:grid-cols-1 mt-2 text-center gap-5 lg:grid-cols-2'>
                        <div class='relative'>
                            <form id="changeProfilePicForm" enctype="multipart/form-data" action="{{route('user.settings.storeProfilePic')}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <label for='changeProfileButton' class='flex items-center justify-center cursor-pointer rounded-2xl p-4 text-white hover:bg-pink-600 bg-pink-500'>
                                    <span class="material-icons mx-2">
                                        file_upload
                                    </span>
                                    <p>Upload Photo </p>
                                </label>
                                <input type='file' id='changeProfileButton' name='changeProfileButton' class='hidden bg-gray-200 rounded-2xl cursor-pointer hover:bg-pink-600 bg-pink-500'>
                            </form>
                        </div>

                        <div>
                            <form id='deleteForm' action="{{route('user.settings.deleteProfilePic')}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="button" id='deleteButton' class="flex w-full items-center justify-center cursor-pointer rounded-2xl p-4 text-white hover:bg-pink-600 bg-pink-500 rounded">
                                <span class="material-icons mx-2">&#xE872;</span>
                                <p>Delete Photo</p>

                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-2 text-center w-full flex flex-row-reverse ">
                         <button id="saveButton" class="flex items-center justify-center transition-colors hidden mx-3 py-2 px-5 bg-pink-500 hover:bg-pink-600 text-white rounded-2xl">
                            <span class="material-icons mx-2">
                                save
                            </span>                         </button>
                    </div>


                </div>

                <div class="p-5 w-full bg-gray-200 rounded-lg">
                    <h2 class="w-full text-2xl font-bold text-gray-800 mb-4">Change Password</h2>

                    @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->get('current_password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                @foreach ($errors->get('new_password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                @foreach ($errors->get('new_password_confirmation') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id='passwordForm' action="{{ route('user.settings.changePassword') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-pink-500 focus:border-pink-500 p-2" required>
                        </div>
                        <div class="mb-4">
                            <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-pink-500 focus:border-pink-500 p-2" required>
                        </div>
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-pink-500 focus:border-pink-500 p-2" required>
                        </div>
                        <button id='changePasswordButton' type="button" class="flex items-center justify-center w-full bg-pink-500 text-white font-semibold py-2 rounded-md hover:bg-pink-600 transition duration-200">
                            <span class="material-icons mx-2">edit</span>Change Password
                        </button>
                    </form>
                </div>
            </div>

                <div id='userInfo' class='tab-content hidden pt-4'>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit User Information</h2>

    <form id="editForm" action="{{ route('user.settings.storeUserInfo') }}" class='w-full h-full' method="POST">
        @csrf
        @method('PATCH')

        @if ($errors->has('fname') || $errors->has('mname') || $errors->has('lname')|| $errors->has('age')
        || $errors->has('gender')|| $errors->has('province')|| $errors->has('city')|| $errors->has('brgy')
        || $errors->has('postal_code')|| $errors->has('house_no') || $errors->has('street'))
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                            @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

        <div class='grid md:grid-cols-1 lg:grid-cols-2 gap-4 mb-4'>

        <div class="pr-5">
            <label for="fname" class=" w-full block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="fname" name="fname" class="text-xl px-4 py-2 w-full mt-1 block rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->fname }}" required>
        </div>

        <div class="pr-5">
            <label for="mname" class="w-full block text-sm font-medium text-gray-700">Middle Name</label>
            <input type="text" id="mname" name="mname" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->mname }}" required>
        </div>

        <div class="pr-5">
            <label for="lname" class="w-full block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="lname" name="lname" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300  rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->lname }}" required>
        </div>

        <div class="pr-5">
            <label for="age" class="w-full block text-sm font-medium text-gray-700">Age</label>
            <input type="text" id="age" name="age" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->age }}" required>
        </div>

        <div class="pr-5">
            <label for="gender" class="w-full block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender" class="text-xl w-full px-4 py-2 block border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        </div>


    <h2 class="text-2xl font-bold text-gray-800 mb-4 w-full">Edit Address</h2>

                <div class="space-y-4 w-full">
                    <!-- Province (Fixed to Pampanga) -->
                    <div>
                        <label for="province" class="block text-sm font-semibold text-gray-700">Province</label>
                        <input type="text" id="province" name="province" value="Pampanga" readonly
                            class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-gray-600" required>
                    </div>

                    <div id="city_div">
                        <label for="city" class="block text-sm font-semibold text-gray-700">City</label>
                        <select id="city" name="city" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                        @php
            $cities = [
                'Angeles', 'Apalit', 'Arayat', 'Candaba', 'Floridablanca',
                'Guagua', 'Lubao', 'Mabalacat', 'Macabebe', 'Magalang',
                'Masantol', 'Mexico', 'Minalin', 'Porac', 'San Fernando',
                'San Luis', 'San Simon', 'Santo Tomas', 'Santa Ana',
                'Santa Rita', 'Sasmuan'
            ];
        @endphp

        @foreach ($cities as $city)
            <option value="{{ $city }}" {{ $user->city == $city ? 'selected' : '' }}>{{ $city }}</option>
        @endforeach
                        </select>
                    </div>

                    <!-- Barangay (to be populated based on city selection) -->
                    <div id="barangay_div">
                        <label for="barangay" class="block text-sm font-semibold text-gray-700">Barangay</label>
                        <select id="barangay" name="brgy" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                            <!-- Barangay options will be populated based on city selection -->                           
                        </select>
                    </div>

                    <!-- Hidden Fields (House No., Street, Postal Code) -->
                    <div id="address_fields" class="hidden">

                        <!-- Postal Code -->
                        <div>
                            <label for="postal_code" class="block text-sm font-semibold text-gray-700">Postal Code</label>
                            <input readonly type="text" id="postal_code" value="{{$user->postal_code}}" name="postal_code" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-gray-600" required>
                        </div>
                        <!-- House No. -->
                        <div>
                            <label for="house_no" class="block text-sm font-semibold text-gray-700">House No.</label>
                            <input type="text" id="house_no" name="house_no" value="{{$user->house_no}}" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                        </div>

                        <!-- Street -->
                        <div>
                            <label for="street" class="block text-sm font-semibold text-gray-700">Street</label>
                            <input type="text" id="street" name="street" value="{{$user->street}}" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                        </div>
                    </div>

                </div>
            </form>


    <div class="mt-2 text-center w-full flex flex-row-reverse">
        <button id="editButton" class="flex items-center justify-center w-12 h-12  mx-2 my-2  bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors">
            <span class="material-icons mx-2">edit</span>

        </button>

    </div>


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
        const allTabs = document.querySelectorAll(`.tab-content`);
        allTabs.forEach(function(tab) {
            tab.classList.add('hidden');
        });

        const selectedTab = document.getElementById(`${tabName}`);
        selectedTab.classList.remove('hidden');

        const allTabButtons = document.querySelectorAll(`.nav-tabs>button`);
        allTabButtons.forEach(function(button) {
            button.classList.remove('text-pink-500');
            button.classList.add('border-transparent', 'text-black');
        });

        const activeButton = document.getElementById(`${tabName}-tab`);
        activeButton.classList.add('text-pink-500');

         // Adjust the tab highlight under the active tab
         const highlight = document.getElementById('tab-highlight');
            if (highlight && activeButton) {
                highlight.style.left = activeButton.offsetLeft + 'px';
                highlight.style.width = activeButton.offsetWidth + 'px';
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

    document.getElementById('changePasswordButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to change your password.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('passwordForm').submit();

            }
        });
    });

      // Full Cities and Barangays with Postal Codes for Pampanga
      const cityBarangays = {
    'Angeles': [
        { name: 'Balibago', postal_code: '2009' },
        { name: 'Pulung Cacutud', postal_code: '2009' },
        { name: 'Sapang Bato', postal_code: '2009' },
        { name: 'Cutud', postal_code: '2009' },
        { name: 'Pampang', postal_code: '2009' },
        { name: 'Sto. Niño', postal_code: '2009' },
        { name: 'Miranda', postal_code: '2009' },
        { name: 'Quebiawan', postal_code: '2009' },
        { name: 'Pulung Maragul', postal_code: '2009' },
        { name: 'Mining', postal_code: '2009' },
        { name: 'Salapungan', postal_code: '2009' },
        { name: 'Dau', postal_code: '2009' },
        { name: 'Anunas', postal_code: '2009' },
        { name: 'Malabanias', postal_code: '2009' },
        { name: 'Amsic', postal_code: '2009' },
        { name: 'Pulungbulu', postal_code: '2009' },
        { name: 'Telebastagan', postal_code: '2009' },
        { name: 'Kalala', postal_code: '2009' },
        { name: 'Bical', postal_code: '2009' },
        { name: 'Pio', postal_code: '2009' },
        { name: 'Tuna', postal_code: '2009' },
        { name: 'Bagumbayan', postal_code: '2009' },
        { name: 'San Francisco', postal_code: '2009' },
        { name: 'San Jose', postal_code: '2009' },
        { name: 'San Juan', postal_code: '2009' },
        { name: 'San Isidro', postal_code: '2009' }
    ],
    'Apalit': [
        { name: 'San Juan', postal_code: '2016' },
        { name: 'San Vicente', postal_code: '2016' },
        { name: 'Santo Niño', postal_code: '2016' },
        { name: 'Dila-Dila', postal_code: '2016' },
        { name: 'Sapangbato', postal_code: '2016' },
        { name: 'Pulungbulu', postal_code: '2016' },
        { name: 'Bucana', postal_code: '2016' },
        { name: 'San Rafael', postal_code: '2016' },
        { name: 'Baras', postal_code: '2016' },
        { name: 'San Carlos', postal_code: '2016' },
        { name: 'San Pascual', postal_code: '2016' },
        { name: 'Magsilingan', postal_code: '2016' },
        { name: 'San Miguel', postal_code: '2016' },
        { name: 'San Jose', postal_code: '2016' }
    ],
    'Arayat': [
        { name: 'Bano', postal_code: '2012' },
        { name: 'Bical', postal_code: '2012' },
        { name: 'Minuyan', postal_code: '2012' },
        { name: 'Laug', postal_code: '2012' },
        { name: 'Santo Niño', postal_code: '2012' },
        { name: 'Cupang', postal_code: '2012' },
        { name: 'San Juan', postal_code: '2012' },
        { name: 'Magliman', postal_code: '2012' },
        { name: 'Baliti', postal_code: '2012' },
        { name: 'Dampol', postal_code: '2012' },
        { name: 'Balubad', postal_code: '2012' },
        { name: 'Cansinala', postal_code: '2012' },
        { name: 'Poblacion', postal_code: '2012' },
        { name: 'San Isidro', postal_code: '2012' },
        { name: 'Lacub', postal_code: '2012' },
        { name: 'Lalapac', postal_code: '2012' },
        { name: 'Bagumbayan', postal_code: '2012' },
        { name: 'Pulo', postal_code: '2012' }
    ],
    'Candaba': [
        { name: 'Salapungan', postal_code: '2013' },
        { name: 'Tabuyuc', postal_code: '2013' },
        { name: 'Longos', postal_code: '2013' },
        { name: 'San Juan', postal_code: '2013' },
        { name: 'San Miguel', postal_code: '2013' },
        { name: 'Cacutud', postal_code: '2013' },
        { name: 'Santo Niño', postal_code: '2013' },
        { name: 'San Agustin', postal_code: '2013' },
        { name: 'San Antonio', postal_code: '2013' },
        { name: 'San Gabriel', postal_code: '2013' },
        { name: 'San Rafael', postal_code: '2013' },
        { name: 'San Nicolas', postal_code: '2013' },
        { name: 'Pueblo', postal_code: '2013' },
        { name: 'San Jose', postal_code: '2013' },
        { name: 'Bagumbayan', postal_code: '2013' }
    ],
    'Floridablanca': [
        { name: 'Alasas', postal_code: '2006' },
        { name: 'Santo Niño', postal_code: '2006' },
        { name: 'San Pedro', postal_code: '2006' },
        { name: 'San Antonio', postal_code: '2006' },
        { name: 'San Jose', postal_code: '2006' },
        { name: 'San Rafael', postal_code: '2006' }
    ],
    'Guagua': [
        { name: 'Baliti', postal_code: '2003' },
        { name: 'Bancal', postal_code: '2003' },
        { name: 'Cupang', postal_code: '2003' },
        { name: 'Longos', postal_code: '2003' },
        { name: 'San Pedro', postal_code: '2003' },
        { name: 'San Vicente', postal_code: '2003' },
        { name: 'San Antonio', postal_code: '2003' },
        { name: 'San Isidro', postal_code: '2003' }
    ],
    'Lubao': [
        { name: 'Babo Pangulo', postal_code: '2004' },
        { name: 'Bacolor', postal_code: '2004' },
        { name: 'Botalac', postal_code: '2004' },
        { name: 'San Vicente', postal_code: '2004' },
        { name: 'San Felipe', postal_code: '2004' },
        { name: 'San Pedro', postal_code: '2004' },
        { name: 'San Juan', postal_code: '2004' },
        { name: 'Balanan', postal_code: '2004' },
        { name: 'San Isidro', postal_code: '2004' },
        { name: 'San Miguel', postal_code: '2004' },
        { name: 'Santo Niño', postal_code: '2004' }
    ],
    'Mabalacat': [
        { name: 'Dau', postal_code: '2010' },
        { name: 'Mamatitang', postal_code: '2010' },
        { name: 'Pobla', postal_code: '2010' },
        { name: 'Mabiga', postal_code: '2010' },
        { name: 'Pulungbulu', postal_code: '2010' },
        { name: 'San Jose', postal_code: '2010' },
        { name: 'Balibago', postal_code: '2010' },
        { name: 'Cuyapo', postal_code: '2010' },
        { name: 'Salapungan', postal_code: '2010' },
        { name: 'Bical', postal_code: '2010' },
        { name: 'Agapito', postal_code: '2010' },
        { name: 'Villa Maria', postal_code: '2010' },
        { name: 'Pio', postal_code: '2010' },
        { name: 'Santa Barbara', postal_code: '2010' },
        { name: 'San Francisco', postal_code: '2010' },
        { name: 'San Pedro', postal_code: '2010' },
        { name: 'Santo Niño', postal_code: '2010' }
    ],
    'Macabebe': [
        { name: 'San Isidro', postal_code: '2011' },
        { name: 'San Vicente', postal_code: '2011' },
        { name: 'San Jose', postal_code: '2011' },
        { name: 'Balucuc', postal_code: '2011' },
        { name: 'San Antonio', postal_code: '2011' },
        { name: 'Santo Niño', postal_code: '2011' }
    ],
    'Magalang': [
        { name: 'San Juan', postal_code: '2011' },
        { name: 'Santa Rita', postal_code: '2011' },
        { name: 'San Isidro', postal_code: '2011' },
        { name: 'San Pedro', postal_code: '2011' },
        { name: 'Santo Niño', postal_code: '2011' },
        { name: 'Santo Rosario', postal_code: '2011' }
    ],
    'Masantol': [
        { name: 'San Isidro', postal_code: '2011' },
        { name: 'San Pablo', postal_code: '2011' },
        { name: 'Santo Niño', postal_code: '2011' },
        { name: 'Sapang Bato', postal_code: '2011' },
        { name: 'San Sebastian', postal_code: '2011' }
    ],
    'Mexico': [
        { name: 'San Felipe', postal_code: '2010' },
        { name: 'San Isidro', postal_code: '2010' },
        { name: 'San Pedro', postal_code: '2010' },
        { name: 'San Jose', postal_code: '2010' },
        { name: 'Santa Monica', postal_code: '2010' },
        { name: 'Longos', postal_code: '2010' }
    ],
    'Minalin': [
        { name: 'San Vicente', postal_code: '2005' },
        { name: 'San Pedro', postal_code: '2005' },
        { name: 'San Nicolas', postal_code: '2005' },
        { name: 'San Juan', postal_code: '2005' },
        { name: 'Balas', postal_code: '2005' },
        { name: 'Santo Niño', postal_code: '2005' }
    ],
    'Porac': [
        { name: 'Cupang', postal_code: '2009' },
        { name: 'Bunga', postal_code: '2009' },
        { name: 'Santo Niño', postal_code: '2009' },
        { name: 'Pulung Bulu', postal_code: '2009' },
        { name: 'San Juan', postal_code: '2009' },
        { name: 'Bagumbayan', postal_code: '2009' }
    ],
    'San Fernando': [
        { name: 'San Jose', postal_code: '2000' },
        { name: 'San Agustin', postal_code: '2000' },
        { name: 'San Juan', postal_code: '2000' },
        { name: 'San Antonio', postal_code: '2000' },
        { name: 'Santo Niño', postal_code: '2000' },
        { name: 'Masantol', postal_code: '2000' },
        { name: 'Bulaon', postal_code: '2000' }
    ],
    'San Luis': [
        { name: 'San Roque', postal_code: '2015' },
        { name: 'San Antonio', postal_code: '2015' },
        { name: 'Santo Niño', postal_code: '2015' },
        { name: 'San Isidro', postal_code: '2015' },
        { name: 'San Vicente', postal_code: '2015' }
    ],
    'San Simon': [
        { name: 'San Juan', postal_code: '2010' },
        { name: 'San Isidro', postal_code: '2010' },
        { name: 'San Vicente', postal_code: '2010' },
        { name: 'Santo Niño', postal_code: '2010' },
        { name: 'Pulung Maragul', postal_code: '2010' }
    ],
    'Santo Tomas': [
        { name: 'San Matias', postal_code: '2016' },
        { name: 'San Bartolome', postal_code: '2016' },
        { name: 'San Vicente', postal_code: '2016' },
        { name: 'Santo Niño', postal_code: '2016' },
        { name: 'Santo Rosario', postal_code: '2016' }
    ],
    'Santa Ana': [
        { name: 'San Luis', postal_code: '2009' },
        { name: 'San Vicente', postal_code: '2009' },
        { name: 'San Felipe', postal_code: '2009' },
        { name: 'San Miguel', postal_code: '2009' },
        { name: 'Santo Niño', postal_code: '2009' }
    ],
    'Santa Rita': [
        { name: 'San Juan', postal_code: '2006' },
        { name: 'San Vicente', postal_code: '2006' },
        { name: 'Santo Niño', postal_code: '2006' },
        { name: 'San Pedro', postal_code: '2006' },
        { name: 'San Isidro', postal_code: '2006' }
    ],
    'Sasmuan': [
        { name: 'San Pedro', postal_code: '2009' },
        { name: 'San Isidro', postal_code: '2009' },
        { name: 'San Vicente', postal_code: '2009' },
        { name: 'San Antonio', postal_code: '2009' },
        { name: 'San Agustin', postal_code: '2009' }
    ]
    };

    // Function to populate Barangay based on selected city
const citySelect = document.getElementById('city');
const barangaySelect = document.getElementById('barangay');
const addressFields = document.getElementById('address_fields');

// Set the default option for barangay based on the user's current barangay
barangaySelect.innerHTML = `<option value="{{ $user->brgy }}" selected>{{ $user->brgy }}</option>`;

// Populate barangays based on the selected city when the page loads
const initialCity = citySelect.value;
if (initialCity) {
    const barangays = cityBarangays[initialCity];

    // Clear previous options
    barangaySelect.innerHTML = '<option value="" disabled>Select a brgy</option>';

    if (barangays) {
        barangays.forEach(function(barangay) {
            const option = document.createElement('option');
            option.value = barangay.name;
            option.textContent = barangay.name;
            barangaySelect.appendChild(option);
        });

        // Set the default barangay if it exists in the barangays array
        if (barangays.some(b => b.name === '{{ $user->brgy }}')) {
            barangaySelect.value = '{{ $user->brgy }}';
        }

        // Show address fields when a barangay is selected
        barangaySelect.addEventListener('change', function() {
            const selectedBarangay = barangaySelect.value;
            const postalCode = barangays.find(barangay => barangay.name === selectedBarangay).postal_code;

            document.getElementById('postal_code').value = postalCode;
            addressFields.classList.remove('hidden');
        });
    } else {
        addressFields.classList.add('hidden');
    }
}

// Add event listener for city selection
citySelect.addEventListener('change', function() {
    const city = this.value;
    const barangays = cityBarangays[city];

    // Clear previous options
    barangaySelect.innerHTML = '<option value="" disabled selected>Select a brgy</option>';

    if (barangays) {
        barangays.forEach(function(barangay) {
            const option = document.createElement('option');
            option.value = barangay.name;
            option.textContent = barangay.name;
            barangaySelect.appendChild(option);
        });

        // Show address fields when a barangay is selected
        barangaySelect.addEventListener('change', function() {
            const selectedBarangay = barangaySelect.value;
            const postalCode = barangays.find(barangay => barangay.name === selectedBarangay).postal_code;

            document.getElementById('postal_code').value = postalCode;
            addressFields.classList.remove('hidden');
        });
    } else {
        addressFields.classList.add('hidden');
    }
});
</script>



@if(session('page') == "1")
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            showTab('accountDetails');
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
                showTab('userInfo')
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
    showTab('accountDetails')
    </script>
@endif

@if($errors)
    @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
    <script>
        showTab('accountDetails')
        </script>
    @elseif ($errors->has('fname') || $errors->has('mname') || $errors->has('lname')|| $errors->has('age')
        || $errors->has('gender')|| $errors->has('province')|| $errors->has('city')|| $errors->has('brgy')
        || $errors->has('postal_code')|| $errors->has('house_no') || $errors->has('street'))
    <script>
        showTab('userInfo')
        </script>
    @endif
@endif

</x-app-layout>