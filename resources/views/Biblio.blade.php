<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Keep all existing head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Keep all existing styles */
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
        .step-number {
            background: linear-gradient(135deg, #FF6B35, #FF8E53);
            color: white;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
        }
        .add-btn {
            transition: all 0.2s ease;
        }
        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .category-pill {
            transition: all 0.2s ease;
        }
        .category-pill:hover {
            background-color: #FF6B35;
            color: white;
            border-color: #FF6B35;
        }
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
        }
        .ingredient-item {
            transition: all 0.2s ease;
        }
        .ingredient-item:hover {
            border-color: #FF6B35;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
        @if (View::exists('partial.nav'))
        @include('partial.nav')
        @endif

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
                    
                    <!-- Form container -->
                    <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto relative custom-scrollbar">
                        <!-- Form Header -->
                        <div class="sticky top-0 z-10 bg-gradient-to-r from-orange-500 to-amber-500 py-6 px-8 flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-white">Create New Recipe</h2>
                                <p class="text-orange-50 text-sm mt-1">Fields marked with * are required</p>
                            </div>
                            <button @click="showRecipeForm = false" class="text-white hover:text-orange-100 focus:outline-none">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <!-- Form Body -->
                        <form class="p-8 space-y-8" method="POST" action="{{route('create.recipe')}}" enctype="multipart/form-data" x-data="{
                            steps: [
                            ],
                            ingredients: [
                            ],
                            newIngredient: {
                                amount: '',
                                name: ''
                            },
                            selectedCategories: [],
                            nextStepId: 1,
                            nextIngredientId: 1,
                            
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
                                    ></textarea>
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
                                            hx-post="{{route('search.categorie')}}"
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
                                            <div class="step-number flex-shrink-0" x-text="step.id"></div>
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
                                        value="30"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-300 focus:border-transparent shadow-sm" 
                                    >
                                </div>
                                
                                <!-- Difficulty Level -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty Level</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <label class="flex items-center justify-center space-x-2 category-pill px-3 py-3 rounded-lg border border-gray-200 hover:border-orange-300">
                                            <input type="radio" name="difficulty" value="easy" class="text-orange-500 focus:ring-orange-300">
                                            <span>Easy</span>
                                        </label>
                                        <label class="flex items-center justify-center space-x-2 category-pill px-3 py-3 rounded-lg border border-gray-200 hover:border-orange-300">
                                            <input type="radio" name="difficulty" value="medium" class="text-orange-500 focus:ring-orange-300" checked>
                                            <span>Medium</span>
                                        </label>
                                        <label class="flex items-center justify-center space-x-2 category-pill px-3 py-3 rounded-lg border border-gray-200 hover:border-orange-300">
                                            <input type="radio" name="difficulty" value="hard" class="text-orange-500 focus:ring-orange-300">
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
                                ></textarea>
                            </div>
                            
                            <!-- Media Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Image Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Recipe Image</label>
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
                                            <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Video Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Recipe Video (optional)</label>
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
                                            <p class="text-sm text-gray-500">Upload a video demonstration</p>
                                            <p class="text-xs text-gray-400 mt-1">MP4, MOV, AVI up to 50MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Buttons -->
                            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                                <button 
                                    type="button" 
                                    @click="showRecipeForm = false" 
                                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white rounded-lg transition shadow-md flex items-center"
                                >
                                    <i class="fas fa-utensils mr-2"></i> Create Recipe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </div>

    <!-- Keep all existing content below this point -->
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
            </div>

            <!-- Category Filters -->
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Filter by Category</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="filter-chip active px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        All Categories
                    </button>
                    @foreach ($categories as $category)
                    <button class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200">
                        {{$category->name}}
                    </button>
                    @endforeach
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
                        <img src="{{asset('storage/' . $First_recipe->image)}}" 
                             alt="Featured post" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-1/2 p-8 md:p-10">
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($First_recipe->categories as $category)
                                <span class="category-tag bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
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
                {{-- <!-- Post 2 -->@dd($recipes) --}}
                @foreach ($recipes as $recipe)
                <div class="bg-white rounded-xl overflow-hidden blog-card">
                    <div class="h-48 overflow-hidden">
                        <img src="{{asset('storage/' . $recipe->image)}}" 
                             alt="Post image" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($recipe->categories as $category)
                            <span class="category-tag bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{$category->name}}
                            </span>
                            @endforeach
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{$recipe->title}}
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            {{$recipe->description}}
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t">
                            <div class="flex items-center space-x-2 author-hover">
                                <img src="{{asset('storage/' . $recipe->user->profile_picture)}}" 
                                     alt="Author" 
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-sm font-medium text-gray-700 author-name transition">{{$recipe->user->name}}</span>
                            </div>
                            <span class="text-xs text-gray-500">{{\Carbon\Carbon::parse($recipe->created_at)->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                
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
    @if (View::exists('partial.fotter'))
    @include('partial.fotter')
    @endif
</body>
</html>