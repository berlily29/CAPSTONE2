<div class="mb-4 text-center">
    <p class="text-gray-400">Discover events recommended just for you, based on your preferences and activity.</p>
    <div class="w-full flex justify-center">

        <button id="generate-btn" class="flex flex-col items-center text-white mt-4 px-6 py-8 bg-gradient-to-r from-pink-500 to-sky-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all">

            <span class="material-symbols-outlined text-[3rem]">
                search
            </span>



            Find an Event for you
        </button>
    </div>

    <!-- Popup Loader (Hidden by Default) -->
    <div id="popup-loader" class="popup-loader hidden fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 z-50">
        <div class="card">
            <div class="loader">
                    <div
                    class="p-3 animate-spin drop-shadow-2xl bg-gradient-to-bl from-pink-400 via-purple-400 to-indigo-600 md:w-48 md:h-48 h-32 w-32 aspect-square rounded-full"
                    >



                    <div
                        class="rounded-full h-full w-full bg-slate-100 dark:bg-zinc-900 background-blur-xl"
                    ></div>
                    </div>

            </div>
        </div>
    </div>

    <!-- Recommended Event Display (Hidden Initially) -->
    <div id="recommendation" class="mt-6 hidden">
        <div class="group relative bg-white rounded-2xl shadow-sm transition-all border border-gray-100 hover:border-pink-100 overflow-hidden">
            <!-- Gradient Accent Bar -->
            <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-pink-500 to-sky-600"></div>

            <div class="pl-6 pr-4 py-6 flex flex-col items-center gap-4">
                <!-- Event Details -->
                <div class="flex flex-col">
                    <h3 id="event_title" class="text-xl font-bold text-pink-600 mb-3"></h3>

                    <div class="flex items-center gap-3 text-pink-500 mb-4">
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

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <a id =  "event-details-link" href=""
                       class="flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-pink-500 to-sky-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Details
                    </a>

                    <!-- Generate Again Button -->
                    <button id="generate-again-btn" class="flex items-center gap-2 px-5 py-2.5 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all">
                    <span class="material-symbols-outlined">
restart_alt
</span>
                    Generate Again
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to update the event recommendation display
    function updateRecommendation(recEvent) {
        document.querySelector('#event_title').textContent = recEvent.title;
        document.querySelector('#event_date').textContent = recEvent.date.split("T")[0]
        document.querySelector('#event_venue').textContent = recEvent.venue;
        document.getElementById('event-details-link').href = `/events/${recEvent.event_id}`;



        // Make the recommendation visible
        document.getElementById("recommendation").classList.remove("hidden");
    }

    // Handle Generate Again Button Click
    document.getElementById("generate-again-btn").addEventListener("click", function() {
        // Show the loader and hide the button
        document.getElementById("popup-loader").classList.remove("hidden");

        // Fetch the new event recommendation using AJAX
        fetch("{{ route('find-events.getNewRecommendation') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById("popup-loader").classList.add("hidden");


                // Update the event details with the new recommendation
                const recEvent = data.rec_event;


                document.querySelector('#event_title').textContent = recEvent.title;
                document.querySelector('#event_date').textContent = recEvent.date.split("T")[0]
                document.querySelector('#event_venue').textContent = recEvent.venue;
                document.getElementById('event-details-link').href = `/events/${recEvent.event_id}`;

                // Show event recommendation
                document.getElementById("recommendation").classList.remove("hidden");

            })
            .catch(error => {
                console.error("Error fetching new recommendation:", error);
                document.getElementById("popup-loader").classList.add("hidden");
                alert("An error occurred while fetching a new recommendation.");
            });
    });

    // Handle the initial page load recommendation display (just in case)
    document.getElementById("generate-btn").addEventListener("click", function() {
        // Show the loader and hide the button
        document.getElementById("popup-loader").classList.remove("hidden");
        this.classList.add("hidden");

        // Fetch the first event recommendation
        fetch("{{ route('find-events.getNewRecommendation') }}")
            .then(response => response.json())
            .then(data => {
                 // Hide loader
        document.getElementById("popup-loader").classList.add("hidden");

        // Show event recommendation
        document.getElementById("recommendation").classList.remove("hidden");

        // Update the event details with the new recommendation
        const recEvent = data.rec_event;
        console.log(recEvent.title)

        // Assuming rec_event has title, date, venue, etc.
        document.querySelector('#event_title').textContent = recEvent.title;
        document.querySelector('#event_date').textContent = recEvent.date.split("T")[0]
        document.querySelector('#event_venue').textContent = recEvent.venue;
        document.getElementById('event-details-link').href = `/events/${recEvent.event_id}`;


            })
    })
</script>
