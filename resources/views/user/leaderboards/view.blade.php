<x-app-layout>
  <div class="p-8">
    <h2 class="text-2xl font-bold mb-4 flex items-center">
      <span class="material-icons mr-2 text-pink-500">emoji_events</span> Top Volunteers
    </h2>

    <div class="flex space-x-8">

      <!-- All time -->
      <div class="w-1/2">
        <h3 class="text-lg font-semibold mb-2 text-pink-600">All time</h3>
        <div class="bg-pink-100 rounded-lg shadow p-4 h-64 flex items-center justify-center">
          <p class="text-center text-pink-700">Top performers will appear here</p>
        </div>
      </div>

      <!-- This month -->
      <div class="w-1/2">
        <h3 class="text-lg font-semibold mb-2 text-pink-600">This Month</h3>
        <div class="bg-pink-100 rounded-lg shadow p-4 h-64 flex items-center justify-center">
          <p class="text-center text-pink-700">Top volunteers of this month</p>
        </div>
      </div>
    </div>

    <!-- Points Display Container -->
    <div class="mt-6 text-center">
      <span class="text-xl font-semibold text-pink-600">Your points:</span>
      <div class="mt-2 text-2xl text-pink-500 font-bold">
        <span>{{ $user->points }}</span>
      </div>
    </div>
  </div>
</x-app-layout>
