<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Add your Tailwind setup -->
</head>

@php
$config = \App\Models\AppConfig::find(1);
@endphp

<body class="bg-gray-50 h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <!-- Logo Section -->
        <div class="flex justify-center">
            <img src="{{ asset('images/logo/' . $config->primary_logo) }}" alt="Logo" class="w-[350px] h-auto">
        </div>

        <hr class="w-full opacity-60 my-4">

        <form method="POST" action="{{ route('reset-password.send') }}" onsubmit="showLoader()">
            @csrf

            <!-- Email -->
            <div class="mb-2">
                <label for="email" class="block text-base font-medium text-gray-600 mb-2">Enter your Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-400 @error('email') border-red-500 @enderror">

                @error('email')
                    <div class="text-red-500 text-sm mt-2">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <!-- Display Message -->
            @if(isset($message) && $message != '')
                <div class="text-center text-sm text-gray-600 mb-4">
                    <small>{{ $message }}</small>
                </div>
            @endif

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full mt-4 p-3 text-base text-white rounded-3xl bg-pink-600 hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-300 transition-all duration-300">
                SEND RESET LINK
            </button>
        </form>
    </div>

    <!-- Popup Loader -->
    <div id="popup-loader" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
            <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-pink-500"></div>
            <p class="mt-4 text-gray-700">Processing, please wait...</p>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById("popup-loader").classList.remove("hidden");
        }
    </script>
</body>
</html>
