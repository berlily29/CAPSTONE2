<div class="mb-4">
                            <p class="text-gray-400">Discover events currently accepting participants</p>
                        </div>

                        <div class="w-full grid grid-cols-1 gap-6">
                            @foreach ($open_events as $event)
                            <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-pink-100 overflow-hidden">
                                <!-- Gradient Accent Bar -->
                                <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-pink-500 to-sky-600"></div>

                                <div class="pl-6 pr-4 py-6 flex flex-col sm:flex-row justify-between gap-4">
                                    <!-- Event Details -->
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-pink-600 mb-3">{{ $event->title }}</h3>

                                        <div class="flex items-center gap-3 text-pink-500 mb-4">
                                            <div class="flex items-center text-sm">
                                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{explode(' ', $event->date)[0] ?? 'TBA' }}
                                            </div>
                                            <div class="flex items-center text-sm">
                                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $event->venue ?? 'TBA' }}
                                            </div>
                                        </div>

                                        <!-- Categories -->
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($event->event_category as $category_id)
                                                @php $category = \App\Models\EventCategories::find($category_id) @endphp
                                                <span class="px-3 py-1.5 text-sm font-medium bg-gradient-to-r from-pink-50 to-pink-100 text-pink-600 rounded-full border border-pink-200">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="sm:self-center">
                                        <a href="{{route('find-events.view', ['id'=>$event->event_id])}}"
                                        class="flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-pink-500 to-sky-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
