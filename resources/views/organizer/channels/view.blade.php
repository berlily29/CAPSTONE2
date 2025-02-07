<x-app-layout>
    <div class="w-full p-8 bg-white">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-black text-gray-700 md:text-4xl">My Events</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your event channels</p>
        </div>

        <!-- Empty State -->
        @if($events->isEmpty())
        <div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
            <div class="p-12 border border-gray-400 rounded-xl hover:border-gray-600 transition-colors">
                <img src="{{ asset('images/icons/unavailable.png') }}" class="w-32 h-32 mx-auto mb-6" alt="No events">
                <h3 class="text-xl font-bold text-gray-700">No Events Available</h3>
            </div>
        </div>
        @else
        <!-- Events Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($events as $event)
            <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-200 rounded-xl hover:border-gray-300 hover:shadow-lg">
                <!-- Event Content -->
                <div class="p-6">
                    <!-- Event Header -->
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-lg font-black text-gray-700">{{ $event->title }}</h3>
                        <span class="px-2 py-1 text-xs rounded-full bg-sky-100 text-sky-600">
                            {{ $event->channel->name }}
                        </span>
                    </div>

                    <!-- Event Details -->
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $event->created_at->format('M d, Y') }}
                        </div>

                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ $event->joinedUsers->count() }}
                            {{ Str::plural('Volunteer', $event->joinedUsers->count()) }}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2 mt-6">
                        <a href="{{ route('eo.channels.view', $event->channel_id) }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white transition-colors bg-sky-500 rounded-lg hover:bg-sky-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            Manage
                        </a>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>
