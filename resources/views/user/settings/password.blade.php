<div class='flex flex-col'>
    <div class='w-full'>
        <h2 class="w-full text-2xl font-bold text-gray-700 mb-4">Change Password</h2>

            @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                <div class="bg-red-500 text-white p-4 m-2 rounded mb-4">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>

                </div>
            @endif
    </div>
    <form id='passwordForm' action="{{ route('user.settings.changePassword') }}" method="POST" class='flex flex-col'>
            @csrf
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-400">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-pink-500 p-2" required>
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-400">New Password</label>
                <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-pink-500 p-2" required>
            </div>
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-400">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-pink-500 p-2" required>
            </div>
            <div class='w-full flex flex-row-reverse'>
            <button id='changePasswordButton' type="button" class="flex items-center justify-center sm:w-full lg:w-1/3 md:w-full bg-gradient-to-r from-pink-500 to-pink-400 hover:scale-[1.02] text-white font-semibold py-2 rounded-md transition duration-200">
                <span class="material-icons mx-2">lock_reset</span>Change Password
            </button>
            </div>
    </form>
</div>

<script>
  document.getElementById('changePasswordButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to change your password.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('passwordForm').submit();

            }
        });
    });
</script>
