<x-app-layout>
    <div class="bg-white w-full p-8">
        <div class="">
            <!-- Title Section -->
            <h1 class="text-sm text-gray-500">Channels</h1>
            <h1 class="text-3xl font-black text-gray-700 mb-6">My Events</h1>

            <!-- Event Cards Section -->
            <div class="grid grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="bg-white border border-gray-200 hover:border-gray-300 overflow-hidden transition duration-400 ease-in-out transform hover:scale-101">

                    <!-- Action Button -->



                    <div class="p-6 flex flex-col justify-left">
                            <div class="flex gap-2 mb-2   ">
                                <a href=""
                                class=" gap-2 flex items-center justify-center rounded-md bg-sky-500 text-white py-2 px-2 hover:bg-sky-600 text-sm font-semibold transition duration-400 ease-in-out">
                                <span class="material-symbols-outlined">folder_managed</span>
                                Manage
                                </a>

                                <a href=""
                                class=" gap-2 flex items-center justify-center rounded-md bg-red-500 text-white py-2 px-2 hover:bg-red-600 text-sm font-semibold transition duration-400 ease-in-out">
                                <span class="material-symbols-outlined">delete</span>
                                Delete
                                </a>

                            </div>
                            <!-- Event Title -->
                            <h2 class="text-lg font-black text-gray-700">{{ $event->title }}</h2>




                            <div class="w-full flex text-gray-400 gap-2 items-center ">
                                <span class="material-icons">group</span>
                                    <h1 class="ml-[-2rem]s">
                                        @if($event-> joinedUsers->count() == 0)
                                            No volunteers
                                        @else
                                            {{$event-> joinedUsers->count()}} {{$event-> joinedUsers->count() == 1 ? 'volunteer' : 'volunteers'}}
                                        @endif
                                    </h1>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
