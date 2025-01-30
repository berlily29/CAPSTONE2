<div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-xl font-bold text-gray-700">Attendance Token</h1>

    <!-- If the token hasn't been generated -->
    <div id="generateSection" class="{{$token != null ? 'hidden' : ''}}">
        <h1 class="text-sm text-gray-500 mb-4">
            Clicking the button will generate your attendance token. This token will be required by the event organizer at the venue for verification.
        </h1>

        <!-- Form for generating the token -->
        <form id="generateTokenForm" action="{{ route('user.channel.attendance.post', ['id' => $event->event_id]) }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-1/4 px-4 py-4 bg-pink-600 text-white text-center rounded-md hover:bg-pink-700 transition flex flex-col items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Generate Token
            </button>
        </form>
    </div>

    <!-- If the token was generated already -->
    @if($token != null)
    <div id="tokenSection" class="{{$token == null ? 'hidden' : ''}}">
        <h1 class="text-sm text-gray-500 mb-4">
            Your attendance token has already been generated. Please ensure that you provide this token to the event organizer at the venue.
            If it has not been encoded yet, your attendance may not be recorded.
        </h1>

        <div id="tokenDisplay" class="flex gap-2 mb-4 items-center">
            <div class="flex gap-2">
                @php $chars = str_split($token->token) @endphp
                @foreach($chars as $char)
                <div class="w-12 h-12 flex items-center justify-center border border-gray-300 text-2xl font-bold rounded-md">{{$char}}</div>
                @endforeach
            </div>

            <div>
                @if($token->encoded == 1)
                <span id="encodedStatus" class="bg-green-100 text-green-600 font-semibold px-2 py-1 rounded flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Your Token has been encoded.
                </span>
                @else

                <span id="waitingStatus" class="bg-yellow-100 text-yellow-600 font-semibold px-2 py-1 rounded flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3M12 4a8 8 0 100 16 8 8 0 000-16z"/>
                    </svg>
                    Waiting to be Encoded
                </span>
               @endif
            </div>
        </div>
    </div>
    @endif
</div>
