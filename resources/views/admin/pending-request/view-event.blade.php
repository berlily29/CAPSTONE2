<head>

<meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        a {
            cursor: pointer;
        }
    </style>
</head>

<div class="bg-gray-50 w-full">
    <div class="w-full">
        <div class="mt-4 bg-white overflow-hidden sm:rounded-lg pb-4">
            <div class="bg-white rounded-lg">
                <div class="flex flex-wrap lg:flex-nowrap gap-4">
                    <!-- Event Details -->
                    <div class="w-full py-4 px-8">
                        <!-- Header -->
                        <div class="w-full flex justify-between pb-2">
                            <div class="flex flex-col gap-0">
                                <h1 class="text-lg text-gray-500 font-semibold">Admin Approval</h1>
                                <h1 class="text-3xl font-black text-gray-700">Event Request</h1>
                            </div>
                            <div class="w-[30%]">

                                <form class="" action="{{route('admin.pending-request.approve-event',['id'=> $event->event_id])}}" method ="POST">
                                    @csrf
                                    <button type = "button" id="approveButton"
                                        class="w-full px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition duration-200">
                                        Approve
                                    </button>
                                </form>




                                <div class="w-full">
                                    <a id="rejectButton"
                                        class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition duration-200 cursor-pointer">
                                        Terminate
                                    </a>

                                </div>

                            </div>
                        </div>
                        <hr class="w-full opacity-65 my-4">

                        <!-- Event Information -->
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

<script>
    // Approve Button Click Handler
    document.getElementById('approveButton').addEventListener('click', function () {
        Swal.fire({
            title: "Do you want to approve this event?",
            showCancelButton: true,
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('approveButton').closest('form'); // Get the form
                const actionUrl = form.getAttribute('action'); // Form action URL
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Get CSRF token

                // Send the approval request via fetch
                fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Event has been approved',
                                showConfirmButton: false,
                                timer: 1500

                            }).then(() => {
                                window.close(); // Close the current window
                                window.opener.location.reload(); // Reload the parent window
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to approve the event. Please try again.',
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again later.',
                        });
                    });
            }
        });
    });

    // Reject Button Click Handler
    document.getElementById('rejectButton').addEventListener('click', function () {

                let event_id = "{{$event->event_id}}";
                console.log(event_id);
                window.location.href = `/admin/pending-request/event/${event_id}/termination`;

    });
</script>
