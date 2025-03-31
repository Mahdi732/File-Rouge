<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thai Green Curry Recipe | CookNShare</title>
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @if (View::exists('partial.nav'))
    @include('partial.nav')
    @endif

    <!-- Recipe Header -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex items-center text-sm text-gray-500 mb-4">
            <a href="#" class="text-orange-500 hover:text-orange-600">Recipes</a>
            <span class="mx-2">/</span>
            <a href="#" class="text-orange-500 hover:text-orange-600">Thai Cuisine</a>
            <span class="mx-2">/</span>
            <span>Thai Green Curry</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Recipe Content -->
            <div class="lg:w-2/3">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Authentic Thai Green Curry</h1>
                
                <!-- Author and Meta -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                    <div class="flex items-center space-x-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                             alt="Chef Maria" 
                             class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <p class="font-medium">By Chef Maria Garcia</p>
                            <p class="text-sm text-gray-500">Posted on May 15, 2023</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-1 text-gray-600">
                            <i class="fas fa-clock"></i>
                            <span>45 mins</span>
                        </div>
                        <div class="flex items-center space-x-1 text-gray-600">
                            <i class="fas fa-utensils"></i>
                            <span>4 servings</span>
                        </div>
                        <div class="flex items-center space-x-1 text-gray-600">
                            <i class="fas fa-fire"></i>
                            <span>Medium</span>
                        </div>
                    </div>
                </div>
                
                <!-- Featured Image -->
                <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" 
                         alt="Thai Green Curry" 
                         class="w-full h-auto max-h-96 object-cover">
                </div>
                
                <!-- Description -->
                <div class="prose max-w-none mb-8">
                    <p class="text-gray-700 mb-4">
                        This authentic Thai green curry recipe brings the vibrant flavors of Thailand to your kitchen. 
                        The combination of fresh herbs, creamy coconut milk, and just the right amount of heat makes 
                        this dish a crowd-pleaser. I learned this recipe during my time in Chiang Mai from a local 
                        chef who shared her family's secret techniques.
                    </p>
                    <p class="text-gray-700">
                        What makes this version special is the homemade green curry paste - while you can use store-bought, 
                        taking the extra time to make it fresh elevates the flavors tremendously. Don't be intimidated 
                        by the ingredient list - once you have everything prepped, the curry comes together in minutes!
                    </p>
                </div>
                
                <!-- Video Tutorial -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-play-circle text-orange-500 mr-2"></i>
                        Video Tutorial
                    </h2>
                    <div class="bg-black rounded-xl overflow-hidden shadow-lg video-container relative">
                        <!-- Video placeholder - replace with actual video embed -->
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <button class="bg-orange-500 hover:bg-orange-600 rounded-full w-16 h-16 flex items-center justify-center">
                                <i class="fas fa-play text-2xl"></i>
                            </button>
                        </div>
                    </div>
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
                            <h3 class="font-medium text-gray-700 mb-3">For the Curry Paste:</h3>
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing1" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing1" class="ingredient-label flex-1 text-gray-700">
                                        5 green Thai chilies, stems removed
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing2" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing2" class="ingredient-label flex-1 text-gray-700">
                                        3 shallots, peeled and chopped
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing3" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing3" class="ingredient-label flex-1 text-gray-700">
                                        4 garlic cloves, peeled
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing4" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing4" class="ingredient-label flex-1 text-gray-700">
                                        1 stalk lemongrass, tender part only, sliced
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing5" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing5" class="ingredient-label flex-1 text-gray-700">
                                        1 thumb-sized piece galangal, peeled and sliced
                                    </label>
                                </li>
                            </ul>
                            
                            <h3 class="font-medium text-gray-700 mb-3">For the Curry:</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing6" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing6" class="ingredient-label flex-1 text-gray-700">
                                        400ml coconut milk
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing7" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing7" class="ingredient-label flex-1 text-gray-700">
                                        500g chicken thighs, sliced
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing8" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing8" class="ingredient-label flex-1 text-gray-700">
                                        1 cup Thai eggplant, quartered
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing9" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing9" class="ingredient-label flex-1 text-gray-700">
                                        6 kaffir lime leaves
                                    </label>
                                </li>
                                <li class="flex items-start">
                                    <input type="checkbox" id="ing10" class="ingredient-checkbox mt-1 mr-3">
                                    <label for="ing10" class="ingredient-label flex-1 text-gray-700">
                                        1 tbsp palm sugar
                                    </label>
                                </li>
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
                            <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    1
                                </div>
                                <p class="text-gray-700">
                                    Make the curry paste by blending all paste ingredients in a food processor until smooth. 
                                    Add a splash of water if needed to help blend.
                                </p>
                            </div>
                            <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    2
                                </div>
                                <p class="text-gray-700">
                                    Heat 1/2 cup of coconut milk in a wok or large pan over medium heat until bubbling. 
                                    Add 2-3 tbsp of curry paste and stir fry for 2-3 minutes until fragrant.
                                </p>
                            </div>
                            <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    3
                                </div>
                                <p class="text-gray-700">
                                    Add chicken pieces and cook until they turn white on the outside, about 3 minutes.
                                </p>
                            </div>
                            <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    4
                                </div>
                                <p class="text-gray-700">
                                    Pour in remaining coconut milk and bring to a gentle simmer. Add eggplant and kaffir lime leaves.
                                </p>
                            </div>
                            <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    5
                                </div>
                                <p class="text-gray-700">
                                    Season with fish sauce and palm sugar. Simmer for 10-15 minutes until chicken is cooked through and vegetables are tender.
                                </p>
                            </div>
                            <div class="flex space-x-4 bg-white p-4 rounded-xl shadow-sm">
                                <div class="step-number w-8 h-8 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    6
                                </div>
                                <p class="text-gray-700">
                                    Taste and adjust seasoning. Serve hot with jasmine rice and garnish with Thai basil and sliced red chili.
                                </p>
                            </div>
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
                            <strong>Pro Tip:</strong> For an extra authentic touch, add a few pea eggplants if you can find them. 
                            They add a wonderful bitter contrast to the rich coconut milk.
                        </p>
                        <p class="text-gray-700 mt-2">
                            <strong>Storage:</strong> This curry tastes even better the next day! Store in an airtight 
                            container in the refrigerator for up to 3 days.
                        </p>
                    </div>
                </div>
                
                <!-- Tags and Categories -->
                <div class="mb-8">
                    <div class="flex flex-wrap gap-4">
                        <div>
                            <h3 class="font-medium text-gray-700 mb-2">Categories:</h3>
                            <div class="flex flex-wrap gap-2">
                                <a href="#" class="recipe-tag bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Thai Cuisine
                                </a>
                                <a href="#" class="recipe-tag bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Main Dishes
                                </a>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-700 mb-2">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                <a href="#" class="recipe-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Spicy
                                </a>
                                <a href="#" class="recipe-tag bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Coconut Milk
                                </a>
                                <a href="#" class="recipe-tag bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Quick Dinner
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Nutrition Facts -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-fire-alt text-orange-500 mr-2"></i>
                        Nutrition Facts
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Calories</span>
                            <span class="font-medium">420 kcal</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Protein</span>
                            <span class="font-medium">28g</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Carbs</span>
                            <span class="font-medium">15g</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Fat</span>
                            <span class="font-medium">30g</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Fiber</span>
                            <span class="font-medium">5g</span>
                        </div>
                    </div>
                </div>
                
                <!-- Recommended Tools -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-tools text-orange-500 mr-2"></i>
                        Recommended Tools
                    </h2>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-orange-500">
                                <i class="fas fa-mortar-pestle"></i>
                            </div>
                            <span class="group-hover:text-orange-500 transition">Mortar and Pestle</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-orange-500">
                                <i class="fas fa-blender"></i>
                            </div>
                            <span class="group-hover:text-orange-500 transition">Food Processor</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-orange-500">
                                <i class="fas fa-utensil-spoon"></i>
                            </div>
                            <span class="group-hover:text-orange-500 transition">Wooden Spoon</span>
                        </a>
                    </div>
                </div>
                
                <!-- Similar Recipes -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-utensils text-orange-500 mr-2"></i>
                        You May Also Like
                    </h2>
                    <div class="space-y-4">
                        <a href="#" class="flex space-x-3 group">
                            <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                 alt="Red Curry" 
                                 class="w-16 h-16 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium group-hover:text-orange-500 transition">Thai Red Curry</h3>
                                <p class="text-sm text-gray-500">25 mins · Medium</p>
                            </div>
                        </a>
                        <a href="#" class="flex space-x-3 group">
                            <img src="https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                 alt="Pad Thai" 
                                 class="w-16 h-16 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium group-hover:text-orange-500 transition">Authentic Pad Thai</h3>
                                <p class="text-sm text-gray-500">30 mins · Easy</p>
                            </div>
                        </a>
                        <a href="#" class="flex space-x-3 group">
                            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                 alt="Tom Yum" 
                                 class="w-16 h-16 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium group-hover:text-orange-500 transition">Tom Yum Soup</h3>
                                <p class="text-sm text-gray-500">20 mins · Medium</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @if (View::exists('partial.fotter'))
    @include('partial.fotter')
    @endif
</body>
</html>