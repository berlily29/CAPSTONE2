<!-- resources/views/layouts/admin.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Admin Dashboard Overview -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-2xl">500</p>
                </div>

                <!-- Admin Dashboard Overview -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Total Events</h3>
                    <p class="text-2xl">100</p>
                </div>

                <!-- Admin Dashboard Overview -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Pending Approvals</h3>
                    <p class="text-2xl">25</p>
                </div>
            </div>

            <div class="mt-8">
                <!-- Admin-specific content, like charts, recent activities, etc. -->
                <h3 class="text-lg font-semibold">Recent Activities</h3>
                <ul class="list-disc pl-5">
                    <li>User 'John Doe' registered</li>
                    <li>Event 'Volunteer Drive' was scheduled</li>
                    <li>Pending request for approval on event 'Charity Fundraiser'</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
