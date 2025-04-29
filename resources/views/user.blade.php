<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background-color: #FFF9F0;
        }
        .feature-card {
            background-color: #FFF9F0;
        }
        .container-section {
            background-color: #E6F7F2;
        }
        .orange-button {
            background-color: #FF6B35;
        }
        .outline-button {
            border: 1px solid #FF6B35;
            color: #FF6B35;
        }
        .recipe-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .tab-active {
            border-bottom: 3px solid #FF6B35;
            color: #FF6B35;
        }
    </style>
</head>
<body id="all_content" class="bg-white">
    @if (View::exists('partial.nav'))
        @include('partial.nav')
    @endif
    <!-- Profile Header Section -->
    <section class="bg-cover bg-center py-16 px-4 relative" style="background-image: url('{{ asset('storage/' . $user->background_image) }}');" x-data="{ showBgUpload: false, showProfileUpload: false }">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

        <div class="container mx-auto relative z-10">
            <!-- Background Image Edit Button -->
            <div class="absolute top-4 right-4">
                <!-- Background Upload Form -->
                <div x-show="showBgUpload" @click.away="showBgUpload = false" class="absolute right-0 mt-2 z-50 w-64 bg-white p-4 rounded-lg shadow-xl">
                    <form id="bgImageForm"
                        hx-post="{{ route('profile.update.background') }}"
                        hx-target="#background_update"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input name="background_image" type="file" class="text-sm mb-3 w-full">
                        <div class="flex gap-2">
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm flex-1">
                                Upload
                            </button>
                            <button @click="showBgUpload = false" type="button" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                    <div id="background_update"></div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="flex flex-col md:flex-row items-center gap-8 bg-white/90 backdrop-blur-sm p-6 rounded-xl shadow-lg">
                <!-- Profile Picture with Upload -->
                <div class="relative">
                    <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.jpg') }}"
                             alt="Profile Picture"
                             class="w-full h-full object-cover">
                    </div>
                    <button @click="showProfileUpload = true"
                            class="absolute bottom-0 right-0 bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 shadow-lg transition-transform hover:scale-110">
                        <i class="fas fa-camera"></i>
                    </button>

                    <!-- Profile Picture Upload Form -->
                    <div x-show="showProfileUpload" @click.away="showProfileUpload = false"
                         class="absolute z-10 mt-2 right-0 bg-white p-4 rounded-lg shadow-xl w-64">
                        <form id="profileImageForm"
                              hx-post="{{ route('profile.update.picture') }}"
                              hx-target="#picture_update"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input name="image" type="file" class="text-sm mb-3 w-full">
                            <div class="flex gap-2">
                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm flex-1">
                                    Upload
                                </button>
                                <button @click="showProfileUpload = false" type="button" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded text-sm">
                                    Cancel
                                </button>
                            </div>
                        </form>
                        <div id="picture_update"></div>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-3xl font-bold mb-1 text-gray-800">{{ $user->name }}</h1>
                    <p class="text-gray-600 mb-3">{{ '@' . $user->user_name }}</p>
                    <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                        <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-utensils mr-1"></i> {{ $user->recipes_count }} Recipes
                        </span>
                        <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-heart mr-1"></i> {{ $user->favorites_count }} Favorites
                        </span>
                    </div>
                    <p class="mt-4 text-gray-700 max-w-prose">{{ $user->bio }}</p>
                </div>

                <!-- Edit Profile Button -->
                <div class="md:ml-auto">
                    <button  @click="showBgUpload = true"
                            class="bg-white border border-orange-500 text-orange-500 hover:bg-orange-50 px-4 py-2 rounded-lg flex items-center transition-colors">
                        <i class="fas fa-edit mr-2"></i> Edit BackGround
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Content Section -->
    <section class="py-8 px-8 hero-section">
        <div class="container mx-auto" x-data="{ activeTab: 'recipes', showEditProfile: false }">
            <!-- Tabs -->
            <div class="flex border-b mb-8">
                <button @click="activeTab = 'recipes'" :class="{ 'tab-active': activeTab === 'recipes' }" class="px-6 py-3 font-medium text-gray-700 hover:text-orange-500">
                    <i class="fas fa-book-open mr-2"></i> My Recipes
                </button>
                <button @click="activeTab = 'saved'" :class="{ 'tab-active': activeTab === 'saved' }" class="px-6 py-3 font-medium text-gray-700 hover:text-orange-500">
                    <i class="fas fa-bookmark mr-2"></i> Saved Recipes
                </button>
                <button @click="activeTab = 'settings'; showEditProfile = true" :class="{ 'tab-active': activeTab === 'settings' }" class="px-6 py-3 font-medium text-gray-700 hover:text-orange-500">
                    <i class="fas fa-cog mr-2"></i> Settings
                </button>
            </div>

            <!-- My Recipes Tab -->
            <div x-show="activeTab === 'recipes'">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">My Recipes</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Recipe Card 1 -->
                    @foreach ($recipes as $recipe)
                    <div class="bg-white rounded-lg overflow-hidden recipe-card" x-data="{ showOptions: false }">
                        <div class="relative">
                            <img src="{{asset('storage/' . $recipe->image )}}" alt="Pumpkin Oats" class="w-full h-48 object-cover">
                            <button @click="showOptions = !showOptions" class="absolute top-2 right-2 bg-white rounded-full p-2 text-gray-600 hover:text-orange-500">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div x-show="showOptions" @click.away="showOptions = false" class="absolute top-12 right-2 bg-white rounded-lg shadow-lg z-10">
                                <a href="{{ route('get.recipe', $recipe->id) }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                                <a href="{{ route('get.recipe', $recipe->id) }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Delete</a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">{{ $recipe->title }}</h3>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> {{ $recipe->timepreparation }} mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> {{ $recipe->levelPreparation }}</span>
                            </div>
                            <div class="flex mt-3">
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
                                @foreach ($recipe->categories as $category)
                                <span class="{{ $color = $colors[array_rand($colors)] }} text-xs px-2 py-1 rounded-full mr-2">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 text-center">
                    {{$recipes->links()}}
                </div>
            </div>

            <!-- Saved Recipes Tab -->
            <div x-show="activeTab === 'saved'">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Saved Recipes</h2>
                    <div class="relative" x-data="{ showFilter: false }">
                        <button @click="showFilter = !showFilter" class="outline-button bg-transparent px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                        <div x-show="showFilter" @click.away="showFilter = false" class="absolute right-0 mt-2 bg-white rounded-lg shadow-lg z-10 w-48">
                            <div class="p-3">
                                <label class="block mb-2 text-sm font-medium">Diet</label>
                                <div class="space-y-1">
                                    <label class="flex items-center text-sm">
                                        <input type="checkbox" class="mr-2"> Vegetarian
                                    </label>
                                    <label class="flex items-center text-sm">
                                        <input type="checkbox" class="mr-2"> Vegan
                                    </label>
                                    <label class="flex items-center text-sm">
                                        <input type="checkbox" class="mr-2"> Gluten Free
                                    </label>
                                </div>
                                <button class="orange-button text-white px-3 py-1 rounded text-sm mt-3 w-full">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Saved Recipe -->
                    @foreach ($favories as $favori)
                    <div class="bg-white rounded-lg overflow-hidden recipe-card relative">
                        <div class="absolute top-2 right-2 z-10">
                            <button class="bg-white rounded-full p-2 text-red-500 hover:text-red-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <img src="{{asset('storage/' . $favori->image)}}" alt="Recipe" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold mb-2">{{ $favori->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3">By <span class="text-orange-500">{{ $favori->name }}</span></p>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> {{ $favori->time_pr }} mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> {{ $favori->level }}</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="bg-red-300 text-white text-xs px-2 py-1 rounded-full">High Protein</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 text-center">
                    <button class="outline-button bg-transparent px-6 py-2 rounded-lg">Load More</button>
                </div>
            </div>

            <!-- Settings Tab -->
            <div x-show="activeTab === 'settings'" class="max-w-3xl mx-auto">
                <h2 class="text-xl font-bold mb-6">Profile Settings</h2>

                <!-- Edit Profile Form -->
                <div x-show="showEditProfile" class="bg-white p-6 rounded-lg shadow-sm mb-8">
                    <h3 class="font-bold text-lg mb-4">Edit Profile</h3>
                    <form class="space-y-4"
                    hx-post="{{ route('profile.update') }}"
                    hx-target="#accepted_update">
                        @csrf
                        @method('PUT')
                        <div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input name="first_name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="{{$user->name}}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input name="user_name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="{{$user->user_name}}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="{{$user->email}}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea name="bio" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" rows="4">{{$user->bio}}</textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="showEditProfile = false" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-600">Cancel</button>
                            <button type="submit" class="orange-button text-white px-5 py-2 rounded-lg">Save Changes</button>
                        </div>
                    </form>
                    <div id="accepted_update">

                    </div>
                </div>

                <!-- Password Settings -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                    <div id="password_respond">

                    </div>
                    <h3 class="font-bold text-lg mb-4">Change Password</h3>
                    <form class="space-y-4"
                    hx-post="{{ route('password.update') }}"
                    hx-target="#password_respond">
                    @csrf
                    @method("PATCH")
                        <div>
                            <label  class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <input name="old_password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input name="new_password" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                        </div>

                        <div>
                            <label name="new_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input name="new_password_confirm" type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="orange-button text-white px-5 py-2 rounded-lg">Update Password</button>
                        </div>
                    </form>
                </div>

                <!-- Danger Zone -->
                <div class="bg-white p-8 rounded-xl border border-red-200 shadow-sm">
                    <div class="flex items-center mb-6">
                        <svg class="h-6 w-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-red-600">Danger Zone</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Deactivate Account Section -->
                        <div class="p-5 bg-red-50 rounded-lg border border-red-100">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 mb-1">Deactivate Account</h4>
                                    <p class="text-sm text-gray-600">Temporarily disable your account. You can reactivate it anytime by logging in.</p>
                                </div>
                                <button class="ml-4 bg-white border border-red-500 text-red-500 px-4 py-2 rounded-lg hover:bg-red-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-1">
                                    Deactivate
                                </button>
                            </div>
                        </div>

                        <!-- Delete Account Section -->
                        <div x-data="{ showForm: false }" class="p-5 bg-red-50 rounded-lg border border-red-100">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 mb-1">Delete Account</h4>
                                    <p class="text-sm text-gray-600">Permanently delete your account and all your data. This action cannot be undone.</p>
                                </div>
                                <button
                                    @click="showForm = !showForm"
                                    class="ml-4 bg-white border border-red-500 text-red-500 px-4 py-2 rounded-lg hover:bg-red-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-1"
                                >
                                    Delete Account
                                </button>
                            </div>

                            <!-- Delete Form (Animated) -->
                            <form
                                x-show="showForm"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-4"
                                hx-post="{{ route('profile.delete') }}"
                                hx-target="#delete_account_error"
                                class="mt-5 p-5 bg-white border border-red-300 rounded-lg shadow-sm space-y-4"
                            >
                                @csrf
                                @method('DELETE')

                                <div id="delete_account_error" class="text-red-600 text-sm"></div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input
                                        name="email"
                                        type="email"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-transparent transition duration-200"
                                        placeholder="your@email.com"
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                    <input
                                        name="password"
                                        type="password"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-transparent transition duration-200"
                                        placeholder="••••••••"
                                        required
                                    >
                                </div>

                                <div class="flex justify-end space-x-3 pt-2">
                                    <button
                                        @click="showForm = false"
                                        type="button"
                                        class="px-4 py-2.5 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1"
                                    >
                                        Confirm Deletion
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Save Changes Button -->
                    <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
                        <button class="px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-1">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


@if (View::exists("partial.fotter"))
    @include('partial.fotter')
@endif

<script>
    setTimeout(() => {
      document.getElementById('success-notification').innerHTML = '';
    }, 5000);
</script>
</body>
</html>

