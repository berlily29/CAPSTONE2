
    <div class="w-full bg-white flex flex-col">
        <!-- Header Section -->


        <!-- Events Table -->
        <div class="overflow-x-auto border border-gray-200 ">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Event Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Organizer
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categories
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($events as $event)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                {{ $event->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                {{ $event->organizer->user->fullname}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($event->date)->format('m-d-Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($event->event_category as $categoryId)
                                        @php
                                            $category = \App\Models\EventCategories::find($categoryId);
                                        @endphp
                                        @if ($category)
                                            <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <div class="flex gap-2 justify-end">
                                    <button onclick="openEventPopup('{{ route('admin.pending-request.view-event', $event->event_id) }}')"
                                        class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                                        VIEW
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <!-- If No Events -->
                    @if ($events->isEmpty())
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No pending events for approval.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <script>
    function openEventPopup(url) {
        const width = 800;  // Set the width of the popup window
        const height = 600; // Set the height of the popup window
        const left = (window.innerWidth - width) / 2; // Center the window horizontally
        const top = (window.innerHeight - height) / 2; // Center the window vertically

        // Open a new window with specified dimensions and URL
        window.open(url, '_blank', `width=${width},height=${height},left=${left},top=${top}`);
    }
</script>

