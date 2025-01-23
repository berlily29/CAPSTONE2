
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
                    Date Created
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center text-sm text-gray-700 font-medium">
                        <img src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('images/default-dp.jpg') }}"
                             alt="Profile Picture"
                             class="w-8 h-8 rounded-full mr-3">
                        {{ $user->fname }} {{ $user->mname }} {{ $user->lname }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->login->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('l, F j, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-sm font-medium rounded-lg {{ $user->account_status == 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600' }}">
                            {{ $user->account_status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                        <button class="openModal px-4 py-2 text-white bg-pink-500 hover:bg-pink-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
                                data-user-id="{{ $user->user_id }}"
                                data-user-email="{{ $user->login->email }}"
                                data-user-name="{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}"
                                data-user-mobile="{{ $user->mobile_no }}"
                                data-user-age="{{ $user->age }}"
                                data-user-gender="{{ $user->gender }}"
                                data-user-house-no="{{ $user->house_no }}"
                                data-user-street="{{ $user->street }}"
                                data-user-brgy="{{ $user->brgy }}"
                                data-user-city="{{ $user->city }}"
                                data-user-province="{{ $user->province }}"
                                data-user-postal-code="{{ $user->postal_code }}"
                                data-user-ID-Type="{{ $user->id->id_type }}"
                                data-user-ID-Attachment="{{ $user->id->attachment }}">
                            <span class="material-icons">rate_review</span>
                        </button>
                    </td>
                </tr>
            @endforeach

            <!-- If No Users -->
            @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No active requests found.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
