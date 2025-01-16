
        
<x-layout>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100" style="margin-left: 250px">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl p-10">
            <form action="/p" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="space-y-10">
                    <!-- Form Title -->
                    <div class="text-center">
                        <h1 class="text-4xl font-extrabold text-gray-800">Create a Post</h1>
                        <p class="text-lg text-gray-600 mt-2">Share your favorite moments with the world</p>
                    </div>
    
                    <!-- Caption Field -->
                    <div>
                        <label for="caption" class="block text-lg font-medium text-gray-700 mb-3">Caption</label>
                        <input type="text" name="caption" id="caption"
                            class="block w-full px-5 py-4 text-lg border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 {{ $errors->has('caption') ? 'border-red-500' : '' }}"
                            value="{{ old('caption') }}" required autocomplete="caption" autofocus>
                        
                        @if ($errors->has('caption'))
                            <span class="text-red-500 text-sm mt-2">
                                <strong>{{ $errors->first('caption') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-lg font-medium text-gray-700 mb-3">Image</label>
                        <input type="file" id="image" name="image"
                            class="block w-full text-lg text-gray-500 px-5 py-4 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        
                        @if ($errors->has('image'))
                            <span class="text-red-500 text-sm mt-2">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="w-full py-4 px-6 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-lg font-semibold rounded-lg shadow-lg hover:from-indigo-600 hover:to-purple-600 focus:ring-4 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300">
                            Add New Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>
        