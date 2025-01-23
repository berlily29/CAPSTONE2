<head>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins';
    }
</style>

</head>
<div class="bg-gray-50 w-full">
    <div class="w-full">
        <div class="mt-4 bg-white overflow-hidden sm:rounded-lg pb-4">



            <!-- Main Content -->
            <div class="bg-white rounded-lg">
                <!-- Event Details and Contact Information Container -->
                <div class="flex flex-wrap lg:flex-nowrap gap-4">



                    <!-- Event Details -->
                    <div class="w-full lg:w-1/2 py-4 px-8">

                               <!-- header -->
                    <div class="flex justify-between">
                        <div class="flex flex-col gap-0">
                            <h1 class="text-lg text-gray-500 font-semibold">Admin Approval</h1>
                            <h1 class="text-3xl font-black text-gray-700">Event Request</h1>
                        </div>

                        <div class="flex gap-2">
                            <form action="">
                            <button class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg  focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 transition duration-200">
                                Approve
                            </button>

                            </form>

                            <form action="">
                            <button class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg  focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-50 transition duration-200">
                                Reject
                            </button>

                            </form>

                        </div>
                    </div>

                    <hr class="w-full opacity-65 my-4">


                        <div class="flex flex-col gap-4">
                            <div>
                                <span class="text-sm text-gray-400">Event Title</span>
                                <h2 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h2>
                            </div>

                            <div>
                                <span class="text-gray-400">Date</span>
                                <h2 class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</h2>
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
                                    @foreach($event->event_category as $category_id)
                                        @php
                                            $category = \App\Models\EventCategories::find($category_id)
                                        @endphp

                                        @if ($category)
                                            <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="w-full opacity-65 px-8">

                    <!-- Contact Information -->
                    <div class="w-full lg:w-1/2 border-l px-8 border-gray-200 pb-8">
                        <h1 class="text-sm font-medium text-gray-500">Event Organizer</h1>
                        <h3 class="text-[2rem] font-black text-gray-700">Contact Information</h3>
                        <div class="flex flex-col gap-4">
                            @if($event->organizer->user->profile_picture !== null)
                                <img src="{{ $event->organizer->user->profile_picture ? asset('storage/uploads/profilepic/' . $event->organizer->user->profile_picture) : asset('images/default-dp.jpg') }}" alt="" class="w-32 h-32">
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
