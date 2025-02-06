<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Successfully</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Tailwind setup -->
</head>
@php
$config = \App\Models\AppConfig::find(1);
@endphp

<body class="bg-gray-50 h-screen flex items-center justify-center">
    <div class="w-2/8 flex h-screen items-center justify-center bg-gray-50">
        <div class="w-full p-8 bg-white rounded-xl shadow-lg">
            <!-- Logo -->
            <div class="w-full flex justify-center my-2">
                <img src="{{ asset('images/logo/' . $config->secondary_logo) }}" class="w-[150px] h-[150px]" alt="App Logo">
            </div>

            <!-- App Title -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold text-gray-800">{{ config ('app.name')}}</h1>
            </div>

            <!-- Success Message -->
            <div class="text-center mb-6">
                <!-- Checkmark Icon -->
                <div class="flex justify-center mb-4">
                    <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Password Changed Successfully!</h2>
                <p class="text-sm text-gray-500 mt-2">Your password has been updated. You can now log in with your new password.</p>
            </div>

            <!-- Redirection Link to Login -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-pink-500 hover:text-pink-400 font-medium transition-all duration-300">
                    Go to Login →
                </a>
            </div>
        </div>
    </div>
</body>
</html>
