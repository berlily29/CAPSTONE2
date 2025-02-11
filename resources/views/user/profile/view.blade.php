<x-app-layout>
    <div class="min-h-screen bg-white py-8 rounded-xl">
        <section class=" bg-white px-6">
            <!-- Profile Header -->
            <div class="flex items-center gap-6 mb-8">
                <div class="relative group">
                    <img src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('images/default-dp.jpg') }}"
                         alt="Profile Picture"
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg hover:border-purple-100 transition-background-color duration-200">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->fullname }}</h1>
                    <div class="flex items-center mt-2">
                        <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="ml-2 text-lg font-semibold text-gray-600">{{ $user->profile_points }} Points</span>
                    </div>
                </div>
            </div>

            <!-- Personal Info Section -->
            <div class="space-y-6">
                <!-- Name Section -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">First Name</p>
                            <p class="font-medium text-gray-700">{{ $user->fname }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Middle Name</p>
                            <p class="font-medium text-gray-700">{{ $user->mname }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Last Name</p>
                            <p class="font-medium text-gray-700">{{ $user->lname }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Mobile Number</p>
                            <p class="font-medium text-gray-700">{{ $user->mobile_no }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Age</p>
                            <p class="font-medium text-gray-700">{{ $user->age }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Gender</p>
                            <p class="font-medium text-gray-700">{{ $user->gender === 'male' ? 'Male' : 'Female' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Address</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Street Address</p>
                                <p class="font-medium text-gray-700">{{ $user->house_no }} {{ $user->street }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">City</p>
                                <p class="font-medium text-gray-700">{{ $user->city }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Barangay</p>
                                <p class="font-medium text-gray-700">{{ $user->brgy }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Province & Postal Code</p>
                                <p class="font-medium text-gray-700">{{ $user->province }} {{ $user->postal_code }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Participated Events -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Participated Events</h3>
                    <div class="space-y-3">
                        @foreach($part_events as $event)
                        <div class="flex items-center justify-between bg-white p-4 rounded-lg hover:shadow transition-all">
                            <div>
                                <p class="font-medium text-gray-700">{{ $event->channel->event->title }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">+50pts</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
