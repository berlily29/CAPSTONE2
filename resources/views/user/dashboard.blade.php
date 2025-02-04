<x-app-layout>
   <div class="min-h-screen bg-white p-8 rounded-lg">

      <!-- Dashboard Header -->
      <section class="mb-6 text-center md:text-left">
         <h2 class="text-3xl font-black text-gray-700 ">Dashboard</h2>
         <p class="text-xl text-gray-700">Hello, <span class="font-semibold text-pink-600">{{ Auth::user()->user->fname }}!</span></p>
         <p class="text-gray-600" id="current-date">Today is: </p>
      </section>

      @if(!$is_approved)
         <div class="{{ $is_rejected ? 'bg-red-500' : 'bg-green-500' }} text-white p-4 shadow-md flex items-center space-x-3 mb-4">
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a9 9 0 11-9-9 9 9 0 019 9z" />
            </svg>
            <div>
                  @if($is_rejected)
                     <p class="font-semibold">Submitted ID Rejected</p>
                     <p>Your account needs a valid ID for approval. Please <a class='font-bold underline' href="{{ route('auth.id') }}">Click here</a> to resubmit and access other features.</p>
                  @else
                     <p class="font-semibold">Account Under Approval</p>
                     <p>Your account is currently under approval. Kindly wait for an email notification.</p>
                  @endif
            </div>
         </div>
      @endif

      <!-- Notifications -->
      <section class="grid grid-cols-2 gap-6" >
         <div class="bg-white p-6 border border-gray-200">
            <h3 class="flex items-center justify-between text-lg font-semibold text-gray-800">
               <div class="flex items-center">
                  <span class="material-icons mr-2 text-sky-600">notifications</span>
                  <h1 class="font-black  text-sky-600">

                      Notifications
                  </h1>
               </div>
            </h3>

            @if($notifications->count() > 0)
               <ul class="mt-4 space-y-3">
                  @foreach($notifications as $notification)
                     <li class="flex justify-between items-center p-3 bg-sky-100 rounded-lg shadow-sm">
                        <p class="text-sky-500">{{ $notification->caption }}</p>
                        <a href="{{ route('user.channel.index', ['id'=> $notification->channel_id]) }}">
                           <span>
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 hover:text-blue-700 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
         <div class="bg-white p-6 border border-gray-200">
            <h3 class="flex items-center text-lg font-semibold text-gray-800">
               <span class="material-icons mr-2 text-pink-500">event</span>
               Your Events
            </h3>
            @if($upcoming->count()== 0)
            <p class="mt-2 text-gray-600">You have no upcoming events.</p>
            @else
            <div class="flex flex-col gap-2 mt-2">

                @foreach($upcoming as $event)
                <li class="flex justify-between gap-2 p-3 bg-pink-100 text-pink-500 rounded-lg shadow-sm overflow-y">
                    <div class="flex items-center">

                        <p class="text-pink-500 font-semibold">{{ $event->title }}</p>
                    </div>

                    <div class="flex-items-center">

                        <a href="{{ route('user.channel.index', ['id'=> $event->channel_id]) }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 hover:text-blue-700 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </a>

                    </div>
                </li>
                @endforeach
            </div>

            @endif
            <div class="relative w-full mt-4">
               <a href="{{ route('find-events.index') }}" class="w-full bg-pink-500 p-2 rounded-lg text-white hover:bg-pink-600 hover:scale-105 transition-all text-sm flex items-center justify-center">
                  Find Events >
                </a>
            </div>
         </div>
      </section>

      <!-- Other Events -->
      <section class="bg-white p-6 rounded-lg border border-gray-200 mt-4">
         <h3 class="text-lg font-bold text-gray-800 text-center mb-4">Check out these Events!</h3>
         <p class="text-center text-gray-600">No featured events at the moment. Stay tuned!</p>
      </section>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
               axios.post("{{ route('notifications.delete', ['id' => '__ID__']) }}".replace('__ID__', notificationId), {
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
                        window.location.href = "/dashboard"; // Redirect to dashboard
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
