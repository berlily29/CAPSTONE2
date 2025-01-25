

    <!-- Table -->
    <div class="overflow-x-auto border border-gray-200 bg-white">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Location
                </th>



            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center text-sm text-gray-700 font-medium">
                        {{ $user->fname }} {{ $user->mname }} {{ $user->lname }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->login->email }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-sm font-medium rounded-lg {{ $user->account_status == 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600' }}">
                        {{ $user->brgy }}, {{ $user->city }}, {{$user->province}}
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                    <button
                        class="flex items-center justify-center gap-4 text-white p-2 rounded-md bg-gray-500 hover:bg-gray-600"
                        onclick="openPopup('{{ route('eo.channels.view-user', ['id' => $user->user_id]) }}')"
                    >
                        <span class="material-icons">info</span>
                        View Information
                    </button>
                    </td>


                </tr>
            @endforeach

            <!-- If No Users -->
            @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No data available
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>


<script>
     function openPopup(url) {
        window.open(
            url,
            '_blank',
            'width=900,height=500,scrollbars=yes,resizable=yes'
        );
    }

</script>
