<x-app-layout>
   <div class="min-h-screen bg-gray-50 p-8">

      <!-- Dashboard Header -->
      <section class="mb-6 text-center md:text-left">
         <h2 class="text-3xl font-black text-gray-600 ">Dashboard</h2>
         <p class="text-xl text-gray-700">Hello, <span class="font-semibold text-pink-600">{{Auth::user()->user->fname}}!</span></p>
         <p class="text-gray-600" id="current-date">Today is: </p>
      </section>


      @if($is_approved == false)
      <div class="bg-green-500 text-white p-4 rounded-lg shadow-md flex items-center space-x-3 mb-4">
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a9 9 0 11-9-9 9 9 0 019 9z" />
            </svg>
            <div>
                <p class="font-semibold">Account Under Approval</p>
                <p>Your account is currently under approval. Kindly wait for an email notification. Once approved, you will gain access to all features.</p>
            </div>
        </div>
        @endif


      <!-- Notifications and Events -->
      <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

         <!-- Notifications -->
         <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="flex items-center text-lg font-semibold text-gray-800">
               <span class="material-icons mr-2 text-sky-600">notifications</span>
               Notifications
            </h3>
            <p class="mt-2 text-gray-600">You have no new notifications.</p>
         </div>

         <!-- Your Events -->
         <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h3 class="flex items-center text-lg font-semibold text-gray-800">
               <span class="material-icons mr-2 text-pink-500">event</span>
               Your Events
            </h3>
            <p class="mt-2 text-gray-600">You have no upcoming events.</p>
            <div class="relative w-full mt-4">
               <button class="w-full bg-pink-500 p-2 rounded-lg text-white hover:bg-pink-600 hover:scale-105 transition-all text-sm flex items-center justify-center">
                  View Events >
               </button>
            </div>
         </div>

      </section>

      <!-- Other Events -->
      <section class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
         <h3 class="text-lg font-bold text-gray-800 text-center mb-4">Check out these Events!</h3>
         <p class="text-center text-gray-600">No featured events at the moment. Stay tuned!</p>
      </section>

   </div>

   <script>
      // Display today's date dynamically
      const currentDateElement = document.getElementById("current-date");
      const today = new Date();
      const formattedDate = today.toLocaleDateString("en-US", {
         weekday: "long",
         year: "numeric",
         month: "long",
         day: "numeric"
      });
      currentDateElement.textContent += formattedDate;
   </script>
</x-app-layout>
