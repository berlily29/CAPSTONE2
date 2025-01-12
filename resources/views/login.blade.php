<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans">
<div class="flex h-screen">
    <!-- Left Content: Form Section -->
    <div class="w-7/12 bg-white flex flex-col justify-center items-center px-16 shadow-lg">
        <!-- Logo Section -->
        <div class="w-full flex justify-center">
            <img src="{{asset('images/logo/logo.png')}}" alt="Logo" class="w-[350px] h-[200px]">
        </div>

        <!-- Login Header -->
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">Welcome Back</h1>
        <p class="text-gray-500 text-center mb-8">Please log in to your account to continue.</p>

        <!-- Form -->
        <form method="POST" action="{{ route('auth.login') }}" class="w-full max-w-md">
            @csrf

            <!-- Email Input -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400" 
                    placeholder="Enter your email address"
                    required
                >
                @error('email')
                <p class="text-pink-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400" 
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                <p class="text-pink-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Forgot Password -->
            <div class="text-right text-sm mb-6">
                <a href="{{route('reset-password')}}" class="text-sky-500 hover:text-sky-700 transition duration-200">Forgot Password?</a>
            </div>

            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full py-3 text-white bg-sky-500 hover:bg-sky-600 rounded-lg font-medium tracking-wide transition duration-300"
            >
                LOGIN
            </button>

            <!-- Error Message -->
            @if(isset($msg) && $msg != '')
            <div class="mt-6 bg-pink-50 border-l-4 border-pink-500 text-pink-600 p-4 rounded-lg shadow-md">
                <span class="font-medium">{{ $msg }}</span>
            </div>
            @endif

            <!-- Signup Section -->
            <p class="text-center text-gray-600 mt-8">
                Don't have an account? 
                <a href="{{route('auth.register')}}" class="text-sky-500 font-semibold hover:underline">Sign up here</a>
            </p>
        </form>
    </div>

    <!-- Right Content: Image Section -->
    <div class="w-5/12 bg-gradient-to-b from-sky-100 via-white to-sky-50 flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-700">GALLERY</h1>
         
        </div>
    </div>
</div>
</body>
</html>
