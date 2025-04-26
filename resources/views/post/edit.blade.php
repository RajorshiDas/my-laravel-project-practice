<x-layout>

    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your dashboard</a>

    <div>
        <h1 class="text-2xl font-bold mb-6">
          Update your post
        </h1>
        <form action="{{ route('posts.update', $post) }}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        @csrf

        @method('PUT')

         {{-- Post Title --}}
         <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Post Title</label>
            <input type="text" name="title" value="{{ $post->title }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror">

            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Post Body --}}
        <div class="mb-4">
            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Post Content</label>

            <textarea name="body" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('body') border-red-500 @enderror">{{ $post->body }}</textarea>

            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Post Image --}}
        @if ($post->image)
        <div class="h-auto rounded-md mb-4 w-1/6 overflow-hidden">
            <label class="block text-gray-700 text-sm font-bold mb-2">Current cover photo</label>
            <img class="object-cover object-center rounded-md" src="{{ asset('storage/' . $post->image) }}" alt="">
        </div>
        @endif

        {{-- Post Image --}}
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Cover photo</label>
            <input type="file" name="image" id="image"
            class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

            @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <br>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update Post</button>
    </form>
    </div>

    {{-- User Posts --}}

</x-layout>
