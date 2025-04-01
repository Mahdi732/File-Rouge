<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Lost in the Digital Jungle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Urbanist', sans-serif;
            background-color: #0a0a0a;
        }
        .glow-text {
            text-shadow: 0 0 8px rgba(74, 222, 128, 0.7);
        }
        .video-container {
            box-shadow: 0 0 30px rgba(74, 222, 128, 0.3);
        }
        .pixel-corners {
            clip-path: polygon(
                0% 8px, 8px 8px, 8px 0%, calc(100% - 8px) 0%, 
                calc(100% - 8px) 8px, 100% 8px, 100% calc(100% - 8px), 
                calc(100% - 8px) calc(100% - 8px), calc(100% - 8px) 100%, 
                8px 100%, 8px calc(100% - 8px), 0% calc(100% - 8px)
            );
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4 bg-gradient-to-br from-gray-900 to-black text-gray-100">
    <div class="max-w-4xl w-full text-center space-y-10">
        <!-- Header with Dino and Frog -->
        <div class="flex justify-center items-center space-x-6">
            <div class="text-5xl opacity-80">🦖</div>
            <h1 class="text-6xl font-black tracking-tighter">
                <span class="glow-text text-green-400">404</span>
                <span class="text-gray-300 mx-2">|</span>
                <span class="text-blue-400">PAGE NOT FOUND</span>
            </h1>
            <div class="text-5xl opacity-80">🐸</div>
        </div>
        
        <!-- Video Container -->
        <div class="video-container pixel-corners rounded-lg overflow-hidden bg-gray-800 transform transition-all duration-500 hover:scale-[1.01]">
            <div class="aspect-w-16 aspect-h-9 flex items-center justify-center">
                <video autoplay muted loop playsinline class="w-full">
                    <source src="{{ asset('picture/404.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
        
        <!-- Meme Caption -->
        <div class="bg-gray-800 bg-opacity-70 p-5 rounded-lg border-l-2 border-green-400">
            <p class="text-xl font-bold">
                <span class="text-green-400">"9ta3 lay ydir chi 7mar,</span>
                <span class="text-blue-400">7ayed 3liya."</span>
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 pt-8">
            <a href="/" class="btn-hover px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-md shadow-lg flex items-center space-x-2">
                <span>🏠</span>
                <span>Return Home</span>
            </a>
            <a href="#" class="btn-hover px-6 py-3 bg-gray-700 hover:bg-gray-600 text-gray-100 font-bold rounded-md shadow-lg flex items-center space-x-2">
                <span>🦴</span>
                <span>Explore Fossils</span>
            </a>
            <a href="#" class="btn-hover px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-md shadow-lg flex items-center space-x-2">
                <span>🐸</span>
                <span>Ribbit Report</span>
            </a>
        </div>
        
        <!-- Footer Meme -->
        <div class="pt-12 opacity-70">
            <p class="text-sm text-gray-400">Meanwhile, in the server logs...</p>
            <div class="flex justify-center mt-3">
                <span class="text-xl">🦖💻🐸</span>
            </div>
        </div>
    </div>
</body>
</html>