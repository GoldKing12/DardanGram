<x-layout>
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <!-- Search Header -->

        <!-- Search Form -->
        <form action="{{ route('profile.search') }}" method="GET" class="flex items-center md:items-start justify-center md:justify-start space-x-2 mb-8">
            <input 
                type="text" 
                name="search" 
                placeholder="Search Profiles" 
                value="{{ $search }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none"
            >
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Search
            </button>
        </form>

        <!-- Results Section -->
        @if($results->isEmpty())
            <p class="text-gray-600 text-lg">
                No profiles found matching "<span class="font-semibold">{{ $search }}</span>".
            </p>
        @else
            <ul class="space-y-6">
                @foreach ($results as $result)
                    <li class="flex items-center space-x-4 p-4 bg-white shadow-md rounded-lg hover:shadow-lg transition">
                        <a href="{{ route('profile.index', ['user' => $result->user->id]) }}" class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <img 
                                src="{{ $result->profileImage() }}" 
                                alt="Profile Image" 
                                class="w-16 h-16 rounded-full object-cover border border-gray-300"
                            >
                            <!-- Profile Info -->
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">
                                    {{ $result->user->username }}
                                </h2>
                                <p class="text-gray-500 text-sm">
                                    {{ $result->title }}
                                </p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>
