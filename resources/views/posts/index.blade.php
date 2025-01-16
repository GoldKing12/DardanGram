
<x-layout>
    <div id="app" class="container mx-auto py-8 flex justify-center" style="position: relative; left: 200px;">
        <div class="w-full max-w-3xl flex flex-col gap-6">
            @foreach ($posts as $post)
                <div class="bg-white shadow rounded-lg p-4">
                    <!-- User Info -->
                    <div class="flex items-center justify-between border-b pb-4 mb-4">
                        <div class="flex items-center">
                            <img src="{{ $post->user->profile->profileImage() }}" alt="User Profile" class="w-12 h-12 rounded-full border-2 border-blue-500">
                            <a href="/profile/{{ $post->user->id }}" class="ml-4 text-gray-800 font-semibold hover:underline">
                                {{ $post->user->username }}
                            </a>
                        </div>
                        <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}" class="text-blue-500 font-semibold hover:text-blue-700 transition-colors"></follow-button>
                    </div>
    
                    <!-- Post Image -->
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalShow-{{ $post->id }}" onclick="event.preventDefault();">
                            <img src="/storage/{{ $post->image }}" alt="Post Image" class="w-full object-cover rounded-lg">
                        </a>
                    </div>
    
                    <!-- Caption -->
                    <div class="flex space-x-8 mb-6 mt-4">
                        <p>
                            <a href="/profile/{{ $post->user->id }}" class="font-bold text-gray-800 hover:underline">
                                {{ $post->user->username }}
                            </a>
                            {{ $post->caption }}
                        </p>

                        <div class="flex justify-end" style="margin-left: 300px;">
                            <button 
                                class="like-button flex items-center gap-2" 
                                data-post-id="{{ $post->id }}" 
                                data-liked="{{ $post->likes->isNotEmpty() ? 'true' : 'false' }}"
                            >
                                <i class="{{ $post->likes->isNotEmpty() ? 'fa-solid text-red-500' : 'fa-regular' }} fa-heart"></i>
                                <span class="like-count">{{ $post->likes->count() }}</span> Like
                            </button>
                        </div>
                    </div>

                    <!-- Comment -->
                    <div class="flex flex-col space-y-4">
                        <!-- Add Comment Form -->
                        <form action="{{ route('comments.store') }}" method="POST" class="flex flex-col gap-4 bg-gray-100 p-4 rounded-lg">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea 
                                name="content" 
                                rows="3" 
                                class="border border-gray-300 rounded-lg p-2 resize-none focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Add a comment..." 
                                required></textarea>
                            <button 
                                type="submit" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                Post Comment
                            </button>
                        </form>
                    
                        <!-- Display Comments -->
                        {{-- <div class="space-y-4 overflow-y-auto max-h-64">
                            @foreach ($post->comments as $comment)
                                <div class="bg-gray-50 border border-gray-200 p-4 rounded-lg">
                                    <div class="flex items-center gap-4 mb-2">
                                        <img 
                                            src="{{ $comment->post->user->profile->profileImage() }}" 
                                            alt="User Profile" 
                                            class="w-10 h-10 rounded-full border border-gray-300">
                                            <a href="/profile/{{ $comment->user->id }}" class="font-bold text-gray-800 hover:underline">
                                                {{ $comment->user->username }}
                                            </a>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div> --}}

                        <div class="space-y-4 overflow-y-auto max-h-64">
                            @foreach ($post->comments as $comment)
                                <div class="bg-gray-50 border border-gray-200 p-4 rounded-lg">
                                    <div class="flex items-center gap-4 mb-2">
                                        <img 
                                            src="{{ $comment->user->profile->profileImage() }}" 
                                            alt="User Profile" 
                                            class="w-10 h-10 rounded-full border border-gray-300">
                                        <a href="/profile/{{ $comment->user->id }}" class="font-bold text-gray-800 hover:underline">
                                            {{ $comment->user->username }}
                                        </a>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                    
                </div>
    
                <!-- Modal for the post -->
                <div class="modal fade" id="ModalShow-{{ $post->id }}" tabindex="-1" aria-labelledby="ModalShowLabel-{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="flex flex-col md:flex-row">
                                <!-- Image Section -->
                                <div class="w-full md:w-2/3">
                                    <img src="/storage/{{ $post->image }}" alt="Post Image" class="w-full h-full object-cover">
                                </div>

                                <!-- Post Details Section -->
                                <div class="w-full md:w-1/3 flex flex-col p-4">
                                    <!-- User Info -->
                                    <div class="flex items-center justify-between border-b pb-4">
                                        <div class="flex items-center">
                                            <img src="{{ $post->user->profile->profileImage() }}" alt="User Profile" class="w-12 h-12 rounded-full border-2 border-blue-500">
                                            <a href="/profile/{{ $post->user->id }}" class="ml-4 text-gray-800 font-semibold hover:underline">
                                                {{ $post->user->username }}
                                            </a>
                                        </div>
                                        <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}" class="text-blue-500 font-semibold hover:text-blue-700 transition-colors"></follow-button>
                                    </div>

                                    <!-- Caption -->
                                    <div class="mt-4 flex-1">
                                        <p>
                                            <a href="/profile/{{ $post->user->id }}" class="font-bold text-gray-800 hover:underline">
                                                {{ $post->user->username }}
                                            </a>
                                            {{ $post->caption }}
                                        </p>
                                    </div>

                                    <!-- Close Button -->
                                    <div class="mt-auto">
                                        <button type="button" class="btn btn-secondary w-full" data-bs-dismiss="modal">Close</button>
                                    </div>

                                    <!-- Comment Part -->
                                    <div class="mt-4">
                                        <h3 class="text-lg font-semibold mb-2">Comments</h3>
                                        <div class="space-y-4 overflow-y-auto max-h-64">
                                            @foreach ($post->comments as $comment)
                                                <div class="flex items-start gap-4">
                                                    <!-- User Info -->
                                                    <div class="w-10 h-10">
                                                        <img 
                                                            src="{{ $comment->user->profile->profileImage() }}" 
                                                            alt="Profile Image" 
                                                            class="w-10 h-10 rounded-full border border-gray-300"
                                                        >
                                                    </div>
                                                    <!-- Comment Content -->
                                                    <div>
                                                        <p class="font-bold text-gray-800">
                                                            <a href="/profile/{{ $comment->user->id }}" class="hover:underline">
                                                                {{ $comment->user->username }}
                                                            </a>
                                                        </p>
                                                        <p class="text-gray-700">
                                                            {{ $comment->content }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        <script>

            document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.like-button').forEach(button => {
                const icon = button.querySelector('i');
                const isLiked = button.getAttribute('data-liked') === 'true';

                // Set initial state of the heart icon
                if (isLiked) {
                    icon.classList.add('fa-solid', 'text-red-500');
                    icon.classList.remove('fa-regular');
                } else {
                    icon.classList.add('fa-regular');
                    icon.classList.remove('fa-solid', 'text-red-500');
                }

                button.addEventListener('click', async () => {
                    const postId = button.getAttribute('data-post-id');
                    const likeCount = button.querySelector('.like-count');

                    try {
                        const response = await fetch(`/posts/${postId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                        });

                        if (response.ok) {
                            const data = await response.json();

                            // Update like count
                            // likeCount.textContent = data.liked
                            //     ? parseInt(likeCount.textContent) + 1
                            //     : parseInt(likeCount.textContent) - 1;

                            likeCount.textContent = data.likeCount;

                            // Toggle heart icon
                            if (data.liked) {
                                icon.classList.remove('fa-regular');
                                icon.classList.add('fa-solid', 'text-red-500');
                                button.setAttribute('data-liked', 'true');
                            } else {
                                icon.classList.remove('fa-solid', 'text-red-500');
                                icon.classList.add('fa-regular');
                                button.setAttribute('data-liked', 'false');
                            }
                        } else {
                            console.error('Failed to like the post.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        </script>
</x-layout>
