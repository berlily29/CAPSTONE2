<x-app-layout>
  <div class="p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-3xl font-black mb-6 flex items-center text-gray-700">
      <span class="material-icons mr-2 text-pink-500 text-4xl">emoji_events</span> Top Performers
    </h2>

    <!-- Leaderboard -->
    <div class="bg-gray-50  p-6 rounded-lg shadow-md">
      <h3 class="text-xl font-semibold text-pink-600 mb-4">Leaderboard</h3>
      <div class="divide-y divide-pink-300">
        <!-- Top 10 -->
        <div class="mb-4">
          <h4 class="text-lg font-bold text-pink-500 mb-3">Top 10</h4>
          <ul class="space-y-2">
            @foreach($top10 as $index => $u)
              <li class="flex justify-between items-center bg-gray-100 p-3 rounded-lg shadow-sm">
                <div class="flex items-center space-x-3">
                  <span class="text-lg font-bold text-pink-600">#{{ $index + 1 }}</span>
                  <span class="font-semibold text-gray-800">{{ $u->fullname }}</span>
                </div>
                <span class="text-lg text-pink-500 font-bold">{{ $u->profile_points }} pts</span>
              </li>
            @endforeach
          </ul>
        </div>

        <!-- Divider -->
        <div class="h-1 bg-pink-500 my-6 rounded-full"></div>

        <!-- Top 11-30 -->
        <div>
          <h4 class="text-lg font-bold text-pink-500 mb-3">Rank 11 - 30</h4>
          <ul class="space-y-2">
            @foreach($top30 as $index => $u)
              @if($index >= 10)
                <li class="flex justify-between items-center bg-gray-100 p-3 rounded-lg shadow-sm">
                  <div class="flex items-center space-x-3">
                    <span class="text-lg font-bold text-pink-600">#{{ $index + 1 }}</span>
                    <span class="font-semibold text-gray-800">{{ $u->fullname }}</span>
                  </div>
                  <span class="text-lg text-pink-500 font-bold">{{ $u->profile_points }} pts</span>
                </li>
              @endif
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <!-- User Details and Points -->
    <div class="mt-8 text-center bg-gray-100 p-6 rounded-lg shadow-md">
      <span class="text-xl font-semibold text-gray-800">Your Profile</span>
      <div class="mt-2 text-2xl text-pink-500 font-bold">
        <span>{{ $user->fullname }}</span>
      </div>
      <span class="text-xl font-semibold text-gray-800">Current Points:</span>
      <div class="mt-2 text-3xl text-pink-500 font-bold">
        <span>{{ $user->profile_points }}</span>
      </div>
    </div>
  </div>
</x-app-layout>
