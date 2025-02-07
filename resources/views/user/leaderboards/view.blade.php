<x-app-layout>

  <div class="bg-white p-4">
    <div class="p-4 space-y-8">
      <!-- Header -->
      <div class="flex items-center gap-4">
        <div class="p-3 bg-gradient-to-br from-pink-500 to-purple-600 rounded-lg shadow-lg">
          <span class="material-icons text-white text-4xl">emoji_events</span>
        </div>
        <h2 class="text-3xl font-black bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
          Top Performers
        </h2>
      </div>

      <!-- Leaderboard Sections -->
      <div class="space-y-8">
        <!-- Top 10 Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-4">
            <h3 class="text-xl font-semibold text-white">Leaderboard - Top 10</h3>
          </div>
          <div class="p-6 space-y-4">
            <ul class="space-y-3">
              @foreach($top10 as $index => $u)
              <li class="flex items-center justify-between p-4 rounded-lg hover:bg-gray-50 transition-colors
              @if($u->user_id === Auth::user()->user_id) bg-pink-100 @endif
                {{ $index < 3 ? 'border-l-4' : '' }}
                {{ $index === 0 ? 'border-l-rose-500' : '' }}
                {{ $index === 1 ? 'border-l-amber-500' : '' }}
                {{ $index === 2 ? 'border-l-emerald-500' : '' }}">
                <div class="flex items-center gap-4">
                  <span class="w-8 text-center font-bold
                    {{ $index === 0 ? 'text-rose-500' : '' }}
                    {{ $index === 1 ? 'text-amber-500' : '' }}
                    {{ $index === 2 ? 'text-emerald-500' : '' }}
                    {{ $index > 2 ? 'text-gray-400' : '' }}">
                    {{ $index + 1 }}
                  </span>
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                      <span class="text-sm font-medium text-gray-600">{{ strtoupper(substr($u->fullname, 0, 1)) }}</span>
                    </div>
                    <span class="font-medium text-gray-800"> @if($u->user_id === Auth::user()->user_id)<strong class="font-extrabold"> @endif {{ $u->fullname }}@if($u->user_id === Auth::user()->user_id)</strong> @endif

                    {{$u->user_id === Auth::user()->user_id ? '(You)' : ''}}  </span>
                  </div>
                </div>
                <span class="font-semibold text-pink-600">{{ $u->profile_points }} pts</span>
              </li>
              @endforeach
            </ul>
          </div>
        </div>

        <!-- Top 11-30 Card -->
        <div class="bg-white rounded-xl shadow-lg">
          <div class="bg-gray-100 p-4">
            <h3 class="text-lg font-semibold text-gray-700">Rank 11 - 30</h3>
          </div>
          <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              @foreach($top30 as $index => $u)
                @if($index >= 10)
                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                  <div class="flex items-center gap-3">
                    <span class="w-8 text-center font-bold text-gray-400">{{ $index + 1 }}</span>
                    <span class="font-medium text-gray-700">{{ $u->fullname }}</span>
                  </div>
                  <span class="font-medium text-pink-500">{{ $u->profile_points }} pts</span>
                </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- Current User Card -->
      <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
          <div class="space-y-2">
            <h3 class="text-lg font-semibold">Your Profile</h3>
            <p class="text-2xl font-bold">{{ $user->fullname }}</p>
          </div>
          <div class="text-right">
            <p class="text-lg font-medium">Current Points</p>
            <p class="text-3xl font-bold">{{ $user->profile_points }}</p>
          </div>
        </div>
        <div class="mt-4 flex justify-end">
          <span class="material-icons animate-bounce">arrow_upward</span>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
