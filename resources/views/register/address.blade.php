<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Up Address</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

<!-- Popup Loader -->
<div id="popup-loader" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-pink-500"></div>
        <p class="mt-4 text-gray-700">Processing, please wait...</p>
    </div>
</div>




    <div class="min-h-screen flex items-center justify-center p-8">
        <form action="{{route('auth.location.store')}}" method="POST" class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            @csrf
            @method('PUT') <!-- Use this if you're updating existing data, otherwise, POST for new -->

            <h2 class="text-2xl font-bold text-gray-800 mb-4">Set Up Your Address</h2>

            <div class="space-y-4">
                <!-- Province (Fixed to Pampanga) -->
                <div>
                    <label for="province" class="block text-sm font-semibold text-gray-700">Province</label>
                    <input type="text" id="province" name="province" value="Pampanga" readonly
                           class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-gray-600" required>
                </div>

                <!-- City -->
                <div id="city_div">
                    <label for="city" class="block text-sm font-semibold text-gray-700">City</label>
                    <select id="city" name="city" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                        <option value="" disabled selected>Select a City</option>
                        <!-- Cities here -->
                        <option value="Angeles">Angeles</option>
                        <option value="Apalit">Apalit</option>
                        <option value="Arayat">Arayat</option>
                        <option value="Candaba">Candaba</option>
                        <option value="Floridablanca">Floridablanca</option>
                        <option value="Guagua">Guagua</option>
                        <option value="Lubao">Lubao</option>
                        <option value="Mabalacat">Mabalacat</option>
                        <option value="Macabebe">Macabebe</option>
                        <option value="Magalang">Magalang</option>
                        <option value="Masantol">Masantol</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Minalin">Minalin</option>
                        <option value="Porac">Porac</option>
                        <option value="San Fernando">San Fernando</option>
                        <option value="San Luis">San Luis</option>
                        <option value="San Simon">San Simon</option>
                        <option value="Santo Tomas">Santo Tomas</option>
                        <option value="Santa Ana">Santa Ana</option>
                        <option value="Santa Rita">Santa Rita</option>
                        <option value="Sasmuan">Sasmuan</option>
                    </select>
                </div>

                <!-- Barangay (to be populated based on city selection) -->
                <div id="barangay_div">
                    <label for="barangay" class="block text-sm font-semibold text-gray-700">Barangay</label>
                    <select id="barangay" name="brgy" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                        <!-- Barangay options will be populated based on city selection -->
                    </select>
                </div>

                <!-- Hidden Fields (House No., Street, Postal Code) -->
                <div id="address_fields" class="hidden">

                    <!-- Postal Code -->
                    <div>
                        <label for="postal_code" class="block text-sm font-semibold text-gray-700">Postal Code</label>
                        <input readonly type="text" id="postal_code" name="postal_code" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-gray-600" required>
                    </div>
                    <!-- House No. -->
                    <div>
                        <label for="house_no" class="block text-sm font-semibold text-gray-700">House No.</label>
                        <input type="text" id="house_no" name="house_no" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                    </div>

                    <!-- Street -->
                    <div>
                        <label for="street" class="block text-sm font-semibold text-gray-700">Street</label>
                        <input type="text" id="street" name="street" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-pink-500  text-white py-3 rounded-md hover:bg-pink-600 transition-colors text-sm">
                        Save Address
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>

document.querySelector("form").addEventListener("submit", function() {
    // Show the loader popup
    document.getElementById("popup-loader").classList.remove("hidden");
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
    { name: 'San Agustin', postal_code: '2009' },
    { name: 'San Juan', postal_code: '2009' },
    { name: 'San Roque', postal_code: '2009' },
    { name: 'Santo Niño', postal_code: '2009' },
    { name: 'Sasmuan Poblacion', postal_code: '2009' },
    { name: 'Santo Rosario', postal_code: '2009' }
]
    };

     // Function to populate Barangay based on selected city
     const citySelect = document.getElementById('city');
        const barangaySelect = document.getElementById('barangay');
        const addressFields = document.getElementById('address_fields');

        citySelect.addEventListener('change', function() {
            const city = this.value;
            const barangays = cityBarangays[city];

            // Clear previous options
            barangaySelect.innerHTML = '<option value="" disabled selected>Select a Barangay</option>';

            if (barangays) {
                barangays.forEach(function(barangay) {
                    const option = document.createElement('option');
                    option.value = barangay.name;
                    option.textContent = barangay.name;
                    barangaySelect.appendChild(option);
                });

                // Show address fields when a city and barangay are selected
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
</body>
</html>
