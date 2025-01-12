<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="bg-gray-100 min-h-screen flex">
        <!-- Sidebar for Events -->
        <div class="w-1/3 bg-white p-4 shadow-md rounded-lg">
            <h2 class="mt-2 mb-4 text-xl text-center font-bold text-black">Your Events</h2>
            <ul>
                @foreach ($events as $event)
                    <li class="mb-1">
                        <a href="{{ route('user.joinevents.announcement', ['event_id' => $event['id']]) }}"
                           class="block p-2 text-md text-pink-600 {{ isset($event_id) && $event_id == $event['id'] ? 'font-bold' : '' }}">
                            {{ $event['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="flex-grow bg-white p-4 shadow-md rounded-lg ml-4">
            <nav class="flex border-b mb-4">
                <a href="{{ route('user.joinevents.announcement', ['event_id' => $event_id ?? ($events[0]['id'] ?? null)]) }}"
                   class="px-4 py-2 font-medium border-b-2 focus:outline-none {{ request()->routeIs('user.joinevents.announcement') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                    Announcements
                </a>

                <a href="{{ route('user.joinevents.stories', ['event_id' => $event_id ?? ($events[0]['id'] ?? null)]) }}"
                   class="px-4 py-2 font-medium border-b-2 focus:outline-none {{ request()->routeIs('user.joinevents.stories') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                    Stories
                </a>

                <a href="{{ route('user.joinevents.eventdetails', ['event_id' => $event_id ?? ($events[0]['id'] ?? null)]) }}"
                   class="px-4 py-2 font-medium border-b-2 focus:outline-none {{ request()->routeIs('user.joinevents.eventdetails') ? 'border-black text-pink-500' : 'border-transparent text-black' }}">
                    Event Details
                </a>
            </nav>

            <!-- Content -->
            @if(request()->routeIs('user.joinevents.announcement'))
                <div class="text-black">
                    @foreach ($announcements as $announcement)
                        {{ $announcement }}
                    @endforeach
                </div>

            @elseif(request()->routeIs('user.joinevents.stories'))
                <div class="text-black">
                    @foreach ($stories as $story)
                        {{ $story }}
                    @endforeach
                </div>

            @elseif(request()->routeIs('user.joinevents.eventdetails'))
                <div>
                    @foreach ($details as $detail)
                        {{ $detail }}
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
