<x-app-layout>
<div class="min-h-screen bg-gray-100 p-8">

<section class="bg-white p-8 rounded-lg shadow">
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
    <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2">First Name</h2>
        <p>{{ $user->fname }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2">Middle Name</h2>
        <p>{{ $user->mname }}</p>
      </div>

      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="font-semibold mb-2">Last Name</h2>
        <p>{{ $user->lname }}</p>
      </div>
    </div>

    <div class="border border-gray-300 rounded-md p-4 mb-4">
      <h2 class="font-semibold mb-2">Complete Address</h2>
      <p>{{ $user->address }}</p>
    </div>

    <div class="border border-gray-300 rounded-md p-4">
      <h2 class="font-semibold mb-2">Mobile Number</h2>
      <p>{{ $user->mobile_number }}</p>
    </div>
  </div>

  <!-- Points -->
  <hr class="border-t border-black">
  <div class="mb-6 pt-6">
    <div class="flex items-center mb-4">
      <h3 class="text-lg font-semibold">Your Points: </h3>
      <p class="ml-2">{{ $user->points }}</p>
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