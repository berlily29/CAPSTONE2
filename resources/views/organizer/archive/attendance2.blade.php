<!-- Include SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 p-6 bg-gray-50 shadow-md rounded-lg">
        <!-- Tab Navigation -->
        <div class="flex flex-col">

            <button id="attendeesTab" class="px-4 py-2 text-sm font-semibold text-gray-700  bg-pink-100 hover:bg-pink-100 focus:outline-none focus:bg-pink-100 focus:ring focus:ring-pink-200 transition-all duration-300 rounded-lg">
                List of Attendees
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 bg-white shadow-md rounded-lg ml-6">



        <div id="listOfAttendees" class="">
            <!-- List of Attendees Table -->
            <h2 class="text-lg font-semibold text-gray-700 mb-4">List of Attendees</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 py-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Token</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($attendees as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center text-sm text-gray-700 font-medium">
                                {{$item->user->fullname}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{$item->token}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-sm font-medium rounded-lg bg-green-100 text-green-600">Encoded</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tailwind JS for switching tabs -->
<script>


    // Add an event listener to the encode form to handle the ajax response
    document.getElementById('encodeForm').addEventListener('submit', function (event) {
        event.preventDefault();  // Prevent the default form submission

        const token = document.querySelector('input[name="token"]').value;

        fetch('{{ route("eo.channel.token.encode", ["id" => $event->event_id]) }}', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'noexist') {
                Swal.fire({
                    icon: 'error',
                    title: 'Token Not Found',
                    text: 'The attendance token does not exist.',
                    timer: 1500
                });
            } else if (data.status === 'existing') {
                Swal.fire({
                    icon: 'info',
                    title: 'Already Encoded',
                    text: 'This attendance has already been encoded.',
                    timer: 1500
                });
            } else if (data.status === 'encoded') {
                Swal.fire({
                    icon: 'success',
                    title: 'Attendance Recorded',
                    text: `The attendance for ${data.user} was recorded successfully.`,
                    showConfirmButton: true,
                    confirmButtonText: "CLOSE"

                }).then(()=> {
                    location.reload()
                })
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong, please try again.',
            });
        });
    });
</script>
