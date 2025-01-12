@extends('user.settings.view')

@section('content')

<h1>Profile </h1>
<div class="flex items-center mb-6">


<img src="{{ asset('profiles/' . $user->profile_picture )}}" alt="{{$user->profile_picture}}" class="w-24 h-24 rounded bg-gray-300 mr-4">

    <div>
      <button class="w-full bg-gray-200 p-2.5 rounded-2xl hover:bg-gray-300 mt-3 text-sm flex items-center justify-center">
        Change Profile Picture
      </button> 
    </div>

    <div>
      <button class="w-full bg-gray-200 p-2.5 rounded-2xl hover:bg-gray-300 mt-3 text-sm flex items-center justify-center">
        Delete Profile Picture
      </button> 
    </div>
  </div>




@endsection