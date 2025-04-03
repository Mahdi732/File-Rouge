<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookNShare - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .admin-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .admin-card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .primary-button {
            background-color: #FF6B35;
            color: white;
            transition: all 0.3s ease;
        }
        .primary-button:hover {
            background-color: #FF5722;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }
        .secondary-button {
            background-color: #F8F9FA;
            color: #495057;
            transition: all 0.3s ease;
        }
        .secondary-button:hover {
            background-color: #E9ECEF;
            transform: translateY(-2px);
        }
        .tab-active {
            border-bottom: 3px solid #FF6B35;
            color: #FF6B35;
            font-weight: 600;
        }
        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }
        .status-completed {
            background-color: #D4EDDA;
            color: #155724;
        }
        .status-cancelled {
            background-color: #F8D7DA;
            color: #721C24;
        }
        .sidebar-item {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            background-color: #F8F9FA;
            border-left: 4px solid #FF6B35;
        }
        .sidebar-item.active {
            background-color: #FFF5F2;
            border-left: 4px solid #FF6B35;
            color: #FF6B35;
            font-weight: 500;
        }
        [x-cloak] { display: none !important; }
        .image-upload {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .image-upload:hover {
            border-color: #FF6B35;
            background-color: #FFF5F2;
        }
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .mobile-menu-button {
            display: none;
        }
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
                top: 0;
                left: 0;
                transition: transform 0.3s ease;
            }
            .sidebar-open {
                transform: translateX(0);
            }
            .mobile-menu-button {
                display: block;
            }
            .main-content {
                margin-left: 0 !important;
            }
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
            .recipe-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }
        @media (max-width: 640px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            .search-bar {
                width: 100%;
            }
            .tabs-container {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 0.5rem;
            }
            .tabs {
                display: inline-flex;
            }
            .tab-button {
                padding: 0.75rem 1rem;
            }
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-gray-50" 
    x-data="{ 
        activeSection: 'dashboard',
        activeTab: 'categories',
        showCategoryModal: false,
        showTagModal: false,
        showIngredientModal: false,
        categoryImage: null,
        ingredientImage: null,
        sidebarOpen: window.innerWidth > 1024,
        mobileSidebarOpen: false
    }"
    x-init="() => {
        window.addEventListener('resize', () => {
            sidebarOpen = window.innerWidth > 1024;
        });
    }">
    
    <!-- Mobile Menu Button -->
    <div class="fixed top-4 left-4 z-40 lg:hidden">
        <button @click="mobileSidebarOpen = !mobileSidebarOpen" class="mobile-menu-button bg-white p-2 rounded-lg shadow-md">
            <i class="fas fa-bars text-xl text-gray-700"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <div class="sidebar bg-white shadow-lg w-64 px-4 py-8 z-50"
         :class="{ 'sidebar-open': mobileSidebarOpen }">
        <div class="flex items-center justify-between mb-10 px-2">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-utensils text-orange-500 mr-2"></i>
                CookNShare
            </h1>
            <button @click="mobileSidebarOpen = false" class="text-gray-500 hover:text-gray-700 lg:hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <nav class="space-y-1">
            <a href="#" 
               @click="activeSection = 'dashboard'; mobileSidebarOpen = false"
               :class="{'sidebar-item active': activeSection === 'dashboard', 'sidebar-item': activeSection !== 'dashboard'}"
               class="block px-4 py-3 rounded-lg">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="#" 
               @click="activeSection = 'recipes'; activeTab = 'categories'; mobileSidebarOpen = false"
               :class="{'sidebar-item active': activeSection === 'recipes', 'sidebar-item': activeSection !== 'recipes'}"
               class="block px-4 py-3 rounded-lg">
                <i class="fas fa-book-open mr-3"></i> Management
            </a>
            <a href="#" 
               @click="activeSection = 'posts'; mobileSidebarOpen = false"
               :class="{'sidebar-item active': activeSection === 'posts', 'sidebar-item': activeSection !== 'posts'}"
               class="block px-4 py-3 rounded-lg">
                <i class="fas fa-newspaper mr-3"></i> Post Management
            </a>
            <a href="#" 
               @click="activeSection = 'settings'; mobileSidebarOpen = false"
               :class="{'sidebar-item active': activeSection === 'settings', 'sidebar-item': activeSection !== 'settings'}"
               class="block px-4 py-3 rounded-lg">
               <i class="fas fa-book-open mr-3"></i> Recipe Management
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content ml-0 lg:ml-64 transition-all duration-300 min-h-screen">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm py-4 px-6 flex items-center justify-between header-content">
            <button @click="mobileSidebarOpen = !mobileSidebarOpen" class="text-gray-600 hover:text-gray-900 lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div class="flex items-center space-x-4 w-full justify-end">
                <div class="relative search-bar">
                    <input type="text" placeholder="Search..." 
                           class="pl-10 pr-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-orange-300 w-full max-w-md">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <button class="text-gray-600 hover:text-gray-900 relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                             alt="Profile" 
                             class="w-8 h-8 rounded-full bg-red-600 object-cover">
                        <span class="font-medium hidden sm:inline">Admin</span>
                        <i class="fas fa-chevron-down text-gray-500 text-xs hidden sm:inline"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Dashboard Section -->
            <div x-show="activeSection === 'dashboard'" x-cloak>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>
                
                <div class="stats-grid grid gap-4 sm:gap-6 mb-8">
                    <!-- Stats Cards -->
                    <div class="admin-card p-4 sm:p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm sm:text-base">Total Recipes</p>
                                <h3 class="text-xl sm:text-2xl font-bold">1,248</h3>
                                <p class="text-green-500 text-xs sm:text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 12% from last month</p>
                            </div>
                            <div class="bg-orange-100 p-2 sm:p-3 rounded-full">
                                <i class="fas fa-book-open text-orange-500 text-lg sm:text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="admin-card p-4 sm:p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm sm:text-base">Total Posts</p>
                                <h3 class="text-xl sm:text-2xl font-bold">568</h3>
                                <p class="text-green-500 text-xs sm:text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 8% from last month</p>
                            </div>
                            <div class="bg-blue-100 p-2 sm:p-3 rounded-full">
                                <i class="fas fa-newspaper text-blue-500 text-lg sm:text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="admin-card p-4 sm:p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm sm:text-base">Active Users</p>
                                <h3 class="text-xl sm:text-2xl font-bold">4,782</h3>
                                <p class="text-green-500 text-xs sm:text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 5% from last week</p>
                            </div>
                            <div class="bg-green-100 p-2 sm:p-3 rounded-full">
                                <i class="fas fa-users text-green-500 text-lg sm:text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="admin-card p-4 sm:p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm sm:text-base">Pending Orders</p>
                                <h3 class="text-xl sm:text-2xl font-bold">24</h3>
                                <p class="text-red-500 text-xs sm:text-sm mt-1"><i class="fas fa-arrow-down mr-1"></i> 3% from yesterday</p>
                            </div>
                            <div class="bg-purple-100 p-2 sm:p-3 rounded-full">
                                <i class="fas fa-shopping-cart text-purple-500 text-lg sm:text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Section -->
                <div class="admin-card p-4 sm:p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Recent Activity</h2>
                        <button class="text-sm text-orange-500 hover:text-orange-700">View All</button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-orange-100 p-2 rounded-full mr-4">
                                <i class="fas fa-book-open text-orange-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">New recipe added</p>
                                <p class="text-gray-500 text-sm">"Spicy Thai Noodles" was added by Chef Maria</p>
                                <p class="text-gray-400 text-xs mt-1">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-full mr-4">
                                <i class="fas fa-comment text-blue-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">New comment</p>
                                <p class="text-gray-500 text-sm">John Doe commented on "Perfect Chocolate Cake"</p>
                                <p class="text-gray-400 text-xs mt-1">5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-green-100 p-2 rounded-full mr-4">
                                <i class="fas fa-user-plus text-green-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">New user registered</p>
                                <p class="text-gray-500 text-sm">Sarah Johnson joined CookNShare</p>
                                <p class="text-gray-400 text-xs mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recipe Management Section -->
            <div x-show="activeSection === 'recipes'" x-cloak>
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Recipe Management</h1>
                </div>

                <!-- Recipe Tabs -->
                <div class="tabs-container mb-6 scrollbar-hide">
                    <div class="tabs flex border-b space-x-4">
                        <button 
                            @click="activeTab = 'categories'" 
                            :class="{'tab-active': activeTab === 'categories'}" 
                            class="tab-button px-4 sm:px-6 py-3 font-medium text-gray-700 hover:text-orange-500 whitespace-nowrap">
                            <i class="fas fa-list-alt mr-2"></i> Categories
                        </button>
                        <button 
                            @click="activeTab = 'tags'" 
                            :class="{'tab-active': activeTab === 'tags'}" 
                            class="tab-button px-4 sm:px-6 py-3 font-medium text-gray-700 hover:text-orange-500 whitespace-nowrap">
                            <i class="fas fa-tags mr-2"></i> Tags
                        </button>
                        <button 
                            @click="activeTab = 'ingredients'" 
                            :class="{'tab-active': activeTab === 'ingredients'}" 
                            class="tab-button px-4 sm:px-6 py-3 font-medium text-gray-700 hover:text-orange-500 whitespace-nowrap">
                            <i class="fas fa-carrot mr-2"></i> Ingredients
                        </button>
                    </div>
                </div>

                <!-- Categories Management -->
                <div x-show="activeTab === 'categories'" class="space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h2 class="text-xl sm:text-2xl font-bold">Categories</h2>
                        <button 
                            @click="showCategoryModal = true"
                            class="primary-button px-4 py-2 rounded-lg flex items-center w-full sm:w-auto justify-center">
                            <i class="fas fa-plus mr-2"></i> Add Category
                        </button>
                    </div>

                    <!-- Categories Table -->
                    <div class="admin-card p-4 sm:p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-max">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-3 text-left font-medium text-gray-700">Image</th>
                                        <th class="py-3 text-left font-medium text-gray-700">Name</th>
                                        <th class="py-3 text-left font-medium text-gray-700 hidden sm:table-cell">Description</th>
                                        <th class="py-3 text-right font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                                 alt="Appetizers" 
                                                 class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
                                        </td>
                                        <td class="py-4 font-medium">Appetizers</td>
                                        <td class="py-4 text-gray-600 hidden sm:table-cell">Small dishes before main course</td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                                 alt="Main Dishes" 
                                                 class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
                                        </td>
                                        <td class="py-4 font-medium">Main Dishes</td>
                                        <td class="py-4 text-gray-600 hidden sm:table-cell">Primary meal courses</td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                                 alt="Desserts" 
                                                 class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
                                        </td>
                                        <td class="py-4 font-medium">Desserts</td>
                                        <td class="py-4 text-gray-600 hidden sm:table-cell">Sweet final course</td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tags Management -->
                <div x-show="activeTab === 'tags'" class="space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h2 class="text-xl sm:text-2xl font-bold">Tags</h2>
                        <button 
                            @click="showTagModal = true"
                            class="primary-button px-4 py-2 rounded-lg flex items-center w-full sm:w-auto justify-center">
                            <i class="fas fa-plus mr-2"></i> Add Tag
                        </button>
                    </div>

                    <!-- Tags Table -->
                    <div class="admin-card p-4 sm:p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-max">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-3 text-left font-medium text-gray-700">Name</th>
                                        <th class="py-3 text-left font-medium text-gray-700 hidden sm:table-cell">Color</th>
                                        <th class="py-3 text-right font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 font-medium">Vegetarian</td>
                                        <td class="py-4 hidden sm:table-cell">
                                            <span class="inline-block w-6 h-6 rounded-full bg-green-500"></span>
                                            <span class="ml-2 text-gray-600 hidden md:inline">#4CAF50</span>
                                        </td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 font-medium">Gluten-Free</td>
                                        <td class="py-4 hidden sm:table-cell">
                                            <span class="inline-block w-6 h-6 rounded-full bg-blue-500"></span>
                                            <span class="ml-2 text-gray-600 hidden md:inline">#2196F3</span>
                                        </td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 font-medium">Quick Meal</td>
                                        <td class="py-4 hidden sm:table-cell">
                                            <span class="inline-block w-6 h-6 rounded-full bg-orange-500"></span>
                                            <span class="ml-2 text-gray-600 hidden md:inline">#FF9800</span>
                                        </td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Ingredients Management -->
                <div x-show="activeTab === 'ingredients'" class="space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h2 class="text-xl sm:text-2xl font-bold">Ingredients</h2>
                        <button 
                            @click="showIngredientModal = true"
                            class="primary-button px-4 py-2 rounded-lg flex items-center w-full sm:w-auto justify-center">
                            <i class="fas fa-plus mr-2"></i> Add Ingredient
                        </button>
                    </div>

                    <!-- Ingredients Table -->
                    <div class="admin-card p-4 sm:p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-max">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-3 text-left font-medium text-gray-700">Image</th>
                                        <th class="py-3 text-left font-medium text-gray-700">Name</th>
                                        <th class="py-3 text-left font-medium text-gray-700 hidden sm:table-cell">Unit</th>
                                        <th class="py-3 text-left font-medium text-gray-700 hidden md:table-cell">Category</th>
                                        <th class="py-3 text-right font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                                 alt="Salt" 
                                                 class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
                                        </td>
                                        <td class="py-4 font-medium">Salt</td>
                                        <td class="py-4 text-gray-600 hidden sm:table-cell">grams</td>
                                        <td class="py-4 text-gray-600 hidden md:table-cell">Seasonings</td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                                 alt="Olive Oil" 
                                                 class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
                                        </td>
                                        <td class="py-4 font-medium">Olive Oil</td>
                                        <td class="py-4 text-gray-600 hidden sm:table-cell">milliliters</td>
                                        <td class="py-4 text-gray-600 hidden md:table-cell">Oils</td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80" 
                                                 alt="Chicken Breast" 
                                                 class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
                                        </td>
                                        <td class="py-4 font-medium">Chicken Breast</td>
                                        <td class="py-4 text-gray-600 hidden sm:table-cell">pieces</td>
                                        <td class="py-4 text-gray-600 hidden md:table-cell">Meat</td>
                                        <td class="py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post Management Section -->
            <div x-show="activeSection === 'posts'" x-cloak>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Post Management</h1>
                    <button class="primary-button px-4 py-2 rounded-lg flex items-center w-full sm:w-auto justify-center">
                        <i class="fas fa-plus mr-2"></i> Add New Post
                    </button>
                </div>

                <!-- Posts Table -->
                <div class="admin-card p-4 sm:p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-max">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-3 text-left font-medium text-gray-700">Title</th>
                                    <th class="py-3 text-left font-medium text-gray-700 hidden sm:table-cell">Author</th>
                                    <th class="py-3 text-left font-medium text-gray-700 hidden md:table-cell">Categories</th>
                                    <th class="py-3 text-left font-medium text-gray-700 hidden lg:table-cell">Date</th>
                                    <th class="py-3 text-left font-medium text-gray-700">Status</th>
                                    <th class="py-3 text-right font-medium text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 font-medium">10 Tips for Perfect Pasta Every Time</td>
                                    <td class="py-4 text-gray-600 hidden sm:table-cell">Chef Maria</td>
                                    <td class="py-4 text-gray-600 hidden md:table-cell">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm mr-1">Cooking</span>
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm">Tips</span>
                                    </td>
                                    <td class="py-4 text-gray-600 hidden lg:table-cell">May 15, 2023</td>
                                    <td class="py-4">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Published</span>
                                    </td>
                                    <td class="py-4 text-right space-x-2">
                                        <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                        <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        <button class="text-purple-500 hover:text-purple-700"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 font-medium">Summer Salad Recipes</td>
                                    <td class="py-4 text-gray-600 hidden sm:table-cell">Chef John</td>
                                    <td class="py-4 text-gray-600 hidden md:table-cell">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm mr-1">Salads</span>
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm">Summer</span>
                                    </td>
                                    <td class="py-4 text-gray-600 hidden lg:table-cell">Jun 2, 2023</td>
                                    <td class="py-4">
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Draft</span>
                                    </td>
                                    <td class="py-4 text-right space-x-2">
                                        <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                                        <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                        <button class="text-purple-500 hover:text-purple-700"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-4 border-t">
                        <div class="text-sm text-gray-500">
                            Showing 1 to 5 of 12 entries
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">Previous</button>
                            <button class="px-3 py-1 border rounded-md bg-orange-500 text-white">1</button>
                            <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">2</button>
                            <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">3</button>
                            <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recipe Management Section -->
            <div x-show="activeSection === 'settings'" x-cloak>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Recipe Management</h1>
                    <button class="primary-button px-4 py-2 rounded-lg flex items-center w-full sm:w-auto justify-center">
                        <i class="fas fa-plus mr-2"></i> Add New Recipe
                    </button>
                </div>
            
                <!-- Recipe Cards -->
                <div class="recipe-grid grid gap-4 sm:gap-6">
                    <!-- Recipe Card -->
                    <div class="admin-card p-0 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Recipe Image -->
                        <div class="h-40 sm:h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141" 
                                 alt="Perfect Pasta" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Recipe Content -->
                        <div class="p-4 sm:p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800">10 Tips for Perfect Pasta Every Time</h3>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Published</span>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                                     alt="Chef Maria" 
                                     class="w-6 h-6 sm:w-8 sm:h-8 rounded-full mr-2">
                                <span class="text-gray-600 text-sm sm:text-base">Chef Maria</span>
                                <span class="text-gray-400 mx-2 hidden sm:inline">•</span>
                                <span class="text-gray-500 text-xs sm:text-sm hidden sm:inline">May 15, 2023</span>
                            </div>
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-1 sm:gap-2 mb-2">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Italian</span>
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pasta</span>
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs hidden sm:inline">Cooking Tips</span>
                                </div>
                            </div>
                            
                            <!-- Stats -->
                            <div class="flex justify-between text-xs sm:text-sm text-gray-500 border-t pt-3">
                                <div class="flex items-center">
                                    <i class="fas fa-comment text-blue-400 mr-1"></i>
                                    <span>42 reviews</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-heart text-red-400 mr-1"></i>
                                    <span>128 likes</span>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2 sm:space-x-3 mt-4 border-t pt-3">
                                <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-purple-500 hover:text-purple-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Second Recipe Card -->
                    <div class="admin-card p-0 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Recipe Image -->
                        <div class="h-40 sm:h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd" 
                                 alt="Summer Salad" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Recipe Content -->
                        <div class="p-4 sm:p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800">Fresh Summer Salad</h3>
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Draft</span>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                     alt="Chef John" 
                                     class="w-6 h-6 sm:w-8 sm:h-8 rounded-full mr-2">
                                <span class="text-gray-600 text-sm sm:text-base">Chef John</span>
                                <span class="text-gray-400 mx-2 hidden sm:inline">•</span>
                                <span class="text-gray-500 text-xs sm:text-sm hidden sm:inline">Jun 2, 2023</span>
                            </div>
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-1 sm:gap-2 mb-2">
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Vegetarian</span>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Healthy</span>
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs hidden sm:inline">Summer</span>
                                </div>
                            </div>
                            
                            <!-- Stats -->
                            <div class="flex justify-between text-xs sm:text-sm text-gray-500 border-t pt-3">
                                <div class="flex items-center">
                                    <i class="fas fa-comment text-blue-400 mr-1"></i>
                                    <span>15 reviews</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-heart text-red-400 mr-1"></i>
                                    <span>87 likes</span>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2 sm:space-x-3 mt-4 border-t pt-3">
                                <button class="text-blue-500 hover:text-blue-700" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="text-purple-500 hover:text-purple-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav class="flex items-center space-x-2">
                        <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 border rounded-md bg-orange-500 text-white">1</button>
                        <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">3</button>
                        <span class="px-2 text-gray-500">...</span>
                        <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">8</button>
                        <button class="px-3 py-1 border rounded-md text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </main>
    </div>

    <!-- Category Modal -->
    <div x-show="showCategoryModal" 
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
         x-cloak>
        <div class="bg-white rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl sm:text-2xl font-bold">Add New Category</h3>
                    <button @click="showCategoryModal = false; categoryImage = null" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="space-y-4">
                    <div>
                        <label class="block mb-2 font-medium">Category Name</label>
                        <input type="text" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent" placeholder="Enter category name">
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium">Description</label>
                        <textarea class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent" placeholder="Optional description"></textarea>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium">Category Image</label>
                        <template x-if="!categoryImage">
                            <div class="image-upload" @click="document.getElementById('categoryImageUpload').click()">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500 text-center">Click to upload or drag and drop</p>
                                <p class="text-gray-400 text-sm mt-1">PNG, JPG (Max. 2MB)</p>
                                <input type="file" id="categoryImageUpload" class="hidden" 
                                       @change="categoryImage = URL.createObjectURL($event.target.files[0])">
                            </div>
                        </template>
                        <template x-if="categoryImage">
                            <div class="flex flex-col items-center">
                                <img :src="categoryImage" alt="Preview" class="image-preview mb-2">
                                <button type="button" @click="categoryImage = null" 
                                        class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash mr-1"></i> Remove Image
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <div class="flex justify-end space-x-4 pt-4">
                        <button 
                            type="button" 
                            @click="showCategoryModal = false; categoryImage = null"
                            class="secondary-button px-4 sm:px-6 py-2 rounded-lg">Cancel</button>
                        <button 
                            type="submit" 
                            class="primary-button px-4 sm:px-6 py-2 rounded-lg">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tag Modal -->
    <div x-show="showTagModal" 
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
         x-cloak>
        <div class="bg-white rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl sm:text-2xl font-bold">Add New Tag</h3>
                    <button @click="showTagModal = false" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="space-y-4">
                    <div>
                        <label class="block mb-2 font-medium">Tag Name</label>
                        <input type="text" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent" placeholder="Enter tag name">
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium">Color</label>
                        <div class="flex items-center space-x-4">
                            <input type="color" class="w-12 sm:w-16 h-10 border rounded-lg cursor-pointer" value="#4CAF50">
                            <span class="text-gray-600">Hex: #4CAF50</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium">Description (Optional)</label>
                        <textarea class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent" placeholder="Short description"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4 pt-4">
                        <button 
                            type="button" 
                            @click="showTagModal = false"
                            class="secondary-button px-4 sm:px-6 py-2 rounded-lg">Cancel</button>
                        <button 
                            type="submit" 
                            class="primary-button px-4 sm:px-6 py-2 rounded-lg">Save Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ingredient Modal -->
    <div x-show="showIngredientModal" 
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
         x-cloak>
        <div class="bg-white rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl sm:text-2xl font-bold">Add New Ingredient</h3>
                    <button @click="showIngredientModal = false; ingredientImage = null" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form class="space-y-4">
                    <div>
                        <label class="block mb-2 font-medium">Ingredient Name</label>
                        <input type="text" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent" placeholder="Enter ingredient name">
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-medium">Unit of Measurement</label>
                            <select class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                                <option>grams</option>
                                <option>kilograms</option>
                                <option>milliliters</option>
                                <option>liters</option>
                                <option>teaspoons</option>
                                <option>tablespoons</option>
                                <option>cups</option>
                                <option>pieces</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-medium">Category</label>
                            <select class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                                <option>Dairy</option>
                                <option>Meat</option>
                                <option>Vegetables</option>
                                <option>Fruits</option>
                                <option>Grains</option>
                                <option>Spices</option>
                                <option>Oils</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium">Ingredient Image</label>
                        <template x-if="!ingredientImage">
                            <div class="image-upload" @click="document.getElementById('ingredientImageUpload').click()">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500 text-center">Click to upload or drag and drop</p>
                                <p class="text-gray-400 text-sm mt-1">PNG, JPG (Max. 2MB)</p>
                                <input type="file" id="ingredientImageUpload" class="hidden" 
                                       @change="ingredientImage = URL.createObjectURL($event.target.files[0])">
                            </div>
                        </template>
                        <template x-if="ingredientImage">
                            <div class="flex flex-col items-center">
                                <img :src="ingredientImage" alt="Preview" class="image-preview mb-2">
                                <button type="button" @click="ingredientImage = null" 
                                        class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash mr-1"></i> Remove Image
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium">Description (Optional)</label>
                        <textarea class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-300 focus:border-transparent" placeholder="Short description"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4 pt-4">
                        <button 
                            type="button" 
                            @click="showIngredientModal = false; ingredientImage = null"
                            class="secondary-button px-4 sm:px-6 py-2 rounded-lg">Cancel</button>
                        <button 
                            type="submit" 
                            class="primary-button px-4 sm:px-6 py-2 rounded-lg">Save Ingredient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            
            if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                Alpine.store('mobileSidebarOpen', false);
            }
        });

        // Initialize Alpine store
        document.addEventListener('alpine:init', () => {
            Alpine.store('mobileSidebarOpen', false);
        });
    </script>
</body>
</html>