<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipes->title }} | CookNShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        .gradient-text {
            background: linear-gradient(90deg, #FF6B35, #FF8E53);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .recipe-tag {
            transition: all 0.2s ease;
        }
        .recipe-tag:hover {
            transform: translateY(-2px);
        }
        .ingredient-checkbox:checked + .ingredient-label {
            text-decoration: line-through;
            color: #9CA3AF;
        }
        .step-number {
            background: linear-gradient(135deg, #FF6B35, #FF8E53);
        }
        .video-container {
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
        }
        .file-drop-area {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            max-width: 100%;
            padding: 2rem 1.5rem;
            border: 2px dashed #cbd5e1;
            border-radius: 0.5rem;
            transition: 0.2s;
            background-color: #f8fafc;
        }
        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            cursor: pointer;
            opacity: 0;
        }
        .file-msg {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        [x-cloak] {
            display: none !important;
        }
        .star-rating {
            display: inline-flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            cursor: pointer;
            color: #ddd;
            font-size: 1.5rem;
            padding: 0 0.1rem;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #FFB800;
        }
        .review-stars {
            color: #ddd;
        }
        .review-stars .filled {
            color: #FFB800;
        }
    </style>
</head>
<body class="bg-gray-50" x-data="{ editMode: false }">
    <!-- Navigation -->
    @if (View::exists('partial.nav'))
    @include('partial.nav')
    @endif

    <!-- Recipe Header -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- View/Edit Toggle (Only visible to recipe owner or admin) -->
        @if(Auth::user() && (Auth::user()->id == $recipes->userId ))
        <div class="flex justify-end mb-6">
            <button
                @click="editMode = !editMode"
                class="flex items-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition shadow-sm"
            >
                <i class="fas" :class="editMode ? 'fa-eye' : 'fa-edit'"></i>
                <span x-text="editMode ? 'View Recipe' : 'Edit Recipe'"></span>
            </button>
        </div>
        @endif

        <!-- Recipe View Mode -->
        <div x-show="!editMode" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Recipe Content -->
                <div class="lg:w-2/3">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $recipes->title }}</h1>

                    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('storage/' . $recipes->user->profile_picture) }}"
                                alt="Chef {{ $recipes->user->name }}"
                                class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium">By Chef {{ $recipes->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($recipes->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-1 text-gray-600">
                                <i class="fas fa-clock"></i>
                                <span>{{ $recipes->timepreparation }} min</span>
                            </div>
                            <div class="flex items-center space-x-1 text-gray-600">
                                <i class="fas fa-fire"></i>
                                <span>{{ $recipes->levelPreparation }}</span>
                            </div>

                            <!-- Recipe Actions Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    @click.away="open = false"
                                    class="flex items-center space-x-1 text-gray-600 hover:text-orange-500"
                                >
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div
                                    x-show="open"
                                    x-cloak
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 overflow-hidden"
                                >
                                    <div class="py-1">
                                        <form action="{{ route('add.favorite.recipe', $recipes) }}" method="post">
                                            @csrf
                                        <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700">
                                            <i class="fas fa-heart mr-2"></i> Add Favorite
                                        </button>
                                        </form>
                                        @if(Auth::user() && (Auth::user()->id == $recipes->userId ))
                                        <form action="{{ route('delete.recipe', $recipes->id) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this recipe?')" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-trash-alt mr-2"></i> Delete Recipe
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                        <img src="{{ asset('storage/' . $recipes->image) }}"
                            alt="{{ $recipes->title }}"
                            class="w-full h-auto max-h-96 object-cover">
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none mb-8">
                        <p class="text-gray-700 mb-4">
                            {{ $recipes->description }}
                        </p>
                    </div>

                    <!-- Video Tutorial -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-play-circle text-orange-500 mr-2"></i>
                            Video Tutorial
                        </h2>

                        @if($recipes->video)
                            <div
                                x-data="{
                                    playing: false,
                                    loading: true,
                                    muted: false,
                                    currentTime: 0,
                                    duration: 0,
                                    seeking: false,
                                    seekPosition: 0
                                }"
                                class="rounded-xl overflow-hidden shadow-lg relative bg-gray-900"
                                @mousemove="if (playing) $refs.controls.classList.add('opacity-100')"
                                @mouseleave="if (playing) $refs.controls.classList.remove('opacity-100')"
                            >
                                <!-- Video Element -->
                                <video
                                    id="recipe-video"
                                    class="w-full aspect-video object-cover"
                                    poster="{{ $recipes->image ? asset('storage/' . $recipes->image) : asset('images/recipe-placeholder.jpg') }}"
                                    preload="metadata"
                                    x-ref="video"
                                    @play="playing = true; loading = false"
                                    @pause="playing = false"
                                    @ended="playing = false"
                                    @loadeddata="loading = false; duration = $event.target.duration"
                                    @timeupdate="currentTime = $event.target.currentTime"
                                    @waiting="loading = true"
                                    @canplay="loading = false"
                                >
                                    <source src="{{ asset('storage/' . $recipes->video) }}" type="video/mp4">
                                    <source src="{{ asset('storage/' . $recipes->video) }}" type="video/webm">
                                    <p class="text-white p-4">Your browser does not support the video tag.</p>
                                </video>

                                <!-- Loading Spinner -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 transition-opacity duration-300 z-10"
                                    x-show="loading"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                >
                                    <div class="w-12 h-12 border-4 border-orange-500 border-t-transparent rounded-full animate-spin"></div>
                                </div>

                                <!-- Play Button Overlay -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 transition-opacity duration-300 z-20"
                                    x-show="!playing && !loading"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    @click="$refs.video.play()"
                                >
                                    <button class="bg-orange-500 hover:bg-orange-600 rounded-full w-16 h-16 flex items-center justify-center transition transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-opacity-50">
                                        <i class="fas fa-play text-white text-2xl"></i>
                                    </button>
                                </div>

                                <!-- Video Controls -->
                                <div
                                    x-ref="controls"
                                    class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent opacity-0 transition-opacity duration-300 z-30"
                                    :class="{ 'opacity-100': !playing || seeking }"
                                >
                                    <!-- Progress Bar -->
                                    <div
                                        class="h-2 bg-gray-600 rounded-full overflow-hidden mb-2 cursor-pointer relative"
                                        @click="$refs.video.currentTime = ($event.offsetX / $event.target.offsetWidth) * duration"
                                        @mousedown="seeking = true; seekPosition = ($event.offsetX / $event.target.offsetWidth) * duration"
                                        @mousemove="if (seeking) seekPosition = ($event.offsetX / $event.target.offsetWidth) * duration"
                                        @mouseup="if (seeking) { $refs.video.currentTime = seekPosition; seeking = false }"
                                        @mouseleave="seeking = false"
                                    >
                                        <div
                                            class="h-full bg-orange-500 relative"
                                            :style="`width: ${(currentTime / duration) * 100}%`"
                                        >
                                            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-3 h-3 bg-white rounded-full shadow"></div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <button
                                                @click="$refs.video.paused ? $refs.video.play() : $refs.video.pause()"
                                                class="text-white hover:text-orange-300 transition focus:outline-none"
                                                aria-label="Play or pause video"
                                            >
                                                <i class="fas" :class="{ 'fa-pause': playing, 'fa-play': !playing }"></i>
                                            </button>

                                            <div class="text-white text-sm hidden sm:block">
                                                <span x-text="formatTime(currentTime)">0:00</span>
                                                <span class="mx-1">/</span>
                                                <span x-text="formatTime(duration)">0:00</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-4">
                                            <button
                                                @click="muted = !muted; $refs.video.muted = muted"
                                                class="text-white hover:text-orange-300 transition focus:outline-none"
                                                aria-label="Toggle mute"
                                            >
                                                <i class="fas" :class="{ 'fa-volume-up': !muted, 'fa-volume-mute': muted }"></i>
                                            </button>

                                            <button
                                                @click="$refs.video.requestFullscreen()"
                                                class="text-white hover:text-orange-300 transition focus:outline-none"
                                                aria-label="Enter fullscreen"
                                            >
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Video Description (Optional) -->
                            @if(isset($recipes->video_description) && $recipes->video_description)
                                <div class="mt-3 text-sm text-gray-600">
                                    {{ $recipes->video_description }}
                                </div>
                            @endif
                        @else
                            <div class="rounded-xl overflow-hidden shadow-lg bg-gray-100 aspect-video flex items-center justify-center">
                                <div class="text-center p-6">
                                    <i class="fas fa-video text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-gray-500">No video tutorial available for this recipe</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Recipe Details -->
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <!-- Ingredients -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-carrot text-orange-500 mr-2"></i>
                                Ingredients
                            </h2>
                            <div class="bg-white rounded-xl p-6 shadow-sm">
                                <ul class="space-y-3 mb-6">
                                    @foreach (json_decode($recipes->ingredients) as $index => $ingredient)
                                        <li class="flex items-start">
                                            <input type="checkbox" id="ing{{ $index }}" class="ingredient-checkbox mt-1 mr-3">
                                            <label for="ing{{ $index }}" class="ingredient-label flex-1 text-gray-700">
                                                {{ $ingredient }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-list-ol text-orange-500 mr-2"></i>
                                Instructions
                            </h2>
                            <div class="space-y-4">
                                @foreach (json_decode($recipes->etap, true) as $index => $etap)
                                    <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                        <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                            {{ $index + 1 }}
                                        </div>
                                        <p class="text-gray-700">
                                            {{ $etap }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-orange-500 mr-2"></i>
                            Chef's Notes
                        </h2>
                        <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-lg">
                            <p class="text-gray-700">
                                <strong>Pro Tip:</strong> {{ $recipes->note }}
                            </p>
                        </div>
                    </div>

                    <!-- Tags and Categories -->
                    <div class="mb-8">
                        <div class="flex flex-wrap gap-4">
                            <div>
                                <h3 class="font-medium text-gray-700 mb-2">Categories:</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($recipes->categories as $categorie)
                                        <a href="" class="recipe-tag bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $categorie->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3 space-y-6">
                    <!-- Similar Recipes -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-utensils text-orange-500 mr-2"></i>
                            You May Also Like
                        </h2>
                        <div class="space-y-4">
                            @foreach ($Like as $item)
                            <a href="{{ route('get.recipe', $item->id) }}" class="flex space-x-3 group">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->title }}"
                                    class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <h3 class="font-medium group-hover:text-orange-500 transition">{{ $item->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->timepreparation }} mins · {{ $item->levelPreparation }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-star text-orange-500 mr-2"></i>
                            Reviews
                        </h2>

                        <!-- Review Stats -->
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="text-3xl font-bold text-gray-800 mr-2">4</div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star-half text-yellow-400"></i>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">12 reviews </div>
                        </div>

                        <!-- Add Review Form -->
                        @auth
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-800 mb-3">Share Your Experience</h3>
                                <form action="{{ route('create.reviews.recipe', $recipes->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                                        <div class="star-rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" />
                                            <label for="star{{ $i }}" title="{{ $i }} stars"><i class="fas fa-star"></i></label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div>
                                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                                        <textarea
                                            id="comment"
                                            name="comment"
                                            rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                                            placeholder="Share your thoughts about this recipe..."
                                            required
                                        ></textarea>
                                    </div>

                                    <button
                                        type="submit"
                                        class="w-full py-2 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition flex items-center justify-center"
                                    >
                                        <i class="fas fa-paper-plane mr-2"></i> Submit Review
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-orange-50 p-4 rounded-lg mb-6">
                                <p class="text-orange-800 text-sm">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <a href="{{ route('login') }}" class="font-medium underline">Sign in</a> to leave a review
                                </p>
                            </div>
                        @endauth

                        <!-- Reviews List -->
                        <div class="space-y-4 max-h-96 overflow-y-auto custom-scrollbar">
                            @foreach($recipes->reviews as $review)
                            <div class="border-b border-gray-100 pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center">
                                            <img class="w-8 h-8 rounded-full bg-gray-200 mr-2 flex items-center justify-center" src="{{ asset('storage/' . $review->user->profile_picture) }}" alt="">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $review->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        @for ($i = 1; $i <= $review->rate; $i++)
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">{{ $review->content }}</p>
                                @auth
                                @if (Auth::id() == $review->user->id)
                                    <div class="flex justify-end mt-2">
                                        <form action="{{ route('remove.review.recipe', $review->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-xs text-red-500 hover:text-red-700" type="submit">
                                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipe Edit Mode -->
        <div x-show="editMode" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="bg-white rounded-xl shadow-xl max-w-4xl mx-auto overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-orange-500 to-amber-500 py-6 px-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-white">Edit Recipe</h2>
                        <p class="text-orange-50 text-sm mt-1">Fields marked with * are required</p>
                    </div>
                    <button @click="editMode = false" class="text-white hover:text-orange-100 focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Form Body -->
                <form class="p-8 space-y-8" method="POST" action="{{ route('edit.recipe', $recipes->id) }}" enctype="multipart/form-data" x-data="{
                    steps: {{ json_encode(array_map(function($step, $index) {
                        return ['id' => $index + 1, 'text' => $step];
                    }, json_decode($recipes->etap, true) ?? [], array_keys(json_decode($recipes->etap, true) ?? []))) }},

                    ingredients: {{ json_encode(array_map(function($ingredient, $index) {
                        $parts = explode('|', $ingredient);
                        return [
                            'id' => $index + 1,
                            'amount' => trim($parts[0] ?? ''),
                            'name' => trim($parts[1] ?? $ingredient)
                        ];
                    }, json_decode($recipes->ingredients, true) ?? [], array_keys(json_decode($recipes->ingredients, true) ?? []))) }},

                    newIngredient: {
                        amount: '',
                        name: ''
                    },

                    selectedCategories: {{ json_encode($recipes->categories->pluck('name')->toArray()) }},

                    nextStepId: {{ count(json_decode($recipes->etap, true) ?? []) + 1 }},
                    nextIngredientId: {{ count(json_decode($recipes->ingredients, true) ?? []) + 1 }},

                    addStep() {
                        this.steps.push({
                            id: this.nextStepId++,
                            text: ''
                        });
                    },

                    removeStep(stepId) {
                        this.steps = this.steps.filter(step => step.id !== stepId);
                    },

                    addIngredient() {
                        if (this.newIngredient.amount.trim() !== '' && this.newIngredient.name.trim() !== '') {
                            this.ingredients.push({
                                id: this.nextIngredientId++,
                                amount: this.newIngredient.amount,
                                name: this.newIngredient.name
                            });
                            this.newIngredient.amount = '';
                            this.newIngredient.name = '';
                        }
                    },

                    removeIngredient(ingredientId) {
                        this.ingredients = this.ingredients.filter(ingredient => ingredient.id !== ingredientId);
                    },

                    addCategory(category) {
                        if (!this.selectedCategories.includes(category)) {
                            this.selectedCategories.push(category);
                        }
                    },

                    removeCategory(category) {
                        this.selectedCategories = this.selectedCategories.filter(c => c !== category);
                    },

                    isCategorySelected(category) {
                        return this.selectedCategories.includes(category);
                    }
                }">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Basic Information</h3>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Recipe Title <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ $recipes->title }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent shadow-sm"
                                placeholder="Give your recipe a descriptive title"
                                required
                            >
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent shadow-sm"
                                placeholder="Describe your recipe in a few sentences"
                                required
                            >{{ $recipes->description }}</textarea>
                        </div>

                        <!-- Categories with Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Categories <span class="text-red-500">*</span></label>

                            <!-- Category Search Bar -->
                            <div class="relative mb-4">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input
                                type="text"
                                name="categoriesSearch"
                                hx-post="{{route('searchCategorie')}}"
                                hx-target="#categorieSearch"
                                hx-swap="innerHTML"
                                hx-trigger="keyup changed delay:200ms"
                                placeholder="Search categories..."
                                class="search-input w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-300 shadow-sm"
                            >
                            </div>

                            <!-- Selected Categories -->
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-2">Selected Categories:</p>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="category in selectedCategories" :key="category">
                                        <div class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                            <span x-text="category"></span>
                                            <button type="button" @click="removeCategory(category)" class="ml-1 text-orange-600 hover:text-orange-800">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <input type="hidden" name="categories[]" :value="category">
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Popular Categories -->
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Popular Categories:</p>
                                <div id="categorieSearch" class="flex flex-wrap gap-2">
                                    @foreach($allCategories ?? [] as $category)
                                        <button
                                            type="button"
                                            @click="addCategory('{{ $category->name }}')"
                                            :class="{'bg-orange-500 text-white': isCategorySelected('{{ $category->name }}')}"
                                            class="category-pill px-3 py-1 rounded-full text-sm font-medium border border-gray-200 hover:border-orange-300"
                                        >
                                            {{ $category->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ingredients Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Ingredients <span class="text-red-500">*</span></h3>

                        <!-- Ingredient List -->
                        <div class="space-y-3">
                            <template x-for="ingredient in ingredients" :key="ingredient.id">
                            <div class="ingredient-item flex items-center p-3 border border-gray-200 rounded-lg bg-white shadow-sm">
                                <div class="flex-grow">
                                    <input
                                        type="text"
                                        x-bind:value="`${ingredient.amount} | ${ingredient.name}`"
                                        name="ingredients[]"
                                        readonly
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                                    >
                                </div>
                                <button type="button" @click="removeIngredient(ingredient.id)" class="ml-3 text-gray-400 hover:text-red-500">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </template>

                            <!-- Add Ingredient Form -->
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                                        <input
                                            type="text"
                                            x-model="newIngredient.amount"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                                            placeholder="e.g. 2 cups"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Ingredient</label>
                                        <input
                                            type="text"
                                            x-model="newIngredient.name"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                                            placeholder="e.g. All-purpose flour"
                                        >
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    @click="addIngredient()"
                                    class="add-btn w-full flex items-center justify-center py-2 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition"
                                >
                                    <i class="fas fa-plus mr-2"></i> Add Ingredient
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Preparation Steps -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Preparation Steps <span class="text-red-500">*</span></h3>

                        <div class="space-y-4">
                            <template x-for="step in steps" :key="step.id">
                                <div class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg bg-white shadow-sm">
                                    <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0" x-text="step.id"></div>
                                    <textarea
                                        x-model="step.text"
                                        name="steps[]"
                                        class="flex-grow px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                                        :placeholder="`Describe step ${step.id}`"
                                        rows="2"
                                        :required="step.id === 1"
                                    ></textarea>
                                    <button
                                        type="button"
                                        @click="removeStep(step.id)"
                                        class="text-gray-400 hover:text-red-500 mt-3"
                                        :disabled="steps.length === 1"
                                        :class="{ 'opacity-50 cursor-not-allowed': steps.length === 1 }"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </template>

                            <!-- Add Step Button -->
                            <button
                                type="button"
                                @click="addStep()"
                                class="add-btn w-full flex items-center justify-center py-3 px-4 border border-dashed border-orange-300 rounded-lg text-orange-500 hover:bg-orange-50"
                            >
                                <i class="fas fa-plus mr-2"></i> Add Another Step
                            </button>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Preparation Time -->
                        <div>
                            <label for="prep_time" class="block text-sm font-medium text-gray-700 mb-1">Preparation Time (minutes)</label>
                            <input
                                type="number"
                                id="prep_time"
                                name="prep_time"
                                min="5"
                                max="180"
                                value="{{ $recipes->timepreparation }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent shadow-sm"
                            >
                        </div>

                        <!-- Difficulty Level -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty Level</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="flex items-center justify-center space-x-2 category-pill px-3 py-3 rounded-lg border border-gray-200 hover:border-orange-300">
                                    <input type="radio" name="difficulty" value="easy" class="text-orange-500 focus:ring-orange-300" {{ $recipes->levelPreparation == 'easy' ? 'checked' : '' }}>
                                    <span>Easy</span>
                                </label>
                                <label class="flex items-center justify-center space-x-2 category-pill px-3 py-3 rounded-lg border border-gray-200 hover:border-orange-300">
                                    <input type="radio" name="difficulty" value="medium" class="text-orange-500 focus:ring-orange-300" {{ $recipes->levelPreparation == 'medium' ? 'checked' : '' }}>
                                    <span>Medium</span>
                                </label>
                                <label class="flex items-center justify-center space-x-2 category-pill px-3 py-3 rounded-lg border border-gray-200 hover:border-orange-300">
                                    <input type="radio" name="difficulty" value="hard" class="text-orange-500 focus:ring-orange-300" {{ $recipes->levelPreparation == 'hard' ? 'checked' : '' }}>
                                    <span>Hard</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                        <textarea
                            id="notes"
                            name="notes"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent shadow-sm"
                            placeholder="Share any tips, variations, or additional information about your recipe"
                        >{{ $recipes->note }}</textarea>
                    </div>

                    <!-- Media Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Recipe Image</label>
                            @if($recipes->image)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                    <div class="relative w-full h-40 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $recipes->image) }}" alt="{{ $recipes->title }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                            <span class="text-white text-sm">Upload new image to replace</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="file-drop-area bg-orange-50 border-orange-200">
                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    accept="image/*"
                                    class="file-input"
                                >
                                <div class="file-msg">
                                    <i class="fas fa-camera text-3xl text-orange-400 mb-2"></i>
                                    <p class="text-sm text-gray-600">{{ $recipes->image ? 'Replace current image' : 'Upload an image' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 5MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Video Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Recipe Video (optional)</label>
                            @if($recipes->video)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Current Video:</p>
                                    <div class="relative w-full h-40 rounded-lg overflow-hidden bg-gray-900">
                                        <video class="w-full h-full object-cover" poster="{{ asset('storage/' . $recipes->image) }}">
                                            <source src="{{ asset('storage/' . $recipes->video) }}" type="video/mp4">
                                        </video>
                                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                            <span class="text-white text-sm">Upload new video to replace</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="file-drop-area">
                                <input
                                    type="file"
                                    id="video"
                                    name="video"
                                    accept="video/*"
                                    class="file-input"
                                >
                                <div class="file-msg">
                                    <i class="fas fa-film text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">{{ $recipes->video ? 'Replace current video' : 'Upload a video demonstration' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">MP4, MOV, AVI up to 50MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <button
                            type="button"
                            @click="editMode = false"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white rounded-lg transition shadow-md flex items-center"
                        >
                            <i class="fas fa-save mr-2"></i> Update Recipe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @if (View::exists('partial.fotter'))
    @include('partial.fotter')
    @endif

    <script>
        function formatTime(seconds) {
            seconds = Math.floor(seconds || 0);
            const minutes = Math.floor(seconds / 60);
            seconds = seconds % 60;
            return `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }
    </script>
</body>
</html>
