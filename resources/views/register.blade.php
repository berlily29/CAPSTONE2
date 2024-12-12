<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #f9fafb;
    }
    label {
      font-weight: 600;
    }
    input, button, select, textarea {
      border-radius: 4px;
    }
    button {
      transition: background-color 0.2s, transform 0.2s;
    }
    button:hover {
      transform: scale(1.02);
    }
  </style>
</head>
<body>
  <div class="flex h-screen">
    <!-- Image Section -->
    <div class="w-1/3 bg-gray-200 flex items-center justify-center">
      <p class="text-3xl font-semibold text-gray-700">GALLERY</p>
    </div>

    <!-- Form Section -->
    <div class="w-2/3 flex items-center justify-center bg-gray-50">
      <div class="w-full max-w-md px-6">

        @if(!isset($isVerified) || !$isVerified)
          <h2 class="text-2xl font-bold mb-4 text-gray-800">Let's Get Started</h2>
          @if(isset($errorMessage) && $errorMessage)
            <p class="text-sm text-red-500 mb-4">{{ $errorMessage }}</p>
          @endif

          <!-- Registration Form -->
          <form action="{{route('auth.register.save')}}" method="POST" class="space-y-4">
            @csrf
            @method('POST')
            <!-- First Name -->
            <div>
              <label for="firstName" class="block text-sm text-gray-700">First Name</label>
              <input 
                type="text" 
                id="firstName" 
                name="fname" 
                class="w-full p-2 border border-gray-300 text-sm focus:outline-none focus:ring focus:ring-gray-400" 
                placeholder="John"
              />
              @error('firstName')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="firstName" class="block text-sm text-gray-700">Middle Name</label>
              <input 
                type="text" 
                id="firstName" 
                name="mname" 
                class="w-full p-2 border border-gray-300 text-sm focus:outline-none focus:ring focus:ring-gray-400" 
                placeholder="John"
              />
              @error('firstName')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>


            <!-- Last Name -->
            <div>
              <label for="lastName" class="block text-sm text-gray-700">Last Name</label>
              <input 
                type="text" 
                id="lastName" 
                name="lname" 
                class="w-full p-2 border border-gray-300 text-sm focus:outline-none focus:ring focus:ring-gray-400" 
                placeholder="Doe"
              />
              @error('lastName')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm text-gray-700">Email</label>
              <input 
                type="email" 
                id="email" 
                name="email" 
                class="w-full p-2 border border-gray-300 text-sm focus:outline-none focus:ring focus:ring-gray-400" 
                placeholder="example@email.com"
              />
              @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Password -->
            <div>
              <label for="password" class="block text-sm text-gray-700">Password</label>
              <input 
                type="password" 
                id="password" 
                name="password" 
                class="w-full p-2 border border-gray-300 text-sm focus:outline-none focus:ring focus:ring-gray-400" 
                placeholder="******"
              />
              @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>


            @if(isset($msg) && $msg != '')
            <div class="mt-6 bg-pink-50 border-l-4 border-pink-500 text-pink-600 p-4 rounded-lg shadow-md">
                <span class="font-medium">{{ $msg }}</span>
            </div>
            @endif

            

            <!-- Register Button -->
            <button 
              type="submit" 
              class="w-full py-3 text-white bg-sky-500 hover:bg-sky-600 rounded-lg font-medium tracking-wide transition duration-300">
              Register
            </button>
          </form>
        @else
          <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
            <span class="material-icons text-xl mr-2">badge</span> Verification
          </h2>
          <p class="text-sm text-gray-600 mb-4">Upload a valid ID to verify your account.</p>

          <!-- ID Preview -->
          <div class="border border-gray-300 bg-gray-100 py-8 rounded-sm mb-4 text-center">
            @if(isset($imagePreview))
              <img src="{{ $imagePreview }}" alt="ID Preview" class="mx-auto h-40 object-contain" />
            @else
              <p class="text-sm text-gray-500">ID Preview</p>
            @endif
          </div>

          <!-- File Upload -->
          <form action="{{ route('upload-id') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" id="fileInput" name="idFile" class="hidden" accept="image/*" />
            <label for="fileInput" class="block text-center text-sm text-gray-600 underline cursor-pointer">
              Choose a file
            </label>

            <button 
              type="submit" 
              class="w-full bg-gray-800 text-white py-2 text-sm font-semibold hover:bg-gray-700">
              Upload
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>
</body>
</html>
