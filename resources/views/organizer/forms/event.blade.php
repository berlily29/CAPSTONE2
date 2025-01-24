
<head><meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<x-app-layout>
    <div class="w-full bg-white rounded-lg p-8 flex flex-col">
        <h1 class="text-sm font-medium text-gray-500">Request</h1>
        <h1 class="mb-4 text-3xl font-black text-gray-700">New Event</h1>

        <form action="{{route('eo.request-event.store')}}" method="POST" id="eventForm" class="w-full flex flex-col">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-pink-600">Event Title</label>
                <input type="text" name="title" id="title"

                    class="mt-1 block w-full border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm"
                    required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-pink-600">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm"></textarea>
            </div>

            <!-- Parent Category -->
            <div class="mb-4">
                <label for="parent_category" class="block text-sm font-medium text-pink-600">Event Category</label>
                <select name="parent_category" id="parent_category"
                    class="mt-1 block w-full border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm">
                    <option value="">Select a Category</option>
                    @foreach ($categories as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Child Categories -->
            <div id="childCategories" class="mb-4 hidden">
                <label class="block text-sm font-medium text-pink-600">Subcategories</label>
                <div class="grid grid-cols-2 gap-4 border border-gray-200 p-4 rounded-md">
                    @foreach ($categories as $parent)
                        <div class="child-group hidden" data-parent-id="{{ $parent->id }}">
                            @foreach ($parent->subcategories as $child)
                                <label class="flex items-center">
                                    <input type="checkbox" name="child_categories[]" value="{{ $child->id }}" class="mr-2">
                                    {{ $child->name }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Date and Venue -->
            <div class="w-full grid grid-cols-[30%_70%] mb-4">
                <div class="flex flex-col pr-4 gap-2">
                    <label for="date" class="text-sm font-medium text-pink-600">Date</label>
                    <input type="date" name="date" id="date"
                        class="border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="venue" class="text-sm font-medium text-pink-600">Venue</label>
                    <input type="text" name="venue" id="venue"
                        class="border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm">
                </div>
            </div>

            <!-- target location  -->
            <div class="mt-2">
                    <label for="city" class="block text-sm font-semibold text-pink-600">Target Location</label>
                    <select id="city" name="target_location" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                        <option value="" disabled selected>Select a City</option>
                        <!-- Cities here -->
                        <option value="Angeles">Angeles</option>
                        <option value="Apalit">Apalit</option>
                        <option value="Arayat">Arayat</option>
                        <option value="Candaba">Candaba</option>
                        <option value="Floridablanca">Floridablanca</option>
                        <option value="Guagua">Guagua</option>
                        <option value="Lubao">Lubao</option>
                        <option value="Mabalacat">Mabalacat</option>
                        <option value="Macabebe">Macabebe</option>
                        <option value="Magalang">Magalang</option>
                        <option value="Masantol">Masantol</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Minalin">Minalin</option>
                        <option value="Porac">Porac</option>
                        <option value="San Fernando">San Fernando</option>
                        <option value="San Luis">San Luis</option>
                        <option value="San Simon">San Simon</option>
                        <option value="Santo Tomas">Santo Tomas</option>
                        <option value="Santa Ana">Santa Ana</option>
                        <option value="Santa Rita">Santa Rita</option>
                        <option value="Sasmuan">Sasmuan</option>
                    </select>
                </div>

            <!-- Submit Button -->
            <div class="flex justify-end my-4">
                <button type="submit"
                    class="px-6 py-2 bg-pink-600 text-white font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                    Submit Request
                </button>
            </div>
        </form>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        const parentDropdown = document.getElementById('parent_category');
        const childCategoriesDiv = document.getElementById('childCategories');
        const childGroups = document.querySelectorAll('.child-group');

        parentDropdown.addEventListener('change', function () {
            const selectedParentId = this.value;

            // Hide all child groups initially
            childGroups.forEach(group => {
                group.classList.add('hidden');
            });

            // Show the child group matching the selected parent
            if (selectedParentId) {
                childCategoriesDiv.classList.remove('hidden');
                document.querySelector(`[data-parent-id="${selectedParentId}"]`).classList.remove('hidden');
            } else {
                childCategoriesDiv.classList.add('hidden');
            }
        });


        const eventForm = document.getElementById('eventForm');

eventForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Serialize form data
    const formData = new FormData(this);

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            throw new Error('CSRF token not found. Ensure it is included in the HTML head.');
        }

        // Send POST request
        const response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        });

        const result = await response.json();

        if (result.response === 'success') {
            // Show success alert using Swal
            Swal.fire({
                title: 'Success!',
                text: result.message,
                icon: 'success',

            }).then(() => {
                    // Optionally reload the page or redirect
                    window.location.href = "/portal/pending-requests";

                });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while submitting your request.',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }
    } catch (error) {
        console.error('Error:', error.message);
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. ' + error.message,
            icon: 'error',
            confirmButtonText: 'OK',
        });
    }
});




    </script>
</x-app-layout>
