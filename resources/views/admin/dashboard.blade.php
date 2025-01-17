<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-8 rounded-lg">

        <!-- Dashboard Header -->
        <section class="mb-6 text-center md:text-left">
            <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
            <p class="text-xl text-gray-700">Hello, <span class="font-semibold text-pink-600">{{ Auth::user()->user->fname }}!</span></p>
            <p class="text-gray-600" id="current-date">Today is: </p>
        </section>

        <!-- Dashboard Overview -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Total Users</h3>
                <p class="text-[5rem] text-pink-600 font-black">{{$users}}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Total Event Organizers</h3>
                <p class="text-[5rem] text-pink-600 font-black">{{$event_organizers}}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Total Events</h3>
                <p class="text-[5rem] text-pink-600 font-black">300</p>
            </div>
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
