<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        .blog-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        .category-tag {
            transition: all 0.2s ease;
        }
        .category-tag:hover {
            transform: translateY(-1px);
        }
        .gradient-text {
            background: linear-gradient(90deg, #FF6B35, #FF8E53);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .author-hover:hover .author-name {
            color: #FF6B35;
        }
        .filter-chip {
            transition: all 0.2s ease;
        }
        .filter-chip:hover {
            background-color: #FF6B35;
            color: white;
        }
        .filter-chip.active {
            background-color: #FF6B35;
            color: white;
        }
        .pagination-item:hover:not(.active):not(.disabled) {
            background-color: #f3f4f6;
        }
        .pagination-item.active {
            background-color: #FF6B35;
            color: white;
        }
        [x-cloak] { 
            display: none !important; 
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
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #FF6B35;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #e05a2b;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <!-- Navigation would be included here -->

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-orange-50 to-amber-50 py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">CookNShare Blog</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover culinary stories, cooking tips, and delicious recipes from our community
            </p>
            
            <!-- Add Recipe Button -->
            <div class="mt-8" x-data="{ showRecipeForm: false }">
                <button 
                    @click="showRecipeForm = !showRecipeForm" 
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition flex items-center mx-auto shadow-md hover:shadow-lg"
                >
                    <i class="fas fa-plus mr-2"></i>
                    <span x-text="showRecipeForm ? 'Close Form' : 'Create New Recipe'"></span>
                </button>
                
                <!-- Recipe Creation Form -->
                <div x-show="showRecipeForm" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto">
                    <!-- Modal backdrop - only this element closes the form when clicked -->
                    <div @click="showRecipeForm = false" class="absolute inset-0"></div>
                    
                    <!-- Form container - removed the @click.outside directive -->
                    <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto relative custom-scrollbar">
                        <div class="sticky top-0 z-10 bg-white p-6 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-2xl font-bold text-gray-800">Create New Recipe</h2>
                            <button @click="showRecipeForm = false" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <form class="p-6 space-y-6" method="POST" enctype="multipart/form-data" x-data="{
                            selectedCategories: [],
                            availableCategories: [
                                'Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Snack', 
                                'Appetizer', 'Soup', 'Salad', 'Main Course', 'Side Dish'
                            ],
                            selectedIngredients: [],
                            searchTerm: '',-

                            
                            availableIngredients: [
                                'Salt', 'Pepper', 'Olive Oil', 'Garlic', 'Onion', 'Tomato', 
                                'Chicken', 'Beef', 'Pork', 'Rice', 'Pasta', 'Flour', 
                                'Sugar', 'Butter', 'Milk', 'Eggs', 'Cheese', 'Lemon'
                            ],
                            customIngredient: '',
                            
                            toggleCategory(category) {
                                if (this.selectedCategories.includes(category)) {
                                    this.selectedCategories = this.selectedCategories.filter(c => c !== category);
                                } else {
                                    this.selectedCategories.push(category);
                                }
                            },
                            
                            filteredIngredients() {
                                if (!this.searchTerm.trim()) return [];
                                
                                return this.availableIngredients.filter(i => 
                                    i.toLowerCase().includes(this.searchTerm.toLowerCase()) && 
                                    !this.selectedIngredients.includes(i)
                                );
                            },
                            
                            addIngredient(ingredient) {
                                if (!this.selectedIngredients.includes(ingredient)) {
                                    this.selectedIngredients.push(ingredient);
                                    this.searchTerm = '';
                                }
                            },
                            
                            addCustomIngredient() {
                                if (this.customIngredient.trim() !== '' && !this.selectedIngredients.includes(this.customIngredient.trim())) {
                                    this.selectedIngredients.push(this.customIngredient.trim());
                                    this.customIngredient = '';
                                }
                            },
                            
                            removeIngredient(ingredient) {
                                this.selectedIngredients = this.selectedIngredients.filter(i => i !== ingredient);
                            }
                        }">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                                <input 
                                    type="text" 
                                    id="title" 
                                    name="title" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                    placeholder="Recipe title"
                                    required
                                >
                            </div>
                            
                            <!-- Categories -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="category in availableCategories" :key="category">
                                        <button 
                                            type="button"
                                            @click="toggleCategory(category)"
                                            :class="selectedCategories.includes(category) ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                            class="px-3 py-1 rounded-full text-sm font-medium transition-colors"
                                            x-text="category"
                                        ></button>
                                    </template>
                                </div>
                                
                                <!-- Hidden inputs to store selected categories -->
                                <template x-for="category in selectedCategories" :key="category">
                                    <input type="hidden" name="categories[]" :value="category">
                                </template>
                                
                                <p class="text-xs text-gray-500 mt-1">Select all that apply</p>
                            </div>
                            
                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                                <textarea 
                                    id="description" 
                                    name="description" 
                                    rows="3" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                    placeholder="Describe your recipe"
                                    required
                                ></textarea>
                            </div>
                            
                            <!-- Steps -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">Steps <span class="text-red-500">*</span></label>
                                </div>
                                
                                <div class="space-y-3">
                                    <!-- Step 1 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3 mt-2">
                                            <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-orange-100 text-orange-800 text-sm font-medium">1</span>
                                        </div>
                                        <div class="flex-grow">
                                            <textarea 
                                                name="steps[]"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                                placeholder="Step 1" 
                                                rows="2"
                                                required
                                            ></textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 2 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3 mt-2">
                                            <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-orange-100 text-orange-800 text-sm font-medium">2</span>
                                        </div>
                                        <div class="flex-grow">
                                            <textarea 
                                                name="steps[]"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                                placeholder="Step 2" 
                                                rows="2"
                                            ></textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 3 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3 mt-2">
                                            <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-orange-100 text-orange-800 text-sm font-medium">3</span>
                                        </div>
                                        <div class="flex-grow">
                                            <textarea 
                                                name="steps[]"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                                placeholder="Step 3" 
                                                rows="2"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-1">Add at least one step. Leave empty steps blank.</p>
                            </div>
                            
                            <!-- Notes -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                <textarea 
                                    id="notes" 
                                    name="notes" 
                                    rows="2" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                    placeholder="Additional notes or tips"
                                ></textarea>
                            </div>
                            
                            <!-- Media Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Image Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                    <div class="file-drop-area">
                                        <input 
                                            type="file" 
                                            id="image" 
                                            name="image" 
                                            accept="image/*" 
                                            class="file-input"
                                        >
                                        <div class="file-msg">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-500">Click to upload or drag and drop</p>
                                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Video Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Video</label>
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
                                            <p class="text-sm text-gray-500">Upload a video file</p>
                                            <p class="text-xs text-gray-400 mt-1">MP4, MOV, AVI up to 50MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ingredients -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ingredients <span class="text-red-500">*</span></label>
                                
                                <!-- Selected Ingredients -->
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <template x-for="ingredient in selectedIngredients" :key="ingredient">
                                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                            <span x-text="ingredient"></span>
                                            <button 
                                                type="button" 
                                                @click="removeIngredient(ingredient)" 
                                                class="ml-2 text-orange-700 hover:text-orange-900"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </span>
                                    </template>
                                </div>
                                
                                <!-- Hidden inputs to store selected ingredients -->
                                <template x-for="ingredient in selectedIngredients" :key="ingredient">
                                    <input type="hidden" name="ingredients[]" :value="ingredient">
                                </template>
                                
                                <!-- Search Input -->
                                <div class="relative mb-2">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        x-model="searchTerm" 
                                        placeholder="Search ingredients..." 
                                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                                    >
                                    
                                    <!-- Dropdown Results -->
                                    <div 
                                        x-show="filteredIngredients().length > 0" 
                                        class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg border border-gray-200 max-h-60 overflow-y-auto"
                                    >
                                        <template x-for="ingredient in filteredIngredients()" :key="ingredient">
                                            <button 
                                                type="button"
                                                @click="addIngredient(ingredient)"
                                                class="block w-full text-left px-4 py-2 hover:bg-orange-50 text-sm"
                                                x-text="ingredient"
                                            ></button>
                                        </template>
                                    </div>
                                </div>
                                
                                <!-- Custom Ingredient -->
                                <div class="flex">
                                    <input 
                                        type="text" 
                                        x-model="customIngredient" 
                                        placeholder="Add custom ingredient..." 
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                                        @keydown.enter.prevent="addCustomIngredient()"
                                    >
                                    <button 
                                        type="button" 
                                        @click="addCustomIngredient()" 
                                        class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-r-lg transition"
                                    >
                                        Add
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Can't find an ingredient? Add your own!</p>
                            </div>
                            
                            <!-- Time and Level -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Preparation Time -->
                                <div>
                                    <label for="prepTime" class="block text-sm font-medium text-gray-700 mb-1">Preparation Time (minutes)</label>
                                    <input 
                                        type="number" 
                                        id="prepTime" 
                                        name="prepTime" 
                                        min="5" 
                                        max="180"
                                        value="30"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                    >
                                </div>
                                
                                <!-- Difficulty Level -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty Level</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="level" value="easy" class="text-orange-500 focus:ring-orange-300">
                                            <span class="ml-2">Easy</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="level" value="medium" class="text-orange-500 focus:ring-orange-300" checked>
                                            <span class="ml-2">Medium</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="level" value="hard" class="text-orange-500 focus:ring-orange-300">
                                            <span class="ml-2">Hard</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Buttons -->
                            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                                <button 
                                    type="button" 
                                    @click="showRecipeForm = false" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition flex items-center"
                                >
                                    <i class="fas fa-save mr-2"></i> Create Recipe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Search and Filters -->
        <div class="mb-8 bg-white rounded-xl shadow-sm p-6">
            <!-- Search Bar -->
            <div class="relative mb-6">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                       placeholder="Search posts...">
                <button class="absolute right-2.5 bottom-2.5 bg-orange-500 hover:bg-orange-600 text-white px-4 py-1 rounded-lg transition">
                    Search
                </button>
            </div>

            <!-- Category Filters -->
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Filter by Category</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="filter-chip active px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        All Categories
                    </button>
                    <button class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        Cooking Tips
                    </button>
                    <button class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        Baking
                    </button>
                    <button class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        Healthy Eating
                    </button>
                    <button class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        World Cuisine
                    </button>
                    <button class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        Kitchen Tools
                    </button>
                </div>
            </div>

            <!-- Tag Filters -->
            <div>
                <h3 class="text-lg font-medium text-gray-800 mb-3">Filter by Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Vegetarian
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Quick Meals
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Beginner
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Advanced
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Seasonal
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Family Friendly
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Gluten-Free
                    </button>
                    <button class="filter-chip px-3 py-1 rounded-full text-sm font-medium border border-gray-200">
                        Dairy-Free
                    </button>
                </div>
            </div>
        </div>

        <!-- Featured Post -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                <span class="w-4 h-4 bg-orange-500 rounded-full mr-3"></span>
                Featured Post
            </h2>
            <div class="bg-white rounded-2xl overflow-hidden blog-card">
                <div class="md:flex">
                    <div class="md:w-1/2 h-80 md:h-auto">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                             alt="Featured post" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-1/2 p-8 md:p-10">
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="category-tag bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                Cooking Tips
                            </span>
                            <span class="category-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                Techniques
                            </span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
                            10 Essential Knife Skills Every Home Cook Should Master
                        </h3>
                        <p class="text-gray-600 mb-6">
                            Learn the fundamental knife techniques that will transform your cooking efficiency and presentation. These skills will save you time and elevate your dishes...
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3 author-hover">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                                     alt="Author" 
                                     class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <p class="font-medium text-gray-800 author-name transition">Maria Garcia</p>
                                    <p class="text-sm text-gray-500">May 15, 2023 · 8 min read</p>
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
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <span class="w-4 h-4 bg-orange-500 rounded-full mr-3"></span>
                    Latest Articles
                </h2>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Sort by:</span>
                    <select class="border-0 bg-gray-100 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-orange-300">
                        <option>Newest First</option>
                        <option>Most Popular</option>
                        <option>Trending</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Post 2 -->
                <div class="bg-white rounded-xl overflow-hidden blog-card">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                             alt="Post image" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="category-tag bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                Baking
                            </span>
                            <span class="category-tag bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                Desserts
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            The Science Behind Perfect Sourdough Bread
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Understanding the fermentation process and how to control it for consistently amazing sourdough results every time...
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t">
                            <div class="flex items-center space-x-2 author-hover">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                                     alt="Author" 
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-sm font-medium text-gray-700 author-name transition">Sarah Johnson</span>
                            </div>
                            <span class="text-xs text-gray-500">May 5, 2023</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mb-12">
            <nav class="inline-flex rounded-md shadow-sm">
                <a href="#" class="pagination-item px-3 py-2 rounded-l-lg border border-gray-300 text-gray-500 disabled">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="pagination-item active px-4 py-2 border-t border-b border-gray-300">
                    1
                </a>
                <a href="#" class="pagination-item px-4 py-2 border-t border-b border-gray-300 text-gray-700">
                    2
                </a>
                <a href="#" class="pagination-item px-4 py-2 border-t border-b border-gray-300 text-gray-700">
                    3
                </a>
                <span class="pagination-item px-4 py-2 border-t border-b border-gray-300 text-gray-500">
                    ...
                </span>
                <a href="#" class="pagination-item px-4 py-2 border-t border-b border-gray-300 text-gray-700">
                    8
                </a>
                <a href="#" class="pagination-item px-3 py-2 rounded-r-lg border border-gray-300 text-gray-700">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </nav>
        </div>

        <!-- Newsletter -->
        <div class="bg-gradient-to-r from-orange-50 to-amber-50 rounded-2xl p-8 md:p-12 text-center mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Join Our Culinary Community</h3>
            <p class="text-gray-600 max-w-2xl mx-auto mb-6">
                Get weekly recipes, cooking tips, and exclusive content delivered straight to your inbox
            </p>
            <div class="flex flex-col sm:flex-row max-w-md mx-auto sm:max-w-xl gap-3">
                <input type="email" 
                       placeholder="Your email address" 
                       class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-orange-300">
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition">
                    Subscribe
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- Footer would be included here -->
</body>
</html>
