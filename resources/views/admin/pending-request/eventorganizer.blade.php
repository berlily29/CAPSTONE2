
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
            @foreach($applications as $applicant)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center text-sm text-gray-700 font-medium">
                        <img src="{{ $applicant->user->profile_picture ? asset('storage/uploads/profilepic/' . $applicant->user->profile_picture) : asset('images/default-dp.jpg') }}"
                             alt="Profile Picture"
                             class="w-8 h-8 rounded-full mr-3">
                        {{ $applicant->user->fname }} {{ $applicant->user->mname }} {{ $applicant->user->lname }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $applicant->user->login->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $applicant->created_at->format('l, F j, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-sm font-medium rounded-lg {{ $applicant->status == 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600' }}">
                            {{ $applicant->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <button class="openModal2 px-4 py-2 text-white bg-pink-500 hover:bg-pink-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
                    data-user-id2="{{ $applicant->user_id }}"
                    data-user-attachment2="{{ $applicant->attachment }}">

                    <span class="material-icons">attachment</span>
                    </button>
                    </td>
                </tr>
            @endforeach

            <!-- If No Users -->
            @if($applications->isEmpty())
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No active requests found.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

    <!-- Modal Structure -->
    <div id="myModal2" class="modal hidden fixed inset-0 bg-gray-700 bg-opacity-25 flex items-center justify-center">
        <div class="modal-content2 p-5 bg-white shadow-2xl rounded-2xl w-full max-w-3xl h-auto max-h-[90vh] overflow-y-auto relative">
            <span class="absolute right-6 text-white close-modal2 cursor-pointer material-icons bg-red-500 w-10 p-2 hover:bg-red-600 rounded-xl mt-2">close</span>
            <div id="modal-body2">
                <!-- User details will be populated here -->
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
      document.addEventListener('DOMContentLoaded', function () {

const modal2 = document.getElementById('myModal2');
const closeModalSpan2 = document.querySelector('.close-modal2');

// Open modal when button is clicked
document.querySelectorAll('.openModal2').forEach(button => {
    button.addEventListener('click', function () {
        const userId2 = this.getAttribute('data-user-id2');
        const userIDAttachment2 = this.getAttribute('data-user-attachment2');


        // Populate modal with user details
        document.getElementById('modal-body2').innerHTML = `
    
    <div class='mt-10'>
        <div class="mt-6 w-full p-4">

            <div class="gap-4 mb-4">
                <div class="border border-gray-300 rounded-md p-4">
                    <h2 class="font-semibold mb-2 text-[0.8rem] text-gray-400">Attachment:</h2>
                    <div class="flex w-full items-center justify-center">
                        <embed src="{{ asset('storage/uploads/application/' . '${userIDAttachment2}') }}" type="application/pdf" width="600" height="400">
                    </div>
                </div>
            </div>
        </div>

        <form action="/admin/pending-request/updateApplication/${userId2}" method='POST' class='approvalForm2 flex flex-row-reverse' >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="approveButton2" id="approveButtonInput2">
            <button type='button' value='Approved' class='mx-2 bg-pink-500 w-28 hover:bg-pink-600 p-4 text-white rounded-2xl'>Approve</button>
            <button type='button' value='To-Review' class='mx-2 bg-red-500 w-28 hover:bg-red-600 p-4 text-white rounded-2xl'>Reject</button>

            </form>
    </div>
        `;
        modal2.classList.remove('hidden');

        document.querySelectorAll('.approvalForm2>Button').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.preventDefault();

                const form = button.closest('.approvalForm2'); 
                const action = button.value; 
                document.getElementById('approveButtonInput2').value = action;

                Swal.fire({
                    title: `Are you sure you want to mark the user as '${action}'?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });

    });
});

closeModalSpan2.addEventListener('click', function () {
    modal2.classList.add('hidden');
    
});

window.addEventListener('click', function (event) {
    if (event.target === modal2) {
        modal2.classList.add('hidden');
    }
});

});
</script>