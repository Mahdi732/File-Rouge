<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                <!-- Post 1 -->
                <div class="bg-white rounded-xl overflow-hidden blog-card">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                             alt="Post image" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="category-tag bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Healthy Eating
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            Seasonal Vegetables You Should Be Cooking This Month
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Discover the best seasonal produce for May and how to prepare them for maximum flavor and nutrition...
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t">
                            <div class="flex items-center space-x-2 author-hover">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                     alt="Author" 
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-sm font-medium text-gray-700 author-name transition">John Smith</span>
                            </div>
                            <span class="text-xs text-gray-500">May 10, 2023</span>
                        </div>
                    </div>
                </div>

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

                <!-- Post 3 -->
                <div class="bg-white rounded-xl overflow-hidden blog-card">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                             alt="Post image" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="category-tag bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                World Cuisine
                            </span>
                            <span class="category-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                Techniques
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            Mastering the Art of Thai Curry Pastes
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            From selecting the right ingredients to achieving the perfect texture, learn how to make authentic Thai curry pastes at home...
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t">
                            <div class="flex items-center space-x-2 author-hover">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" 
                                     alt="Author" 
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-sm font-medium text-gray-700 author-name transition">Michael Brown</span>
                            </div>
                            <span class="text-xs text-gray-500">April 28, 2023</span>
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
    @if (View::exists('partial.fotter'))
    @include('partial.fotter')
    @endif
</body>
</html>