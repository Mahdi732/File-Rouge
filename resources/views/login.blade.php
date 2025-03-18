<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHub Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@1.8.4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <style>
        .bg-food-pattern {
            background-image: url('/api/placeholder/1024/768');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        .float-delay {
            animation: float 6s ease-in-out 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen">
<div class="min-h-screen flex flex-col md:flex-row">
    <!-- Left Side - Food Background -->
    <div class="md:w-1/2 bg-food-pattern bg-orange-500 bg-opacity-90 flex flex-col justify-center items-center p-8 text-white">
        <div class="max-w-md">
            <div class="float">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold mb-4">FoodHub</h1>
            <p class="text-xl mb-6">Discover culinary delights from around the world, all at your fingertips.</p>
            <div class="float-delay">
                <div class="flex space-x-4 mb-8">
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="mt-2">Order Online</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2">Fast Delivery</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <p class="mt-2">Premium Quality</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="md:w-1/2 flex items-center justify-center p-8 bg-white" x-data="{ isLogin: true, isAnimating: false }">
        <div class="max-w-md w-full" :class="{ 'opacity-0': isAnimating }">
            <!-- Logo for Mobile -->
            <div class="md:hidden flex justify-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold mb-2" x-text="isLogin ? 'Welcome Back' : 'Create Account'"></h2>
                <p class="text-gray-600" x-text="isLogin ? 'Enter your credentials to access your account' : 'Join our culinary community today'"></p>
            </div>

            <!-- Login Form -->
            <div x-show="isLogin">
                <form action="{{ route('login')}}" method="POST" >
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email Address</label>
                        <input name="email" type="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:outline-none transition-colors" placeholder="your@email.com">
                        @if(session('email_error'))
                        <div class="mt-2 bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-r-lg">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>{{ session('email_error') }}</span>
                            </div>
                        </div>
                    @endif
                    </div>
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-gray-700 text-sm font-bold" for="password">Password</label>
                            <a href="#" class="text-sm text-orange-500 hover:text-orange-600">Forgot Password?</a>
                        </div>
                        <input name="password" type="password" id="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:outline-none transition-colors" placeholder="••••••••">
                        @if(session('password_error'))
                            <div class="mt-2 bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-r-lg">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>{{ session('password_error') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-orange-500">
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition-colors transform hover:scale-105 duration-200">
                        Sign In
                    </button>
                </form>
            </div>

            <!-- Sign Up Form -->
            <div x-show="!isLogin">
                <form action="{{ route('register')}}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fullname">User Name</label>
                        <input name="user_name" type="text" id="fullname" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:outline-none transition-colors" placeholder="John Doe">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fullname">Full Name</label>
                        <input name="name" type="text" id="fullname" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:outline-none transition-colors" placeholder="John Doe">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="signup-email">Email Address</label>
                        <input name="email" type="email" id="signup-email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:outline-none transition-colors" placeholder="your@email.com">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="signup-password">Create Password</label>
                        <input name="password" type="password" id="signup-password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-orange-500 focus:outline-none transition-colors" placeholder="••••••••">
                    </div>
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-orange-500">
                            <span class="ml-2 text-gray-700">I agree to the <a href="#" class="text-orange-500">Terms of Service</a> and <a href="#" class="text-orange-500">Privacy Policy</a></span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600 transition-colors transform hover:scale-105 duration-200">
                        Create Account
                    </button>
                </form>
            </div>

            <!-- Social Login -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <button class="py-2 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 flex justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                    </button>
                    <button class="py-2 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 flex justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </button>
                    <button class="py-2 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 flex justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Toggle Between Login/Signup -->
            <div class="text-center mt-8">
                <p class="text-gray-600">
                    <span x-text="isLogin ? 'Don\'t have an account?' : 'Already have an account?'"></span>
                    <a href="#" class="text-orange-500 font-bold hover:text-orange-600" @click.prevent="isAnimating = true; setTimeout(() => { isLogin = !isLogin; isAnimating = false; }, 300)">
                        <span x-text="isLogin ? 'Sign Up' : 'Sign In'"></span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
