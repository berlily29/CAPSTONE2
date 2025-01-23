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


        <!-- tools -->

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
</x-app-layout>
