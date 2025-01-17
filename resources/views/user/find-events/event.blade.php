<x-app-layout>
    <div class="bg-gray-50 w-full">
        <div class="w-full">
            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg pb-4">

                <div class="px-4 max-w-full pb-4">
                    <h1 class="ml-2 mt-5 text-3xl font-extrabold text-black">Event Details</h1>
                </div>

                <hr class="opacity-60">
                <div class="py-6 px-8 bg-white shadow-lg rounded-lg">
                    <!-- Event Header -->
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="flex flex-col gap-0 ">
                                <span class="text-sm text-gray-400">Event Title</span>
                                <h2 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h2>
                            </div>
                            <div class="flex gap-4 my-4">
                                <div class="flex flex-col gap-0">
                                    <span class="text-gray-400">Date</span>
                                    <h2 class="text-sm font-bold text-gray-700">{{ $event->date }}</h2>
                                </div>

                                <div class="flex flex-col gap-0">
                                    <span class="text-gray-400">Location</span>
                                    <h2 class="text-sm font-bold text-gray-700">{{ $event->venue }}</h2>
                                </div>


                            </div>

                        </div>

                    </div>



                    <!-- Event Description -->
                    <div class="mt-2">
                        <h3 class="text-sm text-gray-400">Event Description</h3>
                        <p class="text-lg font-bold text-gray-700">{{ $event->description }}</p>
                    </div>

                    <!-- Event Categories -->
                    <div class="mt-6">
                        <h3 class="text-2xl font-semibold text-gray-800">Categories</h3>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @if($event->event_category == 1 || $event->event_category == 6 || $event->event_category == 11 || $event->event_category == 16 || $event->event_category == 20)
                                <span class="px-4 py-2 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                    {{ $event->category->name }}
                                </span>
                            @else
                                <span class="px-4 py-2 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                    {{ $event->category->parent->name }}
                                </span>
                                <span class="px-4 py-2 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                    {{ $event->category->name }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Event Contact Information -->
                    <div class="mt-6">
                        <h3 class="text-2xl font-semibold text-gray-800">Contact Information</h3>
                        @if($event->organizer->user->profile_picture !== null)
                        <img src="{{asset('storage/uploads/profilepic/' . $event->organizer->user->profile_picture)}}" alt="">
                        @endif
                        <p class="text-lg text-gray-700 mt-2"><strong>Organizer:</strong> {{ $event->organizer->user->lname }}, {{ $event->organizer->user->fname }} {{ $event->organizer->user->mname }} </p>
                        <p class="text-lg text-gray-700 mt-1"><strong>Email:</strong> {{ $event->organizer->email }}</p>
                        <p class="text-lg text-gray-700 mt-1"><strong>Phone:</strong> {{ $event->organizer->user->mobile_no }}</p>
                    </div>

                    <!-- Event Terms & Conditions -->
                    <div class="mt-6">
                        <h3 class="text-2xl font-semibold text-gray-800">Terms & Conditions</h3>
                        <p class="text-lg text-gray-700 mt-2">
                            By joining this event, you agree to the terms and conditions. <a href="#" class="text-pink-500">Learn more</a>.
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>

</x-app-layout>
