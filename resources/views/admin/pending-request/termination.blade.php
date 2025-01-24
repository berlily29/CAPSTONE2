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

<div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Request Termination</h2>

        <!-- Form Start -->
        <form action="{{ route('admin.pending-request.reject-event', ['id' => $event->event_id]) }}" method="POST" id="terminationForm">
            @csrf
            @method('POST')

            <!-- Event Details -->
            <div class="mb-4">
                <label for="eventTitle" class="block text-sm text-gray-600">Event Title</label>
                <input type="text" id="eventTitle" name="eventTitle" value="{{ $event->title }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 text-gray-700 border border-gray-300 rounded-lg focus:ring-pink-600 focus:border-pink-600" readonly>
            </div>

            <div class="mb-4">
                <label for="eventOrganizer" class="block text-sm text-gray-600">Event Organizer</label>
                <input type="text" id="eventOrganizer" name="eventOrganizer" value="{{ $event->organizer->user->fullname }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 text-gray-700 border border-gray-300 rounded-lg focus:ring-pink-600 focus:border-pink-600" readonly>
            </div>

            <div class="mb-4">
                <label for="terminationReason" class="block text-sm text-gray-600">Reason for Termination</label>
                <textarea id="terminationReason" name="reason" rows="4" placeholder="Enter the reason for termination..." class="mt-1 block w-full px-4 py-2 bg-gray-50 text-gray-700 border border-gray-300 rounded-lg focus:ring-pink-600 focus:border-pink-600" required></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <button type="button" id="submitButton" class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition duration-200">Submit</button>
                <button type="button" id="cancelButton" class="px-6 py-3 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg transition duration-200">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Script for SweetAlert Confirmation -->
<script>
    document.getElementById('submitButton').addEventListener('click', function (e) {
        e.preventDefault();
        const form = document.getElementById('terminationForm');
        const action = form.getAttribute('action');
        const formData = new FormData(form);

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to terminate this event?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Terminate   ',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Terminated!',
                            text: "The event has been successfully terminated.",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.close(); // Close the current window
                            window.opener.location.reload(); // Reload the parent window
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to terminate the event. Please try again.',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again later.',
                        icon: 'error'
                    });
                });
            }
        });
    });

    // Handle Cancel button click
    document.getElementById('cancelButton').addEventListener('click', function () {
        history.back(); // Navigate back when Cancel is clicked
    });
</script>
