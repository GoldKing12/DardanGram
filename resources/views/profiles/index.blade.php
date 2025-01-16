

<x-layout>

    <div class="profile-container" id="app">
        <div class="header">
            <div class="circular--portrait">
                <img src="{{ $user->profile->profileImage() }}" class="myImg" alt="Profile Picture" class="profile-picture">
            </div>
            <div class="profile-info">  
                <div class="user-follow">
                    <h2 class="text-3xl font-semibold text-gray-800 me-3">{{ $user->username }}</h2>

                <!-- Follow Button -->
                <follow-button 
                    user-id="{{ $user->id }}" 
                    follows="{{ $follows }}" 
                    class="px-3 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition-colors duration-300" style="margin-left: 200px;">
                </follow-button>
                </div>

                <!-- Profile Statistics -->
                <div class="stats">
                    <div><span>{{ $postCount }}</span> Posts</div>
                    <div><span>{{ $followersCount }}</span> Followers</div>
                    <div><span>{{ $followingCount }}</span> Following</div>
                </div>

                <!-- Profile Details -->
                <div class="bio">
                    <p class="fw-bold md-2">{{ $user->profile->title }}</p>
                    <p class="mb-2">{{ $user->profile->description }}</p>
                    <p><a href="{{ $user->profile->url }}" target="_blank" class="text-primary">{{ $user->profile->url }}</a></p>
                </div>

                <!-- Add Edit -->
                <div class="actions">
                    @can('update', $user->profile)
                        <a href="/p/create" class="text-center add">
                            <i class="fa-solid fa-plus"></i> Add New Post
                        </a>
                    @endcan

                    @can('update', $user->profile)
                        <a href="/profile/{{ $user->id }}/edit" class="text-center edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                        </a>
                    @endcan

                    {{-- @can('update', $user->profile)
                        <i id="gear-icon" class="fa-solid fa-gear" style="cursor: pointer;"></i>
                        <div id="dropdown-menu" class="d-none bg-white shadow-lg rounded-lg mt-2 position-absolute">
                            <ul class="list-unstyled m-0 p-2">
                                <li class="px-4 py-2 hover:bg-light cursor-pointer">
                                    @if (Auth::id() == $user->profile->user_id)
                                        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-decoration-none">Delete Profile</button>
                                        </form>
                                    @endif
                                </li>
                                <li class="px-4 py-2 hover:bg-light cursor-pointer">
                                    <a href="#" class="text-decoration-none">Settings</a>
                                </li>
                            </ul>
                        </div>
                    @endcan --}}

                        @can('update', $user->profile)
                            <i id="gear-icon" class="fa-solid fa-gear" style="cursor: pointer; font-size: 24px;"></i>
                            <div id="dropdown-menu" class="d-none bg-white shadow-lg rounded-lg mt-2 position-absolute" style="min-width: 150px;">
                                <ul class="list-unstyled m-0 p-2">
                                    <li class="px-4 py-2 hover:bg-light cursor-pointer">
                                        @if (Auth::id() == $user->profile->user_id)
                                            <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-decoration-none">Delete Profile</button>
                                            </form>
                                        @endif
                                    </li>
                                    <li class="px-4 py-2 hover:bg-light cursor-pointer">
                                        <a href="#" class="text-decoration-none">Settings</a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    
                </div>
            </div>
        </div>

        <div class="posts">
            @foreach ($user->posts as $post)
                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalShow-{{ $post->id }}" onclick="event.preventDefault()">
                    <img src="/storage/{{ $post->image }}" alt="Post Image" class="post">
                </a>

                <!-- Modal for this specific post -->
                <div class="modal fade" id="ModalShow-{{ $post->id }}" tabindex="-1" aria-labelledby="ModalShowLabel-{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="flex flex-col md:flex-row">
                                <!-- Image Section -->

                                <div class="w-full md:w-2/3">
                                    <img src="/storage/{{ $post->image }}" alt="Post Image" class="w-full h-full object-cover">
                                </div>

                                <!-- Post Details Section -->

                                <div class="w-full md:w-1/2 flex flex-col p-4">
                                    <!-- User Info -->
                                    <div class="flex items-center border-b pb-4">
                                        <div class="flex items-center">
                                            <img src="{{ $post->user->profile->profileImage() }}" alt="User Profile" class="w-12 h-12 rounded-full border-2 border-blue-500">

                                            <a href="/profile/{{ $post->user->id }}"
                                                class="ml-4 mr-1 text-gray-800 font-semibold hover:underline">
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

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>

                                    <!-- Close Button -->
                                    <div class="mt-auto">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary w-full">Close</button>
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
                                                            src="{{ $post->user->profile->profileImage() }}" 
                                                            alt="Profile Image" 
                                                            class="w-10 h-10 rounded-full border border-gray-300"
                                                        >
                                                    </div>
                                                    <!-- Comment Content -->
                                                    <div>
                                                        <p class="font-bold text-gray-800">
                                                            <a href="/profile/{{ $post->user->id }}" class="hover:underline">
                                                                {{ $post->user->username }}
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

                    <div class="col-12 text-end mb-3">
                        @if (Auth::id() == $post->user_id)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete Post</button>
                            </form>
                        @endif
                    </div>
                </div>

            @endforeach
        </div>
    </div>

    <div id="myModal" class="modal1 fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
        <span class="close absolute top-5 text-white text-3xl cursor-pointer">&times;</span>

        <img id="img01" class="content-content1 max-w-full rounded-lg border-4 shadow-lg">
    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function() {
            const gearIcon = document.getElementById('gear-icon');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if(gearIcon && dropdownMenu) {
                gearIcon.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('d-none');
                    dropdownMenu.classList.toggle('show');
                    this.classList.toggle('rotated');
                });

                document.addEventListener('click', function(event) {
                    if(!gearIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.toggle('d-none');
                        dropdownMenu.classList.remove('show');
                        gearIcon.classList.remove('rotated');
                    }
                })
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('myModal');
            const modalImg = document.getElementById('img01');
            const captionText = document.getElementById('caption');
            
            document.querySelectorAll('.myImg').forEach(img => {
                img.addEventListener('click', function() {
                    modal.style.display = 'block';
                    modalImg.src = this.src;
                    captionText.innerHtml = this.alt;
                });
            });

            const span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = 'none';
            }
        })

    </script>
</x-layout> 