<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Link Sent</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Add your Tailwind setup -->
</head>

@php

$config = \App\Models\AppConfig::find(1);
@endphp


<body class="bg-gray-50 h-screen flex items-center justify-center">

    <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-lg">
        <!-- Logo Section -->
        <div class="flex justify-center mb-8">
        <img src="{{asset('images/logo/' .$config->secondary_logo )}}" class="w-[150px] h-[150px]" alt="">
        </div>

        <!-- Page Title -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">Check Your Email!</h2>
            <p class="text-lg text-gray-600 mt-2">A password reset link has been sent to your email address. Please follow the instructions to reset your password.</p>
        </div>

        <!-- Confirmation Message -->
        <div class="bg-green-50 p-4 rounded-lg shadow-md mb-6">
            <div class="flex items-center text-green-600">
                <span class="material-icons mr-3 text-2xl">check_circle</span>
                <p class="text-base font-medium">An email has been sent to your email address.</p>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="text-center">
            <p class="text-base text-gray-600 mb-6">If you do not receive the email, please check your spam folder or try again.</p>
            <a href="/" class="px-6 py-3 text-white bg-pink-600 hover:bg-pink-500 rounded-3xl text-base font-semibold transition-all duration-300">Go to Login</a>
        </div>
    </div>

</body>
</html>
