<h2 class="w-full text-2xl font-bold text-gray-800 mb-4">Edit Profile Picture</h2>

<div class="lg:grid lg:grid-cols-3 gap-2 p-3">

    <img id='editImage' src="{{ $user->profile_picture ? asset('storage/uploads/profilepic/' . $user->profile_picture) : asset('images/default-dp.jpg') }}" alt="{{$user->profile_picture}}" class="col-span-1 w-48 h-48 rounded-2xl bg-gray-300">

    <div class='mt-2 text-center  col-span-2 items-center grid grid-cols-1 gap-2'>
        <div class='relative grid gap-2 lg:grid-cols-2'>
            <form id="changeProfilePicForm" enctype="multipart/form-data" action="{{route('user.settings.storeProfilePic')}}" method="POST" >
                @csrf
                @method('PATCH')
                <label for='changeProfileButton' class='flex items-center justify-center cursor-pointer rounded-2xl p-4 text-white hover:bg-pink-600 bg-pink-500'>
                    <span class="material-icons mx-2">
                        file_upload
                    </span>
                    <p> Upload Photo </p>
                </label>
                <input type='file' id='changeProfileButton' name='changeProfileButton' class='hidden bg-gray-200 rounded-2xl cursor-pointer hover:bg-pink-600 bg-pink-500'>
            </form>
            
            <button id="saveButton" class="flex w-1/3 hidden items-center justify-center transition-colors mx-3 py-2 px-5 bg-pink-500 hover:bg-pink-600 text-white rounded-2xl">
                <span class="material-icons mx-2">
                    save
                </span>                         
            </button>
        </div>
        

        <div>
            <form id='deleteForm' action="{{route('user.settings.deleteProfilePic')}}" method="POST">
                @csrf
                @method('PATCH')
                <button type="button" id='deleteButton' class="text-left flex lg:w-1/2  cursor-pointer rounded-2xl p-4 text-red-500 hover:text-pink-600 rounded">
                    <span class="material-icons mx-2">&#xE872;</span>
                    <p>Delete Photo</p>
                </button>
            </form>
        </div>
    </div>


       
   
    <div class="mt-2 text-center flex flex-row col-span-3 overflow-x-auto">
        <div class="border border-gray-300 lg:w-full w-auto rounded-md p-4 ">
            <h2 class="text-left w-full font-semibold mb-2 text-[0.8rem] text-gray-400">Email</h2>
            <p class="text-left font-bold text-lg text-gray-600">{{ $user->login->email }}</p>
        </div>
    </div>
</div>