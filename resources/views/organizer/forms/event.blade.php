<x-app-layout>
    <div class="w-full bg-white rounded-lg p-8 flex flex-col">
        <h1 class="text-sm font-medium text-gray-500">Request</h1>
        <h1 class="mb-4 text-3xl font-black text-gray-700">New Event</h1>

        <form action="" method="POST" id="eventForm">
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
                    <option value="">Select a Parent Category</option>
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
            <div class="w-full grid grid-cols-[30%_70%] gap-4 mb-4">
                <div>
                    <label for="date" class="text-sm font-medium text-pink-600">Date</label>
                    <input type="date" name="date" id="date"
                        class="border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm">
                </div>

                <div>
                    <label for="venue" class="text-sm font-medium text-pink-600">Venue</label>
                    <input type="text" name="venue" id="venue"
                        class="border border-gray-200 py-4 px-4 focus:border-pink-600 focus:ring-pink-600 sm:text-sm">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-pink-600 text-white font-semibold text-sm uppercase rounded-lg shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition">
                    Submit Request
                </button>
            </div>
        </form>
    </div>

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
    </script>
</x-app-layout>
