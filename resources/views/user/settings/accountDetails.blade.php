<div class='w-full '>
    <h2 class="w-full text-2xl font-bold text-gray-700 mb-4"> User Information</h2>

    <form id="editForm" action="{{ route('user.settings.storeUserInfo') }}" class='w-full h-full' method="POST">
        @csrf
        @method('PATCH')

        @if ($errors->has('fname') || $errors->has('mname') || $errors->has('lname')|| $errors->has('age')
        || $errors->has('gender')|| $errors->has('province')|| $errors->has('city')|| $errors->has('brgy')
        || $errors->has('postal_code')|| $errors->has('house_no') || $errors->has('street')) || $errors->has('mobile_no')
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
                <label for="fname" class=" w-full block text-sm font-medium text-gray-400">First Name</label>
                <input type="text" id="fname" name="fname" class="text-xl px-4 py-2 w-full mt-1 block rounded-md border border-gray-300" value="{{ $user->fname }}" required>
            </div>

            <div class="pr-5">
                <label for="mname" class="w-full block text-sm font-medium text-gray-400">Middle Name</label>
                <input type="text" id="mname" name="mname" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md" value="{{ $user->mname }}" required>
            </div>

            <div class="pr-5">
                <label for="lname" class="w-full block text-sm font-medium text-gray-400">Last Name</label>
                <input type="text" id="lname" name="lname" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300  rounded-md" value="{{ $user->lname }}" required>
            </div>

            <div class="pr-5">
                <label for="mobile_no" class="w-full block text-sm font-medium text-gray-400">Mobile Number</label>
                <input type="text" id="mobile_no" name="mobile_no" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md" value="{{ $user->mobile_no }}" required>
            </div>

            <div class="pr-5">
                <label for="age" class="w-full block text-sm font-medium text-gray-400">Age</label>
                <input type="text" id="age" name="age" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md" value="{{ $user->age }}" required>
            </div>

            <div class="pr-5">
                <label for="gender" class="w-full block text-sm font-medium text-gray-400">Gender</label>
                <select id="gender" name="gender" class="text-xl w-full px-4 py-2 block border border-gray-300 rounded-md">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

        </div>


        <h2 class="text-2xl font-bold text-gray-700 mb-4 w-full">Edit Address</h2>

                    <div class="space-y-4 w-full">
        <!-- Province (Fixed to Pampanga) -->
        <div>
            <label for="province" class="block text-sm font-semibold text-gray-400">Province</label>
            <input type="text" id="province" name="province" value="Pampanga" readonly
                class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md text-gray-400" required>
        </div>

        <div id="city_div">
            <label for="city" class="block text-sm font-semibold text-gray-400">City</label>
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
            <label for="barangay" class="block text-sm font-semibold text-gray-400">Barangay</label>
            <select id="barangay" name="brgy" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md " required>
                <!-- Barangay options will be populated based on city selection -->
            </select>
        </div>

        <!-- Hidden Fields (House No., Street, Postal Code) -->
        <div id="address_fields" class="hidden">

            <!-- Postal Code -->
            <div>
                <label for="postal_code" class="block text-sm font-semibold text-gray-400">Postal Code</label>
                <input readonly type="text" id="postal_code" value="{{$user->postal_code}}" name="postal_code" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-gray-600" required>
            </div>
            <!-- House No. -->
            <div>
                <label for="house_no" class="block text-sm font-semibold text-gray-400">House No.</label>
                <input type="text" id="house_no" name="house_no" value="{{$user->house_no}}" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
            </div>

            <!-- Street -->
            <div>
                <label for="street" class="block text-sm font-semibold text-gray-400">Street</label>
                <input type="text" id="street" name="street" value="{{$user->street}}" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
            </div>
        </div>

                    </div>

                    <div class="mt-2 text-center w-full flex flex-row-reverse">
        <button id="editButton" type="button" class=" text-white font-semibold flex items-center justify-center p-2  my-2 text-white rounded-lg bg-gradient-to-r from-pink-500 to-pink-400 hover:scale-[1.02] transition-all">
            <span class="text-xl material-icons mx-2">edit</span> Edit Information
        </button>

        </div>
    </form>
</div>

<script>
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
    
</script>
