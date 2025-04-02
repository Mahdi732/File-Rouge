<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Secure Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-reverse': 'float-reverse 5s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        'float-reverse': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(20px)' },
                        },
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-gray-900 min-h-screen flex items-center justify-center p-4">
    <!-- Decorative elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-purple-500 rounded-full opacity-20 blur-xl animate-float"></div>
        <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-indigo-500 rounded-full opacity-20 blur-xl animate-float-reverse"></div>
        <div class="absolute bottom-1/4 right-1/3 w-20 h-20 bg-blue-500 rounded-full opacity-20 blur-xl animate-float"></div>
    </div>

    <!-- Main login card -->
    <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden w-full max-w-md z-10 border border-white/20">
        <!-- Glow effect -->
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-purple-500 rounded-full opacity-20 blur-3xl"></div>
        
        <!-- Header -->
        <div class="p-8 text-center">
            <div class="flex justify-center mb-6">
                <div class="bg-white/20 p-4 rounded-2xl shadow-lg">
                    <i class="fas fa-lock text-white text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Portal</h1>
            <p class="text-white/70">Enter your credentials to access the dashboard</p>
        </div>

        <!-- Login form -->
        <form class="px-8 pb-8">
            <div class="mb-6">
                <label for="email" class="block text-white/80 text-sm font-medium mb-2">Admin Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-white/50"></i>
                    </div>
                    <input type="email" id="email" class="bg-white/5 border border-white/10 text-white rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent block w-full pl-10 p-3 placeholder-white/30" placeholder="admin@example.com" required>
                </div>
            </div>
            <div class="mb-8">
                <label for="password" class="block text-white/80 text-sm font-medium mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-key text-white/50"></i>
                    </div>
                    <input type="password" id="password" class="bg-white/5 border border-white/10 text-white rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent block w-full pl-10 p-3 placeholder-white/30" placeholder="••••••••" required>
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-eye-slash text-white/50 hover:text-white/80 cursor-pointer"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input id="remember" type="checkbox" class="w-4 h-4 bg-white/5 border-white/10 rounded focus:ring-purple-500">
                    <label for="remember" class="ml-2 text-sm text-white/70">Remember me</label>
                </div>
                <a href="#" class="text-sm text-purple-300 hover:text-purple-200">Forgot password?</a>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium py-3 px-4 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-purple-500/20">
                Sign In <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>

        <!-- Footer -->
        <div class="bg-white/5 py-4 text-center">
            <p class="text-white/50 text-sm">© 2023 Admin Portal. All rights reserved.</p>
        </div>
    </div>

    <!-- Security badge -->
    <div class="fixed bottom-6 right-6 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full text-xs text-white/80 border border-white/10 flex items-center">
        <i class="fas fa-shield-alt text-green-400 mr-2"></i>
        <span>Secure Connection</span>
    </div>

    <script>
        // Toggle password visibility
        document.querySelector('.fa-eye-slash').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this;
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>
</html>