

    <!-- Table -->
    <div class="overflow-x-auto border border-gray-200 bg-white">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 ">
            <tr class="grid grid-cols-3">
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
        <tbody class="bg-white divide-gray-200">
            @foreach($users as $user)
                <tr class="hover:bg-gray-50 grid grid-cols-3">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center  text-sm text-gray-700 font-medium">{{ $user->fullname}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm  flex items-center text-gray-500">
                        {{ $user->login->email }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap flex items-center">
                        <span class="px-2 py-1 text-sm font-medium rounded-lg {{ $user->account_status == 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600' }}">
                        {{ $user->city }}, {{$user->province}}
                        </span>
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
