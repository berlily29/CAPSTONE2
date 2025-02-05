<x-app-layout>
    <div class="min-h-screen bg-white p-8">
        <div class="">
            <!-- Header -->
            <div class="mb-8 flex items-center gap-4">
                <h1 class="text-3xl font-bold text-gray-700">Organization Settings</h1>
                <span class="material-icons text-3xl text-pink-600">settings</span>
            </div>

            <!-- Configuration Form -->
            <form id="configForm" method="POST" action="{{route('admin.config.update')}}" enctype="multipart/form-data" class="bg-white rounded-xl space-y-8">
                @csrf
                @method('PUT')

                <!-- Organization Name -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Organization Name</label>
                    <input type="text" name="name" value="{{$config->name }}"
                           class="px-4 py-2 mt-1 block w-full rounded-lg border border-gray-400  focus:border-pink-500 focus:ring-pink-500"
                           required>
                </div>

                <!-- Primary Logo Section -->
                <div class="space-y-6 border-t border-pink-200 pt-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-icons text-pink-600">image</span>
                        <h3 class="text-lg font-semibold">Primary Logo (With Text)</h3>
                    </div>

                    <div class="flex items-start gap-6">
                        @if($config->primary_logo)
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/logo/'.$config->primary_logo) }}"
                                 class="h-24 w-24 rounded-lg border-2 border-pink-300 p-1" id="primary_logo_preview">
                        </div>
                        @endif

                        <div class="flex-1">
                            <input type="file" name="primary" id="primary_logo_input"
                                   class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 disabled:opacity-50">
                            <p class="mt-2 text-sm text-gray-500">Recommended size: 300x100px (transparent PNG)</p>
                        </div>
                    </div>
                </div>

                <!-- Secondary Logo Section -->
                <div class="space-y-6 border-t border-pink-200 pt-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-icons text-pink-600">image_search</span>
                        <h3 class="text-lg font-semibold">Secondary Logo (Textless)</h3>
                    </div>

                    <div class="flex items-start gap-6">
                        @if($config->secondary_logo)
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/logo/'.$config->secondary_logo) }}"
                                 class="h-24 w-24 rounded-lg border-2 border-pink-300 p-1" id="secondary_logo_preview">
                        </div>
                        @endif

                        <div class="flex-1">
                            <input type="file" name="secondary" id="secondary_logo_input"
                                   class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 disabled:opacity-50">
                            <div class="mt-2 p-3 bg-pink-100 rounded-lg flex items-start gap-2">
                                <span class="material-icons text-pink-600 text-sm">info</span>
                                <p class="text-sm text-pink-700">
                                    Reminder: If you don't have a secondary logo, please upload the same logo as your primary logo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="border-t border-pink-200 pt-6 flex justify-end">
                    <button id="saveBtn" type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-pink-500 to-pink-700 hover:from-pink-600 hover:to-pink-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to preview selected image before upload
        function previewImage(input, previewElementId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(previewElementId).src = e.target.result;
                    document.getElementById(previewElementId).classList.remove('hidden'); // Show image
                };
                reader.readAsDataURL(file);
            }
        }

        // Listen for file selection and update the preview
        document.getElementById("primary_logo_input").addEventListener("change", function () {
            previewImage(this, "primary_logo_preview");
        });

        document.getElementById("secondary_logo_input").addEventListener("change", function () {
            previewImage(this, "secondary_logo_preview");
        });

        document.getElementById("configForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            let formData = new FormData(this);
            let saveBtn = document.getElementById("saveBtn");
            saveBtn.disabled = true; // Disable button to prevent multiple submissions

            axios.post(this.action, formData, {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => {
                if (response.data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Configuration saved",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        if (response.data.primary_logo) {
                            document.getElementById("primary_logo_preview").src = response.data.primary_logo;
                        }
                        if (response.data.secondary_logo) {
                            document.getElementById("secondary_logo_preview").src = response.data.secondary_logo;
                        }

                        location.reload()
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Update Failed",
                        text: "Please check your input and try again.",
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "An error occurred",
                    text: "Something went wrong. Please try again."
                });
            })
            .finally(() => {
                saveBtn.disabled = false; // Re-enable button after request
            });
        });
    </script>
</x-app-layout>
