<div class="grid grid-cols-2 gap-6 mt-4">



                        @foreach($terminated as $event)
                            <div class="bg-white p-6 shadow-lg border border-gray-200 rounded-lg relative">
                                <span class="absolute top-0 left-0 h-full w-2 bg-pink-500"></span>
                                <div class="flex justify-between items-start pl-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date ?? 'TBA' }}</p>
                                        <p class="text-sm text-gray-600 mt-1"><strong>Location:</strong> {{ $event->venue ?? 'TBA' }}</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach($event->event_category as $category_id)
                                                @php
                                                    $category = \App\Models\EventCategories::find($category_id);
                                                @endphp
                                                <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-600 rounded-full">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <!-- Pending Status -->
                            @if($event->approved == 0)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-yellow-200 text-yellow-600 rounded-lg">
                                    Pending
                                </span>
                            </div>
                            @elseif ($event->approved == 1)
                            <div class="mt-4">
                                <span class="px-4 py-2 text-sm font-medium bg-green-200 text-green-600 rounded-lg">
                                    Approved
                                </span>
                            </div>
                            @else
                            <div class="mt-4">
                            <span class="px-4 py-2 text-sm font-medium bg-red-200 text-red-600 rounded-lg">
                                Rejected
                            </span>
                            </div>
                            @endif
                                    </div>
                                    <div class="flex items-center justify-center h-full">
                                        <a href="" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                                            <span class="material-icons">info</span>
                                            View Details
                                        </a>
                                    </div>


                                </div>

                            </div>
                        @endforeach
                    </div>
