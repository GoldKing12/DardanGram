<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>DardanGram</title>
            <link rel="icon" href="{{ asset('instagram-logo.png') }}">

            <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

            <!-- Bootstrap CSS -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

            <!-- Bootstrap JS and jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])

            <script src="https://kit.fontawesome.com/87e420d556.js" crossorigin="anonymous"></script>

        </head>
    <body class="font-sans">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="sidebar bg-gray-100 w-64 shadow-lg fixed h-full flex flex-col py-6 px-1 space-y-8">
                <a href="{{ route('posts.index') }}" class="text-center block font-semibold text-gray-800" style="font-size: 1.6rem; font-family: cursive">
                    DardanGram
                </a>

                @guest
                    @if (Route::has('login'))
                        <a class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white px-4 py-2 rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif

                    @if (Route::has('register'))
                        <a class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white px-4 py-2 rounded" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else            
                    <a href="{{ route('posts.index') }}" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-house mr-2"></i> Home
                    </a>
                    <a href="{{ route('profile.search') }}" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Search
                    </a>
                    <a href="{{ url('/notifications') }}" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-heart mr-2"></i> Notifications
                    </a>
                    <a href="#" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-message mr-2"></i> Messages
                    </a>
                    <a href="{{ route('posts.create') }}" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-plus mr-2"></i> Add New Post
                    </a>
                    <a href="{{ url('/profile/' . auth()->user()->id) }}" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-user mr-2"></i> Profile
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-gray-800 hover:bg-blue-500 hover:text-white flex items-center px-4 py-2 rounded">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>

            <main class="ml-64 flex-1 p-8">
                <div class="posts-container">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
