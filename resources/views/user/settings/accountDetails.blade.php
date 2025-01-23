<div class='w-full '>
    <h2 class="w-full text-2xl font-bold text-gray-800 mb-4">Edit User Information</h2>

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
                <label for="fname" class=" w-full block text-sm font-medium text-pink-500">First Name</label>
                <input type="text" id="fname" name="fname" class="text-xl px-4 py-2 w-full mt-1 block rounded-md border border-gray-300" value="{{ $user->fname }}" required>
            </div>

            <div class="pr-5">
                <label for="mname" class="w-full block text-sm font-medium text-pink-500">Middle Name</label>
                <input type="text" id="mname" name="mname" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md" value="{{ $user->mname }}" required>
            </div>

            <div class="pr-5">
                <label for="lname" class="w-full block text-sm font-medium text-pink-500">Last Name</label>
                <input type="text" id="lname" name="lname" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300  rounded-md" value="{{ $user->lname }}" required>
            </div>

            <div class="pr-5">
                <label for="age" class="w-full block text-sm font-medium text-pink-500">Age</label>
                <input type="text" id="age" name="age" class="text-xl px-4 py-2 w-full mt-1 block border border-gray-300 rounded-md" value="{{ $user->age }}" required>
            </div>

            <div class="pr-5">
                <label for="gender" class="w-full block text-sm font-medium text-pink-500">Gender</label>
                <select id="gender" name="gender" class="text-xl w-full px-4 py-2 block border border-gray-300 rounded-md">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

        </div>


        <h2 class="text-2xl font-bold text-gray-800 mb-4 w-full">Edit Address</h2>

                    <div class="space-y-4 w-full">
        <!-- Province (Fixed to Pampanga) -->
        <div>
            <label for="province" class="block text-sm font-semibold text-pink-500">Province</label>
            <input type="text" id="province" name="province" value="Pampanga" readonly
                class="text-xl mt-2 block w-full px-4 py-2 border border-gray-700 rounded-md bg-pink-400 text-gray-600" required>
        </div>

        <div id="city_div">
            <label for="city" class="block text-sm font-semibold text-pink-500">City</label>
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
            <label for="barangay" class="block text-sm font-semibold text-pink-500">Barangay</label>
            <select id="barangay" name="brgy" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md " required>
                <!-- Barangay options will be populated based on city selection -->             
            </select>
        </div>

        <!-- Hidden Fields (House No., Street, Postal Code) -->
        <div id="address_fields" class="hidden">

            <!-- Postal Code -->
            <div>
                <label for="postal_code" class="block text-sm font-semibold text-pink-500">Postal Code</label>
                <input readonly type="text" id="postal_code" value="{{$user->postal_code}}" name="postal_code" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-gray-600" required>
            </div>
            <!-- House No. -->
            <div>
                <label for="house_no" class="block text-sm font-semibold text-pink-500">House No.</label>
                <input type="text" id="house_no" name="house_no" value="{{$user->house_no}}" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
            </div>

            <!-- Street -->
            <div>
                <label for="street" class="block text-sm font-semibold text-pink-500">Street</label>
                <input type="text" id="street" name="street" value="{{$user->street}}" class="text-xl mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
            </div>
        </div>

                    </div>

                    <div class="mt-2 text-center w-full flex flex-row-reverse">
        <button id="editButton" class="flex items-center justify-center w-12 h-12  my-2  bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition-colors">
            <span class="material-icons">edit</span>

        </button>

        </div>
    </form>
</div>