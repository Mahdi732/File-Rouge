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
        @if (!Auth::check())
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <!-- Icon -->
            <div class="mx-auto w-20 h-20 mb-6 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            
            <!-- Message -->
            <h3 class="text-xl font-medium text-gray-700 mb-3">Welcome to CookNShare!</h3>
            <p class="text-gray-500 mb-6">
                Join our community of food lovers! Sign in to view posts, share recipes, and connect with other foodies.
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{route('login.auth')}}" class="px-6 py-2 bg-spice text-white rounded-lg font-medium hover:bg-opacity-90 transition flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Sign In
                </a>
                <a href="{{route('login.auth')}}" class="px-6 py-2 border border-spice text-spice rounded-lg font-medium hover:bg-cream transition flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Create Account
                </a>
            </div>
            
            <!-- Optional Guest Option -->
            <div class="mt-6 text-sm">
                <p class="text-gray-500 mb-2">Just want to browse?</p>
            </div>
        </div>
        @endif
        
        @if (Auth::check())
        @if ($posts->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                <!-- Illustration -->
                <div class="w-48 h-48 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <!-- Message -->
                <h3 class="text-xl font-medium text-gray-700 mb-2">No posts yet</h3>
                <p class="text-gray-500 max-w-md mb-6">
                    It looks quiet here! Be the first to share something amazing with the community.
                </p>
            </div>
        @endif
        @foreach ($posts as $post)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <!-- Header (common to all post types) -->
            <div class="flex items-center p-4">
                <img src="{{ asset('storage/' . $post->profile_picture)  ?? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" }}" 
                    class="w-8 h-8 rounded-full object-cover border border-spice mr-3">
                <div class="flex-1 font-semibold">{{ '@' . $post->user_name }}</div>
                <button class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>
            </div>
            
            <!-- Content (conditional based on post type) -->
            @if($post->video)
                <!-- Video Content -->
                <div class="relative bg-black">
                    <video controls class="w-full" style="max-height: 600px;">
                        <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            @if($post->picture)
                <!-- Image Content -->
                <img src="{{ asset('storage/' . $post->picture ) }}" 
                    class="w-full object-cover" style="max-height: 600px;">
            @endif
            
            
            <!-- Footer (common to all post types) -->
            <div class="border-t border-gray-100 px-4 pt-3 pb-2">
                <div class="flex space-x-4 mb-2">
                    <button class="text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </button>
                </div>
                
                <div class="mb-1">
                    <span class="font-semibold">{{ '@' . $post->user_name }}</span> {{ $post->description ?? 'hahhaha' }}
                </div>
                <div class="text-xs text-gray-500 mb-2">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
                
                <div class="flex items-center border-t border-gray-100 pt-3">
                    <input type="text" placeholder="Add a comment..." class="flex-1 text-sm outline-none bg-transparent">
                    <button class="text-spice font-semibold text-sm ml-2">Post</button>
                </div>
            </div>
        </div>
        @endforeach
        @endif
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
                
                        <div class="p-4 border-t flex justify-end">
                            <button 
                                @click="openComposer = false"
                                class="px-4 py-2 border rounded-lg font-medium mr-2 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                :class="{ 'bg-spice': canSubmit, 'bg-gray-300 cursor-not-allowed': !canSubmit }"
                                class="px-4 py-2 rounded-lg font-medium text-white">
                                Share
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Photo Post Form -->
                <div x-show="activeTab === 'photo'" x-transition>
                    <form 
                    action="{{ route('post.create.media') }}" 
                    method="post"
                    enctype="multipart/form-data">
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
                        
                        <div class="p-4 border-t flex justify-end">
                            <button 
                                @click="openComposer = false"
                                class="px-4 py-2 border rounded-lg font-medium mr-2 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                :class="{ 'bg-spice': canSubmit, 'bg-gray-300 cursor-not-allowed': !canSubmit }"
                                class="px-4 py-2 rounded-lg font-medium text-white">
                                Share
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Video Post Form -->
                <div x-show="activeTab === 'video'" x-transition>
                    <form 
                    action="{{ route('post.create.media') }}" 
                    method="post"
                    enctype="multipart/form-data">
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
                        
                        <div class="p-4 border-t flex justify-end">
                            <button 
                                @click="openComposer = false"
                                class="px-4 py-2 border rounded-lg font-medium mr-2 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                :class="{ 'bg-spice': canSubmit, 'bg-gray-300 cursor-not-allowed': !canSubmit }"
                                class="px-4 py-2 rounded-lg font-medium text-white">
                                Share
                            </button>
                        </div>
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