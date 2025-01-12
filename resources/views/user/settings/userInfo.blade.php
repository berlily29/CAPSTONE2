@extends('user.settings.view')

@section('content')

<form id="editForm" method="POST">
    @csrf
    @method('PUT')

    <h2 class="text-2xl font-semibold mb-4">Edit User Information</h2>

    <div class="mb-4">
        <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
        <input type="text" id="fname" name="fname" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->fname }}" required>
    </div>

    <div class="mb-4">
        <label for="mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
        <input type="text" id="mname" name="mname" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->mname }}" required>
    </div>

    <div class="mb-4">
        <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
        <input type="text" id="lname" name="lname" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->lname }}" required>
    </div>

    <div class="mb-4">
        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
        <input type="text" id="age" name="age" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->age }}" required>
    </div>

    <div class="mb-4">
        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
        <select id="gender" name="gender" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <option value="" disabled>Select A Gender</option>
            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="house_no" class="block text-sm font-medium text-gray-700">House Number</label>
        <input type="text" id="house_no" name="house_no" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->house_no }}" required>
    </div>

    <div class="mb-4">
        <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
        <input type="text" id="street" name="street" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->street }}" required>
    </div>

</form>

<div class="mt-4 text-center">
    <button id="editButton" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
        Edit Item
    </button>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('editButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to edit your personal information.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'edit',
            cancelButtonText: 'cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                document.getElementById('editForm').submit();
            }
        });
    });
</script>

@endsection

