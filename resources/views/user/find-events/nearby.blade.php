@extends('user.find-events.view')

@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class="container mx-auto mt-8 px-4">
    <div class="space-y-8">
        <!-- Event 1 -->
        <div class="mt-4 event bg-white p-6 rounded-lg shadow-lg flex justify-between items-center">
            <h3 class="text-xl font-bold mb-4">Event 1</h3>
            <button class="bg-pink-500 text-white p-3 rounded-full hover:bg-pink-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Event 2 -->
        <div class="mt-4 event bg-white p-6 rounded-lg shadow-lg flex justify-between items-center">
            <h3 class="text-xl font-bold mb-4">Event 2</h3>
            <button class="bg-pink-500 text-white p-3 rounded-full hover:bg-pink-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Event 3 -->
        <div class="mt-4 event bg-white p-6 rounded-lg shadow-lg flex justify-between items-center">
            <h3 class="text-xl font-bold mb-4">Event 3</h3>
            <button class="bg-pink-500 text-white p-3 rounded-full hover:bg-pink-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>

@endsection
