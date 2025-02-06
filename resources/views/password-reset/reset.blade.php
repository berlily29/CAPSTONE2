<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Tailwind setup -->
    <script>
        // JavaScript to enable/disable the submit button based on password match
        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const submitButton = document.getElementById('submitButton');
            const message = document.getElementById('passwordMessage');

            // Function to check if the passwords match
            function checkPasswordMatch() {
                if (password.value && passwordConfirmation.value) {
                    if (password.value === passwordConfirmation.value) {
                        message.textContent = "Passwords match ✔️";
                        message.classList.remove('text-pink-500');
                        message.classList.add('text-green-500');
                        submitButton.disabled = false;
                    } else {
                        message.textContent = "Passwords do not match ❌";
                        message.classList.remove('text-green-500');
                        message.classList.add('text-pink-500');
                        submitButton.disabled = true;
                    }
                } else {
                    message.textContent = "";
                    submitButton.disabled = true;
                }
            }

            // Event listeners to check the password match as the user types
            password.addEventListener('input', checkPasswordMatch);
            passwordConfirmation.addEventListener('input', checkPasswordMatch);

            // Initial check when the page loads
            checkPasswordMatch();
        });
    </script>
</head>
@php

$config = \App\Models\AppConfig::find(1);
@endphp


<body class="bg-gray-50 h-screen flex items-center justify-center">
<div class="w-2/8 flex h-screen items-center justify-center bg-gray-50">
    <div class="w-full p-8 bg-white rounded-xl shadow-lg">
        <div class="w-full flex justify-center my-2">
          <img src="{{asset('images/logo/' .$config->secondary_logo )}}" class="w-[150px] h-[150px]" alt="">

        </div>
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">Reset Password</h2>
            <p class="text-sm text-gray-500">Please enter and confirm your new password.</p>
        </div>

        <form action="{{ route('reset-password.save', ['token' => $token]) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- New Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password"
                       class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-300"
                       required minlength="6" placeholder="Enter your new password">

            </div>

            <!-- Confirm New Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="mt-2 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-300"
                       required placeholder="Re-enter your new password">
                <p id="passwordMessage" class="mt-2 text-sm"></p>
            </div>

            <!-- Submit Button -->
            <button id="submitButton" type="submit"
                    class="w-full px-4 py-3 bg-pink-500 text-white rounded-lg font-medium disabled:opacity-50 disabled:cursor-not-allowed hover:bg-pink-400 transition-all duration-300"
                    disabled>
                Reset Password
            </button>
        </form>
    </div>
</div>
</body>
</html>
