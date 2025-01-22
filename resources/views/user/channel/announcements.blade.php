
<div class="p-4">


    <!-- Announcement Posts -->
    <div class="space-y-6">
        @foreach($announcements as $announcement)
            <div class="bg-white border border-gray-300 p-6 relative">
                <!-- Author and Date -->
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">

                        <div>

                            <img src="{{$announcement->channel->event->organizer->user->profile_picture ? asset('storage/uploads/profilepic/' . $announcement->channel->event->organizer->user->profile_picture) : asset('images/default-dp.jpg') }}" alt="" class="w-[40px] h-[40px] rounded-full">

                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm text-gray-500"><span class="font-semibold text-gray-800">{{ $announcement->channel->event->organizer->user->fullname }}</span></p>
                            <p class="text-sm text-gray-500">Date: {{ $announcement->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>

                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $announcement->title }}</h3>
                <p class="text-gray-700 leading-relaxed">{{ $announcement->content }}</p>
                <hr class="opacity-65 my-4">

                <div class="w-full flex gap-4">
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="text-sm text-sky-600 border border-sky-600 px-3 py-1 rounded-md hover:bg-sky-600 hover:text-white flex items-center justify-center gap-2" alt = "Like Post">
                            <span class="material-icons">favorite</span>
                            Like this Post
                        </button>
                    </form>


                    <div class="flex gap-2 items-center">
                        <span class="material-icons text-gray-400">visibility</span>
                        <span class="text-sm text-gray-400">Liked by {{ $announcement->total_readers }} others</span>
                    </div>
                </div>
            </div>
        @endforeach

        @if ($announcements->isEmpty())
            <div class="text-center py-8 text-lg font-semibold text-gray-500">
                No announcements yet. Stay tuned!
            </div>
        @endif
    </div>
</div>
