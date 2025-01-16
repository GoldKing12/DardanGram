<x-layout>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-50" style="margin-left: 300px">
        <div class="container mx-auto px-4 py-12">
            <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST" 
                class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8 space-y-8">
                @csrf
                @method('PATCH')

                <!-- Page Title -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">Edit Profile</h1>
                    <p class="text-gray-500 mt-2">Update your details and make your profile stand out.</p>
                </div>

                <!-- Title Field -->
                <div class="space-y-2">
                    <label for="title" class="block text-lg font-semibold text-gray-700">Title</label>
                    <input type="text" id="title" name="title" 
                        class="block w-full px-5 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('title') ? 'border-red-500' : '' }}" 
                        value="{{ old('title') ?? $user->profile->title }}" autocomplete="title">
                    
                    @if ($errors->has('title'))
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('title') }}
                        </span>
                    @endif
                </div>

                <!-- Description Field -->
                <div class="space-y-2">
                    <label for="description" class="block text-lg font-semibold text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block w-full px-5 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('description') ? 'border-red-500' : '' }}" 
                        >{{ old('description') ?? $user->profile->description }}</textarea>

                    @if ($errors->has('description'))
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('description') }}
                        </span>
                    @endif
                </div>

                <!-- URL Field -->
                <div class="space-y-2">
                    <label for="url" class="block text-lg font-semibold text-gray-700">Website or URL</label>
                    <input type="url" id="url" name="url"
                        class="block w-full px-5 py-3 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('url') ? 'border-red-500' : '' }}" 
                        value="{{ old('url') ?? $user->profile->url }}" autocomplete="url">

                    @if ($errors->has('url'))
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('url') }}
                        </span>
                    @endif
                </div>

                <!-- Profile Image Upload -->
                <div class="space-y-2">
                    <label for="image" class="block text-lg font-semibold text-gray-700">Profile Image</label>
                    <input type="file" id="image" name="image" 
                        class="block w-full text-lg text-gray-500 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    
                    @if ($errors->has('image'))
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('image') }}
                        </span>
                    @endif
                </div>

                <!-- Save Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3 px-6 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-lg font-bold rounded-lg shadow-md hover:from-indigo-600 hover:to-purple-600 focus:ring-4 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
