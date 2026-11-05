<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DardanGram</title>
    <link rel="icon" href="{{ asset('instagram-logo.png') }}">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
     <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
</head>
<body class="bg-gradient-to-b from-gray-900 to-black text-white">

    <div class="container mx-auto flex flex-col items-center justify-center min-h-screen px-8">
        
        <h1 class="fade-in-color text-4xl md:text-6xl font-bold py-20">
            Welcome to DardanGram
        </h1>

        
        <div class="text-center">
            <p class="text-lg md:text-xl text-gray-300 mb-8">
                Discover and share your favorite photos with the world.
            </p>
            
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('login') }}" 
                   class="btn-primary px-6 py-3 text-lg font-semibold rounded-lg hover:bg-blue-600 transition">
                    Log In
                </a>
                <a href="{{ route('register') }}" 
                   class="btn-secondary px-6 py-3 text-lg font-semibold rounded-lg hover:bg-green-600 transition">
                    Sign Up
                </a>
            </div>
        </div>

        
        <footer class="mt-16 text-center">
            <p class="text-lg text-gray-500">
                DardanGram &copy; {{ date('Y') }}. All rights reserved.
            </p>
        </footer>
    </div>

</body>
</html>

