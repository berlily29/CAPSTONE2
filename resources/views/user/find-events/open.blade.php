@extends('user.find-events.view')

@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class="container mx-auto mt-8 px-4">
    <div class="space-y-8">
        @foreach ([
            ['id' => 1, 'name' => 'Event 1', 'date' => 'January 15, 2025', 'venue' => 'Barangay Hall', 'category' => 'Sports'],
            ['id' => 2, 'name' => 'Event 2', 'date' => 'February 20, 2025', 'venue' => 'Barangay Hall', 'category' => 'Nature'],
            ['id' => 3, 'name' => 'Event 3', 'date' => 'March 25, 2025', 'venue' => 'Barangay Hall', 'category' => 'Sports']
        ] as $event)
        
        <div class="mt-4 event bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">{{ $event['name'] }}</h3>
                <button class="bg-pink-500 text-white p-3 rounded-full hover:bg-pink-600 transition" onclick="toggleEventDetails('event{{ $event['id'] }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Details -->
            <div id="event{{ $event['id'] }}-details" class="event-details hidden mt-4">
                <div class="nav-tabs flex mb-4 space-x-4">
                    <button id="event{{ $event['id'] }}-detail-tab" class="px-3 py-2 font-medium border-b-2 focus:outline-none border-black text-pink-500"
                        onclick="showTab('event{{ $event['id'] }}', 'detail')">
                        Event Details
                    </button>
                    <button id="event{{ $event['id'] }}-organizer-tab" class="px-3 py-2 font-medium border-b-2 focus:outline-none border-transparent text-black"
                        onclick="showTab('event{{ $event['id'] }}', 'organizer')">
                        Organizer Details
                    </button>
                </div>

                <!-- Content -->
                <div id="event{{ $event['id'] }}-detail" class="tab-content mt-4">
                    <div class="text-black space-y-2">
                        <p><strong>Event Name:</strong> {{ $event['name'] }}</p>
                        <p><strong>Date:</strong> {{ $event['date'] }}</p>
                        <p><strong>Venue:</strong> {{ $event['venue'] }}</p>
                        <p><strong>Category:</strong> {{ $event['category'] }}</p>
                    </div>

                    <div class="mt-4">
                        <button class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition">
                            Join Event
                        </button>
                    </div>
                </div>

                <!-- Event organizer -->
                <div id="event{{ $event['id'] }}-organizer" class="tab-content mt-4 hidden">
                    <p class="text-black">Event Organizer Details go here</p>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

<script>
    function toggleEventDetails(eventId) {
        const eventDetails = document.getElementById(`${eventId}-details`);
        eventDetails.classList.toggle('hidden');
    }

    function showTab(eventId, tabType) {
        const allTabs = document.querySelectorAll(`#${eventId}-details .tab-content`);
        allTabs.forEach(function(tab) {
            tab.classList.add('hidden'); 
        });

        const selectedTab = document.getElementById(`${eventId}-${tabType}`);
        selectedTab.classList.remove('hidden');

        const allTabButtons = document.querySelectorAll(`#${eventId}-details .nav-tabs button`);
        allTabButtons.forEach(function(button) {
            button.classList.remove('border-black', 'text-pink-500');
            button.classList.add('border-transparent', 'text-black');
        });

        const activeButton = document.getElementById(`${eventId}-${tabType}-tab`);
        activeButton.classList.add('border-black', 'text-pink-500');
    }
</script>

@endsection
