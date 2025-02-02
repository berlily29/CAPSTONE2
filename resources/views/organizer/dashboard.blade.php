<x-app-layout>
    <div class="w-full bg-white rounded-lg p-8">
        <h1 class="text-3xl font-black text-gray-700 mb-6">Dashboard</h1>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">


            <div class="bg-white p-6  border border-gray-200 rounded-lg">
                <p class="text-[0.8rem] text-gray-500 mt-2">Total upcoming events in the future</p>
                <h3 class="text-2xl font-black text-gray-700">Upcoming Events</h3>
                <p class="text-8xl font-black text-pink-600 mt-4">{{ $upcomingEvents }}</p>

            </div>


            <div class="bg-white p-6  border border-gray-200 rounded-lg">
                <p class="text-[0.8rem] text-gray-500 mt-2">Total events that have been completed</p>
                <h3 class="text-2xl font-black text-gray-700">Total Accomplished Events</h3>
                <p class="text-8xl font-black text-pink-600 mt-4">{{ $totalAccomplishedEvents }}</p>

            </div>

            <div class="bg-white p-6  border border-gray-200 rounded-lg">
                <p class="text-[0.8rem] text-gray-500 mt-2">Total events awaiting approval</p>
                <h3 class="text-2xl font-black text-gray-700">Current Pending Requests</h3>
                <p class="text-8xl font-black text-pink-600 mt-4">{{ $currentPendingRequests }}</p>


            </div>

        </div>



          <!-- Notifications -->
      <section class="grid grid-cols-2 gap-6 h-[300px] mt-4" >
         <div class="bg-white p-6 border border-gray-200">
            <h3 class="flex items-center justify-between text-lg font-semibold text-gray-800">
               <div class="flex items-center">
                  <span class="material-icons mr-2 text-sky-600">notifications</span>
                  Notifications
               </div>
            </h3>

            @if($notifications->count() > 0)
               <ul class="mt-4 space-y-3">
                  @foreach($notifications as $notification)
                     <li class="flex justify-between items-center p-3 bg-gray-100 rounded-lg shadow-sm">
                        <p class="text-gray-700">{{ $notification->caption }}</p>
                        <a href="{{ route('eo.channels.view', ['id'=> $notification->channel_id]) }}">
                           <span>
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 hover:text-blue-700 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                 <path d="M5 12h14"></path>
                                 <path d="M12 5l7 7-7 7"></path>
                              </svg>
                           </span>
                        </a>
                        <button onclick="deleteNotification('{{ $notification->id }}')" class="text-red-500 hover:text-red-700">
                           <span class="material-icons text-lg">delete</span>
                        </button>
                     </li>
                  @endforeach
               </ul>
            @else
               <p class="mt-3 text-gray-600 text-center">You have no new notifications.</p>
            @endif
         </div>

         <!-- Events -->
         <div class="bg-white p-6 border border-gray-200 ">

                    <h1 class="mt-8 flex items-center gap-2 text-gray-600 text-3xl font-black">
                        <span class="material-icons "> build </span>
                        Tools
                    </h1>
                    <h1 class="text-sm text-gray-400">Everything you need to streamline event operations</h1>

                <div class="flex  gap-2 mt-4">

                        <!-- Create Post Button -->
                        <div class="flex">
                            <a href="#" class="flex items-center justify-center gap-2 bg-pink-500 text-white py-3 px-6 rounded-lg hover:bg-pink-600 transition-all">
                                <span class="material-icons">create</span>
                                <span>Create Post</span>
                            </a>
                        </div>

                        <!-- Submit Event Proposal Button -->
                        <div class="flex ">
                            <a href="#" class="flex items-center justify-center gap-2 bg-sky-600 text-white py-3 px-6 rounded-lg hover:bg-sky-700 transition-all">
                                <span class="material-icons">event_note</span>
                                <span>Submit Event Proposal</span>
                            </a>
                        </div>

                        <!-- Submit Documentation Button -->
                        <div class="flex ">
                            <a href="#" class="flex items-center justify-center gap-2 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 transition-all">
                                <span class="material-icons">event</span>
                                <span>Submit Documentation</span>
                            </a>
                        </div>


                </div>
         </div>
      </section>





    </div>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>


      // Delete Notification Function
      function deleteNotification(notificationId) {
         Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to recover this notification!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
         }).then((result) => {
            if (result.isConfirmed) {
               axios.post("{{ route('notifications.eodelete', ['id' => '__ID__']) }}".replace('__ID__', notificationId), {
                  _method: "DELETE"
               })
               .then(response => {
                  if (response.data.success) {
                     Swal.fire({
                        title: "Deleted!",
                        text: "Notification has been deleted.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                     }).then(() => {
                        window.location.href = "/portal/dashboard"; // Redirect to dashboard
                     });
                  }
               })
               .catch(error => {
                  Swal.fire("Error", "Something went wrong!", "error");
               });
            }
         });
      }
   </script>

</x-app-layout>
