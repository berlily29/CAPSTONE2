<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slideshow-container {
      position: relative;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }
    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }
    .slide.active { opacity: 1; }
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
<body>
@php

$config = \App\Models\AppConfig::find(1);
@endphp

  <div class="flex h-screen">
    <!-- Image Section -->
    <div class="w-1/3 bg-gray-200 relative">
      <div class="slideshow-container">
        <img src="{{asset('images/slideshow/1.jpg')}}" class="slide active">
        <img src="{{asset('images/slideshow/2.jpg')}}" class="slide">
        <img src="{{asset('images/slideshow/3.jpg')}}" class="slide">
        <div class="gradient-overlay"></div>
        <div class="absolute inset-0 flex items-center justify-center z-10">
          <img src="{{asset('images/logo/' . $config->secondary_logo) }}" class="w-[220px] h-auto" alt="">
        </div>
      </div>
    </div>

    <!-- Form Section -->
    <div class="w-2/3 flex items-center justify-center bg-gray-50">
      <div class="w-full max-w-md px-6">
        @if(!isset($isVerified) || !$isVerified)
          <h2 class="text-3xl font-bold mb-6 text-gray-800">Let's Get Started</h2>
          @if(isset($errorMessage) && $errorMessage)
            <p class="text-sm text-red-500 mb-4">{{ $errorMessage }}</p>
          @endif

          <form method="POST" action="{{ route('auth.register.save') }}" class="space-y-4" id="registrationForm">
            @csrf

            <!-- Name Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="space-y-1">
                <label class="text-sm font-medium text-gray-600">First Name</label>
                <input type="text" name="fname" value="{{ old('fname') }}"
                       class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
              </div>
              <div class="space-y-1">
                <label class="text-sm font-medium text-gray-600">Middle Name</label>
                <input type="text" name="mname" value="{{ old('mname') }}"
                       class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
              </div>
              <div class="space-y-1">
                <label class="text-sm font-medium text-gray-600">Last Name</label>
                <input type="text" name="lname" value="{{ old('lname') }}"
                       class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
              </div>
            </div>

            <!-- email -->

            <div class="space-y-1">
              <label class="text-sm font-medium text-gray-600">Email</label>
              <input type ="text" name="email" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">

              </select>
            </div>


            <div class="space-y-1">
              <label class="text-sm font-medium text-gray-600">Email</label>
              <input type ="password" name="password" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">

              </select>
            </div>
            <!-- Contact Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="space-y-1">
                <label class="text-sm font-medium text-gray-600">Mobile No.</label>
                <input type="text" name="mobile_no" value="{{ old('mobile_no') }}"
                       class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
              </div>
              <div class="space-y-1">
                <label class="text-sm font-medium text-gray-600">Age</label>
                <input type="number" name="age" value="{{ old('age') }}"
                       class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
              </div>
            </div>

            <!-- Gender -->
            <div class="space-y-1">
              <label class="text-sm font-medium text-gray-600">Gender</label>
              <select name="gender" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>






            <button type="submit"
                    class="w-full bg-pink-600 text-white py-2 px-4 rounded-md hover:bg-pink-700 transition-colors">
              Continue
            </button>
          </form>

        @else
          <!-- Verification Section (Keep exactly as original) -->
          <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
            <span class="material-icons text-xl mr-2">badge</span> Verification
          </h2>
          <p class="text-sm text-gray-600 mb-4">Upload a valid ID to verify your account.</p>

          <div class="border border-gray-300 bg-gray-100 py-8 rounded-sm mb-4 text-center">
            @if(isset($imagePreview))
              <img src="{{ $imagePreview }}" alt="ID Preview" class="mx-auto h-40 object-contain">
            @else
              <p class="text-sm text-gray-500">ID Preview</p>
            @endif
          </div>

          <form action="{{ route('upload-id') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" id="fileInput" name="idFile" class="hidden" accept="image/*">
            <label for="fileInput" class="block text-center text-sm text-gray-600 underline cursor-pointer">
              Choose a file
            </label>
            <button type="submit"
                    class="w-full bg-gray-800 text-white py-2 text-sm font-semibold hover:bg-gray-700">
              Upload
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>

  <script>
    // Form persistence
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('registrationForm');
      if(form) {
        const inputs = form.querySelectorAll('input, select, textarea');

        // Load saved values
        inputs.forEach(input => {
          const savedValue = sessionStorage.getItem(input.name);
          if(savedValue) input.value = savedValue;
        });

        // Save on input
        form.addEventListener('input', (e) => {
          sessionStorage.setItem(e.target.name, e.target.value);
        });

        // Clear on submit
        form.addEventListener('submit', () => {
          inputs.forEach(input => sessionStorage.removeItem(input.name));
        });
      }

      // Slideshow
      let currentIndex = 0;
      const slides = document.querySelectorAll('.slide');
      const totalSlides = slides.length;

      function showNextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % totalSlides;
        slides[currentIndex].classList.add('active');
      }
      setInterval(showNextSlide, 3000);
    });
  </script>
</body>
</html>
