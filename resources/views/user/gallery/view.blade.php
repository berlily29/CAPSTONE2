<x-app-layout>


    <div class="min-h-screen bg-white p-8 rounded-lg">
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-bold text-gray-700">App Gallery</h2>
            </div>

            @if($live->isEmpty())
                <h1 class="text-sm text-gray-400 italic">No Stories Available</h1>
            @else
                <!-- All Stories Gallery -->
                <div class="flex flex-col gap-0">
                    <h1 class="text-[0.8rem] text-gray-400">All Stories in the App Gallery</h1>
                    <h3 class="text-[2rem] font-black text-gray-600">ALL STORIES</h3>
                </div>

                <!-- Grid Gallery of All Stories -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-3">
                    @php
                        $galleryChannels = \App\Models\Gallery::all();
                        $liveChannelIds = $galleryChannels->pluck('channel_id')->toArray();
                        $stories = \App\Models\Stories::whereIn('channel_id', $liveChannelIds)->get();
                    @endphp

                    @foreach($stories as $storyItem)
                        <div class="bg-white p-4 rounded-lg border border-gray-200 hover:scale-105 transition duration-300 ease-in-out">
                            <!-- Story Image -->


                            <div class="relative w-full h-48 bg-gray-200 mb-4 rounded-lg overflow-hidden">
                                @php
                                $path = $storyItem->user->profile_picture ? asset('storage/uploads/profilepic/' . $storyItem->user->profile_picture) : asset('images/default-dp.jpg')
                                @endphp
                                <img src="{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}"
                                     class="w-full h-full object-cover"
                                     onclick="openStoryPopup(
                                     '{{ $storyItem->user->fullname }}',
                                     '{{ $storyItem->caption }}',
                                     '{{ $storyItem->channel->event->title }}',
                                     '{{ asset('storage/uploads/story/' . $storyItem->channel_id . '/' . $storyItem->image) }}',
                                     '{{$path}}',
                                     '{{$storyItem-> created_at}}'
                                     )">
                            </div>

                            <!-- Story Details -->
                            <div class="flex flex-col gap-0">
                                <h4 class="text-lg font-bold text-pink-600">{{ $storyItem->user->fullname }}</h4>
                                <p class="text-sm text-gray-500">{{ $storyItem->caption }}</p>
                                <p class="text-xs text-gray-400">Event: {{ $storyItem->channel->event->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>




<!-- Story Details Popup -->
<div id="storyPopup" class="fixed inset-1 flex justify-center items-center hidden z-[9999] bg-black bg-opacity-50">
    <div class="bg-white flex rounded-lg w-[800px] relative">
        <!-- Close Button (Gray X) -->
        <button onclick="closeStoryPopup()" class="absolute -top-4 -right-4 bg-gray-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-600">
            <span class="text-xl">×</span>
        </button>

        <!-- Image on the Left -->
        <div class="w-1/2 bg-gray-200">
            <img id="storyImage" src="" class="w-full h-full">
        </div>

        <!-- Captions and Info on the Right -->
        <div class="w-1/2 p-6">
            <!-- User Profile Section -->
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                    <img id="userProfileImage" src="" alt="User Profile" class="w-full h-full object-cover">
                </div>
                <div>
                    <p id="userName" class="font-semibold text-sm">User Name</p>
                    <p class="text-xs text-gray-500"><span id="postTime">2h ago</span></p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 text-[0.3rem]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 2.25V6M16 2.25V6M3.75 9h16.5M4.5 4.5h15a1.5 1.5 0 011.5 1.5v13.5a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 19.5V6a1.5 1.5 0 011.5-1.5z" />
                </svg>
                <p class="text-[0.8rem] text-gray-400" id="storyEvent">
                    Event
                </p>
            </div>

            <hr class="my-4">
            <!-- Story Caption and Event -->
             <div class="flex items-center ">

                 <p class="text-xl text-gray-500" id="storyCaption">Story Caption</p>

             </div>

            <!-- Story Title -->
        </div>
    </div>
</div>

    <script>


        function openStoryPopup(userName, caption, eventTitle, imageUrl, userProfile, created_at) {
            document.getElementById('userName').innerText = userName;
            document.getElementById('storyCaption').innerText = caption;
            document.getElementById('storyEvent').innerText = eventTitle;


            let created = created_at.split(' ');
            document.getElementById('postTime').innerText = created[0]  + ' | ' + created[1];


            document.getElementById('storyImage').src = imageUrl;
            document.getElementById('userProfileImage').src = userProfile;
            console.log(imageUrl)
            document.getElementById('storyPopup').classList.remove('hidden');
        }

        function closeStoryPopup() {
            document.getElementById('storyPopup').classList.add('hidden');
        }
    </script>
</x-app-layout>
