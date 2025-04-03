<!DOCTYPE html>
<html lang="en" x-data="{ isLogin: true }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHub | Join Our Culinary Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        .bg-food-pattern {
            background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }
        .animate-fade-in-up {
        animation: fadeInUp 0.3s ease-out forwards;
        }
        .animate-fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    @if (request()->has('success'))
    <div id="success-notification" class="fixed top-4 left-0 right-0 z-50 flex justify-center pointer-events-none">
        <div class="animate-fade-in-up bg-white shadow-lg rounded-lg border border-green-100 overflow-hidden w-full max-w-md">
            <div class="flex items-start p-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">Success!</p>
                    
                    <p class="mt-1 text-sm text-gray-500">{{ urldecode(request()->query('success')) }}</p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button onclick="document.getElementById('success-notification').remove()" class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="bg-green-500 h-1 w-full"></div>
        </div>
    </div>
    @endif
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Hero Section -->
        <div class="md:w-1/2 bg-food-pattern bg-orange-600 bg-opacity-90 flex items-center justify-center p-8 text-white">
            <div class="max-w-md text-center md:text-left">
                <div class="flex justify-center md:justify-start items-center mb-6">
                    <i class="fas fa-utensils text-6xl mr-4"></i>
                    <h1 class="text-4xl font-bold">FoodHub</h1>
                </div>
                <h2 class="text-2xl font-semibold mb-4">Discover & Share Culinary Delights</h2>
                <p class="text-lg mb-8">Join our community of food enthusiasts and explore recipes from around the world.</p>
                
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-utensils text-xl mb-2"></i>
                        <p class="text-sm">Recipes</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-users text-xl mb-2"></i>
                        <p class="text-sm">Community</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-heart text-xl mb-2"></i>
                        <p class="text-sm">Favorites</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auth Form Section -->
        <div class="md:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md space-y-8">
                <!-- Logo for Mobile -->
                <div class="flex justify-center md:hidden">
                    <i class="fas fa-utensils text-5xl text-orange-500"></i>
                </div>

                <!-- Form Container -->
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800" x-text="isLogin ? 'Welcome Back' : 'Join FoodHub'"></h2>
                        <p class="text-gray-500" x-text="isLogin ? 'Sign in to your account' : 'Create your free account'"></p>
                    </div>

                    <!-- Login Form -->
                    <form x-show="isLogin" action="{{ route('login') }}" method="POST" class="space-y-5 fade-in">
                        @csrf
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input name="email" type="email" id="email" required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                   placeholder="your@email.com">
                            @if(session('email_error'))
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('email_error') }}
                            </p>
                            @endif
                        </div>

                        <!-- Password Field -->
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <a href="#" class="text-sm text-orange-500 hover:text-orange-600">Forgot password?</a>
                            </div>
                            <input name="password" type="password" id="password" required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                   placeholder="••••••••">
                            @if(session('password_error'))
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('password_error') }}
                            </p>
                            @endif
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" 
                                   class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-orange-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-orange-600 transition focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                            Sign In
                        </button>
                    </form>

                    <!-- Signup Form -->
                    <form x-show="!isLogin" action="{{ route('register') }}" method="POST" class="space-y-5 fade-in">
                        @csrf
                        <!-- Username -->
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input name="user_name" type="text" id="user_name" required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                   placeholder="chef_john">
                        </div>

                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input name="name" type="text" id="name" required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                   placeholder="John Doe">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="signup-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input name="email" type="email" id="signup-email" required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                   placeholder="your@email.com">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="signup-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input name="password" type="password" id="signup-password" required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                   placeholder="••••••••">
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" required
                                       class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-2">
                                <label for="terms" class="block text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-orange-500 hover:text-orange-600">Terms</a> and <a href="#" class="text-orange-500 hover:text-orange-600">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-orange-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-orange-600 transition focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                            Create Account
                        </button>
                    </form>

                    <!-- Social Auth -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-3 gap-3">
                            <!-- Google -->
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/>
                                </svg>
                            </a>
                            <!-- Facebook -->
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                            <!-- Twitter -->
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Toggle Link -->
                    <div class="mt-6 text-center text-sm">
                        <span class="text-gray-600" x-text="isLogin ? 'Don\'t have an account?' : 'Already have an account?'"></span>
                        <a href="#" @click.prevent="isLogin = !isLogin" class="font-medium text-orange-500 hover:text-orange-600 ml-1" x-text="isLogin ? 'Sign up' : 'Sign in'"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const notification = document.getElementById('success-notification');
            if (notification) {
                notification.classList.add('animate-fade-out');
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    </script>
</body>
</html>