<x-app-layout>
<div class="min-h-screen bg-gray-100 p-8">

<section class="bg-white p-8 rounded-lg shadow">
    <h1 class="font-black text-[2rem] text-gray-600"> My Profile</h1>
    <hr class="opacity-100 my-4">
  <div class="flex items-center mb-6">
    <img src="{{asset('storage/uploads/profilepic/' . $user->profile_picture )}}" alt="Profile Picture" class="w-24 h-24 rounded bg-gray-300 mr-4">

    <!-- <div>
      <button class="w-full bg-gray-200 p-2.5 rounded-2xl hover:bg-gray-300 mt-3 text-sm flex items-center justify-center">
        Change Profile Picture
      </button>
    </div> -->
  </div>

  <!-- Personal Info -->
  <div class="mb-6">
    <h3 class="text-lg font-bold text-gray-700 mb-2">Personal Information</h3>


    <h3 class="text-sm text-gray-400 mb-2 mt-4">Full Name</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">First Name</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->fname }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Middle Name</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->mname }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Last Name</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->lname }}</p>
      </div>
    </div>






    <!-- 2nd row -->

    <div class="grid grid-cols-1 md:grid-cols-[60%_20%_20%] gap-4 mb-4">
      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Mobile No.</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->mobile_no }} </p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Age</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->age }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Gender</h2>
        @if($user->gender === 'male')
        <p class="font-bold text-lg text-gray-600">M</p>
        @else
        <p class="font-bold text-lg text-gray-600">F</p>
        @endif
      </div>


    </div>



    <!-- address -->
    <h3 class="text-sm text-gray-400 mb-2 mt-4">Complete Address</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">House no.</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->house_no }} </p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Street</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->street }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Barangay</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->brgy }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">City</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->brgy }}</p>
      </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-[70%_30%] gap-4 mb-4">
      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Province</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->province }} </p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Postal Code</h2>
        <p class="font-bold text-lg text-gray-600">{{ $user->postal_code }}</p>
      </div>

    </div>





  </div>

  <!-- Points -->
  <hr class="opacity-100 mt-8 mb-4">
  <div>
    <div class="flex items-center mb-4">
      <h3 class="text-lg font-semibold">Your Points: </h3>
      <p class="ml-2">{{ $user->profile_points }}</p>
    </div>
  </div>

  <!-- Participated Events -->
  <div class="border-gray-300 pt-6">
    <h3 class="text-lg font-semibold mb-4">Participated Events</h3>
    <ul>

        <li class="mb-2">Tree Planting - 11/11/2024</li>

    </ul>
  </div>
</section>
</div>

</x-app-layout>
