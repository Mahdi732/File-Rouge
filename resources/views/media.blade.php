<!DOCTYPE html>
<html lang="en" x-data="app()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlavorFeed | Share Your Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FFF9F0',
                        mint: '#E6F7F2',
                        spice: '#FF6B35',
                        herb: '#4CAF50',
                        chili: '#FF5252',
                        eggyolk: '#FFC107',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.2);
            border-radius: 3px;
        }
    </style>
</head>
    @if (View::exists('partial.nav'))
    @include('partial.nav')
    @endif
<body class="bg-gray-50 font-sans text-gray-900" x-cloak>
    <!-- Main Feed -->
    <div class="max-w-lg mx-auto pb-20">
        <!-- Text Post -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <!-- Header -->
            <div class="flex items-center p-4">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" 
                     class="w-8 h-8 rounded-full object-cover border border-spice mr-3">
                <div class="flex-1 font-semibold">chef_michael</div>
                <button class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <div class="px-4 pb-3 whitespace-pre-line">
                Just discovered this amazing flavor combination for pasta! 
                
                Ingredients:
                - 2 cups penne pasta
                - 1/2 cup sun-dried tomatoes
                - 3 cloves garlic
                - 1/4 cup olive oil
                - Fresh basil
                
                Cook the pasta al dente, sauté the garlic in olive oil, add chopped sun-dried tomatoes, then toss with pasta and fresh basil. So simple but so delicious!
            </div>
            
            <!-- Footer -->
            <div class="border-t border-gray-100 px-4 pt-3 pb-2">
                <div class="flex space-x-4 mb-2">
                    <button class="text-gray-500 hover:text-red-400 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>
                    <button class="ml-auto text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </button>
                </div>
                
                <div class="text-sm font-semibold mb-1">243 likes</div>
                <div class="text-xs text-gray-500 mb-2">2 hours ago</div>
                
                <div class="flex items-center border-t border-gray-100 pt-3">
                    <input type="text" placeholder="Add a comment..." class="flex-1 text-sm outline-none bg-transparent">
                    <button class="text-spice font-semibold text-sm ml-2">Post</button>
                </div>
            </div>
        </div>
        
        <!-- Image Post -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <!-- Header -->
            <div class="flex items-center p-4">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100" 
                     class="w-8 h-8 rounded-full object-cover border border-spice mr-3">
                <div class="flex-1 font-semibold">baking_queen</div>
                <button class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>
            </div>
            
            <!-- Content -->
            <img src="https://media.timeout.com/images/106162401/image.jpg" 
                 class="w-full object-cover" style="max-height: 600px;">
            
            <div class="border-t border-gray-100 px-4 pt-3 pb-2">
                <div class="flex space-x-4 mb-2">
                    <button class="text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>
                    <button class="ml-auto text-spice">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </button>
                </div>
                
                <div class="text-sm font-semibold mb-1">892 likes</div>
                <div class="mb-1">
                    <span class="font-semibold">baking_queen</span> Moist vegan banana bread that even non-vegans love! Recipe in comments 👇
                </div>
                <div class="flex flex-wrap gap-1 mb-1">
                    <span class="text-xs px-2 py-1 rounded-full bg-herb text-white">#vegan</span>
                    <span class="text-xs px-2 py-1 rounded-full bg-eggyolk">#baking</span>
                    <span class="text-xs px-2 py-1 rounded-full bg-mint text-gray-800">#dessert</span>
                </div>
                <div class="text-xs text-gray-500 mb-2">5 hours ago</div>
                
                <div class="flex items-center border-t border-gray-100 pt-3">
                    <input type="text" placeholder="Add a comment..." class="flex-1 text-sm outline-none bg-transparent">
                    <button class="text-spice font-semibold text-sm ml-2">Post</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button 
        @click="openComposer = true"
        class="fixed bottom-6 right-6 w-14 h-14 rounded-full bg-spice text-white flex items-center justify-center shadow-lg hover:shadow-xl transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>

    <!-- Post Composer Modal -->
    <div 
        x-show="openComposer" 
        @click.away="openComposer = false"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        
        <div class="bg-white rounded-lg w-full max-w-md overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="font-semibold text-lg">Create New Post</h3>
                <button @click="openComposer = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Tabs -->
            <div class="flex border-b">
                <button 
                    @click="activeTab = 'text'"
                    :class="{ 'border-b-2 border-spice text-spice': activeTab === 'text', 'text-gray-500': activeTab !== 'text' }"
                    class="flex-1 py-3 font-medium text-center">
                    Text
                </button>
                <button 
                    @click="activeTab = 'photo'"
                    :class="{ 'border-b-2 border-spice text-spice': activeTab === 'photo', 'text-gray-500': activeTab !== 'photo' }"
                    class="flex-1 py-3 font-medium text-center">
                    Photo
                </button>
                <button 
                    @click="activeTab = 'video'"
                    :class="{ 'border-b-2 border-spice text-spice': activeTab === 'video', 'text-gray-500': activeTab !== 'video' }"
                    class="flex-1 py-3 font-medium text-center">
                    Video
                </button>
            </div>
            
            <!-- Content -->
            <div class="p-4">
                <!-- Text Post Form -->
                <div x-show="activeTab === 'text'" x-transition>
                    <form action="{{ route('post.create.media') }}" method="post">
                        @csrf
                        <textarea 
                        name="description"
                        x-model="textPost.content"
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-spice focus:border-transparent" 
                        rows="6"
                        placeholder="Share your recipe or cooking tip..."></textarea>
                    </form>
                </div>
                
                <!-- Photo Post Form -->
                <div x-show="activeTab === 'photo'" x-transition>
                    <form action="{{ route('post.create.media') }}" method="post">
                        @csrf
                        <div 
                            @click="document.getElementById('photo-upload').click()"
                            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-spice transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500">Click to upload a photo</p>
                            <input name="picture" type="file" id="photo-upload" class="hidden" accept="image/*">
                        </div>
                        
                        <template x-if="photoPost.preview">
                            <div class="mt-4">
                                <img :src="photoPost.preview" class="w-full rounded-lg border border-gray-200">
                            </div>
                        </template>
                        
                        <textarea 
                            name="description"
                            x-model="photoPost.caption"
                            class="w-full p-3 border rounded-lg mt-4 focus:ring-2 focus:ring-spice focus:border-transparent" 
                            rows="3"
                            placeholder="Add a caption..."></textarea>
                    </form>
                </div>
                
                <!-- Video Post Form -->
                <div x-show="activeTab === 'video'" x-transition>
                    <form action="{{ route('post.create.media') }}" method="post">
                        @csrf
                        <div 
                            @click="document.getElementById('video-upload').click()"
                            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-spice transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500">Click to upload a video</p>
                            <input name="video" type="file" id="video-upload" class="hidden" accept="video/*">
                        </div>
                        
                        <textarea 
                            name="description"
                            x-model="videoPost.caption"
                            class="w-full p-3 border rounded-lg mt-4 focus:ring-2 focus:ring-spice focus:border-transparent" 
                            rows="3"
                            placeholder="Add a description..."></textarea>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                openComposer: false,
                activeTab: 'text',
                
                textPost: {
                    content: '',
                    tags: [],
                    newTag: ''
                },
                
                photoPost: {
                    preview: null,
                    caption: ''
                },
                
                videoPost: {
                    caption: ''
                },
                
                get canSubmit() {
                    if (this.activeTab === 'text') {
                        return this.textPost.content.trim().length > 0;
                    } else if (this.activeTab === 'photo') {
                        return this.photoPost.preview !== null;
                    } else if (this.activeTab === 'video') {
                        return this.videoPost.caption.trim().length > 0;
                    }
                    return false;
                },
                
                init() {
                    document.getElementById('photo-upload').addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            this.photoPost.preview = URL.createObjectURL(file);
                        }
                    });
                    
                    document.getElementById('video-upload').addEventListener('change', (e) => {
                        console.log('Video selected:', e.target.files[0]);
                    });
                },
                
            }));
        });
    </script>
</body>
</html>