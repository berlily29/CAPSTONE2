<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired</title>
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
                <h1 class="text-3xl font-extrabold text-gray-800">{{ config('app.name') }}</h1>
            </div>

            <!-- Error Message -->
            <div class="text-center mb-6">
                <!-- Warning Icon -->
                <div class="flex justify-center mb-4">
                    <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Session Expired or Invalid</h2>
                <p class="text-sm text-gray-500 mt-2">The session token is either expired or broken. Please request a new password reset link.</p>
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
