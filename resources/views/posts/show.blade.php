

<x-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
        @if($user->posts->count() > 0)
            @foreach ($user->posts as $post)
                <div class="relative group">
                    <!-- Clickable Post Image -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalShow-{{ $post->id }}" class="w-full">
                        <img src="/storage/{{ $post->image }}" alt="Post Image"
                            class="w-full h-full object-cover rounded-lg shadow-lg group-hover:scale-105 transition-all duration-300">
                    </button>
                </div>
    
                <!-- Modal for this specific post -->
                <div id="ModalShow-{{ $post->id }}" class="modal fade" tabindex="-1" aria-labelledby="ModalShowLabel-{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalShowLabel-{{ $post->id }}">Post Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Post Image -->
                                <img src="/storage/{{ $post->image }}" class="w-full rounded" alt="Post Image">
    
                                <!-- Post Details -->
                                <p class="mt-4">{{ $post->caption }}</p>
                                <p>Posted by: 
                                    <a href="/profile/{{ $post->user->id }}" class="text-blue-600">
                                        {{ $post->user->username }}
                                    </a>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No posts available.</p>
        @endif
    </div>
</x-layout>
