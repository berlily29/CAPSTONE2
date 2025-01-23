<x-app-layout>

<div class="bg-white rounded-lg p-8">
    <div class="max-w-7xl ">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="max-w-full">
                        <h1 class="text-3xl font-black text-black">Settings</h1>
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
