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
                  <h1 class="text-lg font-semibold text-gray-800">

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
    <h3 class="text-lg font-bold text-gray-800 text-center">Featured Event</h3>
    <p class="text-gray-400 text-center mb-4">Handpicked just for you—don't miss out!</p>
    <div class="mb-4 text-center">


        <!-- Loader -->
        <div id="popup-loader" class="popup-loader hidden fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50">
            <div class="card">
                <div class="loader">
                    <div class="p-3 animate-spin drop-shadow-2xl bg-gradient-to-bl from-pink-400 via-purple-400 to-indigo-600 md:w-48 md:h-48 h-32 w-32 aspect-square rounded-full">
                        <div class="rounded-full h-full w-full bg-slate-100 dark:bg-zinc-900 background-blur-xl"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommendation Display -->
        <div id="recommendation" class="mt-6 hidden">
            <div class="group relative bg-white rounded-2xl shadow-sm transition-all border border-gray-300 hover:border-pink-100 overflow-hidden">
                <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-pink-500 to-sky-600"></div>
                <div class="pl-6 pr-4 py-6 flex flex-col items-center gap-4">
                    <div class="flex flex-col">
                        <h3 id="event_title" class="text-xl font-bold text-pink-600 mb-3"></h3>
                        <div class="flex items-center gap-3 text-pink-500">
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2h-14a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <h1 id="event_date"></h1>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <h1 id="event_venue"></h1>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <a href="#" id="event-details-link" class="flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-pink-500 to-sky-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Details
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>

 // Recommendation functionality
 document.addEventListener("DOMContentLoaded", function() {
      // Show loader while fetching the event
      document.getElementById("popup-loader").classList.remove("hidden");

      fetch("{{ route('find-events.getNewRecommendation') }}")
         .then(response => response.json())
         .then(data => {
            document.getElementById("popup-loader").classList.add("hidden");
            document.getElementById("recommendation").classList.remove("hidden");

            const recEvent = data.rec_event;
            document.getElementById('event_title').textContent = recEvent.title;
            document.getElementById('event_date').textContent = recEvent.date.split("T")[0];
            document.getElementById('event_venue').textContent = recEvent.venue;
            document.getElementById('event-details-link').href = `/events/${recEvent.event_id}`;
         })
         .catch(error => {
            console.error("Error fetching recommended event:", error);
            document.getElementById("popup-loader").classList.add("hidden");
         });
   });

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
