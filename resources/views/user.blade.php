<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        .veg-tag {
            background-color: #4CAF50;
        }
        .spicy-tag {
            background-color: #FF5252;
        }
        .protein-tag {
            background-color: #FFC107;
        }
        .tab-active {
            border-bottom: 3px solid #FF6B35;
            color: #FF6B35;
        }
    </style>
</head>
<body class="bg-white">
    @if (View::exists('partial.nav'))
        @include('partial.nav')
    @endif

    <!-- Profile Header Section -->
    <section class="bg-[#FEFCE8] py-8 px-8">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <!-- Profile Image -->
                <div x-data="{ showUpload: false }" class="relative">
                    <div class="w-36 h-36 rounded-full overflow-hidden bg-white border-4 border-white shadow-lg">
                        <img src="{{ asset('picture/profile-placeholder.png') }}" alt="Profile Picture" class="w-full h-full object-cover">
                    </div>
                    <button @click="showUpload = !showUpload" class="absolute bottom-0 right-0 bg-orange-500 text-white rounded-full p-2 shadow-lg">
                        <i class="fas fa-camera"></i>
                    </button>
                    <div x-show="showUpload" @click.away="showUpload = false" class="absolute mt-2 right-0 bg-white p-3 rounded-lg shadow-lg z-10">
                        <input type="file" class="text-sm">
                        <button class="orange-button text-white px-3 py-1 rounded text-sm mt-2 w-full">Upload</button>
                    </div>
                </div>
                
                <!-- Profile Info -->
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-2xl font-bold mb-2">Sarah Johnson</h1>
                    <p class="text-gray-600 mb-3">@sarahcooks</p>
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="bg-orange-100 text-orange-500 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-utensils mr-1"></i> 24 Recipes
                        </span>
                        <span class="bg-orange-100 text-orange-500 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-heart mr-1"></i> 45 Favorites
                        </span>
                        <span class="bg-orange-100 text-orange-500 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-users mr-1"></i> 120 Followers
                        </span>
                    </div>
                    <p class="mt-4 text-gray-700">Passionate home cook who loves experimenting with global cuisines. Sharing my kitchen adventures with fellow food enthusiasts!</p>
                </div>
                
                <!-- Edit Profile Button -->
                <div x-data="{ showEdit: false }">
                    <button @click="showEdit = !showEdit" class="outline-button bg-transparent px-5 py-2 rounded-lg flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
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
                    <div class="bg-white rounded-lg overflow-hidden recipe-card" x-data="{ showOptions: false }">
                        <div class="relative">
                            <img src="{{ asset('picture/loli.png') }}" alt="Pumpkin Oats" class="w-full h-48 object-cover">
                            <button @click="showOptions = !showOptions" class="absolute top-2 right-2 bg-white rounded-full p-2 text-gray-600 hover:text-orange-500">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div x-show="showOptions" @click.away="showOptions = false" class="absolute top-12 right-2 bg-white rounded-lg shadow-lg z-10">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Delete</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Share</a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Pumpkin Oats with Toasted Almonds</h3>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> 45 mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> Beginner</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="veg-tag text-white text-xs px-2 py-1 rounded-full mr-2">Vegetarian</span>
                                <span class="protein-tag text-white text-xs px-2 py-1 rounded-full">High Protein</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden recipe-card" x-data="{ showOptions: false }">
                        <div class="relative">
                            <img src="{{ asset('picture/loli.png') }}" alt="Pasta" class="w-full h-48 object-cover">
                            <button @click="showOptions = !showOptions" class="absolute top-2 right-2 bg-white rounded-full p-2 text-gray-600 hover:text-orange-500">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div x-show="showOptions" @click.away="showOptions = false" class="absolute top-12 right-2 bg-white rounded-lg shadow-lg z-10">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Delete</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Share</a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Creamy Garlic Parmesan Pasta</h3>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> 30 mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> Intermediate</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="veg-tag text-white text-xs px-2 py-1 rounded-full mr-2">Vegetarian</span>
                                <span class="spicy-tag text-white text-xs px-2 py-1 rounded-full">Spicy</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden recipe-card" x-data="{ showOptions: false }">
                        <div class="relative">
                            <img src="{{ asset('picture/loli.png') }}" alt="Smoothie" class="w-full h-48 object-cover">
                            <button @click="showOptions = !showOptions" class="absolute top-2 right-2 bg-white rounded-full p-2 text-gray-600 hover:text-orange-500">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div x-show="showOptions" @click.away="showOptions = false" class="absolute top-12 right-2 bg-white rounded-lg shadow-lg z-10">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Delete</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Share</a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Berry Protein Smoothie Bowl</h3>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> 15 mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> Beginner</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="veg-tag text-white text-xs px-2 py-1 rounded-full mr-2">Vegetarian</span>
                                <span class="protein-tag text-white text-xs px-2 py-1 rounded-full">High Protein</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 text-center">
                    <button class="outline-button bg-transparent px-6 py-2 rounded-lg">Load More</button>
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
                    <!-- Saved Recipe Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden recipe-card relative">
                        <div class="absolute top-2 right-2 z-10">
                            <button class="bg-white rounded-full p-2 text-red-500 hover:text-red-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <img src="{{ asset('picture/loli.png') }}" alt="Recipe" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Honey Glazed Salmon</h3>
                            <p class="text-sm text-gray-600 mb-3">By <span class="text-orange-500">ChefMike</span></p>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> 25 mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> Intermediate</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="protein-tag text-white text-xs px-2 py-1 rounded-full">High Protein</span>
                            </div>
                        </div>
                    </div>

                    <!-- Saved Recipe Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden recipe-card relative">
                        <div class="absolute top-2 right-2 z-10">
                            <button class="bg-white rounded-full p-2 text-red-500 hover:text-red-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <img src="{{ asset('picture/loli.png') }}" alt="Recipe" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Avocado Toast with Poached Eggs</h3>
                            <p class="text-sm text-gray-600 mb-3">By <span class="text-orange-500">HealthyEats</span></p>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> 15 mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> Beginner</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="veg-tag text-white text-xs px-2 py-1 rounded-full mr-2">Vegetarian</span>
                                <span class="protein-tag text-white text-xs px-2 py-1 rounded-full">High Protein</span>
                            </div>
                        </div>
                    </div>

                    <!-- Saved Recipe Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden recipe-card relative">
                        <div class="absolute top-2 right-2 z-10">
                            <button class="bg-white rounded-full p-2 text-red-500 hover:text-red-600">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <img src="{{ asset('picture/loli.png') }}" alt="Recipe" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold mb-2">Thai Green Curry</h3>
                            <p class="text-sm text-gray-600 mb-3">By <span class="text-orange-500">AsianFusion</span></p>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500 mr-3"><i class="far fa-clock mr-1"></i> 40 mins</span>
                                <span class="text-sm text-gray-500"><i class="fas fa-signal mr-1"></i> Intermediate</span>
                            </div>
                            <div class="flex mt-3">
                                <span class="spicy-tag text-white text-xs px-2 py-1 rounded-full">Spicy</span>
                            </div>
                        </div>
                    </div>
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
                    <form class="space-y-4" action="{{ route('editProfile') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input name="first_name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="Sarah">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input name="last_name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="Johnson">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input name="user_name" type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="sarahcooks">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" value="sarah@example.com">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea name="bio" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" rows="4">Passionate home cook who loves experimenting with global cuisines. Sharing my kitchen adventures with fellow food enthusiasts!</textarea>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="showEditProfile = false" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-600">Cancel</button>
                            <button type="submit" class="orange-button text-white px-5 py-2 rounded-lg">Save Changes</button>
                        </div>
                    </form>
                </div>
                
                <!-- Password Settings -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                    <h3 class="font-bold text-lg mb-4">Change Password</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <input type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="orange-button text-white px-5 py-2 rounded-lg">Update Password</button>
                        </div>
                    </form>
                </div>
                
                <!-- Notification Settings -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                    <h3 class="font-bold text-lg mb-4">Notification Settings</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Email Notifications</p>
                                <p class="text-sm text-gray-600">Receive updates about new recipes and followers</p>
                            </div>
                            <div x-data="{ enabled: true }">
                                <button @click="enabled = !enabled" :class="enabled ? 'bg-orange-500' : 'bg-gray-300'" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none">
                                    <span :class="enabled ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Recipe Comments</p>
                                <p class="text-sm text-gray-600">Get notified when someone comments on your recipes</p>
                            </div>
                            <div x-data="{ enabled: true }">
                                <button @click="enabled = !enabled" :class="enabled ? 'bg-orange-500' : 'bg-gray-300'" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none">
                                    <span :class="enabled ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">New Followers</p>
                                <p class="text-sm text-gray-600">Get notified when someone follows you</p>
                            </div>
                            <div x-data="{ enabled: false }">
                                <button @click="enabled = !enabled" :class="enabled ? 'bg-orange-500' : 'bg-gray-300'" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none">
                                    <span :class="enabled ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Weekly Digest</p>
                                <p class="text-sm text-gray-600">Receive a weekly summary of trending recipes</p>
                            </div>
                            <div x-data="{ enabled: true }">
                                <button @click="enabled = !enabled" :class="enabled ? 'bg-orange-500' : 'bg-gray-300'" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none">
                                    <span :class="enabled ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Danger Zone -->
                <div class="bg-red-50 p-6 rounded-lg border border-red-200">
                    <h3 class="font-bold text-lg text-red-600 mb-4">Danger Zone</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-700 mb-2">Deactivate Account</p>
                            <p class="text-sm text-gray-600 mb-3">Temporarily disable your account. You can reactivate it anytime by logging in.</p>
                            <button class="bg-white border border-red-500 text-red-500 px-4 py-2 rounded-lg hover:bg-red-50">Deactivate Account</button>
                        </div>

                        <div x-data="{ showForm: false }">
                            <!-- Toggle Button -->
                            <p class="text-gray-700 mb-2">Delete Account</p>
                            <p class="text-sm text-gray-600 mb-3">Permanently delete your account and all your data. This action cannot be undone.</p>
                            <button @click="showForm = !showForm"  class="bg-white border border-red-500 text-red-500 px-4 py-2 rounded-lg hover:bg-red-50">Delete Account</button>
                            <form 
                                hx-post="{{ route('deleteAccount') }}"  
                                x-show="showForm" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="mt-6 p-6 bg-red-50 border border-red-700 rounded-lg shadow-lg space-y-4"
                            >
                            @csrf
                            @method('DELETE')
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                                    <input 
                                        type="text" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" 
                                        placeholder="Enter your name"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                                    <input 
                                        type="email" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" 
                                        placeholder="Enter your email"
                                    >
                                </div>
                                <button 
                                    type="submit"
                                    class="bg-white border border-red-500 text-red-500 px-4 py-2 rounded-lg hover:bg-red-50" 
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                        <!-- Save Changes Button -->
                        <div class="mt-6 flex justify-end">
                            <button class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@if (View::exists("partial.fotter"))
    @include('partial.fotter')
@endif

</body>
</html>

