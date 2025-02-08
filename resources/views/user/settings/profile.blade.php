<div class="w-full space-y-6 p-4 bg-white rounded-2xl ">
    <h2 class="text-2xl font-bold text-gray-700 mb-2">Profile</h2>

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Image Preview -->
        <div class="relative">
            <img id="editImage"
                 src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('images/default-dp.jpg') }}"
                 alt="Profile Picture"
                 class="w-56 h-56 rounded-2xl object-cover border-4 border-white shadow-lg hover:border-purple-100 transition-background-color duration-200">
        </div>

        <!-- Action Section -->
        <div class="flex-1 space-y-6 w-full">
            <!-- Upload Section -->
            <div class="space-y-4">
                <form id="changeProfilePicForm" enctype="multipart/form-data"
                      action="{{ route('user.settings.storeProfilePic') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-col sm:flex-row gap-4">
                        <label class="flex-1 cursor-pointer transition-transform hover:scale-[1.02]">
                            <div class="flex items-center justify-center p-4 bg-gradient-to-r from-pink-500 to-pink-400 text-white rounded-xl shadow-sm hover:shadow-md transition-all">
                                <span class="material-icons text-xl mx-2">cloud_upload</span>
                                <span class="font-medium">Upload New Photo</span>
                            </div>
                            <input type="file" id="changeProfileButton" name="changeProfileButton"
                                   class="hidden" accept="image/*">
                        </label>

                        <button type="submit" id="saveButton"
                                class="items-center p-2 justify-center hover:scale-[1.02] hover:bg-pink-600 bg-gradient-to-r from-pink-500 to-pink-400  text-white rounded-xl shadow-sm hover:shadow-md transition-all md:w-1/5 ">
                            <span class="material-icons text-3xl">save</span>

                        </button>
                    </div>
                </form>

                <!-- Delete Section -->
                <div class="pt-4 border-t border-gray-100">
                    <button type="button" id="deleteProfileButton"
                            class="flex items-center gap-3 text-red-500 hover:text-blue-400 w-full justify-center transition-all group  hover:scale-[1.02]">
                        <span class="material-icons text-xl">delete</span>
                        <span class="font-medium">Remove Current Photo</span>
                    </button>
                </div>
            </div>

            <!-- Email Display -->
            <div class="mt-8 p-5 bg-gray-100 rounded-xl backdrop-blur-sm ">
                <h3 class="text-sm font-semibold text-pink-600 mb-1">Registered Email</h3>
                <p class="text-lg font-medium text-gray-800">{{ $user->login->email }}</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image Upload Handler
    const input = document.getElementById('changeProfileButton');
    const saveBtn = document.getElementById('saveButton');
    const preview = document.getElementById('editImage');

    input.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                saveBtn.classList.remove('hidden');
                saveBtn.classList.add('flex');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Delete Profile Picture Handler
    const deleteButton = document.getElementById('deleteProfileButton');

    if(deleteButton) {
        deleteButton.addEventListener('click', function(e) {
            Swal.fire({
                title: 'Remove Profile Picture?',
                text: "This will permanently remove your current profile photo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ec4899',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg',
                    cancelButton: 'px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('user.settings.deleteProfilePic') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({_method: 'PATCH'})
                    }).then(response => {
                        if(response.ok) {
                            preview.src = "{{ asset('images/default-dp.jpg') }}";
                            Swal.fire({
                                title: 'Removed!',
                                text: 'Your profile picture has been removed.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000,
                                customClass: {
                                    popup: 'rounded-2xl'
                                }
                            });
                        }
                    });
                }
            });
        });
    }
});
</script>
