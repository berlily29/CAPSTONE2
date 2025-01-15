<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-md p-6 w-full max-w-2xl">
        <h1 class="text-2xl font-semibold text-pink-600 mb-4">You're Almost There!</h1>
        <p class="text-base text-gray-700 mb-4">This is the last step to complete your account. Please upload a valid identification document.</p>



        <form id="uploadForm" class="space-y-4" action="{{route('auth.id.store')}}" method ="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div>
                <label for="idType" class="block text-base font-medium text-gray-700">Select ID Type</label>
                <select
                    name="type"
                    id="idType"
                    class="block w-full text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 px-3 py-2"
                >
                    <option value="">-- Select ID Type --</option>
                    <option value="passport">Philippine Passport</option>
                    <option value="umid">Unified Multi-Purpose ID (UMID)</option>
                    <option value="drivers_license">Driver’s License</option>
                    <option value="phil_id">Philippine National ID (PhilSys ID)</option>
                    <option value="prc_id">Professional Regulation Commission (PRC) ID</option>
                    <option value="postal_id">Postal ID</option>
                    <option value="voters_id">Voter’s ID / Certification</option>
                    <option value="sss_id">Social Security System (SSS) ID</option>
                    <option value="gsis_id">Government Service Insurance System (GSIS) eCard</option>
                    <option value="acr_card">Alien Certificate of Registration (ACR I-Card)</option>
                    <option value="company_id">Company ID</option>
                    <option value="school_id">School ID</option>
                    <option value="barangay_clearance">Barangay Clearance with photo</option>
                    <option value="police_clearance">Police Clearance</option>
                    <option value="nbi_clearance">NBI Clearance</option>
                    <option value="philhealth_id">PhilHealth ID</option>
                    <option value="pagibig_id">Pag-IBIG Loyalty Card</option>
                    <option value="senior_citizen_id">Senior Citizen ID</option>
                    <option value="pwd_id">Person with Disability (PWD) ID</option>
                    <option value="tin_id">Taxpayer Identification Number (TIN) ID</option>
                    <option value="seafarers_id">Seafarer’s Identification and Record Book (SIRB)</option>
                    <option value="ofw_id">OFW ID</option>
                    <option value="indigenous_id">Indigenous People’s ID</option>
                    <option value="solo_parent_id">Solo Parent ID</option>
                </select>
            </div>

            <div>
                <label for="idUpload" class="block text-base font-medium text-gray-700">Upload ID</label>
                <input
                    type="file"
                    id="idUpload"
                    accept="image/*"
                    name ="file"
                    class="block w-full text-base text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 px-3 py-2"
                    onchange="previewImage(event)"
                />
            </div>

            <div id="imagePreview" class="hidden">
                <p class="text-base text-gray-600 mb-2">Preview:</p>
                <img id="preview" class="w-full h-auto rounded-md border border-gray-300">
            </div>

            <button
                type="submit"
                class="w-full bg-pink-600 text-white font-semibold text-base py-2 px-4 rounded-md hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2"
            >
                Submit
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('imagePreview');
            const previewImage = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
