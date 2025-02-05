<x-app-layout>

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
    <div class="bg-gray-50 w-full">
        <div class="w-full">
            <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg pb-4">

                <button onclick="history.back()" class="inline-flex items-center mx-8 mt-8 mb-4 px-4 py-2 bg-pink-600 text-white border border-pink-600 font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">

                <span class="material-icons">keyboard_return</span>
                Return </button>

                <div class="px-8 max-w-full pb-4 flex flex-col">
                <h1 class="text-sm text-gray-500">Event ID</h1>

                    <h1 class="text-[2rem] font-black text-gray-700 mt-[-0.5rem]">{{$event->event_id}}</h1>
                </div>

                <hr class="opacity-65">

                <!-- Main Content -->
                <div class="bg-white">
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


                        @if($event->termination_id != NULL)
                        <!-- Terminated Information -->
                        <div class="w-full lg:w-1/2 border-l px-8 border-gray-200 p-8">
                            <div class="flex flex-col gap-0">
                                <h1 class="text-sm text-gray-500">Details</h1>
                                <h1 class="text-3xl font-black text-gray-700">Termination</h1>
                            </div>


                            <div class="flex flex-col gap-0">
                                <h1 class="text-sm text-gray-500">Reason</h1>
                                <span class="px-4 py-2 text-sm font-medium bg-red-200 text-red-600 rounded-lg">
                                {{$event->termination->reason}}
                            </span>
                            </div>

                            <div class="flex w-full py-2 gap-2">
                                <form action="{{route('eo.pending-requests.hard-delete',['id'=> $event->event_id])}}" method ="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" id="deleteRequest" class="inline-flex items-center px-4 py-2 bg-red-600 text-white border font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
    <span class="material-icons">delete</span>
    DELETE request
</button>

                                </form>


                            </div>

                        </div>
                        @endif
                    </div>



                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('deleteRequest').addEventListener('click', function () {
    Swal.fire({
        title: "Delete this request?",
        text: "Are you sure you want to permanently delete this event?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#e74c3c",
        cancelButtonColor: "#6c757d"
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteRequest').closest('form'); // Get the form
            const actionUrl = form.getAttribute('action'); // Form action URL
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token

            // Send the DELETE request via fetch
            fetch(actionUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Event has been removed",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                           window.location.href = "/portal/pending-requests"; // Navigate back after deletion
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to delete the event. Please try again.",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An unexpected error occurred. Please try again later.",
                    });
                });
        }
    });
});


</script>


</script>
</x-app-layout>

