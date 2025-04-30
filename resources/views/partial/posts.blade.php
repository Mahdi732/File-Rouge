<div class="mb-16">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
        <span class="w-4 h-4 bg-orange-500 rounded-full mr-3"></span>
        Featured Post
    </h2>
    <div class="bg-white rounded-2xl overflow-hidden blog-card">
        <div class="md:flex">
            <div class="md:w-1/2 h-80 md:h-auto">
                <img src="{{asset('storage/' . $First_recipe->image)}}"
                     alt="Featured post"
                     class="w-full h-full object-cover">
            </div>
            <div class="md:w-1/2 p-8 md:p-10">
                <div class="flex flex-wrap gap-2 mb-4">
                    @php
                        $colors = [
                            'bg-orange-100 text-orange-800',
                            'bg-purple-100 text-purple-800',
                            'bg-green-100 text-green-800',
                            'bg-yellow-100 text-yellow-800',
                            'bg-red-100 text-red-800',
                            'bg-blue-100 text-blue-800',
                        ];
                    @endphp
                    @foreach ($First_recipe->categories as $category)
                        <span class="{{ $color = $colors[array_rand($colors)] }} px-3 py-1 rounded-full text-sm font-medium">
                            {{$category->name}}
                        </span>
                    @endforeach

                </div>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
                    {{$First_recipe->title}}
                </h3>
                <p class="text-gray-600 mb-6">
                    {{$First_recipe->description}}
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 author-hover">
                        <img src="{{asset('storage/' . $First_recipe->user->profile_picture)}}"
                             alt="Author"
                             class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <p class="font-medium text-gray-800 author-name transition">{{$First_recipe->user->name}}</p>
                            <p class="text-sm text-gray-500">{{\Carbon\Carbon::parse($First_recipe->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    <button class="text-orange-500 hover:text-orange-600 font-medium">
                        Read More →
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($recipes as $recipe)
            <article class="bg-white rounded-xl overflow-hidden blog-card h-full shadow-sm hover:shadow-md transition-all">
                <form action="{{ route('get.recipe', $recipe->id) }}" method="get" class="h-full">
                    @csrf
                    <button type="submit" class="w-full h-full text-left focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-opacity-50 rounded-xl">
                        <div class="relative h-48 overflow-hidden">
                            @if($recipe->image)
                                <img src="{{ asset('storage/' . $recipe->image) }}"
                                    alt="{{ $recipe->title }}"
                                    class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-orange-100 to-amber-100 flex items-center justify-center">
                                    <i class="fas fa-utensils text-4xl text-orange-300"></i>
                                </div>
                            @endif

                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
                                <h3 class="text-xl font-bold text-white line-clamp-2">
                                    {{ $recipe->title }}
                                </h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($recipe->categories as $index => $category)
                                    <span class="category-tag {{ $color = $colors[array_rand($colors)] }} px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>

                            <p class="text-gray-600 mb-4 text-sm line-clamp-3">
                                {{ \Illuminate\Support\Str::limit($recipe->description, 120) }}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t mt-auto">
                                <div class="flex items-center space-x-2">
                                    @if($recipe->user->profile_picture)
                                        <img src="{{ asset('storage/' . $recipe->user->profile_picture) }}"
                                            alt="{{ $recipe->user->name }}"
                                            class="w-8 h-8 rounded-full object-cover border border-gray-200">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                                            <span class="text-orange-500 font-medium text-sm">{{ substr($recipe->user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-700">{{ $recipe->user->name }}</span>
                                </div>
                                <div class="flex items-center text-xs text-gray-500">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ \Carbon\Carbon::parse($recipe->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
            </article>
            @endforeach
        </div>
    </div>
    <!-- Pagination -->
    {{$recipes->links()}}
