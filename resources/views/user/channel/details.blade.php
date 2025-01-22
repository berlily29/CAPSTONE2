
    <div class="bg-gray-50 w-full">
        <div class="w-full">
            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg pb-4">



                <!-- Main Content -->
                <div class="bg-white shadow-lg rounded-lg">
                    <!-- Event Details and Contact Information Container -->
                    <div class="flex flex-wrap lg:flex-nowrap gap-8">

                        <!-- Event Details -->
                        <div class="w-full lg:w-1/2 py-4 px-8">
                            <div class="flex flex-col gap-4">
                                <div>
                                    <span class="text-sm text-gray-400">Event Title</span>
                                    <h2 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h2>
                                </div>

                                <div>
                                    <span class="text-gray-400">Date</span>
                                    <h2 class="text-sm font-bold text-gray-700">{{ $event->date }}</h2>
                                </div>
                                <div>
                                    <span class="text-gray-400">Location</span>
                                    <h2 class="text-sm font-bold text-gray-700">{{ $event->venue }}</h2>
                                </div>

                                <div>
                                    <h3 class="text-sm text-gray-400">Event Description</h3>
                                    <p class="text-lg font-bold text-gray-700">{{ $event->description }}</p>
                                </div>
                                <div>
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
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="w-full lg:w-1/2 border-l px-8 border-gray-200 py-8">
                            <h1 class="text-sm font-medium text-gray-500">Event Organizer</h1>
                            <h3 class="text-[2rem] font-black text-gray-700">Contact Information</h3>
                            <div class="mt-6 flex flex-col gap-4">
                                @if($event->organizer->user->profile_picture !== null)
                                <img src="{{ asset('storage/uploads/profilepic/' . $event->organizer->user->profile_picture) }}" alt="" class="w-32 h-32">
                                @endif
                                <div class="flex flex-col w-full gap-2 justify-center">
                                    <div class="border border-gray-300 p-2">
                                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Name</h2>
                                        <p class="font-bold text-lg text-gray-600">{{ $event->organizer->user->lname }}, {{ $event->organizer->user->fname }} {{ $event->organizer->user->mname }}</p>
                                    </div>
                                    <div class="border border-gray-300 p-2">
                                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Email</h2>
                                        <p class="font-bold text-lg text-gray-600">{{ $event->organizer->email }} </p>
                                    </div>
                                    <div class="border border-gray-300 p-2 ">
                                        <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Mobile Number</h2>
                                        <p class="font-bold text-lg text-gray-600">{{ $event->organizer->user->mobile_no }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
