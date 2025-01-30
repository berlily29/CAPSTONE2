<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Slideshow Container */
        .slideshow-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Slideshow Images */
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        /* Make sure the first slide is visible initially */
        .slide.active {
            opacity: 1;
        }

        /* Gradient Overlay */
        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(255, 105, 180, 0.7), rgba(255, 182, 193, 0.6));
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
<div class="flex min-h-screen">
    <!-- Left Content: Form Section -->
    <div class="w-7/12 bg-white flex flex-col justify-center items-center p-16">
        <!-- Logo Section -->
        <div class="w-full flex justify-center">
            <img src="{{asset('images/logo/logo.png')}}" alt="Logo" class="w-[150px] h-auto">
        </div>

        <!-- Login Header -->
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Welcome Back</h1>
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
            <p class="text-center text-gray-s600 mt-8">
                Don't have an account?
                <a href="{{route('auth.register')}}" class="text-sky-500 font-semibold hover:underline">Sign up here</a>
            </p>
        </form>
    </div>

    <!-- Right Content: Slideshow Section with Gradient Overlay -->
    <div class="w-full md:w-5/12 relative">
        <div class="slideshow-container">
            <!-- Slideshow Images -->
            <img src="{{asset('images/slideshow/1.jpg')}}" class="slide active">
            <img src="{{asset('images/slideshow/2.jpg')}}" class="slide">
            <img src="{{asset('images/slideshow/3.jpg')}}" class="slide">

            <img src="{{asset('images/slideshow/4.jpg')}}" class="slide">
            <img src="{{asset('images/slideshow/5.jpg')}}" class="slide">
            <img src="{{asset('images/slideshow/6.jpg')}}" class="slide">

            <img src="{{asset('images/slideshow/7.jpg')}}" class="slide">
            <img src="{{asset('images/slideshow/8.jpg')}}" class="slide">
            <!-- Gradient Overlay -->
            <div class="gradient-overlay"></div>
        </div>
    </div>
</div>

<script>
    // Slideshow functionality
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    // Show next slide
    function showNextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % totalSlides;
        slides[currentIndex].classList.add('active');
    }

    // Change slide every 3 seconds
    setInterval(showNextSlide, 3000);
</script>
</body>
</html>
