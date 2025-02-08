<x-app-layout>
<div class="w-3/4 bg-white rounded-2xl p-8 shadow-lg mx-auto mt-10">
    <div class="w-full space-y-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-700">Event Organizer Application</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="applicationform" action="{{ route('application.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="flex items-center space-x-4">
                <button type="button" onclick="document.getElementById('file-input').click()"
                    class="bg-gradient-to-r from-pink-500 to-pink-400 hover:scale-[1.02] text-white font-semibold py-2 px-4 rounded-xl shadow-md transition-all duration-300">
                    Upload Your Resume
                </button>
                
                <span id="file-name" class="text-gray-700 italic text-sm">No file selected</span>
            </div>

            <input type="file" id="file-input" name="attachment" accept=".pdf" class="hidden" onchange="updateFileName(this)">
        </form>

        <!-- PDF Preview Section -->
        <div id="preview" class="hidden">
            <h2 class="text-xl font-semibold text-gray-800 mt-4">Preview:</h2>
            <iframe id="pdf-preview" class="w-full h-[80vh] border rounded-lg mt-2 shadow-md"></iframe>

            <div class="flex flex-row-reverse mt-4">
                <button id="submitapplication" type="button" 
                    class="bg-gradient-to-r from-pink-500 to-pink-400 hover:scale-[1.02] text-white font-bold py-2 px-4 rounded-xl shadow-md transition-all duration-300">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewPDF(event) {
        const file = event.target.files[0];
        const pdfPreview = document.getElementById('pdf-preview');
        const previewcontainer = document.getElementById('preview');

        if (file && file.type === 'application/pdf') {
            const fileURL = URL.createObjectURL(file);
            pdfPreview.src = fileURL;
            previewcontainer.classList.remove('hidden'); 
        } else {
            Swal.fire({
            position: "center",
            icon: "error",
            title: "Wrong File Format Use PDF.",
            showConfirmButton: false,
            timer: 2000
            });
            previewcontainer.classList.add('hidden'); 
        }
    }

    document.getElementById('submitapplication').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to submit your application.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Apply Now!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('applicationform').submit();

            }
        });
    });

    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : "No file selected";
        document.getElementById('file-name').innerText = fileName;
        previewPDF({ target: input });
    }


</script>

@if(session('msg'))
<script>
 Swal.fire({
            text: "{{session('msg')}}",
            icon: "success",
            showConfirmButton: false,
            timer:1500

        });
</script>
@endif

