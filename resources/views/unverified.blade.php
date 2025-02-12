<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Pending</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 font-sans">

    <div class="flex items-center justify-center min-h-screen bg-sky-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">Email Verification Pending</h2>

                <h3 class="text-2xl font-bold text-gray-600 mb-4">{{$email}}</h3>
                <p class="text-lg text-gray-600 mb-6">We’ve sent a verification email to your inbox. Please verify your email to proceed.</p>

                <!-- Icon section (optional) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-pink-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v10.5M6 6l6 6 6-6" />
                </svg>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mb-4">
                <p class="text-gray-600 mb-4">Check your inbox for the verification email. If you don't see it, please check your spam folder.</p>

                <!-- Resend Verification Button -->
               
         
                <a href="{{route('auth.register.resend',['id'=> $id])}}" class="w-full inline-block bg-pink-500 text-white text-base py-3 rounded-xl hover:bg-pink-400 transition-all duration-300">
                    Resend Verification Email
                </a>
            </div>

            <div class="text-center mt-4">
                <p class="text-gray-600 text-sm">
                    Having trouble? Contact our support.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
